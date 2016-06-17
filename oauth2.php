


<?php
/**
 * Created by PhpStorm.
 * User: dragon
 * Date: 16-6-10
 * Time: 上午1:05
 */

define("APPID","wx9fbe441cac0bd7d1");
define("APPCECRET","79a664feb2260bec0e8bf2edc395e71c");


$code = $_GET['code'];//前端传来的code值
$appid = APPID;
$appsecret = APPCECRET;
$url = "https://api.weixin.qq.com/sns/oauth2/access_token?appid=$appid&secret=$appsecret&code=$code&grant_type=authorization_code";
$result = https_request($url);
$jsoninfo = json_decode($result, true);

$openid = $jsoninfo["openid"];//从返回json结果中读出openid
$access_token = $jsoninfo["access_token"];//从返回json结果中读出openid

$url1 = "https://api.weixin.qq.com/sns/userinfo?access_token=$access_token&openid=$openid&lang=zh_CN";
$result1 = https_request($url1);
$jsoninfo1 = json_decode($result1, true);

$sex=$jsoninfo1["sex"];
$nickname=$jsoninfo1["nickname"];
$province=$jsoninfo1["province"];
$city=$jsoninfo1["city"];
$headimgurl=$jsoninfo1["headimgurl"];

$headimg = "<img src=\"".$headimgurl."\"/>";


echo "<head>";
echo "<meta charset=\"UTF-8\">";
echo "<title>";
echo "你已通过验证";
echo "</title>";


echo "<link rel=\"stylesheet\" href=\"http://code.jquery.com/mobile/1.3.2/jquery.mobile-1.3.2.min.css\">";
echo "<script src=\"http://code.jquery.com/jquery-1.8.3.min.js\"></script>";
echo "<script src=\"http://code.jquery.com/mobile/1.3.2/jquery.mobile-1.3.2.min.js\"></script>";

echo "</head>";

echo "<body>";

echo "<div data-role=\"page\" id=\"pageone\">";

echo "<ul data-role=\"listview\">";
echo "<li>";
echo 'nicename = '.$nickname;
echo "</li>";
echo "<li>";
echo 'sex = '.$sex;
echo "</li>";
echo "<li>";
echo 'province = '.$province;
echo "</li>";
echo "<li>";
echo 'city = '.$city;
echo "</li>";
echo "<li>";
echo 'nicename = '.$nickname;
echo "</li>";
echo "<li>";
echo "headimg = ".$headimg;
echo "</li>";
echo "<li>";
echo 'access_token = '.$access_token;
echo "</li>";
echo "<li>";
echo 'openid = '.$openid;
echo "</li>";
echo "<li>";
echo 'code = '.$code;
echo "</li>";

echo "</ul>";

echo "</div>";
echo "</body>";
echo "</html>";

//echo 'nicename = '.$nickname."<br>";
//echo 'sex = '.$sex."<br>";
//echo 'province = '.$province."<br>";
//echo 'city = '.$city."<br>";
//echo 'headimgurl = '.$headimgurl."<br>";
//echo 'access_token = '.$access_token."<br>";
//echo 'openid = '.$openid."<br>";
//echo 'code = '.$code;

//$nickname = 'test';
//$openid = 'test';
//$access_token = 'test';
//$sex = 'test';
//$city = 'test';
//$province = 'test';
//$headimgurl = 'test';

//$backAjaxVal = array();
//$backAjaxVal['code'] = $code;
//$backAjaxVal['name'] = $nickname;
//$backAjaxVal['openid'] = $openid;
//$backAjaxVal['accesstoken'] = $access_token;
//$backAjaxVal['sex'] = $sex;
//$backAjaxVal['city'] = $city;
//$backAjaxVal['province'] = $province;
//$backAjaxVal['headimgurl'] = $headimgurl;
//
//echo json_encode($backAjaxVal);



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