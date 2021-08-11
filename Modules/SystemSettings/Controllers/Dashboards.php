<?php namespace Modules\SystemSettings\Controllers;

use App\Controllers\BaseController;
use Modules\Dashboard\Models as Dashboard;

class Dashboards extends BaseController {


  public function index(){
    $data['request_count'] = count($this->requestModel->get(['status !=' => 'c']));
    $data['detail_count'] = count($this->requestDetailModel->getDetails(['request_details.status' => 'p', 'requests.status' => 'c']));
    $data['claim_count'] = count($this->requestDetailModel->getDetails(['request_details.status' => 'r', 'requests.status' => 'c']));
    $data['completed_count'] = count($this->requestDetailModel->getDetails(['request_details.status' => 'c', 'requests.status' => 'c']));
    $data['view'] = 'Modules\SystemSettings\Views\dashboards\index';
    return view('template/index', $data);
  }

}
