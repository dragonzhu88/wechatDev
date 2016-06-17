<?php

/**
 * Created by PhpStorm.
 * User: dragon
 * Date: 16-6-11
 * Time: 下午2:40
 */


require_once('RespondCommonMsg.class.php');
require_once('TemplateMsg.class.php');

define("APPID","wx9fbe441cac0bd7d1");
define("APPCECRET","79a664feb2260bec0e8bf2edc395e71c");

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
                $content = "欢迎关注白羽扇 \n 输入【帮助】可以查询所有功能";
               // $content .= (!empty($postObj->EventKey))?("\n来自二维码场景 ".str_replace("qrscene_","",$postObj->EventKey)):"";
                break;

            case "unsubscribe":
                $content = "取消关注";
                break;

            case "CLICK":
                switch ($postObj->EventKey)
                {
                    case "EDU":
                        $content = "cnbeta:http://www.cnbeta.com/ \nT牛人网:http://www.itniuren.com/ \nCSDN:http://www.csdn.net/ \ntechweb:http://www.techweb.com.cn/";
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


        }
        $result = $this->_respondMsg->RespondTextMsg($postObj,$content);

        return $result;
    }

    public function recvTextMsg($postObj){
        $keyword = trim($postObj->Content);
        $content = null;

        switch($keyword){
            case '你好':
                $content = '你好，我是白羽扇';
                $result = $this->_respondMsg->RespondTextMsg($postObj,$content);
                break;

            case '帮助':
                $content = "输入以下文字进入相应的功能：\n【音乐】收听火影忍者音乐\n【表情】收到一个表情\n【单图文】收到一个单图文信息\n【多图文】收到一个多图文信息\n【2048】玩2048游戏\n【第三方】进入第三方登操作\n【查成绩】进入英语4,6级查询\n【JSSDK】微信JSSDK接口
                ";

                $result = $this->_respondMsg->RespondTextMsg($postObj,$content);
                break;

            case '音乐':
                $content = array();
                $content = array(
                    "Title"=>"火影忍者",
                    "Description"=>"歌手：火影忍者",
                    "MusicUrl"=>"http://sc.111ttt.com/up/mp3/308288/94E95FCC7873F08363267D44B2B7B4DE.mp3",
                    "HQMusicUrl"=>"http://sc.111ttt.com/up/mp3/308288/94E95FCC7873F08363267D44B2B7B4DE.mp3");
                $result = $this->_respondMsg->RespondMusicMsg($postObj,$content);
                break;

            case '表情':
                $content = "中国：".$this->bytes_to_emoji(0x1F1E8).$this->bytes_to_emoji(0x1F1F3)."\n仙人掌：".$this->bytes_to_emoji(0x1F335);
                $result = $this->_respondMsg->RespondTextMsg($postObj,$content);
                break;

            case '单图文':
                $content = array();
                $content[] = array(
                    "Title"=>"单图文标题",
                    "Description"=>"单图文内容",
                    "PicUrl"=>"http://discuz.comli.com/weixin/weather/icon/cartoon.jpg",
                    "Url" =>"http://m.cnblogs.com/?u=txw1958");
                $result = $this->_respondMsg->RespondNewsMsg($postObj,$content);
                break;

            case '多图文':
                $content = array();
                $content[] = array("Title"=>"多图文1标题", "Description"=>"", "PicUrl"=>"http://discuz.comli.com/weixin/weather/icon/cartoon.jpg", "Url" =>"http://m.cnblogs.com/?u=txw1958");
                $content[] = array("Title"=>"多图文2标题", "Description"=>"", "PicUrl"=>"http://d.hiphotos.bdimg.com/wisegame/pic/item/f3529822720e0cf3ac9f1ada0846f21fbe09aaa3.jpg", "Url" =>"http://m.cnblogs.com/?u=txw1958");
                $content[] = array("Title"=>"多图文3标题", "Description"=>"", "PicUrl"=>"http://g.hiphotos.bdimg.com/wisegame/pic/item/18cb0a46f21fbe090d338acc6a600c338644adfd.jpg", "Url" =>"http://m.cnblogs.com/?u=txw1958");
                $result = $this->_respondMsg->RespondNewsMsg($postObj,$content);
                break;

            case '2048':
                $content = array();
                $content[] = array(
                    "Title"=>"2048游戏",
                    "Description"=>"游戏规则很简单，每次可以选择上下左右其中一个方向去滑动，每滑动一次，所有的数字方块都会往滑动的方向靠拢外，系统也会在空白的地方乱数出现一个数字方块，相同数字的方块在靠拢、相撞时会相加。系统给予的数字方块不是2就是4，玩家要想办法在这小小的16格范围中凑出“2048”这个数字方块。",
                    "PicUrl"=>"http://img.laohu.com/www/201403/27/1395908994962.png",
                    "Url" =>"http://gabrielecirulli.github.io/2048/");
                $result = $this->_respondMsg->RespondNewsMsg($postObj,$content);
                break;

            case '查成绩':
                $content = array();
                $content[] = array("Title" =>"2016年6月全国大学英语四六级考试成绩查询",
                    "Description" =>"", "PicUrl" =>"http://365jia.cn/uploads/13/0301/5130c2ff93618.jpg",
                    "Url" =>"http://cet.99sushe.com/");
                $result = $this->_respondMsg->RespondNewsMsg($postObj, $content);

                break;

            case '第三方':
                $url = 'http://whiteyushan.sinaapp.com/oauth2.php';
                $content="<a href=\"https://open.weixin.qq.com/connect/oauth2/authorize?appid=".APPID.'&redirect_uri='.$url."&response_type=code&scope=snsapi_userinfo&state=1#wechat_redirect\" > 点击认证 </a>";
                $result = $this->_respondMsg->RespondTextMsg($postObj,$content);
                break;

            case 'JSSDK':

                $content="<a href='http://whiteyushan.sinaapp.com/jdkdev.php'> 点击浏览JSSDK接口</a>";
                $result = $this->_respondMsg->RespondTextMsg($postObj,$content);
                break;

            case '模板消息':
                    $tempObj = new TemplateMsg();
                    $template = array('touser' => 'oJx_3t76LNyOLfTAzgyal2th-fEo',
                        "template_id" =>"0ZxaJRvThvxwfWXIiGd2-oQurUtsKBhnh71YB2PRHNE",
                        "url"=>"http://weixin.qq.com/download",
                        'topcolor' => '#7B68EE',
                        "data"=> array(
                            "User" => array(
                                "value"=>"朱先生",
                                "color"=>"#173177"
                            ),
                            "Date"=> array(
                                "value"=>"12月28日 19时24分",
                                "color"=>"#173177"
                            ),
                            "CardNumber"=>  array(
                                "value"=>"5523",
                                "color"=>"#173177"
                            ),
                            "Type"=> array(
                                "value"=>"消费",
                                "color"=>"#173177"
                            ),
                            "Money"=> array(
                                "value"=>"人民币122260.00元",
                                "color"=>"#173177"
                            ),
                            "DeadTime"=> array(
                                "value"=>"12月28日19时24分",
                                "color"=>"#173177"
                            ),
                            "Left"=> array(
                                "value"=>"366504.09",
                                "color"=>"#173177"
                            )
                        )
                    );

               // $content = $tempObj->getAccessToken();
                //$result = $this->_respondMsg->RespondTextMsg($postObj,$content);

                //var_dump($tempObj->sendTemplateMsg(urldecode(json_encode($template))));
               $tempObj->sendTemplateMsg(urldecode(json_encode($template)));
               $result = null;
            break;

            default:
                $content = '没有匹配关键字';
                $result = $this->_respondMsg->RespondTextMsg($postObj,$content);
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
        $content = array("MediaId"=>$postObj->MediaId, "ThumbMediaId"=>$postObj->ThumbMediaId);
        $result = $this->_respondMsg->RespondVideoMsg($postObj, $content);
        return $result;
    }

    public function recvLinkMsg($postObj){
        $content = "你发送的是链接，标题为：".$postObj->Title."；内容为：".$postObj->Description."；链接地址为：".$postObj->Url;
        $result = $this->_respondMsg->RespondTextMsg($postObj, $content);
        return $result;
    }

    public function bytes_to_emoji($cp)
    {
        if ($cp > 0x10000){       # 4 bytes
            return chr(0xF0 | (($cp & 0x1C0000) >> 18)).chr(0x80 | (($cp & 0x3F000) >> 12)).chr(0x80 | (($cp & 0xFC0) >> 6)).chr(0x80 | ($cp & 0x3F));
        }else if ($cp > 0x800){   # 3 bytes
            return chr(0xE0 | (($cp & 0xF000) >> 12)).chr(0x80 | (($cp & 0xFC0) >> 6)).chr(0x80 | ($cp & 0x3F));
        }else if ($cp > 0x80){    # 2 bytes
            return chr(0xC0 | (($cp & 0x7C0) >> 6)).chr(0x80 | ($cp & 0x3F));
        }else{                    # 1 byte
            return chr($cp);
        }
    }

    
}