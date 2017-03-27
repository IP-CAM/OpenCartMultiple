<?php
class ModelShopCate extends Model {

	public function getShopCates($shop_id)
	{
		$query = $this->db->query("SELECT *  FROM " . DB_PREFIX . "cate WHERE shop_id = " . $shop_id);
		return $query->rows;
	}

	public function getShopCate($cate_id){
		$query = $this->db->query("SELECT *  FROM " . DB_PREFIX . "cate WHERE cate_id = " . $cate_id);
		return $query->row;
	}

	public function getCateProducts($shop_id,$cate_id,$page,$limit){
		$sql = "SELECT p.product_id, p.price, p.creation_id,p.image,pd.name FROM " . DB_PREFIX . "product p LEFT JOIN " . DB_PREFIX . "product_description pd ON (p.product_id = pd.product_id) WHERE
		 p.shop_id = " .$shop_id . " and pd.language_id = '" . (int)$this->config->get('config_language_id') . "' and p.cate_id = ".$cate_id."
		 order by p.product_id desc limit ".($page-1)*$limit.",".$limit;
		$query = $this->db->query($sql);
		return $query->rows;
	}

	public function getCateProductTotal($shop_id,$cate_id){
		$query = $this->db->query("SELECT COUNT(product_id) AS total FROM ". DB_PREFIX . "product WHERE shop_id = " .$shop_id." and cate_id = ".$cate_id);
		return $query->row['total'];
	}

}
