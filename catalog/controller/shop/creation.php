<?php
class ControllerShopCreation extends Controller {
    public function index() {
        $this->document->setTitle($this->config->get('config_meta_title'));
        $this->document->setDescription($this->config->get('config_meta_description'));
        $this->document->setKeywords($this->config->get('config_meta_keyword'));

        $data['footer'] = $this->load->controller('common/footer');
        $data['header'] = $this->load->controller('common/header');

        $data['shop_home'] = $this->url->link('shop/home');
        $data['shop_creation'] = $this->url->link('shop/creation');

        $this->response->setOutput($this->load->view('shop/creation', $data));
    }
}
