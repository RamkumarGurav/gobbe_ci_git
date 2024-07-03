<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once(APPPATH."controllers/secureRegions/Main.php");
class Product_Module extends Main
{
	function __construct()
	{
        parent::__construct();
		$this->load->database();
		$this->load->library('session');
		$this->load->model('Common_Model');
		$this->load->model('administrator/Admin_Common_Model');
		$this->load->model('administrator/Admin_model');
		$this->load->model('administrator/catalog/Product_Model');
		$this->load->model('administrator/catalog/Category_Model');
		$this->load->model('administrator/catalog/Store_Model');
		$this->load->library('pagination');

		$this->load->library('User_auth');

		$session_uid = $this->data['session_uid']=$this->session->userdata('session_uid');
		$this->data['session_uname']=$this->session->userdata('session_uname');
		$this->data['session_uemail']=$this->session->userdata('session_uemail');
		$this->data['page_module_name']='Product';
		$this->data['table_name']= 'product';
		$this->data['page_module_id'] = 17;
		$this->load->helper('url');

		$this->data['User_auth_obj'] = new User_auth();
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
		$this->load->view('admin/catalog/Product_Module/list' , $this->data);
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

		$search['search_for'] = "count";

		$data_count = $this->Product_Model->getData($search);
		if(!empty($data_count)){
			$r_count = $this->data['row_count'] = $data_count[0]->counts;

		}else{
				$r_count = 0;
		}

		unset($search['search_for']);

		$offset = (int)$this->uri->segment(5); //echo $offset;
		if($offset == "")
		{
			$offset ='0' ;
		}
		$per_page = _all_pagination_;
		$this->data['category_list'] = $category_list = $this->Category_Model->getData();

		$this->load->library('pagination');
		//$config['base_url'] =MAINSITE.'secure_region/reports/DispatchedOrders/'.$module_id.'/';
		$this->load->library('pagination');
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
		$this->data['list_data'] = $this->Product_Model->getData($search);
		// echo $this->db->last_query();
		// die();
		$this->data['css'] = array('jquery.fancybox.css', 'jquery.fancybox-buttons.css');
		$this->data['js'] = array('jquery.fancybox.pack.js', 'jquery.fancybox-buttons.js'  );
		parent::get_header();
		parent::get_left_nav();
		$this->load->view('admin/catalog/Product_Module/listing' , $this->data);
		parent::get_footer();
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


		$this->data['list_data'] = $this->Product_Model->getData($search);
		$this->data['Module_name'] = $this->data['page_module_name'];


		$this->load->view('admin/catalog/Product_Module/export' , $this->data);
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

		$this->data['list_data'] = $this->Product_Model->getData($search);

		$this->data['Module_name'] = 'Country';

		$date = date('Y-m-d H:i:s');
		$html = $this->load->view('admin/catalog/Product_Module/pdf' , $this->data,true);
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
		$this->data['list_data'] = $this->Product_Model->getData(array("id"=>$id));
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
		$this->load->view('admin/catalog/Product_Module/view' , $this->data);
		parent::get_footer();
	}
	public function doAddProductCombination()
	{
		// echo "<pre>";
		// print_r($_POST);
		// echo "</pre>";
		// DIE;
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
		$product_id = $_POST['product_id'];
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
		$this->data['category_list'] = $category_list = $this->Category_Model->getData();
		$this->data['brands'] = $this->Common_Model->getDropdownValues(array('select'=>'*' , 'from'=>'brand_master' , 'where'=>" id > 0 and  status = 1 and is_deleted = 0  "));
		$this->data['taxs'] = $this->Common_Model->getDropdownValues(array('select'=>'*' , 'from'=>'tax' , 'where'=>" id > 0 and  status = 1 and is_deleted = 0  "));

		$this->data['product_attributes'] = $this->Common_Model->getDropdownValues(array('select'=>'*' , 'from'=>'product_attribute' , 'where'=>" id > 0 and  status = 1 and is_deleted = 0"));
		$this->data['product_attributes_values'] = $this->Common_Model->getDropdownValues(array('select'=>'*' , 'from'=>'product_attribute_value' , 'where'=>" id > 0  and  status = 1 and is_deleted = 0"));
		$this->data['units'] = $this->Common_Model->getDropdownValues(array('select'=>'*' , 'from'=>'units' , 'where'=>" id > 0  and  status = 1 and is_deleted = 0"));
		$this->data['product_attribute_list'] =  $product_attribute_list = $this->Common_Model->getData(array('select'=>'*' , 'from'=>'product_attribute' , 'where'=>"id  >0 and status = 1 and is_deleted = 0"));
		$this->data['product_image_detail']=$this->Product_Model->get_product_images(array("product_id"=>$id));

			$this->form_validation->set_rules('product_display_name', 'Product Display Name', 'required');
			$this->form_validation->set_rules('ref_code', 'Ref Code', 'required');
			$this->form_validation->set_rules('uom_id', 'Units', 'required');
			//$this->form_validation->set_rules('select_product_attribute_id', 'Attribute Name', 'required');
			//$this->form_validation->set_rules('select_product_attribute_value_id', 'Attribute Value', 'required');
			$this->form_validation->set_rules('quantity', 'Quantity', 'required');
			$this->form_validation->set_rules('price', 'price', 'required');
			//$this->form_validation->set_rules('discounted_price', 'Discounted Price', 'required');
			$this->form_validation->set_rules('discount_var', 'discount_var', 'required');
			$this->form_validation->set_rules('final_price', 'final_price', 'required');
			$this->form_validation->set_rules('product_weight', 'product_weight', 'required');

			 $this->form_validation->set_rules('product_l', 'product_l', 'required');
			$this->form_validation->set_rules('product_b', 'product_b', 'required');
			$this->form_validation->set_rules('product_h', 'product_h', 'required');

			//$this->form_validation->set_rules('status', 'Status', 'numeric|trim|required|min_length[1]|max_length[1]');
			$this->form_validation->set_error_delimiters('<div class="error alert alert-danger">', '<a href="#" class="btn close" data-bs-dismiss="alert" aria-label="close" title="Close">&times;</a></div>');
			if ($this->form_validation->run() == true)
			{
				$this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');

				$product_combination_id=$_POST['product_combination_id'];
				$entereddata = $this->input->post($this->Product_Model->product_combination_fields);
						$is_add_seo_data = false;
				if(isset($_POST['status'])){
					$entereddata['status'] = $_POST['status'];
				}else{
					$entereddata['status'] = 0;
				}
				if(isset($_POST['trending_now'])){
					$entereddata['trending_now'] = $_POST['trending_now'];
				}else{
					$entereddata['trending_now'] = 0;
				}
				if(isset($_POST['hot_selling_now'])){
					$entereddata['hot_selling_now'] = $_POST['hot_selling_now'];
				}else{
					$entereddata['hot_selling_now'] = 0;
				}
				if(isset($_POST['best_sellers'])){
					$entereddata['best_sellers'] = $_POST['best_sellers'];
				}else{
					$entereddata['best_sellers'] = 0;
				}
				if(isset($_POST['new_product'])){
					$entereddata['new_product'] = $_POST['new_product'];
				}else{
					$entereddata['new_product'] = 0;
				}
				// echo "<pre>";
				// print_r(	$entereddata);
				// echo "</pre>";
				// die;
	if(!empty($product_combination_id))
	{
		$entereddata['updated_by']=$this->session->userdata("sess_user_id");
		$entereddata['updated_on']=date('Y-m-d H:i:s');
		unset($entereddata['id']);
		$condition="(id = '$product_combination_id')";
		$insertStatus = $this->Admin_model->update($entereddata,'product_combination',$product_combination_id , $condition);
		if(!empty($insertStatus))
		{
			$alert_message = '<div class="alert alert-success alert-dismissible"><button type="button" class="btn close" data-bs-dismiss="alert" aria-hidden="true">×</button><i class="icon fas fa-check"></i> Combination Updated Successfully </div>';
			$this->session->set_flashdata('alert_message', $alert_message);
		}
		if($insertStatus >= 1 )
		{
			if(!empty($_POST['is_update_store']))
			{
				if($_POST['is_update_store']==1)
				{
					$this->load->model('SecureRegions/Store_Model');
					$stores_data = $this->Common_Model->getName(array("select"=>'*' , "from"=>'stores' , "where"=>'id > 0'));
					if(!empty($stores_data))
					{
						foreach($stores_data as $sd)
						{
							$product_id = $_POST['product_id'];
							$product_comb_id = $product_combination_id;
							$store_id = $sd->id;
							$pis_condition = "(product_id = $product_id and product_combination_id = $product_comb_id and store_id = $store_id)";
							$product_in_store_data = $this->Common_Model->getName(array("select"=>'*' , "from"=>'product_in_store' , "where"=>$pis_condition));
							if(empty($product_in_store_data))
							{
								$storeinsertStatus = 0;
								$StoreData['store_id']=$store_id;
								$StoreData['product_id']=$product_id;
								$StoreData['product_combination_id']=$product_comb_id;
								$StoreData['status']=1;
								$StoreData['admin_status']=3;
								$StoreData['added_by']=$this->data['session_uid'];
								$StoreData['added_on']=date('Y-m-d H:i:s');
								$product_in_store_id = $storeinsertStatus = $this->Store_Model->add($StoreData,'product_in_store');
							}
							else
							{
								$product_in_store_id = $product_in_store_data[0]->id;
							}
							if($product_in_store_id>0)
							{
								$price = $_POST['price'];
								$quantity = $_POST['quantity'];
								$final_price = $_POST['final_price'];
								$discount = $_POST['discount'];
								$delivery_charges = $_POST['delivery_charges'];
								$discount_var = $_POST['discount_var'];
								$product_id = $_POST['product_id'];
								$product_combination_id = $product_comb_id;
								$product_in_store_id = $product_in_store_id;
								if(empty($discount) || $discount<=0)
								{
									$discount='';
									$discount_var='';
								}
								//$data_prod_price_qty['quantity_per_order'] = $quantity_per_order;
								//$data_prod_price_qty['stock_out_msg'] = $stock_out_msg;
								$data_prod_price_qty['quantity'] = $quantity;
								$data_prod_price_qty['price'] = $price;
								$data_prod_price_qty['discount'] = $discount;
								$data_prod_price_qty['delivery_charges'] = $delivery_charges;
								$data_prod_price_qty['discount_var'] = $discount_var;
								$data_prod_price_qty['final_price'] = $final_price;
								$data_prod_price_qty['updated_by']=$this->data['session_uid'];
								$data_prod_price_qty['updated_on']=date('Y-m-d H:i:s');
								$condition = "(id in ($product_in_store_id) )";
								$insertStatus = $this->Store_Model->update($data_prod_price_qty,'product_in_store','' , $condition); //echo $insertStatus;
							}
						}
					}
				}
			}
			$msg='update';
		}
	}
	else
	{
		// echo "<pre>";
		// print_r($_POST);
		// echo "</pre>";
		// print_r($entereddata);
		// die;
		$entereddata['added_by']=$this->data['session_uid'];
		$entereddata['added_on']=date('Y-m-d H:i:s');
		$product_comb_id = $insertStatus = $this->Admin_model->add($entereddata,'product_combination');
		if(!empty($insertStatus))
		{
			$alert_message = '<div class="alert alert-success alert-dismissible"><button type="button" class="btn close" data-bs-dismiss="alert" aria-hidden="true">×</button><i class="icon fas fa-check"></i> New Combination Added Successfully </div>';
			$this->session->set_flashdata('alert_message', $alert_message);
		}
		if($insertStatus >= 1 )
		{
			$is_add_seo_data = true;
			if(!empty($_POST['is_update_store']))
			{
				if($_POST['is_update_store']==1)
				{
					$this->load->model('SecureRegions/Store_Model');
					$stores_data = $this->Common_Model->getName(array("select"=>'*' , "from"=>'stores' , "where"=>'id > 0'));
					if(!empty($stores_data))
					{
						foreach($stores_data as $sd)
						{
							$product_id = $_POST['product_id'];
							$product_comb_id = $product_comb_id;
							$store_id = $sd->id;
							$storeinsertStatus = 0;
							$StoreData['store_id']=$store_id;
							$StoreData['product_id']=$product_id;
							$StoreData['product_combination_id']=$product_comb_id;
							$StoreData['status']=1;
							$StoreData['admin_status']=3;
							$StoreData['added_by']=$this->data['session_uid'];
							$StoreData['added_on']=date('Y-m-d H:i:s');
							$product_in_store_id = $storeinsertStatus = $this->Store_Model->add($StoreData,'product_in_store');
							if($product_in_store_id>0)
							{
								$price = $_POST['price'];
								$quantity = $_POST['quantity'];
								$final_price = $_POST['final_price'];
								$discount = $_POST['discount'];
								$delivery_charges = $_POST['delivery_charges'];
								$discount_var = $_POST['discount_var'];
								$product_id = $_POST['product_id'];
								$product_combination_id = $product_comb_id;
								$quantity_per_order = '100';
								$stock_out_msg = 'Sold Out';
								$product_in_store_id = $product_in_store_id;
								if(empty($discount) || $discount<=0)
								{
									$discount='';
									$discount_var='';
								}
								$data_prod_price_qty['quantity_per_order'] = $quantity_per_order;
								$data_prod_price_qty['stock_out_msg'] = $stock_out_msg;
								$data_prod_price_qty['quantity'] = $quantity;
								$data_prod_price_qty['price'] = $price;
								if(empty($discount)){
									$data_prod_price_qty['discount'] = 0;

								}else{
									$data_prod_price_qty['discount'] = $discount;

								}
								$data_prod_price_qty['delivery_charges'] = $delivery_charges;
								$data_prod_price_qty['discount_var'] = $discount_var;
								$data_prod_price_qty['final_price'] = $final_price;
								$data_prod_price_qty['updated_by']=$this->data['session_uid'];
								$data_prod_price_qty['updated_on']=date('Y-m-d H:i:s');
								$condition = "(id in ($product_in_store_id) )";
								$insertStatus = $this->Store_Model->update($data_prod_price_qty,'product_in_store','' , $condition); //echo $insertStatus;
									}
								}
							}
						}
					}
					$msg='combiSuccess';$product_combination_id = $product_comb_id;
				}
			}


			if($insertStatus>=1)
			{
				$product_attribute_id = $_POST['product_attribute_id'];
				//echo "<pre>";print_r($product_attribute_id);echo "</pre>";
				$product_attribute_value_id = $_POST['product_attribute_value_id'];
				$combination_value = $_POST['combination_value'];
				$product_id = $_POST['product_id'];
				$insertStatus = $this->Admin_model->deleteRows('product_combination_attribute' , $product_combination_id);
				for($i=0 ; $i < count($product_attribute_id) ; $i++)
				{
					$entereddataproduct_attribute['product_combination_id']=$product_combination_id;
					$entereddataproduct_attribute['product_attribute_id']=$product_attribute_id[$i];
					$entereddataproduct_attribute['product_attribute_value_id']=$product_attribute_value_id[$i];
					$entereddataproduct_attribute['product_id']=$product_id;
					$entereddataproduct_attribute['combination_value']=$combination_value[$i];
					$insertStatus = $this->Admin_model->add($entereddataproduct_attribute,'product_combination_attribute');
				}
			}
			if($is_add_seo_data)
			{
				if(empty($product_in_store_id)){$product_in_store_id='';}
				//$this->addProductSEOWithCombination($product_id , $product_comb_id , $product_in_store_id);
			}
			if($product_combination_id>0 && $product_id>0)
			{
				$_POST['is_seo_tag'] = 1;
				if(!empty($_POST['is_seo_tag']))
				{
					if($_POST['is_seo_tag']==1)
					{
						$this->addUpdateMetaDataWithCombination($product_id , $product_combination_id);
					}
				}
			}
				echo json_encode(array("status"=>1, "return_code"=>"1", "message"=>$alert_message));
				exit;

			}else{

				$this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
				print_r($this->data['message']);
				$html = $this->load->view("admin/catalog/Product_Module/edit",$this->data, true);
				echo json_encode(array("status"=>0, "return_code"=>"2", "message"=>'Something wrong please try again', "html"=>$html));
				exit;
			}


	}


