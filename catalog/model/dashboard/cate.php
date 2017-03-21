<?php
class ModelDashboardCate extends Model {
	public function addCate($data) {
		$this->db->query("INSERT INTO `" . DB_PREFIX . "cate` SET sort_order = '" . (int)$data['sort_order'] . "', shop_id = '" . $this->customer->getId() . "', cate_name = '" .$this->db->escape($data['cate_name']) ."', cate_description = '" .$this->db->escape($data['cate_description']) . "',  created_time = ".time());
		return $this->db->getLastId();
	}

	public function editCate($cate_id, $data) {
		$this->db->query("UPDATE `" . DB_PREFIX . "cate` SET sort_order = '" . (int)$data['sort_order'] . "', cate_name = '" .$this->db->escape($data['cate_name']) ."', cate_description = '" .$this->db->escape($data['cate_description']) . "' WHERE cate_id = '" . (int)$cate_id . "'");
	}

	public function deleteCate($cate_id) {
		$this->db->query("DELETE FROM `" . DB_PREFIX . "cate` WHERE cate_id = '" . (int)$cate_id . "'");
	}

	public function getCate($cate_id) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "cate  WHERE cate_id = '" . (int)$cate_id . "'");

		return $query->row;
	}

	public function getCates($data = array()) {
		$sql = "SELECT * FROM " . DB_PREFIX . "cate  WHERE shop_id = " .$this->customer->getId() ." ORDER BY sort_order asc" ;

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

	public function getTotalCates() {
		$sql = "SELECT count(*) as total FROM " . DB_PREFIX . "cate  WHERE shop_id = " .$this->customer->getId();
		$query = $this->db->query($sql);
		return $query->row['total'];
	}


}
