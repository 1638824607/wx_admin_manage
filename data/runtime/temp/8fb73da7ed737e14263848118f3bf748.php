<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:67:"C:\mywamp\Apache24\htdocs\shen/addons/redPack/view/index/index.html";i:1509527512;}*/ ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=0">
    <meta name="keywords" content="">
    <meta name="description" content="">
    <title></title>
    <script type="text/javascript" src="/public/static/jquery/jquery-1.11.0.min.js"></script>
    <script type="text/javascript" src="/public/static/layui/layui.js"></script>
    <link rel="stylesheet" type="text/css" href="/public/static/layui/css/layui.css" />
</head>
<body>
<div style="padding: 0px 10px 0px 10px;">
    当前红包活动总共发出<?php echo $record['total_record']; ?>份红包，红包总额为<?php echo $record['total_money']; ?>元。
    <a onclick="delRedPack()" class="layui-btn layui-btn-small layui-btn-normal"> 设为过去活动</a>
    <hr>
    <div class="layui-tab layui-tab-brief" lay-filter="docDemoTabBrief">
        <ul class="layui-tab-title">
            <a href="<?php echo addonUrl('index/index',['status'=>'1']); ?>"><li <?php if($status == '1'): ?>class="layui-this"<?php endif; ?>>当前活动</li></a>
            <a href="<?php echo addonUrl('index/index',['status'=>'0']); ?>"><li <?php if($status == '0'): ?>class="layui-this"<?php endif; ?>>过去活动</li></a>
        </ul>
    </div>
    <table class="layui-table" lay-skin="nob" lay-size="sm">
        <thead>
        <tr>
            <th>呢称</th>
            <th>头像</th>
            <th>金额</th>
            <th>领取时间</th>
        </tr>
        </thead>
        <tbody>
        <?php if(is_array($data) || $data instanceof \think\Collection || $data instanceof \think\Paginator): $i = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
        <tr>
            <td><?php echo $vo['nickname']; ?></td>
            <td><img src="<?php echo $vo['headimgurl']; ?>" style="width: 28px;height: 28px; border-radius: 3px;"></td>
            <td><?php echo $vo['money']; ?></td>
            <td><?php echo $vo['create_time']; ?></td>
        </tr>
        <?php endforeach; endif; else: echo "" ;endif; ?>
        </tbody>
    </table>
    <?php echo $data->render(); ?>
</div>
<script>
    function delRedPack() {
        layui.use('layer', function(){
            var layer = layui.layer;
            layer.confirm('确定设为过去活动吗？！', {
                btn: ['是','不'], //按钮
                offset: ['15%', '20%'],
                shade: 0.1,
            }, function(){
                $.post("<?php echo addonUrl('index/delRedPack'); ?>",{},function (res) {
                    if(res.status==1){
                        layer.alert(res.msg,function (index) {
                            window.location.reload();
                            layer.close(index);
                        })

                    }else{
                        layer.alert(res.msg)
                    }
                })
            }, function(){

            });
        });

    }
</script>
</body>
</html>