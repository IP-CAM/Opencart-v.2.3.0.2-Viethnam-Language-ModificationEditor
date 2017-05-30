<?php
class ControllerConfigLinkSeo extends Controller {
	private $error = array();

	public function index() {
		$this->load->language('config/link_seo');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('config/link_seo');

		$this->getList();
	}

	public function add() {
	    $this->load->language('config/link_seo');

	    $this->document->setTitle($this->language->get('heading_title'));

	    $this->load->model('config/link_seo');

	    if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {

	        $this->model_config_link_seo->insert('url_alias', $this->request->post);
	        $this->session->data['success'] = $this->language->get('text_success');

	        $this->response->redirect($this->url->link('config/link_seo', 'token=' . $this->session->data['token'], 'SSL'));
	    }

	    $this->getForm();
	}

	public function edit() {
		$this->load->language('config/link_seo');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('config/link_seo');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
			$this->model_config_link_seo->update($this->request->get['url_alias_id'], $this->request->post);

			$this->session->data['success'] = $this->language->get('text_success');

			$this->response->redirect($this->url->link('config/link_seo', 'token=' . $this->session->data['token'], 'SSL'));
		}

		$this->getForm();
	}

    public function delete() {
		$this->language->load('config/link_seo');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('config/link_seo');

		if (isset($this->request->post['selected']) && $this->validateDelete()) {
			foreach ($this->request->post['selected'] as $url_alias_id) {
				$this->model_config_link_seo->deleteLinkSeo($url_alias_id);
			}

			$this->session->data['success'] = $this->language->get('text_success');

			$url = '';

			if (isset($this->request->get['filter_query'])) {
				$url .= '&filter_query=' . urlencode(html_entity_decode($this->request->get['filter_query'], ENT_QUOTES, 'UTF-8'));
			}

			if (isset($this->request->get['filter_keyword'])) {
				$url .= '&filter_keyword=' . urlencode(html_entity_decode($this->request->get['filter_keyword'], ENT_QUOTES, 'UTF-8'));
			}

			if (isset($this->request->get['page'])) {
				$url .= '&page=' . $this->request->get['page'];
			}

			$this->response->redirect($this->url->link('config/link_seo', 'token=' . $this->session->data['token'] . $url, 'SSL'));
		}

		$this->getList();
	}

	protected function getList() {
	    if (isset($this->request->get['filter_query'])) {
	        $filter_query = $this->request->get['filter_query'];
	    } else {
	        $filter_query = null;
	    }

	    if (isset($this->request->get['filter_keyword'])) {
	        $filter_keyword = $this->request->get['filter_keyword'];
	    } else {
	        $filter_keyword = null;
	    }

	    if (isset($this->request->get['page'])) {
	        $page = $this->request->get['page'];
	    } else {
	        $page = 1;
	    }

	    $url = '';

	    if (isset($this->request->get['filter_query'])) {
	        $url .= '&filter_query=' . urlencode(html_entity_decode($this->request->get['filter_query'], ENT_QUOTES, 'UTF-8'));
	    }

	    if (isset($this->request->get['filter_keyword'])) {
	        $url .= '&filter_keyword=' . urlencode(html_entity_decode($this->request->get['filter_keyword'], ENT_QUOTES, 'UTF-8'));
	    }

	    if (isset($this->request->get['page'])) {
	        $url .= '&page=' . $this->request->get['page'];
	    }

	    $data['breadcrumbs'] = array();

	    $data['breadcrumbs'][] = array(
	        'text' => $this->language->get('text_home'),
	        'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], 'SSL')
	    );

	    $data['breadcrumbs'][] = array(
	        'text' => $this->language->get('heading_title'),
	        'href' => $this->url->link('config/link_seo', 'token=' . $this->session->data['token'] . $url, 'SSL')
	    );

	    $data['add'] = $this->url->link('config/link_seo/add', 'token=' . $this->session->data['token'] . $url, 'SSL');
	    $data['copy'] = $this->url->link('config/link_seo/copy', 'token=' . $this->session->data['token'] . $url, 'SSL');
	    $data['delete'] = $this->url->link('config/link_seo/delete', 'token=' . $this->session->data['token'] . $url, 'SSL');

	    $data['link_seo'] = array();

	    $filter_data = array(
	        'filter_query'	  => $filter_query,
	        'filter_keyword'  => $filter_keyword,
	        'start'           => ($page - 1) * $this->config->get('config_limit_admin'),
	        'limit'           => $this->config->get('config_limit_admin')
	    );

	    $this->load->model('config/link_seo');

	    $url_total = $this->model_config_link_seo->getTotalLinkSeo($filter_data);

	    $results = $this->model_config_link_seo->getLinkSeo($filter_data);

	    foreach ($results as $result) {
	        $data['link_seo'][] = array(
	            'url_alias_id' => $result['url_alias_id'],
	            'query'       => $result['query'],
	            'keyword'      => $result['keyword'],
	            'edit'       => $this->url->link('config/link_seo/edit', 'token=' . $this->session->data['token'] . '&url_alias_id=' . $result['url_alias_id'] . $url, 'SSL')
	        );
	    }

	    $data['heading_title'] = $this->language->get('heading_title');

	    $data['text_list'] = $this->language->get('text_list');
	    $data['text_enabled'] = $this->language->get('text_enabled');
	    $data['text_disabled'] = $this->language->get('text_disabled');
	    $data['text_no_results'] = $this->language->get('text_no_results');
	    $data['text_confirm'] = $this->language->get('text_confirm');


	    $data['entry_query'] = $this->language->get('entry_query');
	    $data['entry_keyword'] = $this->language->get('entry_keyword');
	    $data['column_query'] = $this->language->get('column_query');
	    $data['column_keyword'] = $this->language->get('column_keyword');
	    $data['column_action'] = $this->language->get('column_action');

	    $data['button_copy'] = $this->language->get('button_copy');
	    $data['button_add'] = $this->language->get('button_add');
	    $data['button_edit'] = $this->language->get('button_edit');
	    $data['button_delete'] = $this->language->get('button_delete');
	    $data['button_filter'] = $this->language->get('button_filter');

	    $data['token'] = $this->session->data['token'];

	    if (isset($this->error['warning'])) {
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

	    if (isset($this->request->post['selected'])) {
	        $data['selected'] = (array)$this->request->post['selected'];
	    } else {
	        $data['selected'] = array();
	    }

	    $url = '';

	    if (isset($this->request->get['filter_query'])) {
	        $url .= '&filter_query=' . urlencode(html_entity_decode($this->request->get['filter_query'], ENT_QUOTES, 'UTF-8'));
	    }

	    if (isset($this->request->get['filter_keyword'])) {
	        $url .= '&filter_keyword=' . urlencode(html_entity_decode($this->request->get['filter_keyword'], ENT_QUOTES, 'UTF-8'));
	    }


	    if (isset($this->request->get['page'])) {
	        $url .= '&page=' . $this->request->get['page'];
	    }

	    $url = '';

	    if (isset($this->request->get['filter_query'])) {
	        $url .= '&filter_query=' . urlencode(html_entity_decode($this->request->get['filter_query'], ENT_QUOTES, 'UTF-8'));
	    }

	    if (isset($this->request->get['filter_keyword'])) {
	        $url .= '&filter_keyword=' . urlencode(html_entity_decode($this->request->get['filter_keyword'], ENT_QUOTES, 'UTF-8'));
	    }



	    $pagination = new Pagination();
	    $pagination->total = $url_total;
	    $pagination->page = $page;
	    $pagination->limit = $this->config->get('config_limit_admin');
	    $pagination->url = $this->url->link('config/link_seo', 'token=' . $this->session->data['token'] . $url . '&page={page}', 'SSL');

	    $data['pagination'] = $pagination->render();

	    $data['results'] = sprintf($this->language->get('text_pagination'), ($url_total) ? (($page - 1) * $this->config->get('config_limit_admin')) + 1 : 0, ((($page - 1) * $this->config->get('config_limit_admin')) > ($url_total - $this->config->get('config_limit_admin'))) ? $url_total : ((($page - 1) * $this->config->get('config_limit_admin')) + $this->config->get('config_limit_admin')), $url_total, ceil($url_total / $this->config->get('config_limit_admin')));

	    $data['filter_query'] = $filter_query;
	    $data['filter_keyword'] = $filter_keyword;

	    $data['header'] = $this->load->controller('common/header');
	    $data['column_left'] = $this->load->controller('common/column_left');
	    $data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('config/link_seo_list.tpl', $data));
	}

	protected function getForm() {

		$data['heading_title'] = $this->language->get('heading_title');

		$data['text_form'] = !isset($this->request->get['url_alias_id']) ? $this->language->get('text_add') : $this->language->get('text_edit');

		$data['entry_query'] = $this->language->get('entry_query');
		$data['entry_keyword'] = $this->language->get('entry_keyword');

		$data['button_save'] = $this->language->get('button_save');
		$data['button_cancel'] = $this->language->get('button_cancel');

	    if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}

		if (isset($this->error['query'])) {
			$data['error_query'] = $this->error['query'];
		} else {
			$data['error_query'] = '';
		}

		if (isset($this->error['keyword'])) {
			$data['error_keyword'] = $this->error['keyword'];
		} else {
			$data['error_keyword'] = '';
		}


		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], 'SSL')
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('config/link_seo', 'token=' . $this->session->data['token'] , 'SSL')
		);

		if (!isset($this->request->get['url_alias_id'])) {
			$data['action'] = $this->url->link('config/link_seo/add', 'token=' . $this->session->data['token'], 'SSL');
		} else {
			$data['action'] = $this->url->link('config/link_seo/edit', 'token=' . $this->session->data['token'] . '&url_alias_id=' . $this->request->get['url_alias_id'] , 'SSL');
		}

		$data['cancel'] = $this->url->link('config/link_seo', 'token=' . $this->session->data['token'], 'SSL');


		if (isset($this->request->get['url_alias_id'])) {
		    $url_alias_info = $this->model_config_link_seo->getInfoSeo($this->request->get['url_alias_id']);
		}


		if (isset($this->request->post['query'])) {
		    $data['query'] = $this->request->post['query'];
		} elseif (!empty($url_alias_info)) {
		    $data['query'] = $url_alias_info['query'];
		} else {
		    $data['query'] = '';
		}

		if (isset($this->request->post['keyword'])) {
		    $data['keyword'] = $this->request->post['keyword'];
		} elseif (!empty($url_alias_info)) {
		    $data['keyword'] = $url_alias_info['keyword'];
		} else {
		    $data['keyword'] = '';
		}

		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('config/link_seo_form.tpl', $data));
	}

	protected function validateForm() {
		if (!$this->user->hasPermission('modify', 'config/link_seo')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

	   if ((utf8_strlen(trim($this->request->post['query'])) < 3) || (utf8_strlen(trim($this->request->post['query'])) > 255)) {
			$this->error['query'] = $this->language->get('error_query');
		}

		if ((utf8_strlen(trim($this->request->post['keyword'])) < 3) || (utf8_strlen(trim($this->request->post['keyword'])) > 255)) {
			$this->error['keyword'] = $this->language->get('error_keyword');
		}

		return !$this->error;
	}

	protected function validateDelete() {
		if (!$this->user->hasPermission('modify', 'config/link_seo')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}
		return !$this->error;
	}

	public function autocomplete() {
	    $json = array();

	    if (isset($this->request->get['filter_query']) || isset($this->request->get['filter_keyword'])) {
	        $this->load->model('config/link_seo');

	        if (isset($this->request->get['filter_query'])) {
	            $filter_query = $this->request->get['filter_query'];
	        } else {
	            $filter_query = '';
	        }

	        if (isset($this->request->get['filter_keyword'])) {
	            $filter_keyword = $this->request->get['filter_keyword'];
	        } else {
	            $filter_keyword = '';
	        }

	        if (isset($this->request->get['limit'])) {
	            $limit = $this->request->get['limit'];
	        } else {
	            $limit = 5;
	        }

	        $filter_data = array(
	            'filter_query'  => $filter_query,
	            'filter_keyword' => $filter_keyword,
	            'start'        => 0,
	            'limit'        => $limit
	        );

	        $results = $this->model_config_link_seo->getLinkSeo($filter_data);

	        foreach ($results as $result) {
	            $json[] = array(
	                'url_alias_id' => $result['url_alias_id'],
	                'query'        => strip_tags(html_entity_decode($result['query'], ENT_QUOTES, 'UTF-8')),
	                'keyword'      => strip_tags(html_entity_decode($result['keyword'], ENT_QUOTES, 'UTF-8'))
	            );
	        }
	    }

	    $this->response->addHeader('Content-Type: application/json');
	    $this->response->setOutput(json_encode($json));
	}

}
