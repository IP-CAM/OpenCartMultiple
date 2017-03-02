<?php
class ControllerDashboardCreation extends Controller {
	private $error = array();

	public function index() {
		$this->load->language('dashboard/creation');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('dashboard/creation');

		$this->getList();
	}

	protected function getList() {

		if (isset($this->request->get['page'])) {
			$page = $this->request->get['page'];
		} else {
			$page = 1;
		}

		$url = '';
		if (isset($this->request->get['page'])) {
			$url .= '&page=' . $this->request->get['page'];
		}

		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('dashboard/home', '', true)
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('dashboard/creation', '' . $url, true)
		);

		$data['add'] = $this->url->link('dashboard/creation/add', '' . $url, true);
		$data['delete'] = $this->url->link('dashboard/creation/delete', '' . $url, true);
		$data['edit'] = $this->url->link('dashboard/creation/edit', '' . $url, true);

		$data['creations'] = array();

		$filter_data = array(
			'start'                   => ($page - 1) * $this->config->get('config_limit_admin'),
			'limit'                   => $this->config->get('config_limit_admin')
		);

		$creation_total = $this->model_dashboard_creation->getTotalCreations();

		$results = $this->model_dashboard_creation->getCreations($filter_data);

        $this->load->model('tool/image');
		foreach ($results as $result) {
			$data['creations'][] = array(
				'creation_id'     => $result['creation_id'],
				'creation_name'      => $result['creation_name'],
				'creation_description'      => $result['creation_description'],
                'creation_url_full'      => $result['creation_url_show'] == ""? $this->model_tool_image->resize('no_image.png', 100, 100):QINIU_BASE.$result['creation_url_show']."!thumb",
				'edit'          => $this->url->link('dashboard/creation/edit', '' . '&creation_id=' . $result['creation_id'] . $url, true),
				'delete'          => $this->url->link('dashboard/creation/delete', '' . '&creation_id=' . $result['creation_id'] . $url, true)
			);
		}


		$data['heading_title'] = $this->language->get('heading_title');

		$data['text_list'] = $this->language->get('text_list');
		$data['text_no_results'] = $this->language->get('text_no_results');
		$data['text_confirm'] = $this->language->get('text_confirm');

		$data['column_creation_name'] = $this->language->get('column_creation_name');
		$data['column_creation_img'] = $this->language->get('column_creation_img');
		$data['column_creation_description'] = $this->language->get('column_creation_description');

		$data['button_add'] = $this->language->get('button_add');
		$data['button_edit'] = $this->language->get('button_edit');
		$data['button_delete'] = $this->language->get('button_delete');

		if (isset($this->session->data['error'])) {
			$data['error_warning'] = $this->session->data['error'];

			unset($this->session->data['error']);
		} elseif (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}

		if (isset($this->session->data['success'])) {
			$data['success'] = $this->session->data['success'];

			unset($this->session->data['success']);
		} else {
			$data['success'] = '';
		}

		$pagination = new Pagination();
		$pagination->total = $creation_total;
		$pagination->page = $page;
		$pagination->limit = $this->config->get('config_limit_admin');
		$pagination->url = $this->url->link('dashboard/creation', '&page={page}', true);

		$data['pagination'] = $pagination->render();

		$data['results'] = sprintf($this->language->get('text_pagination'), ($creation_total) ? (($page - 1) * $this->config->get('config_limit_admin')) + 1 : 0, ((($page - 1) * $this->config->get('config_limit_admin')) > ($creation_total - $this->config->get('config_limit_admin'))) ? $creation_total : ((($page - 1) * $this->config->get('config_limit_admin')) + $this->config->get('config_limit_admin')), $creation_total, ceil($creation_total / $this->config->get('config_limit_admin')));

		$data['header'] = $this->load->controller('dashboard/layoutheader');
		$data['column_left'] = $this->load->controller('dashboard/layoutleft');
		$data['footer'] = $this->load->controller('dashboard/layoutfooter');

