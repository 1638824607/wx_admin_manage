<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:59:"C:\mywamp\Apache24\htdocs\shen\themes\pc\mp\mp\special.html";i:1509527512;s:69:"C:\mywamp\Apache24\htdocs\shen\themes\pc\mp\..\admin\common\base.html";i:1509527512;s:70:"C:\mywamp\Apache24\htdocs\shen\themes\pc\mp\common\autoreplay_nav.html";i:1509527512;}*/ ?>
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
        
<link rel="stylesheet" type="text/css" href="/public/static/mp/css/custom_menu.css" />
<div class="layui-tab" style="padding: 0px 10px 0px 10px;">
    <ul class="layui-tab-title">
        <li <?php if($action_name == 'autoreply'): ?>class="layui-this"<?php endif; ?>> <a href="<?php echo url('autoreply'); ?>">关键词回复</a></li>
        <li <?php if($action_name == 'special'): ?>class="layui-this"<?php endif; ?>><a href="<?php echo url('special'); ?>">特殊消息/事件</a></li>
        <!--<li <?php if($action_name == 'autoreply'): ?>class="layui-this"<?php endif; ?>>事件回复</li>-->
        <!--<li <?php if($action_name == 'autoreply'): ?>class="layui-this"<?php endif; ?>>未识别回复</li>-->
    </ul>
