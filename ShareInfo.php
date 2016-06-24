<?php

/**
 * Created by PhpStorm.
 * User: zdc
 * Date: 6/24/16
 * Time: 4:51 PM
 */
class ShareInfo
{
    private $_url = 'http://apis.baidu.com/apistore/stockservice/hkstock';
    private $_header = array('apikey: 01a24c0bb4aef2f6ec728501231ac4f5');


    public function getShareInfo($shareInfo){
        $paramArray = array(
            'stockid'=>$shareInfo['stockid'],
            'list'=>$shareInfo['list']
        );

        $params = http_build_query($paramArray);
        $content = $this->curl_request($this->_url,$params);

        return json_decode($content);
    }


    public function curl_request($url,$params=false,$ispost=0){
        $httpInfo = array();
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_HTTPHEADER  , $this->_header);
        curl_setopt( $ch, CURLOPT_HTTP_VERSION , CURL_HTTP_VERSION_1_1 );
        curl_setopt( $ch, CURLOPT_USERAGENT , 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/41.0.2272.118 Safari/537.36' );
        curl_setopt( $ch, CURLOPT_CONNECTTIMEOUT , 30 );
        curl_setopt( $ch, CURLOPT_TIMEOUT , 30);
        curl_setopt( $ch, CURLOPT_RETURNTRANSFER , true );
        if( $ispost )
        {
            curl_setopt( $ch , CURLOPT_POST , true );
            curl_setopt( $ch , CURLOPT_POSTFIELDS , $params );
            curl_setopt( $ch , CURLOPT_URL , $url );
        }
        else
        {
            if($params){
                curl_setopt( $ch , CURLOPT_URL , $url.'?'.$params );

            }else{
                curl_setopt( $ch , CURLOPT_URL , $url);
            }
        }
        $response = curl_exec( $ch );
        if ($response === FALSE) {
            //echo "cURL Error: " . curl_error($ch);
            return false;
        }
        $httpCode = curl_getinfo( $ch , CURLINFO_HTTP_CODE );
        $httpInfo = array_merge( $httpInfo , curl_getinfo( $ch ) );
        curl_close( $ch );
        return $response;
    }
}


//$obj = new ShareInfo();
//$data = array(
//    'stockid' => '00168',
//    'list' => '1'
//);

//
//$res = $obj->getShareInfo($data);
//$res = json_decode(json_encode($res),true);
////var_dump($res);
//
//
//
//
//$shareName = $res['retData']['stockinfo'][0]['name'];
//$shareCode = $res['retData']['stockinfo'][0]['code'];
//$shareDate = $res['retData']['stockinfo'][0]['date'];
//$shareOpeningPrice = $res['retData']['stockinfo'][0]['openningPrice'];
//$shareClosingPrice = $res['retData']['stockinfo'][0]['closingPrice'];
//$shareHighPrice = $res['retData']['stockinfo'][0]['hPrice'];
//$shareLowPrice = $res['retData']['stockinfo'][0]['lPrice'];
//$shareGrowth = $res['retData']['stockinfo'][0]['growth'];
//$shareCurrentPrie = $res['retData']['stockinfo'][0]['currentPrice'];
//$shareGrowthPercent = $res['retData']['stockinfo'][0]['growthPercent'];
//$shareDealNum = $res['retData']['stockinfo'][0]['dealnumber'];
//$shareTurnover = $res['retData']['stockinfo'][0]['turnover'];
//
//echo '股票名称: '.$shareName."<br>";
//echo '股票代码: '.$shareCode."<br>";
//echo '股票日期: '.$shareDate."<br>";
//echo '股票开盘价格: '.$shareOpeningPrice."<br>";
//echo '股票收市价格: '.$shareClosingPrice."<br>";
//echo '股票最高价: '.$shareHighPrice."<br>";
//echo '股票最低价: '.$shareLowPrice."<br>";
//echo '股票涨跌: '.$shareGrowth."<br>";
//echo '股票当前价格: '.$shareCurrentPrie."<br>";
//echo '股票涨跌百分比: '.$shareGrowthPercent."<br>";
//echo '股票成交量: '.$shareDealNum."<br>";
//echo '股票交易量: '.$shareTurnover."<br>";






//    $ch = curl_init();
//    $url = 'http://apis.baidu.com/apistore/stockservice/hkstock?stockid=00168&list=1';
//    $header = array(
//        'apikey:01a24c0bb4aef2f6ec728501231ac4f5',
//    );
//    // 添加apikey到header
//    curl_setopt($ch, CURLOPT_HTTPHEADER  , $header);
//    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
//    // 执行HTTP请求
//    curl_setopt($ch , CURLOPT_URL , $url);
//    $res = curl_exec($ch);
//
//    var_dump(json_decode($res));
?>