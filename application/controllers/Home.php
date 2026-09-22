<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {
  public function __construct() {
    parent::__construct();
    $this->load->model('Post_model');
    $this->load->library('pagination');
    $this->load->helper(['url','text','app']);
  }

  public function index() {
    $title   = 'Hidayatnews';
    $perPage = 9;

    $page   = (int) $this->input->get('page');
    $page   = $page > 0 ? $page : 1;
    $offset = ($page - 1) * $perPage;

    $total = $this->db->where('status','published')->count_all_results('posts');

    $config['base_url']            = site_url();   
    $config['first_url']           = site_url();
    $config['total_rows']          = $total;
    $config['per_page']            = $perPage;
    $config['page_query_string']   = TRUE;
    $config['query_string_segment']= 'page';
    $config['num_links']           = 2;

    $config['full_tag_open']   = '<nav aria-label="Page navigation"><ul class="pagination justify-content-center">';
    $config['full_tag_close']  = '</ul></nav>';
    $config['attributes']      = ['class' => 'page-link'];
    $config['first_link']      = 'Pertama';
    $config['last_link']       = 'Terakhir';
    $config['next_link']       = '>';
    $config['prev_link']       = '<';
    $config['first_tag_open']  = '<li class="page-item">';
    $config['first_tag_close'] = '</li>';
    $config['last_tag_open']   = '<li class="page-item">';
    $config['last_tag_close']  = '</li>';
    $config['next_tag_open']   = '<li class="page-item">';
    $config['next_tag_close']  = '</li>';
    $config['prev_tag_open']   = '<li class="page-item">';
    $config['prev_tag_close']  = '</li>';
    $config['cur_tag_open']    = '<li class="page-item active"><span class="page-link">';
    $config['cur_tag_close']   = '</span></li>';
    $config['num_tag_open']    = '<li class="page-item">';
    $config['num_tag_close']   = '</li>';

    $this->pagination->initialize($config);

    $data = [
      'title'      => $title,
      'meta'       => ['description' => 'Update berita terbaru dari HIDAYATNEWS.'],
      'posts'      => $this->Post_model->all_public($perPage, $offset),
      'pagination' => $this->pagination->create_links(),
    ];

    $this->load->view('home/index', $data);
  }

	public function show($slug) {
  $post = $this->Post_model->get_by_slug($slug);
  if (!$post) show_404();

  $data = [
    'post'  => $post,
		'title' => 'Hidayatnews | ' . ($post->title ?? ''),
    'meta'  => [
      'description' => character_limiter(strip_tags($post->body), 160),
      'image'       => $post->cover_image ? base_url($post->cover_image) : null,
    ],
  ];
  $this->load->view('home/show', $data);
}

}
