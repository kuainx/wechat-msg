<?php
if (empty($_GET['code'])) {
  echo ('error');
  exit;
}
include('./util.php');
$url = 'https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=wx61b12b15f8cbb912&secret=';
$res = httpRequest($url);
$token = $res['access_token'];
$url = 'https://api.weixin.qq.com/cgi-bin/message/template/send?access_token=' . $token;
$data = '{
           "touser":"' . base64_decode($_GET['code']) . '",
           "template_id":"ueEXSCAkX8X75nDQ8DIaIIKhu_EVBis7akqUYVEZmEQ",
           "data":{
               "first": {
                   "value":"素材上传完成！",
                   "color":"#173177"
               },
               "keyword1":{
                   "value":"小视频制作",
                   "color":"#173177"
               },
               "keyword2": {
                   "value":"' . $_GET['order'] . '",
                   "color":"#173177"
               },
               "keyword3": {
                   "value":"' . $_GET['user'] . '",
                   "color":"#173177"
               },
               "keyword4": {
                   "value":"' . $_GET['msg'] . '",
                   "color":"#173177"
               },
               "remark":{
                   "value":"制作完成后我们将通过该公众号向您发送成品链接！",
                   "color":"#173177"
               }
           }
        }';
$res = httpRequest($url, $data);
echo ('ok');
