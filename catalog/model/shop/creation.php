<?php
class ModelShopCreation extends Model {


	public function getCreations($shop_id,$page,$limit)
	{
		$sql = "SELECT creation_id,creation_name,creation_url_show FROM " . DB_PREFIX . "creation WHERE shop_id = " .$shop_id ." order by creation_id desc limit ".($page-1)*$limit.",".$limit;
		$query = $this->db->query($sql);
		return $query->rows;
	}

	public function getCreationTotal($shop_id){
		$query = $this->db->query("SELECT COUNT(creation_id) AS total FROM ". DB_PREFIX . "creation WHERE shop_id = " .$shop_id);
		return $query->row['total'];
	}


	public function getCreationProducts($shop_id,$type_id,$page,$limit){
		$sql = "SELECT p.product_id, p.price, p.creation_id,p.image,pd.name FROM " . DB_PREFIX . "product p LEFT JOIN " . DB_PREFIX . "product_description pd ON (p.product_id = pd.product_id) WHERE
		 p.shop_id = " .$shop_id . " and pd.language_id = '" . (int)$this->config->get('config_language_id') . "' and p.type_id = ".$type_id."
		 order by p.product_id desc limit ".($page-1)*$limit.",".$limit;
		$query = $this->db->query($sql);
		return $query->rows;
	}

	public function getCreationProductTotal($shop_id,$type_id){
		$query = $this->db->query("SELECT COUNT(product_id) AS total FROM ". DB_PREFIX . "product WHERE shop_id = " .$shop_id." and type_id = ".$type_id);
		return $query->row['total'];
	}
}
