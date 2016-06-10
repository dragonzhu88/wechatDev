<?php

/**
 * Created by PhpStorm.
 * User: dragon
 * Date: 16-6-10
 * Time: 下午10:10
 */
class GetFollowerList
{
    private $_appid = null;
    private $_appsecret = null;
    private $_lasttime = null;
    private $_access_token = null;

    public function __construct($appid,$appsecret)
    {
        if($appid && $appsecret){
            $this->_appid = $appid;
            $this->_appid = $appsecret;
        }

        $this->_lasttime = 1406469747;
        $this->_access_token = '2gs7HVqO79x8F0yGL8eC5FlWwqLvGDhCxowoFLlwjn4e0n7Ieh6OFbR-zRTqSS8uANI7Za2YmpxHZMEAm-21Ab_sTiOr3qim2vInH4nBcQ8pfU0TSWe8jRC8B5eS6x2yLYKfADAANZ';

        if(time()>($this->_lasttime)){
            $url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid='.$this->_appid.'&secret'=$this->_appsecret";
            $res = $this->http_request($url);
            $result = json_decode($res,true);
            $this->_access_token = $result['access_token'];
            $this->_lasttime = time();

            var_dump($this->_lasttime);
            var_dump($this->_access_token);
        }

    }


    public function getFollowerList(){
        $url = "https://api.weixin.qq.com/cgi-bin/user/get?access_token=".$this->_access_token;
        $result = https_request($url);
        $jsoninfo = json_decode($result, true);
       // var_dump($jsoninfo);
        return $jsoninfo;
    }

    public function http_request($url,$data = null){
        $curl = curl_init();
        curl_setopt($curl,CURLOPT_URL,$url);
        curl_setopt($curl,CURLOPT_SSL_VERIFYPEER,FALSE);
        curl_setopt($curl,CURLOPT_SSL_VERIFYHOST,FALSE);

        if(!empty($data)){
            curl_setopt($curl,CURLOPT_POST,1);
            curl_setopt($curl,CURLOPT_POSTFIELDS,$data);
        }

        curl_setopt($curl,CURLOPT_RETURNTRANSFER,1);
        $output = curl_exec($curl);
        curl_close($curl);
        return $output;

    }


}