<?php namespace Modules\SystemSettings\Controllers;

use App\Controllers\BaseController;
use Modules\Dashboard\Models as Dashboard;

class Dashboards extends BaseController {


  public function index(){

    $data['view'] = 'Modules\SystemSettings\Views\dashboards\index';
    return view('template/index', $data);
  }

}
