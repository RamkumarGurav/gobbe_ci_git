<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends CI_Controller {

	function __construct()
	{
        parent::__construct();
		$this->load->database();
		$this->load->library('session');
		$this->load->model('Common_Model');
		$this->load->model('administrator/Admin_Common_Model');
		$this->load->model('administrator/Admin_model');
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->library('User_auth');
		$this->db->query("SET sql_mode = ''");

		$session_uid = $this->data['session_uid']=$this->session->userdata('session_uid');
		$this->data['session_uname']=$this->session->userdata('session_uname');
		$this->data['session_uemail']=$this->session->userdata('session_uemail');
		$this->data['session_uroleid']=$this->session->userdata('session_uroleid');

		$this->load->helper('url');

		$this->data['User_auth_obj'] = new User_auth();
		$this->data['user_data'] = $this->data['User_auth_obj']->check_user_status();
		$this->data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);


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


	function get_header()
	{
		$this->load->view('admin/inc/header', $this->data);
	}

	function get_left_nav()
	{
		$page_is_master = "";
		$page_parent_module_id = "";
		$page_module_id = "";
		//print_r($this->data['user_access']);
		if(!empty($this->data['page_is_master'])){
			$page_is_master = $this->data['page_is_master'];
		}

		if(!empty($this->data['page_parent_module_id'])){
			$page_parent_module_id = $this->data['page_parent_module_id'];
		}

		if(!empty($this->data['page_module_id'])){
			$page_module_id = $this->data['page_module_id'];
		}

		$params_arr = array(
			"page_is_master"=>$page_is_master ,
			"page_parent_module_id"=>$page_parent_module_id ,
			"page_module_id"=>$page_module_id
		);
		$modules = $this->Admin_Common_Model->get_role_modules(array("session_uroleid"=>$this->data['session_uroleid']));

		$all_modules_list = '';
		if(!empty($modules)){
			foreach ($modules as $module ) {
				$all_modules_list .= $this->data['User_auth_obj']->get_left_menu( $module->is_master , $params_arr);
				// echo "<pre>";
				// print_r($all_modules_list);
				// echo "</pre>";
				// echo "string";
				// die;
			}
		//	die;
		}
	//	print_r($all_modules_list);die;
		$this->data['left_menu_module_list'] = $all_modules_list;
		$this->load->view('admin/inc/left_nav', $this->data);
	}

	function get_footer()
	{
		$this->load->view('admin/inc/footer', $this->data);
	}


}
