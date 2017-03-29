<?php
class ControllerShopCate extends Controller {
	public function index() {
		$this->load->language('shop/home');
		$this->load->model('shop/home');
		$this->load->model('shop/cate');
		/*

		if ($category_info) {


		} else {
			$url = '';
			$data['breadcrumbs'][] = array(
				'text' => $this->language->get('text_error'),
				'href' => $this->url->link('shop/home', $url)
			);

			$this->document->setTitle($this->language->get('text_error'));

			$data['heading_title'] = $this->language->get('text_error');

			$data['text_error'] = $this->language->get('text_error');

			$data['button_continue'] = $this->language->get('button_continue');

			$data['continue'] = $this->url->link('common/home');

			$this->response->addHeader($this->request->server['SERVER_PROTOCOL'] . ' 404 Not Found');

			$data['column_left'] = $this->load->controller('common/column_left');
			$data['column_right'] = $this->load->controller('common/column_right');
			$data['content_top'] = $this->load->controller('common/content_top');
			$data['content_bottom'] = $this->load->controller('common/content_bottom');
			$data['footer'] = $this->load->controller('common/footer');
			$data['header'] = $this->load->controller('common/header');

			$this->response->setOutput($this->load->view('shop/not_found', $data));
		}*/


		$cate_id = $this->request->get['cate_id'];
		$data['cate_info'] = $this->model_shop_cate->getShopCate($cate_id);
		
		$shop_id = $data['cate_info']['shop_id'];
		$data['shop_info'] = $this->model_shop_home->getShopInfo($shop_id);

		if (isset($this->request->get['page'])) {
			$page = $this->request->get['page'];
		} else {
			$page = 1;
		}
		$limit = $this->config->get($this->config->get('config_theme') . '_product_limit');
		$data['cate_link'] = $this->url->link('shop/cate',array('shop_id'=>$shop_id));

		$this->load->model('shop/cate');


		$cate_id = $this->request->get['cate_id'];
		$data['cate_id']  = $cate_id;

		//Product
		$data['product_list'] = $this->model_shop_cate->getCateProducts($shop_id,$cate_id,$page,$limit);
		foreach($data['product_list'] as &$product){
			$product['link'] = $this->url->link('product/product',array('product_id'=>$product['product_id']));
			$product['img_url'] = QINIU_BASE.$product['image'];
		}

		//Pagination
		$total = $this->model_shop_cate->getCateProductTotal($shop_id, $cate_id);

		$pagination = new Pagination();
		$pagination->total = $total;
		$pagination->page = $page;
		$pagination->limit = $limit;
		$pagination->url = $this->url->link('shop/cate', 'shop_id='.$shop_id.'&cate_id='.$cate_id.'&page={page}');

		$data['pagination'] = $pagination->render();
		$data['results'] = sprintf($this->language->get('text_pagination'), ($total) ? (($page - 1) * $limit) + 1 : 0, ((($page - 1) * $limit) > ($total - $limit)) ? $total : ((($page - 1) * $limit) + $limit), $total, ceil($total / $limit));
		if ($page == 1) {
			$this->document->addLink($this->url->link('shop/cate', 'shop_id=' . $shop_id.'&cate_id='.$cate_id, true), 'canonical');
		} elseif ($page == 2) {
			$this->document->addLink($this->url->link('shop/cate', 'shop_id=' . $shop_id.'&cate_id='.$cate_id, true), 'prev');
		} else {
			$this->document->addLink($this->url->link('shop/cate', 'shop_id=' . $shop_id.'&cate_id='.$cate_id . '&page='. ($page - 1), true), 'prev');
		}
		if ($limit && ceil($total / $limit) > $page) {
			$this->document->addLink($this->url->link('shop/cate', 'shop_id=' . $shop_id.'&cate_id='.$cate_id . '&page='. ($page + 1), true), 'next');
		}


		$data['footer'] = $this->load->controller('common/footer');
		$data['header'] = $this->load->controller('common/header');
		$data['header_shop'] = $this->load->controller('common/header_shop');
		$this->response->setOutput($this->load->view('shop/cate', $data));
	}


}
