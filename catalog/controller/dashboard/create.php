<?php
class ControllerShopCreate extends Controller {
	public function index() {
		if (!$this->customer->isLogged()) {
			$this->session->data['redirect'] = $this->url->link('account/account', '', true);
			$this->response->redirect($this->url->link('account/login', '', true));
		}

        if($this->customer->getIsOpenShop()){
            $this->response->redirect($this->url->link('shop/dashboard', '', true));
        }

		$this->load->language('shop/create');
		$this->document->setTitle($this->language->get('heading_title'));
		$data['heading_title'] = $this->language->get('heading_title');
		$data['shop_name'] = $this->language->get('shop_name');
        $data['shop_create_button'] =  $this->language->get('shop_create_button');

        if (($this->request->server['REQUEST_METHOD'] == 'POST')) {
            // Default Shop
            $this->load->model('shop/shop');
            $requestData['customer_id'] = $this->customer->getId();
            $requestData['shop_name'] = $this->request->post['shop_name'];
            $this->model_shop_shop->addShop($requestData);
            $this->customer->setIsOpenShop(1);
            //Redirect
            $this->response->redirect($this->url->link('shop/account', '', true));
        }

		$data['action'] = $this->url->link('shop/create', '', true);

		$data['column_left'] = $this->load->controller('common/column_left');
		$data['column_right'] = $this->load->controller('common/column_right');
		$data['content_top'] = $this->load->controller('common/content_top');
		$data['content_bottom'] = $this->load->controller('common/content_bottom');
		$data['footer'] = $this->load->controller('common/footer');
		$data['header'] = $this->load->controller('common/header');
		
		$this->response->setOutput($this->load->view('shop/create', $data));
	}

	public function country() {
		$json = array();

		$this->load->model('localisation/country');

		$country_info = $this->model_localisation_country->getCountry($this->request->get['country_id']);

		if ($country_info) {
			$this->load->model('localisation/zone');

			$json = array(
				'country_id'        => $country_info['country_id'],
				'name'              => $country_info['name'],
				'iso_code_2'        => $country_info['iso_code_2'],
				'iso_code_3'        => $country_info['iso_code_3'],
				'address_format'    => $country_info['address_format'],
				'postcode_required' => $country_info['postcode_required'],
				'zone'              => $this->model_localisation_zone->getZonesByCountryId($this->request->get['country_id']),
				'status'            => $country_info['status']
			);
		}

		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}
}
