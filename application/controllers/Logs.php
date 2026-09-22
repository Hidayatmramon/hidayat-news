<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Logs extends CI_Controller {
  public function __construct() {
    parent::__construct();
    is_logged_in(); require_admin();
    $this->load->model('Login_log_model');
    $this->load->library('pagination');
  }

  public function index() {
    $filters = [
      'q'        => trim((string) $this->input->get('q', TRUE)),
      'is_proxy' => $this->input->get('is_proxy', TRUE),
      'status'   => $this->input->get('status', TRUE),
    ];
    if (!in_array($filters['is_proxy'], ['0','1'], true)) $filters['is_proxy'] = '';
    if (!in_array($filters['status'], ['success','failed'], true)) $filters['status'] = '';

    $per_page = 20;
    $page = (int) $this->input->get('page', TRUE);
    if ($page < 1) $page = 1;
    $offset = ($page - 1) * $per_page;

    $total_rows = $this->Login_log_model->count_filtered($filters);
    $logs       = $this->Login_log_model->filter($filters, $per_page, $offset);

    $config = [
      'base_url'            => site_url('logs'),
      'total_rows'          => $total_rows,
      'per_page'            => $per_page,
      'page_query_string'   => TRUE,
      'query_string_segment'=> 'page',
      'reuse_query_string'  => TRUE,

      'full_tag_open'       => '<nav><ul class="pagination mb-0">',
      'full_tag_close'      => '</ul></nav>',
      'attributes'          => ['class' => 'page-link'],

      'num_tag_open'        => '<li class="page-item">',
      'num_tag_close'       => '</li>',
      'cur_tag_open'        => '<li class="page-item active"><span class="page-link">',
      'cur_tag_close'       => '</span></li>',
      'prev_link'           => '&laquo;',
      'prev_tag_open'       => '<li class="page-item">',
      'prev_tag_close'      => '</li>',
      'next_link'           => '&raquo;',
      'next_tag_open'       => '<li class="page-item">',
      'next_tag_close'      => '</li>',
      'first_link'          => FALSE,
      'last_link'           => FALSE,
    ];
    $this->pagination->initialize($config);

    $data = [
      'logs'        => $logs,
      'filters'     => $filters,
      'pagination'  => $this->pagination->create_links(),
    ];
    $this->load->view('dashboard/logs', $data);
  }

  public function show($id) {
    is_logged_in(); require_admin();
    $log = $this->Login_log_model->find((int)$id);
    if (!$log) show_404();
    $this->load->view('dashboard/logs_show', ['log'=>$log]);
  }
}
