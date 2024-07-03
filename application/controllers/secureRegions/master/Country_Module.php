<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once(APPPATH."controllers/secureRegions/Main.php");
class Country_Module extends Main
{
	function __construct()
	{
        parent::__construct();
		$this->load->database();
		$this->load->library('session');
		$this->load->model('Common_Model');
		$this->load->model('administrator/Admin_Common_Model');
		$this->load->model('administrator/Admin_model');
		$this->load->model('administrator/master/Country_Model');
		$this->load->library('pagination');

		$this->load->library('User_auth');

		$session_uid = $this->data['session_uid']=$this->session->userdata('session_uid');
		$this->data['session_uname']=$this->session->userdata('session_uname');
		$this->data['session_uemail']=$this->session->userdata('session_uemail');
		$this->data['page_module_name']='Country';
		$this->data['table_name']= 'country';
		$this->data['page_module_id'] = 2;
		$this->load->helper('url');

		$this->data['User_auth_obj'] = new User_auth();
		//$this->data['user_data'] = $this->data['User_auth_obj']->check_user_status();

		$this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate, no-transform, max-age=0, post-check=0, pre-check=0");
		$this->output->set_header("Pragma: no-cache");

    }

	function unset_only()
	{
		$user_data = $this->session->all_userdata();
		foreach ($user_data as $key => $value) {
			if ($key != 'session_id' && $key != 'ip_address' && $key != 'user_agent' && $key != 'last_activity') {
				$this->session->unset_userdata($key);
			}
		}
	}

	function index()
	{
		parent::get_header();
		parent::get_left_nav();
		$this->load->view('admin/master/Country_Module/list' , $this->data);
		parent::get_footer();
	}

	function listing()
	{
		$this->data['page_type'] = "list";

		$this->data['user_access'] = $this->data['User_auth_obj']->check_user_access(array("module_id"=>$this->data['page_module_id']));
		//print_r($this->data['user_access']);
		if(empty($this->data['user_access']))
		{
			REDIRECT(MAINSITE_Admin."wam/access-denied");
		}
		$search = array();
		$field_name = 'urm.name';
		$field_value = '';


		if(!empty($_REQUEST['field_name']))
			$field_name = $_POST['field_name'];
		else if(!empty($field_name))
			$field_name = $field_name;

		if(!empty($_REQUEST['field_value']))
			$field_value = $_POST['field_value'];
		else if(!empty($field_value))
			$field_value = $field_value;




		$this->data['field_name'] = $field_name;
		$this->data['field_value'] = $field_value;


		$search['field_value'] = $field_value;
		$search['field_name'] = $field_name;

		$search['search_for'] = "count";

		$data_count = $this->Country_Model->getData($search);
		$r_count = $this->data['row_count'] = $data_count[0]->counts;

		unset($search['search_for']);

		$offset = (int)$this->uri->segment(5); //echo $offset;
		if($offset == "")
		{
			$offset ='0' ;
		}
		$per_page = _all_pagination_;

		$this->load->library('pagination');
		//$config['base_url'] =MAINSITE.'secure_region/reports/DispatchedOrders/'.$module_id.'/';
		$this->load->library('pagination');
		$config['base_url'] =MAINSITE_Admin.$this->data['user_access']->class_name.'/'.$this->data['user_access']->function_name.'/';
		$config['total_rows'] = $r_count;
		$config['uri_segment'] = '5';
		$config['per_page'] = $per_page;
		$config['num_links'] = 4;
		$config['first_link'] = '&lsaquo; First';
		$config['last_link'] = 'Last &rsaquo;';
		$config['prev_link'] = 'Prev';
		$config['full_tag_open'] = '<p>';
		$config['full_tag_close'] = '</p>';
		$config['attributes'] = array('class' => 'paginationClass');


		$this->pagination->initialize($config);

		$this->data['page_is_master'] = $this->data['user_access']->is_master;
		$this->data['page_parent_module_id'] = $this->data['user_access']->parent_module_id;

		//$search['limit'] = $per_page;
		$search['offset'] = $offset;
		$this->data['list_data'] = $this->Country_Model->getData($search);
		// echo $this->db->last_query();
		// die();
		parent::get_header();
		parent::get_left_nav();
		$this->load->view('admin/master/Country_Module/listing' , $this->data);
		parent::get_footer();
	}

