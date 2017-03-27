<?php
class ControllerCommonHeaderShop extends Controller {
	public function index() {

		$this->load->language('shop/home');

		$this->load->model('shop/home');
		$this->load->model('shop/cate');
		$this->load->model('shop/follow');

		//Get shop_id
		if(isset($this->request->get['shop_id'])){
			$shop_id = $this->request->get['shop_id'];
		}else if($this->request->get['cate_id']){
			$cate_info = $this->model_shop_cate->getShopCate($this->request->get['cate_id']);
			$shop_id = $cate_info['shop_id'];
		}

		$data['home_link'] = $this->url->link("shop/home",array('shop_id'=>$shop_id));
		$data['print_link'] = $this->url->link("shop/creation",array('shop_id'=>$shop_id));

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
			$cate['link'] = $this->url->link('shop/cate',array('cate_id'=>$cate['cate_id']));
		}

		//Follow
		$data['is_follow'] = 0;
		if($this->customer->isLogged()){
			$data['is_follow'] = $this->model_shop_follow->getIsFollow($shop_id);
		}

		$data['shop_id'] = $shop_id;
		return $this->load->view('common/header_shop', $data);
	}


	public function follow(){
		$json = array();

		if($this->customer->isLogged()){
			if(isset($this->request->get['shop_id'])){
				$this->load->model('shop/follow');
				$this->model_shop_follow->follow($this->request->get['shop_id']);
				$json['code'] = 1;
			}
		}else{
			$json['code'] = 0;
			$json['message'] = 'Please Login';
		}

		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}

	public function unfollow(){
		$json = array();
		if($this->customer->isLogged()){
			if(isset($this->request->get['shop_id'])){
				$this->load->model('shop/follow');
				$this->model_shop_follow->unfollow($this->request->get['shop_id']);
				$json['code'] = 1;
			}
		}else{
			$json['code'] = 0;
			$json['message'] = 'Please Login';
		}

		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}
}
