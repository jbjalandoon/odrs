<?php
namespace Modules\DocumentRequest\Controllers;

use App\Controllers\BaseController;
use App\Libraries\Pdf;

class Requests extends BaseController
{

	// public function __construct()
	// {
	// 	parent:: __construct();
	// }

  public function index()
  {

		// $this->data['documents'] = $this->document->get();
		$this->data['office_approvals'] = $this->officeApprovalModel->getOwnRequest($_SESSION['student_id']);
		$this->data['request_details_ready'] = $this->requestDetailModel->getDetails(['requests.student_id' => $_SESSION['student_id'], 'request_details.status' => 'r', 'requests.status' => 'c']);
		$this->data['request_details_process'] = $this->requestDetailModel->getDetails(['requests.student_id' => $_SESSION['student_id'], 'request_details.status' => 'p', 'requests.status' => 'c']);
		$this->data['requests'] = $this->requestModel->getDetails(['student_id' => $_SESSION['student_id'], 'requests.completed_at' => null, 'status !=' => 'd']);
		$this->data['request_documents'] = $this->requestDetailModel->getDetails();

    $this->data['view'] = 'Modules\DocumentRequest\Views\requests\index';
    return view('template/index', $this->data);
  }

  public function add(){

		$this->data['documents'] = $this->documentModel->get();
    $this->data['view'] = 'Modules\DocumentRequest\Views\requests\form';
		if ($this->request->getMethod() == 'post') 
    {
			if ($this->validate('request')) {
				// if (!empty($this->requestModel->get(['student_id' => $_SESSION['student_id'], 'completed_at' => null]))) {
				// 	$this->session->setFlashdata('error_message', 'You Have on process document request');
				// 	return redirect()->to(base_url().'requests');
				// } else {
				$data['request'] = [];
				$data['request_document'] = [];
				$requests['student_id']  = $_SESSION['student_id'];
				$requests['reason'] = $_POST['reason'];
				
				$slugs = random_string('alnum', 12);
				// while(!empty($this->requestModel->getBySlugs($slugs))){
				// 	$slugs = random_string('alnum', 12);
				// }
				$requests['slug'] = $slugs;
				$data['request'] = array_merge($data['request'], $requests);
			
			// $request_details['request_id'] = $this->requestModel->input($requests, 'id');
			foreach ($_POST['document_id'] as $index => $document_id) {
				$request_details['document_id'] = $document_id;
				$request_details['quantity'] = $_POST['quantity'][$index];
				array_push($data['request_document'], $request_details);
				// echo "<pre>";
				// foreach ($document_requirements as $document_requirement) {
					// 	  $request_approvals['office_id'] = $document_requirement['office_id'];
					// 	  $this->requestApproval->input($request_approvals);
					// 	}
				}
				if($this->requestModel->request($data))
				{
					$this->session->setFlashdata('success_message', 'You Have Succesfully Made a request');
					return redirect()->to(base_url('requests'));
				} 
				else 
				{
					$this->session->setFlashdata('error_message', 'Something Went Wrong!');
					return redirect()->to(base_url('requests'));
				}
			}
			else {
				$data['error'] = $this->validation->getErrors();
				$data['value'] = $_POST;
			}
		}
    return view('userTemplate/index', $this->data);
  }

	public function delete($id)
	{
		if($this->requestModel->cancelRequest($id));
			return $this->index();
	}

  public function history()
  {	
		$this->data['request_details'] = $this->requestDetailModel->getDetails(['requests.id' => 5]);
	  $this->data['view'] = 'Modules\DocumentRequest\Views\requests\history';
	  return view('userTemplate/index', $this->data);
  }

	public function stub($id){
		$pdf = new Pdf('P', 'mm', 'A4', true, 'UTF-8', false);
    // set document information
    // (di ata kailangan)
    $data['documents'] = $this->documentModel->get();
    $data['requests'] = $this->requestModel->getDetails(['student_id' => $_SESSION['student_id']], $id);
    $data['request_documents'] = $this->requestDetailModel->getDetails(['requests.student_id' => $_SESSION['student_id'], 'request_details.request_id' => $id, 'request_details.status' => 'r']);
		$data['document_notes'] = $this->documentNoteModel->getDetails();
    $pdf->SetTitle('Claiming Stub');


		$pdf->SetHeaderData('header.png', '130', '', '');
    // die(PDF_HEADER_LOGO);
    $pdf->setPrintHeader(true);
    // set header and footer fonts
    $pdf->setHeaderFont(Array('times', 'Times New Roman', PDF_FONT_SIZE_MAIN));
    $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

    // (di ata kailangan)
    $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

    // set margins
    $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
    $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
    $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

    // set auto page breaks
    $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

    // set image scale factor
    $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

    // set default font subsetting mode
    $pdf->setFontSubsetting(true);

    // Set font
    $pdf->SetFont('dejavusans', '', 10, '', true);

    $style = array(
        'position' => '',
        'align' => 'C',
        'stretch' => false,
        'fitwidth' => true,
        'cellfitalign' => '',
        'border' => true,
        'hpadding' => 'auto',
        'vpadding' => 'auto',
        'fgcolor' => array(0, 0, 0),
        'bgcolor' => false, //array(255,255,255),
        'text' => true,
        'font' => 'helvetica',
        'fontsize' => 8,
        'stretchtext' => 4
    );

    $pdf->AddPage();

    // $pdf->setCellPaddings(1, 1, 1, 1);
		//
    // // set cell margins
    // $pdf->setCellMargins(1, 1, 1, 1);


    // $pdf->MultiCell(90  , '', view('report/voucher', $data), 0, 'L', 0, 0, '', '', true, 0, true);
    // $pdf->MultiCell(80, '', $pdf->write1DBarcode('Bernadette', 'C39', 110, '', '', 18, .4, $style, 'N'), 0, 'R', 0, 1, '', '', true);
    $pdf->writeHTML(view('student/request/stub', $data), true, false, true, false, '');
    $pdf->write1DBarcode($data['requests'][0]['slug'], 'C39', '', '', '', 18, .4, $style, 'N');
    $pdf->Ln(4);

    // Set some content to print

    // Print text using writeHTMLCell()

    // $pdf->AddPage();
    $pdf->Output('example_001.pdf', 'I');
    die();
	}
  

}
