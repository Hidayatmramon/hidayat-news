<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends CI_Controller {
  public function __construct() {
    parent::__construct();
    is_logged_in();
    $this->load->model('User_model');
    $this->load->helper(['form','url','app']);
    $this->load->library(['form_validation','upload','image_lib','session']);
  }

  public function index() {
    $user_id = (int)$this->session->userdata('user_id');
    $user = $this->User_model->get($user_id);
    if (!$user) show_404();

    $data = ['user' => $user];

    if ($this->input->method() === 'post') {
      $this->form_validation->set_rules('fullname','Nama Lengkap','required|trim');
      $this->form_validation->set_rules('username','Username','required|trim|min_length[3]');
      $this->form_validation->set_rules('email','Email','required|valid_email');

      if ($this->input->post('new_password')) {
        $this->form_validation->set_rules('new_password','Password Baru','min_length[6]');
        $this->form_validation->set_rules('new_password_confirm','Konfirmasi Password','matches[new_password]');
      }

      if ($this->form_validation->run() === FALSE) {
        $data['errors'] = validation_errors();
      } else {
        if ($this->User_model->exists_username($this->input->post('username',TRUE), $user_id)) {
          $data['errors'] = 'Username sudah dipakai.';
        } elseif ($this->User_model->exists_email($this->input->post('email',TRUE), $user_id)) {
          $data['errors'] = 'Email sudah dipakai.';
        } else {
          $update = [
            'fullname' => $this->input->post('fullname', TRUE),
            'username' => $this->input->post('username', TRUE),
            'email'    => $this->input->post('email', TRUE),
          ];
          if ($this->input->post('new_password')) {
            $update['password'] = password_hash($this->input->post('new_password', TRUE), PASSWORD_DEFAULT);
          }

          $remove_avatar = $this->input->post('remove_avatar');
          if ($remove_avatar) {
            safe_unlink($user->avatar);
            $update['avatar'] = NULL;
          }

          if (!empty($_FILES['avatar']['name'])) {
            $upload_dir = FCPATH.'public/uploads/avatars/';
            if (!is_dir($upload_dir)) @mkdir($upload_dir, 0755, true);

            $basename = ($user->uuid ?: ('user-'.$user_id)).'-'.time();
            $config = [
              'upload_path'   => $upload_dir,
              'allowed_types' => 'jpg|jpeg|png|gif|webp',
              'max_size'      => 4096,
              'file_name'     => $basename,
              'overwrite'     => TRUE,
            ];
            $this->upload->initialize($config);

            if (!$this->upload->do_upload('avatar')) {
              $data['errors'] = $this->upload->display_errors('', '');
              $data['user'] = $this->User_model->get($user_id);
              return $this->load->view('dashboard/profile/index', $data);
            } else {
              safe_unlink($user->avatar);

              $up = $this->upload->data(); 
              $relative = 'public/uploads/avatars/'.$up['file_name'];

              $this->image_lib->clear();
              $conf_img = [
                'image_library'  => 'gd2',
                'source_image'   => $up['full_path'],
                'maintain_ratio' => TRUE,
                'width'          => 512,
                'height'         => 512,
                'quality'        => '90%',
              ];
              $this->image_lib->initialize($conf_img);
              $this->image_lib->resize();

              $update['avatar'] = $relative;
            }
          }

          $this->User_model->update($user_id, $update);

          $this->session->set_userdata('username', $update['username']);

          $this->session->set_flashdata('success','Profil berhasil diperbarui.');
          return redirect('profile');
        }
      }
    }

    $this->load->view('dashboard/profile/index', $data);
  }
}
