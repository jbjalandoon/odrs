<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

use App\Models\AdminsModel;
use App\Models\CoursesModel;
use App\Models\DocumentRequirementsModel;
use App\Models\DocumentsModel;
use App\Models\OfficesModel;
use App\Models\RequestApprovalsModel;
use App\Models\RequestDetailsModel;
use App\Models\PermissionsModel;
use App\Models\ModulesModel;
use App\Models\RequestsModel;
use App\Models\RolesModel;
use App\Models\StudentsModel;
use App\Models\UsersModel;
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
	protected $helpers = ['text'];

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

		//--------------------------------------------------------------------
		// Preload any models, libraries, etc, here.
		//--------------------------------------------------------------------
		// E.g.: $this->session = \Config\Services::session();
		$this->admin = new AdminsModel();
		$this->course = new CoursesModel();
		$this->documentRequirement = new DocumentRequirementsModel();
		$this->document = new DocumentsModel();
		$this->office = new OfficesModel();
		$this->requestApproval = new RequestApprovalsModel();
		$this->requestDetail = new RequestDetailsModel();
		$this->requestModel = new RequestsModel();
		$this->role = new RolesModel();
		$this->student = new StudentsModel();
		$this->user = new UsersModel();
		$this->module = new ModulesModel();
		$this->permission = new PermissionsModel();
		$this->session = \Config\Services::session();
		$this->validation =  \Config\Services::validation();
		$this->request =  \Config\Services::request();
		$this->email =  \Config\Services::email();
		// $this->pdf = \Config\Services::TCPDF();
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
