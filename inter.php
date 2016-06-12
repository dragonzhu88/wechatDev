<?php
/**
 * wechat php test
 */

require_once('RecvMsg.class.php');

//define your token
define("TOKEN", "dragon");
$wechatObj = new wechatCallbackapiTest();
if($_GET['echostr']){
    $wechatObj->valid();
}else{
    $wechatObj->responseMsg();
}



class wechatCallbackapiTest
{
    private $_msgHander;

    public function __construct()
    {
        //$this->_textSender = new RespondCommonMsg();
        // $this->_templateSender = new TemplateMsg(APPID,APPCECRET);
        //$this->_getUserList = new GetFollowerList(APPID,APPCECRET);
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
}

?>