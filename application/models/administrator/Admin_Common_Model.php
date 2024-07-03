<?php
class Admin_Common_Model extends CI_Model
{
	public $session_uid = '';
	public $session_uname = '';
	public $session_uemail = '';
	public $session_company_profile_id = '';

	function __construct()
    {
		$this->load->database();
		$this->model_data = array();
		$this->session_uid=$this->session->userdata('session_uid');
		$this->session_uname=$this->session->userdata('session_uname');
		$this->session_uemail=$this->session->userdata('session_uemail');
		$this->session_company_profile_id=$this->session->userdata('sess_company_profile_id');

	}

	function get_admin_user_data($params = array())
	{
		$result='';
		$this->db->select("au.*,urm.name as user_role_name ");//, urm.user_role_name
		$this->db->from("user as au");
		$this->db->join("user_role_master as urm" , "au.role_id = urm.id");
		$this->db->where("au.id" , $this->session_uid);
		$this->db->limit(1);

		$query_get_list = $this->db->get();
		$result = $query_get_list->result();
		if(!empty($result))
		{
			foreach($result as $r)
			{
				$this->db->select("aur.* , urm.name as user_role_name , cp.company_unique_name");
				$this->db->from("user_role as aur");
				$this->db->join("user_role_master as urm" , "urm.id = aur.user_role_id");
				$this->db->join("company_profile as  cp" , "cp.id = aur.company_profile_id");
				$this->db->where("aur.user_id" , $r->id);
				$r->roles = $this->db->get()->result();
			}
			$result = $result[0];
			foreach($result->roles as $r){
				if($this->session_company_profile_id == $r->company_profile_id)
				{
					$result->user_role_name = $r->user_role_name;
					$result->user_role_id = $r->user_role_id;
				}
			}
		}
		return $result;
	}

	function get_left_menu($params = array())
	{
		$result='';
		$this->db->distinct("mm.is_master");
		$this->db->select("mm.* , mp.*");
		$this->db->from("module_master as mm");
		$this->db->join("module_permissions as mp" , "mm.id = mp.module_id");
		//$this->db->join("users_role_master as urm" , "urm.user_role_id = mp.user_role_id");
		//$this->db->join("user as au" , "mp.user_role_id = au.user_role_id");
		$this->db->join("user_role as au" , "mp.user_role_id = au.user_role_id");
	//	$this->db->where("au.company_profile_id" , $this->sess_company_profile_id);
		$this->db->where("au.user_id" , $this->session_uid);
		$this->db->where("mm.is_display" , 1);
		$this->db->where("mm.status" , 1);
		$this->db->order_by("mm.position ASC");
		$this->db->group_by("mm.is_master");
		if(!empty($params['module_id']))
		{
			$this->db->where("mm.id" , $params['module_id']);
		}
		if(!empty($params['is_master']))
		{
			if($params['is_master']=="zero"){
				$this->db->where("mm.is_master" , 0);
			}
			else{
				$this->db->where("mm.is_master" , $params['is_master']);
			}
		}

		if(!empty($params['module_id']))
		{
			$this->db->where("mm.id" , $params['module_id']);
		}

		if(!empty($params['parent_module_id']))
		{
			$this->db->where("mm.parent_module_id" , $params['parent_module_id']);
		}

		$query_get_list = $this->db->get();
		$result = $query_get_list->result();
		//echo $this->db->last_query();die;
		if(!empty($result))
		{
			foreach($result as $r)
			{
				if(!empty($r->direct_db_count) && !empty($r->table_name))
				{
					$this->db->select('count(*) as row_count');
					$this->db->from("$r->table_name");
					if(!empty($r->count_function_name))
					{
						$this->db->where("$r->count_function_name");
					}
					if($r->is_company_profile_id==1)
					{
						$this->db->where("company_profile_id" , $this->session_company_profile_id);
					}
					$row_count_result = $this->db->get()->result();
					$r->data_count = $row_count_result[0]->row_count;
				}
				$r->submenu = $this->get_left_sub_menu(array("is_master"=>$r->is_master ));
			}
		}
		//print_r($result);
		return $result;
	}

