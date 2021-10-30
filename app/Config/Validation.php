<?php

namespace Config;

use CodeIgniter\Validation\CreditCardRules;
use CodeIgniter\Validation\FileRules;
use CodeIgniter\Validation\FormatRules;
use CodeIgniter\Validation\Rules;

class Validation
{
	//--------------------------------------------------------------------
	// Setup
	//--------------------------------------------------------------------

	/**
	 * Stores the classes that contain the
	 * rules that are available.
	 *
	 * @var string[]
	 */
	public $ruleSets = [
		Rules::class,
		FormatRules::class,
		FileRules::class,
		CreditCardRules::class,
	];

	/**
	 * Specifies the views that are used to display the
	 * errors.
	 *
	 * @var array<string, string>
	 */
	public $templates = [
		'list'   => 'CodeIgniter\Validation\Views\list',
		'single' => 'CodeIgniter\Validation\Views\single',
	];

	//--------------------------------------------------------------------
	// Rules
	//--------------------------------------------------------------------

	public $receipt = [
		'file' => 'uploaded[file]|ext_in[file,png,jpg,jpeg]|is_image[file]',
		'receipt_number' => 'required'
	];

	public $password = [
		'old_password' => 'required',
		'new_password' => 'required',
		'repeat_password' => [
			'rules' => 'required|matches[password]',
			'errors' => [
				'matches' => 'Passwords Not Match'
			],
		],

	];

	public $user_own = [
		'email' => [
			'rules' => 'required|valid_email',
			'label' => 'Email',
			'errors' => [
				'required' => 'Please enter email',
				'valid_email' => 'Please enter a valid email',
			]
		],
		'contact' => [
			'rules' => 'required|numeric|exact_length[11]',
			'label' => 'Contact',
			'errors' => [
				'required' => 'Please enter contact',
				'numeric' => 'Please enter numeric only',
				'exact_length' => 'Enter 11 digits number'
			]
		],
		'firstname' => [
			'rules' => 'alpha_space|required',
			'label' => 'First Name',
			'errors' => [
				'alpha_dash' => 'Enter valid characters',
				'required' => 'Please enter first name'
			]
		],
		'lastname' => [
			'rules' => 'alpha_space|required',
			'label' => 'Last Name',
			'errors' => [
				'alpha_dash' => 'Enter valid characters',
				'required' => 'Please enter first name'
			]
		],
		'course_id' => [
			'rules' => 'required',
			'label' => 'Course',
			'errors' => [
				'required' => 'Enter Course'
			]
		],
		'birthdatesqweqw' => [
			'rules' => 'valid_date',
			'label' => 'Birthdate',
			'errors' => [
				'required' => 'Enter Birthdate'
			]
		],
	];

	public $student = [
		// 'student_number' => [
		// 	'rules'=> 'required|exact_length[15]|alpha_dash|regex_match[/[0-9]{4}-[0-9]{5}-TG-0/]|is_unique[users.username]',
		// 	'label' => 'Student Number',
		// 	'errors' => [
		// 		'required' => 'Please enter student number',
		// 		'exact_length' => 'Please enter a valid length (15)',
		// 		'alpha_dash' => 'Special characters are not allowed',
		// 		'regex_match' => 'PLease enter a valid student number',
		// 		'is_unique' => 'This student number is already registered'
		// 	]
		// ],
		'email' => [
			'rules' => 'required|valid_email|is_unique[users.email]',
			'label' => 'Email',
			'errors' => [
				'required' => 'Please enter email',
				'valid_email' => 'Please enter a valid email',
				'is_unique' => 'Email is already in used'
			]
		],
		'firstname' => [
			'rules' => 'alpha_space|required',
			'label' => 'First Name',
			'errors' => [
				'alpha_dash' => 'Enter valid characters',
				'required' => 'Please enter first name'
			]
		],
		'lastname' => [
			'rules' => 'alpha_space|required',
			'label' => 'Last Name',
			'errors' => [
				'alpha_dash' => 'Enter valid characters',
				'required' => 'Please enter first name'
			]
		],
	'birthdate' => [
		'rules' => 'required',
		'label' => 'Birthdate',
		'errors' => [
			'alpha_dash' => 'Enter valid characters',
		]
	],
];

