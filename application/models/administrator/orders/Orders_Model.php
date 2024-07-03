<?php
class Orders_Model extends Database_Tables
{
	function __construct()
    {
        parent::__construct();
		date_default_timezone_set("Asia/Kolkata");
		$this->load->database();
    }

	function getData($params = array())
	{
		$result='';
		if(!empty($params['search_for']))
		{
			$this->db->select("count(urm.orders_id) as counts");
		}
		else
		{
			$this->db->select("urm.* ,urm.orders_id as id, s.name as store_name , os.order_status_display ");

		}

		$this->db->from("orders as urm");
		$this->db->order_by("orders_id desc");
		$this->db->join("stores as  s" , "s.id = urm.stores_id");
		$this->db->join("order_status as  os" , "os.order_status_id = urm.order_status_id");

		if(!empty($params['orders_id']))
		{
			$this->db->where("urm.orders_id" ,  $params['orders_id']);
		}
		if(!empty($params['order_status_id']))
		{
			$this->db->where("urm.order_status_id" ,  $params['order_status_id']);
		}
		if(!empty($params['is_cod']))
		{
			$this->db->where("urm.is_cod" ,  $params['is_cod']);
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
				$this->db->where("urm.orders_id" ,  $params['record_status']);
			}
		}

		if(!empty($params['stores_id']))
		{
			$this->db->where('urm.stores_id' , $params['stores_id']);
		}


		if(!empty($params['order_status']))
		{
			$this->db->where('urm.order_status' , $params['order_status']);
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


		/*$this->db
		->select('o.* , s.name as store_name , os.order_status_display')
		->from("orders as o")
		->join("stores as s" , "o.stores_id = s.stores_id")
		->join("order_status as os" , "os.order_status_id = o.order_status_id");

		if(!empty($params['stores_id']))
			$this->db->where('o.stores_id' , $params['stores_id']);
		if(!empty($params['order_status']))
			$this->db->where('o.order_status' , $params['order_status']);
		$this->db->order_by('o.orders_id DESC');
		return $this->db->get()->result();*/
	}
	public function orderDahboardData($params = array())
	{
		$result='';
		$this->db
		->select("count(o.orders_id) as total_orders,SUM(total) as total_orders_price")
		->from("orders as o");
		if(!empty($params['order_status'])){

			$this->db->where("o.order_status in ($params[order_status])");

		}
		if(!empty($params['last_month'])){
			$stages_sts_date = date('Y-m', strtotime('last month')); // Get the year and month of the last month
				$sts_from_date = date('Y-m-01', strtotime($stages_sts_date)); // Set the start date to the first day of the last month
				$sts_end_date = date('Y-m-t', strtotime($stages_sts_date)); // Set the end date to the last day of the last month
				$this->db->where("DATE_FORMAT(o.added_on, '%Y%m%d') >= DATE_FORMAT('$sts_from_date', '%Y%m%d')");
				$this->db->where("DATE_FORMAT(o.added_on, '%Y%m%d') <= DATE_FORMAT('$sts_end_date', '%Y%m%d')");

		}
		if(!empty($params['this_month'])){
			$stages_sts_date = date('Y-m');
			$sts_from_date = date('Y-m-d', strtotime($stages_sts_date.'-1'));
			$sts_end_date = date('Y-m-t');
				$this->db->where("DATE_FORMAT(o.added_on, '%Y%m%d') >= DATE_FORMAT('$sts_from_date', '%Y%m%d')");
				$this->db->where("DATE_FORMAT(o.added_on, '%Y%m%d') <= DATE_FORMAT('$sts_end_date', '%Y%m%d')");

		}
		if(!empty($params['today_orders'])){

			$sts_from_date = date('Y-m-d');
			$sts_end_date = date('Y-m-d');
				$this->db->where("DATE_FORMAT(o.added_on, '%Y%m%d') >= DATE_FORMAT('$sts_from_date', '%Y%m%d')");
				$this->db->where("DATE_FORMAT(o.added_on, '%Y%m%d') <= DATE_FORMAT('$sts_end_date', '%Y%m%d')");

		}
		if(!empty($params['yesterday_orders'])){

			$sts_from_date = date('Y-m-d',strtotime('-1 day'));
			$sts_end_date = date('Y-m-d');
				$this->db->where("DATE_FORMAT(o.added_on, '%Y%m%d') >= DATE_FORMAT('$sts_from_date', '%Y%m%d')");
				$this->db->where("DATE_FORMAT(o.added_on, '%Y%m%d') <= DATE_FORMAT('$sts_end_date', '%Y%m%d')");

		}
		if(!empty($params['start_date']))
		{
			$temp_date = date('Y-m-d' , strtotime($params['start_date']));
			$this->db->where("DATE_FORMAT(o.added_on, '%Y%m%d') >= DATE_FORMAT('$temp_date', '%Y%m%d')");
		}

		if(!empty($params['end_date']))
		{
			$temp_date = date('Y-m-d' , strtotime($params['end_date']));
			$this->db->where("DATE_FORMAT(o.added_on, '%Y%m%d') <= DATE_FORMAT('$temp_date', '%Y%m%d')");
		}
			$query_get_list = $this->db->get();
			$result = $query_get_list->result();

			return $result;
	}
	function getOrdersDetails($params = array())
	{
		$result = '';
		$this->db
		->select('o.* , s.name as store_name , s.person_contact_name , s.person_contact_email , s.person_contact_number, s.person_contact_alt_number, s.store_contact_number , s.address as store_address , os.order_status_display , c.country_short_name , c.code as country_code ,  st.code as division_code' )//, c.city_name as store_city_name , country_short_name , country_code
		->from("orders as o")
		->join("stores as s" , "o.stores_id = s.id")
		->join("order_status as os" , "os.order_status_id = o.order_status_id")
		->join("country as c" , "c.id = o.d_country_id" , "left")
		->join("state as st" , "st.id = o.d_state_id" , "left")
		->join("city as ci" , "ci.id = o.d_city_id" , "left")
		;
		if(!empty($params['orders_id']))
			$this->db->where("o.orders_id in ($params[orders_id])");
			if(!empty($params['today_orders'])){

				$sts_from_date = date('Y-m-d',strtotime('-1 day'));
				$sts_end_date = date('Y-m-d');
					$this->db->where("DATE_FORMAT(o.added_on, '%Y%m%d') >= DATE_FORMAT('$sts_from_date', '%Y%m%d')");
					$this->db->where("DATE_FORMAT(o.added_on, '%Y%m%d') <= DATE_FORMAT('$sts_end_date', '%Y%m%d')");

			}
		if(!empty($params['order_number']))
			$this->db->where("o.order_number in ('$params[order_number]')");
		if(!empty($params['stores_id']))
			$this->db->where('o.stores_id' , $params['stores_id']);
		$this->db->order_by('o.orders_id DESC');
		$result_c = $this->db->get();
		//echo $this->db->last_query();
		if($result_c->num_rows() > 0)
		{
			$result = $result_c->result();
			for($i = 0 ; $i< count($result) ; $i++ )
			{
			$this->db
			->select('od.* , pc.product_display_name')
			->from("orders_details as od")
			->join("product_combination as pc" , "od.product_combination_id = pc.id" , 'left')
			->where("od.orders_id" , $result[$i]->orders_id);

			$result1 = $this->db->get();
			if($result1->num_rows() > 0)
			{ $result[$i]->details=$result1->result(); }
			else
			{ $result[$i]->details=false; }

			$this->db
			->select('oh.* , os.order_status_display , os.order_status')
			->from("orders_history as oh")
			->join("order_status as os" , "os.order_status_id = oh.order_status_id")
			->where("oh.orders_id" , $result[$i]->orders_id)
			->order_by("oh.updated_on DESC");
			$result2 = $this->db->get();
			if($result2->num_rows() > 0)
			{ $result[$i]->order_history=$result2->result(); }
			else
			{ $result[$i]->order_history=false; }

			if( !empty( $params["for_invoice"] ) )
			{
				$this->db
				->select('s.*')
				->from('stores as s')
				->where('s.id' , $result[$i]->stores_id);
				$result[$i]->store_data = $this->db->get()->result();
			}

			if( !empty( $params["for_packing_slip"] ) )
			{
				$this->db
				->select('s.*')
				->from('courier_packing_slip as s')
				->where('s.docket_no' , $result[0]->docket_no)
				->order_by('s.courier_packing_slip_id DESC');
				$result[$i]->packing_slip_data = $this->db->get()->result();
			}
			}
		}
		return $result;
	}



