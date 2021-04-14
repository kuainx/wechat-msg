<?php
if (empty($_GET['code'])) {
  header("Location:https://mp.weixin.qq.com/mp/profile_ext?action=home&__biz=MzUxNjM2NzM3Ng==#wechat_redirect");
  exit;
}
include('./util.php');
include('./config.php');
$ret = httpRequest('https://api.weixin.qq.com/sns/oauth2/access_token?appid=wx61b12b15f8cbb912&secret=' . SECRET . '&code=' . $_GET['code'] . '&grant_type=authorization_code');
echo ('openid:<br/>' . base16_encode($ret['openid']));
