<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include('Main.php');
class Ajax extends main {

	public function __construct()
	{
		parent::__construct();
        $this->load->database();
		$this->load->model('Ajax_model');
		$this->load->model('Common_Model');
		//$this->load->library('session');
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->data['action'] = '';
		$this->data['message']='';
	}

	function footer_category()
	{
		$this->output->cache('10');
		$this->data['footer_category'] = $this->Common_Model->getData(array('select'=>'category_id , position , name , slug_url ' , 'from'=>'category' , 'where'=>"(super_category_id =0 and status=1)" , "order_by"=>"rand()" , "limit"=>8 ));
		$this->load->view('template/footer_category',$this->data);
	}

	function getState()
	{
		$country_id = $_POST['country_id'];
		$state_id = '';if(!empty($_POST['state_id'])){$state_id = $_POST['state_id'];}
		$state=$this->Ajax_model->getState(array("country_id"=>$country_id));
		$show="<option value=''>Select State</option>";
		if(!empty($country_id))
		{
			if(!empty($state))
			{
				foreach($state as $s)
				{
					$selected='';
					if($s->id==$state_id)
						$selected='selected';
					$show.="<option $selected value='$s->id'>$s->name</option>";
				}
			}
		}
		echo $show;
	}

	function getCity()
	{
		$state_id = $_POST['state_id'];
		$city_id = $_POST['city_id'];
		$city=$this->Ajax_model->getCity(array("state_id"=>$state_id));
		$show="<option value=''>Select City</option>";
		if(!empty($state_id))
		{
			if(!empty($city))
			{
				foreach($city as $c)
				{
					$selected='';
					if($c->id==$city_id)
						$selected='selected';
					$show.="<option $selected value='$c->id'>$c->name</option>";
				}
			}
		}
		echo $show;
	}
}
