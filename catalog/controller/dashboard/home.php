<?php
class ControllerDashboardHome extends Controller {
	public function index() {
		if (!$this->customer->isLogged()) {
			$this->session->data['redirect'] = $this->url->link('account/account', '', true);
			$this->response->redirect($this->url->link('account/login', '', true));
		}
        if($this->customer->getIsOpenShop() == 0){
            $this->response->redirect($this->url->link('dashboard/create', '', true));
        }

        $this->load->language('dashboard/home');
        $this->document->setTitle($this->language->get('heading_title'));
        $data['heading_title'] = $this->language->get('heading_title');

        $data['breadcrumbs'] = array();
        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('text_home'),
            'href' => $this->url->link('dashboard/home', '', true)
        );
        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('heading_title'),
            'href' => $this->url->link('dashboard/home', '', true)
        );

        $data['footer'] = $this->load->controller('dashboard/layoutfooter');
        $data['header'] = $this->load->controller('dashboard/layoutheader');
        $data['column_left'] = $this->load->controller('dashboard/layoutleft');
		$this->response->setOutput($this->load->view('dashboard/home', $data));
	}


}