	function get_left_sub_menu($params = array())
	{
		//echo "111";
		$result='';
		$this->db->select("mm.* , mp.*");
		$this->db->from("module_master as mm");
		$this->db->join("module_permissions as mp" , "mm.id = mp.module_id");
		//$this->db->join("users_role_master as urm" , "urm.user_role_id = mp.user_role_id");
		//$this->db->join("user as au" , "mp.user_role_id = au.user_role_id");
		$this->db->join("user_role as au" , "mp.user_role_id = au.user_role_id");
		$this->db->where("au.company_profile_id" , $this->session_company_profile_id);
		$this->db->where("au.id" , $this->session_uid);
		$this->db->where("mm.is_display" , 1);
		$this->db->where("mm.status" , 1);

		if(!empty($params['is_master']))
		{
			if($params['is_master']=="zero")
			{
				$this->db->where("mm.is_master = 0");
			}
			else
			{
				$this->db->where("mm.is_master" , $params['is_master']);
			}

		}

		if(!empty($params['parent_module_id']))
		{
			$this->db->where("mm.parent_module_id" , $params['parent_module_id']);
		}
		if(!empty($params['is_master']))
		{
			$this->db->where("mm.is_master" , $params['is_master']);
		}

		$query_get_list = $this->db->get();
		//echo $this->db->last_query();
		$result = $query_get_list->result();
		if(!empty($result))
		{
			foreach($result as $r)
			{
				if(!empty($r->direct_db_count) && !empty($r->table_name))
				{
					$this->db->select('count(*) as row_count');
					$this->db->from("$r->table_name");
					$row_count_result = $this->db->get()->result();
					$r->data_count = $row_count_result[0]->row_count;
				}
			}
		}

		return $result;
	}
	function get_role_modules($params = array())
	{
		//echo "111";
		$result='';
		$this->db->select("mm.* , mp.*");
		$this->db->from("module_master as mm");
		$this->db->join("module_permissions as mp" , "mm.id = mp.module_id");
		//$this->db->join("users_role_master as urm" , "urm.user_role_id = mp.user_role_id");
		//$this->db->join("user as au" , "mp.user_role_id = au.user_role_id");
		$this->db->join("user_role as au" , "mp.user_role_id = au.user_role_id");
		$this->db->where("au.company_profile_id" , $this->session_company_profile_id);
		$this->db->where("au.id" , $this->session_uid);
		$this->db->where("mm.is_display" , 1);
		$this->db->where("mm.is_master !=" , 0);
		$this->db->where("mm.status" , 1);
		$this->db->group_by("mm.is_master");
		$this->db->order_by("mm.position",'asc');

		if(!empty($params['is_master']))
		{
			if($params['is_master']=="zero")
			{
				$this->db->where("mm.is_master = 0");
			}
			else
			{
				$this->db->where("mm.is_master" , $params['is_master']);
			}

		}

		if(!empty($params['parent_module_id']))
		{
			$this->db->where("mm.parent_module_id" , $params['parent_module_id']);
		}
		if(!empty($params['session_uroleid']))
		{
			$this->db->where("mp.user_role_id" , $params['session_uroleid']);
		}

		$query_get_list = $this->db->get();
		//echo $this->db->last_query();
		$result = $query_get_list->result();
		if(!empty($result))
		{
			foreach($result as $r)
			{
				if(!empty($r->direct_db_count) && !empty($r->table_name))
				{
					$this->db->select('count(*) as row_count');
					$this->db->from("$r->table_name");
					$row_count_result = $this->db->get()->result();
					$r->data_count = $row_count_result[0]->row_count;
				}
			}
		}

		return $result;
	}
	// function get_role_modules($params = array())
	// {
	// 	//echo "111";
	// 	$result='';
	// 	$this->db->select("mm.* , mp.*");
	// 	$this->db->from("module_master as mm");
	// 	$this->db->join("module_permissions as mp" , "mm.id = mp.module_id");
	// 	//$this->db->join("users_role_master as urm" , "urm.user_role_id = mp.user_role_id");
	// 	//$this->db->join("user as au" , "mp.user_role_id = au.user_role_id");
	// 	$this->db->join("user_role as au" , "mp.user_role_id = au.user_role_id");
	// 	$this->db->where("au.company_profile_id" , $this->session_company_profile_id);
	// 	$this->db->where("au.id" , $this->session_uid);
	// 	$this->db->where("mm.is_display" , 1);
	// 	$this->db->where("mm.is_master !=" , 0);
	// 	$this->db->where("mm.status" , 1);
	// 	$this->db->group_by("mm.is_master");
	// 	$this->db->order_by("mm.position",'asc');
	//
	// 	if(!empty($params['is_master']))
	// 	{
	// 		if($params['is_master']=="zero")
	// 		{
	// 			$this->db->where("mm.is_master = 0");
	// 		}
	// 		else
	// 		{
	// 			$this->db->where("mm.is_master" , $params['is_master']);
	// 		}
	//
	// 	}
	//
	// 	if(!empty($params['parent_module_id']))
	// 	{
	// 		$this->db->where("mm.parent_module_id" , $params['parent_module_id']);
	// 	}
	// 	if(!empty($params['session_uroleid']))
	// 	{
	// 		$this->db->where("mp.user_role_id" , $params['session_uroleid']);
	// 	}
	//
	// 	$query_get_list = $this->db->get();
	// 	//echo $this->db->last_query();
	// 	$result = $query_get_list->result();
	// 	if(!empty($result))
	// 	{
	// 		foreach($result as $r)
	// 		{
	// 			if(!empty($r->direct_db_count) && !empty($r->table_name))
	// 			{
	// 				$this->db->select('count(*) as row_count');
	// 				$this->db->from("$r->table_name");
	// 				$row_count_result = $this->db->get()->result();
	// 				$r->data_count = $row_count_result[0]->row_count;
	// 			}
	// 		}
	// 	}
	//
	// 	return $result;
	// }

