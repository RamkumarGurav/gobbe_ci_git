<?php

class Screen_Lock_model extends CI_Model
{
	protected $search_query;

    function __construct($search_query='')
    {
        //parent::__construct();
        $this->load->database();
        $this->search_query = $search_query;
		$this->db->query("SET sql_mode = ''");
    }

	function doSignInUser($params = array())
	{
		$status = true;
		$session_uid = $this->data['session_uid'];
		$password = md5($_POST['password']);

		$this->db
		->select('u.*')
		->from('user as u ')
		->where('id' , $session_uid)
		->where('password' , $password)
		->limit(1);
		$result = $this->db->get();
		if($result->num_rows() > 0 )
		{
			$result = $result->result();
			$result = $result[0];
			if($result->status==1)
			{
				$client_ip = $this->Common_Model->get_client_ip();
				$update_login['last_login'] = date('Y-m-d H:i:s');
				$update_login['last_loginip'] = $client_ip;
				$response = $this->Common_Model->update_operation(array('table'=>"user" , 'data'=>$update_login , 'condition'=>"(id = $result->id)" ));
			}
			return $result;

		}
		else
		{
			return false;
		}
	}

}

?>
