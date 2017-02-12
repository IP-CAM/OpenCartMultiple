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


}