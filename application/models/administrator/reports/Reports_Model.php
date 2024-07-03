<?php
//require_once('Database_Tables.php');
class Reports_Model extends Database_Tables
{
	function __construct()
    {
        parent::__construct();
		date_default_timezone_set("Asia/Kolkata");
		$this->load->database();
		$this->db->query("SET sql_mode = ''");
    }
	function get_data(){
      $this->db->select('year,purchase,sale,profit');
      $result = $this->db->get('account');
      return $result;
  }
	public function students_order($params = array())
	{
		$this->db->select("urm.*,b.name as branch_name,c.name as class_name");
		$this->db->from("orders as urm");
		$this->db->join("childrens as  ch" , "ch.id = urm.child_id");
		$this->db->join("branches as  b" , "b.id = urm.branch_id");
		$this->db->join("classes as  c" , "c.id = urm.class_id");

		if(!empty($params['from_date']))
		{
			$temp_date = date('Y-m-d' , strtotime($params['from_date']));
			$this->db->where("DATE_FORMAT(urm.added_on, '%Y%m%d') >= DATE_FORMAT('$temp_date', '%Y%m%d')");
		}

		if(!empty($params['to_date']))
		{
			$temp_date = date('Y-m-d' , strtotime($params['to_date']));
			$this->db->where("DATE_FORMAT(urm.added_on, '%Y%m%d') <= DATE_FORMAT('$temp_date', '%Y%m%d')");
		}
		if(!empty($params['branch_id']))
		{
			$this->db->where("urm.branch_id" ,  $params['branch_id']);
		}
		if(!empty($params['class_id']))
		{
			$this->db->where("urm.class_id" ,  $params['class_id']);
		}
		if(!empty($params['field_value']) && !empty($params['field_name']))
		{
			$this->db->where("$params[field_name] like ('%$params[field_value]%')");
		}
		if(!empty($params['id_in']))
		{
			$this->db->where_in("urm.orders_id" ,  $params['id_in']);
		}
		$this->db->order_by("urm.orders_id desc");
		$query_get_list = $this->db->get();
		$result = $query_get_list->result();
		return $result;
	}
	public function settled_transactions($params = array())
	{
		$this->db->select("urm.*,om.*,bm.name as branch_name,c.name as class_name");
		$this->db->from("settled_transactions as urm");
		$this->db->join("orders AS om" , "urm.merchantTxnID = om.r_order_id" , 'left');
		$this->db->join("branches AS bm" , "bm.id = om.branch_id" , 'left');
		//$this->db->join("childrens as  ch" , "ch.id = urm.child_id");
	//	$this->db->join("branches as  b" , "b.id = urm.branch_id");
		$this->db->join("classes as  c" , "c.id = om.class_id");

		if(!empty($params['from_date']))
		{
			$temp_date = date('Y-m-d' , strtotime($params['from_date']));
			$this->db->where("DATE_FORMAT(urm.settlement_date, '%Y%m%d') >= DATE_FORMAT('$temp_date', '%Y%m%d')");
		}

		if(!empty($params['to_date']))
		{
			$temp_date = date('Y-m-d' , strtotime($params['to_date']));
			$this->db->where("DATE_FORMAT(urm.settlement_date, '%Y%m%d') <= DATE_FORMAT('$temp_date', '%Y%m%d')");
		}
		if(!empty($params['branch_id']))
		{

			$this->db->where("om.branch_id" ,  $params['branch_id']);
		}
		if(!empty($params['id_in']))
		{
			$this->db->where_in("urm.settled_transactions_id" ,  $params['id_in']);
		}
		$this->db->order_by("urm.settled_transactions_id desc");
		$query_get_list = $this->db->get();

		$result = $query_get_list->result();
		return $result;
	}
	public function pending_Settlement_reports($params = array())
	{
		$this->db->select("om.*,bm.name as branch_name,c.name as class_name");
		$this->db->from("orders as om");
		//$this->db->join("orders AS om" , "urm.merchantTxnID = om.r_order_id" );
		$this->db->join("branches AS bm" , "bm.id = om.branch_id" , 'left');
		//$this->db->join("childrens as  ch" , "ch.id = urm.child_id");
	//	$this->db->join("branches as  b" , "b.id = urm.branch_id");
		$this->db->join("classes as  c" , "c.id = om.class_id");

		if(!empty($params['from_date']))
		{
			$temp_date = date('Y-m-d' , strtotime($params['from_date']));
			$this->db->where("DATE_FORMAT(om.added_on, '%Y%m%d') >= DATE_FORMAT('$temp_date', '%Y%m%d')");
		}

		if(!empty($params['to_date']))
		{
			$temp_date = date('Y-m-d' , strtotime($params['to_date']));
			$this->db->where("DATE_FORMAT(om.added_on, '%Y%m%d') <= DATE_FORMAT('$temp_date', '%Y%m%d')");
		}
		if(!empty($params['branch_id']))
		{

			$this->db->where("om.branch_id" ,  $params['branch_id']);
		}
		$this->db->where("om.r_order_id NOT IN(SELECT merchantTxnID FROM settled_transactions)");
		if(!empty($params['id_in']))
		{
			$this->db->where_in("om.orders_id" ,  $params['id_in']);
		}
		$this->db->order_by("om.orders_id desc");
		$query_get_list = $this->db->get();
		//echo $this->db->last_query();
		//die;
		$result = $query_get_list->result();
		return $result;
	}
	public function vendor_pending_order($params = array())
	{
		$this->db->select("urm.*,b.name as branch_name,c.name as class_name");
		$this->db->from("orders as urm");
		$this->db->join("childrens as  ch" , "ch.id = urm.child_id");
		$this->db->join("branches as  b" , "b.id = urm.branch_id");
		$this->db->join("classes as  c" , "c.id = urm.class_id");

		if(!empty($params['from_date']))
		{
			$temp_date = date('Y-m-d' , strtotime($params['from_date']));
			$this->db->where("DATE_FORMAT(urm.added_on, '%Y%m%d') >= DATE_FORMAT('$temp_date', '%Y%m%d')");
		}

		if(!empty($params['to_date']))
		{
			$temp_date = date('Y-m-d' , strtotime($params['to_date']));
			$this->db->where("DATE_FORMAT(urm.added_on, '%Y%m%d') <= DATE_FORMAT('$temp_date', '%Y%m%d')");
		}
		if(!empty($params['branch_id']))
		{
			$this->db->where("urm.branch_id" ,  $params['branch_id']);
		}
		if(!empty($params['class_id']))
		{
			$this->db->where("urm.class_id" ,  $params['class_id']);
		}
		if(!empty($params['field_value']) && !empty($params['field_name']))
		{
			$this->db->where("$params[field_name] like ('%$params[field_value]%')");
		}
		$this->db->where("(urm.shoe_approved_status !='2' OR urm.book_approved_status !='2' OR urm.uniform_approved_status !='2')", NULL, FALSE);
		if(!empty($params['id_in']))
		{
			$this->db->where_in("urm.orders_id" ,  $params['id_in']);
		}
		$this->db->order_by("urm.orders_id desc");
		$query_get_list = $this->db->get();

		$result = $query_get_list->result();
		return $result;
	}
	
