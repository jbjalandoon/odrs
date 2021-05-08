<?php
namespace Modules\StudentManagement\Controllers;

use App\Controllers\BaseController;

class Students extends BaseController
{
    public function index()
    {
        $this->data['viewName'] = 'Modules\StudentManagement\Views\index';
        return view('templates/index', $this->data);
    }
}
