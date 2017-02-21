<?php
class ControllerDashboardTheme extends Controller {
	private $error = array();

	public function index() {
//		$this->load->language('catalog/category');
//
//		$this->document->setTitle($this->language->get('heading_title'));
//
//		$this->load->model('catalog/category');
//
//		$this->getList();
	}


	public function autocomplete() {
		$json = array();

		if (isset($this->request->get['filter_name'])) {
			$this->load->model('dashboard/theme');

			$filter_data = array(
				'filter_name' => $this->request->get['filter_name'],
				'sort'        => 'theme_id',
				'order'       => 'ASC',
				'start'       => 0,
				'limit'       => 5
			);

			$results = $this->model_dashboard_theme->getThemeByNameFilters($filter_data);

			foreach ($results as $result) {
				$json[] = array(
					'theme_id' => $result['theme_id'],
					'theme_name'        => strip_tags(html_entity_decode($result['theme_name'], ENT_QUOTES, 'UTF-8'))
				);
			}
		}

		$sort_order = array();

		foreach ($json as $key => $value) {
			$sort_order[$key] = $value['theme_name'];
		}

		array_multisort($sort_order, SORT_ASC, $json);

		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}

	/**
	 * Create by Ajax
	 */
	public function autocreate(){
		if (isset($this->request->get['theme_name'])) {
			$this->load->model('dashboard/theme');
			$json = array('theme_id'=> $this->model_dashboard_theme->addTheme($this->request->get['theme_name']));
			$this->response->addHeader('Content-Type: application/json');
			$this->response->setOutput(json_encode($json));
		}

	}
}
