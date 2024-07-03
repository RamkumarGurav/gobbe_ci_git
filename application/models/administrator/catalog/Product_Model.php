<?php

include_once(APPPATH.'models/administrator/Database_Tables.php');

class Product_Model extends Database_Tables

{

	public $session_uid = '';

	public $session_name = '';

	public $session_email = '';



	function __construct()

    {

		parent::__construct();

		date_default_timezone_set("Asia/Kolkata");

		$this->load->database();

		$this->model_data = array();
		$this->db->query("SET sql_mode = ''");

		$this->session_uid=$this->session->userdata('sess_psts_uid');

		$this->session_name=$this->session->userdata('sess_psts_name');

		$this->session_email=$this->session->userdata('sess_psts_email');



	}



	function getData($params = array())

	{

		$result='';

		if(!empty($params['search_for']))

		{

			$this->db->select("count(aau.id) as counts");

		}

		else

		{



			//$sql_get_list="select p.id , p.manufacturer_id , p.name, p.status , p.ref_code , p.slug_url , p.short_description, p.added_on, m.manufacturer_name from product p , manufacturer as m where m.manufacturer_id=p.manufacturer_id   ";

			//$this->db->select("aau.id , aau.id , aau.name, aau.status , aau.ref_code , aau.short_description, aau.added_on, aau1.name, pi.product_image_name, pi.id, c.category_name");

			$this->db->select("aau.id ,aau.image, aau.brand_id , aau.name as product_name, aau.status , aau.ref_code , aau.hsn_code, aau.tax_id, aau.short_description, aau.long_description,  aau.added_on, aau.is_bulk_enquiry, aau1.name, pi.product_image_name, aau.updated_on");

			$this->db->select("(select au.name from user as  au where au.id = aau.added_by) as added_by_name ");

			$this->db->select("(select au.name from user as  au where au.id = aau.updated_by) as updated_by_name ");
			$this->db->select("GROUP_CONCAT(DISTINCT category.name SEPARATOR '~~~') as category_name");

		}



		$this->db->from("product as aau");

		$this->db->join("brand_master as aau1" , "aau.id = aau1.id" , "left");

		$this->db->join("product_category as pc" , "pc.id = aau.id" , "left");
		$this->db->join("category as category" , "pc.id = category.id" , "left");

		$this->db->join("product_image as pi" , "pi.id = aau.id" , "left");

		if(!empty($params['sortByPosition']))

		{

			$this->db->order_by("aau.position ASC");

		}

		else if(!empty($params['order_by'])){

			$this->db->order_by($params['order_by']);

		}

		else {
			$this->db->order_by("aau.id desc");
		}
		if(!empty($params['product_id']))
		{
			$this->db->where("aau.id" ,  $params['product_id']);
		}
		if(!empty($params['category_id']))
		{
			$this->db->where("aau.id" ,  $params['category_id']);
		}
		if(!empty($params['id']))
		{
			$this->db->where("aau.id" ,  $params['id']);
		}
		if(!empty($params['start_date']))
		{
			$temp_date = date('Y-m-d' , strtotime($params['start_date']));
			$this->db->where("DATE_FORMAT(aau.added_on, '%Y%m%d') >= DATE_FORMAT('$temp_date', '%Y%m%d')");
		}
		if(!empty($params['end_date']))
		{
			$temp_date = date('Y-m-d' , strtotime($params['end_date']));
			$this->db->where("DATE_FORMAT(aau.added_on, '%Y%m%d') <= DATE_FORMAT('$temp_date', '%Y%m%d')");
		}



		if(!empty($params['record_status']))

		{

			if($params['record_status']=='zero')

			{

				$this->db->where("aau.status = 0");

			}

			else

			{

				$this->db->where("aau.status" ,  $params['record_status']);

			}

		}



		if(!empty($params['group_by']))

		{

			$this->db->group_by($params['product_id']);

		}

		else

		{

			$this->db->group_by("aau.id");

		}



		if(!empty($params['limit']) && !empty($params['offset'])){

			$this->db->limit($params['limit'] , $params['offset']);

		}

		else if(!empty($params['limit'])){

			$this->db->limit($params['limit']);

		}





		$query_get_list = $this->db->get();

		//echo $this->db->last_query();

		$result = $query_get_list->result();



		if(!empty($result))

		{

			if(!empty($params['details']))

			{

				foreach($result as $r)

				{

					$this->db->select("aur.* , emp.name");

					$this->db->from("product as aur");

					$this->db->join("user as emp" , "emp.id = aur.updated_by", "left");

					$this->db->where("aur.id" , $r->product_id);

					$r->roles = $this->db->get()->result();

				}

			}



		}

		return $result;

	}



