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

		$data['footer'] = $this->load->controller('common/footer');
		$data['header'] = $this->load->controller('common/header');

      ;
		$this->response->setOutput($this->load->view('common/home', $data));
	}
}
