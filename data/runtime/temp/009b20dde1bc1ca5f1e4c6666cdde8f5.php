<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:62:"C:\mywamp\Apache24\htdocs\shen\themes\pc\mp\mp\addkeyword.html";i:1509527512;s:69:"C:\mywamp\Apache24\htdocs\shen\themes\pc\mp\..\admin\common\base.html";i:1509527512;}*/ ?>
<!DOCTYPE html>
<html>
<head>
    <meta content="text/html; charset=UTF-8" http-equiv="Content-Type">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=0">
    <meta name="keywords" content="">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="">
    <title>RhaPHP 二哈公众号管理系统</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" type="text/css" href="__STATIC__/admin/css/admin_base.css" />
    <script type="text/javascript" src="__STATIC__/jquery/jquery-1.11.0.min.js"></script>
    <script type="text/javascript" src="__STATIC__/layui/layui.js"></script>
    <link rel="stylesheet" type="text/css" href="__STATIC__/layui/css/layui.css" />
    <link rel="stylesheet" type="text/css" href="__STATIC__/icon/icon.css" />
    
</head>
<body class="trade-order">
<div class="topbar" id="gotop">
    <div class="wrap">
        <ul>
            <li>你好，<a class="name" href="" id="username"><?php echo $admin['admin_name']; ?></a>
                <?php if(!(empty($mpInfo) || (($mpInfo instanceof \think\Collection || $mpInfo instanceof \think\Paginator ) && $mpInfo->isEmpty()))): ?>
                <span class="quit">当前公众号：<a href="<?php echo url('mp/index/index',['mid'=>$mpInfo['id']]); ?>"><?php echo $mpInfo['name']; ?></a><i style="font-size: 9px; margin-left: 5px;"><?php echo getMpType($mpInfo['type']); ?></i>
                    <?php if($mpInfo['valid_status'] == '1'): ?>
                    <i style="font-size: 9px; margin-left: 5px;">已接入</i>
                    <?php else: ?>
                    <i style="font-size: 9px; margin-left: 5px; color: red">未接入</i>
                    <?php endif; ?>
                </span>
                <a class="quit" href="<?php echo url('mp/index/mplist'); ?>">切换公众号</a>
                <?php endif; ?>
                <a href="<?php echo url('mp/Message/messagelist'); ?>"><i class="layui-icon">&#xe645;</i>用户消息<span class="num-feed rhaphp-msg-user show" style="display: none;">0</span></a>
                <a href="javascript:;" onclick="cacheClear()"><i class="layui-icon">&#xe640;</i>清空缓存</a>
                <a class="quit" href="<?php echo url('admin/Login/out'); ?>"><i class="rha-icon">&#xe696;</i>退出</a>
            </li>
        </ul>
    </div>
</div>
<div class="header">
    <div class="wrap">
        <div class="logo">
            <h1 class="main-logo"><a href="<?php echo url('mp/mp/index'); ?>">RhaPHP</a></h1>
            <div class="sub-logo"></div>
        </div>
        <div class="nav">
            <ul>
                <?php if(is_array($t_menu) || $t_menu instanceof \think\Collection || $t_menu instanceof \think\Paginator): $i = 0; $__LIST__ = $t_menu;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$t): $mod = ($i % 2 );++$i;?>
                <li class="<?php if($topNode == $t['url']): ?>selected<?php endif; ?>"><a href="<?php echo url($t['url']); ?>"><?php echo $t['name']; ?></a></li>
                <?php endforeach; endif; else: echo "" ;endif; ?>
            </ul>
        </div>
    </div>
</div>
<div class="container_body wrap">
    <div class="sidebar">
        <div class="menu">
            <?php if(is_array($menu) || $menu instanceof \think\Collection || $menu instanceof \think\Paginator): $i = 0; $__LIST__ = $menu;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$t): $mod = ($i % 2 );++$i;?>
            <dl>
                <dt><i class="type-ico ico-trade rha-icon <?php if($t['shows'] == '1'): endif; ?>"><?php echo $t['icon']; ?></i><?php echo $t['name']; ?></dt>
                <?php if(is_array($t['child']) || $t['child'] instanceof \think\Collection || $t['child'] instanceof \think\Paginator): $i = 0; $__LIST__ = $t['child'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$c): $mod = ($i % 2 );++$i;?>
                <dd class="<?php if($c['shows'] == '1'): ?>selected<?php endif; ?>"><a href="<?php echo url($c['url']); ?>"><?php echo $c['name']; ?></a></dd>
                <?php endforeach; endif; else: echo "" ;endif; ?>
            </dl>
            <?php endforeach; endif; else: echo "" ;endif; ?>
            
            <dl>
                <?php  if(!isset($menu_app))$menu_app=null; if($menu_app != ''): ?><dt><i class="type-ico ico-trade rha-icon">&#xe6f0;</i>应用扩展</dt><?php endif; if(is_array($menu_app) || $menu_app instanceof \think\Collection || $menu_app instanceof \think\Paginator): $i = 0; $__LIST__ = $menu_app;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?>
                <dd class=""><a href="<?php echo url('mp/App/index',['name'=>$v['addon'],'type'=>'news','mid'=>$mid]); ?>"><?php echo $v['name']; ?></a></dd>
                <?php endforeach; endif; else: echo "" ;endif; ?>
            </dl>
        </div>
    </div>
    <div class="content" id="tradeSearchBd">
        <?php if(isset($menu_tile) OR $menu_title != ''): ?>
        <div class="content-hd">
            <h2><?php echo $menu_title; ?></h2>
        </div>
        <?php endif; ?>
        
