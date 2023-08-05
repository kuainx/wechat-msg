<?php
if (empty($_GET['code']) || $_GET['token'] !== 'b4') {
  echo ('error');
  exit;
}
include('./util.php');
include('./config.php');
$url = 'https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=wx61b12b15f8cbb912&secret=' . SECRET;
$res = httpRequest($url);
if (empty($res['access_token'])) {
  echo ('server err');
  exit;
}
$token = $res['access_token'];
$url = 'https://api.weixin.qq.com/cgi-bin/message/template/send?access_token=' . $token;
$data = '{
           "touser":"' . $_GET['code'] . '",
           "template_id":"LaDYp94JDdbADjruFQBlntVIK3yGKMYuU-XD3UNdV2U",
           "url":"https://api.lifestudio.cn/show.php?data=' . $_GET['data'] . '",
           "data":{
               "first": {
                   "value":"' . $_GET['first'] . '",
                   "color":"#173177"
               },
               "keyword1":{
                   "value":"' . $_GET['keyword1'] . '",
                   "color":"#173177"
               },
               "keyword2": {
                   "value":"' . $_GET['keyword2'] . '",
                   "color":"#173177"
               },
               "keyword3": {
                   "value":"' . $_GET['keyword3'] . '",
                   "color":"#173177"
               },
               "remark":{
                   "value":"' . $_GET['remark'] . '",
                   "color":"#173177"
               }
           }
        }';
$res = httpRequest($url, $data);
if ($res['errcode'] !== 0) {
  echo ('send err');
  exit;
}
echo ('ok');
