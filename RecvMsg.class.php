<?php

/**
 * Created by PhpStorm.
 * User: dragon
 * Date: 16-6-11
 * Time: 下午2:40
 */


require_once('RespondCommonMsg.class.php');

class RecvMsg
{
    private $_respondMsg;

    public function __construct()
    {
        $this->_respondMsg = new RespondCommonMsg();
    }

    public function recvMsgType($postObj){
        $msgType = trim($postObj->MsgType);

        switch ($msgType)
        {
            case "event":
                $result = $this->recvEventMsg($postObj);

                break;

            case "text":
                $result = $this->recvTextMsg($postObj);

                break;

            case "image":
                $result = $this->recvImgMsg($postObj);

                break;

            case "location":
                $result = $this->recvLocationMsg($postObj);

                break;

            case "voice":
                $result = $this->recvVoiceMsg($postObj);

                break;
            case "video":
                $result = $this->recvVedioMsg($postObj);

                break;
            case "link":
                $result = $this->recvLinkMsg($postObj);

                break;
            default:
                $result = "unknown msg type: ".$msgType;
                break;
        }

        return $result;
    }

    public function recvEventMsg($postObj){
        $content = "";
        switch ($postObj->Event)
        {
            case "subscribe":
                $content = "欢迎关注白羽扇 ";
                $content .= (!empty($postObj->EventKey))?("\n来自二维码场景 ".str_replace("qrscene_","",$postObj->EventKey)):"";
                break;

            case "unsubscribe":
                $content = "取消关注";
                break;

            case "CLICK":
                switch ($postObj->EventKey)
                {
                    case "COMPANY":
                        $content = array();
                        $content[] = array("Title"=>"白羽扇科技", "Description"=>"", "PicUrl"=>"http://discuz.comli.com/weixin/weather/icon/cartoon.jpg", "Url" =>"http://m.cnblogs.com/?u=txw1958");
                        break;

                    default:
                        $content = "点击菜单：".$postObj->EventKey;
                        break;
                }
                break;

            case "VIEW":
                $content = "跳转链接 ".$postObj->EventKey;
                break;

            case "SCAN":
                $content = "扫描场景 ".$postObj->EventKey;
                break;

            case "LOCATION":
                $content = "上传位置：纬度 ".$postObj->Latitude.";经度 ".$postObj->Longitude;
                break;

            case "scancode_waitmsg":
                if ($postObj->ScanCodeInfo->ScanType == "qrcode"){
                    $content = "扫码带提示：类型 二维码 结果：".$postObj->ScanCodeInfo->ScanResult;
                }else if ($postObj->ScanCodeInfo->ScanType == "barcode"){
                    $codeinfo = explode(",",strval($postObj->ScanCodeInfo->ScanResult));
                    $codeValue = $codeinfo[1];
                    $content = "扫码带提示：类型 条形码 结果：".$codeValue;
                }else{
                    $content = "扫码带提示：类型 ".$postObj->ScanCodeInfo->ScanType." 结果：".$postObj->ScanCodeInfo->ScanResult;
                }
                break;

            case "scancode_push":
                $content = "扫码推事件";
                break;

            case "pic_sysphoto":
                $content = "系统拍照";
                break;

            case "pic_weixin":
                $content = "相册发图：数量 ".$postObj->SendPicsInfo->Count;
                break;

            case "pic_photo_or_album":
                $content = "拍照或者相册：数量 ".$postObj->SendPicsInfo->Count;
                break;

            case "location_select":
                $content = "发送位置：标签 ".$postObj->SendLocationInfo->Label;
                break;

            default:
                $content = "receive a new event: ".$postObj->Event;
                break;

            $result = $this->_respondMsg->RespondTextMsg($postObj,$content);

            return $result;
        }
    }

    public function recvTextMsg($postObj){
        $keyword = trim($postObj->Content);
        $content = 'null';

        switch($keyword){
            case '你好':
                $content = '你好，我是白羽扇';
                $result = $this->_respondMsg->RespondTextMsg($postObj,$content);
                break;

            case '音乐':
                $content = array();
                $content = array("Title"=>"最炫民族风", "Description"=>"歌手：凤凰传奇", "MusicUrl"=>"http://121.199.4.61/music/zxmzf.mp3", "HQMusicUrl"=>"http://121.199.4.61/music/zxmzf.mp3");
                $result = $this->_respondMsg->RespondMusicMsg($postObj,$content);
                break;
        }

        return $result;
    }

    public function recvImgMsg($postObj){
        $content = array("MediaId"=>$postObj->MediaId);
        $result = $this->_respondMsg->RespondImgMsg($postObj, $content);
        return $result;
    }

    public function recvLocationMsg($postObj){
        $content = "你发送的是位置，经度为：".$postObj->Location_Y."；纬度为：".$postObj->Location_X."；缩放级别为：".$postObj->Scale."；位置为：".$postObj->Label;
        $result = $this->_respondMsg->RespondTextMsg($postObj, $content);
        return $result;
    }

    public function recvVoiceMsg($postObj){
        if (isset($postObj->Recognition) && !empty($postObj->Recognition)){
            $content = "你刚才说的是：".$postObj->Recognition;
            $result = $this->_respondMsg->RespondTextMsg($postObj, $content);
        }else{
            $content = array("MediaId"=>$postObj->MediaId);
            $result = $this->_respondMsg->RespondVoiceMsg($postObj, $content);
        }
        return $result;
    }

    public function recvVedioMsg($postObj){
        $content = array("MediaId"=>$postObj->MediaId, "ThumbMediaId"=>$postObj->ThumbMediaId, "Title"=>"", "Description"=>"");
        $result = $this->_respondMsg->RespondVideoMsg($postObj, $content);
        return $result;
    }

    public function recvLinkMsg($postObj){
        $content = "你发送的是链接，标题为：".$postObj->Title."；内容为：".$postObj->Description."；链接地址为：".$postObj->Url;
        $result = $this->_respondMsg->RespondTextMsg($postObj, $content);
        return $result;
    }
    
}