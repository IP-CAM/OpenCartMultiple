<?php
class ModelShopFollow extends Model {

	public function follow($shop_id){
		//查询是否已经有
		$theme = $this->db->query("SELECT *  FROM " . DB_PREFIX . "shop_follow WHERE shop_id = ".$shop_id." and customer_id = ".$this->customer->getId());

		if($theme->num_rows == 0){

			$this->db->query("INSERT INTO " . DB_PREFIX . "shop_follow SET shop_id = " .$shop_id. ",
             customer_id = " .$this->customer->getId());

			$this->db->query("UPDATE " . DB_PREFIX . "shop SET follower_number = follower_number+1 WHERE shop_id = '" . (int)$shop_id . "'");
		}
	}

	public function unfollow($shop_id){
		//查询是否已经有
		$query = $this->db->query("SELECT *  FROM " . DB_PREFIX . "shop_follow WHERE shop_id = ".$shop_id." and customer_id = ".$this->customer->getId());
		if($query->num_rows == 1){
			$this->db->query("DELETE FROM " . DB_PREFIX . "shop_follow WHERE shop_follow_id = " .$query->row['shop_follow_id']);
			$this->db->query("UPDATE " . DB_PREFIX . "shop SET follower_number = follower_number-1 WHERE shop_id = '" . (int)$shop_id . "'");
		}
	}

	public function getIsFollow($shop_id){
		$query = $this->db->query("SELECT *  FROM " . DB_PREFIX . "shop_follow WHERE shop_id = ".$shop_id." and customer_id = ".$this->customer->getId());
		return $query->num_rows;
	}


}
