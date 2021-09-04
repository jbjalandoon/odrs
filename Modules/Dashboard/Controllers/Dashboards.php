<?php namespace Modules\Dashboard\Controllers;

use App\Controllers\BaseController;
use Modules\Dashboard\Models as Dashboard;

class Dashboards extends BaseController {

  function __construct(){
    $this->dashboardsModel = new Dashboard\DashboardsModel();
  }

  public function index(){
    $data['view'] = 'Modules\Dashboard\Views\dashboards\index';
    return view('template/index', $data);
  }

}
