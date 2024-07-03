<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class User_auth
{
	private $CI;
	public $session_uid = '';
	public $session_uname = '';
	public $session_uemail = '';
	function __construct()
	{
		$this->CI =& get_instance();
		$this->CI->load->database();
		$this->CI->load->library('session');
		$this->CI->load->helper('url');
		$this->CI->load->model('administrator/Admin_Common_Model');

		$this->session_uid=$this->CI->session->userdata('session_uid');
		$this->session_uname=$this->CI->session->userdata('session_uname');
		$this->session_uemail=$this->CI->session->userdata('session_uemail');
		$this->sess_company_profile_id=$this->CI->session->userdata('sess_company_profile_id');
	}

	function check_user_status()
	{

		$this->data['user_data']='';
		if($this->session_uid > 0 && !empty($this->session_uname))
		{
			$this->data['user_data'] = $this->CI->Admin_Common_Model->get_admin_user_data(array());

			if(!empty($this->data['user_data']))
			{
				if($this->data['user_data']->status!=1)
				{
					$this->unset_only();
					$this->CI->session->set_flashdata('alert_message', '<div class="alert alert-danger alert-dismissible">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
					<i class="icon fas fa-ban"></i> You are blocked by Management.
					</div>');
					$this->CI->session->unset_userdata('session_uid');
					//$this->CI->session->unset_userdata('session_uid');
					REDIRECT(MAINSITE_Admin.'login');
				}
			}
			else
			{
				$this->unset_only();
				$this->CI->session->set_flashdata('alert_message', '<div class="alert alert-danger alert-dismissible">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
				<i class="icon fas fa-ban"></i> Something Went Wrong. Please Try Again.
				</div>');
				$this->CI->session->unset_userdata('session_uid');
				REDIRECT(MAINSITE_Admin.'login');
			}

		}
		else
		{
			$this->unset_only();
			$this->CI->session->set_flashdata('alert_message', '<div class="alert alert-danger alert-dismissible">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
			<i class="icon fas fa-ban"></i> Session Out Please Try Again.
			</div>');
			$this->CI->session->unset_userdata('session_uid');
			REDIRECT(MAINSITE_Admin.'login');
		}

		$screen_lock = $this->CI->session->userdata('screen_lock');
		if(!empty($screen_lock))
		{
			REDIRECT(MAINSITE_Admin.'Screen-Lock');
		}


		return $this->data['user_data'];
	}

	function unset_only() {
		$user_data = $this->CI->session->all_userdata();
		foreach ($user_data as $key => $value) {
			if ($key != 'session_id' && $key != 'ip_address' && $key != 'user_agent' && $key != 'last_activity') {
				$this->CI->session->unset_userdata($key);
			}
		}
	}

	function get_left_menu($is_master , $params = array(),$module_id=0)
	{
		if(!empty($is_master) || true)
		{

			$menu = $this->CI->Admin_Common_Model->get_left_menu(array("is_master"=>$is_master , "module_id"=>$module_id));
			//$menu[] = $menu[0]->submenu;
			$display_menu="";
			// echo "<pre>";
			// print_r($menu);
			// echo "</pre>";die;

			foreach($menu as $m)
			{
				if(!empty($m->submenu))
				{
					$display_menu.=$this->get_main_menu_html($m , $params);
				}
				else
				{
					$display_menu.=$this->get_sub_menu_html($m , $params);
				}
			}

			return $display_menu;
		}
		else
		{
			return false;
		}
	}

	function get_main_menu_html($obj , $params){

		$active = "";
		$is_menu = '';
		//if() menu-open active
		// echo '<pre>';
		// print_r($obj);die;
		// echo '</pre>';
		$link = MAINSITE_Admin.$obj->class_name.'/'.$obj->function_name;

		if($params['page_is_master'] == $obj->is_master){
			$cls = ' nav-item-active';
			$mcls = ' menu menu-active';
			$expand = ' nid-con-b';
		}else{
			$cls  = $expand = '';
			$mcls  = '';

		}

		$html = '  <li class="nav-item '.	$cls.'" role="presentation">
					<div class="nav-item-drop">
							<div class="nid-li">
									<span class="menu '.	$mcls.'"><svg stroke="currentColor" fill="none" stroke-width="2" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round" class="w-5 h-5" aria-hidden="true" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg"><path d="M14.5 10c-.83 0-1.5-.67-1.5-1.5v-5c0-.83.67-1.5 1.5-1.5s1.5.67 1.5 1.5v5c0 .83-.67 1.5-1.5 1.5z"></path><path d="M20.5 10H19V8.5c0-.83.67-1.5 1.5-1.5s1.5.67 1.5 1.5-.67 1.5-1.5 1.5z"></path><path d="M9.5 14c.83 0 1.5.67 1.5 1.5v5c0 .83-.67 1.5-1.5 1.5S8 21.33 8 20.5v-5c0-.83.67-1.5 1.5-1.5z"></path><path d="M3.5 14H5v1.5c0 .83-.67 1.5-1.5 1.5S2 16.33 2 15.5 2.67 14 3.5 14z"></path><path d="M14 14.5c0-.83.67-1.5 1.5-1.5h5c.83 0 1.5.67 1.5 1.5s-.67 1.5-1.5 1.5h-5c-.83 0-1.5-.67-1.5-1.5z"></path><path d="M15.5 19H14v1.5c0 .83.67 1.5 1.5 1.5s1.5-.67 1.5-1.5-.67-1.5-1.5-1.5z"></path><path d="M10 9.5C10 8.67 9.33 8 8.5 8h-5C2.67 8 2 8.67 2 9.5S2.67 11 3.5 11h5c.83 0 1.5-.67 1.5-1.5z"></path><path d="M8.5 5H10V3.5C10 2.67 9.33 2 8.5 2S7 2.67 7 3.5 7.67 5 8.5 5z"></path></svg> '.$obj->mega_menu_name.' <i
													class="fa-solid fa-chevron-right"></i></span>
							</div>';


		$html .='<div class="nid-con '.$expand.'">';
		$shtml = '';
			foreach($obj->submenu as $s)
			{
				if($s->module_id == $params['page_module_id']){

					$chcls = ' active';
				}else{

					$chcls = '';
				}
				$link = MAINSITE_Admin.$s->class_name.'/'.$s->function_name;
				$html .= '<a class="nav-link '.$chcls.'" href="'.$link.'">'.$s->name.'</a>';

			//	$html .= $this->get_sub_menu_html($s , $params);
			}

		//	$html .= $shtml;
	  $html .= "</div></div></li>";

		return $html;
	}

	function get_sub_menu_html($obj , $params){
		$active = "";
		if(!empty($params['page_module_id']))
		{
			if($params['page_module_id'] == $obj->module_id)
			{
				$active = " active";
				$navactive = " nav-item-active";
			}else{
				$active = "";
				$navactive = "";
			}
		}
		$link = MAINSITE_Admin.$obj->class_name.'/'.$obj->function_name;

		//$html = '<li class="nav-item"><a href="'.$link.'" class="nav-link '.$active.'">';
		$html = '<li class="nav-item '.$navactive.'" role="presentation"<a class="nav-link '.$active.'" href="'.$link.'" id="ex1-tab-9" data-bs-toggle="pill" href="#ex1-pills-9" role="tab" aria-controls="ex1-pills-9" aria-selected="false" tabindex="-1"><span><svg stroke="currentColor" fill="none" stroke-width="2" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round" class="w-5 h-5" aria-hidden="true" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg"><circle cx="12" cy="12" r="3"></circle><path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z"></path></svg> '.$obj->name.'</span></a>';
		$html .="</a></li>";
		return $html;
	}

	function check_user_access($params = array())
	{
		if(!empty($params))
		{
			$menu = $this->CI->Admin_Common_Model->check_user_access($params);
			return $menu;
		}
		else
		{
			return false;
		}
	}

	function getData($params = array())
	{
		$this->CI->db->select($params['select']);
		$this->CI->db->from($params['from']);
		$this->CI->db->where("($params[where])");
		if(!empty($params['limit']))
		{
			$this->CI->db->limit($params['limit']);
		}
		if(!empty($params['order_by']))
		{
			$this->CI->db->order_by($params['order_by']);
		}
		$query_get_list = $this->CI->db->get();
		return $query_get_list->result();
	}

	function add_operation($params = array())
	{
		if(empty($params)) return false;
		$status = $this->CI->db->insert($params['table'], $params['data']);
		if($status){$status = $status = $this->CI->db->insert_id();}
		return $status;
	}

    public function getFiscalYear()
    {
		$result = array();
        $start='';
        $end='';
		$s_start='';
        $s_end='';
		if (date('m') < 4) {//Upto march
			$start=date('Y')-1;
       		$end=date('Y');
			$s_start=date('y')-1;
       		$s_end=date('y');
			//$financial_year = (date('Y')-1) . '-' . date('Y');
		} else {//form April
			$start=date('Y');
       		$end=date('Y') + 1;
			$s_start=date('y');
       		$s_end=date('y') + 1;
			//$financial_year = date('Y') . '-' . (date('Y') + 1);
		}

		$work_year = date('Y');
        $result['work_year'] = $work_year;
		$result['start'] = $start;
		$result['end'] = $end;
		$result['short_start'] = $s_start;
		$result['short_end'] = $s_end;
		$result['financial_year'] = $work_year;
		$result['short_financial_year'] = $s_start.'-'.$s_end;

        return (object)$result;
	}

	// $mydate = new fiscalYear();    // will default to the current date time
	// $mydate->setDate(2011, 3, 31); //if you don't do this
	// $result = $mydate->getFiscalYear();
	// var_dump(date(DATE_RFC3339, $result['start']));
	// var_dump(date(DATE_RFC3339, $result['end']));
}