	function get_product_category($params = array())

	{

		$result='';

		if(!empty($params['search_for']))

		{

			$this->db->select("count(aau.id) as counts");

		}

		else

		{

			//$sql_get_list="select p.id , p.manufacturer_id , p.name, p.status , p.ref_code , p.slug_url , p.short_description, p.added_on, m.manufacturer_name from product p , manufacturer as m where m.manufacturer_id=p.manufacturer_id   ";

			//$this->db->select("aau.id , aau.id , aau.name, aau.status , aau.ref_code , aau.short_description, aau.added_on, aau1.name, pi.product_image_name, pi.id, c.category_name");

			$this->db->select("aau.category_id , aau.product_id, aau.id");

		}



		$this->db->from("product_category as aau");



		if(!empty($params['product_id']))

		{

			$this->db->where("aau.product_id" ,  $params['product_id']);

		}



		if(!empty($params['limit']) && !empty($params['offset'])){

			$this->db->limit($params['limit'] , $params['offset']);

		}

		else if(!empty($params['limit'])){

			$this->db->limit($params['limit']);

		}





		$query_get_list = $this->db->get();

		//echo $this->db->last_query();

		$result = $query_get_list->result();

		return $result;

	}



			function checkSlugUrl($params = array())

			{

				$result='';

				if(!empty($params['search_for']))

				{

					$this->db->select("count(aau.id) as counts");

				}

				else

				{



					//$sql_get_list="select p.product_id , p.manufacturer_id , p.name, p.status , p.ref_code , p.slug_url , p.short_description, p.added_on, m.manufacturer_name from product p , manufacturer as m where m.manufacturer_id=p.manufacturer_id   ";

					//$this->db->select("aau.product_id , aau.brand_id , aau.name, aau.status , aau.ref_code , aau.short_description, aau.added_on, aau1.brand_name, pi.product_image_name, pi.category_id, c.category_name");

					$this->db->select("aau.*");

				}



				$this->db->from("product_seo as aau");



				if(!empty($params['slug_url']))

				{

					$this->db->where("aau.slug_url" ,  $params['slug_url']);



				}

				if(!empty($params['product_seo_id']))

				{

					$this->db->where("aau.id !=" ,  $params['product_seo_id']);



				}





				if(!empty($params['limit']) && !empty($params['offset'])){

					$this->db->limit($params['limit'] , $params['offset']);

				}

				else if(!empty($params['limit'])){

					$this->db->limit($params['limit']);

				}





				$query_get_list = $this->db->get();

				//echo $this->db->last_query();

				$result = $query_get_list->result();



				return $result;

			}

	function get_product_images($params = array())
	{


		$result='';
		if(!empty($params['search_for']))
		{
			$this->db->select("distinct(count(aau.id)) as counts");
		}
		else
		{
			//$sql_get_list="select p.id , p.manufacturer_id , p.name, p.status , p.ref_code , p.slug_url , p.short_description, p.added_on, m.manufacturer_name from product p , manufacturer as m where m.manufacturer_id=p.manufacturer_id   ";
			//$this->db->select("aau.id , aau.id , aau.name, aau.status , aau.ref_code , aau.short_description, aau.added_on, aau1.name, pi.product_image_name, pi.id, c.category_name");
			$this->db->select("aau.product_id , aau.id as product_image_id, aau.product_image_name, aau.default_image, aau.position, aau.status, aau.added_on, aau.added_by, aau.updated_on, aau.updated_by, product_combination.id as product_combination_id");
			$this->db->group_by('aau.id');
		}
		$this->db->from("product_image as aau");
		$this->db->join("product_combination", "product_combination.product_image_id = aau.id and aau.product_id = product_combination.product_id", "left");
		if(!empty($params['product_id']))
		{
			$this->db->where("aau.product_id" ,  $params['product_id']);
		}
		if(!empty($params['limit']) && !empty($params['offset']))
		{
			$this->db->limit($params['limit'] , $params['offset']);
		}
		else if(!empty($params['limit']))
		{
			$this->db->limit($params['limit']);
		}
		if(!empty($params['sortByPosition']))
		{
			//$this->db->order_by("aau.position ASC");
		}
		$this->db->order_by("aau.position ASC");
		$query_get_list = $this->db->get();
		//echo $this->db->last_query();
		$result = $query_get_list->result();
		return $result;
	}



