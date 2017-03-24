<?php
class ControllerCommonHome extends Controller {
	public function index() {
		$this->document->setTitle($this->config->get('config_meta_title'));
		$this->document->setDescription($this->config->get('config_meta_description'));
		$this->document->setKeywords($this->config->get('config_meta_keyword'));

		if (isset($this->request->get['route'])) {
			$this->document->addLink($this->config->get('config_url'), 'canonical');
		}

        $data['shop_create_link'] = $this->url->link('shop/description');
		$data['shop_home'] = $this->url->link('shop/home');
		$data['shop_creation'] = $this->url->link('shop/creation');

		$this->load->model("setting/site_front");
		$data['recomend_shops'] = $this->model_setting_site_front->getRecommendShop();
		foreach($data['recomend_shops'] as &$shop){
			if($shop['owner_img'] != ""){
				$shop['owner_img'] = QINIU_BASE.$shop['owner_img']."!thumb";
			}else{
				$shop['owner_img'] = "image/avatar_default.png";
			}
			if($shop['banner_img'] != ""){
				$shop['banner_img'] = QINIU_BASE.$shop['banner_img']."!thumb";
			}else{
				$shop['banner_img'] = "image/shop_bg_default_thumb.png";
			}
			$shop['link'] = $this->url->link('shop/home',array('shop_id'=>$shop['shop_id']));
		}

		$data['footer'] = $this->load->controller('common/footer');
		$data['header'] = $this->load->controller('common/header');

		$this->response->setOutput($this->load->view('common/home', $data));
	}
}
