<?php
class ModelDashboardShop extends Model {
    public function addShop($data) {
        //Whether is Added
        $count = $this->db->query("SELECT *  FROM " . DB_PREFIX . "shop WHERE shop_id = ".$data['customer_id']);
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
        $this->db->query("UPDATE " . DB_PREFIX . "shop SET owner_about = '" . $this->db->escape($data['owner_about']) . "',
                                                        link_facebook = '" . $this->db->escape($data['link_facebook']) . "',
                                                        link_twitter = '" . $this->db->escape($data['link_twitter']) . "',
                                                        link_instagram = '" . $this->db->escape($data['link_instagram']) . "',
                                                        owner_img = '" . $this->db->escape($data['owner_img']) . "',
                                                        banner_img = '" . $this->db->escape($data['banner_img']) . "'
                                                        WHERE shop_id = " . $shop_id);
    }

    public function checkIsDomainReg($shopName){
        $count = $this->db->query("SELECT *  FROM " . DB_PREFIX . "shop WHERE shop_name = '". $this->db->escape($shopName)."'");
        if($count->num_rows == 0){
            return false;
        }else{
            return true;
        }
    }

}