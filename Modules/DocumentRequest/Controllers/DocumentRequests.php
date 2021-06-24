<?php
namespace Modules\DocumentRequest\Controllers;

use App\Libraries\Pdf;
use App\Libraries\Fpdi;
use App\Controllers\BaseController;

class DocumentRequests extends BaseController
{

  function __construct(){
    $this->session = \Config\Services::session();
    $this->session->start();
    if(!isset($_SESSION['user_id'])){
      header('Location: '.base_url());
      exit();
    }
  }

  public function index()
  {
    $this->data['requests'] = $this->requestModel->getDetails(['requests.status' => 'p']);
    $this->data['request_documents'] = $this->requestDetailModel->getDetails(['request_details.received_at' => null]);
    $this->data['view'] = 'Modules\DocumentRequest\Views\requests\pending';
    return view('template\index', $this->data);
  }

  // public function getRequestDetails()
  // {
  //   $details = $this->requestDetailModel->getDetails(['requests.id' => $_POST['id']])[0];
  //   return JSON_decode($details);
  // }

  public function denyRequest()
  {
    // return print_r($this->requestModel->denyRequest($_POST));
    $student = $this->userModel->get(['username' => $_POST['student_number']]);

    $this->email->setTo($student[0]['email']);
    $this->email->setSubject('Document Request Update');
    $this->email->setFrom('ODRS', 'PUP');
    $this->email->setMessage('Your Request has been denied : ' . $_POST['remark']);
    if($this->requestModel->cancelRequest($_POST['id']))
      $this->email->send();
    return $this->index();
  }

  public function confirmRequest(){
    // return print_r($this->requestModel->denyRequest($_POST));
    $student = $this->userModel->get(['username' => $_POST['data'][0][1]]);
    $this->email->setTo($student[0]['email']);
    $this->email->setSubject('Document Request Update');
    $this->email->setFrom('ODRS', 'PUP');
    $this->email->setMessage('Your Request has been confirmed');
    if($this->requestModel->confirmRequest($_POST['data']))
      $this->email->send();
    return $this->index();
  }

  public function approval()
  {
    $this->data['request_approvals'] = $this->officeApprovalModel->getDetails(['office_id' => $_SESSION['office_id'], 'request_approvals.status' => 'p', 'requests.status !=' => 'p']);
    $this->data['request_approvals_hold'] = $this->officeApprovalModel->getDetails(['office_id' => $_SESSION['office_id'], 'request_approvals.status' => 'h']);
    $this->data['view'] = 'Modules\DocumentRequest\Views\requests\approval';

    return view('template/index', $this->data);
  }

  public function holdRequest()
  {
    // return print_r($this->requestModel->denyRequest($_POST));
    $student = $this->userModel->get(['username' => $_POST['student_number']]);

    $this->email->setTo($student[0]['email']);
    $this->email->setSubject('Document Request Update');
    $this->email->setFrom('ODRS', 'PUP');
    $this->email->setMessage('Your Request is on hold : ' . $_POST['remark']);
    if($this->officeApprovalModel->holdRequest($_POST))
      $this->email->send();
    return $this->approval();
  }

  public function approveRequest()
  {
    foreach($_POST['data'] as $key => $value){
      $students = $this->userModel->get(['username' => $_POST['data'][$key][2]]);
      $this->email->setTo($students[0]['email']);
      $this->email->setSubject('Document Request Update');
      $this->email->setFrom('ODRS', 'PUP');
      $this->email->setMessage('You dont have any sanctions your request ' . $_POST['data'][$key][5] . ' is now to be processed');

      $this->email->send();

    }
    if($this->officeApprovalModel->approveRequest($_POST['data']))
      return $this->approval();

  }

  public function onProcess()
  {
    $this->data['documents'] = $this->documentModel->get();
    $this->data['request_details'] = $this->requestDetailModel->getDetails(['request_details.status' => 'p', 'requests.status' => 'c']);
    $this->data['view'] = 'Modules\DocumentRequest\Views\requests\process';
    return view('template/index', $this->data);
  }

  public function filterOnProcess()
  {
    if($_GET['document_id'] == 0){
      $this->data['request_details'] = $this->requestDetailModel->getDetails(['request_details.status' => 'p', 'requests.status' => 'c']);
    } else {
      $this->data['request_details'] = $this->requestDetailModel->getDetails(['request_details.status' => 'p', 'requests.status' => 'c', 'documents.id' => $_GET['document_id']]);
    }
    return view('Modules\DocumentRequest\Views\requests\tables\process', $this->data);
  }

