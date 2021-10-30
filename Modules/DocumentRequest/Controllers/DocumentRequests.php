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
      header('Location: '.base_url('admin'));
      exit();
    }
  }

  public function completed(){
    $this->data['request_documents'] = $this->requestDetailModel->getDetails();
    $this->data['requests'] = $this->requestModel->getDetails(['requests.completed_at !=' => null, 'requests.status !=' => 'd']);
    $this->data['office_approvals'] = $this->officeApprovalModel->getDetails(['requests.completed_at !=' => null, 'request_details.status !=' => 'd']);
    // echo "<pre>";
    // print_r($this->data['office_approvals']);
    // die();
	  $this->data['view'] = 'Modules\DocumentRequest\Views\requests\completed';
	  return view('template/index', $this->data);
  }

  public function index()
  {
    $this->data['requests'] = $this->requestModel->getDetails(['requests.status' => 'p']);
    $this->data['request_documents'] = $this->requestDetailModel->getDetails(['request_details.received_at' => null]);
    $this->data['view'] = 'Modules\DocumentRequest\Views\requests\pending';
    return view('template/index', $this->data);
  }

  // public function getRequestDetails()
  // {
  //   $details = $this->requestDetailModel->getDetails(['requests.id' => $_POST['id']])[0];
  //   return JSON_decode($details);
  // }

  public function denyRequest()
  {
    $student = $this->userModel->get(['username' => $_POST['student_number']]);

    $this->email->setTo($student[0]['email']);
    $this->email->setSubject('Document Request Update');
    $this->email->setFrom('ODRS', 'PUP-Taguig ODRS');
    $this->email->setMessage('Your Request has been denied (' . $_POST['remark'] .') <br> Try Requesting again');
    if($this->requestModel->denyRequest($_POST))
      $this->email->send();
    return $this->index();
  }

  public function confirmRequest(){
    foreach($_POST['data'] as $key => $value){
      $student = $this->userModel->get(['username' => $_POST['data'][$key][1]]);
      $this->email->setTo($student[0]['email']);
      $this->email->setSubject('Document Request Update');
      $this->email->setFrom('ODRS', 'PUP-Taguig ODRS');
      $this->email->setMessage('<p>Good day!</p> <p>Your requested document/s has been approved!</p> <p>You may now download the payment stub and pay the indicated price in the stub.
</p> <p>Thank you!</p>');
      if($this->requestModel->confirmRequest($_POST['data']))
        $this->email->send();
    }


    return $this->index();
  }

  public function acceptPaid()
  {
    // return print_r($this->requestModel->denyRequest($_POST));
    $student = $this->userModel->get(['username' => $_POST['student_number']]);

    $this->email->setTo($student[0]['email']);
    $this->email->setSubject('Document Request Update');
    $this->email->setFrom('ODRS', 'PUP-Taguig ODRS');
    $this->email->setMessage('<p>Good day!</p> <p>Your requested document/s has been approved and now will be process!</p> <p>Please be reminded that you\'ll be notified via email once your requested document is done and is ready for its next step process.
</p> <p>Thank you!</p>');
    if($this->requestModel->acceptPaid($_POST['id']))
      $this->email->send();
    return $this->paid();
  }

  public function denyPaid()
  {
    // return print_r($this->requestModel->denyRequest($_POST));
    $student = $this->userModel->get(['username' => $_POST['student_number']]);

    $this->email->setTo($student[0]['email']);
    $this->email->setSubject('Document Request Update');
    $this->email->setFrom('ODRS', 'PUP-Taguig ODRS');
    $this->email->setMessage('<p>Good day!</p> <p> There is something wrong in your uploaded receipt please double check your upload and try it uploading again. (This will be serve as proof of your payment)
</p> <p>Thank you!</p>');
    if($this->requestModel->denyPaid($_POST['id']))
      $this->email->send();
    return $this->paid();
  }

  public function payment(){
    $this->data['requests'] = $this->requestModel->getDetails(['requests.status' => 'y']);
    $this->data['request_documents'] = $this->requestDetailModel->getDetails(['request_details.received_at' => null]);
    $this->data['view'] = 'Modules\DocumentRequest\Views\requests\payment';
    return view('template\index', $this->data);
  }

  public function paid(){
    $this->data['requests'] = $this->requestModel->getDetails(['requests.status' => 'i']);
    $this->data['request_documents'] = $this->requestDetailModel->getDetails(['request_details.received_at' => null]);
    $this->data['view'] = 'Modules\DocumentRequest\Views\requests\paid';
    return view('template\index', $this->data);
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
    $this->email->setFrom('ODRS', 'PUP-Taguig ODRS');
    $this->email->setMessage('<p>Good day!</p> <p>Your requested document/s has been denied due to the following reasons!</p> <p>'. $_POST['remark'].'<p>Please check your ODRS Account for further information</p></p> <p>Thank you!</p> ');
    if($this->officeApprovalModel->holdRequest($_POST))
      $this->email->send();
    return $this->approval();
  }

  public function approveRequest()
  {
    foreach($_POST['data'] as $key => $value){
      $office = $this->officeModel->get(['id' => $_SESSION['office_id']])[0];
      $students = $this->userModel->get(['username' => $_POST['data'][$key][2]]);
      $this->email->setTo($students[0]['email']);
      $this->email->setSubject('Document Request Update');
      $this->email->setFrom('ODRS', 'PUP-Taguig ODRS');
      $this->email->setMessage('<p>Good day!</p> <p>Your requested document/s has been approved by the Office of the '.$office['office'].'!</p> <p>'.  $_POST['data'][$key][5].' <p>Please be reminded that you\'ll be notified via email once your requested document is done and is ready for its next step process.</p> </p> <p>Thank you!</p>');

      $this->email->send();
      if($this->officeApprovalModel->approveRequest($_POST['data'][$key]))
      {
        if (count($this->officeApprovalModel->get(['request_detail_id' => $_POST['data'][$key][1]])) == count($this->officeApprovalModel->get(['request_detail_id' => $_POST['data'][$key][1], 'status' => 'c']))) {
          $this->requestDetailModel->update($_POST['data'][$key][1], ['status' => 'p']);
        }
      }
    }

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
    $_POST['printed_at'] == null ? $printed_at = date('Y-m-d H:i:s'): $printed_at = date("Y-m-d H:i:s", strtotime($_POST["printed_at"]));
    if($this->request->getFile('file') == null){
      $data = [
        'status' => 'r',
        'printed_at' => $printed_at,
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
    // return $request['document'];
    $mail = \Config\Services::email();
    $mail->setTo($_POST['email']);
    $mail->setSubject('Document Request Update');
    $mail->setFrom('ODRS', 'PUP-Taguig ODRS');
    $mail->setMessage('<p>Good day! </p><p>Your requested document is now ready to claim</p>' . $request['document'] . '<p>Just present the receipt to claim the document</p><p>Thank you!</p>');
    $mail->send();
    return $data['page'].'';
  }

  public function acceptForm()
  {
    // return print_r($this->requestModel->denyRequest($_POST));
    $student = $this->userModel->get(['username' => $_POST['student_number']]);

    $this->email->setTo($student[0]['email']);
    $this->email->setSubject('Document Request Update');
    $this->email->setFrom('ODRS', 'PUP-Taguig ODRS');
    $this->email->setMessage('Your Form 137 Requests has been approved, you may now download the request form.');
    if($this->formRequestModel->acceptForm($_POST['id']))
      $this->email->send();
    return $this->formRequests();
  }

  public function receiveForm()
  {
    // return print_r($this->requestModel->denyRequest($_POST));
    if($this->formRequestModel->receiveForm($_POST['id']))
      $this->email->send();
    return $this->formRequests();
  }

  public function form($id){
    $pdf = new Pdf(PDF_PAGE_ORIENTATION, PDF_UNIT, 'LETTER', true, 'UTF-8', false);
    $data = $this->formRequestModel->getDetails(['form_requests.id' => $id])[0];
    // set document information
    $pdf->SetCreator(PDF_CREATOR);
    $pdf->SetAuthor('PUPT ODRS');
    $pdf->SetTitle('Form-137 Request');
    $pdf->SetSubject('Form-137 Request');
    // set default header data
    $pdf->SetHeaderData('header.png', '200', '', '');
    // set header and footer fonts
    $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
    $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

    // set default monospaced font
    $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

    // set margins
    $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP + 10, PDF_MARGIN_RIGHT);
    $pdf->SetHeaderMargin(3);
    $pdf->SetFooterMargin(PDF_MARGIN_FOOTER + 15);

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
    // disable auto-page-break
    // set bacground image
    $img_file = K_PATH_IMAGES.'bg.png';
    $pdf->Image($img_file, 22, 40, 175, 175, '', '', '', false, 300, '', false, false, 0);
    // restore auto-page-break status
    // set the starting point for the page content
    $pdf->setPageMark();
    $pdf->setJPEGQuality(100);
    $pdf->SetFont('lucidafaxdemib', '', 9);

    $pdf->MultiCell(90, 10, 'Reference No.', 0, 'L', 0, 0, '', '', true, 0, false, true, 0, 'T');
    $pdf->Ln(4);
    $pdf->SetTextColor(255,0,0);
    $pdf->SetFont('lucidafaxdemib', '', 12);

    $pdf->MultiCell(90, 10, 'PUPTG-F137-' . date('Y', strtotime($data['created_at'])). '-' . substr(str_repeat(0, 5).$data['id'], - 5), 0, 'L', 0, 0, '', '', true, 0, false, true, 0, 'T');

    $pdf->Ln(12);
    $pdf->SetTextColor(0,0,0);
    $pdf->SetFont('lucidafax', '', 12);

    $pdf->MultiCell(90, 10, '', 0, 'J', 0, 0, '', '', true, 0, false, true, 40, 'T');
    $pdf->MultiCell(90, 10, date('F d, Y'), 0, 'L', 0, 0, '', '', true, 0, false, true, 40, 'T');

    $pdf->Ln(20);

    $pdf->SetFont('lucidafaxdemib', '', 12);
    $pdf->MultiCell(70, 30, 'THE PRINCIPAL/REGISTRAR', 0, 'L', 0, 0, '', '', true, 0, false, true, 40, 'T');

    $pdf->Ln(4);
    $pdf->SetFont('lucidafax', '', 12);
    $pdf->MultiCell(120, 30, strtoupper($data['school']), 0, 'L', 0, 0, '', '', true, 0, false, true, 40, 'T');
    $pdf->Ln(4);
    $pdf->MultiCell(120, 30, strtoupper($data['address']), 0, 'L', 0, 0, '', '', true, 0, false, true, 40, 'T');

    $pdf->Ln(8);

    $pdf->SetFont('lucidafax', '', 12);
    $pdf->MultiCell(70, 30, 'Dear Sir/Maam:', 0, 'L', 0, 0, '', '', true, 0, false, true, 40, 'T');

    $pdf->Ln(8);
    $pdf->writeHTML('<p style="text-indent: 50px">May I request for the ', 0, 0, true, 1);
    $pdf->SetFont('lucidafaxdemib', '', 12);
    $pdf->writeHTML('original copy', 0, 0, true, 1);
    $pdf->SetFont('lucidafax', '', 12);
    $pdf->writeHTML('of Form 137-A and/or Transcript of Records of', 0, 0, true, 1);
    $pdf->SetFont('lucidafaxdemib', '', 12);
    $pdf->writeHTML(ucwords($data['firstname'] . ' ' . $data['middlename'] . ' '. $data['lastname'] . ' '. $data['suffix']).' ', 0, 0, true, 1);
    $pdf->SetFont('lucidafax', '', 12);
    $pdf->writeHTML('please indicate the student\'s complete name ', 0, 0, true, 1);
    $pdf->SetFont('lucidafaxdemib', '', 12);
    $pdf->writeHTML('(Last Name, First Name, and Middle Name) ', 0, 0, true, 1);
    $pdf->SetFont('lucidafax', '', 12);
    $pdf->writeHTML('and with ', 0, 0, true, 1);
    $pdf->SetFont('lucidafaxdemib', '', 12);
    $pdf->writeHTML('<b>"Copy for POLYTECHNIC UNIVERSITY OF THE PHILIPPINES TAGUIG BRANCH"</b> ', 0, 0, true, 1);
    $pdf->SetFont('lucidafax', '', 12);
    $pdf->writeHTML('remarks. The above-mentioned student has been admitted on the basis of his/her transfer credentials for ', 0, 0, true, 1);
    $pdf->SetFont('lucidafaxdemib', '', 12);
    $pdf->writeHTML($data['course'], 0, 0, true, 1);
    $pdf->SetFont('lucidafax', '', 12);
    $pdf->writeHTML('presented in this University, S.Y. ', 0, 0, true, 1);
    $pdf->SetFont('lucidafaxdemib', '', 12);
    $pdf->writeHTML('<b>'.SCHOOL_YEAR.'</b>.</p>', 0, 0, true, 1);
    // $pdf->writeHTML('May I request for the <b>original copy</b> of Form 137-A and/or Transcript of Records of <u><b>'.$_SESSION['name'].'</b></u>. Please indicate the <b>student\'s complete name</b> (Last Name, First Name, and Middle Name) and with <b>"Copy for POLYTECHNIC UNIVERSITY OF THE PHILIPPINES TAGUIG BRANCH"  </b> remarks. The above-mentioned student has been admitted on the basis of his/her transfer credentials presented in this University, S.Y. <u><b>'.SCHOOL_YEAR.'</b></u>.', true, 0, true, 0);
    // $pdf->MultiCell(180, 30, , 0, 'L', 0, 0, '', '', true, 0, false, true, 40, 'T');

    $pdf->Ln(8);

    $pdf->SetFont('lucidafax', '', 12);
    $pdf->writeHTML('<p style="text-indent: 50px;">May I Further request that said copy be sent to our Admission and Registration Office, c/o the undersigned, in a <b>sealed envelope</b>, bearing your signature on its flap, to be hand-carried by the student. Thank you.</p>', 0, 0, true, 1);
    // $pdf->MultiCell(180, 30, , 0, 'L', 0, 0, '', '', true, 0, false, true, 40, 'T');

    $pdf->Ln(4);

    $pdf->MultiCell(60, 10, '', 0, 'J', 0, 0, '', '', true, 0, false, true, 40, 'T');
    $pdf->MultiCell(20, 10, '', 0, 'J', 0, 0, '', '', true, 0, false, true, 40, 'T');
    $pdf->MultiCell(90, 10, 'Very truly yours,', 0, 'C', 0, 0, '', '', true, 0, false, true, 40, 'T');

    $pdf->Ln(20);

    $pdf->SetFont('lucidafaxdemib', '', 12);
    $pdf->MultiCell(60, 1, '', 0, 'C', 0, 0, '', '', true, 0, false, true, 40, 'T');
    $pdf->MultiCell(20, 1, '', 0, 'J', 0, 0, '', '', true, 0, false, true, 40, 'T');
    $pdf->MultiCell(90, 1, 'MR. MHEL P. GARCIA', 0, 'C', 0, 0, '', '', true, 0, false, true, 40, 'T');

    $pdf->Ln(4);



    $pdf->SetFont('lucidafax', '', 12);

    $pdf->MultiCell(60, 10, '', 0, 'J', 0, 0, '', '', true, 0, false, true, 40, 'T');
    $pdf->MultiCell(20, 10, '', 0, 'J', 0, 0, '', '', true, 0, false, true, 40, 'T');
    $pdf->MultiCell(90, 10, 'Head, Admission and Registration Office', 0, 'L', 0, 0, '', '', true, 300, false, true, 40, 'T');

    $pdf->Ln(8);

    $pdf->SetFont('lucidafaxdemib', '', 9);

    $pdf->MultiCell(90, 10, 'Remarks:', 0, 'L', 0, 0, '', '', true, 0, false, true, 0, 'T');
    $pdf->Ln(4);
    $pdf->SetFont('lucidafax', '', 9);
    if ($data['remarks'] == 1) {
      $remark = '1st Request';
    } elseif ($data['remarks'] == 2) {
      $remark = '2nd Request';
    } elseif ($data['remarks'] == 3) {
      $remark = '3rd Request';
    } else {
      $remark = '4th Request';
    }
    $pdf->MultiCell(90, 10, $remark, 0, 'L', 0, 0, '', '', true, 0, false, true, 0, 'T');

    // -----------------------------------------------------------------------------
    // output the HTML content
    // -----------------------------------------------------------------------------
    $pdf->SetXY(122, 172);
    $pdf->Image(APPPATH . 'libraries/tcpdf/examples/images/signature.png', '', '', 35, 20, '', '', 'T', false, 300, '', false, false, 1, false, false, false);


    //Close and output PDF document
    $pdf->Output('example_048.pdf', 'I');

    //============================================================+
    // END OF FILE
    //============================================================+
    die('here');
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
		$pdf->SetAuthor('PUPT Taguig ODRS');
		$pdf->SetTitle('Report');
		$pdf->SetSubject('Documet Request Report');
		$pdf->SetKeywords('Report, ODRS, Document');

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

    $pdf->SetFont('helvetica', '', 12);


// Fit text on cell by reducing font size
    $pdf->MultiCell(89, 40, 'Prepared By:

Mhel P. Garcia
Branch Registrar Head', 0, 'C', 0, 0, '', '', true, 0, false, true, 40, 'M' ,true);
    $pdf->MultiCell(89, 40, '', 0, 'J', 0, 0, '', '', true, 0, false, true, 40, 'M');
    $pdf->MultiCell(89, 40, 'Noted By:

Dr. Marissa B. Ferrer
Branch Director', 0, 'C', 0, 1, '', '', true, 0, false, true, 40, 'M');

    $pdf->Ln(4);

    $pdf->SetFont('helvetica', '', 10);


    $pdf->AddPage();

    $data['documents'] = $this->requestDetailModel->getSummary($_GET['t'], $_GET['a'], $_GET['d']);

    $data['types'] = $_GET;
    $data['document'] = $this->documentModel->get(['id' => $_GET['d']])[0]['document'];
    $summaryTable = view('Modules\DocumentRequest\Views\requests\summary',$data);

    $pdf->writeHTML($summaryTable, true, false, false, false, '');
		// -----------------------------------------------------------------------------

    $pdf->SetFont('helvetica', '', 12);


// Fit text on cell by reducing font size
    $pdf->MultiCell(89, 40, 'Prepared By:

Mhel P. Garcia
Branch Registrar Head', 0, 'C', 0, 0, '', '', true, 0, false, true, 40, 'M' ,true);
    $pdf->MultiCell(89, 40, '', 0, 'J', 0, 0, '', '', true, 0, false, true, 40, 'M');
    $pdf->MultiCell(89, 40, 'Noted By:

Dr. Marissa B. Ferrer
Branch Director', 0, 'C', 0, 1, '', '', true, 0, false, true, 40, 'M');

		//Close and output PDF document
		$pdf->Output('report.pdf', 'I');

		//============================================================+
		// END OF FILE
		//============================================================+
		die();
  }

  public function addForm(){
    $this->data['view'] = 'Modules\DocumentRequest\Views\requests\formrequest';
    $this->data['requests'] = $this->formRequestModel->getDetails(['student_id' => $_SESSION['student_id'], 'form_requests.status !=' => 'c']);
    if ($this->request->getMethod() == 'post') {
      if ($this->validate('form')) {
        $data = [
          'student_id' => $_SESSION['student_id'],
          'school' => $_POST['school'],
          'address' => $_POST['address'],
          'sy_admission' => $_POST['sy_admission'],
          'status' => 'w',
          'remarks' => $_POST['remarks']
        ];
        if ($this->formRequestModel->input($data)) {
          $this->session->setFlashData('success_message', 'Sucessfully make a request');
        } else {
          $this->session->setFlashData('error_message', 'Something Went wrong!');
        }
        return redirect()->to(base_url('form-137'));
        print_r($_POST);
        die();
      } else {
        $this->data['error'] = $this->validation->getErrors();
      }
    }
    return view('template/index', $this->data);
  }

  public function formRequests(){
    $this->data['view'] = 'Modules\DocumentRequest\Views\requests\formrequestlist';
    $this->data['requests'] = $this->formRequestModel->getDetails();
    return view('template/index', $this->data);
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
    $pdf->Output('goodmoral.pdf', 'I');

    //============================================================+
    // END OF FILE
    //============================================================+
    die('here');
  }

}
