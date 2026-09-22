<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Posts extends CI_Controller {
  public function __construct() {
    parent::__construct();
    is_logged_in();
    $this->load->model('Post_model');
    $this->load->helper(['form','url','app']);
    $this->load->library(['form_validation','upload','image_lib']);
  }
	
	private function _do_image_upload() {
  if (empty($_FILES['image']['name'])) return [null, null];

  $upload_dir = FCPATH.'public/uploads/covers/';
  $thumb_dir  = FCPATH.'public/uploads/covers/thumbs/';
  if (!is_dir($upload_dir)) @mkdir($upload_dir, 0777, true);
  if (!is_dir($thumb_dir))  @mkdir($thumb_dir, 0777, true);

  $baseCfg = [
    'upload_path'      => $upload_dir,
    'allowed_types'    => 'gif|jpg|jpeg|jpe|jfif|png|webp',
    'max_size'         => 0,          
    'encrypt_name'     => TRUE,
    'file_ext_tolower' => TRUE,
    'remove_spaces'    => TRUE,
    'detect_mime'      => TRUE,
  ];
  $this->upload->initialize($baseCfg);

  if (!$this->upload->do_upload('image')) {
    $name = isset($_FILES['image']['name']) ? strtolower($_FILES['image']['name']) : '';
    $isWebpExt = substr($name, -5) === '.webp';
    $errMsg = strip_tags($this->upload->display_errors('', ''));

    if ($isWebpExt) {
      $retryCfg = $baseCfg;
      $retryCfg['detect_mime']   = FALSE;
      $retryCfg['allowed_types'] = 'webp';
      $this->upload->initialize($retryCfg);

      if (!$this->upload->do_upload('image')) {
        return [null, $errMsg ?: 'Upload failed .webp.'];
      }

      $up = $this->upload->data();

      $okMagic = FALSE;
      if (is_file($up['full_path'])) {
        $fh = fopen($up['full_path'], 'rb');
        if ($fh) {
          $sig = fread($fh, 12);
          fclose($fh);
          $okMagic = (substr($sig, 0, 4) === 'RIFF' && substr($sig, 8, 4) === 'WEBP');
        }
      }
      if (!$okMagic) {
        @unlink($up['full_path']);
        return [null, 'File WEBP not valid.'];
      }

      return $this->_make_thumb_and_return($up);
    }

    return [null, $errMsg];
  }

  $up = $this->upload->data();
  return $this->_make_thumb_and_return($up);
}

private function _make_thumb_and_return($up) {
  $thumb_dir = FCPATH.'public/uploads/covers/thumbs/';
  $ext = strtolower($up['file_ext']);
  $gd  = function_exists('gd_info') ? gd_info() : [];
  $hasWebP = !empty($gd['WebP Support']);

  $this->image_lib->clear();
  $thumbConf = [
    'image_library'  => 'gd2',
    'source_image'   => $up['full_path'],
    'new_image'      => $thumb_dir.$up['file_name'],
    'maintain_ratio' => TRUE,
    'width'          => 600,
    'height'         => 400,
    'quality'        => '80%',
  ];

  if ($ext === '.webp' && !$hasWebP) {
    log_message('debug', 'webp not available, file='.$up['file_name']);
  } else {
    $this->image_lib->initialize($thumbConf);
    if (!$this->image_lib->resize()) {
      log_message('error', 'ERORR: '.$this->image_lib->display_errors('', ''));
    }
    $this->image_lib->clear();
  }

  return ['public/uploads/covers/'.$up['file_name'], null];
}

  public function index() {
    $q = $this->input->get('q', TRUE);
    $data['posts'] = $this->Post_model->all(200,0,$q);
    $data['q'] = $q;
    $this->load->view('dashboard/posts/index', $data);
  }

  public function create() {
    if ($this->input->method() === 'post') {
      $this->form_validation->set_rules('title','Judul','required|trim|min_length[3]');
      $this->form_validation->set_rules('slug','Slug','required|alpha_dash');
      $this->form_validation->set_rules('body','Isi','required');
      $this->form_validation->set_rules('status','Status','required|in_list[draft,published]');

      if ($this->form_validation->run() === FALSE) {
        $data['errors'] = validation_errors();
      } else {
        if ($this->Post_model->slug_exists($this->input->post('slug',TRUE))) {
          $data['errors'] = 'Slug sudah dipakai.';
        } else {
          list($imgPath, $upErr) = $this->_do_image_upload();
          if ($upErr) {
            $data['errors'] = $upErr;
          } else {
            $payload = [
              'title'        => $this->input->post('title', TRUE),
              'slug'         => $this->input->post('slug', TRUE),
              'body'         => $this->input->post('body'),
              'status'       => $this->input->post('status', TRUE),
              'published_at' => $this->input->post('status')==='published' ? date('Y-m-d H:i:s') : null,
              'author_id'    => (int)$this->session->userdata('user_id'),
            ];
            if ($imgPath) $payload['image'] = $imgPath;

            $this->Post_model->create($payload);
            $this->session->set_flashdata('success','created.');
            return redirect('posts');
          }
        }
      }
    }
    $this->load->view('dashboard/posts/create', isset($data)?$data:[]);
  }

  public function edit($id) {
    $post = $this->Post_model->get($id);
    if (!$post) show_404();

    if ($this->input->method() === 'post') {
      $this->form_validation->set_rules('title','Judul','required|trim|min_length[3]');
      $this->form_validation->set_rules('slug','Slug','required|alpha_dash');
      $this->form_validation->set_rules('body','Isi','required');
      $this->form_validation->set_rules('status','Status','required|in_list[draft,published]');

      if ($this->form_validation->run() === FALSE) {
        $data['errors'] = validation_errors();
      } else {
        if ($this->Post_model->slug_exists($this->input->post('slug',TRUE), $id)) {
          $data['errors'] = 'Slug sudah dipakai.';
        } else {
          list($imgPath, $upErr) = $this->_do_image_upload();
          if ($upErr) {
            $data['errors'] = $upErr;
          } else {
            $payload = [
              'title'        => $this->input->post('title', TRUE),
              'slug'         => $this->input->post('slug', TRUE),
              'body'         => $this->input->post('body'),
              'status'       => $this->input->post('status', TRUE),
            ];
            if ($imgPath) {
              if (!empty($post->image)) {
                @unlink(FCPATH.$post->image);
                $oldThumb = thumb_path($post->image);
                if ($oldThumb) @unlink(FCPATH.$oldThumb);
              }
              $payload['image'] = $imgPath;
            }

            $this->Post_model->update($id, $payload);
            $this->session->set_flashdata('success','updated.');
            return redirect('posts');
          }
        }
      }
    }

    $data['post'] = $post;
    $this->load->view('dashboard/posts/edit', $data);
  }

  public function delete($id) {
    $post = $this->Post_model->get($id);
    if ($post && !empty($post->image)) {
      @unlink(FCPATH.$post->image);
      $thumb = thumb_path($post->image);
      if ($thumb) @unlink(FCPATH.$thumb);
    }
    $this->Post_model->delete($id);
    $this->session->set_flashdata('success','deleted.');
    redirect('posts');
  }
}
