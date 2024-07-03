<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Main extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		//$this->load->library('session');
		$this->load->model('Common_Model');
		$this->load->model('Products_model');
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->session->set_userdata('application_sess_store_id',1);
		$this->data['temp_name'] = $this->session->userdata('application_sess_temp_name');
		$this->data['temp_id'] = $this->session->userdata('application_sess_temp_id');
		$this->data['store_id'] = $this->session->userdata('application_sess_store_id');
		$this->data['store_id'] = 1;
		$this->data['cart_count'] = $this->session->userdata('application_sess_cart_count');
		$this->data['active_left_menu'] = '';
		$company_profile_data = $this->Common_Model->getData(array('select'=>'*' , 'from'=>'company_profile' , 'where'=>"id > 0"  ));
		$this->data['company_profile_data'] =  $company_profile_data[0];

		$this->data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$this->session->set_userdata('application_sess_currency_id',1);
		$this->session->set_userdata('application_sess_country_id',__const_country_id__);
		$app_sess_currency_id = $this->session->userdata('application_sess_currency_id');
		if(empty($app_sess_currency_id) && false)
		{
			$user_ip = getenv('REMOTE_ADDR');
			//$geo = unserialize(file_get_contents("http://www.geoplugin.net/php.gp?ip=$user_ip"));
			if(!empty($geo["geoplugin_countryName"]))
			{
				if($geo["geoplugin_countryName"]=='India')
				{

					$this->session->set_userdata('application_sess_currency_id',1);
					$this->session->set_userdata('application_sess_country_id',__const_country_id__);
				}
				else
				{
					$country_name = $geo["geoplugin_countryName"];
					$getCountry_data=$this->Common_Model->getName(array('select'=>'*' , 'from'=>'country' , 'where'=>"(country_name like '$country_name' and status=1)"));
					if(!empty($getCountry_data))
					{
						$getCountry_data = $getCountry_data[0];
						$this->session->set_userdata('application_sess_currency_id',2);
						$this->session->set_userdata('application_sess_country_id',$getCountry_data->country_id);
					}
					else
					{
						$this->session->set_userdata('application_sess_currency_id',1);
						$this->session->set_userdata('application_sess_country_id',__const_country_id__);
					}

				}
			}
			else
			{
				$this->session->set_userdata('application_sess_currency_id',1);
				$this->session->set_userdata('application_sess_country_id',__const_country_id__);
			}
		}

		$this->Common_Model->getWishlistItemCount();
		$this->data['wishlist_count'] = $this->session->userdata('application_sess_wishlist_count');

		if(empty($this->data['temp_id']))
		{
			$sess_temp_id = date("dmYhis");
			if(empty($_COOKIE["application_user"]))
			{
				setcookie("application_user", $sess_temp_id, time() + (86400 * 365), "/");
				$this->session->set_userdata('application_sess_temp_id',$sess_temp_id);
			}
			else
			{
				$this->session->set_userdata('application_sess_temp_id',$_COOKIE["application_user"]);
			}
		}

		$this->Common_Model->getCartItemCount();

		$this->data['cart_coupon_code'] = $this->session->userdata('application_sess_coupon_code');
		$this->data['cart_coupon_discount'] = $this->session->userdata('application_sess_discount');
		$this->data['cart_discount_in'] = $this->session->userdata('application_sess_discount_in');
		$this->data['cart_discount_variable'] = $this->session->userdata('application_sess_discount_variable');
		$this->data['cart_discount_on_cart_value'] = $this->session->userdata('application_sess_discount_on_cart_value');
		$this->data['cart_discount_cart_value_message'] = $this->session->userdata('application_sess_discount_cart_value_message');
	}


	public function getHeader($pageName , $data)
	{
		$this->data = $data;
		if(empty($this->data['js']))
		{
			$this->data['js'] = array();
		}
		//$this->data['js'] = array_merge(array( 'js/product.js'), $this->data['js']);
		$this->data['check_screen'] = $this->Common_Model->checkScreen();
		$this->data['menu']=$this->Common_Model->getMenu();
		$application_sess_temp_id = $this->session->userdata('application_sess_temp_id');
		$application_sess_store_id = $this->session->userdata('application_sess_store_id');
		$distinct_product_id_in_cart = $this->Products_model->temp_cart('distinct_product_id_in_cart','','' , '' , '', '', $application_sess_temp_id, $application_sess_store_id);
		if(count($distinct_product_id_in_cart)>0){
			$product_ids = '';
			$product_combination_ids = '';
			foreach($distinct_product_id_in_cart as $col){$product_ids.=$col['product_id'].',';$product_combination_ids.=$col['product_combination_id'].',';}
			$product_ids = trim($product_ids , ',');$product_combination_ids = trim($product_combination_ids , ',');
			$this->data['header_products_list']=$this->Products_model->productsSearch('products_list_group','', '', $application_sess_temp_id, $application_sess_store_id, $product_ids, $product_combination_ids);
			//print_r($products_list);
		}
		$this->load->view("inc/$pageName" , $this->data);

	}

	public function getFooter($pageName , $data)
	{
		$this->data = $data;

		$this->data['js'] = array_merge( $this->data['js']);
		$this->load->view("inc/$pageName" , $this->data);
	}

	public function setCurrency($params = array())
	{
		if(empty($this->data['setCurency']))
		{
			$this->data['setCurency'] = $this->Common_Model->setCurency();
		}
		return $this->data['setCurency'];
	}

	public function getCurrencyPrice($params = array())
	{
		//return $params['obj']['setCurency']->currency_rate*$params['amount'];
		return round($params['amount']);
		//echo $params['obj']['setCurency']->currency_rate;
		//echo $params['amount'];
	}

	public function getDeliveryPrice($params = array())
	{

		//include( APPPATH."third_party/express/auth.php");
		$shipping_charges_arr['cod_charges'] = 0;
		$shipping_charges_arr['shipping_charges'] = 0;
		$shipping_charges_arr['shipping_discount'] = 0;
		$shipping_charges_arr['total_shipping_charges'] = 0;
		$store_delivery_pincodes = array();
		$shipping_charges_arr['is_delivery_available'] = $is_delivery_available = false;
		$shipping_charges_arr['is_cod_available'] = $is_delivery_available = 0;
		$is_tsm_delivery = false;
		$is_express_delivery = false;
		$is_express = true;


		$store_data = $this->Common_Model->getData(array('select'=>'*' , 'from'=>'stores' , 'where'=>"id =1"  ));
		if(!empty($store_data))
		{
			$store_data = $store_data[0];
			if(!empty($store_data->store_delivery_pincodes))
			{
				$store_delivery_pincodes = explode(',' , $store_data->store_delivery_pincodes);
				for($i=0 ; $i< count($store_delivery_pincodes) ; $i++)
				{
					$store_delivery_pincodes[$i] = trim($store_delivery_pincodes[$i]);
					if($store_delivery_pincodes[$i] == $params['delivery_pin_code'])
					{
						$is_tsm_delivery = true;
						$is_delivery_available = true;
						$shipping_charges_arr['is_cod_available'] = 1;
						break;
					}
				}
			}
		}


		include_once( APPPATH."third_party/expressbess/auth2.php");

		$data = array(
		  "origin" => "122001",
		"destination" => $params['delivery_pin_code'],
		"payment_type" => "cod",
		"order_amount" => $params['order_total'],
		);
		$data_string = json_encode($data);

		$url = 'https://shipment.xpressbees.com/api/courier/serviceability';
		$ch = curl_init($url);

		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array(
		    'Content-Type: application/json',
		    "Authorization: Bearer $token"
		  )
		);

		$result = curl_exec($ch);
		$result = $postcode_response = json_decode($result);
		// echo "<pre>";
		// print_r($result);
		// echo "</pre>";
		// die;
		$is_free_delivery = 1;
		$not_free_delivery_states = array('Tripura', 'Mizoram', 'Nagaland', 'Manipur', 'Meghalaya', 'Jammu and Kashmir', 'Himachal Pradesh');
		$post_code_state = '';

		//echo $post_code_state;
		$fright_charges = 0;
		$cod_charges = 100;

		if(!empty($postcode_response))
		{
			if(!empty($postcode_response->status))
			{

				if($postcode_response->status)
				{

					$is_express_delivery = true;
							$is_delivery_available = true;
						$shipping_charges_arr['is_cod_available'] = 1;
				}
			}
		}

		if(!$is_express_delivery)
		{
			//$fright_charges = 75;
			$fright_charges = 90;
			//$cod_charges = 20;
		}

		if($params['order_total'] > __free_shipping_above__ && $is_free_delivery)
		{
			$shipping_charges_arr['cod_charges'] = $cod_charges;
			$shipping_charges_arr['shipping_charges'] = 0;
			$shipping_charges_arr['shipping_discount'] = 0;
		}
		else
		{
			$shipping_charges_arr['cod_charges'] = $cod_charges;
			$shipping_charges_arr['shipping_charges'] = 90;
			$shipping_charges_arr['shipping_discount'] = 0;
		}

		$shipping_charges_arr['is_delivery_available'] = $is_delivery_available;
		if(!$is_delivery_available )
		{
			$is_redirect = true;
			if(!empty($params['is_redirect']))
			{
				$is_redirect = false;
			}

			$msg = "The pin code (".$params['delivery_pin_code'].") is not serviceable.";
			$this->session->set_flashdata('message', '<div class=" alert alert-warning">'.$msg.'</div>');
			if($is_redirect)
			{
				REDIRECT(base_url().__cart__);
			}
			else
			{
				//return '<div class=" alert alert-warning">'.$msg.'</div>';
			}
		}
		$shipping_charges_arr['total_shipping_charges'] = $shipping_charges_arr['cod_charges'] + $shipping_charges_arr['shipping_charges'] - $shipping_charges_arr['shipping_discount'] ;
		/*echo "<pre>";
		print_r($params);
		print_r($shipping_charges_arr);
 		echo "</pre>";*/

		$t1 = json_encode($shipping_charges_arr);
		$t = json_decode($t1);

		return $t;
	}

}
