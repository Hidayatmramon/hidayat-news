<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Post_model extends CI_Model {
  private $table = 'posts';

  public function all_public($limit=10, $offset=0) {
    return $this->db
      ->select('posts.*, posts.image as cover_image, users.fullname as author_name, users.avatar as author_avatar')
      ->from($this->table)
      ->join('users','users.id = posts.author_id','left')
      ->where('posts.status','published')
      ->order_by('posts.published_at','desc')
      ->limit($limit,$offset)
      ->get()->result();
  }

  public function all($limit=100, $offset=0, $keyword=null) {
    if ($keyword) {
      $this->db->group_start()
        ->like('title',$keyword)
        ->or_like('slug',$keyword)
      ->group_end();
    }
    return $this->db->order_by('id','desc')
      ->get($this->table,$limit,$offset)->result();
  }

  public function get_by_slug($slug) {
    return $this->db
      ->select('posts.*, posts.image as cover_image, users.fullname as author_name, users.avatar as author_avatar')
      ->from($this->table)
      ->join('users','users.id = posts.author_id','left')
      ->where(['posts.slug'=>$slug,'posts.status'=>'published'])
      ->get()->row();
  }

  public function get($id) {
    return $this->db->get_where($this->table, ['id'=>$id])->row();
  }

  public function create($data) {
    $data['created_at'] = date('Y-m-d H:i:s');
    $data['updated_at'] = date('Y-m-d H:i:s');
    if ($data['status']==='published' && empty($data['published_at'])) {
      $data['published_at'] = date('Y-m-d H:i:s');
    }
    $this->db->insert($this->table,$data);
    return $this->db->insert_id();
  }

  public function update($id, $data) {
    $data['updated_at'] = date('Y-m-d H:i:s');
    if (isset($data['status']) && $data['status']==='published' && empty($data['published_at'])) {
      $data['published_at'] = date('Y-m-d H:i:s');
    }
    $this->db->where('id',$id)->update($this->table,$data);
    return $this->db->affected_rows() >= 0;
  }

  public function delete($id) {
    return $this->db->delete($this->table,['id'=>$id]);
  }

  public function slug_exists($slug, $exclude_id=null) {
    $this->db->where('slug',$slug);
    if ($exclude_id) $this->db->where('id !=', $exclude_id);
    return $this->db->count_all_results($this->table) > 0;
  }
}
