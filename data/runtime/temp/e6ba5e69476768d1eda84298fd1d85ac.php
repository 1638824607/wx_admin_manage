<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:61:"C:\mywamp\Apache24\htdocs\shen\themes\pc\mp\member\index.html";i:1509527512;s:69:"C:\mywamp\Apache24\htdocs\shen\themes\pc\mp\..\admin\common\base.html";i:1509527512;}*/ ?>
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
        
<div class="layui-tab layui-tab-brief" lay-filter="docDemoTabBrief">
    <ul class="layui-tab-title">
        <!--为了适合大众开发主页、积分、余额、等应该在扩展应用中开发，这样自由扩展使用。-->
        <!--<li <?php if($do == 'page'): ?>class="layui-this"<?php endif; ?>><a href="<?php echo url('mp/Member/index',['do'=>'page']); ?>"> 会员主页</a></li>-->
        <!--<li <?php if($do == 'friend'): ?>class="layui-this"<?php endif; ?>><a href="<?php echo url('mp/Member/index',['do'=>'friend']); ?>"> 会员列表</a></li>-->
        <li <?php if($do == 'group'): ?>class="layui-this"<?php endif; ?>><a href="<?php echo url('mp/Member/index',['do'=>'group']); ?>">会员等级</a></li>
        <!--<li <?php if($do == 'score'): ?>class="layui-this"<?php endif; ?>><a href="<?php echo url('mp/Member/index',['do'=>'score']); ?>">积分管理</a></li>-->
        <!--<li <?php if($do == 'withdrawal'): ?>class="layui-this"<?php endif; ?>><a href="<?php echo url('mp/Member/index',['do'=>'withdrawal']); ?>">会员提现</a></li>-->
        <!--<li <?php if($do == 'balance'): ?>class="layui-this"<?php endif; ?>><a href="<?php echo url('mp/Member/index',['do'=>'balance']); ?>">会员余额</a></li>-->
        <li <?php if($do == 'register'): ?>class="layui-this"<?php endif; ?>><a href="<?php echo url('mp/Member/index',['do'=>'register']); ?>">注册设置</a></li>
    </ul>
    <div class="layui-tab-content">
        <?php switch($do): case "page": ?>
        <blockquote class="site-text layui-elem-quote">
            会员中心地址：<a target="_blank" href="<?php echo $memberUrl; ?>"><?php echo $memberUrl; ?></a>
        </blockquote>
            <?php break; case "friend": ?>
                <table class="layui-table">
                    <colgroup>
                        <col width="150">
                        <col width="200">
                        <col>
                    </colgroup>
                    <thead>
                    <tr>
                        <th>会员ID</th>
                        <th>呢称</th>
                        <th>头像</th>
                        <th>电话</th>
                        <th>等级</th>
                        <th>积分</th>
                        <th>余额</th>
                        <th>注册时间</th>
                        <th>操作</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php if(is_array($data) || $data instanceof \think\Collection || $data instanceof \think\Paginator): $i = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?>
                    <tr>
                        <td><?php echo $v['id']; ?></td>
                        <td><?php echo $v['nickname']; ?></td>
                        <td><img src="<?php echo $v['headimgurl']; ?>" width="30" height="30"></td>
                        <td><?php echo $v['mobile']; ?></td>
                        <td><?php echo $v['group_id']; ?></td>
                        <td><?php echo $v['score']; ?></td>
                        <td><?php echo $v['money']; ?></td>
                        <td><?php echo date("Y-m-d",$v['subscribe_time']); ?></td>
                        <td>
                        <div class="layui-btn-group ">
                            <button class="layui-btn layui-btn-small layui-btn-danger">禁用</button>
                            <button class="layui-btn layui-btn-small">配置</button>
                        </div>
                        </td>
                    </tr>
                    <?php endforeach; endif; else: echo "" ;endif; ?>
                    </tbody>
                </table>
                <?php echo $data->render(); break; case "group": if($to != 'updateGroup'): ?>
                <div class="layui-tab">
                    <ul class="layui-tab-title">
                        <li class="layui-this">会员等级</li>
                        <li>增加等级</li>
                    </ul>
                    <div class="layui-tab-content">
                        <div class="layui-tab-item layui-show">
                            <table class="layui-table">
                                <colgroup>
                                    <col width="">
                                    <col width="100">
                                    <col>
                                    <col>
                                    <col>
                                    <col>
                                    <col>
                                    <col width="110">
                                </colgroup>
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>等级名称</th>
                                    <th>所需积分</th>
                                    <th>所需金额</th>
                                    <th>折扣率</th>
                                    <th>升级条件</th>
                                    <th>描述</th>
                                    <th>操作</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php if(is_array($data) || $data instanceof \think\Collection || $data instanceof \think\Paginator): $i = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?>
                                <tr>
                                    <td><?php echo $v['gid']; ?></td>
                                    <td><?php echo $v['group_name']; ?></td>
                                    <td><?php echo $v['up_score']; ?></td>
                                    <td><?php echo $v['up_money']; ?></td>
                                    <td><?php echo $v['discount']; ?>%</td>
                                    <td><?php if($v['up_type'] == '0'): ?>积分与金额其中一个满足即升级<?php endif; if($v['up_type'] == '1'): ?>积分与金额两者都满足即升级<?php endif; ?></td>
                                    <td><?php echo $v['description']; ?></td>
                                    <td>
                                            <a href="<?php echo url('mp/Member/index',['do'=>'group','to'=>'updateGroup','id'=>$v['gid']]); ?>" class="rha-bt-a">更改</a>
                                            <a href="javascript:;" onclick="delGroup('<?php echo $v['gid']; ?>')" class="rha-bt-a">
                                                删除
                                            </a>
                                    </td>
                                </tr>
                                <?php endforeach; endif; else: echo "" ;endif; ?>
                                </tbody>
                            </table>


                        </div>
                        <div class="layui-tab-item">
                            <form class="layui-form" action="">
                                <div class="layui-form-item">
                                    <label class="layui-form-label">等级名称</label>
                                    <div class="layui-input-block">
                                        <input type="text" name="group_name" required  lay-verify="required" placeholder="请输入等级名称" autocomplete="off" class="layui-input">
                                    </div>
                                </div>
                                <div class="layui-form-item" style="border-top:1px solid #e2e2e2;border-bottom: 1px solid #e2e2e2">
                                    <label class="layui-form-label">升级条件</label>
                                    <div class="layui-input-block" style="margin-left: 76px;">
                                        <div class="layui-form-item">
                                            <label class="layui-form-label layui-word-aux">累计积分满</label>
                                            <div class="layui-input-inline" style="width: 100px;">
                                                <input type="text" name="up_score" value="0" required lay-verify="required" placeholder="请输入密码" autocomplete="off" class="layui-input">
                                            </div>
                                            <div class="layui-form-mid layui-word-aux">分，设置会员等级所需要的累计积分且必须大于等于0</div>
                                        </div>
                                       <div class="layui-form-item">
                                            <label class="layui-form-label layui-word-aux">消费额度满</label>
                                            <div class="layui-input-inline" style="width: 100px;">
                                                <input type="text" name="up_money" value="0" required lay-verify="required" placeholder="请输入密码" autocomplete="off" class="layui-input">
                                            </div>
                                            <div class="layui-form-mid layui-word-aux">元，设置会员等级所需要的消费额度且必须大于等于0</div>
                                       </div>
                                        <div class="layui-form-item">
                                            <label class="layui-form-label layui-word-aux">会员升级条件</label>
                                            <div class="layui-input-inline" style="width: 140px;">
                                                <input type="radio" name="up_type" value="0" title="或">
                                                <input type="radio" name="up_type" value="1" title="且" checked>
                                            </div>
                                            <div class="layui-form-mid layui-word-aux">或：满足一个条件即可升级，且两个条件必须满足才可升级。</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="layui-form-item">
                                    <label class="layui-form-label">折扣率:</label>
                                    <div class="layui-input-block">
                                        <div class="layui-input-inline" style="width: 70px;">
                                            <input type="text"  name="discount" value="98" required lay-verify="required" placeholder="" autocomplete="off" class="layui-input">
                                        </div>
                                        <div class="layui-form-mid layui-word-aux">%</div>
                                    </div>
                                </div>
                                <div class="layui-form-item layui-form-text">
                                    <label class="layui-form-label">描述</label>
                                    <div class="layui-input-block">
                                        <textarea name="description" placeholder="请输入会员描述" class="layui-textarea"></textarea>
                                    </div>
                                </div>
                                <div class="layui-form-item">
                                    <div class="layui-input-block">
                                        <button class="layui-btn" lay-submit lay-filter="formDemo">立即提交</button>
                                        <button type="reset" class="layui-btn layui-btn-primary">重置</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
        <script>
            layui.use('form', function(){
                var form = layui.form;
                form.on('submit(formDemo)', function(data){
                    $.post("<?php echo url('mp/Member/addGroup'); ?>",data.field,function (res) {
                        if(res.status==1){
                            layer.msg(res.msg,{time:1000},function () {
                                window.location.href="<?php echo url('mp/Member/index',['do'=>'group']); ?>";
                            });
                        }else{
                            layer.msg(res.msg);
                        }
                    })
                    return false;
                });
            });
            function delGroup(gid) {
                layui.use('layer', function(){
                    var layer = layui.layer;
                    layer.confirm('你确定需要删除吗？', {
                        btn: ['是','不'] //按钮
                    }, function(){
                        $.post("<?php echo url('mp/Member/delGroup'); ?>",{'gid':gid},function (res) {
                            if(res.status==1){
                                layer.msg(res.msg,{time:1000},function () {
                                    window.location.href="<?php echo url('mp/Member/index',['do'=>'group']); ?>";
                                });
                            }else{
                                layer.msg(res.msg);
                            }
                        })
                    }, function(){

                    });
                });
            }
        </script>
                <?php elseif($to == 'updateGroup'): ?>
                    <br>
                    <form class="layui-form" action="">
                        <div class="layui-form-item">
                            <label class="layui-form-label">等级名称</label>
                            <div class="layui-input-block">
                                <input type="text" name="group_name" value="<?php echo $group['group_name']; ?>" required  lay-verify="required" placeholder="请输入等级名称" autocomplete="off" class="layui-input">
                            </div>
                        </div>
                        <div class="layui-form-item" style="border-top:1px solid #e2e2e2;border-bottom: 1px solid #e2e2e2">
                            <label class="layui-form-label">升级条件</label>
                            <div class="layui-input-block" style="margin-left: 76px;">
                                <div class="layui-form-item">
                                    <label class="layui-form-label layui-word-aux">累计积分满</label>
                                    <div class="layui-input-inline" style="width: 100px;">
                                        <input type="text" name="up_score" value="<?php echo $group['up_score']; ?>" required lay-verify="required" placeholder="请输入密码" autocomplete="off" class="layui-input">
                                    </div>
                                    <div class="layui-form-mid layui-word-aux">分，设置会员等级所需要的累计积分且必须大于等于0</div>
                                </div>
                                <div class="layui-form-item">
                                    <label class="layui-form-label layui-word-aux">消费额度满</label>
                                    <div class="layui-input-inline" style="width: 100px;">
                                        <input type="text" name="up_money" value="<?php echo $group['up_money']; ?>" required lay-verify="required" placeholder="请输入密码" autocomplete="off" class="layui-input">
                                    </div>
                                    <div class="layui-form-mid layui-word-aux">元，设置会员等级所需要的消费额度且必须大于等于0</div>
                                </div>
                                <div class="layui-form-item">
                                    <label class="layui-form-label layui-word-aux">会员升级条件</label>
                                    <div class="layui-input-inline" style="width: 140px;">
                                        <input type="radio" <?php if($group['up_type'] == '0'): ?>checked<?php endif; ?> name="up_type" value="0" title="或">
                                        <input type="radio" <?php if($group['up_type'] == '1'): ?>checked<?php endif; ?> name="up_type" value="1" title="且" >
                                    </div>
                                    <div class="layui-form-mid layui-word-aux">或：满足一个条件即可升级，且两个条件必须满足才可升级。</div>
                                </div>
                            </div>
                        </div>
                        <div class="layui-form-item">
                            <label class="layui-form-label">折扣率:</label>
                            <div class="layui-input-block">
                                <div class="layui-input-inline" style="width: 70px;">
                                    <input type="text"  name="discount" value="<?php echo $group['discount']; ?>" required lay-verify="required" placeholder="" autocomplete="off" class="layui-input">
                                </div>
                                <div class="layui-form-mid layui-word-aux">%</div>
                            </div>
                        </div>
                        <div class="layui-form-item layui-form-text">
                            <label class="layui-form-label">描述</label>
                            <div class="layui-input-block">
                                <textarea name="description" placeholder="请输入会员描述" class="layui-textarea"><?php echo $group['description']; ?></textarea>
                            </div>
                        </div>
                        <div class="layui-form-item">

                            <div class="layui-input-block">
                                <input type="hidden" name="gid" value="<?php echo $group['gid']; ?>">
                                <button class="layui-btn" lay-submit lay-filter="formDemo">立即提交</button>
                                <button type="reset" class="layui-btn layui-btn-primary">重置</button>
                            </div>
                        </div>
                    </form>
                    <script>
                        layui.use('form', function(){
                            var form = layui.form;
                            form.on('submit(formDemo)', function(data){
                                $.post("<?php echo url('mp/Member/updateGroup'); ?>",data.field,function (res) {
                                    if(res.status==1){
                                        layer.msg(res.msg,{time:1000},function () {
                                            window.location.href="<?php echo url('mp/Member/index',['do'=>'group']); ?>";
                                        });
                                    }else{
                                        layer.msg(res.msg);
                                    }
                                })
                                return false;
                            });
                        });
                    </script>
                <?php endif; break; case "register": ?>
        <form class="layui-form" action="">
            <div class="layui-form-item">
                <label class="layui-form-label">注册设置</label>
                <div class="layui-input-block">
                    <!--<input type="radio" <?php if($st['register_type'] == '1'): ?>checked <?php endif; ?> name="register_type" value="1" title="手机号注册">-->
                    <div id="login_auto">
                        <input type="radio" <?php if($st['register_type'] == '3'): ?>checked <?php endif; ?> checked name="register_type" value="3" title="回复注册|登录" >
                        <input  type="radio" <?php if($st['register_type'] == '2'): ?>checked <?php endif; ?> name="register_type" value="2" title="系统自动注册" >
                    </div>
                    <div id="registerType" <?php if($st['register_type'] == '2'): ?> style="display: none" <?php endif; ?> >
                        <p class="tip_for_p">注：没有认证的公众号，请选择回复登录|注册，系统自动注册需要认证公众号可用，已经认证公众号建议选择系统自动注册。<br>
                        若选择回复注册，必须要填写你的关键词。保存成功后也可以在菜单设置中配置此关键词方可注册或者登录。
                        </p><br>
                        <div class="layui-form-item" style="width: 560px;">
                            <label class="layui-form-label">关键词*</label>
                            <div class="layui-input-block">
                                <input type="text" name="keyword" placeholder="请输入关键词" value="<?php echo $st['keyword']; ?>" autocomplete="off" class="layui-input">
                            </div>
                        </div>
                        <div class="layui-form-item">
                            <label class="layui-form-label">封面图*</label>
                            <div class="layui-input-block">
                                <?php echo hook('Upload',['type'=>'image','name'=>'picurl','material'=>true,'value'=>$st['picurl']]); ?>
                            </div>
                        </div>

                    <div class="layui-form-item">
                        <label class="layui-form-label">设置密码</label>
                        <div class="layui-input-block">
                            <input type="radio" name="ispwd" value="1" title="是" checked <?php if($st['ispwd'] == '1'): ?>checked <?php endif; ?>>
                            <input type="radio" name="ispwd" value="0" title="否" <?php if($st['ispwd'] == '0'): ?>checked <?php endif; ?>>
                            <p class="tip_for_p">设为“是”那么需要密码登录,设为“否”侧反。</p>
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label">跳转地址*</label>
                        <div class="layui-input-block">
                            <input type="text" name="redirect_url" placeholder="请输入址址"  value="<?php echo $st['redirect_url']; ?>" autocomplete="off" class="layui-input">
                            <p class="tip_for_p">注册|登录后跳转的地址；如：http://www.rhaphp.com/</p>
                        </div>
                    </div>
                    </div>
                </div>

            <div class="layui-form-item">
                <label class="layui-form-label">验证手机</label>
                <div class="layui-input-block">
                    <input type="radio" name="verify" value="1" title="是" checked <?php if($st['verify'] == '1'): ?>checked <?php endif; ?>>
                    <input type="radio" name="verify" value="0" title="否" <?php if($st['verify'] == '0'): ?>checked <?php endif; ?>>
                    <p class="tip_for_p">注：若要验证手机号请先配置短信发送所需参数。</p>
                </div>
            </div>
            <div class="layui-form-item" style="border-top:1px solid #e2e2e2;border-bottom: 1px solid #e2e2e2">
                <label class="layui-form-label">注册福利</label>
                <div class="layui-input-block" style="margin-left: 76px;">
                    <div class="layui-form-item">
                        <label class="layui-form-label layui-word-aux">会员注册送</label>
                        <div class="layui-input-inline" style="width: 100px;">
                            <input type="text" name="up_score" value="<?php echo $st['up_score']; ?>" required lay-verify="required" placeholder="" autocomplete="off" class="layui-input">
                        </div>
                        <div class="layui-form-mid layui-word-aux">分</div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label layui-word-aux">会员注册送</label>
                        <div class="layui-input-inline" style="width: 100px;">
                            <input type="text" name="up_money" value="<?php echo $st['up_money']; ?>" required lay-verify="required" placeholder="" autocomplete="off" class="layui-input">
                        </div>
                        <div class="layui-form-mid layui-word-aux">元，单位：元</div>
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
                $("#login_auto").click(function(){
                    var values= $("input[name='register_type']:checked").val();
                    if(values ==2){
                        $('#registerType').hide();
                    }else{
                        $('#registerType').show();
                    }
                });
            })
            layui.use('form', function(){
                var form = layui.form;
                form.on('submit(formDemo)', function(data){
                    $.post("<?php echo url('mp/Member/registerConfig'); ?>",data.field,function (res) {
                        if(res.status==1){
                            layer.msg(res.msg,{time:1000},function () {
                               // window.location.href="<?php echo url('mp/Member/index',['do'=>'group']); ?>";
                            });
                        }else{
                            layer.msg(res.msg);
                        }
                    })
                    return false;
                });
            });
        </script>
            <?php break; endswitch; ?>
    </div>
</div>


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