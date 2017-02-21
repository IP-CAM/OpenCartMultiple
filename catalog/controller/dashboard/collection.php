<?php
class ControllerDashboardCollection extends Controller {
	private $error = array();

	public function index() {
		$this->load->language('dashboard/collection');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('dashboard/collection');

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
			'href' => $this->url->link('dashboard/collection', '' . $url, true)
		);

		$data['add'] = $this->url->link('dashboard/collection/add', '' . $url, true);
		$data['delete'] = $this->url->link('dashboard/collection/delete', '' . $url, true);
		$data['edit'] = $this->url->link('dashboard/collection/edit', '' . $url, true);

		$data['collections'] = array();

		$filter_data = array(
			'start'                   => ($page - 1) * $this->config->get('config_limit_admin'),
			'limit'                   => $this->config->get('config_limit_admin')
		);

		$collection_total = $this->model_dashboard_collection->getTotalCollections();

		$results = $this->model_dashboard_collection->getCollections($filter_data);

		foreach ($results as $result) {
			$data['collections'][] = array(
				'collection_id'     => $result['collection_id'],
				'collection_name'      => $result['collection_name'],
				'rank'      => $result['rank'],
				'edit'          => $this->url->link('dashboard/collection/edit', '' . '&collection_id=' . $result['collection_id'] . $url, true),
				'delete'          => $this->url->link('dashboard/collection/delete', '' . '&collection_id=' . $result['collection_id'] . $url, true)
			);
		}

		$data['heading_title'] = $this->language->get('heading_title');

		$data['text_list'] = $this->language->get('text_list');
		$data['text_no_results'] = $this->language->get('text_no_results');
		$data['text_confirm'] = $this->language->get('text_confirm');

		$data['column_rank'] = $this->language->get('column_rank');
		$data['column_collection_name'] = $this->language->get('column_collection_name');

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
		$pagination->url = $this->url->link('dashboard/collection', '&page={page}', true);

		$data['pagination'] = $pagination->render();

		$data['results'] = sprintf($this->language->get('text_pagination'), ($collection_total) ? (($page - 1) * $this->config->get('config_limit_admin')) + 1 : 0, ((($page - 1) * $this->config->get('config_limit_admin')) > ($collection_total - $this->config->get('config_limit_admin'))) ? $collection_total : ((($page - 1) * $this->config->get('config_limit_admin')) + $this->config->get('config_limit_admin')), $collection_total, ceil($collection_total / $this->config->get('config_limit_admin')));

		$data['header'] = $this->load->controller('dashboard/layoutheader');
		$data['column_left'] = $this->load->controller('dashboard/layoutleft');
		$data['footer'] = $this->load->controller('dashboard/layoutfooter');

		$this->response->setOutput($this->load->view('dashboard/collection_list', $data));
	}

	public function add() {
		$this->load->language('dashboard/collection');
		$this->document->setTitle($this->language->get('heading_title'));
		$this->load->model('dashboard/collection');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
			$this->model_dashboard_collection->addCollection($this->request->post);
			$this->session->data['success'] = $this->language->get('text_success');
			$url = '';
			if (isset($this->request->get['page'])) {
				$url .= '&page=' . $this->request->get['page'];
			}

			$this->response->redirect($this->url->link('dashboard/collection', '' . $url, true));
		}

		$this->getForm();
	}

	public function edit() {
		$this->load->language('dashboard/collection');
		$this->document->setTitle($this->language->get('heading_title'));
		$this->load->model('dashboard/collection');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
			$this->model_dashboard_collection->editCollection($this->request->get['collection_id'], $this->request->post);
			$this->session->data['success'] = $this->language->get('text_success');
			$url = '';
			if (isset($this->request->get['page'])) {
				$url .= '&page=' . $this->request->get['page'];
			}
			$this->response->redirect($this->url->link('dashboard/collection', '' . $url, true));
		}

		$this->getForm();
	}

	protected function getForm() {
		$data['heading_title'] = $this->language->get('heading_title');

		$data['text_form'] = !isset($this->request->get['collection_id']) ? $this->language->get('text_add') : $this->language->get('text_edit');

		$data['entry_rank'] = $this->language->get('column_rank');
		$data['entry_collection_name'] = $this->language->get('column_collection_name');
		$data['column_rank_help'] = $this->language->get('column_rank_help');

		$data['button_save'] = $this->language->get('button_save');
		$data['button_cancel'] = $this->language->get('button_cancel');

		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}

		if (isset($this->error['collection_name'])) {
			$data['error_collection_name'] = $this->error['collection_name'];
		} else {
			$data['error_collection_name'] = '';
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
				'href' => $this->url->link('dashboard/collection', '' . $url, true)
		);

		if (!isset($this->request->get['collection_id'])) {
			$data['action'] = $this->url->link('dashboard/collection/add', '' . $url, true);
		} else {
			$data['action'] = $this->url->link('dashboard/collection/edit', '' . '&collection_id=' . $this->request->get['collection_id'] . $url, true);
		}

		$data['cancel'] = $this->url->link('dashboard/collection', '' . $url, true);

		if (isset($this->request->get['collection_id']) && ($this->request->server['REQUEST_METHOD'] != 'POST')) {
			$collection_info = $this->model_dashboard_collection->getCollection($this->request->get['collection_id']);
		}


		if (isset($this->request->post['rank'])) {
			$data['rank'] = $this->request->post['rank'];
		} elseif (!empty($collection_info)) {
			$data['rank'] = $collection_info['rank'];
		} else {
			$data['rank'] = '';
		}

		if (isset($this->request->post['collection_name'])) {
			$data['collection_name'] = $this->request->post['collection_name'];
		} elseif (!empty($collection_info)) {
			$data['collection_name'] = $collection_info['collection_name'];
		} else {
			$data['collection_name'] = '';
		}

		$data['header'] = $this->load->controller('dashboard/layoutheader');
		$data['column_left'] = $this->load->controller('dashboard/layoutleft');
		$data['footer'] = $this->load->controller('dashboard/layoutfooter');

		$this->response->setOutput($this->load->view('dashboard/collection_form', $data));
	}


	public function delete() {
		$this->load->language('dashboard/collection');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('dashboard/collection');

		if (isset($this->request->post['collection_id']) && $this->validateDelete()) {

			$this->model_dashboard_collection->deleteCollection($this->request->post['collection_id']);
			$this->session->data['success'] = $this->language->get('text_success');
			$url = '';
			if (isset($this->request->get['page'])) {
				$url .= '&page=' . $this->request->get['page'];
			}

			$this->response->redirect($this->url->link('dashboard/collection', '' . $url, true));
		}

		$this->getList();
	}

	protected function validateForm() {

		if ((utf8_strlen($this->request->post['collection_name']) < 2) || (utf8_strlen($this->request->post['collection_name']) > 32)) {
			$this->error['collection_name'] = $this->language->get('error_collection_name');
		}

		return !$this->error;
	}

	protected function validateDelete() {
		return !$this->error;
	}

}