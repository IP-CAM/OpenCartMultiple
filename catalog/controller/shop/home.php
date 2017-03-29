<?php
class ControllerShopHome extends Controller {
	public function index() {
		$this->load->language('shop/home');

		$this->load->model('shop/home');
		$this->load->model('tool/image');

		$shop_id = $this->request->get['shop_id'];
		$data['shop_info'] = $this->model_shop_home->getShopInfo($shop_id);
		$data['shop_home'] = $this->url->link('shop/home');
		$data['shop_creation'] = $this->url->link('shop/creation');

		//Latest Product
		$product_list = $this->model_shop_home->getHomeProducts($shop_id);

		for($i = 0; $i<count($product_list); $i++){
			if($i<8) {
				$product_list[$i]['link'] = $this->url->link('product/product', array('product_id' => $product_list[$i]['product_id']));
				$product_list[$i]['img_url'] = QINIU_BASE . $product_list[$i]['image'];
				$data['product_list'][$i] = $product_list[$i];
			}
		}

		$data['footer'] = $this->load->controller('common/footer');
		$data['header'] = $this->load->controller('common/header');
		$data['header_shop'] = $this->load->controller('common/header_shop');
		$this->response->setOutput($this->load->view('shop/home', $data));
	}


}
