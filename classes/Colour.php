<?php
	
class Colour extends Application{
	
	public function getColours(){
		$sql = "SELECT * FROM `colours`
				ORDER BY `colour` ASC";
		return $this->db->getAllRecords($sql);
	}
	
	// Gets the colour
	public function getColour($id = null){
		if(!empty($id)){
			$sql = "SELECT * FROM `colours`
					WHERE `id` = '".$this->db->escape($id)."'";
			return $this->db->getOneRecord($sql);
		}
	}
	




}