	function export()
	{
		$this->load->library('PHPExcel');
		$this->load->library('PHPExcel/IOFactory');
		$this->data['page_type'] = "list";

		$this->data['user_access'] = $this->data['User_auth_obj']->check_user_access(array("module_id"=>$this->data['page_module_id']));

		if(empty($this->data['user_access']))
		{
			REDIRECT(MAINSITE_Admin."wam/access-denied");
		}

		if($this->data['user_access']->export_data!=1)
		{
			$this->session->set_flashdata('no_access_flash_message' , "You Are Not Allowed To Export ".$user_access->module_name);
			REDIRECT(MAINSITE_Admin."wam/access-denied");
		}
		$search = array();
		$field_name = 'urm.name';
		$field_value = '';


		if(!empty($_REQUEST['field_name']))
			$field_name = $_POST['field_name'];
		else if(!empty($field_name))
			$field_name = $field_name;

		if(!empty($_REQUEST['field_value']))
			$field_value = $_POST['field_value'];
		else if(!empty($field_value))
			$field_value = $field_value;




		$this->data['field_name'] = $field_name;
		$this->data['field_value'] = $field_value;


		$search['field_value'] = $field_value;
		$search['field_name'] = $field_name;


		$this->data['list_data'] = $this->Country_Model->getData($search);
		$this->data['Module_name'] = $this->data['page_module_name'];


		$this->load->view('admin/master/Country_Module/export' , $this->data);
	}
	function pdf()
	{
		$this->load->library('pdf');
		$this->data['page_type'] = "list";

		$this->data['user_access'] = $this->data['User_auth_obj']->check_user_access(array("module_id"=>$this->data['page_module_id']));

		if(empty($this->data['user_access']))
		{
			REDIRECT(MAINSITE_Admin."wam/access-denied");
		}

		if($this->data['user_access']->export_data!=1)
		{
			$this->session->set_flashdata('no_access_flash_message' , "You Are Not Allowed To Export ".$user_access->module_name);
			REDIRECT(MAINSITE_Admin."wam/access-denied");
		}
		$search = array();
		$field_name = '';
		$field_value = '';
		$end_date = '';
		$start_date = '';
		$record_status="";

		if(!empty($_REQUEST['field_name']))
			$field_name = $_POST['field_name'];
		else if(!empty($field_name))
			$field_name = $field_name;

		if(!empty($_REQUEST['field_value']))
			$field_value = $_POST['field_value'];
		else if(!empty($field_value))
			$field_value = $field_value;

		if(!empty($_POST['end_date']))
			$end_date = $_POST['end_date'];

			if(!empty($_POST['start_date']))
			$start_date = $_POST['start_date'];

		if(!empty($_POST['record_status']))
			$record_status = $_POST['record_status'];


		$this->data['field_name'] = $field_name;
		$this->data['field_value'] = $field_value;
		$this->data['end_date'] = $end_date;
		$this->data['start_date'] = $start_date;
		$this->data['record_status'] = $record_status;

		$search['end_date'] = $end_date;
		$search['start_date'] = $start_date;
		$search['field_value'] = $field_value;
		$search['field_name'] = $field_name;
		$search['record_status'] = $record_status;

		$this->data['list_data'] = $this->Country_Model->getData($search);

		$this->data['Module_name'] = 'Country';

		$date = date('Y-m-d H:i:s');
		$html = $this->load->view('admin/master/Country_Module/pdf' , $this->data,true);
		// echo $html;
		// exit;
		//$html = $this->load->view('admin/reports/Project_Reports_Module/project_reports_list_pdf' , $this->data, true);
		$this->pdf->createPDF($html, $this->data['Module_name']."-".$date, false);
		exit;
	}