	function getTempOrders($params = array())
	{
		$this->db
		->select('to.* , s.name as store_name , (select o.order_number from orders as o where  o.temp_orders_id = to.temp_orders_id limit 1) as order_number , (select o.orders_id from orders as o where  o.temp_orders_id = to.temp_orders_id limit 1) as orders_id')
		->from("temp_orders as to")
		->join("stores as s" , "to.stores_id = s.stores_id");

		if(!empty($params['stores_id']))
			$this->db->where('to.stores_id' , $params['stores_id']);
		if(!empty($params['order_status']))
			$this->db->where('to.order_status' , $params['order_status']);
		$this->db->order_by('to.temp_orders_id DESC');
		return $this->db->get()->result();
	}

	function getTempOrdersDetails($params = array())
	{
		$this->db
		->select('to.* , s.name as store_name , s.person_contact_name , s.person_contact_email , s.person_contact_number, s.person_contact_alt_number, s.store_contact_number , s.address as store_address' )//, c.city_name as store_city_name
		->from("temp_orders as to")
		->join("stores as s" , "to.stores_id = s.stores_id")
		//->join("city as c" , "c.city_id = s.city_id")
		;
		if(!empty($params['temp_orders_id']))
			$this->db->where('to.temp_orders_id' , $params['temp_orders_id']);
		if(!empty($params['stores_id']))
			$this->db->where('to.stores_id' , $params['stores_id']);
		$this->db->order_by('to.temp_orders_id DESC');
		$result = $this->db->get();
		//echo $this->db->last_query();
		if($result->num_rows() > 0)
		{
			$result = $result->result();
			$this->db
			->select('od.*')
			->from("temp_orders_details as od")
			->where("od.temp_orders_id" , $result[0]->temp_orders_id);
			$result1 = $this->db->get();
			if($result1->num_rows() > 0)
			{ $result[0]->details=$result1->result(); }
			else
			{ $result[0]->details=false; }
		}
		return $result;
	}

	function getName($params = array())
	{
		$this->db->select($params['select']);
		$this->db->from($params['from']);
		$this->db->where("($params[where])");
		$query_get_list = $this->db->get();
		return $query_get_list->result();
	}
}

?>
