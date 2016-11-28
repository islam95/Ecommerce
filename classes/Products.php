<?php

class Products extends Application {

	private $categories = 'categories';
	private $products = 'products';

	public $path = 'images/products/';
	public static $currency = '&pound;';
	
	
	// Returns the list of categories ordered alphabetically
	public function getCategories() {
		$sql = "SELECT * FROM `{$this->categories}`
				ORDER BY `name` ASC";
		return $this->db->getAllRecords($sql);
	}
	
	// Returns the category name
	public function getCategory($id){
		$sql = "SELECT * FROM `{$this->categories}`
				WHERE `id` = '".$this->db->escape($id)."'";
		return $this->db->getOneRecord($sql);
	}
	
	// Adds new category to the database, used in admin panel.
	public function addCategory($name = null){
		if(!empty($name)){
			$sql = "INSERT INTO `{$this->categories}`
					(`name`) VALUES ('".$this->db->escape($name)."')";
			return $this->db->query($sql);
		}
	}
	
	// Updates the category in categories table
	public function updateCategory($name = null, $id = null){
		if(!empty($name) && !empty($id)){
			$sql = "UPDATE `{$this->categories}`
					SET `name` = '".$this->db->escape($name)."'
					WHERE `id` = '".$this->db->escape($id)."'";
			return $this->db->query($sql);
		}
		return false;
	}
	
	// Removes the category from database. used in admin panel
	public function removeCategory($id = null){
		if(!empty($id)){
			$sql = "DELETE FROM `{$this->categories}`
					WHERE `id` = '".$this->db->escape($id)."'";
			$this->db->query($sql);
		}
		return false;
	}
	
	// Check if the category is already exists.
	public function sameCategory($name = null, $id = null){
		if(!empty($name)){
			$sql  = "SELECT * FROM `{$this->categories}` 
					WHERE `name` = '".$this->db->escape($name)."'";
			$sql .= !empty($id) ? " AND `id` != '".$this->db->escape($id)."'" : null;
			
			return $this->db->getOneRecord($sql); 
		}
		return false;
	}
	
	// Returns the list of products ordered by newest products first.
	public function getProducts($cat){
		$sql = "SELECT * FROM `{$this->products}`
				WHERE `category` = '".$this->db->escape($cat)."'
				ORDER BY `date` DESC";
		return $this->db->getAllRecords($sql);
	}
	
	public function getProduct($id){
		$sql = "SELECT * FROM `{$this->products}`
				WHERE `id` = '".$this->db->escape($id)."'";
		return $this->db->getOneRecord($sql);
	}
	
	public function getAll(){
		$sql = "SELECT * FROM `{$this->products}`
				ORDER BY `name` ASC";
		return $this->db->getAllRecords($sql);
	}
	
	// Used for search results. Gets all products for a keyword looking in prodct names or ids.
	public function getAllProducts($srch = null){
		$sql = "SELECT * FROM `{$this->products}`";
		if(!empty($srch)) {
			$srch = $this->db->escape($srch);
			$sql .= " WHERE `name` LIKE '%{$srch}%' || `id` = '{$srch}'";
		}
		$sql .= " ORDER BY `date` DESC";
		return $this->db->getAllRecords($sql);
	}
	
	// Adds product to the database from Admin Panel
	public function addProduct($fields = null){
		if(!empty($fields)){
			$fields['date'] = Check::setDate(); //assigning current date
			$this->db->insert($fields);
			$array = $this->db->insertData($this->products);
			$this->id = $this->db->id;
			return $array;
		}
		return false;
	}
	
	// Updates product in the Admin panel
	public function updateProduct($fields = null, $id = null){
		if (!empty($fields) && !empty($id)){
			$this->db->update($fields);
			return $this->db->updateTable($this->products, $id);
		}
	}
	
	// Removes the product from database used in Admin Panel
	public function removeProduct($id = null){
		if(!empty($id)){
			$product = $this->getProduct($id);
			if(!empty($product)){
				// deleting the image
				if (is_file(PRODUCTS_PATH.DIR_SEP.$product['image'])) {
					unlink(PRODUCTS_PATH.DIR_SEP.$product['image']);
				}
				$sql = "DELETE FROM `{$this->products}`
						WHERE `id` = '".$this->db->escape($id)."'";
				return $this->db->query($sql);
			}
			return false;
		}
		return false;
	}











	
}






