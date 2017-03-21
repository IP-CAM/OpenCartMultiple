<?php
class ControllerDashboardCate extends Controller {
	private $error = array();

	public function index() {
		$this->load->language('dashboard/cate');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('dashboard/cate');

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
			'href' => $this->url->link('dashboard/cate', '' . $url, true)
		);

		$data['add'] = $this->url->link('dashboard/cate/add', '' . $url, true);
		$data['delete'] = $this->url->link('dashboard/cate/delete', '' . $url, true);
		$data['edit'] = $this->url->link('dashboard/cate/edit', '' . $url, true);

		$data['cates'] = array();

		$filter_data = array(
			'start'                   => ($page - 1) * $this->config->get('config_limit_admin'),
			'limit'                   => $this->config->get('config_limit_admin')
		);

		$cate_total = $this->model_dashboard_cate->getTotalCates();

		$results = $this->model_dashboard_cate->getCates($filter_data);

        $this->load->model('tool/image');
		foreach ($results as $result) {
			$data['cates'][] = array(
				'cate_id'     => $result['cate_id'],
				'cate_name'      => $result['cate_name'],
				'product_num'      => $result['product_num'],
				'cate_description'      => $result['cate_description'],
				'sort_order'      => $result['sort_order'],
				'edit'          => $this->url->link('dashboard/cate/edit', '' . '&cate_id=' . $result['cate_id'] . $url, true),
				'delete'          => $this->url->link('dashboard/cate/delete', '' . '&cate_id=' . $result['cate_id'] . $url, true)
			);
		}

		$data['heading_title'] = $this->language->get('heading_title');

		$data['text_list'] = $this->language->get('text_list');
		$data['text_no_results'] = $this->language->get('text_no_results');
		$data['text_confirm'] = $this->language->get('text_confirm');

		$data['column_order'] = $this->language->get('column_order');
		$data['column_cate_name'] = $this->language->get('column_cate_name');
        $data['column_cate_description'] = $this->language->get('column_cate_description');
		$data['column_cate_product'] = $this->language->get('column_cate_product');
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
		$pagination->total = $cate_total;
		$pagination->page = $page;
		$pagination->limit = $this->config->get('config_limit_admin');
		$pagination->url = $this->url->link('dashboard/cate', '&page={page}', true);

		$data['pagination'] = $pagination->render();

		$data['results'] = sprintf($this->language->get('text_pagination'), ($cate_total) ? (($page - 1) * $this->config->get('config_limit_admin')) + 1 : 0, ((($page - 1) * $this->config->get('config_limit_admin')) > ($cate_total - $this->config->get('config_limit_admin'))) ? $cate_total : ((($page - 1) * $this->config->get('config_limit_admin')) + $this->config->get('config_limit_admin')), $cate_total, ceil($cate_total / $this->config->get('config_limit_admin')));

		$data['header'] = $this->load->controller('dashboard/layoutheader');
		$data['column_left'] = $this->load->controller('dashboard/layoutleft');
		$data['footer'] = $this->load->controller('dashboard/layoutfooter');

