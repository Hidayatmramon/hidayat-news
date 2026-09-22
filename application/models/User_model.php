<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model {
  private $table = 'users';

  public function get_by_identity($identity) {
    return $this->db->group_start()
              ->where('username', $identity)
              ->or_where('email', $identity)
            ->group_end()
            ->get($this->table)->row();
  }

  public function get($id) {
    return $this->db->get_where($this->table, ['id'=>$id])->row();
  }

  public function all($limit=100, $offset=0, $keyword=null) {
    if ($keyword) {
      $this->db->group_start()
        ->like('username',$keyword)
        ->or_like('email',$keyword)
        ->or_like('fullname',$keyword)
      ->group_end();
    }
    return $this->db->order_by('id','desc')
            ->get($this->table, $limit, $offset)->result();
  }

  public function exists_username($username, $exclude_id=null) {
    $this->db->where('username',$username);
    if ($exclude_id) $this->db->where('id !=', $exclude_id);
    return $this->db->count_all_results($this->table) > 0;
  }

  public function exists_email($email, $exclude_id=null) {
    $this->db->where('email',$email);
    if ($exclude_id) $this->db->where('id !=', $exclude_id);
    return $this->db->count_all_results($this->table) > 0;
  }

  public function create($data) {
    $data['created_at'] = date('Y-m-d H:i:s');
    $data['updated_at'] = date('Y-m-d H:i:s');
    $this->db->insert($this->table, $data);
    return $this->db->insert_id();
  }

  public function update($id, $data) {
    $data['updated_at'] = date('Y-m-d H:i:s');
    $this->db->where('id',$id)->update($this->table,$data);
    return $this->db->affected_rows() >= 0;
  }

  public function delete($id) {
    return $this->db->delete($this->table, ['id'=>$id]);
  }

  public function update_last_login($user_id) {
    $this->db->where('id', $user_id)
             ->update($this->table, ['last_login' => date('Y-m-d H:i:s')]);
  }
}
