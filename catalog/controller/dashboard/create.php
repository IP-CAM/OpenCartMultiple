<?php
class ControllerDashboardCreate extends Controller {
	private $error = array();
	public function index() {
		if (!$this->customer->isLogged()) {
			$this->session->data['redirect'] = $this->url->link('account/account', '', true);
			$this->response->redirect($this->url->link('account/login', '', true));
		}

        if($this->customer->getIsOpenShop()){
            $this->response->redirect($this->url->link('dashboard/home', '', true));
        }

		$this->load->language('dashboard/create');
		$this->document->setTitle($this->language->get('heading_title'));
		$data['heading_title'] = $this->language->get('heading_title');
		$data['entry_shop_name'] = $this->language->get('entry_shop_name');
        $data['shop_create_button'] =  $this->language->get('shop_create_button');

        if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {

			// Default Shop
            $requestData['customer_id'] = $this->customer->getId();
            $requestData['shop_name'] = $this->request->post['shop_name'];
            $this->model_dashboard_shop->addShop($requestData);
            $this->customer->setIsOpenShop(1);

            //Redirect
            $this->response->redirect($this->url->link('dashboard/home', '', true));
        }

		if (isset($this->error['shop_name'])) {
			$data['error_shop_name'] = $this->error['shop_name'];
		} else {
			$data['error_shop_name'] = '';
		}

		if (isset($this->request->post['shop_name'])) {
			$data['shop_name'] = $this->request->post['shop_name'];
		} else{
			$data['shop_name'] = '';
		}

		$data['action'] = $this->url->link('dashboard/create', '', true);

		$data['column_left'] = $this->load->controller('common/column_left');
		$data['column_right'] = $this->load->controller('common/column_right');
		$data['content_top'] = $this->load->controller('common/content_top');
		$data['content_bottom'] = $this->load->controller('common/content_bottom');
		$data['footer'] = $this->load->controller('common/footer');
		$data['header'] = $this->load->controller('common/header');
		
		$this->response->setOutput($this->load->view('dashboard/create', $data));
	}

	protected function validateForm() {

		if ((utf8_strlen($this->request->post['shop_name']) < 2) || (utf8_strlen($this->request->post['shop_name']) > 32)) {

			$this->error['shop_name'] = $this->language->get('error_shop_domain');
		}else if (strpos($this->request->post['shop_name']," ")) {
			$this->error['shop_name'] = $this->language->get('error_shop_domain_blank');
		}else{
			$this->load->model('dashboard/shop');
			if($this->model_dashboard_shop->checkIsDomainReg($this->request->post['shop_name'])){
				$this->error['shop_name'] = $this->language->get('error_shop_domain_used');
			}
		}
		return !$this->error;
	}


}
