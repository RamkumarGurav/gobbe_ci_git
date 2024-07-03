<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	function __construct()
	{
        parent::__construct();
		//$this->load->database();
		$this->load->library('session');
		$this->load->model('administrator/Login_model');
		$this->load->helper('url');
		$this->data['message']='';
		$this->data['alert_message']='';
				$this->load->model('Common_Model');
		$this->load->helper('form');
		$this->load->library('form_validation');

		$this->data['session_uid']=$this->session->userdata('session_uid');
		$this->data['session_uname']=$this->session->userdata('session_uname');
		$this->data['session_uemail']=$this->session->userdata('session_uemail');
		$this->load->library('Add_Update_Data_Lib');

		$this->_audl = $this->data['_audl'] = new Add_Update_Data_Lib();

		$this->data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
    }


		public function save_new_password()
	{
			$user_id = $_POST['user_id'];
			$token = $_POST['token'];
			$mp_data['show_password'] = $_POST['password'];
			$mp_data['password'] = md5($_POST['password']);

		 $this->Common_Model->update_operation(array('table'=>'user', 'data'=>$mp_data, 'condition'=>"id = $user_id"));
			$this->Common_Model->update_operation(array('table'=>'th_admin_resetpwd_token', 'data'=>array('used'=>1), 'condition'=>"token = '$token'"));
			echo json_encode(array('status'=>1,'message'=> "Your password is changed successfully&nbsp;<a href='".MAINSITE_Admin."' style='color:blue;'>Click Here To Login</a>"));
			die;
	}
	function getRandomString($length)
{
	$validCharacters = "ABCDEFGHIJKLMNPQRSTUXYVWZ123456789";
	$validCharNumber = strlen($validCharacters);
	$result = "";

	for ($i = 0; $i < $length; $i++)
	{
		$index = mt_rand(0, $validCharNumber - 1);
		$result .= $validCharacters[$index];
	}
	return $result;
}
	public function reset_password()
	{
		$username = $_POST['username'];
		$this->db
		->select('u.*')
		->from('user as u ')
		->where("(email = '$username' or username = '$username')")
		->limit(1);
		$result = $this->db->get();
		//echo $this->db->last_query(); exit;
		if($result->num_rows() > 0 )
		{
			$result = $result->result();
			$result = $result[0];
				$status  = true;
				$token=$this->getRandomString(12);
				$email = $result->email;
				$resetpwd_data['token'] = $token;
				$resetpwd_data['email'] = $email;
				$resetpwd_data['user_fk'] = $result->id;
				$resetpwd_data['used'] = 0;
				$this->Common_Model->add_operation(array('table'=>'th_admin_resetpwd_token' , 'data'=>$resetpwd_data));

				//send Email
				$head_title = _project_name_;
				$mail_message = "<strong>User Forgot Password on "._project_name_.'</strong>';
				$mailMessage = file_get_contents(APPPATH.'mailer/reset_password_admin_side.html');
				$mailMessage = str_replace("#head_title#",stripslashes($head_title),$mailMessage);
				$mailMessage = str_replace("#token#",stripslashes($token),$mailMessage);
				$mailMessage = str_replace("#uri#",MAINSITE_Admin,$mailMessage);

				$subject = "User Forgot Password on "._project_name_;
			//	$mailStatus = $this->Common_Model->send_mail_api(array("template"=>$mailMessage , "subject"=>$subject , "to"=>strtolower($b_email) , "name"=>$name ));
			//	$mailStatus = $this->Common_Model->send_mail_api(array("template"=>$mailMessage , "subject"=>$subject , "to"=>__adminemail__ , "name"=>"BSNL" ));
				$mailStatus = $this->Common_Model->send_mail(array("template"=>$mailMessage , "subject"=>$subject , "to"=>"$email" , "name"=>_project_name_ ));
				//$mailStatus = $this->Common_Model->send_mail_api(array("template"=>$mailMessage , "subject"=>$subject , "to"=>"anil@marswebsolutions.com" , "name"=>"Login Reset" ));
				//$mailStatus = $this->Common_Model->send_mail_api(array("template"=>$mailMessage , "subject"=>$subject , "to"=>"viswa69@gmail.com" , "name"=>"Booking" ));
			//	$mailStatus = $this->Common_Model->send_mail_api(array("template"=>$mailMessage , "subject"=>$subject , "to"=>"anilkumarbora14310@gmail.com" , "name"=>"Login Reset" ));
				$message = 'We have sent the password reset link to your email id '.$email;
		}else{
			$status = false;
			$message = 'Email Id doesnot exist';
		}
		echo json_encode(array('status'=>$status,'message'=>$message));
		die;
	}
	public function admin_reset_password($token)
	{
		$this->data['th_user_resetpwd_details'] = $th_user_resetpwd_details =  $this->Common_Model->getData(array('select'=>'*' , 'from'=>'th_admin_resetpwd_token' , 'where'=>"token = '".$token."'"));
		$user_id=	$th_user_resetpwd_details[0]->user_fk;
		$used=	$th_user_resetpwd_details[0]->used;

		if($used){
			$this->session->set_flashdata('alert_message', '<div class="alert alert-danger alert-bs-dismissible">

			<button type="button" class="close" data-bs-dismiss="alert" aria-hidden="true">×</button>

			<i class="icon fas fa-ban"></i> Link Used.Please Reset Again.

			</div>');

			$temp_alert_message = $this->session->flashdata('alert_message');

			if(!empty($temp_alert_message))

			{

				$this->data['alert_message'] = $temp_alert_message;

			}
			//REDIRECT('secureRegions/');
					$this->load->view('admin/login' , $this->data);
					//die;
		}else{
			$this->data['token'] =  $token;
			$this->data['user_details'] = $user_details =  $this->Common_Model->getData(array('select'=>'*' , 'from'=>'user' , 'where'=>"id = '".$user_id."'"));

			$this->load->view('admin/reset_password' , $this->data);
			$this->data['token'] = $token;
		}

	}
	function index()
	{
		if(!empty($this->data['session_uid']) && !empty($this->data['session_uname']) && !empty($this->data['session_uemail']))
		{
			REDIRECT(MAINSITE_Admin."wam");
		}
		if(isset($_POST['login_btn']))
		{
			$login_type = $_POST['login_type'];
			if($login_type == 'otp'){
				$this->form_validation->set_rules('contact_no', "Contact No", 'required');
				$this->form_validation->set_rules('otp', 'OTP', 'required|callback_check_Otp');
			}else{
				$this->form_validation->set_rules('username', "Username", 'required');
				$this->form_validation->set_rules('password', "Password", 'required');
			}
			$this->form_validation->set_error_delimiters('<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-bs-dismiss="alert" aria-hidden="true">×</button><i class="icon fa fa-ban"></i>', '</div>');

			if ($this->form_validation->run() == true )
			{
				$this->data['alert_message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
				$response=$this->Login_model->doSignInUser();
				if($response){
					if($response->status==1)
					{
						//echo "<pre>"; print_r($response); echo "</pre>"; exit;

						$this->session->set_flashdata('alert_message', '<div class="alert alert-success alert-dismissible">
						<button type="button" class="close" data-bs-dismiss="alert" aria-hidden="true">×</button>
						<i class="icon fa fa-check"></i> You Are Login Successfully
						</div>');
						$this->session->set_userdata('session_uid', $response->id);
						$this->session->set_userdata('session_uname', $response->name);
						$this->session->set_userdata('session_uemail', $response->email);
						$this->session->set_userdata('session_uroleid', $response->role_id);
						$this->session->set_userdata('sess_company_profile_id', $response->roles[0]->company_profile_id);

						$this->load->library('fiscalYear');
						$fy = new fiscalYear();
						$result = $fy->setFiscalYear();
						$this->session->set_userdata('sess_fiscal_year_id',$result->id);

						REDIRECT(MAINSITE_Admin."wam");
					}
					else{
						$this->session->set_flashdata('alert_message', '<div class="alert alert-danger alert-dismissible">
						<button type="button" class="close" data-bs-dismiss="alert" aria-hidden="true">×</button>
						<i class="icon fa fa-ban"></i> You are blocked by Management.
					  </div>');
					}
				}
				else if(!$response){

					$this->session->set_flashdata('alert_message', '<div class="alert alert-danger alert-dismissible">
					<button type="button" class="close" data-bs-dismiss="alert" aria-hidden="true">×</button>
					<i class="icon fa fa-ban"></i> Wrong Email Id Or Password
				  </div>');
				}
				else{
					$this->session->set_flashdata('alert_message', '<div class="alert alert-danger alert-dismissible">
					<button type="button" class="close" data-bs-dismiss="alert" aria-hidden="true">×</button>
					<i class="icon fa fa-ban"></i> Something Went Wrong Please Try Again.
				  </div>');
				}
			}
			else
			{
				$this->data['alert_message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('alert_message');
			}
		}
		$temp_alert_message = $this->session->flashdata('alert_message');
		if(!empty($temp_alert_message))
		{
			$this->data['alert_message'] = $temp_alert_message;
		}
		//echo "<pre>";print_r($_POST);echo "</pre>";
		$this->load->view('admin/login' , $this->data);
	}
	public function check_Otp($otp)
{
$contact_no = $_POST['contact_no'];
	$this->data['profile'] = $this->Common_Model->getData(array('select'=>'*' , 'from'=>'user' , 'where'=>"email like ('".$contact_no."') or mobile_no like ('".$contact_no."')"));
	if(!empty($this->data['profile']))
	{
		$contact_no = $this->data['profile'][0]->mobile_no;
		$is_exist_otp = $this->_audl->check_exist_otp(array('contact_no'=>$contact_no , 'otp_for'=>'login_otp_admin' , 'otp'=>$otp , 'status'=>1));
	if(!empty($is_exist_otp))
	{

		return TRUE;
	}
	else
	{
		$this->form_validation->set_message('check_Otp', 'You Entered Wrong OTP. Please try again.');
		return FALSE;
	}
}
else
{
	$this->form_validation->set_message('check_Otp', 'You Entered wrong Username.  Please try again.');
	return FALSE;
}
}
	function resend_otp()
	{
		$response_array['status'] = false;
		$response_array['message'] = 'Error In Processing';
		$contact_no = $_POST['contact_no'];
		$contact_no = ltrim($_POST['contact_no'], '0');
		$this->data['profile'] = $this->Common_Model->getData(array('select'=>'*' , 'from'=>'user' , 'where'=>"mobile_no like ('".$contact_no."')"));
		if(!empty($this->data['profile']))
		{
			$contact_no = $this->data['profile'][0]->mobile_no;
			$status = $this->data['profile'][0]->status;

			if($status == 0){
				$this->session->set_flashdata('alerttq_message', '<div class="alert alert-danger alert-dismissible">
			 <button type="button" class="close" data-bs-dismiss="alert" aria-hidden="true">×</button>
				Your Account is Blocked. Kindly contact to Admin.
			 </div>');

			 echo json_encode('blocked');
			 exit;
			}
			$is_exist_otp = $this->_audl->check_exist_otp(array('contact_no'=>$contact_no , 'otp_for'=>'login_otp_admin'));
			if(!empty($is_exist_otp))
			{
				$exist_otp_data = $is_exist_otp[0];
				$otp = $exist_otp_data->otp;
			}
			else
			{
				$otp = $this->Common_Model->random_password(6 , 'number');
				$add_new_otp_log_params = array('otp'=>$otp , 'contact'=>$contact_no , 'otp_for'=>'login_otp_admin');

				$this->_audl->add_new_otp_log($add_new_otp_log_params);
			}
			$response_array['status'] = true;
			$response_array['message'] = 'OTP Sent';
			//$template = "OTP for online verification is {$otp}. This OTP can be used only once and is valid for 24 hrs. Nice And Natural Products";
				//$template = "OTP for online verification is {$otp}. This OTP can be used only once and is valid for 24 hrs. Nice And Natural Products";
				//$template = "Please verify your mobile number by entering the OTP ".$otp.'. Knowledge C'; //echo $msg;
				$template = "Please verify your mobile number by entering the OTP ".$otp.". "._project_name_;
			$this->Common_Model->send_sms($contact_no , $template);
		}
		else
		{
			$response_array['status'] = false;
			$response_array['message'] = 'Mobile Number Not Exist';
		}
		echo json_encode($response_array);
	}

}
