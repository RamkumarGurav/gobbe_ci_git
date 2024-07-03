<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once(APPPATH."controllers/secureRegions/Main.php");
class Orders_Module extends Main
{
	function __construct()
	{
        parent::__construct();
		$this->load->database();
		$this->load->library('session');
		$this->load->model('Common_Model');
		$this->load->model('administrator/Admin_Common_Model');
		$this->load->model('administrator/Admin_model');
		$this->load->model('administrator/orders/Orders_Model');
		$this->load->library('pagination');

		$this->load->library('User_auth');

		$session_uid = $this->data['session_uid']=$this->session->userdata('session_uid');
		$this->data['session_uname']=$this->session->userdata('session_uname');
		$this->data['session_uemail']=$this->session->userdata('session_uemail');
		$this->data['page_module_name']='Orders';
		$this->data['table_name']= 'orders';
		$this->data['page_module_id'] = 20;
		$this->load->helper('url');
		$this->data['User_auth_obj'] = new User_auth();
		$this->load->library('Set_Order_Status_Lib');
			$this->_sosl = $this->data['_sosl'] = new Set_Order_Status_Lib();
			$this->data['backend_sess_id'] = 1;
		//$this->data['user_data'] = $this->data['User_auth_obj']->check_user_status();
		$this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate, no-transform, max-age=0, post-check=0, pre-check=0");
		$this->output->set_header("Pragma: no-cache");

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

	function index()
	{
		parent::get_header();
		parent::get_left_nav();
		$this->load->view('admin/orders/Order_Module/list' , $this->data);
		parent::get_footer();
	}

	function listing()
	{
		$this->data['page_type'] = "list";

		$this->data['user_access'] = $this->data['User_auth_obj']->check_user_access(array("module_id"=>$this->data['page_module_id']));
		//print_r($this->data['user_access']);
		if(empty($this->data['user_access']))
		{
			REDIRECT(MAINSITE_Admin."wam/access-denied");
		}
		$search = array();
		$field_name = 'urm.name';
		$field_value = $end_date = $start_date = $is_cod = $order_status_id =  '';


		if(!empty($_REQUEST['field_name']))
			$field_name = $_POST['field_name'];
		else if(!empty($field_name))
			$field_name = $field_name;

			if(!empty($_POST['end_date']))
	$end_date = $_POST['end_date'];

			if(!empty($_POST['is_cod']))
	$is_cod = $_POST['is_cod'];

			if(!empty($_POST['order_status_id']))
	$order_status_id = $_POST['order_status_id'];

	if(!empty($_POST['start_date']))
	$start_date = $_POST['start_date'];

		if(!empty($_REQUEST['field_value']))
			$field_value = $_POST['field_value'];
		else if(!empty($field_value))
			$field_value = $field_value;




		$this->data['field_name'] = $field_name;
		$this->data['field_value'] = $field_value;
		$this->data['end_date'] = $end_date;
			$this->data['start_date'] = $start_date;
			$this->data['is_cod'] = $is_cod;
			$this->data['order_status_id'] = $order_status_id;

		$search['field_value'] = $field_value;
		$search['field_name'] = $field_name;
		$search['end_date'] = $end_date;
	$search['start_date'] = $start_date;
	$search['order_status_id'] = $order_status_id;
	$search['is_cod'] = $is_cod;

		$search['search_for'] = "count";

		$data_count = $this->Orders_Model->getData($search);
		$r_count = $this->data['row_count'] = $data_count[0]->counts;

		unset($search['search_for']);

		$offset = (int)$this->uri->segment(5); //echo $offset;
		if($offset == "")
		{
			$offset ='0' ;
		}
		$per_page = _all_pagination_;

		$this->load->library('pagination');
		//$config['base_url'] =MAINSITE.'secure_region/reports/DispatchedOrders/'.$module_id.'/';

		$config['base_url'] =MAINSITE_Admin.$this->data['user_access']->class_name.'/'.$this->data['user_access']->function_name.'/';
		$config['total_rows'] = $r_count;
		$config['uri_segment'] = '5';
		$config['per_page'] = $per_page;
		$config['num_links'] = 4;
		$config['first_link'] = '&lsaquo; First';
		$config['last_link'] = 'Last &rsaquo;';
		$config['prev_link'] = 'Prev';
		$config['full_tag_open'] = '<p>';
		$config['full_tag_close'] = '</p>';
		$config['attributes'] = array('class' => 'paginationClass');


		$this->pagination->initialize($config);

		$this->data['page_is_master'] = $this->data['user_access']->is_master;
		$this->data['page_parent_module_id'] = $this->data['user_access']->parent_module_id;

		//$search['limit'] = $per_page;
		$search['offset'] = $offset;
		$this->data['list_data'] = $this->Orders_Model->getData($search);

		// echo $this->db->last_query();
		// die();
		parent::get_header();
		parent::get_left_nav();
		$this->load->view('admin/orders/Order_Module/listing' , $this->data);
		parent::get_footer();
	}

	public function cancelshipment()
	{
		$this->data['awb_no'] = '14344941397657';
		parent::get_header();
		parent::get_left_nav();
		$this->load->view('admin/orders/Order_Module/cancel' , $this->data);
		parent::get_footer();
	}
	public function details($orders_id)
	{
		$this->data['page_type'] = "list";

		$this->data['user_access'] = $this->data['User_auth_obj']->check_user_access(array("module_id"=>$this->data['page_module_id']));
		//print_r($this->data['user_access']);
		if(empty($this->data['user_access']))
		{
			$alert_message = 'Access Denied';
			echo json_encode(array("status"=>0, "return_code"=>"3", "message"=>$alert_message, ));
			exit;
		}
		$search = array();

		$search['orders_id'] = $orders_id;


		$this->data['list_data'] = $this->Orders_Model->getOrdersDetails($search);
		$this->data['list_data']  = $this->data['list_data'][0];
		$module_html = $this->load->view('admin/orders/Order_Module/detail' , $this->data,true);
		echo json_encode(array('module_data'=>$module_html));
		exit;
	}
	function shipping_service_api()
{
	$orders_id = $_POST['orders_id'];
	//$orders_id = 15;
	$this->data['orders_detail']=$this->Orders_Model->getOrdersDetails(array("orders_id"=>$orders_id , "stores_id"=>1));
	//print_r($this->data['orders_detail']);
	$pageData['currentPageName']=$uriid=$this->uri->segment(1);
	$this->load->view('admin/orders/Order_Module/shipping_service_api' , $this->data);
}
function assign_order_awb_api()
{
	$orders_id = $_POST['orders_id'];
	//$orders_id = 15;
	$this->data['orders_detail']=$this->Orders_Model->getOrdersDetails(array("orders_id"=>$orders_id , "stores_id"=>$this->data['backend_sess_id']));
	//print_r($this->data['orders_detail']);
	$pageData['currentPageName']=$uriid=$this->uri->segment(1);
	$this->load->view('admin/orders/Order_Module/assign_order_awb_api' , $this->data);
}
function update()
{
	if(isset($_POST['OrderStatusBTN']) || 1)
	{
		$orders_id = $_POST['orders_id'];
		$order_number = $_POST['order_number'];
		$order_status = $_POST['order_status'];
		//$sosl_remarks = $reason = nl2br($_POST['reason']);
		$sosl_remarks = $reason = '';
		$delivered_on='';

		$sosl_order_status_id = 1;
		$sosl_caption = '';
		$this->data['orders'] = $this->Orders_Model->getOrdersDetails(array("orders_id"=>$orders_id , "stores_id"=>$this->data['backend_sess_id']));
		//print_r($this->data['orders']);
		$o = $this->data['orders'][0];
		if(empty($reason)){$reason=NULL;}
		if($order_status==1)
		{
			$sosl_order_status_id = 1;
			$sosl_caption = 'Order Placed';
			$subject_order_status = "Order Placed";
			$subject = "Your $subject_order_status Successfully. Order No.: $o->order_number "._brand_name_;
			$mail_message = "Your The "._brand_name_." <strong>Order</strong>&nbsp;<strong>$o->order_number</strong> has been placed successfully.<br>We will update you the order processing action.";
			$template = "Dear $o->name, your "._brand_name_." order is confirmed. Your order id is $o->order_number. For more details login to your account "._SMS_BRAND_."";
		}
		if($order_status==2)
		{
			$sosl_order_status_id = 2;
			$sosl_caption = 'In Process';
			$subject_order_status = "In Process";
			$subject = "your "._brand_name_." order is in Processing State. Order No.: $o->order_number "._brand_name_."";
			$mail_message = "Your The "._brand_name_." <strong>Order</strong>&nbsp;<strong>$o->order_number</strong> is in Processing State.<br>We will update you the order processing action.";
			$template = "Dear $o->name, your "._brand_name_." order is in process. Your order id is $o->order_number. For more details login to your account "._SMS_BRAND_."";
		}
		if($order_status==3)
		{
			$sosl_order_status_id = 3;
			$sosl_caption = 'has been shipped';
			$subject_order_status = "has been shipped";
			$subject = "Your Order $subject_order_status. Order No.: $o->order_number !"._brand_name_."";
			$mail_message = "Your The "._brand_name_." <strong>Order</strong>&nbsp;<strong>$o->order_number</strong> has been shipped.<br>$reason";
			if(!empty($o->docket_no) && !empty($o->courier_name))
			{
				$mail_message .= "<br>Docket No. : ".$o->docket_no;
				$mail_message .= "<br>Shipped From : ".$o->courier_name;
			}
			$mail_message .= "<br>Will update you the order processing action.";
			$template = "Dear $o->name, your "._brand_name_." order is out for delivery. Your order id is $o->order_number. For more details login to your account "._SMS_BRAND_."";
			//$template = "Dear $o->name, your order has been shipped. Your order id is $o->order_number. For more details login to your account "._SMS_BRAND_."";

			// if(isset($_FILES["order_invoice"]['name']))
			// {
			// 	//echo "Test";
			// 	$timg_name = $_FILES['order_invoice']['name'];
			// 	if(!empty($timg_name))
			// 	{
			// 		//$deleteImgStatus = $this->admin_tbl->delete($image_id,'delete_prod_images'); //echo $insertStatus;
			// 		$end = explode(".",strtolower($timg_name));
			// 		$timage_ext = end($end);
			// 		if($timage_ext=='pdf' || $timage_ext=='PDF')
			// 		{
			// 			$timage_name_new = time().'-'.$orders_id.".".$timage_ext;
			//
			// 			$orderUpdateInvData['order_invoice'] = $timage_name_new;
			// 			$imginsertStatus = $this->Common_Model->update_operation(array('table'=>'orders' , 'data'=>$orderUpdateInvData , 'condition'=>"(orders_id=$orders_id)"));
			// 			//echo $this->db->last_query();
			// 			if($imginsertStatus)
			// 			{
			// 				$msg='success';
			// 				move_uploaded_file($_FILES['order_invoice']['tmp_name'],"assets/uploads/invoice/".$timage_name_new);
			// 			}
			// 			else
			// 			{
			// 				$this->session->set_flashdata('message', '<div class=" alert alert-danger">Something went wrong. Please try again.</div>');
			// 				REDIRECT(MAINSITE.'secureRegions/orders/Orders_Module/details/'.$orders_id);
			// 			}
			// 		}
			// 		else
			// 		{
			// 			$this->session->set_flashdata('message', '<div class=" alert alert-danger">Upload the invoice in pdf format.</div>');
			// 			REDIRECT(MAINSITE.'secureRegions/orders/Orders_Module/details/'.$orders_id);
			// 		}
			// 	}
			// 	else
			// 	{
			// 		$this->session->set_flashdata('message', '<div class=" alert alert-danger">Upload the invoice.</div>');
			// 		REDIRECT(MAINSITE.'secureRegions/orders/Orders_Module/details/'.$orders_id);
			// 	}
			// }
			// else
			// {
			// 	$this->session->set_flashdata('message', '<div class=" alert alert-danger">Upload the invoice.</div>');
			// 	REDIRECT(MAINSITE.'secureRegions/orders/Orders_Module/details/'.$orders_id);
			// }

		}
		if($order_status==4)
		{
			$delivered_on = "<br>Delivered on <strong>".date("d M y")."</strong>";
			$sosl_order_status_id = 4;
			$sosl_caption = 'Delivered';
			$subject_order_status = "Delivered";
			$subject = "Your Order $subject_order_status Successfully. Order No.: $o->order_number !"._brand_name_."";
			$mail_message = "Your "._brand_name_." <strong>Order</strong>&nbsp;<strong>$o->order_number</strong> has been Delivered successfully.<br>";
			$template = "Dear $o->name, your "._brand_name_." order is delivered successfully. Your order id is $o->order_number. For more details login to your account "._SMS_BRAND_."";
		}
		if($order_status==5)
		{
			$sosl_order_status_id = 5;
			$sosl_caption = 'Not Deliver';
			$subject_order_status = "Not Deliver";
			$subject = "Your Order $subject_order_status. Order No.: $o->order_number !"._brand_name_."";
			$mail_message = "Your "._brand_name_." <strong>Order</strong>&nbsp;<strong>$o->order_number</strong> has not been Delivered.<br>$reason.";
			$template = "Dear $o->name, your "._brand_name_." order is not delivered. Your order id is $o->order_number. For more details login to your account "._SMS_BRAND_."";
		}
		if($order_status==6)
		{
			$sosl_order_status_id = 6;
			$sosl_caption = 'Cancel';
			$subject_order_status = "Cancel";
			$subject = "Your Order has been $subject_order_status. Order No.: $o->order_number !"._brand_name_."";
			$mail_message = "Your "._brand_name_." <strong>Order</strong>&nbsp;<strong>$o->order_number</strong> has been Cancel.<br>$reason";
			$template = "Dear $o->name, your "._brand_name_." order is cancelled. Your order id is $o->order_number. For more details login to your account "._SMS_BRAND_."";
		}

		$orderUpdateData['updated_on'] = date("Y-m-d H:i:s");
		$orderUpdateData['reason'] = $reason;
		$orderUpdateData['order_status'] = $order_status;
		$orderUpdateData['order_status_id'] = $sosl_order_status_id;
		$UpdateStatus=$this->Common_Model->update_operation(array('table'=>'orders' , 'data'=>$orderUpdateData , 'condition'=>"(orders_id=$orders_id)"));
		if($UpdateStatus)
		{
			$this->session->set_flashdata('message', "<div class=' alert alert-success'>Order status successfully set to '$subject_order_status' for order No : $order_number.</div>");

			$add_new_order_history_params = array('orders_id'=>$orders_id , 'order_status_id'=>$sosl_order_status_id , 'caption'=>$sosl_caption , 'remarks'=>$sosl_remarks , 'updated_by'=>$this->session->userdata("sess_psts_uid"));
			$orders_history_id = $this->_sosl->add_new_order_history($add_new_order_history_params);

			//mail and sms code start

			$contact = $o->number;
			$this->Common_Model->send_sms($contact , $template);


			$shipping_address = $o->d_name.'<br>'.$o->d_number.'<br>'.$o->d_address.'<br>'.$o->d_city_name.' - '.$o->d_zipcode.'<br>'.$o->d_state_name.'<br>'.$o->d_country_name;
		$billing_address = $o->b_name.'<br>'.$o->b_number.'<br>'.$o->b_address.'<br>'.$o->b_city_name.' - '.$o->b_zipcode.'<br>'.$o->b_state_name.'<br>'.$o->b_country_name;
		$product_detail = "";
		foreach($o->details as $od)
		{
			$product_detail .="<tr>
				<td style='font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#666; border-bottom:1px solid #ccc; line-height:20px; padding:5px 10px;'>
					$od->product_name ($od->combi)
				</td>
				<td style='font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#666; border-bottom:1px solid #ccc; line-height:20px; padding:5px 10px;'>
					$od->prod_in_cart
				</td>
				<td style='font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#666; border-bottom:1px solid #ccc; line-height:20px; padding:5px 10px;'>
					$o->symbol $od->final_price
				</td>
				<td style='font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#666; border-bottom:1px solid #ccc; line-height:20px; padding:5px 10px;'>
					$o->symbol $od->sub_total
				</td>
			</tr>
			";
		}
		$ship_data='';
		if($o->shipping_discount>0)
		{
			$ship_data .= '<tr>
				<td colspan="3" style="font-family:Arial, sans-serif; text-align:right; font-size:14px; color:#333; border-bottom:1px solid #ccc; line-height:20px; padding:5px 20px;border-collapse: collapse;">
				<strong>Shipping Discount</strong>
				</td>
				<td style="font-family:Arial, sans-serif; font-size:14px; color:#666; border-bottom:1px solid #ccc; line-height:20px; padding:5px 10px;border-collapse: collapse;">-
					'.$o->symbol.' '.$o->shipping_discount.'
				</td>
			</tr>';
		}
			$mailMessage = file_get_contents(APPPATH.'mailer/orders.html');
			$mailMessage = str_replace("#name#",stripslashes($o->name),$mailMessage);
			$mailMessage = str_replace("#order_number#",stripslashes($o->order_number),$mailMessage);
			$mailMessage = str_replace("#mode#",stripslashes($o->mode),$mailMessage);
			$mailMessage = str_replace("#added_on#",stripslashes(date("d M y" , strtotime($o->added_on))),$mailMessage);
			$mailMessage = str_replace("#txnid#",stripslashes($o->txnid),$mailMessage);
			$mailMessage = str_replace("#shipping_address#",stripslashes($shipping_address),$mailMessage);
			$mailMessage = str_replace("#billing_address#",stripslashes($billing_address),$mailMessage);
			$mailMessage = str_replace("#order_status#",stripslashes($subject_order_status),$mailMessage);
			$mailMessage = str_replace("#mail_message#",stripslashes($mail_message),$mailMessage);
			$mailMessage = str_replace("#delivery_charges#",stripslashes($o->symbol.' '.$o->delivery_charges),$mailMessage);
			$mailMessage = str_replace("#delivered_on#",stripslashes($delivered_on),$mailMessage);
			$mailMessage = str_replace("#total#",stripslashes($o->symbol.' '.$o->total),$mailMessage);
			$mailMessage = str_replace("#product_detail#",$product_detail,$mailMessage);
			$mailMessage = str_replace("#total_packing_charges#",stripslashes($o->symbol.' '.$o->total_packing_charges),$mailMessage);
			$mailMessage = str_replace("#ship_data#",$ship_data,$mailMessage);
			$mailMessage = str_replace("#total_gst#",stripslashes($o->symbol.' '.$o->total_gst),$mailMessage);
			//$mailMessage = str_replace("#mainsite#",IMAGE,$mailMessage);
			// $mailMessage = str_replace("#mainsitepp#",IMAGE.__privacy_policy__,$mailMessage);
			// $mailMessage = str_replace("#mainsitecontact#",IMAGE.__contactUs__,$mailMessage);
			// $mailMessage = str_replace("#mainsitefaq#",IMAGE.__faq__,$mailMessage);
			// $mailMessage = str_replace("#mainsiteaccount#",IMAGE.__dashboard__,$mailMessage);


			$mailMessage = str_replace("#project_contact#",_project_contact_,$mailMessage);
			$mailMessage = str_replace("#project_contact_without_space#",_project_contact_without_space_,$mailMessage);
			$mailMessage = str_replace("#project_complete_name#",_project_complete_name_,$mailMessage);
			$mailMessage = str_replace("#project_website#",_project_web_,$mailMessage);
			$mailMessage = str_replace("#project_email#",__adminemail__,$mailMessage);
			$mailMessage = str_replace("#mainsite#",base_url(),$mailMessage);
			$social_media = '';
			if(_FACEBOOK_!='')
				$social_media = $social_media.'<a href="'._FACEBOOK_.'" target="_blank" ><img src="'.IMAGE.'email/facebook.png" width="25"></a>';
			if(_INSTAGRAM_!='')
				$social_media = $social_media.'<a href="'._INSTAGRAM_.'" target="_blank" ><img src="'.IMAGE.'email/instagram.png" width="25"></a>';
			if(_PINTEREST_!='')
				$social_media = $social_media.'<a href="'._PINTEREST_.'" target="_blank" ><img src="'.IMAGE.'email/pinterest.png" width="25"></a>';
			if(_TWITTER_!='')
				$social_media = $social_media.'<a href="'._TWITTER_.'" target="_blank" ><img src="'.IMAGE.'email/twitter.png" width="25"></a>';
			if(_LINKEDIN_!='')
				$social_media = $social_media.'<a href="'._LINKEDIN_.'" target="_blank" ><img src="'.IMAGE.'email/linkedin.png" width="25"></a>';
			if(_YOUTUBE_!='')
				$social_media = $social_media.'<a href="'._YOUTUBE_.'" target="_blank" ><img src="'.IMAGE.'email/youtube.png" width="25"></a>';
			$mailMessage = str_replace("#social_media#",$social_media,$mailMessage);

			if($o->cod_charges>0)
			{
				$cod_content = '<tr><td colspan="3" style="font-family:Arial, Helvetica, sans-serif; text-align:right; font-size:14px; color:#333; border-bottom:1px solid #ccc; line-height:20px; padding:5px 20px;"><strong>	COD Charges </strong></td><td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#666; border-bottom:1px solid #ccc; line-height:20px; padding:5px 10px;">'.$o->symbol.' '.$o->cod_charges.'</td></tr>';
				$mailMessage = str_replace("#cod_charges#",stripslashes($cod_content),$mailMessage);
			}
			else
			{ $mailMessage = str_replace("#cod_charges#",stripslashes(''),$mailMessage); }
			// echo '<pre>';
			// print_r($o);
			// echo '</pre>';

		//	$subject = "Your Order Placed Successfully. Order No.: $o->order_number !"._brand_name_."";
			$mailStatus = $this->Common_Model->send_mail(array("template"=>$mailMessage , "subject"=>$subject , "to"=>$o->email , "name"=>$o->name ));
			//$mailStatus = $this->Common_Model->send_mail(array("template"=>$mailMessage , "subject"=>$subject , "to"=>'anil@marswebsolutions.com' , "name"=>$o->name ));
			//mail and sms code end
			//die;
			$alert_message = 'Order status successfully set to '.$subject_order_status.' for order No : '.$order_number;
			echo json_encode(array("status"=>1, "return_code"=>"1", "message"=>$alert_message));
			exit;
		}
		else
		{
			$this->session->set_flashdata('message', '<div class=" alert alert-danger">Failed to change the order status for order No : $order_number.</div>');
			$alert_message = "Failed to change the order status for order No : $order_number.";
			echo json_encode(array("status"=>3, "return_code"=>"3", "message"=>$alert_message));
			exit;
		}


		//REDIRECT(MAINSITE.'secureRegions/orders/');
	}
}
function assign_shiprocket_order_generate_manifest_api()
{
	$orders_id = $_POST['orders_id'];
	//$orders_id = 15;
	$this->data['orders_detail']=$this->Orders_Model->getOrdersDetails(array("orders_id"=>$orders_id , "stores_id"=>$this->data['backend_sess_id']));
	//print_r($this->data['orders_detail']);
	$pageData['currentPageName']=$uriid=$this->uri->segment(1);
	$this->load->view('admin/orders/Order_Module/assign_order_generate_manifest_api' , $this->data);
}
	function export()
	{
		$this->load->library('PHPExcel');
		$this->load->library('PHPExcel/IOFactory');
		$this->data['page_type'] = "list";

		$this->data['user_access'] = $this->data['User_auth_obj']->check_user_access(array("module_id"=>$this->data['page_module_id']));

		if(empty($this->data['user_access']))
		{
			REDIRECT(MAINSITE_Admin."wam/access-denied");
		}

		if($this->data['user_access']->export_data!=1)
		{
			$this->session->set_flashdata('no_access_flash_message' , "You Are Not Allowed To Export ".$user_access->module_name);
			REDIRECT(MAINSITE_Admin."wam/access-denied");
		}
		$search = array();
		$field_name = 'urm.name';
		$field_value = '';


		if(!empty($_REQUEST['field_name']))
			$field_name = $_POST['field_name'];
		else if(!empty($field_name))
			$field_name = $field_name;

		if(!empty($_REQUEST['field_value']))
			$field_value = $_POST['field_value'];
		else if(!empty($field_value))
			$field_value = $field_value;




		$this->data['field_name'] = $field_name;
		$this->data['field_value'] = $field_value;


		$search['field_value'] = $field_value;
		$search['field_name'] = $field_name;


		$this->data['list_data'] = $this->Orders_Model->getData($search);
		$this->data['Module_name'] = $this->data['page_module_name'];


		$this->load->view('admin/orders/Order_Module/export' , $this->data);
	}
	function track_order_api()
{
	$orders_id = $_POST['orders_id'];
	//$orders_id = 15;
	$this->data['orders_detail']=$this->Orders_Model->getOrdersDetails(array("orders_id"=>$orders_id , "stores_id"=>$this->data['backend_sess_id']));
	//print_r($this->data['orders_detail']);
	$pageData['currentPageName']=$uriid=$this->uri->segment(1);
	$this->load->view('admin/orders/Order_Module/track_order_api' , $this->data);
}
	function pdf()
	{
		$this->load->library('pdf');
		$this->data['page_type'] = "list";

		$this->data['user_access'] = $this->data['User_auth_obj']->check_user_access(array("module_id"=>$this->data['page_module_id']));

		if(empty($this->data['user_access']))
		{
			REDIRECT(MAINSITE_Admin."wam/access-denied");
		}

		if($this->data['user_access']->export_data!=1)
		{
			$this->session->set_flashdata('no_access_flash_message' , "You Are Not Allowed To Export ".$user_access->module_name);
			REDIRECT(MAINSITE_Admin."wam/access-denied");
		}
		$search = array();
		$field_name = '';
		$field_value = '';
		$end_date = '';
		$start_date = '';
		$record_status="";

		if(!empty($_REQUEST['field_name']))
			$field_name = $_POST['field_name'];
		else if(!empty($field_name))
			$field_name = $field_name;

		if(!empty($_REQUEST['field_value']))
			$field_value = $_POST['field_value'];
		else if(!empty($field_value))
			$field_value = $field_value;

		if(!empty($_POST['end_date']))
			$end_date = $_POST['end_date'];

			if(!empty($_POST['start_date']))
			$start_date = $_POST['start_date'];

		if(!empty($_POST['record_status']))
			$record_status = $_POST['record_status'];


		$this->data['field_name'] = $field_name;
		$this->data['field_value'] = $field_value;
		$this->data['end_date'] = $end_date;
		$this->data['start_date'] = $start_date;
		$this->data['record_status'] = $record_status;

		$search['end_date'] = $end_date;
		$search['start_date'] = $start_date;
		$search['field_value'] = $field_value;
		$search['field_name'] = $field_name;
		$search['record_status'] = $record_status;

		$this->data['list_data'] = $this->Orders_Model->getData($search);

		$this->data['Module_name'] = 'Country';

		$date = date('Y-m-d H:i:s');
		$html = $this->load->view('admin/orders/Order_Module/pdf' , $this->data,true);
		// echo $html;
		// exit;
		//$html = $this->load->view('admin/reports/Project_Reports_Module/project_reports_list_pdf' , $this->data, true);
		$this->pdf->createPDF($html, $this->data['Module_name']."-".$date, false);
		exit;
	}

	function view($id="")
	{
		$this->data['page_type'] = "list";

		$this->data['user_access'] = $this->data['User_auth_obj']->check_user_access(array("module_id"=>$this->data['page_module_id']));
		//print_r($this->data['user_access']);
		if(empty($id))
		{
			$alert_message = ' Something Went Wrong. Please Try Again.';
			$this->session->set_flashdata('alert_message', $alert_message);
			REDIRECT(MAINSITE_Admin.$user_access->class_name."/".$user_access->function_name);
			exit;
		}
		if(empty($this->data['user_access']))
		{
			REDIRECT(MAINSITE_Admin."wam/access-denied");
		}
		$this->data['page_is_master'] = $this->data['user_access']->is_master;
		$this->data['page_parent_module_id'] = $this->data['user_access']->parent_module_id;
		$this->data['list_data'] = $this->Orders_Model->getData(array("id"=>$id));
		if(empty($id))
		{
			$alert_message = ' Something Went Wrong. Please Try Again.';
			$this->session->set_flashdata('alert_message', $alert_message);
			REDIRECT(MAINSITE_Admin.$user_access->class_name."/".$user_access->function_name);
			exit;
		}

		$this->data['list_data'] = $this->data['list_data'][0];

		parent::get_header();
		parent::get_left_nav();
		$this->load->view('admin/orders/Order_Module/view' , $this->data);
		parent::get_footer();
	}

	function edit($id="")
	{
		$this->data['page_type'] = "list";

		$user_access = $this->data['user_access'] = $this->data['User_auth_obj']->check_user_access(array("module_id"=>$this->data['page_module_id']));
		//print_r($this->data['user_access']);
		if(empty($this->data['user_access']))
		{
			REDIRECT(MAINSITE_Admin."wam/access-denied");
		}
		if(empty($id))
		{
			$this->data['page_type_action'] = "Add";

			if($user_access->add_module!=1)
			{
				$this->session->set_flashdata('no_access_flash_message' , "You Are Not Allowed To Add ".$user_access->module_name);
				REDIRECT(MAINSITE_Admin."wam/access-denied");
			}
		}
		if(!empty($id))
		{
			$this->data['page_type_action'] = "Edit";

			if($user_access->update_module!=1)
			{
				$this->session->set_flashdata('no_access_flash_message' , "You Are Not Allowed To Update ".$user_access->module_name);
				REDIRECT(MAINSITE_Admin."wam/access-denied");
			}
		}

		$this->data['page_is_master'] = $this->data['user_access']->is_master;
		$this->data['page_parent_module_id'] = $this->data['user_access']->parent_module_id;
		if(!empty($id)){
			$this->data['list_data'] = $this->Orders_Model->getData(array("id"=>$id));
			if(empty($this->data['list_data']))
			{
				$this->session->set_flashdata('alert_message', '<div class="alert alert-danger alert-dismissible">
					<button type="button" class="btn close" data-bs-dismiss="alert" aria-hidden="true">×</button>
					<i class="icon fa fa-ban"></i> Record Not Found.
				  </div>');
				REDIRECT(MAINSITE_Admin.$user_access->class_name.'/'.$user_access->function_name);
			}
			$this->data['list_data'] = $this->data['list_data'][0];
		}
		 $module_html = $this->load->view('admin/orders/Order_Module/edit' , $this->data,true);
		echo json_encode(array('module_data'=>$module_html));
		exit;
	}

	function doEdit()
	{
		$this->data['page_type'] = "list";

		$user_access = $this->data['user_access'] = $this->data['User_auth_obj']->check_user_access(array("module_id"=>$this->data['page_module_id']));

		// if(empty($_POST['name']) || empty($_POST['country_short_name']) )
		// {
		// 	$alert_message = ' Something Went Wrong. Please Try Again.';
		// 	$this->session->set_flashdata('alert_message', $alert_message);
		// 	REDIRECT(MAINSITE_Admin.$user_access->class_name."/".$user_access->function_name);
		// 	exit;
		// }
		$id = $_POST['id'];
		//print_r($_POST);
		if(empty($this->data['user_access']))
		{
			REDIRECT(MAINSITE_Admin."wam/access-denied");
		}
		if(empty($id))
		{
				$this->data['page_type_action'] = "Add";
			if($user_access->add_module!=1)
			{
				$this->session->set_flashdata('no_access_flash_message' , "You Are Not Allowed To Add ".$user_access->module_name);
				REDIRECT(MAINSITE_Admin."wam/access-denied");
			}
		}else{
				$this->data['page_type_action'] = "Edit";
		}
		if(!empty($id))
		{
			if($user_access->update_module!=1)
			{
				$this->session->set_flashdata('no_access_flash_message' , "You Are Not Allowed To Update ".$user_access->module_name);
				REDIRECT(MAINSITE_Admin."wam/access-denied");
			}
		}

			$this->form_validation->set_rules('name', 'Name', 'callback_alpha_dash_space|required');
			$this->form_validation->set_rules('link', 'Banner Link', 'required');
			$this->form_validation->set_rules('banner_for', 'Banner For', 'required');
			$this->form_validation->set_rules('title1', 'Title 1', 'required');
			//$this->form_validation->set_rules('status', 'Status', 'numeric|trim|required|min_length[1]|max_length[1]');
			$this->form_validation->set_error_delimiters('<div class="error alert alert-danger">', '<a href="#" class="btn close" data-bs-dismiss="alert" aria-label="close" title="Close">&times;</a></div>');
			if ($this->form_validation->run() == true)
			{
				$this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
				$name = trim($_POST['name']);
				if(isset($_POST['status'])){
					$status = $_POST['status'];

				}
				$is_exist = $this->Common_Model->getData(array('select'=>'*' , 'from'=>$this->data['table_name'] , 'where'=>"name = '$name' and id != $id and is_deleted != 1"));
			//	echo $this->db->last_query();
			//	print_r($is_exist);
				if(!empty($is_exist))
				{
					$alert_message = $this->data['page_module_name']." already exist in database";
					$this->session->set_flashdata('alert_message', $alert_message);
					//echo $this->session->flashdata('alert_message' );
					//echo "";
					echo json_encode(array("status"=>0, "return_code"=>"3", "message"=>$alert_message, ));
					exit;
				}

				$enter_data['name'] = $name;
				$enter_data['title1'] = $_POST['title1'];
				$enter_data['title2'] = $_POST['title2'];
				$enter_data['title3'] = $_POST['title3'];
				$enter_data['title4'] = $_POST['title4'];
				$enter_data['banner_for'] = $_POST['banner_for'];
				$enter_data['link'] = $_POST['link'];
				if(isset($_POST['status'])){
					$enter_data['status'] = $_POST['status'];
				}else{
					$enter_data['status'] = 0;
				}

				$alert_message = ' Something Went Wrong Please Try Again.';
				if(!empty($id))
				{


					$enter_data['updated_on'] = date("Y-m-d H:i:s");
					$enter_data['updated_by'] = $this->data['session_uid'];
					$insertStatus = $this->Common_Model->update_operation(array('table'=>$this->data['table_name'], 'data'=>$enter_data, 'condition'=>"id = $id"));
					if(!empty($insertStatus))
					{
						$alert_message = ' Record Updated Successfully';
					}

				}
				else
				{


					$enter_data['added_on'] = date("Y-m-d H:i:s");
					$enter_data['added_by'] = $this->data['session_uid'];
					$insertStatus = $this->Common_Model->add_operation(array('table'=>$this->data['table_name'] , 'data'=>$enter_data));
					if(!empty($insertStatus))
					{
						$alert_message = ' New Record Added Successfully';
					}


				}
				$banner_id = $id;
				$banner_file_name = "";
				if(isset($_FILES["image"]['name'])){
					$timg_name = $_FILES['image']['name'];
					if(!empty($timg_name)){
						$temp_var = explode(".",strtolower($timg_name));
						$timage_ext = end($temp_var);
						$timage_name_new = "banner_".$banner_id.".".$timage_ext;
						$image_enter_data['image'] = $timage_name_new;
						$imginsertStatus = $this->Common_Model->update_operation(array('table'=>'banner', 'data'=>$image_enter_data, 'condition'=>"id = $banner_id"));
						if($imginsertStatus==1)
						{
							if (!is_dir(_uploaded_temp_files_.'banner')) {
								mkdir(_uploaded_temp_files_.'./banner', 0777, TRUE);

							}
							move_uploaded_file ($_FILES['image']['tmp_name'],_uploaded_temp_files_."banner/".$timage_name_new);
							$banner_file_name = $timage_name_new;
						}

					}
				}
				echo json_encode(array("status"=>1, "return_code"=>"1", "message"=>$alert_message));
				exit;

			}else{
				$this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
				$html = $this->load->view("admin/orders/Order_Module/edit",$this->data, true);
				echo json_encode(array("status"=>0, "return_code"=>"2", "message"=>'Something wrong please try again', "html"=>$html));
				exit;
			}



	}
	function alpha_dash_space($fullname){
    if (! preg_match('/^[a-zA-Z\s]+$/', $fullname)) {
        $this->form_validation->set_message('alpha_dash_space', 'The %s field may only contain alpha characters & White spaces');
        return FALSE;
    } else {
        return TRUE;
    }
}
	function doUpdateStatus()
	{
		$this->data['page_type'] = "list";

		$user_access = $this->data['user_access'] = $this->data['User_auth_obj']->check_user_access(array("module_id"=>$this->data['page_module_id']));
		//print_r($this->data['user_access']);
		$task = $_POST['task'];
		$id_arr = $_POST['sel_recds'];

		if(empty($user_access))
		{
			REDIRECT(MAINSITE_Admin."wam/access-denied");
		}
		if($user_access->update_module==1)
		{
			$this->session->set_flashdata('alert_message', '<div class="alert alert-danger alert-dismissible">
					<button type="button" class="btn close" data-bs-dismiss="alert" aria-hidden="true">×</button>
					<i class="icon fa fa-ban"></i> Something Went Wrong Please Try Again.
				  </div>');
			$update_data = array();
			if(!empty($id_arr) )
			{


				$action_taken = "";
				$ids = implode(',' , $id_arr);
				if($task=="active")
				{
					$update_data['status'] = 1;
					$action_taken = "Activate";
				}
				if($task=="block")
				{
					$update_data['status'] = 0;
					$action_taken = "Blocked";
				}
				if($task=="export")
				{
					$this->load->library('PHPExcel');
					$this->load->library('PHPExcel/IOFactory');
				//	$this->data['list_data'] = $this->Common_Model->getData(array('select'=>'*' , 'from'=>$this->data['table_name'] , 'where'=>"id in ($ids)"));
					$this->data['list_data'] = $this->Common_Model->export(array('table'=>$this->data['table_name']));
					$this->data['Module_name'] = 'Country';
					$this->load->view('admin/orders/Order_Module/export' , $this->data);
				  $action_taken = "Exported";
				}
				if($task=="pdf")
				{
					$this->load->library('pdf');
				//	$this->data['list_data'] = $this->Common_Model->getData(array('select'=>'*' , 'from'=>$this->data['table_name'] , 'where'=>"id in ($ids)"));
					$this->data['list_data'] = $this->Common_Model->export(array('id'=>$id_arr,'table'=>$this->data['table_name']));
					$this->data['Module_name'] = 'Country';
					$html = $this->load->view('admin/orders/Order_Module/pdf' , $this->data,true);
				  $action_taken = "Exported";
						$date = date('Y-m-d H:i:s');
					$this->pdf->createPDF($html, $this->data['Module_name']."-".$date, false);
					exit;
				}
				if($task=="delete")
				{
					$update_data['is_deleted'] = 1;
					$action_taken = "Deleted";
					$update_data['is_deleted_on'] = date("Y-m-d H:i:s");
					$update_data['is_deleted_by'] = $this->data['session_uid'];
				}
				$update_data['updated_on'] = date("Y-m-d H:i:s");
				$update_data['updated_by'] = $this->data['session_uid'];
				$response = $this->Common_Model->update_operation(array('table'=>$this->data['table_name'] , 'data'=>$update_data , 'condition'=>"id in ($ids)" ));
				if($response){
					$this->session->set_flashdata('alert_message', '<div class="alert alert-success alert-dismissible">
						<button type="button" class="btn close" data-bs-dismiss="alert" aria-hidden="true">×</button>
						<i class="icon fa fa-check"></i> Records Successfully '.$action_taken.'
						</div>');
				}
			}
			REDIRECT(MAINSITE_Admin.$user_access->class_name.'/'.$user_access->function_name);
		}
		else
		{
			$this->session->set_flashdata('no_access_flash_message' , "You Are Not Allowed To Update ".$user_access->module_name);
			REDIRECT(MAINSITE_Admin."wam/access-denied");
		}
	}




	function logout()
	{
		$this->unset_only();
		$this->session->set_flashdata('alert_message', '<div class="alert alert-success alert-dismissible">
		<button type="button" class="btn close" data-bs-dismiss="alert" aria-hidden="true">×</button>
		<i class="icon fa fa-check"></i> You Are Successfully Logout.
		</div>');
		$this->session->unset_userdata('session_uid');
		REDIRECT(MAINSITE_Admin.'login');
	}



	public function index1()
	{
		$this->load->view('welcome_message');
	}

	function mypdf(){


		$this->load->library('pdf');


		  $this->pdf->load_view('mypdf');
		  $this->pdf->render();


		  $this->pdf->stream("welcome.pdf");
	   }
}
