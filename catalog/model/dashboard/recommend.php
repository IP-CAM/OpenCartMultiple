<?php
class ModelDashboardRecommend extends Model {
	public function addRecommend($product_id) {
        $this->db->query("UPDATE `" . DB_PREFIX . "product` SET is_recommend = 1 where product_id = ".$product_id);
	}

	public function deleteRecommend($product_id) {
        $this->db->query("UPDATE `" . DB_PREFIX . "product` SET is_recommend = 0 where product_id = ".$product_id);
	}

	public function getRecommends($data = array()) {
        $sql = "SELECT p.product_id,p.price,p.image,pd.name FROM " . DB_PREFIX . "product p LEFT JOIN " . DB_PREFIX . "product_description pd ON (p.product_id = pd.product_id) where p.shop_id = ".$this->customer->getId() ." and is_recommend = 1" ;

		if (isset($data['start']) || isset($data['limit'])) {
			if ($data['start'] < 0) {
				$data['start'] = 0;
			}

			if ($data['limit'] < 1) {
				$data['limit'] = 20;
			}

			$sql .= " LIMIT " . (int)$data['start'] . "," . (int)$data['limit'];
		}

		$query = $this->db->query($sql);

		return $query->rows;
	}

	public function getTotalRecommends() {
		$sql = "SELECT count(*) as total FROM " . DB_PREFIX . "product WHERE shop_id = " .$this->customer->getId()." and is_recommend = 1";
		$query = $this->db->query($sql);
		return $query->row['total'];
	}


}