		$this->response->setOutput($this->load->view('dashboard/cate_list', $data));
	}

	public function add() {
		$this->load->language('dashboard/cate');
		$this->document->setTitle($this->language->get('heading_title'));
		$this->load->model('dashboard/cate');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
			$this->model_dashboard_cate->addCate($this->request->post);
			$this->session->data['success'] = $this->language->get('text_success');
			$url = '';
			if (isset($this->request->get['page'])) {
				$url .= '&page=' . $this->request->get['page'];
			}

			$this->response->redirect($this->url->link('dashboard/cate', '' . $url, true));
		}

		$this->getForm();
	}

	public function edit() {
		$this->load->language('dashboard/cate');
		$this->document->setTitle($this->language->get('heading_title'));
		$this->load->model('dashboard/cate');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
			$this->model_dashboard_cate->editCate($this->request->get['cate_id'], $this->request->post);
			$this->session->data['success'] = $this->language->get('text_success');
			$url = '';
			if (isset($this->request->get['page'])) {
				$url .= '&page=' . $this->request->get['page'];
			}
			$this->response->redirect($this->url->link('dashboard/cate', '' . $url, true));
		}

		$this->getForm();
	}

	protected function getForm() {
		$data['heading_title'] = $this->language->get('heading_title');

		$data['text_form'] = !isset($this->request->get['cate_id']) ? $this->language->get('text_add') : $this->language->get('text_edit');

		$data['entry_sort_order'] = $this->language->get('column_order');
		$data['entry_cate_name'] = $this->language->get('column_cate_name');
        $data['entry_cate_description'] = $this->language->get('column_cate_description');
		$data['column_order_help'] = $this->language->get('column_order_help');

		$data['button_save'] = $this->language->get('button_save');
		$data['button_cancel'] = $this->language->get('button_cancel');

		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}

		if (isset($this->error['cate_name'])) {
			$data['error_cate_name'] = $this->error['cate_name'];
		} else {
			$data['error_cate_name'] = '';
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
				'href' => $this->url->link('dashboard/cate', '' . $url, true)
		);

		if (!isset($this->request->get['cate_id'])) {
			$data['action'] = $this->url->link('dashboard/cate/add', '' . $url, true);
		} else {
			$data['action'] = $this->url->link('dashboard/cate/edit', '' . '&cate_id=' . $this->request->get['cate_id'] . $url, true);
		}

		$data['cancel'] = $this->url->link('dashboard/cate', '' . $url, true);

		if (isset($this->request->get['cate_id']) && ($this->request->server['REQUEST_METHOD'] != 'POST')) {
			$cate_info = $this->model_dashboard_cate->getCate($this->request->get['cate_id']);
		}


		if (isset($this->request->post['sort_order'])) {
			$data['sort_order'] = $this->request->post['sort_order'];
		} elseif (!empty($cate_info)) {
			$data['sort_order'] = $cate_info['sort_order'];
		} else {
			$data['sort_order'] = '';
		}

		if (isset($this->request->post['cate_name'])) {
			$data['cate_name'] = $this->request->post['cate_name'];
		} elseif (!empty($cate_info)) {
			$data['cate_name'] = $cate_info['cate_name'];
		} else {
			$data['cate_name'] = '';
		}

		if (isset($this->request->post['cate_description'])) {
			$data['cate_description'] = $this->request->post['cate_description'];
		} elseif (!empty($cate_info)) {
			$data['cate_description'] = $cate_info['cate_description'];
		} else {
			$data['cate_description'] = '';
		}

		$data['header'] = $this->load->controller('dashboard/layoutheader');
		$data['column_left'] = $this->load->controller('dashboard/layoutleft');
		$data['footer'] = $this->load->controller('dashboard/layoutfooter');

		$this->response->setOutput($this->load->view('dashboard/cate_form', $data));
	}


	public function delete() {
		$this->load->language('dashboard/cate');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('dashboard/cate');

		if (isset($this->request->post['cate_id']) && $this->validateDelete()) {

			$this->model_dashboard_cate->deleteCate($this->request->post['cate_id']);
			$this->session->data['success'] = $this->language->get('text_success');
			$url = '';
			if (isset($this->request->get['page'])) {
				$url .= '&page=' . $this->request->get['page'];
			}

			$this->response->redirect($this->url->link('dashboard/cate', '' . $url, true));
		}

		$this->getList();
	}

	protected function validateForm() {

		if ((utf8_strlen($this->request->post['cate_name']) < 2) || (utf8_strlen($this->request->post['cate_name']) > 32)) {
			$this->error['cate_name'] = $this->language->get('error_cate_name');
		}

		return !$this->error;
	}

	protected function validateDelete() {
		return !$this->error;
	}

}