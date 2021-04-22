<?php

namespace App\Controllers\Office;
use App\Controllers\BaseController;

class Request extends BaseController
{

	public function index()
	{

		if($_SESSION['role_id'] != 3 || !isset($_SESSION['role_id']))
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

		if($_SESSION['role_id'] != 3 || !isset($_SESSION['role_id']))
			return view('errors/html/error_404');

		$data['documents'] = $this->document->get();
		if ($this->request->getMethod() == 'get') {
			echo view('student/template/header');
			echo view('student/request/form', $data);
			return view('student/template/footer');
		} else {
			if ($this->validate('request')) {
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
			} else {
				$data['error'] = $this->validation->getErrors();
				echo view('student/template/header');
				echo view('student/request/form', $data);
				return view('student/template/footer');
			}
		}
	}

	public function delete($id){

		if($_SESSION['role_id'] != 3 || !isset($_SESSION['role_id']))
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


}
