<?php
class ControllerCommonHeaderShop extends Controller {
	public function index() {

		$this->load->language('shop/home');

		$this->load->model('shop/home');
		$this->load->model('shop/cate');
		$this->load->model('shop/follow');

		//Get shop_id
		$shop_id = $this->request->get['shop_id'];

		//Text
		$data['text_follow'] = $this->language->get('follow');
		$data['text_unfollow'] = $this->language->get('unfollow');

		//Data
		//Shop Info
		$data['shop_info'] = $this->model_shop_home->getShopInfo($shop_id);
		if($data['shop_info']['owner_img'] != ""){
			$data['shop_info']['owner_img'] = QINIU_BASE.$data['shop_info']['owner_img']."!thumb";
		}else{
			$data['shop_info']['owner_img'] = "image/avatar_default.png";
		}
		if($data['shop_info']['banner_img'] != ""){
			$data['shop_info']['banner_img'] = QINIU_BASE.$data['shop_info']['banner_img']."!thumb";
		}else{
			$data['shop_info']['banner_img'] = "image/shop_bg_default_thumb.png";
		}

		//Category
		$data['cates'] = $this->model_shop_cate->getShopCates($shop_id);
		foreach($data['cates'] as &$cate){
			$data['cates']['link'] = $this->url->link('shop/category',array('cate_id'=>$cate['cate_id']));
		}

		//Follow
		$data['is_follow'] = 0;
		if(isset($this->customer)){
			$data['is_follow'] = $this->model_shop_follow->getIsFollow($shop_id);
		}


		return $this->load->view('common/header_shop', $data);
	}
}
