<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {
  public function __construct() {
    parent::__construct();
    $this->load->model('User_model', 'user_model');
    $this->load->model('Login_log_model', 'login_log');
    $this->load->library(['session','form_validation']);
    $this->load->helper(['form','url','vpn']);
  }

  public function index() {
    if ($this->session->userdata('logged_in')) return redirect('dashboard');
    $data['siteKey'] = $this->config->item('recaptcha_site_key');
    $this->load->view('auth/login', $data);
  }

  private function _recaptcha_verify($token)
  {
    $secret = $this->config->item('recaptcha_secret_key');
    if (empty($secret) || empty($token)) {
      return ['success' => false, 'error' => 'missing-input'];
    }

    $postFields = http_build_query([
      'secret'   => $secret,
      'response' => $token,
      'remoteip' => $this->input->ip_address(),
    ]);

    if (function_exists('curl_init')) {
      $ch = curl_init('https://www.google.com/recaptcha/api/siteverify');
      curl_setopt_array($ch, [
        CURLOPT_POST           => true,
        CURLOPT_POSTFIELDS     => $postFields,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_TIMEOUT        => 10,
      ]);
      $out = curl_exec($ch);
      curl_close($ch);
    } else {
      $ctx = stream_context_create([
        'http' => [
          'method'  => 'POST',
          'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
          'content' => $postFields,
          'timeout' => 10,
        ]
      ]);
      $out = @file_get_contents('https://www.google.com/recaptcha/api/siteverify', false, $ctx);
    }

    $json = @json_decode($out, true);
    return is_array($json) ? $json : ['success' => false, 'error' => 'bad-response'];
  }

  public function login() {
    $this->form_validation->set_rules('identity','Username atau Email','required|trim');
    $this->form_validation->set_rules('password','Password','required');

    if ($this->form_validation->run() === FALSE) {
      $this->session->set_flashdata('error', strip_tags(validation_errors(' ',' ')));
      return redirect('auth');
    }

    $siteKey   = $this->config->item('recaptcha_site_key');
    $secretKey = $this->config->item('recaptcha_secret_key');
    if (!empty($siteKey) && !empty($secretKey)) {
      $token = $this->input->post('g-recaptcha-response', TRUE);
      if (empty($token)) {
        $this->session->set_flashdata('error','Silakan centang reCAPTCHA.');
        return redirect('auth');
      }
      $verify = $this->_recaptcha_verify($token);
      if (empty($verify['success'])) {
        $this->session->set_flashdata('error','Verifikasi reCAPTCHA gagal. Coba lagi.');
        return redirect('auth');
      }
    }

    $identity = $this->input->post('identity', TRUE);
    $password = $this->input->post('password', TRUE);

    $user = $this->user_model->get_by_identity($identity);
    if (!$user) {
      $this->session->set_flashdata('error','Username/email atau password salah.');
      return redirect('auth');
    }

    $posted_ip = $this->input->post('client_ip', TRUE);
    $ip        = ($posted_ip && filter_var($posted_ip, FILTER_VALIDATE_IP)) ? $posted_ip : (function_exists('simple_ip') ? simple_ip() : $this->input->ip_address());
    $ua        = substr($_SERVER['HTTP_USER_AGENT'] ?? '-', 0, 255);

    $is_public = function_exists('is_public_ip') ? is_public_ip($ip) : true;
    if ($is_public && function_exists('vpn_check')) {
      $pr_key = $this->config->item('proxyradar_api_key');
      $check  = vpn_check($ip, $pr_key);
    } else {
      $check = ['is_proxy'=>0,'asn'=>null,'as_name'=>null,'isp'=>null,'country'=>null,'country_code'=>null,'city'=>null,'region'=>null];
    }
    $is_proxy = (int)($check['is_proxy'] ?? 0);

    $ok = password_verify($password, $user->password);

    if ($ok && $user->status === 'active') {
      $this->session->set_userdata([
        'user_id'   => $user->id,
        'username'  => $user->username,
        'role'      => $user->role,
        'logged_in' => TRUE
      ]);
      if (method_exists($this->user_model,'update_last_login')) {
        $this->user_model->update_last_login($user->id);
      }

      if (method_exists($this->login_log,'add')) {
        $this->login_log->add([
          'user_id'=>$user->id,'identity'=>$identity,'ip'=>$ip,'user_agent'=>$ua,
          'is_proxy'=>$is_proxy,'asn'=>$check['asn'] ?? null,'as_name'=>$check['as_name'] ?? null,'isp'=>$check['isp'] ?? null,
          'country'=>$check['country'] ?? null,'country_code'=>$check['country_code'] ?? null,
          'city'=>$check['city'] ?? null,'region'=>$check['region'] ?? null,'status'=>'success'
        ]);
      }

      return redirect('dashboard');
    }

    if (method_exists($this->login_log,'add')) {
      $this->login_log->add([
        'user_id'=>$user->id,'identity'=>$identity,'ip'=>$ip,'user_agent'=>$ua,
        'is_proxy'=>$is_proxy,'asn'=>$check['asn'] ?? null,'as_name'=>$check['as_name'] ?? null,'isp'=>$check['isp'] ?? null,
        'country'=>$check['country'] ?? null,'country_code'=>$check['country_code'] ?? null,
        'city'=>$check['city'] ?? null,'region'=>$check['region'] ?? null,'status'=>'failed'
      ]);
    }

    $this->session->set_flashdata('error',
      $user->status!=='active' ? 'Akun tidak aktif.' : 'Username/email atau password salah.'
    );
    return redirect('auth');
  }

  public function logout() {
    $this->session->sess_destroy();
    redirect('auth');
  }
}
