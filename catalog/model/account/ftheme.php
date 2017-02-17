<?php
class ModelAccountFtheme extends Model {

	public function getFthemes($start = 0, $limit = 20) {
		if ($start < 0) {
			$start = 0;
		}

		if ($limit < 1) {
			$limit = 20;
		}

		$query = $this->db->query("SELECT DISTINCT  t.theme_id, t.theme_name FROM `" . DB_PREFIX . "artheme_follow` tf LEFT JOIN " . DB_PREFIX . "artheme t ON (t.theme_id = tf.theme_id) WHERE tf.customer_id = '" . (int)$this->customer->getId() . "' ORDER BY tf.theme_follow_id DESC LIMIT " . (int)$start . "," . (int)$limit);
		return $query->rows;

	}

	public function getTotalFthemes() {;
		$query = $this->db->query("SELECT COUNT(*) AS total FROM `" . DB_PREFIX . "artheme_follow`  WHERE customer_id = '" . (int)$this->customer->getId() . "'");
		return $query->row['total'];
	}
}