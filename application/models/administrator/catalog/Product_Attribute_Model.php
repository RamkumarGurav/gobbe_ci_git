<?php
class Product_Attribute_Model extends CI_Model
{
	public $session_uid = '';
	public $session_name = '';
	public $session_email = '';

	function __construct()
    {
		$this->load->database();
		$this->model_data = array();
		$this->session_uid=$this->session->userdata('sess_psts_uid');
		$this->session_name=$this->session->userdata('sess_psts_name');
		$this->session_email=$this->session->userdata('sess_psts_email');

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
			//$this->db->select("urm.* , dm.designation_name , urm.user_role_name , ci.city_name , s.state_name , c.country_name , c.country_short_name , c.dial_code ");
			$this->db->select("urm.*");
			$this->db->select("(select au.name from user as  au where au.id = urm.added_by) as added_by_name ");
			$this->db->select("(select au.name from user as  au where au.id = urm.updated_by) as updated_by_name ");
		}

		$this->db->from("product_attribute as urm");
		$this->db->join("attributes_input as ai" , "ai.id = urm.attributes_input_id");
		$this->db->order_by("urm.id desc");

		if(!empty($params['id']))
		{
			$this->db->where("urm.id" ,  $params['id']);
		}

		if(!empty($params['record_status']))
		{
			if($params['record_status']=='zero')
			{
				$this->db->where("urm.status = 0");
			}
			else
			{
				$this->db->where("urm.status" ,  $params['record_status']);
			}
		}

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
		$this->db->where("urm.is_deleted" , 0);
		$query_get_list = $this->db->get();
		$result = $query_get_list->result();
		// echo $this->db->last_query();
		// die();

		//die();
		return $result;
	}
}

?>