	function checkProductCombinationCombiRefCode()

	{

		$product_combination_id = 0;

		$product_attribute_id = 0;

		$combination_value = 0;

		$product_attribute_value_id = 0;

		$product_seo_id = 0;

		$combination_value = '';

		$combref_code = '';

		$search = array();

		if(!empty($_POST['product_id'])){$product_id = $_POST['product_id'];}

		if(!empty($_POST['ref_code'])){$ref_code = $_POST['ref_code'];}

		if(!empty($_POST['product_combination_id'])){$product_combination_id = $_POST['product_combination_id'];}



		if(!empty($_POST['product_attribute_id'])){$product_attribute_id_arr = $_POST['product_attribute_id'];}

		if(!empty($_POST['combination_value'])){$combination_value_arr = $_POST['combination_value'];}

		if(!empty($_POST['product_attribute_value_id'])){$product_attribute_value_id_arr = $_POST['product_attribute_value_id'];}

		if(!empty($_POST['is_seo_tag'])){$is_seo_tag = $_POST['is_seo_tag'];}

		if(!empty($_POST['slug_url'])){$slug_url = $_POST['slug_url'];}

		if(!empty($_POST['product_seo_id'])){$product_seo_id = $_POST['product_seo_id'];}



		$search['product_id'] = $product_id;

		$search['ref_code'] = $ref_code;

		$search['product_combination_id'] = $product_combination_id;

		$search['product_attribute_id'] = $product_attribute_id;

		$search['combination_value'] = $combination_value;

		$search['product_attribute_value_id'] = $product_attribute_value_id;

		$search['is_seo_tag'] = $is_seo_tag;

		$search['slug_url'] = $slug_url;

		$search['product_seo_id'] = $product_seo_id;



		$is_duplicate = 'no';

		for($i=0 ; $i< count($product_attribute_id_arr) ; $i++)

		{

			$product_attribute_id = $product_attribute_id_arr[$i];

			$combination_value = $combination_value_arr[$i];

			$product_attribute_value_id = $product_attribute_value_id_arr[$i];



			$temp_combi_data = $this->Common_Model->getData(array('select'=>'*' , 'from'=>'product_combination_attribute' , 'where'=>"product_id = $product_id and product_combination_id != $product_combination_id and product_attribute_id = $product_attribute_id and product_attribute_value_id = $product_attribute_value_id and combination_value = '$combination_value'" ));



			//$is_duplicate = 'no';

		}

		//print_r($temp_combi_data);

				$search['product_id'] = $product_id;

		$search['product_combination_id'] = $product_combination_id;

		$search['slug_url'] = $slug_url;

		$search['product_seo_id'] = $product_seo_id;

		$position_status = $this->Product_Model->checkSlugUrl($search);

		//$position_status=$this->Product_Model->checkSlugUrl($combref_code,'product_combination_ref_code',$product_id , $product_combination_id);
		//echo $this->db->last_query();

		//echo $position_status;



		if(empty($position_status))

		{

			if(!empty($temp_combi_data))

			{

				$position_status = "combi_duplicate";

			}

		}

		else //if(empty($position_status))

		{
			$position_status = "slug_duplicate";

			if($is_seo_tag==1 && false)

			{

				//$slugstatus=$this->Admin_model->checkSlugUrl($slug_url,'product_seo',$product_seo_id);

				$slugstatus = $this->Product_Model->checkSlugUrl($search);

				if(!empty($slugstatus))

				{

					$position_status = "slug_duplicate";

				}

			}

		}

		/*else

		{

			$position_status = "";

		}
*/
		//echo json_encode(array("position_status"=>"exist"));

		echo json_encode(array("position_status"=>$position_status));

	}

