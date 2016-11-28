<?php
// Uploads files. Used in Add product page in Admin Panel to upload 
// an image of the product.
class Upload {
	
	public $files = array();
	public $names = array();
	public $errors = array();
	public $overwrite = false;
	
	public function __construct() {
		$this->getUploads();
	}
	
	public function getUploads() {
		if(!empty($_FILES)) {
			foreach($_FILES as $key => $value) {
				$this->files[$key] = $value;
			}
		}
	}
	
	public function upload($path = null) {
		if(!empty($path) && is_dir($path) && !empty($this->files)) {
			foreach($this->files as $key => $value) {
				// Checking if the name contains any illigal characaters
				$name = Check::cleanString($value['name']);
				if($this->overwrite == false && is_file($path.DIR_SEP.$name)) {
					$prefix = date('YmdHis', time());
					$name = $prefix."-".$name;
				}
				if(!move_uploaded_file($value['tmp_name'], $path.DIR_SEP.$name)) {
					$this->errors[] = $key;
				}
				$this->names[] = $name;
			}
			return empty($this->errors) ? true : false;
		}
		return false;
	}
	


}