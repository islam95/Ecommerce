<?php
	
class Order extends Application {
	
	private $orders = 'orders';
	private $o_p = 'orders_products';
	private $statuses = 'statuses';

	private $basket = array();
	private $fields = array();
	private $items = array();
	private $values = array();
	private $id = null;
	
	
	// Get products from the session from basket
	public function getItems(){
		$this->basket = Session::getSession('basket');
		if(!empty($this->basket)){
			$objProducts = new Products();
			foreach($this->basket as $key => $value){
				$this->items[$key] = $objProducts->getProduct($key);
			}
		}
	}
	
	//used in modules/paypal.php file to create an order
	public function createOrder(){
		$this->getItems();
		if(!empty($this->items)){
			$newUser = new User();
			$user = $newUser->getUser(Session::getSession(Login::$user_login));
			
			if(!empty($user)){
				$newBasket = new Basket();
				$this->fields[] = 'user';
				$this->values[] = $this->db->escape($user['id']);
				
				$this->fields[] = 'total';
				$this->values[] = $this->db->escape($newBasket->total_value);
				
				$this->fields[] = 'date';
				$this->values[] = Check::setDate();
				
				$sql  = "INSERT INTO `{$this->orders}` (`";
				$sql .= implode("`, `", $this->fields);
				$sql .= "`) VALUES ('";
				$sql .= implode("', '", $this->values);
				$sql .= "')";
				
				$this->db->query($sql);
				$this->id = $this->db->lastID();
				
				if(!empty($this->id)){
					//clearing up the arrays
					$this->fields = array();
					$this->values = array();
					return $this->addItems($this->id);
				}
			}
			return false;
		}
		return false;
	}
	
	// Adding items to the orders_products table.
	private function addItems($order_id = null){
		if(!empty($order_id)){
			$error = array();
			foreach($this->items as $item){
				$sql = "INSERT INTO `{$this->o_p}` 
						(`order`, `product`, `price`, `qty`)
						VALUES ('{$order_id}', '".$item['id']."', '".$item['price']."', '".$this->basket[$item['id']]['qty']."')";
				if(!$this->db->query($sql)){
					$error[] = $sql;
				}
			}
			return empty($error) ? true : false;
		}
		return false;
	}
	
	public function getOrder($order_id = null){
		$order_id = !empty($order_id) ? $order_id : $this->id;
		$sql = "SELECT * FROM `{$this->orders}` 
				WHERE `id` = '".$this->db->escape($order_id)."'";
		return $this->db->getOneRecord($sql);	
	}
	
	public function getOrderItems($order_id = null){
		$order_id = !empty($order_id) ? $order_id : $this->id;
		$sql = "SELECT * FROM `{$this->o_p}` 
				WHERE `order` = '".$this->db->escape($order_id)."'";
		return $this->db->getAllRecords($sql);
	}
	
	public function approve($array = null, $result = null){
		if(!empty($array) && !empty($result)){
			if (array_key_exists('txn_id', $array) &&
				array_key_exists('payment_status', $array) &&
				array_key_exists('custom', $array)) {
					
				$active = $array['payment_status'] == 'Completed' ? 1 : 0;
				$print = array();
				foreach($array as $key => $value){
					$print[] = "{$key} : {$value}";
				}
				$print = implode("\n", $print);
				
				$sql = "UPDATE `{$this->orders}` 
						SET `paypal_status` = '". $this->db->escape($active) ."',
						`txn_id` = '". $this->db->escape($array['txn_id']) ."',
						`payment_status` = '". $this->db->escape($array['payment_status']) ."', 
						`ipn` = '". $this->db->escape($print) ."',
						`response` = '". $this->db->escape($result). "'
						WHERE `id` = '". $this->db->escape($array['custom']) ."'";
				$this->db->query($sql);
			}
		}
	}
	
	public function cashStatus(){
		$sql = "UPDATE `{$this->orders}` 
				SET `payment_status` = 'Cash' 
				WHERE `id` = '".$this->id."'";
		return $this->db->query($sql);
		
	}
	
	
	// Gets orders of specified user.
	public function getUserOrders($user_id = null){
		if(!empty($user_id)){
			$sql = "SELECT * FROM `{$this->orders}` 
					WHERE `user` = '".$this->db->escape($user_id)."' 
					ORDER BY `date` DESC";
			return $this->db->getAllRecords($sql);
		}
	}
	
	// Gets the status of the order
	public function getStatus($id = null){
		if(!empty($id)){
			$sql = "SELECT * FROM `{$this->statuses}` 
					WHERE `id` = '".$this->db->escape($id)."'";
			return $this->db->getOneRecord($sql);
		}
	}
	
	// Gets orders from search field
	public function getOrders($srch = null){
		$sql  = "SELECT * FROM `{$this->orders}`";
		$sql .= !empty($srch) ? " WHERE `id` = '".$this->db->escape($srch)."'" : null;
		$sql .= " ORDER BY `date` DESC";
		
		return $this->db->getAllRecords($sql);
	}
	
	// Gets all the statuses
	public function getStatuses(){
		$sql = "SELECT * FROM `{$this->statuses}` 
				ORDER BY `id` ASC";
		return $this->db->getAllRecords($sql);
	}
	
	// Updates the order, used in admin panel.
	public function updateOrder($id = null, $array = null){
		if(!empty($id) && !empty($array) && is_array($array) 
			&& array_key_exists('status', $array) && array_key_exists('notes', $array)){
			$sql = "UPDATE `{$this->orders}` 
					SET `status` = '".$this->db->escape($array['status'])."', 
					`notes` = '".$this->db->escape($array['notes'])."' 
					WHERE `id` = '".$this->db->escape($id)."'";
			return $this->db->query($sql);
		}
	}
	
	// Removes the order, used in admin panel.
	public function removeOrder($id = null){
		if(!empty($id)){
			$sql = "DELETE FROM `{$this->orders}` 
					WHERE `id` = '".$this->db->escape($id)."'";
			return $this->db->query($sql);
		}
	}
	
}