  public function printed()
  {
    $this->data['documents'] = $this->documentModel->get();
    $this->data['request_details_release'] = $this->requestDetailModel->getDetails(['request_details.status' => 'r', 'requests.status' => 'c']);
    $this->data['view'] = 'Modules\DocumentRequest\Views\requests\printed';
    return view('template/index', $this->data);
  }

  public function filterPrinted(){
    if($_GET['document_id'] == 0){
      $this->data['request_details_release'] = $this->requestDetailModel->getDetails(['request_details.status' => 'r', 'requests.status' => 'c']);
    } else {
      $this->data['request_details_release'] = $this->requestDetailModel->getDetails(['request_details.status' => 'r', 'requests.status' => 'c', 'documents.id' => $_GET['document_id']]);
    }
    return view('Modules\DocumentRequest\Views\requests\tables\printed', $this->data);
  }

  public function printRequest()
  {
    // return print_r($_FILES);
    if($this->request->getFile('file') == null){
      $data = [
        'status' => 'r',
        'printed_at' => date('Y-m-d H:i:s'),
        'page' => null,
      ];
      if($this->requestDetailModel->printRequest($_POST['id'] ,$data)){

      }
    } else {
      $file = $this->request->getFile('file');
      $newName = $file->getRandomName();

      $path = $file->move('../public/pdf/', $newName);
      $pdftext = file_get_contents('../public/pdf/'.$newName);
      $num = preg_match_all("/\Page\W/", $pdftext, $dummy);

      $data = [
        'status' => 'r',
        'printed_at' => date('Y-m-d H:i:s'),
        'page' => $num,
      ];
      $this->requestDetailModel->printRequest($_POST['id'] ,$data);

    }
    $request = $this->requestDetailModel->getDetails(['request_details.id' => $_POST['id']])[0];
    // return print_r($request);
    $mail = \Config\Services::email();
    $mail->setTo($_POST['email']);
    $mail->setSubject('Ready to claim Document');
    $mail->setFrom('ODRS', 'PUP');
    $mail->setMessage('Your document is ready to claim:  ' . $request['document']);
    $mail->send();
    return $num . '';
  }

  public function claimRequest()
  {

    if ($this->requestDetailModel->claimRequest($_POST['value'])) {
      if (count($this->requestDetailModel->get(['request_id' => $_POST['request_id']])) == count($this->requestDetailModel->get(['request_id' => $_POST['request_id'], 'status' => 'c']))) {
        return $this->requestModel->edit(['completed_at' => date('Y-m-d h:i:s')], $_POST['request_id']);
      }
    }
    return false;

  }

  public function getPrinted()
  {
    if(empty($this->requestModel->getBySlugs($_GET['slug']))){
      return JSON_encode(['404' => 'Not Found']);
    } else {
      $id = $this->requestModel->getBySlugs($_GET['slug'])[0]['id'];
      $request_details = $this->requestDetailModel->getDetails(['request_id' => $id, 'request_details.status' => 'r']);
    }
    return JSON_encode($request_details);
  }

  public function claimed()
  {
    $this->data['documents'] = $this->documentModel->get();
    $this->data['request_details'] = $this->requestDetailModel->getDetails(['request_details.status' => 'c', 'requests.status' => 'c']);
    $this->data['view'] = 'Modules\DocumentRequest\Views\requests\claimed';
    return view('template/index', $this->data);
  }

  public function claimFilter(){
    if($_GET['document_id'] == 0){
      $this->data['request_details'] = $this->requestDetailModel->getDetails(['request_details.status' => 'c', 'requests.status' => 'c']);
    }else{
      $this->data['request_details'] = $this->requestDetailModel->getDetails(['request_details.status' => 'c', 'requests.status' => 'c', 'document_id' => $_GET['document_id']]);
    }
    return view('Modules\DocumentRequest\Views\requests\tables\claimed', $this->data);
  }

