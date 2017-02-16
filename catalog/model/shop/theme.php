<?php
class ModelShopTheme extends Model {
	public function addTheme($theme_name) {
		//查询是否已经有
		$theme = $this->db->query("SELECT *  FROM " . DB_PREFIX . "artheme WHERE theme_name = '".$this->db->escape($theme_name)."'");

		if($theme->num_rows == 0){

			$this->db->query("INSERT INTO " . DB_PREFIX . "artheme SET theme_name = '" . $this->db->escape($theme_name) . "',
             created_uid = " .$this->customer->getId().",
             created_time = ".time());

			return $this->db->getLastId();
		}else{
			return $theme->row['theme_id'];
		}

	}


	public function getThemeHot() {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "artheme  WHERE is_hot = 1 order by theme_id desc limit 0,20");
		return $query->rows;
	}

	public function getThemeUsed(){
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "product_theme pt LEFT JOIN " . DB_PREFIX . "artheme a
		  		ON(pt.theme_id = a.theme_id) WHERE pt.shop_id = ".$this->customer->getId()." order by pt.product_theme_id desc limit 0,20");
		return $query->rows;
	}


	public function getThemeByNameFilters($data){
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "artheme WHERE  theme_name LIKE '%" . $this->db->escape($data['filter_name']) . "%' order by theme_id desc limit 0,5");
		return $query->rows;
	}



}