	function view($id="")
	{
		$this->data['page_type'] = "list";

		$this->data['user_access'] = $this->data['User_auth_obj']->check_user_access(array("module_id"=>$this->data['page_module_id']));
		//print_r($this->data['user_access']);
		if(empty($id))
		{
			$alert_message = ' Something Went Wrong. Please Try Again.';
			$this->session->set_flashdata('alert_message', $alert_message);
			REDIRECT(MAINSITE_Admin.$user_access->class_name."/".$user_access->function_name);
			exit;
		}
		if(empty($this->data['user_access']))
		{
			REDIRECT(MAINSITE_Admin."wam/access-denied");
		}
		$this->data['page_is_master'] = $this->data['user_access']->is_master;
		$this->data['page_parent_module_id'] = $this->data['user_access']->parent_module_id;
		$this->data['list_data'] = $this->Country_Model->getData(array("id"=>$id));
		if(empty($id))
		{
			$alert_message = ' Something Went Wrong. Please Try Again.';
			$this->session->set_flashdata('alert_message', $alert_message);
			REDIRECT(MAINSITE_Admin.$user_access->class_name."/".$user_access->function_name);
			exit;
		}

		$this->data['list_data'] = $this->data['list_data'][0];

		parent::get_header();
		parent::get_left_nav();
		$this->load->view('admin/master/Country_Module/view' , $this->data);
		parent::get_footer();
	}

