<?php
class ControllerShopLayoutfooter extends Controller {
	public function index() {
		$data['text_version'] = '1.5.7';
		return $this->load->view('shop/layoutfooter', $data);
	}
}
