<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:58:"C:\mywamp\Apache24\htdocs\shen\themes\pc\mp\app\entry.html";i:1509527512;s:59:"C:\mywamp\Apache24\htdocs\shen\themes\pc\mp\.\app\base.html";i:1509527512;s:69:"C:\mywamp\Apache24\htdocs\shen\themes\pc\mp\..\admin\common\base.html";i:1509527512;}*/ ?>
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
    <dt><i class="type-ico ico-trade rha-icon">&#xe617;</i>应用配置</dt></dt>
    <dd class="<?php if($action_name == 'index'): ?>selected<?php endif; ?>"><a href="<?php echo url('mp/App/index',['name'=>$addonInfo['addon'],'type'=>'news']); ?>">入口配置</a></dd>
    <?php if(isset($addonInfo['config']) && !empty($addonInfo['config'])): ?>
    <dd class="<?php if($action_name == 'config'): ?>selected<?php endif; ?>"><a href="<?php echo url('mp/App/config',['name'=>$addonInfo['addon']]); ?>">参数设置</a></dd>
    <?php endif; ?>
</dl>
<dl>
    <dt><i class="type-ico ico-trade rha-icon">&#xe670;</i>业务菜单</dt></dt>
    <?php if(is_array($addonMenu) || $addonMenu instanceof \think\Collection || $addonMenu instanceof \think\Paginator): $i = 0; $__LIST__ = $addonMenu;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?>
    <dd class="<?php if($Mkey == $key): ?>selected<?php endif; ?>">
    <a href="<?php echo url('mp/App/toview',['name'=>$addonInfo['addon'],'key'=>$key]); ?>"><i class="rha-icon"><?php echo $v['icon']; ?></i><?php echo $v['name']; ?></a>
    </dd>
    <?php endforeach; endif; else: echo "" ;endif; ?>
</dl>

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
        
<script type="text/javascript" src="__STATIC__/zclip/jquery.zclip.min.js"></script>
<?php if(isset($addonInfo['name']) OR $menu_title != ''): ?>
<div class="content-hd">
    <h2><img class="rhaphp-addon-admin-logo" src="<?php echo $addonInfo['logo']; ?>"><?php echo $addonInfo['name']; ?></h2>
</div>
<?php endif; if(isset($tips) && $tips != ''): ?>
<div class="rha-10">
    <blockquote  class="layui-elem-quote layui-text">
        <?php echo $tips; ?>
    </blockquote>
</div>
<?php endif; ?>
<!--<h1 class="site-h1">入口配置：<img src="$addonInfo.logo" width="30" height="30"> $addonInfo.name</h1>-->
<?php if($addonInfo['entry_url'] != ''): ?>
<div style="padding: 0px 10px 0px 10px;">
    <table class="layui-table" lay-skin="line">
        <colgroup>
            <col width="150">
            <col width="">
            <col>
        </colgroup>
        <thead>
        <tr>
            <th>二维码</th>
            <th>入口链接</th>
            <th>操作</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td><img src="<?php echo url('mp/material/qrcode'); ?>?url=<?php echo $entryUrl; ?>" width="100" height="100"></td>
            <td><a class="apiUrl" target="_blank" href="<?php echo $entryUrl; ?>"><?php echo $entryUrl; ?></a> <span class="tip1 rha-bt-a"></span></td>
            <td><button id="apiUrl" class="layui-btn layui-btn-mini ">复制链接</button></td>
        </tr>

        </tbody>
    </table>
