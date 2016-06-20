<?php
/**
 * wechat php test
 */

require_once('RespondCommonMsg.class.php');
require_once('TemplateMsg.class.php');
require_once('GetFollowerList.class.php');
require_once('RecvMsg.class.php');

//define your token
define('TOKEN', 'dragon');
define('APPID','wx9fbe441cac0bd7d1');
define('APPCECRET','79a664feb2260bec0e8bf2edc395e71c');
$wechatObj = new wechatCallbackapiTest();


if($_GET['echostr']){
    $wechatObj->valid();
}else{
    $wechatObj->responseMsg();
}

class wechatCallbackapiTest
{
    private $_textSender;
    private $_templateSender;
    private $_getUserList;
    private $_msgHander;

    public function __construct()
    {
        $this->_textSender = new RespondCommonMsg();
       // $this->_templateSender = new TemplateMsg(APPID,APPCECRET);
        $this->_getUserList = new GetFollowerList(APPID,APPCECRET);
        $this->_msgHander = new RecvMsg();

    }


    public function valid()
    {
        $echoStr = $_GET["echostr"];

        //valid signature , option
        if($this->checkSignature()){
            echo $echoStr;
            exit;
        }
    }

    private function checkSignature()
    {
        // you must define TOKEN by yourself
        if (!defined("TOKEN")) {
            throw new Exception('TOKEN is not defined!');
        }

        $signature = $_GET["signature"];
        $timestamp = $_GET["timestamp"];
        $nonce = $_GET["nonce"];

        $token = TOKEN;
        $tmpArr = array($token, $timestamp, $nonce);
        // use SORT_STRING rule
        sort($tmpArr, SORT_STRING);
        $tmpStr = implode( $tmpArr );
        $tmpStr = sha1( $tmpStr );

        if( $tmpStr == $signature ){
            return true;
        }else{
            return false;
        }
    }

    public function responseMsg()
    {
        //get post data, May be due to the different environments
        $postStr = $GLOBALS["HTTP_RAW_POST_DATA"];

        //extract post data
        if (!empty($postStr)){
            /* libxml_disable_entity_loader is to prevent XML eXternal Entity Injection,
               the best way is to check the validity of xml by yourself */
            libxml_disable_entity_loader(true);
            $postObj = simplexml_load_string($postStr, 'SimpleXMLElement', LIBXML_NOCDATA);

            $result = $this->_msgHander->recvMsgType($postObj);
            echo $result;

        }else {
            echo "";
            exit;
        }
    }
}

?>