<?php

/**
 * Created by PhpStorm.
 * User: dragon
 * Date: 16-6-8
 * Time: 上午12:18
 */
class RespondCommonMsg{

    public function RespondTextMsg($postObj,$contentStr){
        $textTpl = "<xml>
                                <ToUserName><![CDATA[%s]]></ToUserName>
                                <FromUserName><![CDATA[%s]]></FromUserName>
                                <CreateTime>%s</CreateTime>
                                <MsgType><![CDATA[%s]]></MsgType>
                                <Content><![CDATA[%s]]></Content>
                                <FuncFlag>0</FuncFlag>
                                </xml>";

        $fromUsername = $postObj->FromUserName;
        $toUsername = $postObj->ToUserName;
        $createTime = time();
        $msgType = "text";

        $resultStr = sprintf($textTpl, $fromUsername, $toUsername, $createTime, $msgType, $contentStr);
        return $resultStr;
    }

    public function RespondImgMsg($postObj,$mediaIdStr){
        $textTpl = "<xml>
                                <ToUserName><![CDATA[%s]]></ToUserName>
                                <FromUserName><![CDATA[%s]]></FromUserName>
                                <CreateTime>%s</CreateTime>
                                <MsgType><![CDATA[%s]]></MsgType>
                                <Image>
                                <MediaId><![CDATA[%s]]></MediaId>
                                </Image>
                                </xml>";

        $fromUsername = $postObj->FromUserName;
        $toUsername = $postObj->ToUserName;
        $createTime = time();
        $msgType = "image";

        $resultStr = sprintf($textTpl, $fromUsername, $toUsername, $createTime, $msgType, $mediaIdStr);
        return $resultStr;
    }

    public function RespondVoiceMsg($postObj,$mediaIdStr){
        $textTpl = "<xml>
                                <ToUserName><![CDATA[%s]]></ToUserName>
                                <FromUserName><![CDATA[%s]]></FromUserName>
                                <CreateTime>%s</CreateTime>
                                <MsgType><![CDATA[%s]]></MsgType>
                                <Voice>
                                <MediaId><![CDATA[%s]]></MediaId>
                                </Voice>
                                </xml>";

        $fromUsername = $postObj->FromUserName;
        $toUsername = $postObj->ToUserName;
        $createTime = time();
        $msgType = "voice";

        $resultStr = sprintf($textTpl, $fromUsername, $toUsername, $createTime, $msgType, $mediaIdStr);
        return $resultStr;
    }

    public function RespondVideoMsg($postObj,$mediaIdStr,$title,$description){
        $textTpl = "<xml>
                                <ToUserName><![CDATA[%s]]></ToUserName>
                                <FromUserName><![CDATA[%s]]></FromUserName>
                                <CreateTime>%s</CreateTime>
                                <MsgType><![CDATA[%s]]></MsgType>
                                <Video>
                                <MediaId><![CDATA[%s]]></MediaId>
                                </Video>
                                </xml>";

        $fromUsername = $postObj->FromUserName;
        $toUsername = $postObj->ToUserName;
        $createTime = time();
        $msgType = "video";

        $resultStr = sprintf($textTpl, $fromUsername, $toUsername, $createTime, $msgType, $mediaIdStr, $title, $description);
        return $resultStr;
    }

    public function RespondMusicMsg($postObj,$mediaIdStr,$title,$description,$musicUrl,$hqMusicUrl,$thumbMediaId){
        $textTpl = "<xml>
                                <ToUserName><![CDATA[%s]]></ToUserName>
                                <FromUserName><![CDATA[%s]]></FromUserName>
                                <CreateTime>%s</CreateTime>
                                <MsgType><![CDATA[%s]]></MsgType>
                                <Music>
                                <Title><![CDATA[%s]]></Title>
                                <Description><![CDATA[%s]]></Description>
                                <MusicUrl><![CDATA[%s]]></MusicUrl>
                                <HQMusicUrl><![CDATA[%s]]></HQMusicUrl>
                                <ThumbMediaId><![CDATA[%s]]></ThumbMediaId>
                                </Music>
                                </xml>";

        $fromUsername = $postObj->FromUserName;
        $toUsername = $postObj->ToUserName;
        $createTime = time();
        $msgType = "music";

        $resultStr = sprintf($textTpl, $fromUsername, $toUsername, $createTime, $msgType,
            $mediaIdStr, $title, $description, $musicUrl, $hqMusicUrl, $thumbMediaId);
        return $resultStr;
    }

    public function RespondNewsMsg($postObj,$newsArray){
        if(!is_array($newsArray)){
            return "";
        }
        $itemTpl = "        <item>
             <Title><![CDATA[%s]]></Title>
             <Description><![CDATA[%s]]></Description>
             <PicUrl><![CDATA[%s]]></PicUrl>
             <Url><![CDATA[%s]]></Url>
        	 </item> ";
        $item_str = "";
        foreach ($newsArray as $item){
            $item_str .= sprintf($itemTpl, $item['Title'], $item['Description'], $item['PicUrl'], $item['Url']);
        }
        $xmlTpl = "<xml>
		     <ToUserName><![CDATA[%s]]></ToUserName>
		     <FromUserName><![CDATA[%s]]></FromUserName>
		     <CreateTime>%s</CreateTime>
		     <MsgType><![CDATA[%s]]></MsgType>
		     <ArticleCount>%s</ArticleCount>
		     <Articles>
			 $item_str    
			 </Articles>
			 </xml>";

        $fromUsername = $postObj->FromUserName;
        $toUsername = $postObj->ToUserName;
        $createTime = time();
        $msgType = "news";

        $result = sprintf($xmlTpl, $fromUsername, $toUsername, $createTime,$msgType, count($newsArray));
        return $result;
    }



}