	function getOrderSalesReports($params = array())
	{
		$this->db->select("urm.*,od.*,p.hsn_code,t.tax_percentage,g.name as gender_name,ch.name as child_name,ch.father_name as father_name,b.name as branch_name,c.name as class_name");
		$this->db->from("orders as urm");
		$this->db->join("orders_details as od" , "urm.orders_id = od.orders_id");
		$this->db->join("product as p" , "p.id = od.product_id");
		$this->db->join("childrens as  ch" , "ch.id = urm.child_id");
		$this->db->join("branches as  b" , "b.id = urm.branch_id");
		$this->db->join("classes as  c" , "c.id = urm.class_id");
		$this->db->join("gender as  g" , "g.id = urm.gender_id");
		$this->db->join("tax as  t" , "t.id = p.tax_id");
		if(!empty($params['from_date']))
		{
			$temp_date = date('Y-m-d' , strtotime($params['from_date']));
			//$this->db->where("DATE_FORMAT(urm.added_on, '%Y%m%d') >= DATE_FORMAT('$temp_date', '%Y%m%d')");
			if(!empty($params['product_type']))
			{
				$product_type = $params['product_type'];
				if($product_type == 1){
					$this->db->where("DATE_FORMAT(urm.book_issue_date, '%Y%m%d') >= DATE_FORMAT('$temp_date', '%Y%m%d')");
				}
				if($product_type == 2){
					$this->db->where("DATE_FORMAT(urm.shoe_issue_date, '%Y%m%d') >= DATE_FORMAT('$temp_date', '%Y%m%d')");
				}
				if($product_type == 3){
					$this->db->where("DATE_FORMAT(urm.uniform_issue_date, '%Y%m%d') >= DATE_FORMAT('$temp_date', '%Y%m%d')");
				}
			}
		}

		if(!empty($params['to_date']))
		{
			$temp_date = date('Y-m-d' , strtotime($params['to_date']));
			if(!empty($params['product_type']))
			{
				$product_type = $params['product_type'];
				if($product_type == 1){
					$this->db->where("DATE_FORMAT(urm.book_issue_date, '%Y%m%d') <= DATE_FORMAT('$temp_date', '%Y%m%d')");
				}
				if($product_type == 2){
					$this->db->where("DATE_FORMAT(urm.shoe_issue_date, '%Y%m%d') <= DATE_FORMAT('$temp_date', '%Y%m%d')");
				}
				if($product_type == 3){
					$this->db->where("DATE_FORMAT(urm.uniform_issue_date, '%Y%m%d') <= DATE_FORMAT('$temp_date', '%Y%m%d')");
				}
			}
		}
		if(!empty($params['branch_id']))
		{
			$this->db->where("urm.branch_id" ,  $params['branch_id']);
		}
		if(!empty($params['product_type']))
		{
			$product_type = $params['product_type'];
			if($product_type == 1){
				$this->db->where("od.category_id" ,  4);
			}
			if($product_type == 2){
				$this->db->where("od.category_id" ,  2);
			}
			if($product_type == 3){
				$this->db->where_not_in("od.category_id" ,  array(2,4,1));
			}
		}
		$query_get_list = $this->db->get();
		$result = $query_get_list->result();
		return $result;
	}
	