		$this->response->setOutput($this->load->view('dashboard/creation_list', $data));
	}

	public function add() {
		$this->load->language('dashboard/creation');
		$this->document->setTitle($this->language->get('heading_title'));
		$this->load->model('dashboard/creation');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
			//Combine new Image
			$this->load->model('tool/image');
			$fillColorImgUrl = $this->model_tool_image->toFillColor($this->request->post['creation_color'],700,QINIU_BASE.$this->request->post['creation_url']."!creation");
			//Upload
			$this->load->model('tool/file');
			$this->model_tool_file->getQiniuToken();
			$uploadFile = $this->model_tool_file->uploadToQiniu($fillColorImgUrl,floor($this->customer->getId()/1000)."/".$this->customer->getId()."/");

			if($uploadFile != "fail"){
				$this->request->post['creation_url_show'] = $uploadFile;
				$this->model_dashboard_creation->addCreation($this->request->post);

				$this->model_tool_file->deleteFile($fillColorImgUrl);
				$this->session->data['success'] = $this->language->get('text_success');
				$url = '';
				if (isset($this->request->get['page'])) {
					$url .= '&page=' . $this->request->get['page'];
				}
				$this->response->redirect($this->url->link('dashboard/creation', '' . $url, true));

			}
		}

		$this->getForm();
	}

	public function edit() {
		$this->load->language('dashboard/creation');
		$this->document->setTitle($this->language->get('heading_title'));
		$this->load->model('dashboard/creation');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
			if($this->request->post['creation_color_origin'] != $this->request->post['creation_color']){
				//生成图片
				//Combine new Image
				$this->load->model('tool/image');
				$fillColorImgUrl = $this->model_tool_image->toFillColor($this->request->post['creation_color'],700,QINIU_BASE.$this->request->post['creation_url']."!creation");
				//Upload
				$this->load->model('tool/file');
				$this->model_tool_file->getQiniuToken();
				$uploadFile = $this->model_tool_file->uploadToQiniu($fillColorImgUrl,floor($this->customer->getId()/1000)."/".$this->customer->getId()."/");
				if($uploadFile != "fail") {
					$this->request->post['creation_url_show'] = $uploadFile;
					$this->model_tool_file->deleteFile($fillColorImgUrl);
				}
			}
			$this->model_dashboard_creation->editCreation($this->request->get['creation_id'], $this->request->post);
			$this->session->data['success'] = $this->language->get('text_success');
			$url = '';
			if (isset($this->request->get['page'])) {
				$url .= '&page=' . $this->request->get['page'];
			}
			$this->response->redirect($this->url->link('dashboard/creation', '' . $url, true));
		}

		$this->getForm();
	}

	protected function getForm() {
		$data['heading_title'] = $this->language->get('heading_title');

		$data['text_form'] = !isset($this->request->get['creation_id']) ? $this->language->get('text_add') : $this->language->get('text_edit');
		$data['text_form_type'] = !isset($this->request->get['creation_id']) ? "add": "edit";

		$data['entry_creation_name'] = $this->language->get('column_creation_name');
        $data['entry_creation_img'] = $this->language->get('column_creation_img');
		$data['entry_creation_description'] = $this->language->get('column_creation_description');
		$data['entry_creation_color'] = $this->language->get('entry_creation_color');
		$data['column_rank_help'] = $this->language->get('column_rank_help');

		$data['button_save'] = $this->language->get('button_save');
		$data['button_cancel'] = $this->language->get('button_cancel');

		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}

		if (isset($this->error['creation_name'])) {
			$data['error_creation_name'] = $this->error['creation_name'];
		} else {
			$data['error_creation_name'] = '';
		}

		if (isset($this->error['creation_color'])) {
			$data['error_creation_color'] = $this->error['creation_color'];
		} else {
			$data['error_creation_color'] = '';
		}

		$url = '';

		if (isset($this->request->get['page'])) {
			$url .= '&page=' . $this->request->get['page'];
		}

		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
				'text' => $this->language->get('text_home'),
				'href' => $this->url->link('dashboard/home', '', true)
		);

		$data['breadcrumbs'][] = array(
				'text' => $this->language->get('heading_title'),
				'href' => $this->url->link('dashboard/creation', '' . $url, true)
		);

		if (!isset($this->request->get['creation_id'])) {
			$data['action'] = $this->url->link('dashboard/creation/add', '' . $url, true);
			$data['creation_id'] = "";
		} else {
			$data['action'] = $this->url->link('dashboard/creation/edit', '' . '&creation_id=' . $this->request->get['creation_id'] . $url, true);
			$data['creation_id'] = $this->request->get['creation_id'];
		}

		$data['cancel'] = $this->url->link('dashboard/creation', '' . $url, true);

		if (isset($this->request->get['creation_id']) && ($this->request->server['REQUEST_METHOD'] != 'POST')) {
			$creation_info = $this->model_dashboard_creation->getCreation($this->request->get['creation_id']);
		}

		if (isset($this->request->post['creation_name'])) {
			$data['creation_name'] = $this->request->post['creation_name'];
		} elseif (!empty($creation_info)) {
			$data['creation_name'] = $creation_info['creation_name'];
		} else {
			$data['creation_name'] = '';
		}

		if (isset($this->request->post['creation_description'])) {
			$data['creation_description'] = $this->request->post['creation_description'];
		} elseif (!empty($creation_info)) {
			$data['creation_description'] = $creation_info['creation_description'];
		} else {
			$data['creation_description'] = '';
		}

		if (isset($this->request->post['creation_color'])) {
			$data['creation_color'] = $this->request->post['creation_color'];
		} elseif (!empty($creation_info)) {
			$data['creation_color'] = $creation_info['creation_color'];
		} else {
			$data['creation_color'] = '';
		}

        //image
        $this->load->model('tool/image');
        if (isset($this->request->post['creation_url'])) {
            $data['creation_url'] = $this->request->post['creation_url'];
        } elseif (!empty($creation_info)) {
            $data['creation_url'] = $creation_info['creation_url'];
        } else {
            $data['creation_url'] = '';
        }
        if($data['creation_url'] == ""){
            $data['creation_url_full'] = $this->model_tool_image->resize('no_image.png', 100, 100);
        }else{
            $data['creation_url_full'] = QINIU_BASE.$data['creation_url']."!thumb";
        }
		if (isset($this->request->post['creation_url_show'])) {
			$data['creation_url_show'] = $this->request->post['creation_url_show'];
		} elseif (!empty($creation_info)) {
			$data['creation_url_show'] = $creation_info['creation_url_show'];
		} else {
			$data['creation_url_show'] = '';
		}

		if (isset($this->request->post['creation_url'])) {
			$data['creation_url'] = $this->request->post['creation_url'];
		} elseif (!empty($creation_info)) {
			$data['creation_url'] = $creation_info['creation_url'];
		} else {
			$data['creation_url'] = '';
		}

        // qiniu
        $this->load->model('tool/file');
        $data['qiniu_token'] = $this->model_tool_file->getQiniuToken();
		//$this->model_tool_file->uploadToQiniu("C:/wamp/www/opencart/image/temp/1.png","0/1/");

        $data['img_dir'] = floor($this->customer->getId()/1000)."/".$this->customer->getId()."/";

		$data['header'] = $this->load->controller('dashboard/layoutheader');
		$data['column_left'] = $this->load->controller('dashboard/layoutleft');
		$data['footer'] = $this->load->controller('dashboard/layoutfooter');

		$this->response->setOutput($this->load->view('dashboard/creation_form', $data));
	}


	public function delete() {
		$this->load->language('dashboard/creation');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('dashboard/creation');

		if (isset($this->request->post['creation_id']) && $this->validateDelete()) {

			$this->model_dashboard_creation->deleteCreation($this->request->post['creation_id']);
			$this->session->data['success'] = $this->language->get('text_success');
			$url = '';
			if (isset($this->request->get['page'])) {
				$url .= '&page=' . $this->request->get['page'];
			}

			$this->response->redirect($this->url->link('dashboard/creation', '' . $url, true));
		}

		$this->getList();
	}

	protected function validateForm() {

		if ((utf8_strlen($this->request->post['creation_name']) < 2) || (utf8_strlen($this->request->post['creation_name']) > 32)) {
			$this->error['creation_name'] = $this->language->get('error_creation_name');
		}

		if (utf8_strlen($this->request->post['creation_color']) !=  6) {
			$this->error['creation_color'] = $this->language->get('error_creation_color');
		}

		return !$this->error;
	}

	protected function validateDelete() {
		return !$this->error;
	}

	/**
	 * Product list页面
	 */
	public function product() {
		$data['header'] = $this->load->controller('dashboard/layoutheader');
		$data['column_left'] = $this->load->controller('dashboard/layoutleft');
		$data['footer'] = $this->load->controller('dashboard/layoutfooter');

		$this->response->setOutput($this->load->view('dashboard/creation_product', $data));
	}

}