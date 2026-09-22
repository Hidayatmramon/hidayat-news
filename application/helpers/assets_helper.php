<?php defined('BASEPATH') OR exit('No direct script access allowed');

if (!function_exists('front_asset')) {
  function front_asset($path) {
    $path = ltrim($path, '/');
    $file = FCPATH.'public/front/'.$path;
    $url  = base_url('public/front/'.$path);
    $ver  = is_file($file) ? filemtime($file) : (config_item('app_version') ?: time());
    return $url.'?v='.$ver;
  }
}
