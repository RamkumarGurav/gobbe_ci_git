<?php
class State_Model extends CI_Model
{
	public $session_uid = '';
	public $session_uname = '';
	public $session_uemail = '';

	function __construct()
    {
		$this->load->database();
		$this->model_data = array();
		$this->session_uid=$this->session->userdata('session_uid');
		$this->session_uname=$this->session->userdata('session_uname');
		$this->session_uemail=$this->session->userdata('session_uemail');

	}

	function getData($params = array())
	{
		$result='';
		if(!empty($params['search_for']))
		{
			$this->db->select("count(urm.id) as counts");
		}
		else
		{
			$this->db->select("urm.* , c.id as country_id , c.name as country_name , c.country_short_name");
			$this->db->select("(select au.name from user as  au where au.id = urm.added_by) as added_by_name ");
			$this->db->select("(select au.name from user as  au where au.id = urm.updated_by) as updated_by_name ");
		}

		$this->db->from("state as urm");
		$this->db->join("country as  c" , "c.id = urm.country_id");
		$this->db->order_by("urm.id desc");

		if(!empty($params['id']))
		{
			$this->db->where("urm.id" ,  $params['id']);
		}
		if(!empty($params['country_id']))
		{
			$this->db->where("urm.country_id" ,  $params['country_id']);
		}

		if(!empty($params['start_date']))
		{
			$temp_date = date('Y-m-d' , strtotime($params['start_date']));
			$this->db->where("DATE_FORMAT(urm.added_on, '%Y%m%d') >= DATE_FORMAT('$temp_date', '%Y%m%d')");
		}

		if(!empty($params['end_date']))
		{
			$temp_date = date('Y-m-d' , strtotime($params['end_date']));
			$this->db->where("DATE_FORMAT(urm.added_on, '%Y%m%d') <= DATE_FORMAT('$temp_date', '%Y%m%d')");
		}

		if(!empty($params['status']))
		{

			if($params['status']=='zero')
			{
				$this->db->where("urm.status = 0");
			}
			else
			{
				$this->db->where("urm.status" ,  $params['status']);
			}
		}
		$this->db->where("urm.is_deleted" , 0);
		$this->db->where("c.is_deleted" , 0);

		if(!empty($params['field_value']) && !empty($params['field_name']))
		{
			$this->db->where("$params[field_name] like ('%$params[field_value]%')");
		}

		if(!empty($params['limit']) && !empty($params['offset'])){
			$this->db->limit($params['limit'] , $params['offset']);
		}
		else if(!empty($params['limit'])){
			$this->db->limit($params['limit']);
		}

		$query_get_list = $this->db->get();
		$result = $query_get_list->result();

		return $result;
	}
}

?>