<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

function reading_time($html, $wpm = 200) {
  $words = str_word_count(strip_tags($html));
  $mins  = max(1, (int)ceil($words / $wpm));
  return $mins.' menit baca';
}

function thumb_path($path) {
  if (!$path) return null;
  $thumb = str_replace('/covers/', '/covers/thumbs/', $path);
  $abs   = FCPATH.$thumb;
  return is_file($abs) ? $thumb : $path; 
}

function avatar_url($avatar_path) {
  if ($avatar_path && is_file(FCPATH.$avatar_path)) {
    return base_url($avatar_path);
  }
  return base_url('public/backend/images/profile-default.png'); 
}

function safe_unlink($path) {
  if ($path && is_file(FCPATH.$path)) @unlink(FCPATH.$path);
}
