<?php
namespace Modules\StudentManagement\Controllers;

use App\Controllers\BaseController;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
class Students extends BaseController
{
    public function index()
    {
        $this->data['view'] = 'Modules\StudentManagement\Views\students\index';
        return view('template/index', $this->data);
    }

    public function add()
    {
        $this->data['edit'] = false;
        $this->data['view'] = 'Modules\StudentManagement\Views\students\form';
        return view('template/index', $this->data);
    }
}
