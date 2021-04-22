<?php

namespace App\Controllers\Student;
use App\Controllers\BaseController;
use App\Libraries\Pdf;

class Request extends BaseController
{

	public function index()
	{

		if($_SESSION['role_id'] != 1 || !isset($_SESSION['role_id']))
			return view('errors/html/error_404');

		$data['documents'] = $this->document->get();
    $data['request_details_ready'] = $this->requestDetail->getDetails(['requests.student_id' => $_SESSION['student_id'], 'request_details.status' => 'r', 'requests.status' => 'c']);
    $data['request_details_process'] = $this->requestDetail->getDetails(['requests.student_id' => $_SESSION['student_id'], 'request_details.status' => 'p', 'requests.status' => 'c']);
    $data['requests'] = $this->requestModel->getDetails(['student_id' => $_SESSION['student_id'], 'requests.completed_at' => null]);
    $data['request_documents'] = $this->requestDetail->getDetails();

		echo view('student/template/header');
		echo view('student/request/index', $data);
		return view('student/template/footer');
	}

	public function send(){

		if($_SESSION['role_id'] != 1 || !isset($_SESSION['role_id']))
			return view('errors/html/error_404');

		$data['documents'] = $this->document->get();
		if ($this->request->getMethod() == 'get') {
			echo view('student/template/header');
			echo view('student/request/form', $data);
			return view('student/template/footer');
		} else {
			if ($this->validate('request')) {
				if (!empty($this->requestModel->get(['student_id' => $_SESSION['student_id'], 'completed_at' => null]))) {
					$this->session->setFlashdata('error_message', 'You Have on process document request');
					return redirect()->to(base_url().'/student');
				} else {
					$requests['student_id']  = $_SESSION['student_id'];
			    $requests['reason'] = $_POST['reason'];
					$slugs = random_string('alnum', 12);
					while(!empty($this->requestModel->getBySlugs($slugs))){
						$slugs = random_string('alnum', 12);
					}
			    $requests['slugs'] = $slugs;
			    $request_details['request_id'] = $this->requestModel->input($requests, 'id');
			    foreach ($_POST['document_id'] as $index => $document_id) {
			      $document_requirements = $this->documentRequirement->get(['document_id' => $document_id]);
			      $request_details['document_id'] = $document_id;
			      $request_details['quantity'] = $_POST['quantity'][$index];
			      $request_details['status'] = empty($document_requirements) ? 'p' : 'a';
			      $request_approvals['request_detail_id'] = $this->requestDetail->input($request_details, 'id');
			      foreach ($document_requirements as $document_requirement) {
			        $request_approvals['office_id'] = $document_requirement['office_id'];
			        $this->requestApproval->input($request_approvals);
			      }
			    }
					$this->session->setFlashdata('success_message', 'You Have Succesfully Made a request');
			    return redirect()->to(base_url().'/student');
				}
			} else {
				$data['error'] = $this->validation->getErrors();
				echo view('student/template/header');
				echo view('student/request/form', $data);
				return view('student/template/footer');
			}
		}
	}

	public function delete($id){

		if($_SESSION['role_id'] != 1 || !isset($_SESSION['role_id']))
			return view('errors/html/error_404');

		$request = $this->requestModel->get(['id' => $id, 'status' => 'p']);
		if(!empty($request)){
			$request_details = $this->requestDetail->get(['request_id' => $id, 'status' => 'a']);
			foreach($request_details as $request_detail){
				$this->requestApproval->softDeleteByRequestDetailId($request_detail['id']);
			}
			$this->requestDetail->sofDeleteByRequestId($id);
			$this->requestModel->delete($id);
		} else {
			die('Insert Deletion Error Here');
		}

		$this->session->setFlashdata('success', 'You have sucessfully deleted ');
		return redirect()->to(base_url('student'));

  }

	public function stub($id){
		$pdf = new Pdf('P', 'mm', 'A4', true, 'UTF-8', false);
    // set document information
    // (di ata kailangan)
    $data['documents'] = $this->document->get();
    $data['request_approvals'] = $this->requestApproval->getDetails(['requests.student_id' => $_SESSION['student_id'], 'requests.id' => $id]);
    $data['requests'] = $this->requestModel->getDetails(['student_id' => $_SESSION['student_id']], $id);
    $data['request_documents'] = $this->requestDetail->getDetails(['requests.student_id' => $_SESSION['student_id'], 'request_details.request_id' => $id]);
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
    $pdf->write1DBarcode($data['requests'][0]['slugs'], 'C39', '', '', '', 18, .4, $style, 'N');
    $pdf->Ln(4);

    // Set some content to print

    // Print text using writeHTMLCell()

    // $pdf->AddPage();
    $pdf->Output('example_001.pdf', 'I');
    die();
	}

	public function history(){
		$data['documents'] = $this->document->get();
		$data['request_details'] = $this->requestDetail->getDetails(['request_details.received_at !=' => null, 'requests.student_id' => $_SESSION['student_id']]);
		echo view('student/template/header');
		echo view('student/request/history', $data);
		return view('student/template/footer');
	}


}
