<?php
class ModelSettingSiteFront extends Model {

	public function getRecommendShop(){
		$query = $this->db->query("SELECT s.* FROM " . DB_PREFIX . "site_front AS f LEFT JOIN " . DB_PREFIX . "shop AS s ON(f.shop_id = s.shop_id) WHERE f.type = 1");
		return $query->rows;
	}

}