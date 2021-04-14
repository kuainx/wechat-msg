<?php
function httpRequest($url = '', $data = '')
{
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, $url);
  curl_setopt($ch, CURLOPT_TIMEOUT, 30);
  curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
  curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
  curl_setopt($ch, CURLOPT_HEADER, FALSE);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
  if ($data) {
    curl_setopt($ch, CURLOPT_POST, TRUE);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
  }
  $res = curl_exec($ch);
  if (!$res) {
    $data['return_code'] = 'FAIL';
    $data['return_msg'] = 'curl出错，错误码: ' . curl_error($ch) . '详情: ' . curl_error($ch);
  } else {
    $data = json_decode($res, true);
  }
  curl_close($ch);
  return $data;
}

function base16_encode($string)
{
  $encode = '';
  $chars = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9', 'A', 'B', 'C', 'D', 'E', 'F'];
  for ($i = 0; $i < strlen($string); $i++) {
    $encode .= $chars[(ord($string[$i]) & 0b11110000) >> 4] . $chars[ord($string[$i]) & 0b00001111];
  }
  return $encode;
}

function base16_decode($encode)
{
  $result = '';
  for ($i = 0; $i < strlen($encode) / 2; $i++) {
    $result .= chr(intval(substr($encode, $i * 2, 2), 16));
  }
  return $result;
}