	public $user = [
		'firstname' => [
			'rules' => 'required|alpha',
			'errors' => [
				'required' => 'This field is required',
				'alpha' => 'Invalid first name'
			]
		],
		'lastname' => [
			'rules' => 'required|alpha',
			'errors' => [
				'required' => 'This field is required',
				'alpha' => 'Invalid last name'
			]
		],
		'email' => [
			'rules' => 'required|valid_email',
			'errors' => [
				'required' => 'This field is required',
				'valid_email' => 'Email is invalid'
			]
		],
		'contact' => [
			'rules' => 'required|numeric',
			'errors' => [
				'required' => 'This field is required',
				'valid_email' => 'Email is invalid'
			]
		],
		'username' => [
			'rules' => 'required',
			'errors' => [
				'required' => 'This field is required',
			]
		],
		'password' => [
			'rules' => 'required',
			'errors' => [
				'required' => 'This field is required'
			]
		],
		'confirm_password' => [
			'rules' => 'required|matches[password]',
			'errors' => [
				'required' => 'This field is required',
				'matches' => 'Password not match'
			]
		]
	];

	public $user_edit = [
		'firstname' => [
			'rules' => 'required|alpha',
			'errors' => [
				'required' => 'This field is required',
				'alpha' => 'Invalid first name'
			]
		],
		'lastname' => [
			'rules' => 'required|alpha',
			'errors' => [
				'required' => 'This field is required',
				'alpha' => 'Invalid last name'
			]
		],
		'email' => [
			'rules' => 'required|valid_email',
			'errors' => [
				'required' => 'This field is required',
				'valid_email' => 'Email is invalid'
			]
		],
		'contact' => [
			'rules' => 'required|numeric',
			'errors' => [
				'required' => 'This field is required',
				'valid_email' => 'Email is invalid'
			]
		],
		'username' => [
			'rules' => 'required',
			'errors' => [
				'required' => 'This field is required',
			]
		],
		'confirm_password' => [
			'rules' => 'matches[password]',
			'errors' => [
				'required' => 'This field is required',
				'matches' => 'Password not match'
			]
		]
	];

	public $request = [
		'document_id' => [
			'rules' => 'required',
			'errors' => [
				'required' => 'Please pick a document'
			]
		],
		'quantity.*' => [
			'rules' => 'greater_than[0]',
			'errors' => [
				'greater_than' => 'Please input a valid Quantity'
			]
		],
	];

	public $report = [
		'a' => [
			'rules' => 'required',
			'errors' => [
				'required' => 'Enter #'
			]
		]
	];

