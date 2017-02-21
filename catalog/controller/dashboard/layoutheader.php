<?php
class ControllerDashboardLayoutheader extends Controller {
	public function index() {
		$data['title'] = $this->document->getTitle();

		if ($this->request->server['HTTPS']) {
			$data['base'] = HTTPS_SERVER;
		} else {
			$data['base'] = HTTP_SERVER;
		}

		$data['description'] = $this->document->getDescription();
		$data['keywords'] = $this->document->getKeywords();
		$data['links'] = $this->document->getLinks();
		$data['styles'] = $this->document->getStyles();
		$data['scripts'] = $this->document->getScripts();
		$data['lang'] = $this->language->get('code');
		$data['direction'] = $this->language->get('direction');

		$this->load->language('dashboard/layoutheader');

		$data['heading_title'] = $this->language->get('heading_title');

		$data['text_order'] = $this->language->get('text_order');
		$data['text_processing_status'] = $this->language->get('text_processing_status');
		$data['text_complete_status'] = $this->language->get('text_complete_status');
		$data['text_return'] = $this->language->get('text_return');
		$data['text_customer'] = $this->language->get('text_customer');
		$data['text_online'] = $this->language->get('text_online');
		$data['text_approval'] = $this->language->get('text_approval');
		$data['text_product'] = $this->language->get('text_product');
		$data['text_stock'] = $this->language->get('text_stock');
		$data['text_review'] = $this->language->get('text_review');
		$data['text_affiliate'] = $this->language->get('text_affiliate');
		$data['text_store'] = $this->language->get('text_store');
		$data['text_front'] = $this->language->get('text_front');
		$data['text_help'] = $this->language->get('text_help');
		$data['text_homepage'] = $this->language->get('text_homepage');
		$data['text_documentation'] = $this->language->get('text_documentation');
		$data['text_support'] = $this->language->get('text_support');
		$data['text_logout'] = $this->language->get('text_logout');

		if (false) {
			$data['logged'] = '';

			$data['home'] = $this->url->link('dashboard/home', '', true);
		} else {
			$data['logged'] = true;

			$data['home'] = $this->url->link('dashboard/home', '', true);
			$data['logout'] = $this->url->link('dashboard/logout', '', true);

			// Orders
			$this->load->model('dashboard/order');

			// Processing Orders
			$data['processing_status_total'] = $this->model_dashboard_order->getTotalOrders(array('filter_order_status' => implode(',', $this->config->get('config_processing_status'))));
			$data['processing_status'] = $this->url->link('sale/order', '' . '&filter_order_status=' . implode(',', $this->config->get('config_processing_status')), true);

			// Complete Orders
			$data['complete_status_total'] = $this->model_dashboard_order->getTotalOrders(array('filter_order_status' => implode(',', $this->config->get('config_complete_status'))));
			$data['complete_status'] = $this->url->link('sale/order', '' . '&filter_order_status=' . implode(',', $this->config->get('config_complete_status')), true);

			// Returns
			$this->load->model('dashboard/return');

			$return_total = $this->model_dashboard_return->getTotalReturns(array('filter_return_status_id' => $this->config->get('config_return_status_id')));

			$data['return_total'] = $return_total;

			$data['return'] = $this->url->link('sale/return', '', true);

			// Products
			$this->load->model('dashboard/product');
			$product_total = $this->model_dashboard_product->getTotalProducts(array('filter_quantity' => 0));


			$data['product_total'] = $product_total;

			$data['product'] = $this->url->link('catalog/product', '' . '&filter_quantity=0', true);

			// Reviews
			$this->load->model('dashboard/review');

			$review_total = $this->model_dashboard_review->getTotalReviews(array('filter_status' => 0));

			$data['review_total'] = $review_total;

			$data['review'] = $this->url->link('catalog/review', '' . '&filter_status=0', true);

			$data['alerts'] = $product_total + $review_total + $return_total;

		}

		return $this->load->view('dashboard/layoutheader', $data);
	}
}