	function get_product_combination_detail($params = array())

	{

		$result='';

		if(!empty($params['search_for']))

		{

			$this->db->select("count(pc.id) as counts");

		}

		else

		{


		//	$this->db->distinct("pc.id");

			$this->db->select("pc.* ,pca.combination_value,pca.product_attribute_id,pca.product_attribute_value_id, ps.id as product_seo_id, ps.slug_url, ps.meta_title, ps.meta_description, ps.meta_keywords, pis.quantity, pi.id as product_image_id, pi.product_image_name");

		}

		$this->db->from("product_combination as pc");

		$this->db->join("product_image as pi" , "pi.id  = pc.product_image_id" , "left");
		$this->db->join("product_seo as ps" , "ps.product_combination_id = pc.id" , "left");
		$this->db->join("product_in_store as pis" , "pis.product_combination_id = pc.id" , "left");
		$this->db->join("product_combination_attribute as pca" , "pca.product_combination_id = pc.id" , "left");



		if(!empty($params['product_id']))

		{

			$this->db->where("pc.product_id" ,  $params['product_id']);

		}
		if(!empty($params['id']))

		{

			$this->db->where("pc.id" ,  $params['id']);

		}



		if(!empty($params['limit']) && !empty($params['offset'])){

			$this->db->limit($params['limit'] , $params['offset']);

		}

		else if(!empty($params['limit'])){

			$this->db->limit($params['limit']);

		}
			$this->db->group_by("pc.id");




		$query_get_list = $this->db->get();

		//echo $this->db->last_query();

		$result = $query_get_list->result();

		return $result;

	}



	function get_product_combination_attribute_detail($params = array())

	{

		$result='';

		if(!empty($params['search_for']))

		{

			$this->db->select("count(pc.id) as counts");

		}

		else

		{

			$this->db->select("pc.*,pa.name as attribute_name,pav.name as  attribute_value_name");

		}

		$this->db->from("product_combination_attribute as pc");
		$this->db->join("product_attribute as pa" , "pa.id  = pc.product_attribute_id" , "left");
		$this->db->join("product_attribute_value as pav" , "pav.id = pc.product_attribute_value_id" , "left");


		if(!empty($params['product_id']))
		{
			$this->db->where("pc.product_id" ,  $params['product_id']);

		}



		if(!empty($params['limit']) && !empty($params['offset'])){

			$this->db->limit($params['limit'] , $params['offset']);

		}

		else if(!empty($params['limit'])){

			$this->db->limit($params['limit']);

		}





		$query_get_list = $this->db->get();

		// echo $this->db->last_query();
		// die;
		$result = $query_get_list->result();

		return $result;

	}



	function get_category($params = array())

	{

		$result='';

		if(!empty($params['search_for']))

		{

			$this->db->select("count(aau.id) as counts");

		}

		else

		{

			$this->db->select("aau.*");

			$this->db->select("if(aau.super_category_id = 0 , 'Parent' , aau1.name) as super_category_name");

			$this->db->select("(select au.name from user as  au where au.id = aau.added_by) as added_by_name ");

			$this->db->select("(select au.name from user as  au where au.id = aau.updated_by) as updated_by_name ");

		}



		$this->db->from("category as aau");

		$this->db->join("category as aau1" , "aau.super_category_id = aau1.id" , "left");



		if(!empty($params['sortByPosition']))

		{

			$this->db->order_by("aau.position ASC");

		}

		else if(!empty($params['order_by'])){

			$this->db->order_by($params['order_by']);

		}

		else {

			$this->db->order_by("aau.id desc");

		}



		if(!empty($params['category_id']))

		{

			$this->db->where("aau.id" ,  $params['category_id']);

		}

		if(!empty($params['id']))

		{

			$this->db->where("aau.id" ,  $params['id']);

		}



		if(!empty($params['start_date']))

		{

			$temp_date = date('Y-m-d' , strtotime($params['start_date']));

			$this->db->where("DATE_FORMAT(aau.added_on, '%Y%m%d') >= DATE_FORMAT('$temp_date', '%Y%m%d')");

		}



		if(!empty($params['end_date']))

		{

			$temp_date = date('Y-m-d' , strtotime($params['end_date']));

			$this->db->where("DATE_FORMAT(aau.added_on, '%Y%m%d') <= DATE_FORMAT('$temp_date', '%Y%m%d')");

		}



		if(!empty($params['record_status']))

		{

			if($params['record_status']=='zero')

			{

				$this->db->where("aau.status = 0");

			}

			else

			{

				$this->db->where("aau.status" ,  $params['record_status']);

			}

		}



		if(!empty($params['limit']) && !empty($params['offset'])){

			$this->db->limit($params['limit'] , $params['offset']);

		}

		else if(!empty($params['limit'])){

			$this->db->limit($params['limit']);

		}





		$query_get_list = $this->db->get();

		//echo $this->db->last_query();

		$result = $query_get_list->result();



		if(!empty($result))

		{

			if(!empty($params['details']))

			{

				foreach($result as $r)

				{

					$this->db->select("aur.* , emp.name");

					$this->db->from("category as aur");

					$this->db->join("user as emp" , "emp.id = aur.updated_by", "left");

					$this->db->where("aur.super_category_id" , $r->category_id);

					$r->roles = $this->db->get()->result();





				}

			}



		}

		return $result;

	}



