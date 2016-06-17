<?php
require_once "jssdk.php";
$jssdk = new JSSDK("wx9fbe441cac0bd7d1", "79a664feb2260bec0e8bf2edc395e71c");
$signPackage = $jssdk->GetSignPackage();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="http://code.jquery.com/mobile/1.3.2/jquery.mobile-1.3.2.min.css">
  <script src="http://code.jquery.com/jquery-1.8.3.min.js"></script>
  <script src="http://code.jquery.com/mobile/1.3.2/jquery.mobile-1.3.2.min.js"></script>
  <title>JDK DEV</title>
</head>
<body>
<div class="lbox_close wxapi_form">
  <h3 id="menu-basic">基础接口</h3>
  <span class="desc">判断当前客户端是否支持指定JS接口</span>
  <button class="btn btn_primary" id="checkJsApi">checkJsApi</button>

  <h3 id="menu-share">分享接口</h3>
  <span class="desc">获取“分享到朋友圈”按钮点击状态及自定义分享内容接口</span>
  <button class="btn btn_primary" id="onMenuShareTimeline">onMenuShareTimeline</button>
  <span class="desc">获取“分享给朋友”按钮点击状态及自定义分享内容接口</span>
  <button class="btn btn_primary" id="onMenuShareAppMessage">onMenuShareAppMessage</button>
  <span class="desc">获取“分享到QQ”按钮点击状态及自定义分享内容接口</span>
  <button class="btn btn_primary" id="onMenuShareQQ">onMenuShareQQ</button>
  <span class="desc">获取“分享到腾讯微博”按钮点击状态及自定义分享内容接口</span>
  <button class="btn btn_primary" id="onMenuShareWeibo">onMenuShareWeibo</button>

  <h3 id="menu-image">图像接口</h3>
  <span class="desc">拍照或从手机相册中选图接口</span>
  <button class="btn btn_primary" id="chooseImage">chooseImage</button>
  <span class="desc">预览图片接口</span>
  <button class="btn btn_primary" id="previewImage">previewImage</button>
  <span class="desc">上传图片接口</span>
  <button class="btn btn_primary" id="uploadImage">uploadImage</button>
  <span class="desc">下载图片接口</span>
  <button class="btn btn_primary" id="downloadImage">downloadImage</button>

  <h3 id="menu-voice">音频接口</h3>
  <span class="desc">开始录音接口</span>
  <button class="btn btn_primary" id="startRecord">startRecord</button>
  <span class="desc">停止录音接口</span>
  <button class="btn btn_primary" id="stopRecord">stopRecord</button>
  <span class="desc">播放语音接口</span>
  <button class="btn btn_primary" id="playVoice">playVoice</button>
  <span class="desc">暂停播放接口</span>
  <button class="btn btn_primary" id="pauseVoice">pauseVoice</button>
  <span class="desc">停止播放接口</span>
  <button class="btn btn_primary" id="stopVoice">stopVoice</button>
  <span class="desc">上传语音接口</span>
  <button class="btn btn_primary" id="uploadVoice">uploadVoice</button>
  <span class="desc">下载语音接口</span>
  <button class="btn btn_primary" id="downloadVoice">downloadVoice</button>

  <h3 id="menu-smart">智能接口</h3>
  <span class="desc">识别音频并返回识别结果接口</span>
  <button class="btn btn_primary" id="translateVoice">translateVoice</button>

  <h3 id="menu-device">设备信息接口</h3>
  <span class="desc">获取网络状态接口</span>
  <button class="btn btn_primary" id="getNetworkType">getNetworkType</button>

  <h3 id="menu-location">地理位置接口</h3>
  <span class="desc">使用微信内置地图查看位置接口</span>
  <button class="btn btn_primary" id="openLocation">openLocation</button>
  <span class="desc">获取地理位置接口</span>
  <button class="btn btn_primary" id="getLocation">getLocation</button>

  <h3 id="menu-webview">界面操作接口</h3>
  <span class="desc">隐藏右上角菜单接口</span>
  <button class="btn btn_primary" id="hideOptionMenu">hideOptionMenu</button>
  <span class="desc">显示右上角菜单接口</span>
  <button class="btn btn_primary" id="showOptionMenu">showOptionMenu</button>
  <span class="desc">关闭当前网页窗口接口</span>
  <button class="btn btn_primary" id="closeWindow">closeWindow</button>
  <span class="desc">批量隐藏功能按钮接口</span>
  <button class="btn btn_primary" id="hideMenuItems">hideMenuItems</button>
  <span class="desc">批量显示功能按钮接口</span>
  <button class="btn btn_primary" id="showMenuItems">showMenuItems</button>
  <span class="desc">隐藏所有非基础按钮接口</span>
  <button class="btn btn_primary" id="hideAllNonBaseMenuItem">hideAllNonBaseMenuItem</button>
  <span class="desc">显示所有功能按钮接口</span>
  <button class="btn btn_primary" id="showAllNonBaseMenuItem">showAllNonBaseMenuItem</button>

  <h3 id="menu-scan">微信扫一扫</h3>
  <span class="desc">调起微信扫一扫接口</span>
  <button class="btn btn_primary" id="scanQRCode0">scanQRCode(微信处理结果)</button>
  <button class="btn btn_primary" id="scanQRCode1">scanQRCode(直接返回结果)</button>

  <h3 id="menu-shopping">微信小店接口</h3>
  <span class="desc">跳转微信商品页接口</span>
  <button class="btn btn_primary" id="openProductSpecificView">openProductSpecificView</button>

  <h3 id="menu-card">微信卡券接口</h3>
  <span class="desc">批量添加卡券接口</span>
  <button class="btn btn_primary" id="addCard">addCard</button>
  <span class="desc">调起适用于门店的卡券列表并获取用户选择列表</span>
  <button class="btn btn_primary" id="chooseCard">chooseCard</button>
  <span class="desc">查看微信卡包中的卡券接口</span>
  <button class="btn btn_primary" id="openCard">openCard</button>

  <h3 id="menu-pay">微信支付接口</h3>
  <span class="desc">发起一个微信支付请求</span>
  <button class="btn btn_primary" id="chooseWXPay">chooseWXPay</button>
