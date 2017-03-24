<?php
class ModelShopCate extends Model {

	public function getShopCates($shop_id)
	{
		$query = $this->db->query("SELECT *  FROM " . DB_PREFIX . "cate WHERE shop_id = " . $shop_id);
		return $query->rows;
	}

}