	function addUpdateMetaDataWithCombination($product_id , $product_combination_id )

	{

		$entereddata = $this->input->post(

		$this->Admin_model->product_seo_fields);

		//echo var_dump($_POST);

		$product_seo_id=$_POST['product_seo_id'];

		$entereddata['store_id'] = 1;

		$entereddata['product_combination_id'] = $product_combination_id;

		$entereddata['product_in_store_id'] = 0;

		unset($entereddata['others']);

		if(!empty($product_seo_id)){
			unset($entereddata['id']);
			$entereddata['updated_by']=$this->data['session_uid'];

			$entereddata['updated_on']=date('Y-m-d H:i:s');

			$condition="(id = '$product_seo_id')";

			$insertStatus = $this->Admin_model->update($entereddata,'product_seo',$product_seo_id , $condition);

			if($insertStatus >= 1 )

			{$msg='update';}

		}else{

			$entereddata['added_by']=$this->data['session_uid'];

			$entereddata['added_on']=date('Y-m-d H:i:s');

			$insertStatus = $this->Admin_model->add($entereddata,'product_seo');

			if($insertStatus >= 1 )

			{$msg='success';$product_seo_id = $insertStatus;}

		}

	}

	function doAddProductImages()
	{
		$this->data['page_type'] = "list";

		$user_access = $this->data['user_access'] = $this->data['User_auth_obj']->check_user_access(array("module_id"=>$this->data['page_module_id']));
		$alert_message = '<div class="alert alert-danger alert-dismissible"><button type="button" class="btn close" data-bs-dismiss="alert" aria-hidden="true">×</button><i class="icon fas fa-ban"></i> Something Went Wrong. Please Try Again. </div>';
		if(empty($_POST['product_id']))
		{
			$alert_message = '<div class="alert alert-danger alert-dismissible"><button type="button" class="btn close" data-bs-dismiss="alert" aria-hidden="true">×</button><i class="icon fas fa-ban"></i> Something Went Wrong. Please Try Again.</div>';
			$this->session->set_flashdata('alert_message', $alert_message);
			REDIRECT(MAINSITE_Admin.$user_access->class_name."/".$user_access->function_name);
			exit;
		}
		//print_r($_POST);
		$product_id = '';
		$product_id = $_POST['product_id'];
		if(empty($this->data['user_access']))
		{
			REDIRECT(MAINSITE_Admin."wam/access-denied");
		}
		if(empty($product_id))
		{
			if($user_access->add_module!=1)
			{
				$this->session->set_flashdata('no_access_flash_message' , "You Are Not Allowed To Add ".$user_access->module_name);
				REDIRECT(MAINSITE_Admin."wam/access-denied");
			}
		}
		if(!empty($product_id))
		{
			if($user_access->update_module!=1)
			{
				$this->session->set_flashdata('no_access_flash_message' , "You Are Not Allowed To Update ".$user_access->module_name);
				REDIRECT(MAINSITE_Admin."wam/access-denied");
			}
		}
		$msg = 'fail';
		$image = $_FILES['image'];
		$image_hide = $_FILES['image']['name'];
		if(count($image_hide) > 0)
		{
			for($i=0 ; $i< count($image_hide) ; $i++)
			{
				if(!empty($_FILES["image"]['name'][$i]) && !empty($image['tmp_name'][$i]))
				{
					$max_image_id=$this->Admin_model->getMaxid('id','product_image');
					$max_image_position=$this->Admin_model->getMaxPosition('position','product_image_position' , $product_id);
					$image_name = $_FILES['image']['name'][$i];
					$end = explode(".",strtolower($image_name));
					$image_ext = end($end);
					$image_name_new = "product_".$product_id."_".$max_image_id.".".$image_ext;
					$imagedata['product_id']=$product_id;
					$imagedata['position']=$max_image_position;
					$imagedata['product_image_name']=$image_name_new;
					$imagedata['status']=1;
					$imagedata['default_image']=0;
					// if($i==0){$imagedata['default_image']=1;}else{$imagedata['default_image']=0;}
					$entereddata['added_by'] = $this->data['session_uid'];
					$imagedata['added_on']=date('Y-m-d H:i:s');
					$imginsertStatus = $this->Common_Model->add_operation(array('table'=>'product_image' , 'data'=>$imagedata));
					if(!empty($imginsertStatus))
					{
						$alert_message = '<div class="alert alert-success alert-dismissible"><button type="button" class="btn close" data-bs-dismiss="alert" aria-hidden="true">×</button><i class="icon fas fa-check"></i> Images Added Successfully </div>';
						$this->session->set_flashdata('alert_message', $alert_message);
					}
					if($imginsertStatus>=1)
					{
						$uploadedfile = $_FILES['image']['tmp_name'][$i];
						 $originalImage = imagecreatefrompng($_FILES['image']['tmp_name'][$i]);
						$src = imagecreatefromstring(file_get_contents($uploadedfile));
						list($width,$height)=getimagesize($uploadedfile);
						$newwidth=150;
						$newheight=($height/$width)*$newwidth;
						$tmp=imagecreatetruecolor($newwidth,$newheight);
						$newwidth1=400;
						$newheight1=($height/$width)*$newwidth1;
						$tmp1=imagecreatetruecolor($newwidth1,$newheight1);
						$newwidth2=1200;
						$newheight2=($height/$width)*$newwidth2;
						$tmp2=imagecreatetruecolor($newwidth2,$newheight2);
						//removing black backgroung for image. // imagecreatetruecolor() will create black ground by default.
						imagefill($tmp,0,0,imagecolorallocate($tmp, 255, 255, 255));
						imagefill($tmp1,0,0,imagecolorallocate($tmp1, 255, 255, 255));
						imagefill($tmp2,0,0,imagecolorallocate($tmp2, 255, 255, 255));
						// imagealphablending($tmp, false);
						// imagesavealpha($tmp, true);

						imagecopyresampled($tmp,$src,0,0,0,0,$newwidth,$newheight,$width,$height);
						imagecopyresampled($tmp1,$src,0,0,0,0,$newwidth1,$newheight1,$width,$height);
						imagecopyresampled($tmp2,$src,0,0,0,0,$newwidth2,$newheight2,$width,$height);
						$filename = _uploaded_temp_files_."product/small/". $image_name_new;
						$filename1 = _uploaded_temp_files_."product/medium/". $image_name_new;
						$filename2 = _uploaded_temp_files_."product/large/". $image_name_new;

						imagepng($tmp,$filename,9);
						imagepng($tmp1,$filename1,9);
						imagepng($tmp2,$filename2,9);
						//move_uploaded_file ($_FILES['image']['tmp_name'][$i],"products/product/".$image_name_new);
					}
				}
			}
		}

		if(!empty($_POST['default_image_option'])){
			$up_data = array();
			$up_data['image'] = $_POST['default_image_option'];
			$this->Common_Model->update_operation(array('table'=>'product', 'data'=>$up_data, 'condition'=>"id = $product_id"));

			$alert_message = '<div class="alert alert-success alert-dismissible"><button type="button" class="btn close" data-bs-dismiss="alert" aria-hidden="true">×</button><i class="icon fas fa-check"></i>Product Images Updated successfully. </div>';

		}

		$this->session->set_flashdata('alert_message', $alert_message);
		//$this->session->set_flashdata('alert_message', $alert_message);

		if(!empty($_POST['redirect_type']))
		{
			REDIRECT($_SERVER['HTTP_REFERER']);
			//REDIRECT(MAINSITE_Admin.$user_access->class_name."/edit");
			//REDIRECT(MAINSITE_Admin.$user_access->class_name."/edit/".$product_id);
		}

		REDIRECT($_SERVER['HTTP_REFERER']);
		//REDIRECT(MAINSITE_Admin.$user_access->class_name."/edit/".$product_id);
		//REDIRECT(MAINSITE_Admin.$user_access->class_name."/".$user_access->function_name);
	}
	function doDeleteImage()
	{
		$product_image_id = $_POST['product_image_id'];
		$product_id = $_POST['product_id'];

		$image_data = $this->Common_Model->getData(array('select'=>'*' , 'from'=>'product_image' , 'where'=>"id = $product_image_id"));

		$alert_message = '<div class="alert alert-danger alert-dismissible"><button type="button" class="btn close" data-bs-dismiss="alert" aria-hidden="true">×</button><i class="icon fas fa-ban"></i> Something Went Wrong. Please Try Again. </div>';

		if(!empty($image_data))
		{
			$image_data = $image_data[0];
			@unlink("assets/uploads/product/small/".$image_data->product_image_name);
			@unlink("assets/uploads/product/medium/".$image_data->product_image_name);
			@unlink("assets/uploads/product/large/".$image_data->product_image_name);
			$image_data = $this->Common_Model->delete_operation(array('table'=>'product_image' , 'where'=>"id = $image_data->id"));

			$alert_message = '<div class="alert alert-success alert-dismissible"><button type="button" class="btn close" data-bs-dismiss="alert" aria-hidden="true">×</button><i class="icon fas fa-check"></i> Image deleted successfully. </div>';
		}
		$this->session->set_flashdata('alert_message', $alert_message);
		REDIRECT($_SERVER['HTTP_REFERER']);
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

		$this->data['category_list'] = $category_list = $this->Category_Model->getData();
		$this->data['brands'] = $this->Common_Model->getDropdownValues(array('select'=>'*' , 'from'=>'brand_master' , 'where'=>" id > 0 and  status = 1 and is_deleted = 0  "));
		$this->data['taxs'] = $this->Common_Model->getDropdownValues(array('select'=>'*' , 'from'=>'tax' , 'where'=>" id > 0 and  status = 1 and is_deleted = 0  "));

		// echo "<pre>";
		// print_r($category_list);
		// echo "</pre>";die;
		$this->data['product_attributes'] = $this->Common_Model->getDropdownValues(array('select'=>'*' , 'from'=>'product_attribute' , 'where'=>" id > 0  and  status = 1 and is_deleted = 0"));

		$this->data['page_is_master'] = $this->data['user_access']->is_master;
		$this->data['page_parent_module_id'] = $this->data['user_access']->parent_module_id;
		if(!empty($id)){
			$this->data['list_data'] = $this->Product_Model->getData(array("id"=>$id));
			$this->data['product_category_detail'] = $this->Product_Model->get_product_category(array("product_id"=>$id));
			$product_id = $id ;

			$this->data['product_image_detail']=$this->Product_Model->get_product_images(array("product_id"=>$product_id));
			$this->data['product_attribute_list'] = $this->Product_Model->get_product_attribute_list();
			$this->data['attribute_value_list'] = $this->Product_Model->get_attribute_value_list();
			$this->data['product_combination_detail'] = $this->Product_Model->get_product_combination_detail(array("product_id"=>$product_id));
			$this->data['product_combination_attribute_detail'] = $this->Product_Model->get_product_combination_attribute_detail(array("product_id"=>$product_id));
			//print_r(	$this->data['product_combination_detail']);die;

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
		 $module_html = $this->load->view('admin/catalog/Product_Module/edit' , $this->data,true);
		echo json_encode(array('module_data'=>$module_html));
		exit;
	}
	function GetCompleteProductImageListNewPos()
{
	//echo "<pre>"; print_r($_POST); echo "</pre>"; exit;

	$search = array();
	$product_id = 0;
	$podId = '';
	$podIdArr = '';
	if(!empty($_POST['product_id']))
		$product_id = $_POST['product_id'];
	if(!empty($_POST['podId']))
	{
		$podId = trim($_POST['podId'] , ',');
		$podIdArr = explode(',' , $podId);
	}
	$this->data['product_id'] = $product_id;
	$this->data['podId'] = $podIdArr;
	$search['product_id'] = $product_id;
	$search['podId'] = $podIdArr;
	//$search['search_for'] = "count";
	$show = "No Record To Display";
	$product_image_list = $this->Product_Model->get_product_images($search);

	$count=0;
	$countPos=0;
	foreach($product_image_list as $row)
	{
		// echo "<pre>";
		// print_r($row);
		// echo "</pre>";

		$countPos++;
		$update_data['position']=$countPos;//$podIdArr[$count];
		$condition = "(id in ($podIdArr[$count]))";
		//$insertStatus = $this->Admin_model->update($update_data,'category','' , $condition); //echo $insertStatus;
		$insertStatus = $this->Common_Model->update_operation(array('table'=>'product_image', 'data'=>$update_data, 'condition'=>$condition));
		//echo $this->db->last_query().'<br><br><br><br><br>';
		$count++;
	}

	$this->GetCompleteProductImageList();
}

function GetCompleteProductImageList()
{
	$search = array();
	$search['search_for'] = "count";
	$product_id = 0;
	if(!empty($_POST['product_id'])){$product_id = $_POST['product_id'];}
	$search['product_id'] = $product_id;
	//$data['product_image_list'] = $this->Product_Model->get_category($search);
	$product_image_list = $this->Product_Model->get_product_images($search);
	$data_count = $this->Product_Model->get_product_images($search);
	if(!empty($data_count))
		$r_count = $this->data['row_count'] = $data_count[0]->counts;
	else
		$r_count = $this->data['row_count'] = 0;
	unset($search['search_for']);
	$product_image_list = $this->Product_Model->get_product_images($search);
	//$data['category_list']=$this->Product_Model->get_category('category_list','', '',$super_category_id, '','', '','', $sortByPosition);
	//print_r($data['category_list']);
	$show='';
	$count=0;
	print_r($product_image_list);
	foreach($product_image_list as $row)
	{
		$count++;
		$show.="<tr id='$row->product_image_id'>";
		$show.='<td><a target="_blank" href="'._uploaded_files_.'product/large/'.$row->product_image_name.'" ><img src="'._uploaded_files_.'product/small/'.$row->product_image_name.'" width="100" /></a></td>';
		$show.='<td><span style="cursor: move;" class="fa fa-arrows-alt" aria-hidden="true"></span> '.$row->position.'</td>';
		if($row->default_image==1)
		{
			//$show.='<td class="text-center"><input id="checkBoxId_'.$row->product_image_id.'" checked class="checkBoxClass" onclick="setProductDefaultImage('.$row->product_image_id.' , '.$row->product_id.')" type="checkbox" /></td>';
		}
		else
		{
			//$show.='<td class="text-center"><input id="checkBoxId_'.$row->product_image_id.'" class="checkBoxClass" onclick="setProductDefaultImage('.$row->product_image_id.' , '.$row->product_id.')" type="checkbox" /></td>';
		}
		if($row->product_combination_id <=0 || $row->product_combination_id == NULL)
		{
			$show.='<td class="text-right"><a class="btn btn-default" href="'._uploaded_files_.'product/large/'.$row->product_image_name.'" target="_blank"><i class="fa fa-eye"></i>View This Image</a>
			<form action="'.MAINSITE_Admin.'catalog/Product-Module/doDeleteImage" method="post" onsubmit="return ConfirmImage()">'.form_open(MAINSITE_Admin.'catalog/Product-Module/doDeleteImage', array('method' => 'post', 'id' => 'product_delete_form' , "name"=>"product_delete_form", 'style' => '', 'class' => 'form-horizontal', 'role' => 'form', 'enctype' => 'multipart/form-data', 'onsubmit' => 'return ConfirmImage()')).'<input type="hidden" name="product_image_id" value="'.$row->product_image_id.'" /><input type="hidden" name="product_id" value="'.$row->product_id.'" /><button type="submit" class="btn btn-default" ><i class="fa fa-trash"></i>Delete</button>'.form_close().'</td>';
		}
		else
		{
			$show.='<td class="text-right"><a  target="_blank"class="btn btn-primary example-image-link" href="'._uploaded_files_.'product/large/'.$row->product_image_name.'" data-lightbox="example-set" ><i class="fa fa-eye"></i>View This Image</a></td>';
		}
		$show.='</tr>';
	}
	echo $show;
}
	function combination_edit($id="",$product_id="")
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
		$this->data['category_list'] = $category_list = $this->Category_Model->getData();
		$this->data['brands'] = $this->Common_Model->getDropdownValues(array('select'=>'*' , 'from'=>'brand_master' , 'where'=>" id > 0 and  status = 1 and is_deleted = 0  "));
		$this->data['taxs'] = $this->Common_Model->getDropdownValues(array('select'=>'*' , 'from'=>'tax' , 'where'=>" id > 0 and  status = 1 and is_deleted = 0  "));

		$this->data['product_attributes'] = $this->Common_Model->getDropdownValues(array('select'=>'*' , 'from'=>'product_attribute' , 'where'=>" id > 0 and  status = 1 and is_deleted = 0"));
		$this->data['product_attributes_values'] = $this->Common_Model->getDropdownValues(array('select'=>'*' , 'from'=>'product_attribute_value' , 'where'=>" id > 0  and  status = 1 and is_deleted = 0"));
		$this->data['units'] = $this->Common_Model->getDropdownValues(array('select'=>'*' , 'from'=>'units' , 'where'=>" id > 0  and  status = 1 and is_deleted = 0"));
		$this->data['product_attribute_list'] =  $product_attribute_list = $this->Common_Model->getData(array('select'=>'*' , 'from'=>'product_attribute' , 'where'=>"id  >0 and status = 1 and is_deleted = 0"));
		$this->data['product_image_detail']=$this->Product_Model->get_product_images(array("product_id"=>$product_id));

		$this->data['product_id'] = $product_id;
		$this->data['page_is_master'] = $this->data['user_access']->is_master;
		$this->data['page_parent_module_id'] = $this->data['user_access']->parent_module_id;
		if(!empty($id)){

			$this->data['product_combination_detail'] = $this->Product_Model->get_product_combination_detail(array("id"=>$id));
			$this->data['product_combination_attribute_detail'] = $this->Product_Model->get_product_combination_attribute_detail(array("product_id"=>$product_id));

			//$this->data['list_data'] = $this->Product_Model->getData(array("id"=>$id));
			if(empty($this->data['product_combination_detail']))
			{
				$this->session->set_flashdata('alert_message', '<div class="alert alert-danger alert-dismissible">
					<button type="button" class="btn close" data-bs-dismiss="alert" aria-hidden="true">×</button>
					<i class="icon fa fa-ban"></i> Record Not Found.
				  </div>');
				REDIRECT(MAINSITE_Admin.$user_access->class_name.'/'.$user_access->function_name);
			}
			$this->data['product_combination_detail'] = $this->data['product_combination_detail'][0];
		}
		 $module_html = $this->load->view('admin/catalog/Product_Module/product_combination_edit' , $this->data,true);
		echo json_encode(array('module_data'=>$module_html));
		exit;
	}

	function doEdit()
	{
		$this->data['page_type'] = "list";

		$user_access = $this->data['user_access'] = $this->data['User_auth_obj']->check_user_access(array("module_id"=>$this->data['page_module_id']));


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
		$this->data['category_list'] = $category_list = $this->Category_Model->getData();

		$this->data['category_list'] = $category_list = $this->Category_Model->getData();
		$this->data['brands'] = $this->Common_Model->getDropdownValues(array('select'=>'*' , 'from'=>'brand_master' , 'where'=>" id > 0 and  status = 1 and is_deleted = 0  "));
		$this->data['taxs'] = $this->Common_Model->getDropdownValues(array('select'=>'*' , 'from'=>'tax' , 'where'=>" id > 0 and  status = 1 and is_deleted = 0  "));

		//product_data



			$this->form_validation->set_rules('name', 'Name', 'required');
			$this->form_validation->set_rules('hsn_code', 'HSN Code', 'required');
			$this->form_validation->set_rules('brand_id', 'Brand', 'required');
			$this->form_validation->set_rules('tax_id', 'Tax', 'required');
			$this->form_validation->set_rules('ref_code', 'Reference Code', 'required');

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
				$enter_data['hsn_code'] = $_POST['hsn_code'];
				$enter_data['ref_code'] = $_POST['ref_code'];
				$enter_data['short_description'] = $_POST['short_description'];
				$enter_data['long_description'] = $_POST['long_description'];
				$enter_data['brand_id'] = $_POST['brand_id'];
				$enter_data['tax_id'] = $_POST['tax_id'];

				if(isset($_POST['status'])){
					$enter_data['status'] = $_POST['status'];
				}else{
					$enter_data['status'] = 0;
				}
				if(isset($_POST['is_bulk_enquiry'])){
					$enter_data['is_bulk_enquiry'] = $_POST['is_bulk_enquiry'];
				}else{
					$enter_data['is_bulk_enquiry'] = 0;
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
					$insertStatus = $id =  $this->Common_Model->add_operation(array('table'=>$this->data['table_name'] , 'data'=>$enter_data));
					if(!empty($insertStatus))
					{
						$alert_message = ' New Record Added Successfully';
					}


				}
				if($id > 0){
					if(isset($_FILES['image'])){
						$image = $_FILES['image'];
						$image_hide = $_FILES['image']['name'];
						if(count($image_hide) > 0)
						{
							for($i=0 ; $i< count($image_hide) ; $i++)
							{
								if(!empty($_FILES["image"]['name'][$i]) && !empty($image['tmp_name'][$i]))
								{
									$max_image_id=$this->Admin_model->getMaxid('id','product_image');
									$max_image_position=$this->Admin_model->getMaxPosition('position','product_image_position' , $id);
									$image_name = $_FILES['image']['name'][$i];
									$end = explode(".",strtolower($image_name));
									$image_ext = end($end);
									$image_name_new = "product_".$id."_".$max_image_id.".".$image_ext;
									$imagedata['product_id']=$id;
									$imagedata['position']=$max_image_position;
									$imagedata['product_image_name']=$image_name_new;
									$imagedata['status']=1;
									if($i==0){$imagedata['default_image']=1;}else{$imagedata['default_image']=0;}
									$entereddata['added_by'] = $this->data['session_uid'];
									$imagedata['added_on']=date('Y-m-d H:i:s');
									$imginsertStatus = $this->Common_Model->add_operation(array('table'=>'product_image' , 'data'=>$imagedata));
									if($imginsertStatus>=1)
									{
										$uploadedfile = $_FILES['image']['tmp_name'][$i];
										$src = imagecreatefromstring(file_get_contents($uploadedfile));
										list($width,$height)=getimagesize($uploadedfile);
										$newwidth=150;
										$newheight=($height/$width)*$newwidth;
										$tmp=imagecreatetruecolor($newwidth,$newheight);
										$newwidth1=400;
										$newheight1=($height/$width)*$newwidth1;
										$tmp1=imagecreatetruecolor($newwidth1,$newheight1);
										$newwidth2=1200;
										$newheight2=($height/$width)*$newwidth2;
										$tmp2=imagecreatetruecolor($newwidth2,$newheight2);

										//removing black backgroung for image. // imagecreatetruecolor() will create black ground by default.
										imagefill($tmp,0,0,imagecolorallocate($tmp, 255, 255, 255));
										imagefill($tmp1,0,0,imagecolorallocate($tmp1, 255, 255, 255));
										imagefill($tmp2,0,0,imagecolorallocate($tmp2, 255, 255, 255));


										imagecopyresampled($tmp,$src,0,0,0,0,$newwidth,$newheight,$width,$height);
										imagecopyresampled($tmp1,$src,0,0,0,0,$newwidth1,$newheight1,$width,$height);
										imagecopyresampled($tmp2,$src,0,0,0,0,$newwidth2,$newheight2,$width,$height);
										$filename = _uploaded_temp_files_."product/small/". $image_name_new;
										$filename1 = _uploaded_temp_files_."product/medium/". $image_name_new;
										$filename2 = _uploaded_temp_files_."product/large/". $image_name_new;
										// imagejpeg($tmp,$filename,30);
										// imagejpeg($tmp1,$filename1,35);
										// imagejpeg($tmp2,$filename2,40);
										imagepng($tmp,$filename,9);
										imagepng($tmp1,$filename1,9);
										imagepng($tmp2,$filename2,9);
										//move_uploaded_file ($_FILES['image']['tmp_name'][$i],"products/product/".$image_name_new);
									}
								}
							}
						}
					}

					$category_id_arr = $_POST['category_id'];
					$insertStatus = $this->Admin_model->deleteRows('product_category' , $id);
					for($i = 0 ; $i<count($category_id_arr) ; $i++)
					{
						$categorydata['product_id']=$id;
						$categorydata['category_id']=$category_id_arr[$i];
						$catinsertStatus = $this->Common_Model->add_operation(array('table'=>'product_category' , 'data'=>$categorydata));
					}
				}
				echo json_encode(array("status"=>1, "return_code"=>"1", "message"=>$alert_message));
				exit;

			}else{

				$this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');

				$html = $this->load->view("admin/catalog/Product_Module/edit",$this->data, true);
				echo json_encode(array("status"=>0, "return_code"=>"2", "message"=>'Something wrong please try again', "html"=>$html));
				exit;
			}



	}
	function checkProductRefCode()
{
	$response["response"] = 0;
	$product_id = $_POST['product_id'];
	$ref_code = $_POST['ref_code'];
	$position_status=$this->Admin_model->checkSlugUrl($ref_code,'product_ref_code',$product_id);
	//echo $this->db->last_query();
	if(empty($position_status))
	{
		$response["response"] = 1;
	}
	echo json_encode($response);
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
					$this->load->view('admin/catalog/Product_Module/export' , $this->data);
				  $action_taken = "Exported";
				}
				if($task=="pdf")
				{
					$this->load->library('pdf');
				//	$this->data['list_data'] = $this->Common_Model->getData(array('select'=>'*' , 'from'=>$this->data['table_name'] , 'where'=>"id in ($ids)"));
					$this->data['list_data'] = $this->Common_Model->export(array('id'=>$id_arr,'table'=>$this->data['table_name']));
					$this->data['Module_name'] = 'Country';
					$html = $this->load->view('admin/catalog/Product_Module/pdf' , $this->data,true);
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
