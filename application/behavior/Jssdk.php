<?php
// +----------------------------------------------------------------------
// | [RhaPHP System] Copyright (c) 2017 http://www.rhaphp.com/
// +----------------------------------------------------------------------
// | [RhaPHP] 并不是自由软件,你可免费使用,未经许可不能去掉RhaPHP相关版权
// +----------------------------------------------------------------------
// | Author: Geeson <qimengkeji@vip.qq.com>
// +----------------------------------------------------------------------

namespace app\behavior;
use think\Loader;

class Jssdk
{
    public function run($param=null){
        $mp=getMpInfo();
        Loader::import('Jssdk.jssdk',EXTEND_PATH,'.php');
        $jssdk=new \JSSDK($mp['appid'],$mp['appsecret']);
        $wx= $jssdk->getSignPackage();
        $httpType=getHttpType();
        echo  "<script src=\"{$httpType}res.wx.qq.com/open/js/jweixin-1.2.0.js\"></script>
        <script>
          wx.config({
              debug: false,
              appId: '".$wx['appId']."',
              timestamp: '".$wx['timestamp']."',
              nonceStr: '".$wx['nonceStr']."',
              signature: '".$wx['signature']."',
              jsApiList: [
                'checkJsApi',
                'onMenuShareTimeline',
                'onMenuShareAppMessage',
                'onMenuShareQQ',
                'onMenuShareWeibo',
                'onMenuShareQZone',
                'hideMenuItems',
                'showMenuItems',
                'hideAllNonBaseMenuItem',
                'showAllNonBaseMenuItem',
                'translateVoice',
                'startRecord',
                'stopRecord',
                'onVoiceRecordEnd',
                'playVoice',
                'onVoicePlayEnd',
                'pauseVoice',
                'stopVoice',
                'uploadVoice',
                'downloadVoice',
                'chooseImage',
                'previewImage',
                'uploadImage',
                'downloadImage',
                'getNetworkType',
                'openLocation',
                'getLocation',
                'hideOptionMenu',
                'showOptionMenu',
                'closeWindow',
                'scanQRCode',
                'chooseWXPay',
                'openProductSpecificView',
                'addCard',
                'chooseCard',
                'openCard'
              ]
          });
        </script>";
    }

}