	public $register = [
		'username' => [
			'rules'=> 'required|exact_length[15]|alpha_dash|regex_match[/[0-9]{4}-[0-9]{5}-TG-0/]|is_unique[users.username]',
			'label' => 'Student Number',
			'errors' => [
				'required' => 'Please enter student number',
				'exact_length' => 'Please enter a valid length (15)',
				'alpha_dash' => 'Special characters are not allowed',
				'regex_match' => 'PLease enter a valid student number',
				'is_unique' => 'This student number is already registered'
			]
		],
		'email' => [
			'rules' => 'required|valid_email|is_unique[users.email]',
			'label' => 'Email',
			'errors' => [
				'required' => 'Please enter email',
				'valid_email' => 'Please enter a valid email',
				'is_unique' => 'Email is already in used'
			]
		],
		'password' => [
			'rules' => 'required|alpha_numeric_punct|min_length[10]|max_length[20]',
			'label' => 'Password',
			'errors' => [
				'required' => 'Please enter password',
				'min_length' => 'Minimum of 10 characters',
				'max_length' => 'Maximum of 20 characters'
			]
		],
		'repeat_password' => [
			'rules' => 'required|matches[password]',
			'label' => 'Confirm Password',
			'errors' => [
				'required' => 'Please enter confirm password',
				'matches' => 'Password don\'t match'
			]
		],
		'contact' => [
			'rules' => 'required|numeric|exact_length[11]',
			'label' => 'Contact',
			'errors' => [
				'required' => 'Please enter contact',
				'numeric' => 'Please enter numeric only',
				'exact_length' => 'Enter 11 digits number'
			]
		],
		'firstname' => [
			'rules' => 'alpha_space|required',
			'label' => 'First Name',
			'errors' => [
				'alpha_dash' => 'Enter valid characters',
				'required' => 'Please enter first name'
			]
		],
		'lastname' => [
			'rules' => 'alpha_space|required',
			'label' => 'Last Name',
			'errors' => [
				'alpha_dash' => 'Enter valid characters',
				'required' => 'Please enter first name'
			]
		],
		'middlename' => [
			'rules' => 'alpha_space',
			'label' => 'Middle Name',
			'errors' => [
				'alpha_dash' => 'Enter valid characters',
			]
		],
		'course_id' => [
			'rules' => 'required',
			'label' => 'Course',
			'errors' => [
				'required' => 'Enter Course'
			]
		],
		'birthdate' => [
			'rules' => 'required|valid_date',
			'label' => 'Birthdate',
			'errors' => [
				'required' => 'Enter birthdate',
				'valid_date' => 'Enter valid date'
			]
		]
	];

	public $login = [
		'username' => [
			'rules' => 'required|max_length[35]',
			'label' => 'Username',
			'errors' => [
				'required' => 'Please enter username',
			]
		],
		'password' => [
			'rules' => 'required|alpha_numeric_punct',
			'label' => 'Password',
			'errors' => [
				'required' => 'Please enter password',
			]
		]
	];

	public $module = [
		'module' => [
			'rules' => 'required|alpha_space',
			'label' => 'Module Name',
			'errors' => [
				'required' => 'Please enter Module Name',
			]
		],
		'slug' => [
			'rules' => 'required|alpha_dash',
			'label' => 'Module Slug',
			'errors' => [
				'required' => 'Please enter Module Slug'
			]
		]
	];

	public $role = [
		'role' => [
			'rules' => 'required|alpha_space',
			'label' => 'Role',
			'errors' => [
				'required' => 'Please enter Roles'
			]
		],
		'description' => [
			'rules' => 'required',
			'label' => 'Role Description'
		]
	];

	public $permissionType = [
		'type' => [
			'rules' => 'required',
			'label' => 'Permission Type'
		],
		'slug' => [
			'rules' => 'required',
			'label' => 'Slug'
		]
	];

	public $permission =[
		'permission' => [
			'rules' => 'required',
			'label' => 'Permission'
		],
		'slug' => [
			'rules' => 'required',
			'label' => 'Slug'
		],
		'description' => [
			'rules' => 'required',
			'label' => 'Description'
		],
		'permission_type' => [
			'rules' => 'required',
			'label' => 'Permission Type'
		],
		'module_id' => [
			'rules' => 'required',
			'label' => 'Module'
		]
	];

	public $courseType = [
		'type' => 'required'
	];

	public $course = [
		'course' => 'required',
		'abbreviation' => 'required',
		'course_type' => 'required'
	];

	public $academicStatus = [
		'status' => 'required'
	];

	public $form = [
		'school' => [
			'rules' => 'required',
			'label' => 'School'
		],
		'address' => [
			'rules' => 'required',
			'label' => 'School Address',
		],
		'sy_admission' => [
			'rules' => 'required',
			'label' => 'SY - Admission is required',
		]
	];

	public $office = [
		'office' => 'required'
	];

	public $note = [
		'note' => 'required',
	];

	public $document = [
		'document' => 'required',
		'price' => 'required'
	];

	public $student_spreadsheet = [
		'students' => 'uploaded[students]|ext_in[students,xlsx]'
	];

}
