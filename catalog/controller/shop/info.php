<?php
class ControllerShopInfo extends Controller {

    public function index() {

            $this->load->language('shop/info');
            $this->document->setTitle($this->language->get('heading_title'));
            $this->load->model('shop/shop');

            if($this->request->server['REQUEST_METHOD'] == 'POST'){
                    $this->model_shop_shop->editShopInfo($this->customer->getId(),$this->request->post);
            }

            $data = $this->model_shop_shop->getShopInfo($this->customer->getId());
            $data['heading_title'] = $this->language->get('heading_title');
            $data['text_form'] =  $this->language->get('text_edit');
            $data['entry_name'] =  $this->language->get('shop_name');
            $data['entry_about'] =  $this->language->get('owner_about');
            $data['entry_about_des'] =  $this->language->get('owner_about_des');
            $data['entry_owner'] =  $this->language->get('owner_name');
            $data['entry_owner_des'] =  $this->language->get('owner_name_des');
            $data['entry_facebook'] =  $this->language->get('facebook_link');
            $data['entry_facebook_des'] =  $this->language->get('facebook_link_des');
            $data['entry_twitter'] =  $this->language->get('twitter_link');
            $data['entry_twitter_des'] =  $this->language->get('twitter_link_des');

            $data['action'] = $this->url->link('shop/info', '', true);

            $data['breadcrumbs'] = array();
            $data['breadcrumbs'][] = array(
                'text' => $this->language->get('text_home'),
                'href' => $this->url->link('shop/dashboard','', true)
            );
            $data['breadcrumbs'][] = array(
                'text' => $this->language->get('heading_title'),
                'href' => $this->url->link('shop/info', '', true)
            );

            if (isset($this->error['warning'])) {
                    $data['error_warning'] = $this->error['warning'];
            } else {
                    $data['error_warning'] = '';
            }

            if (isset($this->error['name'])) {
                    $data['error_name'] = $this->error['name'];
            } else {
                    $data['error_name'] = '';
            }


            $data['footer'] = $this->load->controller('shop/layoutfooter');
            $data['header'] = $this->load->controller('shop/layoutheader');
            $data['column_left'] = $this->load->controller('shop/layoutleft');
            $this->response->setOutput($this->load->view('shop/info', $data));
    }

}