</div>
<?php endif; ?>
<form class="layui-form" action="" style="padding: 0px 10px 0px 10px;">
    <div class="layui-tab">
        <ul class="layui-tab-title" >
            <li <?php if($type == 'news'): ?>class="layui-this" <?php endif; ?> > <a href="<?php echo url('mp/App/index',['name'=>$addonInfo['addon'],'type'=>'news']); ?>">响应图文</a></li>
            <li <?php if($type == 'addon'): ?>class="layui-this" <?php endif; ?>><a href="<?php echo url('mp/App/index',['name'=>$addonInfo['addon'],'type'=>'addon']); ?>">响应应用</a></li>
        </ul>
        <div class="layui-tab-content">
            <?php if($type == 'news'): ?>
            <div class="layui-tab-item layui-show">
                <br>
                <div class="layui-form-item">
                    <label class="layui-form-label">关键词</label>
                    <div class="layui-input-block">
                        <input type="text" name="keyword"   value="<?php echo $news['keyword']; ?>"  placeholder="请输入关键词" autocomplete="off" class="layui-input">
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label">标题</label>
                    <div class="layui-input-block">
                        <input type="text" name="title" value="<?php echo $news['title']; ?>" placeholder="请输入标题" autocomplete="off" class="layui-input">
                    </div>
                </div>

                <div class="layui-form-item">
                    <label class="layui-form-label">封面图</label>
                    <div class="layui-input-block">
                        <?php echo hook('Upload',['type'=>'image','name'=>'picurl','value'=>$news['url']]); ?>
                    </div>
                </div>

                <div class="layui-form-item layui-form-text">
                    <label class="layui-form-label">图文描述</label>
                    <div class="layui-input-block">
                        <textarea name="news_content" placeholder="请输入图文描述" class="layui-textarea"><?php echo $news['content']; ?></textarea>
                    </div>
                </div>

                <div class="layui-form-item">
                    <label class="layui-form-label">连接地址</label>
                    <div class="layui-input-block">
                        <?php if($news['link'] == ''): ?>
                        <input type="text" name="link" value="<?php echo $entryUrl; ?>"  placeholder="" autocomplete="off" class="layui-input">
                        <?php else: ?>
                        <input type="text" name="link" value="<?php echo $news['link']; ?>"  placeholder="请输入连接地址如：http://……" autocomplete="off" class="layui-input">
                        <?php endif; ?>
                    </div>
                </div>
                <div class="layui-form-item">
                    <div class="layui-input-block">
                        <input hidden name="addonName" value="<?php echo $addonInfo['addon']; ?>">
                        <button class="layui-btn" lay-submit="" lay-filter="demo1">立即提交</button>
                        <button type="reset" class="layui-btn layui-btn-primary">重置</button>
                    </div>
                </div>
            </div>

            <?php endif; if($type == 'addon'): ?>
            <div class="layui-tab-item layui-show">
                <br>
                <div class="layui-form-item">
                    <label class="layui-form-label">关键词</label>
                    <div class="layui-input-block">
                        <input type="text" name="keyword"   value="<?php echo $addon['keyword']; ?>"  placeholder="请输入关键词" autocomplete="off" class="layui-input">
                        <p style="font-size: 12px; padding: 7px;">此关键词响应此应用。(不是开发者不用理解此：响应addons/<?php echo $addonInfo['addon']; ?>/下的Api.php)</p>
                    </div>
                </div>
                <div class="layui-form-item">
                    <div class="layui-input-block">
                        <input hidden name="addonName" value="<?php echo $addonInfo['addon']; ?>">
                        <button class="layui-btn" lay-submit="" lay-filter="demo1">立即提交</button>
                        <button type="reset" class="layui-btn layui-btn-primary">重置</button>
                    </div>
                </div>
            </div>
            <?php endif; ?>
        </div>
    </div>

</form>
<script>
    layui.use(['form', 'layedit'], function(){
        var form = layui.form
            ,layer = layui.layer
            ,layedit = layui.layedit;
        var editIndex = layedit.build('LAY_demo_editor');
        form.on('submit(demo1)', function(data){
            $.post('',data.field,function (res) {
                if(res.status=='0'){
                    layer.msg(res.msg);
                }
                if(res.status=='1'){
                    layer.msg(res.msg,{time:1000},function () {

                    });

                }
            })
            return false;
        });


    });
    layui.use('element', function(){
        var element = layui.element;
    });
    $(function () {
        $('#apiUrl').zclip({
            path: '__STATIC__/zclip/ZeroClipboard.swf',
            copy: function(){
                $(".tip1").show();
                return $('.apiUrl').text();
            },
            afterCopy: function(){
                $(".tip1").insertAfter($('.tip1')).html('复制成功').fadeOut(2000);
            }
        });
    })
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