</div>
<form class="layui-form" action="">

    <div class="layui-form-item">
        <label class="layui-form-label">用户关注</label>
        <div id="replyType_subscribe" class="layui-input-block">
            <input type="radio" <?php if($subscribe['event'] == 'nocol'): ?> checked <?php endif; ?>  name="subscribe" value="nocol" title="不处理">
            <input type="radio" <?php if(!(empty($subscribe['keyword']) || (($subscribe['keyword'] instanceof \think\Collection || $subscribe['keyword'] instanceof \think\Paginator ) && $subscribe['keyword']->isEmpty()))): ?> checked <?php endif; ?> name="subscribe" value="keyword" title="触发关键词" >
            <input type="radio" <?php if(!(empty($subscribe['addon']) || (($subscribe['addon'] instanceof \think\Collection || $subscribe['addon'] instanceof \think\Paginator ) && $subscribe['addon']->isEmpty()))): ?> checked <?php endif; ?> name="subscribe" value="addon" title="触发应用">
        </div>
    </div>
    <div id="tapNodesubscribe">
        <div class="layui-tab-content subscribe">
            <div class=" image_text layui-tab-item  <?php if($subscribe['event'] == 'nocol'): ?> layui-show <?php endif; ?>">
            <div class="layui-form-item layui-form-text">
            </div>
        </div>
        <div class="subscribe_keyword layui-tab-item <?php if(!(empty($subscribe['keyword']) || (($subscribe['keyword'] instanceof \think\Collection || $subscribe['keyword'] instanceof \think\Paginator ) && $subscribe['keyword']->isEmpty()))): ?> layui-show <?php endif; ?>">
        <div class="layui-form-item">
            <label class="layui-form-label"></label>
            <div class="layui-input-block">
                <input type="text" name="subscribe_keyword" value="<?php echo $subscribe['keyword']; ?>" placeholder="请输入关键词" autocomplete="off" class="layui-input">
            </div>
        </div>
    </div>
    <div class="subscribe_addon layui-tab-item <?php if(!(empty($subscribe['addon']) || (($subscribe['addon'] instanceof \think\Collection || $subscribe['addon'] instanceof \think\Paginator ) && $subscribe['addon']->isEmpty()))): ?> layui-show  <?php endif; ?>">
    <div class="layui-form-item">
        <label class="layui-form-label"></label>
        <div class="layui-input-block">
            <select name="subscribe_addons">
                <option value="">请选择应用</option>
                <?php if(is_array($addons) || $addons instanceof \think\Collection || $addons instanceof \think\Paginator): $i = 0; $__LIST__ = $addons;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?>
                <option <?php if($subscribe['addon'] == $v['addon']): ?> selected <?php endif; ?>  value="<?php echo $v['addon']; ?>"><?php echo $v['name']; ?></option>
                <?php endforeach; endif; else: echo "" ;endif; ?>
            </select>
        </div>
    </div>
    </div>
    </div>
    </div>


    <div class="layui-form-item">
        <label class="layui-form-label">取消关注</label>
        <div id="replyType_unsubscribe" class="layui-input-block">
            <input type="radio" <?php if($unsubscribe['event'] == 'nocol'): ?> checked <?php endif; ?>  name="unsubscribe" value="nocol" title="不处理">
            <input type="radio" <?php if(!(empty($unsubscribe['keyword']) || (($unsubscribe['keyword'] instanceof \think\Collection || $unsubscribe['keyword'] instanceof \think\Paginator ) && $unsubscribe['keyword']->isEmpty()))): ?> checked <?php endif; ?> name="unsubscribe" value="keyword" title="触发关键词" >
            <input type="radio" <?php if(!(empty($unsubscribe['addon']) || (($unsubscribe['addon'] instanceof \think\Collection || $unsubscribe['addon'] instanceof \think\Paginator ) && $unsubscribe['addon']->isEmpty()))): ?> checked <?php endif; ?> name="unsubscribe" value="addon" title="触发应用">
        </div>
    </div>
    <div id="tapNodeunsubscribe">
        <div class="layui-tab-content unsubscribe">
            <div class=" image_text layui-tab-item  <?php if($unsubscribe['event'] == 'nocol'): ?> layui-show <?php endif; ?>">
            <div class="layui-form-item layui-form-text">
            </div>
        </div>
        <div class="unsubscribe_keyword layui-tab-item <?php if(!(empty($unsubscribe['keyword']) || (($unsubscribe['keyword'] instanceof \think\Collection || $unsubscribe['keyword'] instanceof \think\Paginator ) && $unsubscribe['keyword']->isEmpty()))): ?> layui-show <?php endif; ?>">
        <div class="layui-form-item">
            <label class="layui-form-label"></label>
            <div class="layui-input-block">
                <input type="text" name="unsubscribe_keyword" value="<?php echo $unsubscribe['keyword']; ?>" placeholder="请输入关键词" autocomplete="off" class="layui-input">
            </div>
        </div>
    </div>
    <div class="unsubscribe_addon layui-tab-item <?php if(!(empty($unsubscribe['addon']) || (($unsubscribe['addon'] instanceof \think\Collection || $unsubscribe['addon'] instanceof \think\Paginator ) && $unsubscribe['addon']->isEmpty()))): ?> layui-show  <?php endif; ?>">
    <div class="layui-form-item">
        <label class="layui-form-label"></label>
        <div class="layui-input-block">
            <select name="unsubscribe_addons">
                <option value="">请选择应用</option>
                <?php if(is_array($addons) || $addons instanceof \think\Collection || $addons instanceof \think\Paginator): $i = 0; $__LIST__ = $addons;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?>
                <option <?php if($unsubscribe['addon'] == $v['addon']): ?> selected <?php endif; ?>  value="<?php echo $v['addon']; ?>"><?php echo $v['name']; ?></option>
                <?php endforeach; endif; else: echo "" ;endif; ?>
            </select>
        </div>
    </div>
    </div>
    </div>
    </div>




    <div class="layui-form-item">
        <label class="layui-form-label">图片消息</label>
        <div id="replyType_image" class="layui-input-block">
            <input type="radio" <?php if($image['event'] == 'nocol'): ?> checked <?php endif; ?>  name="image" value="nocol" title="不处理">
            <input type="radio" <?php if(!(empty($image['keyword']) || (($image['keyword'] instanceof \think\Collection || $image['keyword'] instanceof \think\Paginator ) && $image['keyword']->isEmpty()))): ?> checked <?php endif; ?> name="image" value="keyword" title="触发关键词" >
            <input type="radio" <?php if(!(empty($image['addon']) || (($image['addon'] instanceof \think\Collection || $image['addon'] instanceof \think\Paginator ) && $image['addon']->isEmpty()))): ?> checked <?php endif; ?> name="image" value="addon" title="触发应用">
        </div>
    </div>
    <div id="tapNode">
        <div class="layui-tab-content image">
            <div class=" image_text layui-tab-item  <?php if($image['event'] == 'nocol'): ?> layui-show <?php endif; ?>">
                <div class="layui-form-item layui-form-text">
                </div>
            </div>
            <div class="image_keyword layui-tab-item <?php if(!(empty($image['keyword']) || (($image['keyword'] instanceof \think\Collection || $image['keyword'] instanceof \think\Paginator ) && $image['keyword']->isEmpty()))): ?> layui-show <?php endif; ?>">
                <div class="layui-form-item">
                    <label class="layui-form-label"></label>
                    <div class="layui-input-block">
                        <input type="text" name="image_keyword" value="<?php echo $image['keyword']; ?>" placeholder="请输入关键词" autocomplete="off" class="layui-input">
                    </div>
                </div>
            </div>
            <div class="image_addon layui-tab-item <?php if(!(empty($image['addon']) || (($image['addon'] instanceof \think\Collection || $image['addon'] instanceof \think\Paginator ) && $image['addon']->isEmpty()))): ?> layui-show  <?php endif; ?>">
                <div class="layui-form-item">
                    <label class="layui-form-label"></label>
                    <div class="layui-input-block">
                        <select name="image_addons">
                            <option value="">请选择应用</option>
                            <?php if(is_array($addons) || $addons instanceof \think\Collection || $addons instanceof \think\Paginator): $i = 0; $__LIST__ = $addons;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?>
                            <option <?php if($image['addon'] == $v['addon']): ?> selected <?php endif; ?>  value="<?php echo $v['addon']; ?>"><?php echo $v['name']; ?></option>
                            <?php endforeach; endif; else: echo "" ;endif; ?>
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="layui-form-item">
        <label class="layui-form-label">语音消息</label>
        <div id="replyType_voice" class="layui-input-block">
            <input type="radio"  <?php if($voice['event'] == 'nocol'): ?> checked <?php endif; ?> name="voice" value="nocol" title="不处理">
            <input type="radio" <?php if(!(empty($voice['keyword']) || (($voice['keyword'] instanceof \think\Collection || $voice['keyword'] instanceof \think\Paginator ) && $voice['keyword']->isEmpty()))): ?> checked <?php endif; ?> name="voice" value="keyword" title="触发关键词" >
            <input type="radio" <?php if(!(empty($voice['addon']) || (($voice['addon'] instanceof \think\Collection || $voice['addon'] instanceof \think\Paginator ) && $voice['addon']->isEmpty()))): ?> checked <?php endif; ?> name="voice" value="addon" title="触发应用">
        </div>
    </div>
    <div id="tapNodevoice">
        <div class="layui-tab-content voice">
            <div class=" image_text layui-tab-item <?php if($voice['event'] == 'nocol'): ?> layui-show <?php endif; ?>">
                <div class="layui-form-item layui-form-text">
                </div>
            </div>
            <div class="voice_keyword layui-tab-item <?php if(!(empty($voice['keyword']) || (($voice['keyword'] instanceof \think\Collection || $voice['keyword'] instanceof \think\Paginator ) && $voice['keyword']->isEmpty()))): ?> layui-show <?php endif; ?>">
                <div class="layui-form-item">
                    <label class="layui-form-label"></label>
                    <div class="layui-input-block">
                        <input type="text" name="voice_keyword" value="<?php echo $voice['keyword']; ?>" placeholder="请输入关键词" autocomplete="off" class="layui-input">
                    </div>
                </div>
            </div>
            <div class="voice_addon layui-tab-item <?php if(!(empty($voice['addon']) || (($voice['addon'] instanceof \think\Collection || $voice['addon'] instanceof \think\Paginator ) && $voice['addon']->isEmpty()))): ?> layui-show <?php endif; ?>">
                <div class="layui-form-item">
                    <label class="layui-form-label"></label>
                    <div class="layui-input-block">
                        <select name="voice_addons">
                            <option value="">请选择应用</option>
                            <?php if(is_array($addons) || $addons instanceof \think\Collection || $addons instanceof \think\Paginator): $i = 0; $__LIST__ = $addons;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?>
                            <option <?php if($voice['addon'] == $v['addon']): ?> selected <?php endif; ?> value="<?php echo $v['addon']; ?>"><?php echo $v['name']; ?></option>
                            <?php endforeach; endif; else: echo "" ;endif; ?>
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="layui-form-item">
        <label class="layui-form-label">视频消息</label>
        <div id="replyType_video" class="layui-input-block">
            <input type="radio"  <?php if($video['event'] == 'nocol'): ?> checked <?php endif; ?> name="video" value="nocol" title="不处理">
            <input type="radio" <?php if(!(empty($video['keyword']) || (($video['keyword'] instanceof \think\Collection || $video['keyword'] instanceof \think\Paginator ) && $video['keyword']->isEmpty()))): ?> checked <?php endif; ?> name="video" value="keyword" title="触发关键词" >
            <input type="radio" <?php if(!(empty($video['addon']) || (($video['addon'] instanceof \think\Collection || $video['addon'] instanceof \think\Paginator ) && $video['addon']->isEmpty()))): ?> checked <?php endif; ?> name="video" value="addon" title="触发应用">
        </div>
    </div>
    <div id="tapNodevideo">
        <div class="layui-tab-content video">
            <div class=" image_text layui-tab-item <?php if($video['event'] == 'nocol'): ?> layui-show <?php endif; ?>">
                <div class="layui-form-item layui-form-text">
                </div>
            </div>
            <div class="video_keyword layui-tab-item <?php if(!(empty($video['keyword']) || (($video['keyword'] instanceof \think\Collection || $video['keyword'] instanceof \think\Paginator ) && $video['keyword']->isEmpty()))): ?> layui-show <?php endif; ?>">
                <div class="layui-form-item">
                    <label class="layui-form-label"></label>
                    <div class="layui-input-block">
                        <input type="text" name="video_keyword" value="<?php echo $video['keyword']; ?>" placeholder="请输入关键词" autocomplete="off" class="layui-input">
                    </div>
                </div>
            </div>
            <div class="video_addon layui-tab-item <?php if(!(empty($video['addon']) || (($video['addon'] instanceof \think\Collection || $video['addon'] instanceof \think\Paginator ) && $video['addon']->isEmpty()))): ?> layui-show <?php endif; ?>">
                <div class="layui-form-item">
                    <label class="layui-form-label"></label>
                    <div class="layui-input-block">
                        <select name="video_addons">
                            <option value="">请选择应用</option>
                            <?php if(is_array($addons) || $addons instanceof \think\Collection || $addons instanceof \think\Paginator): $i = 0; $__LIST__ = $addons;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?>
                            <option <?php if($video['addon'] == $v['addon']): ?> selected <?php endif; ?> value="<?php echo $v['addon']; ?>"><?php echo $v['name']; ?></option>
                            <?php endforeach; endif; else: echo "" ;endif; ?>
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="layui-form-item">
        <label class="layui-form-label">短视频消息</label>
        <div id="replyType_shortvideo" class="layui-input-block">
            <input type="radio"  <?php if($shortvideo['event'] == 'nocol'): ?> checked <?php endif; ?> name="shortvideo" value="nocol" title="不处理">
            <input type="radio" <?php if(!(empty($shortvideo['keyword']) || (($shortvideo['keyword'] instanceof \think\Collection || $shortvideo['keyword'] instanceof \think\Paginator ) && $shortvideo['keyword']->isEmpty()))): ?> checked <?php endif; ?> name="shortvideo" value="keyword" title="触发关键词" >
            <input type="radio" <?php if(!(empty($shortvideo['addon']) || (($shortvideo['addon'] instanceof \think\Collection || $shortvideo['addon'] instanceof \think\Paginator ) && $shortvideo['addon']->isEmpty()))): ?> checked <?php endif; ?> name="shortvideo" value="addon" title="触发应用">
        </div>
    </div>
    <div id="tapNodeshortvideo">
        <div class="layui-tab-content shortvideo">
            <div class=" image_text layui-tab-item layui-show <?php if($shortvideo['event'] == 'nocol'): ?> layui-show <?php endif; ?>">
                <div class="layui-form-item layui-form-text">
                </div>
            </div>
            <div class="shortvideo_keyword layui-tab-item <?php if(!(empty($shortvideo['keyword']) || (($shortvideo['keyword'] instanceof \think\Collection || $shortvideo['keyword'] instanceof \think\Paginator ) && $shortvideo['keyword']->isEmpty()))): ?> layui-show <?php endif; ?>">
                <div class="layui-form-item">
                    <label class="layui-form-label"></label>
                    <div class="layui-input-block">
                        <input type="text" name="shortvideo_keyword" value="<?php echo $shortvideo['keyword']; ?>" placeholder="请输入关键词" autocomplete="off" class="layui-input">
                    </div>
                </div>
            </div>
            <div class="shortvideo_addon layui-tab-item <?php if(!(empty($shortvideo['addon']) || (($shortvideo['addon'] instanceof \think\Collection || $shortvideo['addon'] instanceof \think\Paginator ) && $shortvideo['addon']->isEmpty()))): ?> layui-show <?php endif; ?>">
                <div class="layui-form-item">
                    <label class="layui-form-label"></label>
                    <div class="layui-input-block">
                        <select name="shortvideo_addons">
                            <option value="">请选择应用</option>
                            <?php if(is_array($addons) || $addons instanceof \think\Collection || $addons instanceof \think\Paginator): $i = 0; $__LIST__ = $addons;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?>
                            <option <?php if($shortvideo['addon'] == $v['addon']): ?> selected <?php endif; ?> value="<?php echo $v['addon']; ?>"><?php echo $v['name']; ?></option>
                            <?php endforeach; endif; else: echo "" ;endif; ?>
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <div class="layui-form-item">
        <label class="layui-form-label">位置消息</label>
        <div id="replyType_location" class="layui-input-block">
            <input type="radio"  <?php if($location['event'] == 'nocol'): ?> checked <?php endif; ?> name="location" value="nocol" title="不处理">
            <input type="radio" <?php if(!(empty($location['keyword']) || (($location['keyword'] instanceof \think\Collection || $location['keyword'] instanceof \think\Paginator ) && $location['keyword']->isEmpty()))): ?> checked <?php endif; ?> name="location" value="keyword" title="触发关键词" >
            <input type="radio" <?php if(!(empty($location['addon']) || (($location['addon'] instanceof \think\Collection || $location['addon'] instanceof \think\Paginator ) && $location['addon']->isEmpty()))): ?> checked <?php endif; ?> name="location" value="addon" title="触发应用">
        </div>
    </div>
    <div id="tapNodelocation">
        <div class="layui-tab-content location">
            <div class=" image_text layui-tab-item <?php if($location['event'] == 'nocol'): ?> layui-show <?php endif; ?>">
                <div class="layui-form-item layui-form-text">
                </div>
            </div>
            <div class="location_keyword layui-tab-item <?php if(!(empty($location['keyword']) || (($location['keyword'] instanceof \think\Collection || $location['keyword'] instanceof \think\Paginator ) && $location['keyword']->isEmpty()))): ?> layui-show <?php endif; ?>">
                <div class="layui-form-item">
                    <label class="layui-form-label"></label>
                    <div class="layui-input-block">
                        <input type="text" name="location_keyword" value="<?php echo $location['keyword']; ?>" placeholder="请输入关键词" autocomplete="off" class="layui-input">
                    </div>
                </div>
            </div>
            <div class="location_addon layui-tab-item <?php if(!(empty($location['addon']) || (($location['addon'] instanceof \think\Collection || $location['addon'] instanceof \think\Paginator ) && $location['addon']->isEmpty()))): ?> layui-show <?php endif; ?>">
                <div class="layui-form-item">
                    <label class="layui-form-label"></label>
                    <div class="layui-input-block">
                        <select name="location_addons">
                            <option value="">请选择应用</option>
                            <?php if(is_array($addons) || $addons instanceof \think\Collection || $addons instanceof \think\Paginator): $i = 0; $__LIST__ = $addons;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?>
                            <option <?php if($location['addon'] == $v['addon']): ?> selected <?php endif; ?> value="<?php echo $v['addon']; ?>"><?php echo $v['name']; ?></option>
                            <?php endforeach; endif; else: echo "" ;endif; ?>
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="layui-form-item">
        <label class="layui-form-label">上报位置</label>
        <div id="replyType_event_location" class="layui-input-block">
            <input type="radio"  <?php if($event_location['event'] == 'nocol'): ?> checked <?php endif; ?> name="event_location" value="nocol" title="不处理">
            <input type="radio" <?php if(!(empty($event_location['keyword']) || (($event_location['keyword'] instanceof \think\Collection || $event_location['keyword'] instanceof \think\Paginator ) && $event_location['keyword']->isEmpty()))): ?> checked <?php endif; ?> name="event_location" value="keyword" title="触发关键词" >
            <input type="radio" <?php if(!(empty($event_location['addon']) || (($event_location['addon'] instanceof \think\Collection || $event_location['addon'] instanceof \think\Paginator ) && $event_location['addon']->isEmpty()))): ?> checked <?php endif; ?> name="event_location" value="addon" title="触发应用">
        </div>
    </div>
    <div id="tapNodeevent_location">
        <div class="layui-tab-content event_location">
            <div class=" image_text layui-tab-item <?php if($event_location['event'] == 'nocol'): ?> layui-show <?php endif; ?>">
                <div class="layui-form-item layui-form-text">
                </div>
            </div>
            <div class="event_location_keyword layui-tab-item <?php if(!(empty($event_location['keyword']) || (($event_location['keyword'] instanceof \think\Collection || $event_location['keyword'] instanceof \think\Paginator ) && $event_location['keyword']->isEmpty()))): ?> layui-show <?php endif; ?>">
                <div class="layui-form-item">
                    <label class="layui-form-label"></label>
                    <div class="layui-input-block">
                        <input type="text" name="event_location_keyword"  value="<?php echo $event_location['keyword']; ?>" placeholder="请输入关键词" autocomplete="off" class="layui-input">
                    </div>
                </div>
            </div>
            <div class="event_location_addon layui-tab-item <?php if(!(empty($event_location['addon']) || (($event_location['addon'] instanceof \think\Collection || $event_location['addon'] instanceof \think\Paginator ) && $event_location['addon']->isEmpty()))): ?> layui-show <?php endif; ?>">
                <div class="layui-form-item">
                    <label class="layui-form-label"></label>
                    <div class="layui-input-block">
                        <select name="event_location_addons">
                            <option value="">请选择应用</option>
                            <?php if(is_array($addons) || $addons instanceof \think\Collection || $addons instanceof \think\Paginator): $i = 0; $__LIST__ = $addons;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?>
                            <option <?php if($event_location['addon'] == $v['addon']): ?> selected <?php endif; ?> value="<?php echo $v['addon']; ?>"><?php echo $v['name']; ?></option>
                            <?php endforeach; endif; else: echo "" ;endif; ?>
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="layui-form-item">
        <label class="layui-form-label">链接消息</label>
        <div id="replyType_link" class="layui-input-block">
            <input type="radio"  <?php if($link['event'] == 'nocol'): ?> checked <?php endif; ?> name="link" value="nocol" title="不处理">
            <input type="radio" <?php if(!(empty($link['keyword']) || (($link['keyword'] instanceof \think\Collection || $link['keyword'] instanceof \think\Paginator ) && $link['keyword']->isEmpty()))): ?> checked <?php endif; ?> name="link" value="keyword" title="触发关键词" >
            <input type="radio" <?php if(!(empty($link['addon']) || (($link['addon'] instanceof \think\Collection || $link['addon'] instanceof \think\Paginator ) && $link['addon']->isEmpty()))): ?> checked <?php endif; ?> name="link" value="addon" title="触发应用">
        </div>
    </div>
    <div id="tapNodelink">
        <div class="layui-tab-content link">
            <div class=" image_text layui-tab-item <?php if($link['event'] == 'nocol'): ?> layui-show <?php endif; ?>">
                <div class="layui-form-item layui-form-text">
                </div>
            </div>
            <div class="link_keyword layui-tab-item <?php if(!(empty($link['keyword']) || (($link['keyword'] instanceof \think\Collection || $link['keyword'] instanceof \think\Paginator ) && $link['keyword']->isEmpty()))): ?> layui-show <?php endif; ?>">
                <div class="layui-form-item">
                    <label class="layui-form-label"></label>
                    <div class="layui-input-block">
                        <input type="text" name="link_keyword" value="<?php echo $link['keyword']; ?>" placeholder="请输入关键词" autocomplete="off" class="layui-input">
                    </div>
                </div>
            </div>
            <div class="link_addon layui-tab-item <?php if(!(empty($link['addon']) || (($link['addon'] instanceof \think\Collection || $link['addon'] instanceof \think\Paginator ) && $link['addon']->isEmpty()))): ?> layui-show <?php endif; ?>">
                <div class="layui-form-item">
                    <label class="layui-form-label"></label>
                    <div class="layui-input-block">
                        <select name="link_addons">
                            <option value="">请选择应用</option>
                            <?php if(is_array($addons) || $addons instanceof \think\Collection || $addons instanceof \think\Paginator): $i = 0; $__LIST__ = $addons;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?>
                            <option <?php if($link['addon'] == $v['addon']): ?> selected <?php endif; ?> value="<?php echo $v['addon']; ?>"><?php echo $v['name']; ?></option>
                            <?php endforeach; endif; else: echo "" ;endif; ?>
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="layui-form-item">
        <label class="layui-form-label">菜单链接</label>
        <div id="replyType_view" class="layui-input-block">
            <input type="radio"  <?php if($view['event'] == 'nocol'): ?> checked <?php endif; ?> name="view" value="nocol" title="不处理">
            <input type="radio" <?php if(!(empty($view['keyword']) || (($view['keyword'] instanceof \think\Collection || $view['keyword'] instanceof \think\Paginator ) && $view['keyword']->isEmpty()))): ?> checked <?php endif; ?> name="view" value="keyword" title="触发关键词" >
            <input type="radio" <?php if(!(empty($view['addon']) || (($view['addon'] instanceof \think\Collection || $view['addon'] instanceof \think\Paginator ) && $view['addon']->isEmpty()))): ?> checked <?php endif; ?> name="view" value="addon" title="触发应用">
        </div>
    </div>
    <div id="tapNodeview">
        <div class="layui-tab-content view">
            <div class=" image_text layui-tab-item <?php if($view['event'] == 'nocol'): ?> layui-show <?php endif; ?>">
                <div class="layui-form-item layui-form-text">
                </div>
            </div>
            <div class="view_keyword layui-tab-item <?php if(!(empty($view['keyword']) || (($view['keyword'] instanceof \think\Collection || $view['keyword'] instanceof \think\Paginator ) && $view['keyword']->isEmpty()))): ?> layui-show <?php endif; ?>">
                <div class="layui-form-item">
                    <label class="layui-form-label"></label>
                    <div class="layui-input-block">
                        <input type="text" name="view_keyword" value="<?php echo $view['keyword']; ?>" placeholder="请输入关键词" autocomplete="off" class="layui-input">
                    </div>
                </div>
            </div>
            <div class="view_addon layui-tab-item <?php if(!(empty($view['addon']) || (($view['addon'] instanceof \think\Collection || $view['addon'] instanceof \think\Paginator ) && $view['addon']->isEmpty()))): ?> layui-show <?php endif; ?>">
                <div class="layui-form-item">
                    <label class="layui-form-label"></label>
                    <div class="layui-input-block">
                        <select name="view_addons">
                            <option value="">请选择应用</option>
                            <?php if(is_array($addons) || $addons instanceof \think\Collection || $addons instanceof \think\Paginator): $i = 0; $__LIST__ = $addons;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?>
                            <option <?php if($view['addon'] == $v['addon']): ?> selected <?php endif; ?> value="<?php echo $v['addon']; ?>"><?php echo $v['name']; ?></option>
                            <?php endforeach; endif; else: echo "" ;endif; ?>
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="layui-form-item">
        <div class="layui-input-block">
            <button class="layui-btn" lay-submit lay-filter="formDemo">立即提交</button>
            <button type="reset" class="layui-btn layui-btn-primary">重置</button>
        </div>
    </div>