</div>
</body>
<script src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
<script>
  /*
   * 注意：
   * 1. 所有的JS接口只能在公众号绑定的域名下调用，公众号开发者需要先登录微信公众平台进入“公众号设置”的“功能设置”里填写“JS接口安全域名”。
   * 2. 如果发现在 Android 不能分享自定义内容，请到官网下载最新的包覆盖安装，Android 自定义分享接口需升级至 6.0.2.58 版本及以上。
   * 3. 常见问题及完整 JS-SDK 文档地址：http://mp.weixin.qq.com/wiki/7/aaa137b55fb2e0456bf8dd9148dd613f.html
   *
   * 开发中遇到问题详见文档“附录5-常见错误及解决办法”解决，如仍未能解决可通过以下渠道反馈：
   * 邮箱地址：weixin-open@qq.com
   * 邮件主题：【微信JS-SDK反馈】具体问题
   * 邮件内容说明：用简明的语言描述问题所在，并交代清楚遇到该问题的场景，可附上截屏图片，微信团队会尽快处理你的反馈。
   */
  wx.config({
    debug: false,
    appId: '<?php echo $signPackage["appId"];?>',
    timestamp: <?php echo $signPackage["timestamp"];?>,
    nonceStr: '<?php echo $signPackage["nonceStr"];?>',
    signature: '<?php echo $signPackage["signature"];?>',
    jsApiList: [
      // 所有要调用的 API 都要加到这个列表中
        'onMenuShareTimeline',
        'onMenuShareAppMessage'
    ]
  });
  wx.ready(function () {
    // 在这里调用 API
    // 1 判断当前版本是否支持指定 JS 接口，支持批量判断
    document.querySelector('#checkJsApi').onclick = function () {
      wx.checkJsApi({
        jsApiList: [
          'getNetworkType',
          'previewImage'
        ],
        success: function (res) {
          alert(JSON.stringify(res));
        }
      });
    };

// 2. 分享接口
    // 2.1 监听“分享给朋友”，按钮点击、自定义分享内容及分享结果接口
    document.querySelector('#onMenuShareAppMessage').onclick = function () {
      wx.onMenuShareAppMessage({
        title: '白羽扇个人简介',
        desc: '在长大的过程中，我才慢慢发现，我身边的所有事，别人跟我说的所有事，那些所谓本来如此，注定如此的事，它们其实没有非得如此，事情是可以改变的。更重要的是，有些事既然错了，那就该做出改变。',
        link: 'http://m.whiteyushan.com/index.jsp',
        imgUrl: 'http://tx.haiqq.com/qqtouxiang/uploads/2014-08-11/114538966.jpg',
        trigger: function (res) {
          alert('用户点击发送给朋友');
        },
        success: function (res) {
          alert('已分享');
        },
        cancel: function (res) {
          alert('已取消');
        },
        fail: function (res) {
          alert(JSON.stringify(res));
        }
      });
      alert('已注册获取“发送给朋友”状态事件');
    };

    // 2.2 监听“分享到朋友圈”按钮点击、自定义分享内容及分享结果接口
    document.querySelector('#onMenuShareTimeline').onclick = function () {
      wx.onMenuShareTimeline({
        title: '白羽扇个人简介',
        link: 'http://m.whiteyushan.com/index.jsp',
        imgUrl: 'http://tx.haiqq.com/qqtouxiang/uploads/2014-08-11/114538966.jpg',
        trigger: function (res) {
          alert('用户点击分享到朋友圈');
        },
        success: function (res) {
          alert('已分享');
        },
        cancel: function (res) {
          alert('已取消');
        },
        fail: function (res) {
          alert(JSON.stringify(res));
        }
      });
      alert('已注册获取“分享到朋友圈”状态事件');
    };

    // 2.3 监听“分享到QQ”按钮点击、自定义分享内容及分享结果接口
    document.querySelector('#onMenuShareQQ').onclick = function () {
      wx.onMenuShareQQ({
        title: '白羽扇个人简介',
        desc: '在长大的过程中，我才慢慢发现，我身边的所有事，别人跟我说的所有事，那些所谓本来如此，注定如此的事，它们其实没有非得如此，事情是可以改变的。更重要的是，有些事既然错了，那就该做出改变。',
        link: 'http://m.whiteyushan.com/index.jsp',
        imgUrl: 'http://tx.haiqq.com/qqtouxiang/uploads/2014-08-11/114538966.jpg',
        trigger: function (res) {
          alert('用户点击分享到QQ');
        },
        complete: function (res) {
          alert(JSON.stringify(res));
        },
        success: function (res) {
          alert('已分享');
        },
        cancel: function (res) {
          alert('已取消');
        },
        fail: function (res) {
          alert(JSON.stringify(res));
        }
      });
      alert('已注册获取“分享到 QQ”状态事件');
    };

    // 2.4 监听“分享到微博”按钮点击、自定义分享内容及分享结果接口
    document.querySelector('#onMenuShareWeibo').onclick = function () {
      wx.onMenuShareWeibo({
        title: '白羽扇个人简介',
        desc: '在长大的过程中，我才慢慢发现，我身边的所有事，别人跟我说的所有事，那些所谓本来如此，注定如此的事，它们其实没有非得如此，事情是可以改变的。更重要的是，有些事既然错了，那就该做出改变。',
        link: 'http://m.whiteyushan.com/index.jsp',
        imgUrl: 'http://tx.haiqq.com/qqtouxiang/uploads/2014-08-11/114538966.jpg',
        trigger: function (res) {
          alert('用户点击分享到微博');
        },
        complete: function (res) {
          alert(JSON.stringify(res));
        },
        success: function (res) {
          alert('已分享');
        },
        cancel: function (res) {
          alert('已取消');
        },
        fail: function (res) {
          alert(JSON.stringify(res));
        }
      });
      alert('已注册获取“分享到微博”状态事件');
    };


    // 3 智能接口
    var voice = {
      localId: '',
      serverId: ''
    };
    // 3.1 识别音频并返回识别结果
    document.querySelector('#translateVoice').onclick = function () {
      if (voice.localId == '') {
        alert('请先使用 startRecord 接口录制一段声音');
        return;
      }
      wx.translateVoice({
        localId: voice.localId,
        complete: function (res) {
          if (res.hasOwnProperty('translateResult')) {
            alert('识别结果：' + res.translateResult);
          } else {
            alert('无法识别');
          }
        }
      });
    };

    // 4 音频接口
    // 4.2 开始录音
    document.querySelector('#startRecord').onclick = function () {
      wx.startRecord({
        cancel: function () {
          alert('用户拒绝授权录音');
        }
      });
    };

    // 4.3 停止录音
    document.querySelector('#stopRecord').onclick = function () {
      wx.stopRecord({
        success: function (res) {
          voice.localId = res.localId;
        },
        fail: function (res) {
          alert(JSON.stringify(res));
        }
      });
    };

    // 4.4 监听录音自动停止
    wx.onVoiceRecordEnd({
      complete: function (res) {
        voice.localId = res.localId;
        alert('录音时间已超过一分钟');
      }
    });

    // 4.5 播放音频
    document.querySelector('#playVoice').onclick = function () {
      if (voice.localId == '') {
        alert('请先使用 startRecord 接口录制一段声音');
        return;
      }
      wx.playVoice({
        localId: voice.localId
      });
    };

    // 4.6 暂停播放音频
    document.querySelector('#pauseVoice').onclick = function () {
      wx.pauseVoice({
        localId: voice.localId
      });
    };

    // 4.7 停止播放音频
    document.querySelector('#stopVoice').onclick = function () {
      wx.stopVoice({
        localId: voice.localId
      });
    };

    // 4.8 监听录音播放停止
    wx.onVoicePlayEnd({
      complete: function (res) {
        alert('录音（' + res.localId + '）播放结束');
      }
    });

    // 4.8 上传语音
    document.querySelector('#uploadVoice').onclick = function () {
      if (voice.localId == '') {
        alert('请先使用 startRecord 接口录制一段声音');
        return;
      }
      wx.uploadVoice({
        localId: voice.localId,
        success: function (res) {
          alert('上传语音成功，serverId 为' + res.serverId);
          voice.serverId = res.serverId;
        }
      });
    };

    // 4.9 下载语音
    document.querySelector('#downloadVoice').onclick = function () {
      if (voice.serverId == '') {
        alert('请先使用 uploadVoice 上传声音');
        return;
      }
      wx.downloadVoice({
        serverId: voice.serverId,
        success: function (res) {
          alert('下载语音成功，localId 为' + res.localId);
          voice.localId = res.localId;
        }
      });
    };

    // 5 图片接口
    // 5.1 拍照、本地选图
    var images = {
      localId: [],
      serverId: []
    };
    document.querySelector('#chooseImage').onclick = function () {
      wx.chooseImage({
        success: function (res) {
          images.localId = res.localIds;
          alert('已选择 ' + res.localIds.length + ' 张图片');
        }
      });
    };

    // 5.2 图片预览
    document.querySelector('#previewImage').onclick = function () {
      wx.previewImage({
        current: 'http://img5.douban.com/view/photo/photo/public/p1353993776.jpg',
        urls: [
          'http://img3.douban.com/view/photo/photo/public/p2152117150.jpg',
          'http://img5.douban.com/view/photo/photo/public/p1353993776.jpg',
          'http://img3.douban.com/view/photo/photo/public/p2152134700.jpg'
        ]
      });
    };

    // 5.3 上传图片
    document.querySelector('#uploadImage').onclick = function () {
      if (images.localId.length == 0) {
        alert('请先使用 chooseImage 接口选择图片');
        return;
      }
      var i = 0, length = images.localId.length;
      images.serverId = [];
      function upload() {
        wx.uploadImage({
          localId: images.localId[i],
          success: function (res) {
            i++;
            alert('已上传：' + i + '/' + length);
            images.serverId.push(res.serverId);
            if (i < length) {
              upload();
            }
          },
          fail: function (res) {
            alert(JSON.stringify(res));
          }
        });
      }
      upload();
    };

    // 5.4 下载图片
    document.querySelector('#downloadImage').onclick = function () {
      if (images.serverId.length === 0) {
        alert('请先使用 uploadImage 上传图片');
        return;
      }
      var i = 0, length = images.serverId.length;
      images.localId = [];
      function download() {
        wx.downloadImage({
          serverId: images.serverId[i],
          success: function (res) {
            i++;
            alert('已下载：' + i + '/' + length);
            images.localId.push(res.localId);
            if (i < length) {
              download();
            }
          }
        });
      }
      download();
    };

    // 6 设备信息接口
    // 6.1 获取当前网络状态
    document.querySelector('#getNetworkType').onclick = function () {
      wx.getNetworkType({
        success: function (res) {
          alert(res.networkType);
        },
        fail: function (res) {
          alert(JSON.stringify(res));
        }
      });
    };

    // 8 界面操作接口
    // 8.1 隐藏右上角菜单
    document.querySelector('#hideOptionMenu').onclick = function () {
      wx.hideOptionMenu();
    };

    // 8.2 显示右上角菜单
    document.querySelector('#showOptionMenu').onclick = function () {
      wx.showOptionMenu();
    };

    // 8.3 批量隐藏菜单项
    document.querySelector('#hideMenuItems').onclick = function () {
      wx.hideMenuItems({
        menuList: [
          'menuItem:readMode', // 阅读模式
          'menuItem:share:timeline', // 分享到朋友圈
          'menuItem:copyUrl' // 复制链接
        ],
        success: function (res) {
          alert('已隐藏“阅读模式”，“分享到朋友圈”，“复制链接”等按钮');
        },
        fail: function (res) {
          alert(JSON.stringify(res));
        }
      });
    };

    // 8.4 批量显示菜单项
    document.querySelector('#showMenuItems').onclick = function () {
      wx.showMenuItems({
        menuList: [
          'menuItem:readMode', // 阅读模式
          'menuItem:share:timeline', // 分享到朋友圈
          'menuItem:copyUrl' // 复制链接
        ],
        success: function (res) {
          alert('已显示“阅读模式”，“分享到朋友圈”，“复制链接”等按钮');
        },
        fail: function (res) {
          alert(JSON.stringify(res));
        }
      });
    };

    // 8.5 隐藏所有非基本菜单项
    document.querySelector('#hideAllNonBaseMenuItem').onclick = function () {
      wx.hideAllNonBaseMenuItem({
        success: function () {
          alert('已隐藏所有非基本菜单项');
        }
      });
    };

    // 8.6 显示所有被隐藏的非基本菜单项
    document.querySelector('#showAllNonBaseMenuItem').onclick = function () {
      wx.showAllNonBaseMenuItem({
        success: function () {
          alert('已显示所有非基本菜单项');
        }
      });
    };

    // 8.7 关闭当前窗口
    document.querySelector('#closeWindow').onclick = function () {
      wx.closeWindow();
    };

    // 9 微信原生接口
    // 9.1.1 扫描二维码并返回结果
    document.querySelector('#scanQRCode0').onclick = function () {
      wx.scanQRCode({
        desc: 'scanQRCode desc'
      });
    };
    // 9.1.2 扫描二维码并返回结果
    document.querySelector('#scanQRCode1').onclick = function () {
      wx.scanQRCode({
        needResult: 1,
        desc: 'scanQRCode desc',
        success: function (res) {
          alert(JSON.stringify(res));
        }
      });
    };

    // 10 微信支付接口
    // 10.1 发起一个支付请求
    document.querySelector('#chooseWXPay').onclick = function () {
      wx.chooseWXPay({
        timestamp: 1414723227,
        nonceStr: 'noncestr',
        package: 'addition=action_id%3dgaby1234%26limit_pay%3d&bank_type=WX&body=innertest&fee_type=1&input_charset=GBK&notify_url=http%3A%2F%2F120.204.206.246%2Fcgi-bin%2Fmmsupport-bin%2Fnotifypay&out_trade_no=1414723227818375338&partner=1900000109&spbill_create_ip=127.0.0.1&total_fee=1&sign=432B647FE95C7BF73BCD177CEECBEF8D',
        paySign: 'bd5b1933cda6e9548862944836a9b52e8c9a2b69'
      });
    };

    // 11.3  跳转微信商品页
    document.querySelector('#openProductSpecificView').onclick = function () {
      wx.openProductSpecificView({
        productId: 'pDF3iY0ptap-mIIPYnsM5n8VtCR0'
      });
    };

    // 12 微信卡券接口
    // 12.1 添加卡券
    document.querySelector('#addCard').onclick = function () {
      wx.addCard({
        cardList: [
          {
            cardId: 'pDF3iY9tv9zCGCj4jTXFOo1DxHdo',
            cardExt: '{"code": "", "openid": "", "timestamp": "1418301401", "signature":"64e6a7cc85c6e84b726f2d1cbef1b36e9b0f9750"}'
          },
          {
            cardId: 'pDF3iY9tv9zCGCj4jTXFOo1DxHdo',
            cardExt: '{"code": "", "openid": "", "timestamp": "1418301401", "signature":"64e6a7cc85c6e84b726f2d1cbef1b36e9b0f9750"}'
          }
        ],
        success: function (res) {
          alert('已添加卡券：' + JSON.stringify(res.cardList));
        }
      });
    };

    // 12.2 选择卡券
    document.querySelector('#chooseCard').onclick = function () {
      wx.chooseCard({
        cardSign: '97e9c5e58aab3bdf6fd6150e599d7e5806e5cb91',
        timestamp: 1417504553,
        nonceStr: 'k0hGdSXKZEj3Min5',
        success: function (res) {
          alert('已选择卡券：' + JSON.stringify(res.cardList));
        }
      });
    };



  });
</script>
</html>
