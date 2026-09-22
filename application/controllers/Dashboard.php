<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {
  public function __construct() {
    parent::__construct();
    is_logged_in();
    $this->load->library('session');
  }

  public function index() {
    $this->load->model(['Post_model','User_model']);

    $data['username']     = $this->session->userdata('username');
    $data['role']         = $this->session->userdata('role');
    $data['post_count']   = (int) $this->db->count_all('posts');
    $data['user_count']   = (int) $this->db->count_all('users');
    $data['latest_posts'] = $this->db->order_by('created_at','desc')->limit(5)->get('posts')->result();

    $rows = $this->db->select("DATE_FORMAT(COALESCE(published_at, created_at),'%Y-%m') AS ym, COUNT(*) AS cnt", false)
                     ->from('posts')
                     ->group_by('ym')
                     ->order_by('ym','asc')
                     ->get()->result();

    $map = [];
    foreach ($rows as $r) $map[$r->ym] = (int)$r->cnt;

    $labels = []; $counts = [];
    $dt = new DateTime('first day of -11 months');
    for ($i=0; $i<12; $i++) {
      $key = $dt->format('Y-m');
      $labels[] = $dt->format('M Y');
      $counts[] = isset($map[$key]) ? $map[$key] : 0;
      $dt->modify('+1 month');
    }
    $data['chart_labels'] = $labels;
    $data['chart_counts'] = $counts;

    $this->load->view('dashboard/index', $data);
  }
}