	function getOrderSalesReportsNew($params = array())
	{
		
		$this->db->select("urm.*,od.*,p.hsn_code,t.tax_percentage,g.name as gender_name,ch.name as child_name,ch.father_name as father_name,b.name as branch_name,c.name as class_name,
		
		od.orders_details_id ,
		od.fiscal_year_id ,
		od.orders_id  ,
		od.product_id ,
		od.invoice_number  ,
		sum(od.total_price) as total_price ,
		sum(od.total_gst) as total_gst ,
		sum(od.final_value) as final_value ,
		od.product_name ,
		od.size_name ,
		od.is_set ,
		od.category_name ,
		od.product_quantity ,
		sum(od.cart_quantity) as cart_quantity
		
		");
		$this->db->from("orders as urm");
		$this->db->join("orders_details as od" , "urm.orders_id = od.orders_id");
		$this->db->join("product as p" , "p.id = od.product_id");
		$this->db->join("childrens as  ch" , "ch.id = urm.child_id");
		$this->db->join("branches as  b" , "b.id = urm.branch_id");
		$this->db->join("classes as  c" , "c.id = urm.class_id");
		$this->db->join("gender as  g" , "g.id = urm.gender_id");
		$this->db->join("tax as  t" , "t.id = p.tax_id");
		if(!empty($params['from_date']))
		{
			$temp_date = date('Y-m-d' , strtotime($params['from_date']));
			//$this->db->where("DATE_FORMAT(urm.added_on, '%Y%m%d') >= DATE_FORMAT('$temp_date', '%Y%m%d')");
			if(!empty($params['product_type']))
			{
				$product_type = $params['product_type'];
				if($product_type == 1){
					$this->db->where("DATE_FORMAT(urm.book_issue_date, '%Y%m%d') >= DATE_FORMAT('$temp_date', '%Y%m%d')");
				}
				if($product_type == 2){
					$this->db->where("DATE_FORMAT(urm.shoe_issue_date, '%Y%m%d') >= DATE_FORMAT('$temp_date', '%Y%m%d')");
				}
				if($product_type == 3){
					$this->db->where("DATE_FORMAT(urm.uniform_issue_date, '%Y%m%d') >= DATE_FORMAT('$temp_date', '%Y%m%d')");
				}
			}
			else
			{
				$this->db->where("DATE_FORMAT(urm.added_on, '%Y%m%d') >= DATE_FORMAT('$temp_date', '%Y%m%d')");
			}
		}

		if(!empty($params['to_date']))
		{
			$temp_date = date('Y-m-d' , strtotime($params['to_date']));
			if(!empty($params['product_type']))
			{
				$product_type = $params['product_type'];
				if($product_type == 1){
					$this->db->where("DATE_FORMAT(urm.book_issue_date, '%Y%m%d') <= DATE_FORMAT('$temp_date', '%Y%m%d')");
				}
				if($product_type == 2){
					$this->db->where("DATE_FORMAT(urm.shoe_issue_date, '%Y%m%d') <= DATE_FORMAT('$temp_date', '%Y%m%d')");
				}
				if($product_type == 3){
					$this->db->where("DATE_FORMAT(urm.uniform_issue_date, '%Y%m%d') <= DATE_FORMAT('$temp_date', '%Y%m%d')");
				}
			}
			else
			{
				$this->db->where("DATE_FORMAT(urm.added_on, '%Y%m%d') <= DATE_FORMAT('$temp_date', '%Y%m%d')");
			}
		}
		if(!empty($params['branch_id']))
		{
			$this->db->where("urm.branch_id" ,  $params['branch_id']);
		}
		if(!empty($params['product_type']))
		{
			$product_type = $params['product_type'];
			if($product_type == 1){
				$this->db->where("od.category_id" ,  4);
			}
			if($product_type == 2){
				$this->db->where("od.category_id" ,  2);
			}
			if($product_type == 3){
				$this->db->where_not_in("od.category_id" ,  array(2,4,1));
			}
		}
		
		$this->db->group_by("p.id");
		$this->db->group_by("c.id");
		$this->db->group_by("od.final_value");
		$this->db->group_by("od.product_quantity");
		
		//$this->db->limit(10);
		
		$query_get_list = $this->db->get();
		$result = $query_get_list->result();
		/*echo "<pre>";
		print_r($params);
		echo $this->db->last_query();
		echo "<br><br>";
		echo "count : ".count($result);
		exit();*/
		return $result;
	}
	
	
	function getOrderBookReports($params = array())
	{
		//$SQL = ""

		$this->db->select(" row_number() OVER() as `SL_NO`, branches.name as 'BRANCH',
											classes.name as 'CLASS',
											orders.order_number as 'ORDER_NO',
											date_format(orders.added_on, '%d-%m-%Y %H:%i') as 'DATE',
											orders.child_name as 'NAME_OF_THE_STUDENT',
											gender.name as 'GENDER',
											SUM(orders_details.final_value) as 'TOTAL_AMOUNT'");
		$this->db->from("orders");
		$this->db->join("orders_details" , "orders.orders_id = orders_details.orders_id");
		$this->db->join("branches" , "branches.id = orders.branch_id");
		$this->db->join("classes" , "classes.id = orders.class_id");
		$this->db->join("gender" , "gender.id = orders.gender_id");
		$this->db->where("orders_details.category_id" ,  4);
		$this->db->group_by("orders.orders_id,orders.child_id");

		// $books_query = $this->db->query("SELECT row_number() OVER() as `SL_NO`, branches.name as 'BRANCH',
		// 									classes.name as 'CLASS',
		// 									orders.order_number as 'ORDER_NO',
		// 									date_format(orders.added_on, '%d-%m-%Y %H:%i') as 'DATE',
		// 									orders.child_name as 'NAME_OF_THE_STUDENT',
		// 									gender.name as 'GENDER',
		// 									SUM(orders_details.final_value) as 'TOTAL_AMOUNT'
		// 									FROM orders
		// 									join orders_details on orders_details.orders_id = orders.orders_id and orders_details.category_id = 4
		// 									join branches on orders.branch_id = branches.id
		// 									join classes on orders.class_id = classes.id
		// 									join gender on orders.gender_id = gender.id
		// 									WHERE orders_details.category_id = 4
		// 									GROUP BY orders.orders_id, orders.child_id");

		if(!empty($params['from_date']))
		{
			$temp_date = date('Y-m-d' , strtotime($params['from_date']));
			$this->db->where("DATE_FORMAT(orders.book_issue_date, '%Y%m%d') >= DATE_FORMAT('$temp_date', '%Y%m%d')");
		}

		if(!empty($params['to_date']))
		{
			$temp_date = date('Y-m-d' , strtotime($params['to_date']));
			$this->db->where("DATE_FORMAT(orders.book_issue_date, '%Y%m%d') <= DATE_FORMAT('$temp_date', '%Y%m%d')");
		}
		if(!empty($params['branch_id']))
		{
			$this->db->where("orders.branch_id" ,  $params['branch_id']);
		}

		$query_get_list = $this->db->get();
		$result = $query_get_list->result();
		//$result = $books_query->result();
		//print_r($result);
	//	die;
		return $result;
	}
	function getOrderDialySalesReports($params = array())
	{
		$this->db->select("urm.*,od.*,sum(od.cart_quantity*od.product_quantity) as total_cart_quantity,p.hsn_code,t.tax_percentage,g.name as gender_name,ch.name as child_name,ch.father_name as father_name,b.name as branch_name,c.name as class_name");
		$this->db->from("orders as urm");
		$this->db->join("orders_details as od" , "urm.orders_id = od.orders_id");
		$this->db->join("product as p" , "p.id = od.product_id");
		$this->db->join("childrens as  ch" , "ch.id = urm.child_id");
		$this->db->join("branches as  b" , "b.id = urm.branch_id");
		$this->db->join("classes as  c" , "c.id = urm.class_id");
		$this->db->join("gender as  g" , "g.id = urm.gender_id");
		$this->db->join("tax as  t" , "t.id = p.tax_id");
		if(!empty($params['from_date']))
		{
			$temp_date = date('Y-m-d' , strtotime($params['from_date']));
			//$this->db->where("DATE_FORMAT(urm.added_on, '%Y%m%d') >= DATE_FORMAT('$temp_date', '%Y%m%d')");
			if(!empty($params['product_type']))
			{
				$product_type = $params['product_type'];
				if($product_type == 1){
					$this->db->where("DATE_FORMAT(urm.book_issue_date, '%Y%m%d') >= DATE_FORMAT('$temp_date', '%Y%m%d')");
				}
				if($product_type == 2){
					$this->db->where("DATE_FORMAT(urm.shoe_issue_date, '%Y%m%d') >= DATE_FORMAT('$temp_date', '%Y%m%d')");
				}
				if($product_type == 3){
					$this->db->where("DATE_FORMAT(urm.uniform_issue_date, '%Y%m%d') >= DATE_FORMAT('$temp_date', '%Y%m%d')");
				}
			}
		}

		if(!empty($params['to_date']))
		{
			$temp_date = date('Y-m-d' , strtotime($params['to_date']));
			if(!empty($params['product_type']))
			{
				$product_type = $params['product_type'];
				if($product_type == 1){
					$this->db->where("DATE_FORMAT(urm.book_issue_date, '%Y%m%d') <= DATE_FORMAT('$temp_date', '%Y%m%d')");
				}
				if($product_type == 2){
					$this->db->where("DATE_FORMAT(urm.shoe_issue_date, '%Y%m%d') <= DATE_FORMAT('$temp_date', '%Y%m%d')");
				}
				if($product_type == 3){
					$this->db->where("DATE_FORMAT(urm.uniform_issue_date, '%Y%m%d') <= DATE_FORMAT('$temp_date', '%Y%m%d')");
				}
			}
		}
		if(!empty($params['branch_id']))
		{
			$this->db->where("urm.branch_id" ,  $params['branch_id']);
		}
		if(!empty($params['product_type']))
		{
			$product_type = $params['product_type'];
			if($product_type == 1){
				$this->db->where("od.category_id" ,  4);
			}
			if($product_type == 2){
				$this->db->where("od.category_id" ,  2);
			}
			if($product_type == 3){
				$this->db->where_not_in("od.category_id" ,  array(2,4,1));
			}
		}
		$this->db->group_by("od.product_id");
		$query_get_list = $this->db->get();
		//echo $this->db->last_query();
		//die;
		$result = $query_get_list->result();
		// print_r($result);
		// die;
		return $result;
	}

	function getSalesReports($params = array())
	{
		if(!empty($params['last_12_month']))
		{
			$this->db->select("DATE_FORMAT(o.added_on, '%M-%Y') as f_date");
		}
		$this->db
		//->DISTINCT()
		->select('o.status, sum(o.final_value) as total ,  sum(o.total_gst) as total_gst , count(o.orders_id) as orders_count')
//		->select('o.order_status, sum(od.total) , sum(od.sub_total) , sum(od.total_gst) , sum(od.delivery_charges) , sum(od.prod_in_cart) , count(o.orders_id)')
		//->select('o.orders_id, od.orders_details_id')
		->from("orders as o")
		//->join("orders_details as od" , "o.orders_id = od.orders_id")
		//->join("product_category as pc" , "pc.product_id = od.product_id")
		//->join("category as c" , "c.category_id = pc.category_id")
		//->where("c.super_category_id" , 0)

		;

		//->join("stores as s" , "o.stores_id = s.stores_id");

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

		if(!empty($params['last_12_month']))
		{
			$temp_date = date('Y-m');
			$start_date = date('Y-m' , strtotime("-12 months"));
			//echo "temp_date : $temp_date".'<br>';
		//	echo "start_date : $start_date".'<br>';
			$this->db->where("DATE_FORMAT(o.added_on, '%Y%m') <= '$temp_date'");
			$this->db->where("DATE_FORMAT(o.added_on, '%Y%m') >= '$start_date'");
		}

		if(!empty($params['category_id']))
		{
			//WHERE DATE_FORMAT(AUCTION_DATE, '%Y%m%d') >= DATE_FORMAT('2013/5/18', '%Y%m%d')
		}
		if(!empty($params['group_by']))
		{
			$this->db->group_by($params['group_by']);
		}
		else
		{
			$this->db->group_by("o.status");
		}

		if(!empty($params['stores_id']))
			$this->db->where('o.stores_id' , $params['stores_id']);
		if(!empty($params['status']))
			$this->db->where('o.status' , $params['status']);
		$this->db->order_by('o.orders_id DESC');
		$result = $this->db->get()->result();
		//echo $this->db->last_query().'<br><br>';
		return $result;
	}

	function getSalesReportsMonthWise($params = array())
	{


		$this->db
		//->DISTINCT()
		->select("DATE_FORMAT(o.added_on, '%M-%Y') as f_date")
		->select('o.order_status, sum(o.total) as total , sum(o.discount) as discount , sum(o.total_gst) as total_gst , sum(o.delivery_charges) as delivery_charges , sum(o.total_prod) as total_prod, count(o.orders_id) as orders_count')
//		->select('o.order_status, sum(od.total) , sum(od.sub_total) , sum(od.total_gst) , sum(od.delivery_charges) , sum(od.prod_in_cart) , count(o.orders_id)')
		//->select('o.orders_id, od.orders_details_id')
		->from("orders as o")
		//->join("orders_details as od" , "o.orders_id = od.orders_id")
		//->join("product_category as pc" , "pc.product_id = od.product_id")
		//->join("category as c" , "c.category_id = pc.category_id")
		//->where("c.super_category_id" , 0)

		;

		//->join("stores as s" , "o.stores_id = s.stores_id");

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


		if(!empty($params['group_by']))
		{
			$this->db->group_by($params['group_by']);
		}
		else
		{
			$this->db->group_by("o.order_status");
		}

		if(!empty($params['stores_id']))
			$this->db->where('o.stores_id' , $params['stores_id']);
		if(!empty($params['order_status']))
		{
			if($params['order_status']=='zero'){$params['order_status'] = 0;}
			$this->db->where('o.order_status' , $params['order_status']);
		}
		$this->db->order_by('o.orders_id DESC');
		$result = $this->db->get()->result();
		echo $this->db->last_query().'<br><br>';
		return $result;
	}

	function getPaymentReports($params = array())
	{
		if(!empty($params['last_12_month']))
		{
			$this->db->select("DATE_FORMAT(o.added_on, '%M-%Y') as f_date");
		}
		$this->db
		//->DISTINCT()
		->select('o.order_status, sum(o.total) as total , sum(o.discount) as discount , sum(o.total_gst) as total_gst , sum(o.delivery_charges) as delivery_charges , sum(o.total_prod) as total_prod, count(o.orders_id) as orders_count')
		//		->select('o.order_status, sum(od.total) , sum(od.sub_total) , sum(od.total_gst) , sum(od.delivery_charges) , sum(od.prod_in_cart) , count(o.orders_id)')
		//->select('o.orders_id, od.orders_details_id')
		->from("orders as o")
		//->join("orders_details as od" , "o.orders_id = od.orders_id")
		//->join("product_category as pc" , "pc.product_id = od.product_id")
		//->join("category as c" , "c.category_id = pc.category_id")
		//->where("c.super_category_id" , 0)

		;

		//->join("stores as s" , "o.stores_id = s.stores_id");

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

		if(!empty($params['last_12_month']))
		{
			$temp_date = date('Y-m');
			$start_date = date('Y-m' , strtotime("-12 months"));
			//echo "temp_date : $temp_date".'<br>';
		//	echo "start_date : $start_date".'<br>';
			$this->db->where("DATE_FORMAT(o.added_on, '%Y%m') <= '$temp_date'");
			$this->db->where("DATE_FORMAT(o.added_on, '%Y%m') >= '$start_date'");
		}

		if(!empty($params['category_id']))
		{
			//WHERE DATE_FORMAT(AUCTION_DATE, '%Y%m%d') >= DATE_FORMAT('2013/5/18', '%Y%m%d')
		}
		if(!empty($params['group_by']))
		{
			$this->db->group_by($params['group_by']);
		}
		else
		{
			$this->db->group_by("o.order_status");
		}

		if(!empty($params['stores_id']))
			$this->db->where('o.stores_id' , $params['stores_id']);

		if(!empty($params['order_status']))
		{
			if($params['order_status']==6)
			{$this->db->where('o.order_status' , $params['order_status']);}
			else
			{$this->db->where('o.order_status !=6' );}
		}

		$this->db->order_by('o.orders_id DESC');
		$result = $this->db->get()->result();
		//echo $this->db->last_query().'<br><br>';
		return $result;
	}

	function getReviewReportCount($product_list_params){
		unset($product_list_params['limit']);
		unset($product_list_params['offset']);
		return $this->getReviewReport($product_list_params);
	}

	function getReviewReport($params = array())
	{
		$pg_content=array();
		$this->db->distinct();
		$this->db->select('r.product_id, r.review_id, c.name as customer_name, r.review_title, r.review, r.rating, r.status, r.liked_by, r.added_on, p.name');
		$this->db->from("$this->product_reviews_table_name as r");
		$this->db->join("$this->product_table_name AS p", 'p.product_id = r.product_id','left');
		$this->db->join("customers AS c", 'c.customers_id= r.customers_id','left');
		$this->db->order_by('r.review_id desc');

		if(!empty($params['start_date']))
		{
			$temp_date = date('Y-m-d' , strtotime($params['start_date']));
			$this->db->where("DATE_FORMAT(r.added_on, '%Y%m%d') >= DATE_FORMAT('$temp_date', '%Y%m%d')");
		}

		if(!empty($params['end_date']))
		{
			$temp_date = date('Y-m-d' , strtotime($params['end_date']));
			$this->db->where("DATE_FORMAT(r.added_on, '%Y%m%d') <= DATE_FORMAT('$temp_date', '%Y%m%d')");
		}

		if(!empty($params['field_value']) && !empty($params['field']))
		{
			$this->db->where("$params[field] like ('%$params[field_value]%')");
		}

		if(!empty($params['rating']))
		{
			$this->db->where("r.rating =  $params[rating]");
		}

		if(!empty($params['limit']) && !empty($params['offset'])){
			$this->db->limit($params['limit'] , $params['offset']);
		}
		else if(!empty($params['limit'])){
			$this->db->limit($params['limit']);
		}

		//$this->db->limit($num, $offset);
		$query_get_list = $this->db->get();
		//echo $this->db->last_query().'<br>';
		if($query_get_list->num_rows() > 0 )
		{
			foreach($query_get_list->result() as $row_get_list)
			{

				$pg_content[]=array("review_id"=>$row_get_list->review_id, "product_id"=>$row_get_list->product_id, "product_name"=>$row_get_list->name, "customer_name"=>$row_get_list->customer_name,"review_title"=>$row_get_list->review_title, "review"=>$row_get_list->review, "rating"=>$row_get_list->rating, "status"=>$row_get_list->status, "liked_by"=>$row_get_list->liked_by, "added_on"=>$row_get_list->added_on);
			}
		}
		return $pg_content;
	}

	function getLoginReportCount($product_list_params){
		unset($product_list_params['limit']);
		unset($product_list_params['offset']);
		return $this->getLoginReport($product_list_params);
	}

	function getLoginReport($params = array())
	{
		$pg_content=array();
		$this->db->distinct();
		$this->db->select('r.*, c.name as customer_name, c.email , c.number, co.country_name, co.country_code');
		$this->db->from("customers_login_log as r");
		$this->db->join("customers AS c", 'c.customers_id= r.customers_id','left');
		$this->db->join("country AS co", 'c.country_id= co.country_id','left');
		$this->db->order_by('r.customers_login_log_id desc');

		if(!empty($params['start_date']))
		{
			$temp_date = date('Y-m-d' , strtotime($params['start_date']));
			$this->db->where("DATE_FORMAT(r.login_on, '%Y%m%d') >= DATE_FORMAT('$temp_date', '%Y%m%d')");
		}

		if(!empty($params['end_date']))
		{
			$temp_date = date('Y-m-d' , strtotime($params['end_date']));
			$this->db->where("DATE_FORMAT(r.login_on, '%Y%m%d') <= DATE_FORMAT('$temp_date', '%Y%m%d')");
		}

		if(!empty($params['field_value']) && !empty($params['field']))
		{
			$this->db->where("$params[field] like ('%$params[field_value]%')");
		}

		if(!empty($params['screen']))
		{
			$this->db->where("r.screen =  $params[screen]");
		}

		if(!empty($params['limit']) && !empty($params['offset'])){
			$this->db->limit($params['limit'] , $params['offset']);
		}
		else if(!empty($params['limit'])){
			$this->db->limit($params['limit']);
		}

		//$this->db->limit($num, $offset);
		$query_get_list = $this->db->get();
		//echo $this->db->last_query().'<br>';
		if($query_get_list->num_rows() > 0 )
		{
			foreach($query_get_list->result() as $row_get_list)
			{

				$pg_content[]=array("customers_login_log_id"=>$row_get_list->customers_login_log_id, "customer_name"=>$row_get_list->customer_name,"country_name"=>$row_get_list->country_name, "country_code"=>$row_get_list->country_code, "email"=>$row_get_list->email,"screen"=>$row_get_list->screen, "login_on"=>$row_get_list->login_on, "ip"=>$row_get_list->ip, "number"=>$row_get_list->number);
			}
		}
		return $pg_content;
	}

	function getCouponReports($params = array())
	{
		if(!empty($params['last_12_month']))
		{
			$this->db->select("DATE_FORMAT(o.added_on, '%M-%Y') as f_date");
		}
		$this->db
		//->DISTINCT()
		->select('o.order_status,o.coupan_code, sum(o.total) as total , sum(o.sub_total) as sub_total , o.discount as discount , sum(o.total_gst) as total_gst , sum(o.delivery_charges) as delivery_charges , sum(o.total_prod) as total_prod, count(o.orders_id) as orders_count')
		//		->select('o.order_status, sum(od.total) , sum(od.sub_total) , sum(od.total_gst) , sum(od.delivery_charges) , sum(od.prod_in_cart) , count(o.orders_id)')
		//->select('o.orders_id, od.orders_details_id')
		->from("orders as o")
		//->join("orders_details as od" , "o.orders_id = od.orders_id")
		//->join("product_category as pc" , "pc.product_id = od.product_id")
		//->join("category as c" , "c.category_id = pc.category_id")
		//->where("c.super_category_id" , 0)

		;
		//$this->db->where("o.coupan_code != ''");
		$this->db->where("o.coupan_code != '0'");
		$this->db->where("o.order_status != 6");

		//->join("stores as s" , "o.stores_id = s.stores_id");

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

		if(!empty($params['last_12_month']))
		{
			$temp_date = date('Y-m');
			$start_date = date('Y-m' , strtotime("-12 months"));
			//echo "temp_date : $temp_date".'<br>';
		//	echo "start_date : $start_date".'<br>';
			$this->db->where("DATE_FORMAT(o.added_on, '%Y%m') <= '$temp_date'");
			$this->db->where("DATE_FORMAT(o.added_on, '%Y%m') >= '$start_date'");
		}

		if(!empty($params['category_id']))
		{
			//WHERE DATE_FORMAT(AUCTION_DATE, '%Y%m%d') >= DATE_FORMAT('2013/5/18', '%Y%m%d')
		}
		if(!empty($params['group_by']))
		{
			$this->db->group_by($params['group_by']);
		}
		else
		{
			$this->db->group_by("o.discount");
			$this->db->group_by("o.coupan_code");
		}

		if(!empty($params['stores_id']))
			$this->db->where('o.stores_id' , $params['stores_id']);

		if(!empty($params['order_status']))
		{
			if($params['order_status']==6)
			{$this->db->where('o.order_status' , $params['order_status']);}
			else
			{$this->db->where('o.order_status !=6' );}
		}

		$this->db->order_by('o.orders_id DESC');
		$result = $this->db->get()->result();
		//echo $this->db->last_query().'<br><br>';
		return $result;
	}

	function sales_report_by_status($params = array())
	{
		$this->db
		->select('o.* , s.name as store_name')
		->from("orders as o")
		->join("stores as s" , "o.stores_id = s.stores_id");

		if(!empty($params['stores_id']))
			$this->db->where('o.stores_id' , $params['stores_id']);
		if(!empty($params['order_status']))
		{
			if($params['order_status']=='zero'){$params['order_status']=0;}
			$this->db->where('o.order_status' , $params['order_status']);
		}

		if(!empty($params['field_value']) && !empty($params['field']))
		{
			$this->db->where("$params[field] like ('%$params[field_value]%')");
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

		if(!empty($params['category_id']))
		{
			//WHERE DATE_FORMAT(AUCTION_DATE, '%Y%m%d') >= DATE_FORMAT('2013/5/18', '%Y%m%d')
		}

		if(!empty($params['payment_order_status']))
		{
			if($params['payment_order_status']==6)
			{$this->db->where('o.order_status' , $params['payment_order_status']);}
			else
			{$this->db->where('o.order_status !=6' );}
		}

		$this->db->order_by('o.orders_id DESC');
		$result = $this->db->get()->result();
		//echo $this->db->last_query();
		return $result;
	}

	function getOrdersDetails($params = array())
	{
		$this->db
		->select('o.* , s.name as store_name , s.person_contact_name , s.person_contact_email , s.person_contact_number, s.person_contact_alt_number, s.store_contact_number , s.address as store_address' )//, c.city_name as store_city_name
		->from("orders as o")
		->join("stores as s" , "o.stores_id = s.stores_id")
		//->join("city as c" , "c.city_id = s.city_id")
		;
		if(!empty($params['orders_id']))
			$this->db->where('o.orders_id' , $params['orders_id']);
		if(!empty($params['stores_id']))
			$this->db->where('o.stores_id' , $params['stores_id']);
		$this->db->order_by('o.orders_id DESC');
		$result = $this->db->get();
		//echo $this->db->last_query();
		if($result->num_rows() > 0)
		{
			$result = $result->result();
			$this->db
			->select('od.*')
			->from("orders_details as od")
			->where("od.orders_id" , $result[0]->orders_id);
			$result1 = $this->db->get();
			if($result1->num_rows() > 0)
			{ $result[0]->details=$result1->result(); }
			else
			{ $result[0]->details=false; }
		}
		return $result;
	}

	function customers($params = array())
	{
		if(!empty($params['for_graph']))
		{
			$this->db->select('count(c.customers_id) as counts');
		}
		else
		{
			$this->db->select('c.* , con.country_name , con.country_code , con.country_short_name ');
		}
		$this->db
		->from('customers as c')
		->join('country as con' , "con.country_id = c.country_id");
		if(!empty($params['customers_id']))
			$this->db->where('customers_id' , $params['customers_id']);
		$this->db->order_by('customers_id DESC');
		if(!empty($params['start_date']))
		{
			$temp_date = date('Y-m-d' , strtotime($params['start_date']));
			$this->db->where("DATE_FORMAT(c.added_on, '%Y%m%d') >= DATE_FORMAT('$temp_date', '%Y%m%d')");
		}

		if(!empty($params['end_date']))
		{
			$temp_date = date('Y-m-d' , strtotime($params['end_date']));
			$this->db->where("DATE_FORMAT(c.added_on, '%Y%m%d') <= DATE_FORMAT('$temp_date', '%Y%m%d')");
		}

		if(!empty($params['c_ctatus']))
		{
			if($params['c_ctatus']==1)
			{ $this->db->where("c.status = 1"); }

			if($params['c_ctatus']==2)
			{ $this->db->where("c.status = 0"); }

		}

		if(!empty($params['task']))
		{
			if($params['task']=='details')
			{
				$result = $this->db->get()->result();
				$this->db
				->select('ca.* ,  c.city_name,  s.state_name')//l.location_name , l.location_pincode ,
				->from('customers_address as ca')
				//->join('location as l' , 'l.location_id=ca.location_id')
				->join('city as c' , 'c.city_id=ca.city_id')
				->join('state as s' , 's.state_id=ca.state_id')
				->where('ca.customers_id' , $result[0]->customers_id );
				$result[0]->details = $this->db->get()->result();
				return $result;
			}
			else
			{
				$result = $this->db->get()->result();
				return $result;
			}
		}
		else
		{
			$result = $this->db->get()->result();
			return $result;
		}
	}

	function getSalesReportsProductWise($params = array())
	{
		$search_cat_arr = array();
		$product_ids = '';
		if(!empty($params['category_id']))
		{$search_cat_arr[] = $params['category_id'];}
		if(!empty($params['sub_category_id']))
		{$search_cat_arr[] = $params['sub_category_id'];}
		if(!empty($search_cat_arr))
		{
			$search_cat = implode(',' , $search_cat_arr);
			$product_category = $this->Common_Model->getName(array('select'=>'*' , 'from'=>"product_category" , 'where'=>"category_id in ($search_cat)"));
			if(!empty($product_category))
			{
				$temp_arr = array();
				foreach($product_category as $pc)
				{
					$temp_arr[] = $pc->product_id;
				}
				$product_ids = implode(',' , $temp_arr);
			}
		}

		if(!empty($params['last_12_month']))
		{
			$this->db->select("DATE_FORMAT(o.added_on, '%M-%Y') as f_date");
		}
		$this->db
		//->DISTINCT()
		->select('o.order_status, sum(od.prod_in_cart) as cart_qty , sum(od.total) as total , count(o.orders_id) as orders_count')
//		->select('o.order_status, sum(od.total) , sum(od.sub_total) , sum(od.total_gst) , sum(od.delivery_charges) , sum(od.prod_in_cart) , count(o.orders_id)')
		->select('od.product_name , od.ref_code, od.manufacturer_name, od.combi, od.manufacturer_name')
		->from("orders_details as od")
		->join("orders as o", "o.orders_id = od.orders_id")
		//->join("product_category as pc" , "pc.product_id = od.product_id")
		//->join("category as c" , "c.category_id = pc.category_id")
		//->where("c.super_category_id" , 0)

		;

		//->join("stores as s" , "o.stores_id = s.stores_id");

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

		if(!empty($params['last_12_month']))
		{
			$temp_date = date('Y-m');
			$start_date = date('Y-m' , strtotime("-12 months"));
			//echo "temp_date : $temp_date".'<br>';
		//	echo "start_date : $start_date".'<br>';
			$this->db->where("DATE_FORMAT(o.added_on, '%Y%m') <= '$temp_date'");
			$this->db->where("DATE_FORMAT(o.added_on, '%Y%m') >= '$start_date'");
		}

		if(!empty($product_ids))
		{
			$this->db->where("od.product_id in ($product_ids)");
		}

		if(!empty($params['group_by']))
		{
			$this->db->group_by($params['group_by']);
		}
		else
		{
			$this->db->group_by("od.product_combination_id");
		}

		if(!empty($params['order_by']))
		{
			$this->db->order_by($params['order_by']);
		}
		else
		{
			$this->db->order_by("cart_qty DESC");
		}
		$this->db->where("o.order_status != 6");

		if(!empty($params['stores_id']))
			$this->db->where('o.stores_id' , $params['stores_id']);
		if(!empty($params['order_status']))
			$this->db->where('o.order_status' , $params['order_status']);
		$this->db->order_by('o.orders_id DESC');
		$result = $this->db->get()->result();
		//echo $this->db->last_query().'<br><br>';
		return $result;
	}

	function sales_audit_report($params = array())
	{
		$search_cat_arr = array();
		$product_ids = '';
		/*if(!empty($params['category_id']))
		{$search_cat_arr[] = $params['category_id'];}
		if(!empty($params['sub_category_id']))
		{$search_cat_arr[] = $params['sub_category_id'];}
		if(!empty($search_cat_arr))
		{
			$search_cat = implode(',' , $search_cat_arr);
			$product_category = $this->Common_Model->getName(array('select'=>'*' , 'from'=>"product_category" , 'where'=>"category_id in ($search_cat)"));
			if(!empty($product_category))
			{
				$temp_arr = array();
				foreach($product_category as $pc)
				{
					$temp_arr[] = $pc->product_id;
				}
				$product_ids = implode(',' , $temp_arr);
			}
		}

		if(!empty($params['last_12_month']))
		{
			$this->db->select("DATE_FORMAT(o.added_on, '%M-%Y') as f_date");
		}*/
		$this->db
		//->DISTINCT()
		->select('o.*')
		->from("orders as o");

		//->join("stores as s" , "o.stores_id = s.stores_id");

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

		if(!empty($params['last_12_month']))
		{
			$temp_date = date('Y-m');
			$start_date = date('Y-m' , strtotime("-12 months"));
			//echo "temp_date : $temp_date".'<br>';
		//	echo "start_date : $start_date".'<br>';
			$this->db->where("DATE_FORMAT(o.added_on, '%Y%m') <= '$temp_date'");
			$this->db->where("DATE_FORMAT(o.added_on, '%Y%m') >= '$start_date'");
		}

		if(!empty($product_ids))
		{
			//$this->db->where("od.product_id in ($product_ids)");
		}

		if(!empty($params['group_by']))
		{
			$this->db->group_by($params['group_by']);
		}


		if(!empty($params['order_by']))
		{
			$this->db->order_by($params['order_by']);
		}
		else
		{
			$this->db->order_by("o.orders_id ASC");
		}
		$this->db->where("o.order_status != 6");

		if(!empty($params['stores_id']))
			$this->db->where('o.stores_id' , $params['stores_id']);
		if(!empty($params['order_status']))
			$this->db->where('o.order_status' , $params['order_status']);
		$this->db->order_by('o.orders_id DESC');
		$result = $this->db->get()->result();
		//echo $this->db->last_query().'<br><br>';

		if(!empty($result))
		{
			foreach($result as $r)
			{
				$this->db
				->select('od.*')
				->from("orders_details as od")
				->where("od.orders_id" , $r->orders_id)
				;
				$r->details = $this->db->get()->result();
			}
		}

		return $result;
	}

	function sales_audit_detail_report($params = array())
	{
		$search_cat_arr = array();
		$product_ids = '';
		if(!empty($params['category_id']))
		{$search_cat_arr[] = $params['category_id'];}
		if(!empty($params['sub_category_id']))
		{$search_cat_arr[] = $params['sub_category_id'];}
		if(!empty($search_cat_arr))
		{
			$search_cat = implode(',' , $search_cat_arr);
			$product_category = $this->Common_Model->getName(array('select'=>'*' , 'from'=>"product_category" , 'where'=>"category_id in ($search_cat)"));
			if(!empty($product_category))
			{
				$temp_arr = array();
				foreach($product_category as $pc)
				{
					$temp_arr[] = $pc->product_id;
				}
				$product_ids = implode(',' , $temp_arr);
			}
		}

		if(!empty($params['last_12_month']))
		{
			$this->db->select("DATE_FORMAT(o.added_on, '%M-%Y') as f_date");
		}
		$this->db
		//->DISTINCT()
		->select('o.*, od.*')
		->from("orders_details as od")
		->join("orders as o", "o.orders_id = od.orders_id")
		;

		//->join("stores as s" , "o.stores_id = s.stores_id");

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

		if(!empty($params['last_12_month']))
		{
			$temp_date = date('Y-m');
			$start_date = date('Y-m' , strtotime("-12 months"));
			//echo "temp_date : $temp_date".'<br>';
		//	echo "start_date : $start_date".'<br>';
			$this->db->where("DATE_FORMAT(o.added_on, '%Y%m') <= '$temp_date'");
			$this->db->where("DATE_FORMAT(o.added_on, '%Y%m') >= '$start_date'");
		}

		if(!empty($product_ids))
		{
			//$this->db->where("od.product_id in ($product_ids)");
		}

		if(!empty($params['group_by']))
		{
			$this->db->group_by($params['group_by']);
		}


		if(!empty($params['order_by']))
		{
			$this->db->order_by($params['order_by']);
		}
		else
		{
			$this->db->order_by("o.orders_id ASC");
		}
		$this->db->where("o.order_status != 6");

		if(!empty($params['stores_id']))
			$this->db->where('o.stores_id' , $params['stores_id']);
		if(!empty($params['order_status']))
			$this->db->where('o.order_status' , $params['order_status']);
		$this->db->order_by('o.orders_id DESC');
		$result = $this->db->get()->result();
		//echo $this->db->last_query().'<br><br>';
		return $result;
	}

	function products($category, $id, $status='', $search1='', $search2='', $search3='', $search4='', $search5='', $search6='' , $params=array())
	{
		$pg_content = array();

		if($category == 'products_list')
		{
			$product_ids = '';
			if(!empty($params['category_id']))
			{$search_cat_arr[] = $params['category_id'];}
			if(!empty($params['sub_category_id']))
			{$search_cat_arr[] = $params['sub_category_id'];}
			if(!empty($search_cat_arr))
			{
				$search_cat = implode(',' , $search_cat_arr);
				$product_category = $this->Common_Model->getName(array('select'=>'*' , 'from'=>"product_category" , 'where'=>"category_id in ($search_cat)"));
				if(!empty($product_category))
				{
					$temp_arr = array();
					foreach($product_category as $pc)
					{
						$temp_arr[] = $pc->product_id;
					}
					$product_ids = implode(',' , $temp_arr);
				}
			}

			/*$this->db->where("status = 1 ");
			if(!empty($id))
			$this->db->where("product_id = '$id'");
			$query_get_list = $this->db->get($this->product_table_name);*/

			$sql_get_list="select p.product_id , p.tax_categories_id , p.tax_providers_id, p.manufacturer_id , p.name, p.status , p.ref_code , p.slug_url , p.short_description, p.added_on, m.manufacturer_name
			, (select tax_c.tax_categories_name from tax_categories as tax_c where tax_c.tax_categories_id = p.tax_categories_id ) as tax_categories_name
			, (select tax_p.tax_providers_percentage from tax_providers as tax_p where tax_p.tax_providers_id = p.tax_providers_id ) as tax_providers_percentage
			from product p , manufacturer as m where m.manufacturer_id=p.manufacturer_id   ";

			if(!empty($params))
			{
				if(!empty($params['field']) && !empty($params['field_value']))
				{
					if($params['field']=='p.name')
					{
						$sql_get_list.=" and $params[field] like ('%$params[field_value]%') ";
					}

				}
			}

			if(!empty($product_ids))
			{
				$sql_get_list.=" and p.product_id in ($product_ids) ";
			}



				$query_get_list=$this->db->query($sql_get_list);
				{
						if($query_get_list->num_rows() > 0 )
						{
								foreach($query_get_list->result() as $row_get_list)
								{
									$content_product_combination=array();
								$sql_get_list1="select pc.* , pi.product_image_name  from product_combination as pc , product_image as pi  where pc.product_id=$row_get_list->product_id and pi.product_image_id = pc.product_image_id  ";//echo $sql_get_list1."<br>";

								if(!empty($params['start_date']))
								{
									$temp_date = date('Y-m-d' , strtotime($params['start_date']));
									$sql_get_list1.=" and DATE_FORMAT(pc.added_on, '%Y%m%d') >= DATE_FORMAT('$temp_date', '%Y%m%d')";
								}

								if(!empty($params['end_date']))
								{
									$temp_date = date('Y-m-d' , strtotime($params['end_date']));
									$sql_get_list1.=" and DATE_FORMAT(pc.added_on, '%Y%m%d') <= DATE_FORMAT('$temp_date', '%Y%m%d')";
								}


								if(!empty($params['p_status']))
								{
									if($params['p_status']==1)
									{
										$sql_get_list1.=" and pc.status = 1 ";
									}
									else if($params['p_status']=='zero')
									{
										$sql_get_list1.=" and pc.status = 0 ";
									}
								}

								$sql_get_list1.="  order by pc.default_combination DESC ";//echo $sql_get_list1."<br>";

								$query_get_list1=$this->db->query($sql_get_list1);
								$content_product_combination = array();
									if($query_get_list1->num_rows() > 0 )
									{
										foreach($query_get_list1->result() as $row_get_list1)
										{

											$wishlist=0;
											$cart=0;
											$total_stock=0;
											$sold=array();
											$reviews=array();


											if($params['is_wishlist']==1){
												$this->db
												->select("count(temp_wishlist_id) as counts")
												->from("temp_wishlist as tew")
												->where("tew.product_id" , $row_get_list->product_id)
												->where("tew.product_combination_id" , $row_get_list1->product_combination_id);
												$get_wishlist=$this->db->get()->result();
												$wishlist=$get_wishlist[0]->counts;
											}

											if($params['is_cart']==1){
												$this->db
												->select("sum(quantity) as counts")
												->from("temp_cart as tew")
												->where("tew.product_id" , $row_get_list->product_id)
												->where("tew.product_combination_id" , $row_get_list1->product_combination_id);
												if(!empty($params['cart_start_date']))
												{
													$temp_date = date('Y-m-d' , strtotime($params['cart_start_date']));
													$this->db->where("DATE_FORMAT(tew.updated_on, '%Y%m%d') >= DATE_FORMAT('$temp_date', '%Y%m%d')");
												}

												if(!empty($params['cart_end_date']))
												{
													$temp_date = date('Y-m-d' , strtotime($params['cart_end_date']));
													$this->db->where("DATE_FORMAT(tew.updated_on, '%Y%m%d') <= DATE_FORMAT('$temp_date', '%Y%m%d')");
												}
												$get_wishlist=$this->db->get()->result();
												$cart=$get_wishlist[0]->counts;
												if(empty($cart)){$cart=0;}

											}

											if($params['is_sold']==1){
												$this->db
												->select('o.order_status, sum(od.prod_in_cart) as cart_qty , sum(od.total) as total , count(o.orders_id) as orders_count')
												->select('od.product_name , od.ref_code, od.manufacturer_name, od.combi, od.manufacturer_name')
												->from("orders_details as od")
												->join("orders as o", "o.orders_id = od.orders_id")
												->where("od.product_id" , $row_get_list->product_id)
												->where("od.product_combination_id" , $row_get_list1->product_combination_id)
												->group_by('o.order_status');
												$sold=$this->db->get()->result();
											}

											if($params['is_review']==1){
												$this->db->distinct();
												$this->db->select('count(r.review_id) as total_count, r.review_id, r.rating, r.status, r.liked_by');
												$this->db->from("product_reviews as r");
												$this->db->where("r.product_id" , $row_get_list->product_id);
												$this->db->where("r.product_combination_id" , $row_get_list1->product_combination_id);
												$this->db->group_by("r.rating");
												$reviews=$this->db->get()->result();
											}

											if($params['is_in_stock']==1){
												$this->db->select('*');
												$this->db->from("product_in_store as r");
												$this->db->where("r.product_id" , $row_get_list->product_id);
												$this->db->where("r.product_combination_id" , $row_get_list1->product_combination_id);
												$res=$this->db->get()->result();
												$total_stock = $res[0]->quantity;
											}
										//	echo "<pre>";print_r($reviews);echo "</pre>";


											$sql_get_list2="select pca.* , pa.name as a_name , pav.name as v_name from product_combination_attribute as pca , product_attribute as pa , product_attribute_value pav where product_combination_id=$row_get_list1->product_combination_id and pca.product_attribute_id=pa.product_attribute_id and pca.product_attribute_value_id =pav.product_attribute_value_id and pav.product_attribute_id=pa.product_attribute_id ";



												$query_get_list2=$this->db->query($sql_get_list2);
												{
													$combi="";
													if($query_get_list2->num_rows() > 0 )
													{
														foreach($query_get_list2->result() as $row_get_list2)
														{
															//$pg_content[]=array("product_combination_attribute_id"=>$row_get_list->product_combination_attribute_id,"product_id"=>$row_get_list->product_id	,"product_combination_id"=>$row_get_list->product_combination_id,"product_attribute_id"=>$row_get_list->product_attribute_id,"product_attribute_value_id"=>$row_get_list->product_attribute_value_id,"combination_value"=>$row_get_list->combination_value);
															if(!empty($row_get_list2->combination_value))
																$combi .= "$row_get_list2->combination_value";
															if(!empty($row_get_list2->v_name))
																$combi .= "&nbsp;$row_get_list2->v_name";

															$combi .= ", ";
															//echo $combi.'<br>';
														}
													}
												}


											$combi = trim($combi , ', ');


											$content_product_combination[]=array("product_combination_id"=>$row_get_list1->product_combination_id,"product_id"=>$row_get_list1->product_id	,"ref_code"=>$row_get_list1->ref_code,"quantity"=>$row_get_list1->quantity,"price"=>$row_get_list1->price,"discount"=>$row_get_list1->discount,"discount_var"=>$row_get_list1->discount_var,"final_price"=>$row_get_list1->final_price,"status"=>$row_get_list1->status,"added_on"=>$row_get_list1->added_on,"updated_on"=>$row_get_list1->updated_on,"product_image_id"=>$row_get_list1->product_image_id,"default_combination"=>$row_get_list1->default_combination,"comb_slug_url"=>$row_get_list1->comb_slug_url,"product_weight"=>$row_get_list1->product_weight,"product_dimension"=>$row_get_list1->product_dimension,"product_image_name"=>$row_get_list1->product_image_name,"product_display_name"=>$row_get_list1->product_display_name,"combi"=>$combi,"wishlist"=>$wishlist,"cart"=>$cart,"sold"=>$sold,"reviews"=>$reviews,"total_stock"=>$total_stock);
										}

										//$pg_content[]=array("product_id"=>$row_get_list->product_id,"manufacturer_id"=>$row_get_list->manufacturer_id	,"name"=>$row_get_list->name,"ref_code"=>$row_get_list->ref_code,"slug_url"=>$row_get_list->slug_url,"short_description"=>$row_get_list->short_description,"manufacturer_name"=>$row_get_list->manufacturer_name,"product_combination"=>$content_product_combination,"added_on"=>$row_get_list->added_on,"status"=>$row_get_list->status);

									}
									$pg_content[]=array("product_id"=>$row_get_list->product_id,"manufacturer_id"=>$row_get_list->manufacturer_id	,"tax_categories_name"=>$row_get_list->tax_categories_name	,
									"tax_providers_percentage"=>$row_get_list->tax_providers_percentage	,
									"tax_categories_id"=>$row_get_list->tax_categories_id	,
									"tax_providers_id"=>$row_get_list->tax_providers_id	,"name"=>$row_get_list->name,"ref_code"=>$row_get_list->ref_code,"slug_url"=>$row_get_list->slug_url,"short_description"=>$row_get_list->short_description,"manufacturer_name"=>$row_get_list->manufacturer_name,"product_combination"=>$content_product_combination,"added_on"=>$row_get_list->added_on,"status"=>$row_get_list->status);
								}
						}
				}

			return $pg_content;
		}
		 if($category == 'product_detail')
		{
			$sql_get_list="select p.* , (select Un.login_id from ks_login_detail as Un where p.updated_by != 0 and p.updated_by = Un.user_id) as updated_by_name , (select Un.login_id from ks_login_detail as Un where p.added_by != 0 and p.added_by = Un.user_id) as added_by_name from product p where 1  ";
			if(!empty($id)){
				$sql_get_list.= " and p.product_id=$id ";
			}
			$query_get_list=$this->db->query($sql_get_list);
			{
				if($query_get_list->num_rows() > 0 )
				{
					foreach($query_get_list->result() as $row_get_list)
					{
						$pg_content[]=array("product_id"=>$row_get_list->product_id,"manufacturer_id"=>$row_get_list->manufacturer_id	,"name"=>$row_get_list->name,"ref_code"=>$row_get_list->ref_code,"slug_url"=>$row_get_list->slug_url,"short_description"=>$row_get_list->short_description,"description"=>$row_get_list->description,"how_to_use"=>$row_get_list->how_to_use,"tax_categories_id"=>$row_get_list->tax_categories_id,"tax_providers_id"=>$row_get_list->tax_providers_id,"hsn_code"=>$row_get_list->hsn_code
						,"added_on"=>$row_get_list->added_on,"updated_on"=>$row_get_list->updated_on,"added_by"=>$row_get_list->added_by,"updated_by"=>$row_get_list->updated_by,"status"=>$row_get_list->status,"updated_by_name"=>$row_get_list->updated_by_name,"added_by_name"=>$row_get_list->added_by_name);
					}
				}
		    }
			return $pg_content;
		}

		if($category == 'product_category_detail')
		{
			$sql_get_list="select * from product_category where product_id=$id ";
			$query_get_list=$this->db->query($sql_get_list);
			{
				if($query_get_list->num_rows() > 0 )
				{
					foreach($query_get_list->result() as $row_get_list)
					{
						$pg_content[]=array("product_category_id"=>$row_get_list->product_category_id,"product_id"=>$row_get_list->product_id	,"category_id"=>$row_get_list->category_id);
					}
				}
		    }
			return $pg_content;
		}

		if($category == 'product_image_detail')
		{
			$sql_get_list="select pi.* , (select count(pc.product_combination_id) from product_combination as pc where pc.product_image_id=pi.product_image_id) as img_count from product_image as pi where pi.product_id=$id order by pi.position ASC";
			$query_get_list=$this->db->query($sql_get_list);
			{
				if($query_get_list->num_rows() > 0 )
				{
					foreach($query_get_list->result() as $row_get_list)
					{
						$pg_content[]=array("product_image_id"=>$row_get_list->product_image_id,"product_id"=>$row_get_list->product_id	,"product_image_name"=>$row_get_list->product_image_name,"status"=>$row_get_list->status,"added_on"=>$row_get_list->added_on,"updated_on"=>$row_get_list->updated_on,"default_image"=>$row_get_list->default_image,"position"=>$row_get_list->position,"img_count"=>$row_get_list->img_count);
					}
				}
		    }
			return $pg_content;
		}

		if($category == 'product_combination_detail')
		{
			$sql_get_list="select * from product_combination where product_id=$id ";
			$query_get_list=$this->db->query($sql_get_list);
			{
				if($query_get_list->num_rows() > 0 )
				{
					foreach($query_get_list->result() as $row_get_list)
					{
						$pg_content[]=array("product_combination_id"=>$row_get_list->product_combination_id,"product_id"=>$row_get_list->product_id	,"ref_code"=>$row_get_list->ref_code,"quantity"=>$row_get_list->quantity,"product_weight"=>$row_get_list->product_weight,"product_dimension"=>$row_get_list->product_dimension,"price"=>$row_get_list->price,"discount"=>$row_get_list->discount,"discount_var"=>$row_get_list->discount_var,"final_price"=>$row_get_list->final_price,"status"=>$row_get_list->status,"added_on"=>$row_get_list->added_on,"updated_on"=>$row_get_list->updated_on,"product_image_id"=>$row_get_list->product_image_id,"default_combination"=>$row_get_list->default_combination,"comb_slug_url"=>$row_get_list->comb_slug_url,"trending_now"=>$row_get_list->trending_now,"hot_selling_now"=>$row_get_list->hot_selling_now,"best_sellers"=>$row_get_list->best_sellers,"new_product"=>$row_get_list->new_product,"product_l"=>$row_get_list->product_l,"product_b"=>$row_get_list->product_b,"product_h"=>$row_get_list->product_h,"current_viewers_msg"=>$row_get_list->current_viewers_msg,"current_sold_msg"=>$row_get_list->current_sold_msg,"is_msg_dynamic"=>$row_get_list->is_msg_dynamic,"product_display_name"=>$row_get_list->product_display_name,"delivery_charges"=>$row_get_list->delivery_charges);
					}
				}
		    }
			return $pg_content;
		}

		if($category == 'product_combination_attribute_detail')
		{
			$sql_get_list="select * from product_combination_attribute where product_id=$id ";
			$query_get_list=$this->db->query($sql_get_list);
			{
				if($query_get_list->num_rows() > 0 )
				{
					foreach($query_get_list->result() as $row_get_list)
					{
						$pg_content[]=array("product_combination_attribute_id"=>$row_get_list->product_combination_attribute_id,"product_id"=>$row_get_list->product_id	,"product_combination_id"=>$row_get_list->product_combination_id,"product_attribute_id"=>$row_get_list->product_attribute_id,"product_attribute_value_id"=>$row_get_list->product_attribute_value_id,"combination_value"=>$row_get_list->combination_value);
					}
				}
		    }
			return $pg_content;
		}

		if($category == 'product_use_info_value_detail')
		{
			$sql_get_list="select * from product_use_info_value as puiv , product_use_info as pui where puiv.product_id=$id and pui.product_use_info_id=puiv.product_use_info_id";
			$query_get_list=$this->db->query($sql_get_list);
			{
				if($query_get_list->num_rows() > 0 )
				{
					foreach($query_get_list->result() as $row_get_list)
					{
						$pg_content[]=array("product_use_info_value_id"=>$row_get_list->product_use_info_value_id,"product_id"=>$row_get_list->product_id	,"product_use_info_id"=>$row_get_list->product_use_info_id,"content"=>$row_get_list->content,"image"=>$row_get_list->image);
					}
				}
		    }
			return $pg_content;
		}

		if($category == 'product_seo_detail')
		{
			$sql_get_list="select * from product_seo where product_id=$id ";
			$query_get_list=$this->db->query($sql_get_list);
			{
				if($query_get_list->num_rows() > 0 )
				{
					foreach($query_get_list->result() as $row_get_list)
					{
						$pg_content[]=array("product_seo_id"=>$row_get_list->product_seo_id,"product_id"=>$row_get_list->product_id	,"product_combination_id"=>$row_get_list->product_combination_id,"store_id"=>$row_get_list->store_id,"product_in_store_id"=>$row_get_list->product_in_store_id,"slug_url"=>$row_get_list->slug_url,"meta_title"=>$row_get_list->meta_title,"meta_description"=>$row_get_list->meta_description,"meta_keywords"=>$row_get_list->meta_keywords,"others"=>$row_get_list->others,"added_on"=>$row_get_list->added_on,"added_by"=>$row_get_list->added_by,"updated_by"=>$row_get_list->updated_by,"updated_on"=>$row_get_list->updated_on);
					}
				}
		    }
			return $pg_content;
		}
	}

	function getTempReports($params = array())
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

	function getTempReportsDetails($params = array())
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

	function cart_detail($params = array())
	{
		$this->db
//		->DISTINCT("tew.application_sess_temp_id")
		->select("tew.*")
		->from("temp_cart as tew")
		->group_by("tew.application_sess_temp_id");
		if(!empty($params['cart_start_date']))
		{
			$temp_date = date('Y-m-d' , strtotime($params['cart_start_date']));
			$this->db->where("DATE_FORMAT(tew.updated_on, '%Y%m%d') >= DATE_FORMAT('$temp_date', '%Y%m%d')");
		}

		if(!empty($params['cart_end_date']))
		{
			$temp_date = date('Y-m-d' , strtotime($params['cart_end_date']));
			$this->db->where("DATE_FORMAT(tew.updated_on, '%Y%m%d') <= DATE_FORMAT('$temp_date', '%Y%m%d')");
		}
		$cart_data=$this->db->get()->result();
		return $cart_data;
	}
}

?>