<form class="layui-form" action="" style="padding-right: 10px;">
    <div class="layui-form-item">
        <label class="layui-form-label">回复关键词</label>
        <div class="layui-input-block">
            <input type="text" name="keyword"    placeholder="请输入关键词" autocomplete="off" class="layui-input">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">是否开启</label>
        <div class="layui-input-block">
            <input type="checkbox" name="status" value="1" checked="checked" lay-skin="switch">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">回复类型</label>
        <div id="replyType" class="layui-input-block">
            <input type="radio"  checked  name="type" value="text" title="回复文本">
            <input type="radio" name="type" value="news" title="回复图文" >
            <input type="radio" name="type" value="addon" title="触发应用">
            <input type="radio" name="type" value="voice" title="回复语音" >
            <input type="radio" name="type" value="image" title="回复图片" >
            <input type="radio" name="type" value="video" title="回复视频">
            <input type="radio" name="type" value="music" title="回复音乐" >
        </div>
    </div>
    <div id="tapNode">
        <div class="layui-tab-content">
            <div class=" reply_text layui-tab-item layui-show"><div class="layui-form-item layui-form-text">
                <label class="layui-form-label">回复内容</label>
                    <div class="layui-input-block">
                        <textarea name="content" placeholder="请输入内容" class="layui-textarea"></textarea>
                    </div>
                </div>
            </div>

            <div class="reply_news layui-tab-item">

                <div class="layui-form-item">
                    <label class="layui-form-label">标题</label>
                    <div class="layui-input-block">
                        <input type="text" name="title" placeholder="请输入标题" autocomplete="off" class="layui-input">
                    </div>
                </div>

                <div class="layui-form-item">
                    <label class="layui-form-label">封面图</label>
                    <div class="layui-input-block">
                        <?php echo hook('Upload',['type'=>'image','name'=>'picurl','material'=>true]); ?>
                    </div>
                </div>

                <div class="layui-form-item layui-form-text">
                    <label class="layui-form-label">图文描述</label>
                    <div class="layui-input-block">
                        <textarea name="news_content" placeholder="请输入图文描述" class="layui-textarea"></textarea>
                    </div>
                </div>

                <div class="layui-form-item">
                    <label class="layui-form-label">连接地址</label>
                    <div class="layui-input-block">
                        <input type="text" name="link"  placeholder="请输入连接地址如：http://xxxx.com/……" autocomplete="off" class="layui-input">
                    </div>
                </div>

            </div>
            <div class="reply_addon layui-tab-item">
                <div class="layui-form-item">
                    <label class="layui-form-label">选择应用</label>
                    <div class="layui-input-block">
                        <select name="addons">
                            <option value="">请选择应用</option>
                            <?php if(is_array($addons) || $addons instanceof \think\Collection || $addons instanceof \think\Paginator): $i = 0; $__LIST__ = $addons;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?>
                            <option value="<?php echo $v['addon']; ?>"><?php echo $v['name']; ?></option>
                            <?php endforeach; endif; else: echo "" ;endif; ?>
                        </select>
                    </div>
                </div>
            </div>
            <div class="reply_voice layui-tab-item">
                <div class="layui-form-item">
                    <label class="layui-form-label">语音名称</label>
                    <div class="layui-input-block">
                        <input type="text" name="voice_title"  placeholder="请输入标题" autocomplete="off" class="layui-input">
                    </div>
                </div>
                <div class="layui-form-item">

                    <label class="layui-form-label">语音</label>
                    <div class="layui-input-block">
                        <?php echo hook('Upload',['type'=>'voice','name'=>'voice','bt_title'=>'上传语音','material'=>true]); ?>
                        <p class="tip_for_p">临时语音只支持amr/mp3格式,大小不超过为2M,长度不超过60秒,永久语音只支持mp3/wma/wav/amr格式,大小不超过为5M,长度不超过60秒</p>
                    </div>

                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label">类型</label>
                    <div  class="layui-input-block">
                        <input type="radio"  checked  name="voice_staus_type" value="0" title="临时">
                        <input type="radio" name="voice_staus_type" value="1" title="永久" >
                    </div>
                </div>
            </div>
            <div class="reply_image layui-tab-item">
                <div class="layui-form-item">
                    <label class="layui-form-label">上传图片</label>
                    <div class="layui-input-block">
                        <?php echo hook('Upload',['type'=>'image','name'=>'reply_image','material'=>true]); ?>
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label">类型</label>
                    <div  class="layui-input-block">
                        <input type="radio"  checked  name="image_staus_type" value="0" title="临时">
                        <input type="radio" name="image_staus_type" value="1" title="永久" >
                    </div>
                </div>
            </div>
            <div class="reply_video layui-tab-item">
                <div class="layui-form-item">
                    <label class="layui-form-label">视频标题</label>
                    <div class="layui-input-block">
                        <input type="text" name="video_title"  placeholder="请输入标题" autocomplete="off" class="layui-input">
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label">视频</label>
                    <div class="layui-input-block">
                        <?php echo hook('Upload',['type'=>'video','name'=>'reply_video','bt_title'=>'上传视频','material'=>true]); ?>
                        <p class="tip_for_p">临时视频只支持mp4格式,大小不超过为10M,永久视频只支持rm/rmvb/wmv/avi/mpg/mpeg/mp4格式,大小不超过为20M</p>
                    </div>
                </div>
                <div class="layui-form-item layui-form-text">
                    <label class="layui-form-label">描述内容</label>
                    <div class="layui-input-block">
                        <textarea name="video_content" placeholder="请输入内容" class="layui-textarea"></textarea>
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label">类型</label>
                    <div  class="layui-input-block">
                        <input type="radio"  checked  name="video_staus_type" value="0" title="临时">
                        <input type="radio" name="video_staus_type" value="1" title="永久" >
                    </div>
                </div>
            </div>
            <div class="reply_music layui-tab-item">
                <div class="layui-form-item">
                    <label class="layui-form-label">音乐标题</label>
                    <div class="layui-input-block">
                        <input type="text" name="music_title"  placeholder="请输入标题" autocomplete="off" class="layui-input">
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label">资源文件</label>
                    <div class="layui-input-block">
                        <?php echo hook('Upload',['type'=>'media','name'=>'music','bt_title'=>'上传音乐']); ?>

                    </div>

                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label">高品质链接</label>
                    <div class="layui-input-block">
                        <input type="text" name="music_link"  placeholder="请输入链接" autocomplete="off" class="layui-input">
                    </div>
                </div>
                <div class="layui-form-item layui-form-text">
                    <label class="layui-form-label">描述内容</label>
                    <div class="layui-input-block">
                        <textarea name="music_content" placeholder="请输入内容" class="layui-textarea"></textarea>
                    </div>
                </div>

            </div>
        </div>

    </div>
    <div class="layui-form-item">
        <div class="layui-input-block">
            <button class="layui-btn" lay-submit lay-filter="SBT">立即提交</button>
            <button type="reset" class="layui-btn layui-btn-primary">重置</button>
        </div>
    </div>