	function edit($id="")
	{
		$this->data['page_type'] = "list";

		$user_access = $this->data['user_access'] = $this->data['User_auth_obj']->check_user_access(array("module_id"=>$this->data['page_module_id']));
		//print_r($this->data['user_access']);
		if(empty($this->data['user_access']))
		{
			REDIRECT(MAINSITE_Admin."wam/access-denied");
		}
		if(empty($id))
		{
			$this->data['page_type_action'] = "Add";

			if($user_access->add_module!=1)
			{
				$this->session->set_flashdata('no_access_flash_message' , "You Are Not Allowed To Add ".$user_access->module_name);
				REDIRECT(MAINSITE_Admin."wam/access-denied");
			}
		}
		if(!empty($id))
		{
			$this->data['page_type_action'] = "Edit";

			if($user_access->update_module!=1)
			{
				$this->session->set_flashdata('no_access_flash_message' , "You Are Not Allowed To Update ".$user_access->module_name);
				REDIRECT(MAINSITE_Admin."wam/access-denied");
			}
		}

		$this->data['page_is_master'] = $this->data['user_access']->is_master;
		$this->data['page_parent_module_id'] = $this->data['user_access']->parent_module_id;
		if(!empty($id)){
			$this->data['list_data'] = $this->Country_Model->getData(array("id"=>$id));
			if(empty($this->data['list_data']))
			{
				$this->session->set_flashdata('alert_message', '<div class="alert alert-danger alert-dismissible">
					<button type="button" class="btn close" data-bs-dismiss="alert" aria-hidden="true">×</button>
					<i class="icon fa fa-ban"></i> Record Not Found.
				  </div>');
				REDIRECT(MAINSITE_Admin.$user_access->class_name.'/'.$user_access->function_name);
			}
			$this->data['list_data'] = $this->data['list_data'][0];
		}
		 $module_html = $this->load->view('admin/master/Country_Module/edit' , $this->data,true);
		echo json_encode(array('module_data'=>$module_html));
		exit;
	}

	function doEdit()
	{
		$this->data['page_type'] = "list";

		$user_access = $this->data['user_access'] = $this->data['User_auth_obj']->check_user_access(array("module_id"=>$this->data['page_module_id']));

		// if(empty($_POST['name']) || empty($_POST['country_short_name']) )
		// {
		// 	$alert_message = ' Something Went Wrong. Please Try Again.';
		// 	$this->session->set_flashdata('alert_message', $alert_message);
		// 	REDIRECT(MAINSITE_Admin.$user_access->class_name."/".$user_access->function_name);
		// 	exit;
		// }
		$id = $_POST['id'];
		//print_r($_POST);
		if(empty($this->data['user_access']))
		{
			REDIRECT(MAINSITE_Admin."wam/access-denied");
		}
		if(empty($id))
		{
				$this->data['page_type_action'] = "Add";
			if($user_access->add_module!=1)
			{
				$this->session->set_flashdata('no_access_flash_message' , "You Are Not Allowed To Add ".$user_access->module_name);
				REDIRECT(MAINSITE_Admin."wam/access-denied");
			}
		}else{
				$this->data['page_type_action'] = "Edit";
		}
		if(!empty($id))
		{
			if($user_access->update_module!=1)
			{
				$this->session->set_flashdata('no_access_flash_message' , "You Are Not Allowed To Update ".$user_access->module_name);
				REDIRECT(MAINSITE_Admin."wam/access-denied");
			}
		}

			$this->form_validation->set_rules('code', 'Country Code', 'numeric|trim|required|min_length[1]|max_length[3]');
			$this->form_validation->set_rules('name', 'Name', 'callback_alpha_dash_space|required');
			$this->form_validation->set_rules('country_short_name', 'Short Name', 'alpha|required');
			//$this->form_validation->set_rules('status', 'Status', 'numeric|trim|required|min_length[1]|max_length[1]');
			$this->form_validation->set_error_delimiters('<div class="error alert alert-danger">', '<a href="#" class="btn close" data-bs-dismiss="alert" aria-label="close" title="Close">&times;</a></div>');
			if ($this->form_validation->run() == true)
			{
				$this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
				$name = trim($_POST['name']);
				$country_short_name = trim($_POST['country_short_name']);
				$country_code = trim($_POST['code']);
				if(isset($_POST['status'])){
					$status = $_POST['status'];

				}
				$is_exist = $this->Common_Model->getData(array('select'=>'*' , 'from'=>$this->data['table_name'] , 'where'=>"name = '$name' and id != $id and is_deleted != 1"));
			//	echo $this->db->last_query();
			//	print_r($is_exist);
				if(!empty($is_exist))
				{
					$alert_message = $this->data['page_module_name']." already exist in database";
					$this->session->set_flashdata('alert_message', $alert_message);
					//echo $this->session->flashdata('alert_message' );
					//echo "";
					echo json_encode(array("status"=>0, "return_code"=>"3", "message"=>$alert_message, ));
					exit;
				}

				$enter_data['name'] = $name;
				$enter_data['country_short_name'] = $country_short_name;
				$enter_data['code'] = $country_code;
				if(isset($_POST['status'])){
					$enter_data['status'] = $_POST['status'];
				}else{
					$enter_data['status'] = 0;
				}

				$alert_message = ' Something Went Wrong Please Try Again.';
				if(!empty($id))
				{


					$enter_data['updated_on'] = date("Y-m-d H:i:s");
					$enter_data['updated_by'] = $this->data['session_uid'];
					$insertStatus = $this->Common_Model->update_operation(array('table'=>$this->data['table_name'], 'data'=>$enter_data, 'condition'=>"id = $id"));
					if(!empty($insertStatus))
					{
						$alert_message = ' Record Updated Successfully';
					}

				}
				else
				{


					$enter_data['added_on'] = date("Y-m-d H:i:s");
					$enter_data['added_by'] = $this->data['session_uid'];
					$insertStatus = $this->Common_Model->add_operation(array('table'=>$this->data['table_name'] , 'data'=>$enter_data));
					if(!empty($insertStatus))
					{
						$alert_message = ' New Record Added Successfully';
					}


				}
				echo json_encode(array("status"=>1, "return_code"=>"1", "message"=>$alert_message));
				exit;

			}else{
				$this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
				$html = $this->load->view("admin/master/Country_Module/edit",$this->data, true);
				echo json_encode(array("status"=>0, "return_code"=>"2", "message"=>'Something wrong please try again', "html"=>$html));
				exit;
			}



	}
	function alpha_dash_space($fullname){
    if (! preg_match('/^[a-zA-Z\s]+$/', $fullname)) {
        $this->form_validation->set_message('alpha_dash_space', 'The %s field may only contain alpha characters & White spaces');
        return FALSE;
    } else {
        return TRUE;
    }
}
	function doUpdateStatus()
	{
		$this->data['page_type'] = "list";

		$user_access = $this->data['user_access'] = $this->data['User_auth_obj']->check_user_access(array("module_id"=>$this->data['page_module_id']));
		//print_r($this->data['user_access']);
		$task = $_POST['task'];
		$id_arr = $_POST['sel_recds'];

		if(empty($user_access))
		{
			REDIRECT(MAINSITE_Admin."wam/access-denied");
		}
		if($user_access->update_module==1)
		{
			$this->session->set_flashdata('alert_message', '<div class="alert alert-danger alert-dismissible">
					<button type="button" class="btn close" data-bs-dismiss="alert" aria-hidden="true">×</button>
					<i class="icon fa fa-ban"></i> Something Went Wrong Please Try Again.
				  </div>');
			$update_data = array();
			if(!empty($id_arr) )
			{


				$action_taken = "";
				$ids = implode(',' , $id_arr);
				if($task=="active")
				{
					$update_data['status'] = 1;
					$action_taken = "Activate";
				}
				if($task=="block")
				{
					$update_data['status'] = 0;
					$action_taken = "Blocked";
				}
				if($task=="export")
				{
					$this->load->library('PHPExcel');
					$this->load->library('PHPExcel/IOFactory');
				//	$this->data['list_data'] = $this->Common_Model->getData(array('select'=>'*' , 'from'=>$this->data['table_name'] , 'where'=>"id in ($ids)"));
					$this->data['list_data'] = $this->Common_Model->export(array('table'=>$this->data['table_name']));
					$this->data['Module_name'] = 'Country';
					$this->load->view('admin/master/Country_Module/export' , $this->data);
				  $action_taken = "Exported";
				}
				if($task=="pdf")
				{
					$this->load->library('pdf');
				//	$this->data['list_data'] = $this->Common_Model->getData(array('select'=>'*' , 'from'=>$this->data['table_name'] , 'where'=>"id in ($ids)"));
					$this->data['list_data'] = $this->Common_Model->export(array('id'=>$id_arr,'table'=>$this->data['table_name']));
					$this->data['Module_name'] = 'Country';
					$html = $this->load->view('admin/master/Country_Module/pdf' , $this->data,true);
				  $action_taken = "Exported";
						$date = date('Y-m-d H:i:s');
					$this->pdf->createPDF($html, $this->data['Module_name']."-".$date, false);
					exit;
				}
				if($task=="delete")
				{
					$update_data['is_deleted'] = 1;
					$action_taken = "Deleted";
					$update_data['is_deleted_on'] = date("Y-m-d H:i:s");
					$update_data['is_deleted_by'] = $this->data['session_uid'];
				}
				$update_data['updated_on'] = date("Y-m-d H:i:s");
				$update_data['updated_by'] = $this->data['session_uid'];
				$response = $this->Common_Model->update_operation(array('table'=>$this->data['table_name'] , 'data'=>$update_data , 'condition'=>"id in ($ids)" ));
				if($response){
					$this->session->set_flashdata('alert_message', '<div class="alert alert-success alert-dismissible">
						<button type="button" class="btn close" data-bs-dismiss="alert" aria-hidden="true">×</button>
						<i class="icon fa fa-check"></i> Records Successfully '.$action_taken.'
						</div>');
				}
			}
			REDIRECT(MAINSITE_Admin.$user_access->class_name.'/'.$user_access->function_name);
		}
		else
		{
			$this->session->set_flashdata('no_access_flash_message' , "You Are Not Allowed To Update ".$user_access->module_name);
			REDIRECT(MAINSITE_Admin."wam/access-denied");
		}
	}




	function logout()
	{
		$this->unset_only();
		$this->session->set_flashdata('alert_message', '<div class="alert alert-success alert-dismissible">
		<button type="button" class="btn close" data-bs-dismiss="alert" aria-hidden="true">×</button>
		<i class="icon fa fa-check"></i> You Are Successfully Logout.
		</div>');
		$this->session->unset_userdata('session_uid');
		REDIRECT(MAINSITE_Admin.'login');
	}



	public function index1()
	{
		$this->load->view('welcome_message');
	}

	function mypdf(){


		$this->load->library('pdf');


		  $this->pdf->load_view('mypdf');
		  $this->pdf->render();


		  $this->pdf->stream("welcome.pdf");
	   }
}
