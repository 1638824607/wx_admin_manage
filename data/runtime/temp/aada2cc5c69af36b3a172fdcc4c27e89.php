<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:67:"C:\mywamp\Apache24\htdocs\shen/addons/touPiao/view/admin/index.html";i:1509527512;}*/ ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <script type="text/javascript" src="__STATIC__/jquery/jquery-1.11.0.min.js"></script>
    <script type="text/javascript" src="__STATIC__/layui/layui.js"></script>
    <link rel="stylesheet" type="text/css" href="__STATIC__/layui/css/layui.css" />
    <link rel="stylesheet" type="text/css" href="__ADDONSTATIC__/css/style.css" />
</head>
<?php if(isMobile() == true): ?>
<style>
    .layui-btn{margin-bottom: 5px;}
</style>
<script>
    $(function () {
        $('.vote_time').remove();
        $('.bm_id').remove();
    })
</script>
<?php endif; ?>
<body style="padding: 0px 10px;">
<table class="layui-table" lay-skin="nob" lay-size="sm">
    <thead>
    <tr>
        <th class="bm_id">编号</th>
        <th>呢称</th>
        <th>电话</th>
        <th>封面</th>
        <th>票量</th>
        <th class="vote_time">时间</th>
        <th>操作</th>
    </tr>
    </thead>
    <tbody>
    <?php if(is_array($data) || $data instanceof \think\Collection || $data instanceof \think\Paginator): $i = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
    <tr>
        <td class="bm_id"><?php echo $vo['bm_id']; ?></td>
        <td><?php echo $vo['username']; ?></td>
        <td><?php echo $vo['phone']; ?></td>
        <td><img class="vote_list_cover" onclick="openImsg(this)" src="<?php echo $vo['cover']; ?>"></td>
        <td><?php echo $vo['vote_total']; ?></td>
        <td class="vote_time"><?php echo date('d H:i',strtotime($vo['create_time'])); ?></td>
        <td>
            <?php if($vo['status'] == '0'): ?>
            <button onclick="voteHidden('<?php echo $vo['bm_id']; ?>','1')" class="layui-btn layui-btn-mini layui-btn-danger" href="">显示</button>
            <?php else: ?>
            <button onclick="voteHidden('<?php echo $vo['bm_id']; ?>','0')" class="layui-btn layui-btn-mini layui-btn-danger" href="">隐藏</button>
            <?php endif; ?>

            <button onclick="voteSetinc('<?php echo $vo['bm_id']; ?>')" class="layui-btn layui-btn-mini layui-btn-normal" href="">增票</button>
        </td>
    </tr>
    <?php endforeach; endif; else: echo "" ;endif; ?>
    </tbody>
</table>
<?php echo $data->render(); ?>
</body>
<script>
    var layer;
    layui.use('layer',function () {
        layer = layui.layer;
    })
    function voteHidden(id,status) {
        $.post("<?php echo addonUrl('voteHidden'); ?>",{'id':id,'status':status},function (res) {
            layer.msg(res.msg)
        })
    }
    function voteSetinc(id) {
        layer.prompt({title: '请输入增加票数', formType: 0,value:1}, function(vote, index){
            $.post("<?php echo addonUrl('voteSetinc'); ?>",{'id':id,'vote':vote},function (res) {
                layer.close(index)
                layer.msg(res.msg)
            })
        });
    }
    function openImsg(obj) {
        var data={
            "title": "图片",
            "id": 1,
            "start": 0,
            "data": [
                {
                    "alt": "图片",
                    "pid": 666,
                    "src": obj.src,
                    "thumb": obj.src
                }
            ]
        }
        layer.photos({
            photos: data,
        });
    }
</script>
</html>