</form>

<script>
    $(function () {
       // $('input[name="type"]').each(function(){alert(this.value);});var oldClass= 'replay_'+ $("input[name='type']:checked").val();
        $("#replyType").click(function(){
            var class_a='reply_'+ $("input[name='type']:checked").val();
            $('.layui-tab-content div').removeClass('layui-show')
            $('.'+class_a).addClass('layui-show')
        });
    })
    layui.use('form', function(){
        var form = layui.form
        form.on('submit(SBT)', function(data){
            var load = layer.load();
            $.post('',data.field,function (res) {
                if(res.status=='0'){
                    layer.close(load);
                    layer.alert(res.msg);
                }
                if(res.status=='1'){
                    layer.close(load);
                    layer.msg(res.msg,{time:1000},function () {
                        window.location.href=res.url;
                    });
                }
            })
            return false;
        });

    });
</script>

    </div>
</div>
<div class="footer">
    <div class="wrap">
        <!--请遵守安装使用协议，未经允许不得删除或者屏蔽有关RhaPHP字样-->
        <a href="http://www.rhaphp.com" target="_blank">官方社区</a>
        <i class="vs">|</i>
        Powered By RhaPHP<?php echo $copy['version']; ?> 二哈系统 Copyright © 2017 All Rights Reserved.
    </div>
</div>
</body>
<script>
    layui.use('element', function(){
        var element = layui.element;
    });
    function getMaterial(paramName,type){
        layer.open({
            type: 2,
            title: '选择素材',
            shadeClose: true,
            shade: 0.8,
            area: ['750px', '480px'],
            content: '<?php echo getHostDomain(); ?>/index.php/mp/Material/getMeterial/type/'+type+'/param/'+paramName //iframe的url
        });
    }
    function controllerByVal(value,paramName,type) {
        $('.form_'+paramName).attr('src',value);
        $("input[name="+paramName+"]").val(value);
    }
    $(function () {
         setInterval(getMsgTotal,10000);
        function getMsgTotal() {
            $.get("<?php echo url('mp/Message/getMsgStatusTotal'); ?>",{},function (res) {
                if(res.msgTotal==0){
                    //TODO
                }else{
                    $('.rhaphp-msg-user').show();
                    $('.rhaphp-msg-user').text(res.msgTotal);
                }

            })
        }
    })
    function cacheClear() {
        layui.use('layer', function(){
            var layer = layui.layer;
            var index =layer.load(1)
            $.post("<?php echo url('admin/system/cacheClear'); ?>",function (res) {
                layer.close(index);
                layer.alert(res.msg);
            })
        });
    }
</script>
</html>