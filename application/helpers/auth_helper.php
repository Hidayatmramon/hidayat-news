<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

if (!function_exists('is_logged_in')) {
  function is_logged_in() {
    $CI =& get_instance();
    $CI->load->library('session');
    if (!$CI->session->userdata('logged_in')) {
      redirect('auth');
      exit;
    }
  }
}

if (!function_exists('is_admin')) {
  function is_admin() {
    $CI =& get_instance();
    return $CI->session->userdata('role') === 'admin';
  }
}

if (!function_exists('require_admin')) {
  function require_admin() {
    if (!is_admin()) {
      $CI =& get_instance();
      $CI->session->set_flashdata('error', 'Akses ditolak. Admin saja.');
      redirect('dashboard');
      exit;
    }
  }
}
