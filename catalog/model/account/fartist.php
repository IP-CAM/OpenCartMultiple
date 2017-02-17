<?php
class ModelAccountFartist extends Model {

	public function getFartists($start = 0, $limit = 20) {
		if ($start < 0) {
			$start = 0;
		}

		if ($limit < 1) {
			$limit = 20;
		}

		$query = $this->db->query("SELECT DISTINCT  t.shop_id, t.shop_name FROM `" . DB_PREFIX . "shop_follow` tf LEFT JOIN " . DB_PREFIX . "shop t ON (t.shop_id = tf.shop_id) WHERE tf.customer_id = '" . (int)$this->customer->getId() . "' ORDER BY tf.shop_follow_id DESC LIMIT " . (int)$start . "," . (int)$limit);
		return $query->rows;

	}

	public function getTotalFartists() {;
		$query = $this->db->query("SELECT COUNT(*) AS total FROM `" . DB_PREFIX . "shop_follow`  WHERE customer_id = '" . (int)$this->customer->getId() . "'");
		return $query->row['total'];
	}
}