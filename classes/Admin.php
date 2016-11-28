<?php
class Admin extends Application {
	
	private $admins = 'admins';
	public $admin_id;
	
	
	// Checking if the admin is exists in the database.
	public function isUser($email = null, $password = null){
		if(!empty($email) && !empty($password)){
			$password = Login::encrypt($password);
			$sql = "SELECT * FROM `{$this->admins}` 
					WHERE `email` = '" .$this->db->escape($email). "' 
					AND `password` = '" .$this->db->escape($password) ."'";
			$result = $this->db->getOneRecord($sql);
			
			if(!empty($result)){
				$this->admin_id = $result['id'];
				return true;
			}
			return false;
		}
	}
	
	
	
}


