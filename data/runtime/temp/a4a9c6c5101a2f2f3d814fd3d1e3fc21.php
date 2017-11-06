<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:69:"C:\mywamp\Apache24\htdocs\shen\themes\pc\mp\material\getmeterial.html";i:1509527512;}*/ ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <script type="text/javascript" src="__STATIC__/jquery/jquery-1.11.0.min.js"></script>
    <script type="text/javascript" src="__STATIC__/layui/layui.js"></script>
    <link rel="stylesheet" type="text/css" href="__STATIC__/layui/css/layui.css" />
    <link rel="stylesheet" type="text/css" href="__STATIC__/admin/css/global.css" />
    
</head>
<body>
<div style="padding: 10px;">
    <div class="layui-tab">
        <ul class="layui-tab-title">
            <li class="<?php if($from_type == '1'): ?>layui-this<?php endif; ?>"><a href="<?php echo url('mp/Material/getMeterial',['type'=>$type,'param'=>$param,'from_type'=>'1']); ?>">微信服务器</a></li>
            <li class="<?php if($from_type == '0'): ?>layui-this<?php endif; ?>"><a href="<?php echo url('mp/Material/getMeterial',['type'=>$type,'param'=>$param,'from_type'=>'0']); ?>">本地</a></li>
        </ul>
        <div class="layui-tab-content">
            <?php switch($type): case "image": ?>
                    <div class="layui-tab-item layui-show">
                        <ul>
                            <?php if(is_array($material) || $material instanceof \think\Collection || $material instanceof \think\Paginator): $i = 0; $__LIST__ = $material;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?>
                                <li onclick="returnV('<?php echo $v['url']; ?>','<?php echo $param; ?>','image')" style="display: inline-block; width: 120px;cursor:pointer;"><img style="width: 120px;height: 120px;" src="<?php echo $v['url']; ?>"> </li>
                            <?php endforeach; endif; else: echo "" ;endif; ?>
                        </ul>
                    </div>
                <?php break; case "voice": ?>
            <table class="layui-table">
                        <colgroup>
                            <col width="">
                            <col width="200">
                            <col width="70">
                        </colgroup>
                        <thead>
                        <tr>
                            <th>语音名称</th>
                            <th>创建时间</th>
                            <th>操作</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php if(is_array($material) || $material instanceof \think\Collection || $material instanceof \think\Paginator): $i = 0; $__LIST__ = $material;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?>
                        <tr>
                            <td><?php echo $v['title']; ?></td>
                            <td><?php echo $v['create_time']; ?></td>
                            <td style="text-align: center"><button onclick="returnV('<?php echo $v['media_id']; ?>','<?php echo $param; ?>','voice')" class="layui-btn layui-btn-mini">选取</button></td>
                        </tr>
                        <?php endforeach; endif; else: echo "" ;endif; ?>
                        </tbody>
                    </table>
            <?php break; case "video": ?>
            <table class="layui-table">
                <colgroup>
                    <col width="">
                    <col width="200">
                    <col width="70">
                </colgroup>
                <thead>
                <tr>
                    <th>视频名称</th>
                    <th>创建时间</th>
                    <th>操作</th>
                </tr>
                </thead>
                <tbody>
                <?php if(is_array($material) || $material instanceof \think\Collection || $material instanceof \think\Paginator): $i = 0; $__LIST__ = $material;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?>
                <tr>
                    <td><?php echo $v['title']; ?></td>
                    <td><?php echo $v['create_time']; ?></td>
                    <td style="text-align: center"><button onclick="returnV('<?php echo $v['media_id']; ?>','<?php echo $param; ?>','voice')" class="layui-btn layui-btn-mini">选取</button></td>
                </tr>
                <?php endforeach; endif; else: echo "" ;endif; ?>
                </tbody>
            </table>
            <?php break; endswitch; ?>

        </div>
    </div>
    <div class="page">
        <?php echo $page; ?>
    </div>
</div>
<script>
//    layui.use('element', function(){
//        var $ = layui.jquery
//            ,element = layui.element(); //Tab的切换功能，切换事件监听等，需要依赖element模块
//
//        //触发事件
//        var active = {
//            tabChange: function(){
//                //切换到指定Tab项
//                element.tabChange('demo', '22'); //切换到：用户管理
//            }
//        };
//
//        $('.site-demo-active').on('click', function(){
//            var othis = $(this), type = othis.data('type');
//            active[type] ? active[type].call(this, othis) : '';
//        });
//
//        //Hash地址的定位
//        var layid = location.hash.replace(/^#test=/, '');
//        element.tabChange('test', layid);
//
//        element.on('tab(test)', function(elem){
//            location.hash = 'test='+ $(this).attr('lay-id');
//        });
//
//    });
function returnV(value,paramName,type) {
    var index = parent.layer.getFrameIndex(window.name); //获取窗口索引
    parent.parent.controllerByVal(value,paramName,type);
    parent.layer.close(index);
}

</script>
</body>
</html>