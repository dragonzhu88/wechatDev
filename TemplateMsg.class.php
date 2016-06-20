<?php

/**
 * Created by PhpStorm.
 * User: dragon
 * Date: 16-6-9
 * Time: 下午11:05
 */
class TemplateMsg
{
    private $_appid = 'wx9fbe441cac0bd7d1';
    private $_appsecret = '79a664feb2260bec0e8bf2edc395e71c';
    private $_lasttime = null;
    private $_access_token = null;
    
    public function __construct($appid=null,$appsecret=null)
    {
        if($appid && $appsecret){
            $this->_appid = $appid;
            $this->_appsecret = $appsecret;
        }

        $this->_lasttime = 1406469747;
        $this->_access_token = 'UGYg9CR-mYFy6jZxWBZYly6Ds-79A3JEvg9EtpCEk_Wgx-29A4W6wf9oPQL4cjaEJwq3MKF_di4RhOMieDm8JbOXERObtnpHg8R2fMfQ30gIHNaAHALKQ';

        if(time()>($this->_lasttime + 7200)){
            $url = 'https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid='.$this->_appid.'&secret='.$this->_appsecret;
            $res = $this->http_request($url);
            $result = json_decode($res,true);
            $this->_access_token = $result['access_token'];
            $this->_lasttime = time();

            var_dump($this->_lasttime);
            var_dump($this->_access_token);
        }



    }

    public function getAccessToken(){
        return $this->_access_token;
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

    public function sendTemplateMsg($data){
        $url = "https://api.weixin.qq.com/cgi-bin/message/template/send?access_token=" . $this->_access_token;
        $res = $this->http_request($url,$data);
        return json_decode($res,true);

    }

}