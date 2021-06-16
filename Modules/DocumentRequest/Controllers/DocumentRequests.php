<?php
namespace Modules\DocumentRequest\Controllers;

use App\Libraries\Pdf;
use App\Controllers\BaseController;

class DocumentRequests extends BaseController
{

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
    if($this->requestModel->denyRequest($_POST))
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
    $this->data['request_approvals'] = $this->officeApprovalModel->getDetails(['office_id' => $_SESSION['office_id'], 'request_approvals.status' => 'p']);
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
      
      // $this->email->send();
      
    }
    if($this->officeApprovalModel->approveRequest($_POST['data']))
      return $this->approval();
      
  }

  public function onProcess()
  {
    $this->data['request_details'] = $this->requestDetailModel->getDetails(['request_details.status' => 'p', 'requests.status' => 'c']);
    $this->data['view'] = 'Modules\DocumentRequest\Views\requests\process';
    return view('template/index', $this->data);
  }

  public function printed()
  {
    
    $this->data['request_details_release'] = $this->requestDetailModel->getDetails(['request_details.status' => 'r', 'requests.status' => 'c']);
    $this->data['view'] = 'Modules\DocumentRequest\Views\requests\printed';
    return view('template/index', $this->data);
  }

  public function printRequest()
  {
    $data = [];
    foreach($_POST['data'] as $key => $value){
      $temp = [
        'id' => $value[0],
        'page' => $_POST['pages'][$key],
        'printed_at' => date("Y-m-d H:i:s"),
      ];
      array_push($data, $temp);
      $student = $this->userModel->get(['username' => $_POST['data'][$key][2]]);
        $this->email->setTo($student[0]['email']);
        $this->email->setSubject('Document Request Update');
        $this->email->setFrom('ODRS', 'PUP');
        $this->email->setMessage('Your Request has been printed' . $_POST['data'][$key][5]);
    }
    if($this->requestDetailModel->printRequest($data))
      return $this->printed();
  }

  public function claimRequest()
  {
    if (count($this->requestDetailModel->get(['request_id' => $id])) == count($this->requestDetailModel->get(['request_id' => $id, 'status' => 'c']))) {
      $this->requestModel->edit(['completed_at' => date('Y-m-d h:i:s')], $id);
    }
    return $this->requestDetailModel->claimRequest($_POST['value']);
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
    $data['documents'] = $this->documentModel->get();
    if($_GET['id'] == 0){
      $data['request_details'] = $this->requestDetailModel->getDetails(['request_details.status' => 'c', 'requests.status' => 'c']);
    }else{
      $data['request_details'] = $this->requestDetailModel->getDetails(['request_details.status' => 'c', 'requests.status' => 'c', 'document_id' => $_GET['id']]);
    }
    return view('Modules\DocumentRequest\Views\requests\claimed', $data);
  }
  
  public function report(){
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

		// ---------------------------------------------------------

		// set font

		// add a page
		$pdf->AddPage();


		$pdf->SetFont('helvetica', '', 10);

		// -----------------------------------------------------------------------------
		$data['documents'] = $this->requestDetailModel->getReports($_GET['t'], $_GET['a'], $_GET['d']);
		$reportTable = view('admin/request/report',$data);

		$pdf->writeHTML($reportTable, true, false, false, false, '');

		// -----------------------------------------------------------------------------

		//Close and output PDF document
		$pdf->Output('example_048.pdf', 'I');

		//============================================================+
		// END OF FILE
		//============================================================+
		die();
  }

}
