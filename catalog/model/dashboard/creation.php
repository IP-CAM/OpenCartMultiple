<?php
class ModelDashboardCreation extends Model {

    private $productType = array(
        '1' => 'artPrint',
        '2' => 'tShirt',
		'3' => 'phoneCase',
		'4' => 'pillow',
    );

	public function addCreation($data) {
		$this->db->query("INSERT INTO `" . DB_PREFIX . "creation` SET shop_id = '" . $this->customer->getId() . "',
		   creation_name = '" .$this->db->escape($data['creation_name']) ."',
		   creation_description = '" .$this->db->escape($data['creation_description']) ."',
		   creation_url = '" .$this->db->escape($data['creation_url']) . "',
		   creation_url_height = '" .$this->db->escape($data['creation_url_height']) . "',
		   creation_url_width = '" .$this->db->escape($data['creation_url_width']) . "',
		   creation_url_show = '" .$this->db->escape($data['creation_url_show']) . "',
		   creation_color = '" .$this->db->escape($data['creation_color']) . "',
		   created_time = ".time());
		return $this->db->getLastId();
	}

	public function editCreation($creation_id, $data) {
		$this->db->query("UPDATE `" . DB_PREFIX . "creation` SET  creation_url = '" . $this->db->escape($data['creation_url']) ."',
		creation_name = '" . $this->db->escape($data['creation_name']) . "',
		creation_color = '" . $this->db->escape($data['creation_color']) . "',
		creation_url_show = '" . $this->db->escape($data['creation_url_show']) . "',
		creation_description = '" . $this->db->escape($data['creation_description']) . "'
		WHERE creation_id = '" . (int)$creation_id . "'");
	}

	public function deleteCreation($creation_id) {
		$this->db->query("DELETE FROM `" . DB_PREFIX . "creation` WHERE creation_id = '" . (int)$creation_id . "'");
	}

	public function getCreation($creation_id) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "creation  WHERE creation_id = '" . (int)$creation_id . "'");
		return $query->row;
	}

	public function getCreations($data = array()) {
		$sql = "SELECT * FROM " . DB_PREFIX . "creation  WHERE shop_id = " .$this->customer->getId() ." ORDER BY creation_id desc" ;

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

	public function getTotalCreations() {
		$sql = "SELECT count(*) as total FROM " . DB_PREFIX . "creation  WHERE shop_id = " .$this->customer->getId();
		$query = $this->db->query($sql);
		return $query->row['total'];
	}

	public function addProduct($data){
		$this->db->query("INSERT INTO " . DB_PREFIX . "product SET
				 model = '" . $this->db->escape($data['model']) . "',
		 		 shop_id = '" . (int)$data['shop_id'] . "',
		 		 quantity = 10000,stock_status_id = 6, date_available = NOW(),
		 		 shipping = '" . (int)$data['shipping'] . "',
		 		 price = '" . (float)$data['price'] . "',
		 		 weight = '" . (float)$data['weight']. "',
		 		 creation_id = " . (int)$data['creation_id']. ",
		 		 type_id = " . (int)$data['type_id']. ",
		 		 type_img_no = " . (int)$data['type_img_no']. ",
		 		 status = 1, date_added = NOW()");

		$product_id = $this->db->getLastId();

		if (isset($data['image'])) {
			$this->db->query("UPDATE " . DB_PREFIX . "product SET image = '" . $this->db->escape($data['image']) . "' WHERE product_id = '" . (int)$product_id . "'");
		}

		$this->db->query("INSERT INTO " . DB_PREFIX . "product_description SET
				 product_id = '" . (int)$product_id . "',
				 language_id = 1, name = '" . $this->db->escape($data['name']) . "',
				 meta_title = '" . $this->db->escape($data['name']) . "'");

		return $product_id;
	}

    public function getCreationProduct($creation_id){
        $sql = "SELECT product_id,type_id,type_img_no,image,price FROM " . DB_PREFIX . "product  WHERE creation_id = " .$creation_id;
        $query = $this->db->query($sql);
        $data = array();
        foreach ($query->rows as $result) {
            $data[$this->productType[$result['type_id']]] = $result;
        }
        return $data;
    }

	public function editProduct($data,$product_id){
		$this->db->query("UPDATE `" . DB_PREFIX . "product` SET
			image = '" . $this->db->escape($data['image']) ."',
			price = '" . $this->db->escape($data['price']) . "',
			type_img_no = '" . $this->db->escape($data['type_img_no']) . "'
			WHERE product_id = '" . (int)$product_id . "'");
	}

}
