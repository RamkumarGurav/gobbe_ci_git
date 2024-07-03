<?php
class Generate_Otp_Model extends CI_Model
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

	function get_master($params = array())
	{
		$result='';
		if(!empty($params['search_for']))
		{
			$this->db->select("count(urm.orders_id) as counts");
		}
		else
		{
			$this->db->select("urm.*,ch.name as child_name,sum(od.orders_details_id) as o_prod_in_cart,ch.father_name as father_name,b.name as branch_name,c.name as class_name");
		}

		$this->db->from("orders as urm");
		$this->db->join("orders_details as od" , "urm.orders_id = od.orders_id");
		$this->db->join("childrens as  ch" , "ch.id = urm.child_id");
		$this->db->join("branches as  b" , "b.id = urm.branch_id");
		$this->db->join("classes as  c" , "c.id = urm.class_id");
		//$this->db->join("gender as  g" , "g.id = urm.gender_id");
		//$this->db->join("academic_year as  ay" , "ay.id = urm.academic_year_id");


		if(!empty($params['id']))
		{
			$this->db->where("urm.orders_id" ,  $params['id']);
		}
		if(!empty($params['book_issue_status']))
		{
			$this->db->where("urm.books_otp != ''");
		}
		if(!empty($params['shoe_issue_status']))
		{
			$this->db->where("urm.shoes_otp != ''");
		}
		if(!empty($params['uniform_issue_status']))
		{
			$this->db->where("urm.uniform_otp != ''");
		}
		if(!empty($params['shoe_barcode']))
		{
			$this->db->where("urm.shoe_barcode" , $params['shoe_barcode']);
		}

		if(!empty($params['books_barcode']))
		{

			$this->db->where("urm.books_barcode" , $params['books_barcode']);
		}
		if(!empty($params['uniform_barcode']))
		{
			$this->db->where("urm.uniform_barcode" , $params['uniform_barcode']);
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
		if(!empty($params['field_value']) && !empty($params['field_name']))
		{
			$this->db->where("$params[field_name] like ('%$params[field_value]%')");
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
	//	$this->db->where("urm.is_deleted" , 0);


		if(!empty($params['branch_id']))
		{
			$this->db->where("urm.branch_id" ,  $params['branch_id']);
		}
		if(!empty($params['class_id']))
		{

			$this->db->where("urm.class_id" ,  $params['class_id']);
			//$this->db->where("urm.branch_id" ,  2);
		}
		if(!empty($params['books_search']))
		{

			$this->db->where("urm.books_otp !=" , '');
			//$this->db->where("urm.branch_id" ,  2);
		}
		if(!empty($params['uniform_search']))
		{

			$this->db->where("urm.uniform_otp !=" , '');
			//$this->db->where("urm.branch_id" ,  2);
		}
		if(!empty($params['shoes_search']))
		{

			$this->db->where("urm.shoes_otp !=" , '');
			//$this->db->where("urm.branch_id" ,  2);
		}

		if(!isset($params['search_for']) && isset($params['group_by'])){
				$this->db->group_by("urm.orders_id");
		}
		$this->db->order_by("urm.orders_id desc");
		if(!empty($params['limit']) && !empty($params['offset'])){
			$this->db->limit($params['limit'] , $params['offset']);
		}
		else if(!empty($params['limit'])){
			$this->db->limit($params['limit']);
		}

		$query_get_list = $this->db->get();
		$result = $query_get_list->result();
		// echo $this->db->last_query();
		// die();
		return $result;
	}
}

?>
