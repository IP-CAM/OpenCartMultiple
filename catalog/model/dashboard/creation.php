<?php
class ModelDashboardCollection extends Model {
	public function addCollection($data) {
		$this->db->query("INSERT INTO `" . DB_PREFIX . "collection` SET rank = '" . (int)$data['rank'] . "', shop_id = '" . $this->customer->getId() . "', collection_name = '" .$this->db->escape($data['collection_name']) ."', collection_url = '" .$this->db->escape($data['collection_url']) . "',  created_time = ".time());
		return $this->db->getLastId();
	}

	public function editCollection($collection_id, $data) {
		$this->db->query("UPDATE `" . DB_PREFIX . "collection` SET rank = '" . (int)$data['rank'] . "', collection_url = '" . $this->db->escape($data['collection_url']) ."', collection_name = '" . $this->db->escape($data['collection_name']) . "' WHERE collection_id = '" . (int)$collection_id . "'");
	}

	public function deleteCollection($collection_id) {
		$this->db->query("DELETE FROM `" . DB_PREFIX . "collection` WHERE collection_id = '" . (int)$collection_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "product_collection WHERE collection_id = '" . (int)$collection_id . "'");
	}

	public function getCollection($collection_id) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "collection  WHERE collection_id = '" . (int)$collection_id . "'");

		return $query->row;
	}

	public function getCollections($data = array()) {
		$sql = "SELECT * FROM " . DB_PREFIX . "collection  WHERE shop_id = " .$this->customer->getId() ." ORDER BY rank asc" ;

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

	public function getTotalCollections() {
		$sql = "SELECT count(*) as total FROM " . DB_PREFIX . "collection  WHERE shop_id = " .$this->customer->getId();
		$query = $this->db->query($sql);
		return $query->row['total'];
	}


}
