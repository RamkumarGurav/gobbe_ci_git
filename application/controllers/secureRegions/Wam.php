<?php
defined('BASEPATH') or exit('No direct script access allowed');
require_once ("Main.php");
class Wam extends Main
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
		//$this->load->model('administrator/Quotation_Enquiry_Model');
		//$this->load->model('administrator/Proforma_Invoice_Model');
		//$this->load->model('administrator/Invoice_Model');
		//$this->load->model('administrator/Invoice_Delivery_Note_Model');
		//$this->load->model('administrator/Purchase_Order_Model');
		$this->load->library('User_auth');

		$session_uid = $this->data['session_uid'] = $this->session->userdata('session_uid');
		$this->data['session_uname'] = $this->session->userdata('session_uname');
		$this->data['session_uemail'] = $this->session->userdata('session_uemail');
		$this->data['sess_fiscal_year_id'] = $this->session->userdata('sess_fiscal_year_id');
		$this->data['sess_company_profile_id'] = $this->session->userdata('sess_company_profile_id');

		$this->load->helper('url');

		$this->data['User_auth_obj'] = new User_auth();
		$this->data['user_data'] = $this->data['User_auth_obj']->check_user_status();

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


		$status_options = array(
			'1' => 'Order Placed',
			'2' => 'InProcess',
			'3' => 'Out For Delivery',
			'4' => 'Delivered',
			'5' => 'Not Delivered',
			'6' => 'Cancelled',
		);
		$orderStatusData = array();
		foreach ($status_options as $key => $status) {
			$orders = $this->Orders_Model->orderDahboardData(array('order_status' => $key));
			$orderStatusData[$key] = $orders[0]->total_orders;
		}
		$this->data['orderStatusData'] = $orderStatusData;
		$this->data['this_monthorders'] = $this_monthorders = $this->Orders_Model->orderDahboardData(array('this_month' => '1'));
		$this->data['last_monthorders'] = $last_monthorders = $this->Orders_Model->orderDahboardData(array('last_month' => '1'));
		$this->data['today_orders'] = $last_monthorders = $this->Orders_Model->orderDahboardData(array('today_orders' => '1'));
		$this->data['yesterday_orders'] = $last_monthorders = $this->Orders_Model->orderDahboardData(array('yesterday_orders' => '1'));
		$this->data['allorders'] = $last_monthorders = $this->Orders_Model->orderDahboardData();
		$this->data['list_data'] = $last_monthorders = $this->Orders_Model->orderDahboardData();
		// echo $this->db->last_query();
		// die;
		// echo "<pre>";
		// print_r($last_monthorders);
		// echo "this month";
		// print_r($this_monthorders);
		// echo "</pre>";
		// die;
		$search = array();
		$search['today_orders'] = 1;
		$this->data['list_data'] = $this->Orders_Model->getOrdersDetails($search);
		// 	 echo "<pre>";
		// print_r($this->data['list_data']);
		// 	echo "</pre>";
		// die;

		parent::get_header();
		parent::get_left_nav();
		$this->load->view('admin/dashboard', $this->data);
		parent::get_footer();
	}

	function dashboard()
	{
		parent::get_header();
		parent::get_left_nav();
		$this->load->view('welcome_message');
		parent::get_footer();
	}

	function view_profile()
	{
		$this->load->model('administrator/Employee_Model');
		$this->data['tab_type'] = 'profile';

		if (!empty($_POST['update_password_button'])) {
			$this->data['tab_type'] = $_POST['tab_type'];
			$old_password = $_POST['old_password'];
			$new_password = $_POST['new_password'];
			$re_new_password = $_POST['re_new_password'];

			if ($new_password === $re_new_password) {
				if ($this->data['user_data']->password == md5($old_password)) {
					$enter_data['updated_on'] = date("Y-m-d H:i:s");
					$enter_data['updated_by'] = $this->data['session_uid'];
					$enter_data['show_password'] = $new_password;
					$enter_data['password'] = md5($new_password);
					$insertStatus = $this->Common_Model->update_operation(array('table' => 'user', 'data' => $enter_data, 'condition' => "id = " . $this->data['session_uid']));
					if (!empty($insertStatus)) {
						$alert_message = '<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-bs-dismiss="alert" aria-hidden="true">×</button><i class="icon fas fa-check"></i> Pasword Updated Successfully </div>';
						$this->session->set_flashdata('alert_message', $alert_message);
						REDIRECT(MAINSITE_Admin . "wam/view-profile");
					} else {
						$this->data['profile_alert_massage'] = '<div class="alert alert-danger alert-dismissible">
						<button type="button" class="close" data-bs-dismiss="alert" aria-hidden="true">×</button>
						<i class="icon fas fa-check"></i> Something Went Wrong Please Try Again.
						</div>';
					}
				} else {
					$this->data['profile_alert_massage'] = '<div class="alert alert-danger alert-dismissible">
					<button type="button" class="close" data-bs-dismiss="alert" aria-hidden="true">×</button>
					<i class="icon fas fa-check"></i> You Entered Wrong Password.
					</div>';
				}
			} else {
				$this->data['profile_alert_massage'] = '<div class="alert alert-danger alert-dismissible">
				<button type="button" class="close" data-bs-dismiss="alert" aria-hidden="true">×</button>
				<i class="icon fas fa-check"></i> Password And Re Enter Password Doesnot Match.
				</div>';

			}

		}

		if (!empty($_POST['update_username_button'])) {
			$this->data['tab_type'] = $_POST['tab_type'];
			$password = $_POST['password'];
			$username = $_POST['user_name'];

			if ($this->data['user_data']->password == md5($password)) {
				$is_exist = $this->Common_Model->getData(array('select' => '*', 'from' => 'user', 'where' => "username = '$username' and id != " . $this->data['session_uid']));

				if (empty($is_exist)) {
					$enter_data['updated_on'] = date("Y-m-d H:i:s");
					$enter_data['updated_by'] = $this->data['session_uid'];
					$enter_data['username'] = $username;
					$insertStatus = $this->Common_Model->update_operation(array('table' => 'user', 'data' => $enter_data, 'condition' => "id = " . $this->data['session_uid']));
					if (!empty($insertStatus)) {
						$alert_message = '<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-bs-dismiss="alert" aria-hidden="true">×</button><i class="icon fas fa-check"></i> User Name Updated Successfully </div>';
						$this->session->set_flashdata('alert_message', $alert_message);
						REDIRECT(MAINSITE_Admin . "wam/view-profile");
					} else {
						$this->data['profile_alert_massage'] = '<div class="alert alert-danger alert-dismissible">
						<button type="button" class="close" data-bs-dismiss="alert" aria-hidden="true">×</button>
						<i class="icon fas fa-check"></i> Something Went Wrong Please Try Again.
						</div>';
					}
				} else {
					$this->data['profile_alert_massage'] = '<div class="alert alert-danger alert-dismissible">
					<button type="button" class="close" data-bs-dismiss="alert" aria-hidden="true">×</button>
					<i class="icon fas fa-check"></i> Username You Entered Is Not Available, Please Try Again.
					</div>';
				}

			} else {
				$this->data['profile_alert_massage'] = '<div class="alert alert-danger alert-dismissible">
				<button type="button" class="close" data-bs-dismiss="alert" aria-hidden="true">×</button>
				<i class="icon fas fa-check"></i> You Entered Wrong Password.
				</div>';
			}

		}

		$this->data['employee_data'] = $this->Employee_Model->get_employee(array("id" => $this->data['session_uid'], 'details' => 1));
		$this->data['employee_data'] = $this->data['employee_data'][0];

		parent::get_header();
		parent::get_left_nav();
		$this->load->view('admin/view_profile', $this->data);
		parent::get_footer();
	}

	function logout()
	{
		$this->unset_only();
		$this->session->set_flashdata('alert_message', '<div class="alert alert-success alert-dismissible">
		<button type="button" class="close" data-bs-dismiss="alert" aria-hidden="true">×</button>
		<i class="icon fas fa-check"></i> You Are Successfully Logout.
		</div>');
		$this->session->unset_userdata('session_uid');
		REDIRECT(MAINSITE_Admin . 'login');
	}

	function lock_screen()
	{
		$this->session->set_userdata('screen_lock', "lock_the_screen");
		REDIRECT(MAINSITE_Admin . 'Screen-Lock');
	}

	function set_company()
	{
		$this->session->set_userdata('sess_company_profile_id', $_POST['sess_company_profile_id']);
		REDIRECT(MAINSITE_Admin . 'wam');
	}

	function access_denied()
	{
		parent::get_header();
		parent::get_left_nav();
		$this->load->view('admin/access_denied', $this->data);
		parent::get_footer();
	}
}