  public function report(){
    $pdf = new Pdf('L', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

		// set document information
		$pdf->SetCreator(PDF_CREATOR);
		$pdf->SetAuthor('Nicola Asuni');
		$pdf->SetTitle('TCPDF Example 048');
		$pdf->SetSubject('TCPDF Tutorial');
		$pdf->SetKeywords('TCPDF, PDF, example, test, guide');

		// set default header data
		$pdf->SetHeaderData('header.png', '130', '', '');

		// set header and footer fonts
		$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
		$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

		// set default monospaced font
		$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

		// set margins
		$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
		$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
		$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

		// set auto page breaks
		$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

		// set image scale factor
		$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

		// set some language-dependent strings (optional)
		if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
		    require_once(dirname(__FILE__).'/lang/eng.php');
		    $pdf->setLanguageArray($l);
		}

		// ---------------------------------------------------------

		// set font

		// add a page
		$pdf->AddPage();


		$pdf->SetFont('helvetica', '', 10);

		// -----------------------------------------------------------------------------
		$data['documents'] = $this->requestDetailModel->getReports($_GET['t'], $_GET['a'], $_GET['d']);
    $data['types'] = $_GET;
    $data['document'] = $this->documentModel->get(['id' => $_GET['d']])[0]['document'];
		$reportTable = view('Modules\DocumentRequest\Views\requests\report',$data);

		$pdf->writeHTML($reportTable, true, false, false, false, '');

		// -----------------------------------------------------------------------------

		//Close and output PDF document
		$pdf->Output('example_048.pdf', 'I');

		//============================================================+
		// END OF FILE
		//============================================================+
		die();
  }

  public function goodmoral($request_id){
    $pdf = new Pdf(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

    // set document information
    $pdf->SetCreator(PDF_CREATOR);
    $pdf->SetAuthor('Nicola Asuni');
    $pdf->SetTitle('TCPDF Example 048');
    $pdf->SetSubject('TCPDF Tutorial');
    $pdf->SetKeywords('TCPDF, PDF, example, test, guide');

    // set default header data
    $pdf->SetHeaderData('header.png', '130', '', '');

    // set header and footer fonts
    $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
    $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

    // set default monospaced font
    $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

    // set margins
    $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
    $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
    $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

    // set auto page breaks
    $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

    // set image scale factor
    $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

    // set some language-dependent strings (optional)
    if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
        require_once(dirname(__FILE__).'/lang/eng.php');
        $pdf->setLanguageArray($l);
    }
    $details = $this->requestDetailModel->getDetails(['request_details.id' => $request_id])[0];
    // ---------------------------------------------------------

    // set font

    // add a page
    $pdf->AddPage();


    $pdf->SetFont('helvetica', '', 10);

    // -----------------------------------------------------------------------------
    $txt = <<<EOD
                  Office of the Branch Registrar
    EOD;
    // print a block of text using Write()
    $pdf->Write(0, $txt, '', 0, 'L', true, 0, false, false, 0);
    $date = date('F d, Y');
    $txt = <<<EOD
                  $date
    EOD;
    // print a block of text using Write()
    $pdf->Write(0, $txt, '', 0, 'R', true, 0, false, false, 0);
    $txt = <<<EOD
    CERTIFICATION
    EOD;
    // print a block of text using Write()
    $pdf->Write(0, $txt, '', 0, 'C', true, 0, false, false, 0);
    $txt = <<<EOD
    To Whom It May Concern:
    EOD;
    // print a block of text using Write()
    $pdf->Write(0, $txt, '', 0, 'L', true, 0, false, false, 0);
    $prefix = $details['gender'] == 'm' ? 'Mr': 'Ms';
    $name =  $prefix .'. '.$details['firstname'] . ' ' . $details['lastname'];
    $pronoun['subjective'] = $details['gender'] == 'm' ? 'he': 'she';
    $pronoun['possesive'] = $details['gender'] == 'm' ? 'his': 'hers';
    $pronoun['objective'] = $details['gender'] == 'm' ? 'him': 'her';
    $html = '<span style="text-align:justify; text-indent: 50px;"><p> This is to certify that <b>'. $name .'</b> is a student of this University and that '.$pronoun['subjective'].' shows good moral character and has not been disciplined for any violation of the rules and regulations of the University.</p></span>';

// output the HTML content
    $pdf->writeHTML($html, true, 0, true, false, '');

    $html = '<span style="text-align:justify; text-indent: 50px;"><p>This certification is being issued upon '.$pronoun['possesive'].' request for whatever legitimate purpose it may serve '.$pronoun['objective'].'.</p></span>';

    $pdf->writeHTML($html, true, 0, true, false, '');

    $tbl = <<<EOD
    <table border="0" cellpadding="2" cellspacing="2" align="center">
     <tr nobr="true">
      <td></td>
      <td>MHEL P. GARCIA <br />Head of Admission & Registration Office</td>
     </tr>
    </table>
    EOD;

    $pdf->writeHTML($tbl, true, false, false, false, '');

    $txt = <<<EOD
    shgs/20
    EOD;
    // print a block of text using Write()
    $pdf->Write(0, $txt, '', 0, 'L', true, 0, false, false, 0);
// output the HTML content
    // -----------------------------------------------------------------------------

    //Close and output PDF document
    $pdf->Output('example_048.pdf', 'I');

    //============================================================+
    // END OF FILE
    //============================================================+
    die('here');
  }

}
