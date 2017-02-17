<?php
class ControllerAccountFtheme extends Controller {
	public function index() {
		if (!$this->customer->isLogged()) {
			$this->session->data['redirect'] = $this->url->link('account/download', '', true);

			$this->response->redirect($this->url->link('account/login', '', true));
		}

		$this->load->language('account/ftheme');

		$this->document->setTitle($this->language->get('heading_title'));

		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/home')
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_account'),
			'href' => $this->url->link('account/account', '', true)
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_ftheme'),
			'href' => $this->url->link('account/ftheme', '', true)
		);

		$this->load->model('account/ftheme');

		$data['heading_title'] = $this->language->get('heading_title');

		$data['text_empty'] = $this->language->get('text_empty');

		$data['column_order_id'] = $this->language->get('column_order_id');
		$data['column_name'] = $this->language->get('column_name');
		$data['column_size'] = $this->language->get('column_size');
		$data['column_date_added'] = $this->language->get('column_date_added');

		$data['button_download'] = $this->language->get('button_download');
		$data['button_continue'] = $this->language->get('button_continue');

		if (isset($this->request->get['page'])) {
			$page = $this->request->get['page'];
		} else {
			$page = 1;
		}

		$ftheme_total = $this->model_account_ftheme->getTotalFthemes();

		$results = $this->model_account_ftheme->getFthemes(($page - 1) * $this->config->get($this->config->get('config_theme') . '_product_limit'), $this->config->get($this->config->get('config_theme') . '_product_limit'));

		foreach ($results as $result) {

			$data['fthemes'][] = array(
				'theme_id'   => $result['theme_id'],
				'theme_name'   => $result['theme_name'],
			);

		}

		$pagination = new Pagination();
		$pagination->total = $ftheme_total;
		$pagination->page = $page;
		$pagination->limit = $this->config->get($this->config->get('config_theme') . '_product_limit');
		$pagination->url = $this->url->link('account/ftheme', 'page={page}', true);

		$data['pagination'] = $pagination->render();

		$data['results'] = sprintf($this->language->get('text_pagination'), ($ftheme_total) ? (($page - 1) * $this->config->get($this->config->get('config_theme') . '_product_limit')) + 1 : 0, ((($page - 1) * $this->config->get($this->config->get('config_theme') . '_product_limit')) > ($ftheme_total - $this->config->get($this->config->get('config_theme') . '_product_limit'))) ? $ftheme_total : ((($page - 1) * $this->config->get($this->config->get('config_theme') . '_product_limit')) + $this->config->get($this->config->get($this->config->get('config_theme') . '_theme') . '_product_limit')), $ftheme_total, ceil($ftheme_total / $this->config->get($this->config->get('config_theme') . '_product_limit')));

		$data['continue'] = $this->url->link('account/account', '', true);

		$data['column_left'] = $this->load->controller('common/column_left');
		$data['column_right'] = $this->load->controller('common/column_right');
		$data['content_top'] = $this->load->controller('common/content_top');
		$data['content_bottom'] = $this->load->controller('common/content_bottom');
		$data['footer'] = $this->load->controller('common/footer');
		$data['header'] = $this->load->controller('common/header');

		$this->response->setOutput($this->load->view('account/ftheme', $data));
	}

}