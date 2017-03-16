<?php
class ControllerDashboardRecommend extends Controller {
	private $error = array();

	public function index() {
		$this->load->language('dashboard/recommend');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('dashboard/recommend');

		$this->getList();
	}

	protected function getList() {

		if (isset($this->request->get['page'])) {
			$page = $this->request->get['page'];
		} else {
			$page = 1;
		}

		$url = '';
		if (isset($this->request->get['page'])) {
			$url .= '&page=' . $this->request->get['page'];
		}

		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('dashboard/home', '', true)
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('dashboard/recommend', '' . $url, true)
		);

		$data['add'] = $this->url->link('dashboard/recommend/add', '' . $url, true);
		$data['delete'] = $this->url->link('dashboard/recommend/delete', '' . $url, true);
		$data['edit'] = $this->url->link('dashboard/recommend/edit', '' . $url, true);

		$data['recommends'] = array();

		$filter_data = array(
			'start'                   => ($page - 1) * $this->config->get('config_limit_admin'),
			'limit'                   => $this->config->get('config_limit_admin')
		);

		$collection_total = $this->model_dashboard_recommend->getTotalRecommends();

		$results = $this->model_dashboard_recommend->getRecommends($filter_data);

        $this->load->model('tool/image');

		foreach ($results as $result) {
			$data['recommends'][] = array(
				'product_id'     => $result['product_id'],
				'product_name'      => $result['name'],
                'price'      => $result['price'],
                'product_img'      => $result['image'] == ""? $this->model_tool_image->resize('no_image.png', 100, 100):QINIU_BASE.$result['image']."!thumb",
				'delete'          => $this->url->link('dashboard/recommend/delete', '' . '&product_id=' . $result['product_id'] . $url, true)
			);
		}

		$data['heading_title'] = $this->language->get('heading_title');

		$data['text_list'] = $this->language->get('text_list');
		$data['text_no_results'] = $this->language->get('text_no_results');
		$data['text_confirm'] = $this->language->get('text_confirm');

		$data['column_price'] = $this->language->get('column_price');
		$data['column_product_name'] = $this->language->get('column_product_name');
        $data['column_product_img'] = $this->language->get('column_product_img');

		$data['button_add'] = $this->language->get('button_add');
		$data['button_edit'] = $this->language->get('button_edit');
		$data['button_delete'] = $this->language->get('button_delete');

		if (isset($this->session->data['error'])) {
			$data['error_warning'] = $this->session->data['error'];

			unset($this->session->data['error']);
		} elseif (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}

		if (isset($this->session->data['success'])) {
			$data['success'] = $this->session->data['success'];

			unset($this->session->data['success']);
		} else {
			$data['success'] = '';
		}

		$pagination = new Pagination();
		$pagination->total = $collection_total;
		$pagination->page = $page;
		$pagination->limit = $this->config->get('config_limit_admin');
		$pagination->url = $this->url->link('dashboard/recommend', '&page={page}', true);

		$data['pagination'] = $pagination->render();

		$data['results'] = sprintf($this->language->get('text_pagination'), ($collection_total) ? (($page - 1) * $this->config->get('config_limit_admin')) + 1 : 0, ((($page - 1) * $this->config->get('config_limit_admin')) > ($collection_total - $this->config->get('config_limit_admin'))) ? $collection_total : ((($page - 1) * $this->config->get('config_limit_admin')) + $this->config->get('config_limit_admin')), $collection_total, ceil($collection_total / $this->config->get('config_limit_admin')));

		$data['header'] = $this->load->controller('dashboard/layoutheader');
		$data['column_left'] = $this->load->controller('dashboard/layoutleft');
		$data['footer'] = $this->load->controller('dashboard/layoutfooter');

		$this->response->setOutput($this->load->view('dashboard/recommend_list', $data));
	}

	public function add() {
		$this->load->language('dashboard/recommend');
		$this->document->setTitle($this->language->get('heading_title'));
		$this->load->model('dashboard/recommend');

		if ($this->request->server['REQUEST_METHOD'] == 'POST') {
			$this->model_dashboard_recommend->addRecommend($this->request->post['product_id']);
			$this->session->data['success'] = $this->language->get('text_success');
			$url = '';
			if (isset($this->request->get['page'])) {
				$url .= '&page=' . $this->request->get['page'];
			}

			$this->response->redirect($this->url->link('dashboard/recommend', '' . $url, true));
		}

		$this->getForm();
	}

	protected function getForm() {
		$data['heading_title'] = $this->language->get('heading_title');

		$data['text_form'] = !isset($this->request->get['product_id']) ? $this->language->get('text_add') : $this->language->get('text_edit');

		$data['entry_product_name'] = $this->language->get('column_product_name');

		$data['button_save'] = $this->language->get('button_save');
		$data['button_cancel'] = $this->language->get('button_cancel');

		if (isset($this->error['product_name'])) {
			$data['error_product_name'] = $this->error['product_name'];
		} else {
			$data['error_product_name'] = '';
		}

		$url = '';

		if (isset($this->request->get['page'])) {
			$url .= '&page=' . $this->request->get['page'];
		}

		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
				'text' => $this->language->get('text_home'),
				'href' => $this->url->link('dashboard/home', '', true)
		);

		$data['breadcrumbs'][] = array(
				'text' => $this->language->get('heading_title'),
				'href' => $this->url->link('dashboard/recommend', '' . $url, true)
		);

		if (!isset($this->request->get['product_id'])) {
			$data['action'] = $this->url->link('dashboard/recommend/add', '' . $url, true);
		} else {
			$data['action'] = $this->url->link('dashboard/recommend/edit', '' . '&product_id=' . $this->request->get['product_id'] . $url, true);
		}

		$data['cancel'] = $this->url->link('dashboard/recommend', '' . $url, true);

		$data['header'] = $this->load->controller('dashboard/layoutheader');
		$data['column_left'] = $this->load->controller('dashboard/layoutleft');
		$data['footer'] = $this->load->controller('dashboard/layoutfooter');

		$this->response->setOutput($this->load->view('dashboard/recommend_form', $data));
	}


	public function delete() {
		$this->load->language('dashboard/recommend');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('dashboard/recommend');

		if (isset($this->request->post['product_id'])) {

			$this->model_dashboard_recommend->deleteRecommend($this->request->post['product_id']);
			$this->session->data['success'] = $this->language->get('text_success');
			$url = '';
			if (isset($this->request->get['page'])) {
				$url .= '&page=' . $this->request->get['page'];
			}

			$this->response->redirect($this->url->link('dashboard/recommend', '' . $url, true));
		}

		$this->getList();
	}


}