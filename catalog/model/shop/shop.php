<?php
class ModelShopShop extends Model {
    public function addShop($data) {
        //Whether is Added
        $count = $this->db->query("SELECT *  FROM " . DB_PREFIX . "shop WHERE customer_id = ".$data['customer_id']);
        if($count->num_rows == 0){
            $this->db->query("INSERT INTO " . DB_PREFIX . "shop SET shop_name = '" . $this->db->escape($data['shop_name']) . "',
             shop_id = '" . (int)$data['customer_id'] . "',
             created_time = ".time());
            $this->db->query("UPDATE " . DB_PREFIX . "customer SET is_open_shop = 1");
        }
    }

    public function getShopInfo($shop_id){
        $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "shop  WHERE shop_id = " . $shop_id );
        return $query->row;
    }

    public function editShopInfo($shop_id, $data){
        $this->db->query("UPDATE " . DB_PREFIX . "shop SET shop_name = '" . $this->db->escape($data['shop_name']) . "',
                                                        owner_name = '" . $this->db->escape($data['owner_name']) . "',
                                                        owner_about = '" . $this->db->escape($data['owner_about']) . "',
                                                        owner_facebook = '" . $this->db->escape($data['owner_facebook']) . "',
                                                        owner_twitter = '" . $this->db->escape($data['owner_twitter']) . "',
                                                        owner_image = '" . $this->db->escape($data['image']) . "'
                                                        WHERE shop_id = " . $shop_id);
    }

}