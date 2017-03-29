<?php
class ControllerShopCreation extends Controller {
	public function index() {
		$this->load->language('shop/home');
		$this->load->model('shop/home');
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


		$shop_id = $this->request->get['shop_id'];
		$data['shop_info'] = $this->model_shop_home->getShopInfo($shop_id);

		if (isset($this->request->get['page'])) {
			$page = $this->request->get['page'];
		} else {
			$page = 1;
		}
		$limit = $this->config->get($this->config->get('config_theme') . '_product_limit');
		$data['cate_link'] = $this->url->link('shop/creation',array('shop_id'=>$shop_id));

		$this->load->model('shop/creation');
		if(!isset($this->request->get['type_id'])){
			//Creation
			$data['creation_list'] = $this->model_shop_creation->getCreations($shop_id,$page,$limit);
			foreach($data['creation_list'] as &$creation){
				$creation['link'] = $this->url->link('shop/creation/detail',array('creation_id'=>$creation['creation_id']));
				$creation['img_url'] = QINIU_BASE.$creation['creation_url_show'];
			}

			//Pagination
			$total = $this->model_shop_creation->getCreationTotal($shop_id);

			$pagination = new Pagination();
			$pagination->total = $total;
			$pagination->page = $page;
			$pagination->limit = $limit;
			$pagination->url = $this->url->link('shop/creation', 'shop_id='.$shop_id.'&page={page}');

			$data['pagination'] = $pagination->render();
			$data['results'] = sprintf($this->language->get('text_pagination'), ($total) ? (($page - 1) * $limit) + 1 : 0, ((($page - 1) * $limit) > ($total - $limit)) ? $total : ((($page - 1) * $limit) + $limit), $total, ceil($total / $limit));
			if ($page == 1) {
				$this->document->addLink($this->url->link('shop/creation', 'shop_id=' . $shop_id, true), 'canonical');
			} elseif ($page == 2) {
				$this->document->addLink($this->url->link('shop/creation', 'shop_id=' . $shop_id, true), 'prev');
			} else {
				$this->document->addLink($this->url->link('shop/creation', 'shop_id=' . $shop_id . '&page='. ($page - 1), true), 'prev');
			}
			if ($limit && ceil($total / $limit) > $page) {
				$this->document->addLink($this->url->link('shop/creation', 'shop_id=' . $shop_id . '&page='. ($page + 1), true), 'next');
			}

		}else{

			$type_id = $this->request->get['type_id'];
			$data['type_id']  = $type_id;

			//Product
			$data['product_list'] = $this->model_shop_creation->getCreationProducts($shop_id,$type_id,$page,$limit);
			foreach($data['product_list'] as &$product){
				$product['link'] = $this->url->link('shop/product',array('pid'=>$product['product_id']));
				$product['img_url'] = QINIU_BASE.$product['image'];
			}

			//Pagination
			$total = $this->model_shop_creation->getCreationProductTotal($shop_id, $type_id);

			$pagination = new Pagination();
			$pagination->total = $total;
			$pagination->page = $page;
			$pagination->limit = $limit;
			$pagination->url = $this->url->link('shop/creation', 'shop_id='.$shop_id.'&type_id='.$type_id.'&page={page}');

			$data['pagination'] = $pagination->render();
			$data['results'] = sprintf($this->language->get('text_pagination'), ($total) ? (($page - 1) * $limit) + 1 : 0, ((($page - 1) * $limit) > ($total - $limit)) ? $total : ((($page - 1) * $limit) + $limit), $total, ceil($total / $limit));
			if ($page == 1) {
				$this->document->addLink($this->url->link('shop/creation', 'shop_id=' . $shop_id.'&type_id='.$type_id, true), 'canonical');
			} elseif ($page == 2) {
				$this->document->addLink($this->url->link('shop/creation', 'shop_id=' . $shop_id.'&type_id='.$type_id, true), 'prev');
			} else {
				$this->document->addLink($this->url->link('shop/creation', 'shop_id=' . $shop_id.'&type_id='.$type_id . '&page='. ($page - 1), true), 'prev');
			}
			if ($limit && ceil($total / $limit) > $page) {
				$this->document->addLink($this->url->link('shop/creation', 'shop_id=' . $shop_id.'&type_id='.$type_id . '&page='. ($page + 1), true), 'next');
			}
		}

		$data['footer'] = $this->load->controller('common/footer');
		$data['header'] = $this->load->controller('common/header');
		$data['header_shop'] = $this->load->controller('common/header_shop');
		$this->response->setOutput($this->load->view('shop/creation', $data));
	}

	public function detail(){
		$this->load->language('shop/creation');
		$this->load->model('shop/creation');

		$creation_id = $this->request->get['creation_id'];
		$data['creation_info'] = $this->model_shop_creation->getCreation($creation_id);

		$data['creation_info']['img_url'] = QINIU_BASE.$data['creation_info']['creation_url_show'];
		$data['product_list'] = $this->model_shop_creation->getCreationRelatedProducts($creation_id);
		foreach($data['product_list'] as &$product){
			$product['link'] = $this->url->link('product/product',array('product_id'=>$product['product_id']));
			$product['img_url'] = QINIU_BASE.$product['image'];
		}

		$data['footer'] = $this->load->controller('common/footer');
		$data['header'] = $this->load->controller('common/header');
		$data['header_shop'] = $this->load->controller('common/header_shop');
		$this->response->setOutput($this->load->view('shop/creation_detail', $data));
	}

}
