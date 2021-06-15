<?php

namespace App\Controllers\Admin;
use App\Controllers\BaseController;
use App\Libraries\Pdf;

class Request extends BaseController
{


	public function index()
	{
		$data['request_approvals'] = $this->requestApproval->getDetails(['request_details.status' => 'a','request_approvals.status' => 'p',  'requests.status' => 'c']);
    $data['request_details'] = $this->requestDetail->getDetails(['request_details.status' => 'p', 'requests.status' => 'c']);
    $data['request_details_release'] = $this->requestDetail->getDetails(['request_details.status' => 'r',  'requests.status' => 'c']);
    $data['requests'] = $this->requestModel->getDetails(['requests.status' => 'p']);
    $data['request_documents'] = $this->requestDetail->getDetails(['request_details.received_at' => null]);
    $data['offices'] = $this->office->get();
    $data['documents'] = $this->document->get();
		if($this->isAjax()){
			return view('admin/request/index',$data);
		}
		echo view('admin/template/header');
		echo view('admin/request/index',$data);
		return view('admin/template/footer');
	}

	public function confirm(){

			$student = $this->user->get(['username' => $_POST['data'][0][1]]);

			$this->email->setTo($student[0]['email']);
			$this->email->setSubject('Document Request Update');
			$this->email->setFrom('ODRS', 'PUP');
			$this->email->setMessage('Your request has been approved by the admin');
			$this->email->send();
    	$request['status'] = 'c';
    	foreach ($_POST['data'] as $index) {
      $this->requestModel->edit($request, $index[0]);
    }

    return $this->index();
	}

		public function process(){

			$data['request_approvals'] = $this->requestApproval->getDetails(['request_details.status' => 'a','request_approvals.status' => 'p',  'requests.status' => 'c']);
		  $data['request_details'] = $this->requestDetail->getDetails(['request_details.status' => 'p', 'requests.status' => 'c']);
		  $data['request_details_release'] = $this->requestDetail->getDetails(['request_details.status' => 'r',  'requests.status' => 'c']);
		  $data['requests'] = $this->requestModel->getDetails(['requests.status' => 'p']);
		  $data['request_documents'] = $this->requestDetail->getDetails(['request_details.received_at' => null]);
		  $data['offices'] = $this->office->get();
		  $data['documents'] = $this->document->get();
			if($this->isAjax()){
				return view('admin/request/process',$data);
			}
			echo view('admin/template/header');
			echo view('admin/request/process',$data);
			return view('admin/template/footer');
		}

	public function documentProcessed(){

		$request_detail['status'] = 'r';
		$request_detail['printed_at'] = date('Y-m-d h:i:s');
    foreach ($_POST['data'] as $index) {
      $this->requestDetail->edit($request_detail, $index[0]);
			$student = $this->user->get(['username' => $index[2]]);

			$this->email->setTo($student[0]['email']);
			$this->email->setSubject('Document Request Update');
			$this->email->setFrom('ODRS', 'PUP');
			$this->email->setMessage('Your ' . $index[5] . ' is ready to claim!');
			$this->email->send();
    }
		return $this->process();
	}

	public function processed(){

		$data['request_approvals'] = $this->requestApproval->getDetails(['request_details.status' => 'a','request_approvals.status' => 'p',  'requests.status' => 'c']);
		$data['request_details'] = $this->requestDetail->getDetails(['request_details.status' => 'p', 'requests.status' => 'c']);
		$data['request_details_release'] = $this->requestDetail->getDetails(['request_details.status' => 'r',  'requests.status' => 'c']);
		$data['requests'] = $this->requestModel->getDetails(['requests.status' => 'p']);
		$data['request_documents'] = $this->requestDetail->getDetails(['request_details.received_at' => null]);
		$data['offices'] = $this->office->get();
		$data['documents'] = $this->document->get();
		if($this->isAjax()){
			return view('admin/request/processed',$data);
		}
		echo view('admin/template/header');
		echo view('admin/request/processed',$data);
		return view('admin/template/footer');
	}

	public function scan(){

		$id = $this->requestModel->getBySlugs($_POST['slugs'])[0]['id'];
    if (!empty($this->requestModel->getDetails(['requests.id' => $id]))) {
			$request_details = $this->requestDetail->get(['request_id' => $id, 'status' => 'r']);
      if (!empty($request_details)) {
        foreach ($request_details as $request_detail) {
          $data['status'] = 'c';
          $data['received_at'] = date('Y-m-d h:i:s');
          $this->requestDetail->edit($data, $request_detail['id']);
        }
        if (count($this->requestDetail->get(['request_id' => $id])) == count($this->requestDetail->get(['request_id' => $id, 'status' => 'c']))) {
          $this->requestModel->edit(['completed_at' => date('Y-m-d h:i:s')], $id);

        }
        $this->session->setFlashdata('success_message', $this->requestDetail->getDetails(['request_id' => $id]));
      } else {
        $this->session->setFlashdata('error_message', 'There is no ready to claim document in this request');
      }
    } else {
      $this->session->setFlashdata('error_message', 'Invalid Input');
    }
    return redirect()->to(base_url().'/admin/processed-requests');
  }

	public function claimed(){

			$data['documents'] = $this->document->get();
			if($this->isAjax()){
				if(empty($_GET)){
					$data['request_details'] = $this->requestDetail->getDetails(['request_details.received_at !=' => null]);
				} else {
					if($_GET['id'] == 0) {
						$data['request_details'] = $this->requestDetail->getDetails(['request_details.received_at !=' => null]);
					} else {
						$data['request_details'] = $this->requestDetail->getDetails(['request_details.received_at !=' => null, 'request_details.document_id' => $_GET['id']]);
					}
				}
				return view('admin/request/claimed', $data);
			}
			$data['request_details'] = $this->requestDetail->getDetails(['request_details.received_at !=' => null]);
			echo view('admin/template/header');
			echo view('admin/request/claimed', $data);
			return view('admin/template/footer');
	}

	public function approval(){
		$data['request_approvals'] = $this->requestApproval->getDetails(['request_approvals.status' => 'p']);
		$data['documents'] = $this->document->get();
		if($this->isAjax()){
			return view('admin/request/approval',$data);
		}
		echo view('admin/template/header');
		echo view('admin/request/approval', $data);
		return view('admin/template/footer');
	}

	public function approve(){
		$request_approval['status'] = 'a';
		foreach ($_POST['data'] as $index) {
			$this->requestApproval->edit($request_approval, $index[0]);
			$remaining_approval = count($this->requestApproval->getDetails(['request_approvals.status' => 'p', ['request_detail_id' => $index[1]]]));
			if ($remaining_approval == 0) {
				$request_detail['status'] = 'p';
				$this->requestDetail->edit($request_detail, $index[1]);
			}
		}
		return $this->approval();
	}

	public function report(){
		// create new PDF document
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
		$data['documents'] = $this->requestDetail->getReports($_GET['t'], $_GET['a']);
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