</form>

<script>
    $(function () {
        $("#replyType_subscribe").click(function(){
            var class_a='subscribe_'+ $("input[name='subscribe']:checked").val();
            $('.subscribe div').removeClass('layui-show')
            $('.'+class_a).addClass('layui-show')
        });
        $("#replyType_unsubscribe").click(function(){
            var class_a='unsubscribe_'+ $("input[name='unsubscribe']:checked").val();
            $('.unsubscribe div').removeClass('layui-show')
            $('.'+class_a).addClass('layui-show')
        });
        $("#replyType_image").click(function(){
            var class_a='image_'+ $("input[name='image']:checked").val();
            $('.image div').removeClass('layui-show')
            $('.'+class_a).addClass('layui-show')
        });
        $("#replyType_voice").click(function(){
            var class_a='voice_'+ $("input[name='voice']:checked").val();
            $('.voice div').removeClass('layui-show')
            $('.'+class_a).addClass('layui-show')
        });
        $("#replyType_video").click(function(){
            var class_a='video_'+ $("input[name='video']:checked").val();
            $('.video div').removeClass('layui-show')
            $('.'+class_a).addClass('layui-show')
        });
        $("#replyType_shortvideo").click(function(){
            var class_a='shortvideo_'+ $("input[name='shortvideo']:checked").val();
            $('.shortvideo div').removeClass('layui-show')
            $('.'+class_a).addClass('layui-show')
        });
        $("#replyType_location").click(function(){
            var class_a='location_'+ $("input[name='location']:checked").val();
            $('.location div').removeClass('layui-show')
            $('.'+class_a).addClass('layui-show')
        });
        $("#replyType_event_location").click(function(){
            var class_a='event_location_'+ $("input[name='event_location']:checked").val();
            $('.event_location div').removeClass('layui-show')
            $('.'+class_a).addClass('layui-show')
        });
        $("#replyType_link").click(function(){
            var class_a='link_'+ $("input[name='link']:checked").val();
            $('.link div').removeClass('layui-show')
            $('.'+class_a).addClass('layui-show')
        });
        $("#replyType_view").click(function(){
            var class_a='view_'+ $("input[name='view']:checked").val();
            $('.view div').removeClass('layui-show')
            $('.'+class_a).addClass('layui-show')
        });
    })
    //Demo
    layui.use('form', function(){
        var form = layui.form;
        //监听提交
        form.on('submit(formDemo)', function(data){
            $.post('',data.field,function (res) {
                if(res.status=='0'){
                    layer.msg(res.msg);
                }
                if(res.status=='1'){
                    layer.msg(res.msg);

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