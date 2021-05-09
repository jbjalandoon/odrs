<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

// User Management Models
use Modules\UserManagement\Models as UserManagement; 

// Module Management Models
use Modules\ModuleManagement\Models as ModuleManagement;

// System Settings Models
use Modules\SystemSettings\Models as SystemSettings;

use App\Models\AdminsModel;
use App\Models\CoursesModel;
use App\Models\DocumentRequirementsModel;
use App\Models\DocumentsModel;
use App\Models\OfficesModel;
use App\Models\RequestApprovalsModel;
use App\Models\RequestDetailsModel;
use App\Models\RequestsModel;
use App\Models\StudentsModel;
/**
 * Class BaseController
 *
 * BaseController provides a convenient place for loading components
 * and performing functions that are needed by all your controllers.
 * Extend this class in any new controllers:
 *     class Home extends BaseController
 *
 * For security be sure to declare any new methods as protected or private.
 */

class BaseController extends Controller
{
	/**
	 * An array of helpers to be loaded automatically upon
	 * class instantiation. These helpers will be available
	 * to all other controllers that extend BaseController.
	 *
	 * @var array
	 */
	protected $helpers = [];

	/**
	 * Constructor.
	 *
	 * @param RequestInterface  $request
	 * @param ResponseInterface $response
	 * @param LoggerInterface   $logger
	 */
	public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
	{
		// Do Not Edit This Line
		parent::initController($request, $response, $logger);
		helper(['buttons']);
		//--------------------------------------------------------------------
		// Preload any models, libraries, etc, here.
		//--------------------------------------------------------------------
		// E.g.: $this->session = \Config\Services::session();

		// User Management Models - UserManagement\Class();

		$this->roleModel = new UserManagement\RolesModel();
		$this->rolePermissionModel = new UserManagement\RolePermissionsModel();
		$this->userModel = new UserManagement\UsersModel();
		$this->adminModel = new UserManagement\AdminsModel();

		// Module Management Models - ModuleManagement\Class();

		$this->moduleModel = new ModuleManagement\ModulesModel();
		$this->permissionModel = new ModuleManagement\PermissionsModel();
		$this->permissionTypeModel = new ModuleManagement\permissionTypesModel();

		// Student Management Models - StudentManagement\Class();
		
		// System Settings Model - SystemSettings\Class();

		$this->courseTypeModel = new SystemSettings\CourseTypesModel();
		$this->courseModel = new SystemSettings\CoursesModel();
		$this->academicStatusModel = new SystemSettings\AcademicStatusModel();
		$this->officeModel = new SystemSettings\OfficesModel();

		$this->documentRequirement = new DocumentRequirementsModel();
		$this->document = new DocumentsModel();
		$this->requestApproval = new RequestApprovalsModel();
		$this->requestDetail = new RequestDetailsModel();
		$this->requestModel = new RequestsModel();
		$this->student = new StudentsModel();

		$this->session = \Config\Services::session();
		$this->validation =  \Config\Services::validation();
		$this->request =  \Config\Services::request();
		$this->email =  \Config\Services::email();
		// $this->pdf = \Config\Services::TCPDF();
		if(isset($_SESSION['role_id'])){
			$this->data['allModules'] = $this->rolePermissionModel->getModules(['role_permissions.role_id' => $_SESSION['role_id']]);
			$this->data['allPermissions'] = $this->rolePermissionModel->getDetails(['role_permissions.role_id' => $_SESSION['role_id']]);
		}
		date_default_timezone_set('asia/manila');
		$this->session->start();

	}

	public function isAjax(){
		if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strcasecmp($_SERVER['HTTP_X_REQUESTED_WITH'], 'xmlhttprequest') == 0){
			return true;
		}
		return false;
	}

	public function redirectRole($slug){
		$permimssions = $this->permission->getDetails(['role_id' => $_SESSION['role_id'], 'slug' => $slug]);
		// die();
		if (count($permimssions) == 0) {
			return false;
		}
		return true;
	}
}
