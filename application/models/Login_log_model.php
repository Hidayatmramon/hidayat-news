<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login_log_model extends CI_Model {
  protected $table = 'login_logs';

  private function _apply_filters(array $filters) {
    if (!empty($filters['q'])) {
      $q = $filters['q'];
      $this->db->group_start()
        ->like('identity', $q)
        ->or_like('ip', $q)
        ->or_like('asn', $q)
        ->or_like('as_name', $q)
        ->or_like('isp', $q)
        ->or_like('country', $q)
        ->or_like('city', $q)
        ->or_like('region', $q)
        ->or_like('user_agent', $q)
      ->group_end();
    }
    if ($filters['is_proxy'] !== '' && $filters['is_proxy'] !== null) {
      $this->db->where('is_proxy', (int)$filters['is_proxy']);
    }
    if (!empty($filters['status'])) {
      $this->db->where('status', $filters['status']);
    }
  }

  public function filter(array $filters, $limit = 20, $offset = 0) {
    $this->_apply_filters($filters);
    return $this->db->order_by('id','desc')->get($this->table, $limit, $offset)->result();
  }

  public function count_filtered(array $filters) {
    $this->_apply_filters($filters);
    return $this->db->count_all_results($this->table);
  }

  public function add($data) {
    $data['created_at'] = date('Y-m-d H:i:s');
    $this->db->insert($this->table, $data);
  }

  public function latest($limit=100) {
    return $this->db->order_by('id','desc')->limit($limit)->get($this->table)->result();
  }

  public function find($id) {
    return $this->db->get_where($this->table, ['id'=>$id])->row();
  }
}