	function check_user_access($params = array())
	{

		$result='';
		$this->db->select("mm.* , mp.*");
		$this->db->from("module_master as mm");
		$this->db->join("module_permissions as mp" , "mm.id = mp.module_id");
		$this->db->join("user_role_master as urm" , "urm.id = mp.user_role_id");
		//$this->db->join("user as au" , "mp.user_role_id = au.user_role_id");
		$this->db->join("user_role as au" , "mp.user_role_id = au.user_role_id");
	//	$this->db->where("au.company_profile_id" , $this->session_company_profile_id);
		$this->db->where("au.user_id" , $this->session_uid);
		//$this->db->where("mm.is_display" , 1);
		$this->db->where("mm.status" , 1);
		$this->db->where("urm.status" , 1);

		if(!empty($params['is_master']))
		{
			if($params['is_master']=="zero"){
				$this->db->where("mm.is_master" , 0);
			}
			else{
				$this->db->where("mm.is_master" , $params['is_master']);
			}
		}

		if(!empty($params['parent_module_id']))
		{
			$this->db->where("mm.parent_module_id" , $params['parent_module_id']);
		}

		if(!empty($params['module_id']))
		{
			$this->db->where("mm.id" , $params['module_id']);
		}

		$query_get_list = $this->db->get();
		$result = $query_get_list->result();
		//echo $this->db->last_query();

		if(!empty($result))
		{
			$result = $result[0];
		}

		return $result;
	}

	function getData($params = array())
	{
		$this->db->select($params['select']);
		$this->db->from($params['from']);
		if(!empty($params['where']))
		{
			$this->db->where("($params[where])");
		}

		if(!empty($params['limit']))
		{
			$this->db->limit($params['limit']);
		}
		if(!empty($params['order_by']))
		{
			$this->db->order_by($params['order_by']);
		}
		$query_get_list = $this->db->get();
		return $query_get_list->result();
	}
}

?>
