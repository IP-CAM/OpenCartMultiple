<?php
class ControllerShopLayoutleft extends Controller {
	public function index() {
		if (true) {
			$this->load->language('shop/layoutleft');

			// Create a 3 level menu array
			// Level 2 can not have children
			
			// Menu
			$data['menus'][] = array(
				'id'       => 'menu-dashboard',
				'icon'	   => 'fa-dashboard',
				'name'	   => $this->language->get('text_dashboard'),
				'href'     => $this->url->link('shop/dashboard', '', true),
				'children' => array()
			);

			// Catalog
            $data['menus'][] = array(
                'id'       => 'menu-catalog',
                'icon'	   => 'fa-tags',
                'name'	   => $this->language->get('text_catalog'),
                'href'     => $this->url->link('shop/product', '', true),
                'children' => array()
            );
	
			// Extension
            $data['menus'][] = array(
                'id'       => 'menu-extension',
                'icon'	   => 'fa-puzzle-piece',
                'name'	   => $this->language->get('text_extension'),
                'href'     => $this->url->link('shop/order', '', true),
                'children' => array()
            );
			
			// Design
            $data['menus'][] = array(
                'id'       => 'menu-design',
                'icon'	   => 'fa-television',
                'name'	   => $this->language->get('text_design'),
                'href'     => $this->url->link('shop/info', '', true),
                'children' => array()
            );

			// Sales
            $data['menus'][] = array(
                'id'       => 'menu-sale',
                'icon'	   => 'fa-shopping-cart',
                'name'	   => $this->language->get('text_sale'),
                'href'     => $this->url->link('shop/review', '', true),
                'children' => array()
            );

			// Customer
            $data['menus'][] = array(
                'id'       => 'menu-customer',
                'icon'	   => 'fa-user',
                'name'	   => $this->language->get('text_customer'),
                'href'     => $this->url->link('shop/return', '', true),
                'children' => array()
            );

			// Marketing
            $data['menus'][] = array(
                'id'       => 'menu-marketing',
                'icon'	   => 'fa-share-alt',
                'name'	   => $this->language->get('text_marketing'),
                'href'     => '',
                'children' => array()
            );

			// System
            $data['menus'][] = array(
                'id'       => 'menu-system',
                'icon'	   => 'fa-cog',
                'name'	   => $this->language->get('text_system'),
                'href'     => '',
                'children' => array()
            );

            // report
            $data['menus'][] = array(
                'id'       => 'menu-report',
                'icon'	   => 'fa-bar-chart-o',
                'name'	   => $this->language->get('text_reports'),
                'href'     => '',
                'children' => array()
            );

			return $this->load->view('shop/layoutleft', $data);
		}
	}
}