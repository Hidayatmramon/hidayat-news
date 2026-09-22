<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

if (!function_exists('simple_ip')) {
  function simple_ip() {
    if (!empty($_SERVER['HTTP_CF_CONNECTING_IP'])) return $_SERVER['HTTP_CF_CONNECTING_IP'];
    if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
      $parts = explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']);
      return trim($parts[0]);
    }
    return $_SERVER['REMOTE_ADDR'] ?? '0.0.0.0';
  }
}

if (!function_exists('http_get')) {
  function http_get($url, $timeout = 2) {
    $ctx = stream_context_create([
      'http' => ['method'=>'GET','timeout'=>$timeout,'ignore_errors'=>true,'header'=>"User-Agent: HIDAYATNEWS/1.0\r\n"],
      'ssl'  => ['verify_peer'=>true,'verify_peer_name'=>true]
    ]);
    $body = @file_get_contents($url, false, $ctx);
    if ($body === false) return [null, 'request_failed'];
    if (isset($http_response_header[0]) && preg_match('#HTTP/\S+\s(\d{3})#',$http_response_header[0],$m)) {
      if ((int)$m[1] >= 400) return [null, 'http_'.$m[1]];
    }
    return [$body, null];
  }
}

if (!function_exists('is_public_ip')) {
  function is_public_ip($ip) {
    if (!filter_var($ip, FILTER_VALIDATE_IP)) return false;
    $flags = FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE;
    return (bool) filter_var($ip, FILTER_VALIDATE_IP, $flags);
  }
}

if (!function_exists('flag_emoji')) {
  function flag_emoji($country_code) {
    $cc = strtoupper(trim($country_code ?? ''));
    if (strlen($cc) !== 2) return '';
    $base = 0x1F1E6;
    $chars = [mb_ord($cc[0]) - 65 + $base, mb_ord($cc[1]) - 65 + $base];
    return mb_chr($chars[0],'UTF-8') . mb_chr($chars[1],'UTF-8');
  }
}

if (!function_exists('vpn_check')) {
  function vpn_check($ip, $proxyradar_key) {
    $out = ['is_proxy'=>0,'asn'=>null,'as_name'=>null,'isp'=>null,'country'=>null,'country_code'=>null,'city'=>null,'region'=>null];

    if (!is_public_ip($ip)) return $out;

    // ProxyRadar
    if ($proxyradar_key) {
      list($body,) = http_get("https://proxyradar.io/v1/check?key={$proxyradar_key}&ip={$ip}&format=json", 2);
      if ($body) {
        $j = json_decode($body, true);
        if (is_array($j) && ($j['status'] ?? '') === 'success') {
          $out['is_proxy'] = !empty($j['proxy']) ? 1 : 0;
        }
      }
    }

    // ip-api
    $fields = 'status,as,asname,isp,country,countryCode,city,regionName,query';
    list($body2,) = http_get("http://ip-api.com/json/{$ip}?fields={$fields}", 2);
    if ($body2) {
      $j2 = json_decode($body2, true);
      if (is_array($j2) && ($j2['status'] ?? '') === 'success') {
        $out['asn']          = $j2['as'] ?? null;
        $out['as_name']      = $j2['asname'] ?? null;
        $out['isp']          = $j2['isp'] ?? null;
        $out['country']      = $j2['country'] ?? null;
        $out['country_code'] = $j2['countryCode'] ?? null;
        $out['city']         = $j2['city'] ?? null;
        $out['region']       = $j2['regionName'] ?? null;
      }
    }
    return $out;
  }
}