	function get_brand($params = array())

	{

		$result='';

		if(!empty($params['search_for']))

		{

			$this->db->select("count(urm.id) as counts");

		}

		else

		{

			$this->db->select("urm.* ");

			$this->db->select("(select au.name from user as  au where au.id = urm.added_by) as added_by_name ");

			$this->db->select("(select au.name from user as  au where au.id = urm.updated_by) as updated_by_name ");

		}



		$this->db->from("brand_master as urm");

		$this->db->order_by("brand_id desc");



		if(!empty($params['brand_id']))

		{

			$this->db->where("urm.id" ,  $params['brand_id']);

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



		if(!empty($params['record_status']))

		{

			if($params['record_status']=='zero')

			{

				$this->db->where("urm.status = 0");

			}

			else

			{

				$this->db->where("urm.id" ,  $params['record_status']);

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



		$query_get_list = $this->db->get();

		$result = $query_get_list->result();



		return $result;

	}



	function get_uom($params = array())

	{

		$result='';

		if(!empty($params['search_for']))

		{

			$this->db->select("count(urm.unit_of_measurement_id) as counts");

		}

		else

		{

			$this->db->select("urm.* ");

			$this->db->select("(select au.name from user as  au where au.id = urm.added_by) as added_by_name ");

			$this->db->select("(select au.name from user as  au where au.id = urm.updated_by) as updated_by_name ");

		}



		$this->db->from("unit_of_measurement_master as urm");

		$this->db->order_by("unit_of_measurement_id desc");



		if(!empty($params['unit_of_measurement_id']))

		{

			$this->db->where("urm.unit_of_measurement_id" ,  $params['uom_id']);

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



		if(!empty($params['record_status']))

		{

			if($params['record_status']=='zero')

			{

				$this->db->where("urm.status = 0");

			}

			else

			{

				$this->db->where("urm.unit_of_measurement_id" ,  $params['record_status']);

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



		$query_get_list = $this->db->get();

		$result = $query_get_list->result();



		return $result;

	}



	function get_tax($params = array())

	{

		$result='';

		if(!empty($params['search_for']))

		{

			$this->db->select("count(urm.tax_id) as counts");

		}

		else

		{

			$this->db->select("urm.* ");

			$this->db->select("(select au.name from user as  au where au.id = urm.added_by) as added_by_name ");

			$this->db->select("(select au.name from user as  au where au.id = urm.updated_by) as updated_by_name ");

		}



		$this->db->from("tax as urm");

		$this->db->order_by("tax_id desc");



		if(!empty($params['tax_id']))

		{

			$this->db->where("urm.tax_id" ,  $params['tax_id']);

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



		if(!empty($params['record_status']))

		{

			if($params['record_status']=='zero')

			{

				$this->db->where("urm.status = 0");

			}

			else

			{

				$this->db->where("urm.tax_id" ,  $params['record_status']);

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



		$query_get_list = $this->db->get();

		$result = $query_get_list->result();



		return $result;

	}



	function get_discountCategory($params = array())

	{

		$result='';

		if(!empty($params['search_for']))

		{

			$this->db->select("count(urm.discount_group_id) as counts");

		}

		else

		{

			$this->db->select("urm.* ");

			$this->db->select("(select au.name from user as  au where au.id = urm.added_by) as added_by_name ");

			$this->db->select("(select au.name from user as  au where au.id = urm.updated_by) as updated_by_name ");

		}



		$this->db->from("discount_group as urm");

		$this->db->order_by("discount_group_id desc");



		if(!empty($params['discount_group_id']))

		{

			$this->db->where("urm.discount_group_id" ,  $params['tax_id']);

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



	function get_attributes_input_list($params = array())

	{

		$result='';

		if(!empty($params['search_for']))

		{

			$this->db->select("count(urm.attributes_input_id) as counts");

		}

		else

		{

			$this->db->select("urm.attributes_input_id, urm.name, urm.type, urm.input");

		}



		$this->db->from("attributes_input as urm");

		$this->db->order_by("attributes_input_id desc");



		if(!empty($params['attributes_input_id']))

		{

			$this->db->where("urm.attributes_input_id" ,  $params['attributes_input_id']);

		}





		if(!empty($params['limit']) && !empty($params['offset'])){

			$this->db->limit($params['limit'] , $params['offset']);

		}

		else if(!empty($params['limit'])){

			$this->db->limit($params['limit']);

		}

		$this->db->order_by("urm.name asc");

		$query_get_list = $this->db->get();

		$result = $query_get_list->result();



		return $result;

	}



	function get_product_attribute_list($params = array())

	{

		/*$this->db->distinct();

			$this->db->select('pa.*,ai.name as ai_name,ai.type , (select count(product_attribute_value_id) from product_attribute_value as pav where pav.product_attribute_id=pa.product_attribute_id) as product_attribute_value_count');

			$this->db->from("$this->product_attribute_table_name AS pa");

			$this->db->join("$this->attributes_input_table_name as ai", 'ai.attributes_input_id = pa.attributes_input_id');*/





		$result='';

		if(!empty($params['search_for']))

		{

			$this->db->select("count(urm.id) as counts");

		}

		else

		{

			$this->db->distinct();

			$this->db->select("urm.id as product_attribute_id, urm.attributes_input_id, urm.name, urm.condition_per_product, ai.name as ai_name,ai.type");

			$this->db->select("(select count(id) from product_attribute_value as pav where pav.product_attribute_id = urm.id) as product_attribute_value_count");

		}



		$this->db->from("product_attribute as urm");

		$this->db->join("attributes_input as ai" , "ai.id = urm.attributes_input_id");

		//$this->db->order_by("product_attribute_id desc");



		if(!empty($params['product_attribute_id']))

		{

			$this->db->where("urm.id" ,  $params['product_attribute_id']);

		}





		if(!empty($params['limit']) && !empty($params['offset'])){

			$this->db->limit($params['limit'] , $params['offset']);

		}

		else if(!empty($params['limit'])){

			$this->db->limit($params['limit']);

		}

		$this->db->order_by("urm.name asc");

		$query_get_list = $this->db->get();

		$result = $query_get_list->result();



		return $result;

	}



	function get_attribute_value_list($params = array())
	{
		/*
		$this->db->distinct();
		$this->db->select('ai.*,pa.name as attribute_name ');
		$this->db->from("$this->product_attribute_table_name AS pa");
		$this->db->join("$this->product_attribute_value_table_name as ai", 'ai.product_attribute_id = pa.product_attribute_id');*/

		$result='';
		if(!empty($params['search_for']))
		{
			$this->db->select("count(urm.attributes_input_id) as counts");
		}
		else
		{
			$this->db->distinct();
			$this->db->select("urm.id as product_attribute_value_id, urm.product_attribute_id, urm.name, urm.position, urm.status, ai.name as attribute_name");
		}
		$this->db->from("product_attribute_value as urm");
		$this->db->join("product_attribute as ai" , "ai.id = urm.product_attribute_id");
		//$this->db->order_by("position desc");
		$this->db->order_by("urm.name asc");

		if(!empty($params['product_attribute_value_id']))
		{
			$this->db->where("urm.id" ,  $params['product_attribute_value_id']);
		}

		if(!empty($params['limit']) && !empty($params['offset']))
		{
			$this->db->limit($params['limit'] , $params['offset']);
		}
		else if(!empty($params['limit']))
		{
			$this->db->limit($params['limit']);
		}
		//echo $this->db->last_query();
		$query_get_list = $this->db->get();
		$result = $query_get_list->result();
		return $result;
	}





}
