<?php
/**
 * Created by PhpStorm.
 * User: dragon
 * Date: 16-6-10
 * Time: 上午1:05
 */

define("APPID","wx9fbe441cac0bd7d1");
define("APPCECRET","79a664feb2260bec0e8bf2edc395e71c");

if (isset($_GET['code'])){
    echo 'code = '.$_GET['code']."<br>";
}else{
    echo "NO CODE";
}

$code = $_GET['code'];//前端传来的code值
$appid = APPID;
$appsecret = APPCECRET;
$url = "https://api.weixin.qq.com/sns/oauth2/access_token?appid=$appid&secret=$appsecret&code=$code&grant_type=authorization_code";
$result = https_request($url);
$jsoninfo = json_decode($result, true);
$openid = $jsoninfo["openid"];//从返回json结果中读出openid

echo 'openid = '.$openid."<br>";

$access_token = $jsoninfo["access_token"];//从返回json结果中读出openid

echo 'access_token = '.$access_token."<br>";

$url1 = "https://api.weixin.qq.com/sns/userinfo?access_token=$access_token&openid=$openid&lang=zh_CN";
$result1 = https_request($url1);
$jsoninfo1 = json_decode($result1, true);

$sex=$jsoninfo1["sex"];
$nickname=$jsoninfo1["nickname"];
$province=$jsoninfo1["province"];
$city=$jsoninfo1["city"];
$headimgurl=$jsoninfo1["headimgurl"];

echo 'nicename = '.$nickname."<br>";
echo 'sex = '.$sex."<br>";
echo 'province = '.$province."<br>";
echo 'city = '.$city."<br>";
echo 'headimgurl = '.$headimgurl."<br>";


function https_request($url,$data = null){
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);
    if (!empty($data)){
        curl_setopt($curl, CURLOPT_POST, 1);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
    }
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    $output = curl_exec($curl);
    curl_close($curl);
    return $output;
}





?>