<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller {
  public function __construct() {
    parent::__construct();
    is_logged_in(); require_admin();
    $this->load->model('User_model');
    $this->load->helper(['form','url']);
  }

  public function index() {
    $q = $this->input->get('q', TRUE);
    $data['users'] = $this->User_model->all(200,0,$q);
    $data['q'] = $q;
    $this->load->view('dashboard/users/index', $data);
  }

  public function create() {
    if ($this->input->method() === 'post') {
      $this->form_validation->set_rules('username','Username','required|trim|min_length[3]');
      $this->form_validation->set_rules('email','Email','required|valid_email');
      $this->form_validation->set_rules('fullname','Nama Lengkap','required|trim');
      $this->form_validation->set_rules('password','Password','required|min_length[6]');
      $this->form_validation->set_rules('role','Role','required|in_list[admin,editor]');
      $this->form_validation->set_rules('status','Status','required|in_list[active,inactive]');

      if ($this->form_validation->run() === FALSE) {
        $data['errors'] = validation_errors();
      } else {
        if ($this->User_model->exists_username($this->input->post('username',TRUE))) {
          $data['errors'] = 'Username sudah dipakai.';
        } elseif ($this->User_model->exists_email($this->input->post('email',TRUE))) {
          $data['errors'] = 'Email sudah dipakai.';
        } else {
          $this->User_model->create([
            'uuid'      => $this->input->post('uuid', TRUE) ?: $this->_uuidv4(),
            'username'  => $this->input->post('username', TRUE),
            'email'     => $this->input->post('email', TRUE),
            'password'  => password_hash($this->input->post('password', TRUE), PASSWORD_DEFAULT),
            'fullname'  => $this->input->post('fullname', TRUE),
            'role'      => $this->input->post('role', TRUE),
            'status'    => $this->input->post('status', TRUE),
          ]);
          $this->session->set_flashdata('success','User dibuat.');
          return redirect('users');
        }
      }
    }
    $this->load->view('dashboard/users/create', isset($data)?$data:[]);
  }

  public function edit($id) {
    $user = $this->User_model->get($id);
    if (!$user) show_404();

    if ($this->input->method() === 'post') {
      $this->form_validation->set_rules('username','Username','required|trim|min_length[3]');
      $this->form_validation->set_rules('email','Email','required|valid_email');
      $this->form_validation->set_rules('fullname','Nama Lengkap','required|trim');
      $this->form_validation->set_rules('role','Role','required|in_list[admin,editor]');
      $this->form_validation->set_rules('status','Status','required|in_list[active,inactive]');

      if ($this->form_validation->run() === FALSE) {
        $data['errors'] = validation_errors();
      } else {
        if ($this->User_model->exists_username($this->input->post('username',TRUE), $id)) {
          $data['errors'] = 'Username sudah dipakai.';
        } elseif ($this->User_model->exists_email($this->input->post('email',TRUE), $id)) {
          $data['errors'] = 'Email sudah dipakai.';
        } else {
          $update = [
            'username' => $this->input->post('username', TRUE),
            'email'    => $this->input->post('email', TRUE),
            'fullname' => $this->input->post('fullname', TRUE),
            'role'     => $this->input->post('role', TRUE),
            'status'   => $this->input->post('status', TRUE),
          ];
          if ($this->input->post('password')) {
            $update['password'] = password_hash($this->input->post('password', TRUE), PASSWORD_DEFAULT);
          }
          $this->User_model->update($id, $update);
          $this->session->set_flashdata('success','User diupdate.');
          return redirect('users');
        }
      }
    }

    $data['user'] = $user;
    $this->load->view('dashboard/users/edit', $data);
  }

  public function delete($id) {
    if ((int)$id === (int)$this->session->userdata('user_id')) {
      $this->session->set_flashdata('error','Tidak bisa menghapus diri sendiri.');
      return redirect('users');
    }
    $this->User_model->delete($id);
    $this->session->set_flashdata('success','User dihapus.');
    redirect('users');
  }

  private function _uuidv4() {
    $data = random_bytes(16);
    $data[6] = chr((ord($data[6]) & 0x0f) | 0x40);
    $data[8] = chr((ord($data[8]) & 0x3f) | 0x80);
    return vsprintf('%s%s-%s-%s-%s-%s%s%s', str_split(bin2hex($data), 4));
  }
}
