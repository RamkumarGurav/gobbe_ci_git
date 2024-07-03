<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once("Main.php");
class Ajax extends Main {

	function __construct()
	{
        parent::__construct();
		$this->load->database();
		$this->load->library('session');
		$this->load->model('Common_Model');
		$this->load->model('administrator/Admin_Common_Model');
		$this->load->model('administrator/Admin_model');
		$this->load->model('administrator/Ajax_Model');
		$this->load->library('User_auth');

		$session_uid = $this->data['session_uid']=$this->session->userdata('session_uid');
		$this->data['session_uname']=$this->session->userdata('session_uname');
		$this->data['session_uemail']=$this->session->userdata('session_uemail');
		$this->data['sess_company_profile_id']=$this->session->userdata('sess_company_profile_id');

		$this->load->helper('url');

		$this->data['User_auth_obj'] = new User_auth();
		$this->data['user_data'] = $this->data['User_auth_obj']->check_user_status();
		$this->data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$sess_left_nav = $this->session->flashdata('sess_left_nav');
		if(!empty($sess_left_nav))
		{
			$this->session->set_flashdata('sess_left_nav', $sess_left_nav);
			$this->data['page_module_id'] = $sess_left_nav;
		}

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


	function getState()
	{
		$state_id = $country_id ='0';
		if(!empty($_POST['country_id'])){ $country_id = $_POST['country_id']; }
		if(!empty($_POST['state_id'])){ $state_id = $_POST['state_id']; }

		$state_data = $this->Common_Model->getData(array('select'=>'*' , 'from'=>'state' , 'where'=>"country_id = $country_id and is_deleted < 1" , "order_by"=>"name ASC"));
		$result = '<option value="">Select State</option>';
		if(!empty($state_data))
		{
			foreach($state_data as $r)
			{
				$if_block = $selected = '';
				if($r->id == $state_id){ $selected = "selected"; }
				if($r->status!=1){$if_block= " [Block]";}
				$result .= '<option value="'.$r->id.'" '.$selected.'>'.$r->name.$if_block.'</option>';
			}
		}
		echo json_encode(array("state_html"=>$result , "state_json"=>$state_data));
	}
	function getAttValues()
	{
		$select_product_attribute_value_id = $select_product_attribute_id ='0';
		if(!empty($_POST['select_product_attribute_id'])){ $select_product_attribute_id = $_POST['select_product_attribute_id']; }
		if(!empty($_POST['select_product_attribute_value_id'])){ $select_product_attribute_value_id = $_POST['select_product_attribute_value_id']; }

		$a_data = $this->Common_Model->getData(array('select'=>'*' , 'from'=>'product_attribute_value' , 'where'=>"product_attribute_id = $select_product_attribute_id and is_deleted < 1" , "order_by"=>"name ASC"));
		$result = '<option value="">Select</option>';
		if(!empty($a_data))
		{
			foreach($a_data as $r)
			{
				$if_block = $selected = '';
				if($r->id == $select_product_attribute_value_id){ $selected = "selected"; }
				if($r->status!=1){$if_block= " [Block]";}
				$result .= '<option value="'.$r->id.'" '.$selected.'>'.$r->name.$if_block.'</option>';
			}
		}
		echo json_encode(array("attribute_value_html"=>$result , "state_json"=>$a_data));
	}

	function getClass()
	{
		$branch_id = $class_id ='0';
		if(!empty($_POST['branch_id'])){ $branch_id = $_POST['branch_id']; }
		if(!empty($_POST['class_id'])){ $class_id = $_POST['class_id']; }

		$class_data = $this->Common_Model->getData(array('select'=>'*' , 'from'=>'classes' , 'where'=>"branch_id = $branch_id and is_deleted < 1" , "order_by"=>"name ASC"));
		$result = '<option value="">Select Class</option>';
		if(!empty($class_data))
		{
			foreach($class_data as $r)
			{
				$if_block = $selected = '';
				if($r->id == $class_id){ $selected = "selected"; }
				if($r->status!=1){$if_block= " [Block]";}
				$result .= '<option value="'.$r->id.'" '.$selected.'>'.$r->name.$if_block.'</option>';
			}
		}
		echo json_encode(array("class_html"=>$result , "class_json"=>$class_data));
	}

	function getChild()
	{
		$academic_year = $class_id ='0';
		if(!empty($_POST['academic_year'])){ $academic_year = $_POST['academic_year']; }
		if(!empty($_POST['class_id'])){ $class_id = $_POST['class_id']; }
				$this->data['session_ubranch_id']=$branch_id =$this->session->userdata('session_ubranch_id');
	//	$class_data = $this->Common_Model->getData(array('select'=>'*' , 'from'=>'classes' , 'where'=>"branch_id = $branch_id and is_deleted < 1" , "order_by"=>"name ASC"));
		$class_data = $this->Common_Model->getData(array('select'=>'*' , 'from'=>'childrens' , 'where'=>"branch_id = $branch_id and academic_year_id =$academic_year and class_id = $class_id  and is_deleted < 1" , "order_by"=>"name ASC"));
		$result = '<option value="">Select Child</option>';
		if(!empty($class_data))
		{
			foreach($class_data as $r)
			{
				$if_block = $selected = '';

				$result .= '<option value="'.$r->id.'" >'.$r->name.'-'.$r->reg_no.'</option>';
			}
		}
		echo json_encode(array("child_html"=>$result , "child_json"=>$class_data));
		exit;
	}
	function ProductGetClass()
	{
		$branch_id = $product_id ='0';
		if(!empty($_POST['branch_id'])){ $branch_id = $_POST['branch_id']; }
		if(!empty($_POST['product_id'])){ $product_id = $_POST['product_id']; }

		$class_data = $this->Common_Model->getData(array('select'=>'*' , 'from'=>'classes' , 'where'=>"branch_id = $branch_id and is_deleted < 1" , "order_by"=>"name ASC"));
		$product_classes = $this->Common_Model->getData(array('select'=>'*' , 'from'=>'product_classes' , 'where'=>"product_id = $product_id "));
		$class = array();
		if(!empty($product_classes)){
			foreach ($product_classes as $classes) {
			array_push(	$class,$classes->class_id);
			}
		}
		$result = '<option value="">Select Class</option>';
		if(!empty($class_data))
		{
			foreach($class_data as $r)
			{
				$if_block = $selected = '';
				if (in_array($r->id, $class))
			  {
					 $selected = "selected";
				}
				if(empty($product_id)){
					$selected = "selected";
				}
				//if($r->id == $class_id){ $selected = "selected"; }
				if($r->status!=1){$if_block= " [Block]";}
				$result .= '<option value="'.$r->id.'" '.$selected.'>'.$r->name.$if_block.'</option>';
			}
		}
		echo json_encode(array("class_html"=>$result , "class_json"=>$product_classes));
	}

	function getCity()
	{
		$state_id = $city_id ='0';
		if(!empty($_POST['city_id'])){ $city_id = $_POST['city_id']; }
		if(!empty($_POST['state_id'])){ $state_id = $_POST['state_id']; }

		$city_data = $this->Common_Model->getData(array('select'=>'*' , 'from'=>'city' , 'where'=>"state_id = $state_id and is_deleted < 1" , "order_by"=>"name ASC"));
		$result = '<option value="">Select City</option>';
		//echo "<pre>"; print_r($city_data); echo "</pre>";
		if(!empty($city_data))
		{
			foreach($city_data as $r)
			{
				$if_block = $selected = '';
				if($r->id == $city_id){ $selected = "selected"; }
				if($r->status!=1){$if_block= " [Block]";}
				$result .= '<option value="'.$r->id.'" '.$selected.'>'.$r->name.$if_block.'</option>';
			}
		}
		echo json_encode(array("city_html"=>$result , "city_json"=>$city_data));
	}

	function del_employee_file()
	{
		$admin_user_file_id = $_POST['admin_user_file_id'];
		$file_data = $this->Common_Model->getData(array('select'=>'*' , 'from'=>'user_file' , 'where'=>"user_id = $admin_user_file_id"));
		if(!empty($file_data))
		{
			$this->Common_Model->delete_operation(array('table'=>'user_file' , 'where'=>"user_id = $admin_user_file_id"));
		}
	}

	function del_overview_file()
	{
		$trip_sub_overview_id = $_POST['trip_sub_overview_id'];
		$file_data = $this->Common_Model->getData(array('select'=>'*' , 'from'=>'trip_sub_overview' , 'where'=>"trip_sub_overview_id = $trip_sub_overview_id"));
		if(!empty($file_data))
		{
			$this->Common_Model->delete_operation(array('table'=>'trip_sub_overview' , 'where'=>"trip_sub_overview_id = $trip_sub_overview_id"));
		}
	}

	function del_itinerary_file()
	{
		$trip_itinerary_id = $_POST['trip_itinerary_id'];
		$file_data = $this->Common_Model->getData(array('select'=>'*' , 'from'=>'trip_itinerary' , 'where'=>"trip_itinerary_id = $trip_itinerary_id"));
		if(!empty($file_data))
		{
			$this->Common_Model->delete_operation(array('table'=>'trip_itinerary' , 'where'=>"trip_itinerary_id = $trip_itinerary_id"));
		}
	}

	function del_general_file()
	{
		$trip_general_id = $_POST['trip_general_id'];
		$file_data = $this->Common_Model->getData(array('select'=>'*' , 'from'=>'trip_general' , 'where'=>"trip_general_id = $trip_general_id"));
		if(!empty($file_data))
		{
			$this->Common_Model->delete_operation(array('table'=>'trip_general' , 'where'=>"trip_general_id = $trip_general_id"));
		}
	}

	function del_gallery_file()
	{
		$trip_gallery_id = $_POST['trip_gallery_id'];
		$file_data = $this->Common_Model->getData(array('select'=>'*' , 'from'=>'trip_gallery' , 'where'=>"trip_gallery_id = $trip_gallery_id"));
		if(!empty($file_data))
		{
			$this->Common_Model->delete_operation(array('table'=>'trip_gallery' , 'where'=>"trip_gallery_id = $trip_gallery_id"));
		}
	}

}
