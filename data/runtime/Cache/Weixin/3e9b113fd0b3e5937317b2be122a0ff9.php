<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<!-- Set render engine for 360 browser -->
	<meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- HTML5 shim for IE8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <![endif]-->

	<link href="/public/simpleboot/themes/<?php echo C('SP_ADMIN_STYLE');?>/theme.min.css" rel="stylesheet">
    <link href="/public/simpleboot/css/simplebootadmin.css" rel="stylesheet">
    <link href="/public/js/artDialog/skins/default.css" rel="stylesheet" />
    <link href="/public/simpleboot/font-awesome/4.4.0/css/font-awesome.min.css"  rel="stylesheet" type="text/css">
    <style>
		.length_3{width: 180px;}
		form .input-order{margin-bottom: 0px;padding:3px;width:40px;}
		.table-actions{margin-top: 5px; margin-bottom: 5px;padding:0px;}
		.table-list{margin-bottom: 0px;}
	</style>
	<!--[if IE 7]>
	<link rel="stylesheet" href="/public/simpleboot/font-awesome/4.4.0/css/font-awesome-ie7.min.css">
	<![endif]-->
<script type="text/javascript">
//全局变量
var GV = {
    DIMAUB: "/",
    JS_ROOT: "public/js/",
    TOKEN: ""
};
</script>
<!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="/public/js/jquery.js"></script>
    <script src="/public/js/wind.js"></script>
    <script src="/public/simpleboot/bootstrap/js/bootstrap.min.js"></script>
<?php if(APP_DEBUG): ?><style>
		#think_page_trace_open{
			z-index:9999;
		}
	</style><?php endif; ?>
</head>
<body>
    <div class="wrap js-check-wrap">
        <ul class="nav nav-tabs">
            <li class="active"><a href="javascript:;">微信用户列表</a></li>
        </ul>
        <form class="well form-search" method="post" action="<?php echo U('Weixin/Indexadmin/usersList');?> " style="width:85%;float:left;">
            性别：
            <select class="select_2" name="sex">
                <option value="">全部</option>
                <option value="1">男</option>
                <option value="2">女</option>
                <option value="0">保密</option>
            </select>
            黑名单：
            <select class="select_2" name="isblack">
                <option value="">全部</option>
                <option value="1">黑名单</option>
                <option value="0">开启</option>
            </select>
            昵称：
            <input type="text" name="nickname" style="width: 200px;" placeholder="请输入昵称...">

            <input type="submit" class="btn btn-primary" value="搜索" />
            
        </form>
        <a class="well form-search" href = "<?php echo U('Weixin/Indexadmin/getUsers',array('next_openid'=>$next_openid));?>" style="margin-left:1%;width:8%;float:left;"><button>更新用户</button></a>
        <form class="js-ajax-form" action="" method="post">
            <div class="table-actions">
                <button class="btn btn-primary btn-small js-ajax-submit" type="submit" data-action="<?php echo U('Indexadmin/batchBlack',array('type'=>1));?>" data-subcheck="true" data-msg="你确定拉黑吗？">拉黑</button>
                <button class="btn btn-primary btn-small js-ajax-submit" type="submit" data-action="<?php echo U('Indexadmin/batchBlack');?>" data-subcheck="true" data-msg="你确定取消拉黑吗？">取消拉黑</button>
            </div>
            <table class="table table-hover table-bordered">
                <thead>
                    <tr>
                        <th width="15"><label><input type="checkbox" class="js-check-all" data-direction="x" data-checklist="js-check-x"></label></th>
                        <th width="50">ID</th>
                        <th>用户昵称</th>
                        <th>用户头像</th>
                        <th>用户性别</th>
                        <th>用户备注</th>
                        <th>所在地区</th>
                        <th>关注状态</th>
                        <th>拉黑状态</th>
                        <th>关注时间</th>
                        <th>注册时间</th>
                        <th width="260">操作</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(is_array($lists)): foreach($lists as $key=>$vo): ?><tr>
                        <td><input type="checkbox" class="js-check" data-yid="js-check-y" data-xid="js-check-x" name="ids[]" value="<?php echo ($vo["openid"]); ?>" title="OPENID:<?php echo ($vo["openid"]); ?>"></td>
                        <td><?php echo ($vo["id"]); ?></td>
                        <td><?php echo ($vo["nickname"]); ?></td>
                        <td><img src="<?php echo ($vo['headimgurl']); ?>" width="50" height="45" class="img-circle"></td>
                        <td><?php echo ($vo['sex'] == 1 ? '男':''); echo ($vo['sex'] == 2 ? '女':''); echo ($vo['sex'] == 0 ? '保密':''); ?></td>
                        <td><?php echo ($vo["remark"]); ?></td>
                        <td><?php echo ($vo['country']); ?>-<?php echo ($vo['province']); ?>-<?php echo ($vo['city']); ?></td>
                        <td><?php echo ($vo['subscribe'] == 1 ? '关注':''); echo ($vo['subscribe'] == 0 ? '未关注':''); ?></td>
                        <td><?php echo ($vo['isblack'] == 1 ? '拉黑':''); echo ($vo['isblack'] == 0 ? '开启':''); ?></td>
                        <td><?php echo (date("Y-m-d H:i",$vo['subscribe_time'] )); ?></td>
                        <td><?php echo (date("Y-m-d H:i",$vo['createtime'] )); ?></td>
                        <td>
                            <a href='<?php echo U("Indexadmin/batchBlack",array("openid"=>$vo["openid"],"type"=>1));?>' class="btn btn-danger">拉黑</a>
                            <a href='<?php echo U("Indexadmin/batchBlack",array("openid"=>$vo["openid"]));?>' class="btn btn-danger">取消拉黑</a>
                            <button class="btn btn-primary" id="label" onclick="setRemark('<?php echo ($vo["openid"]); ?>')">修改备注</button>
                        </td>
                    </tr><?php endforeach; endif; ?>
                </tbody>
            </table>
            <div class="pagination"><?php echo ($page); ?></div>
        </form>
    </div>

    <script src="/public/js/common.js"></script>
    <script src="/public/js/layer/layer-min.js"></script>
</body>
</html>
<script type="text/javascript">
    function setRemark(openid){
        if(openid){
            var index = layer.open({
                content:'<form class="well form-search" method="post" action="<?php echo U("Weixin/Indexadmin/setRemark");?>">备注：<input type="text" name="remark"><input type="hidden" value="'+openid+'" name="openid"><br/><button class="btn btn-primary" style="margin: 20px 0px 0px 200px">提交</button></form>'
            });
        }
    };
    $('.forbid').click(function(event) {
        var href = $(this).attr('href');

        $.get(href, function(data) {
            if (data.state === 'success') {
                //修改成功，刷新页面
                if (data.referer) {
                    location.href = data.referer;
                } else {
                    reloadPage(window);
                }

            } else {
                alert('删除失败');
            }
        },'json');
        return false;
    });
    $(function() {
        setCookie("refersh_time", 0);
        Wind.use('ajaxForm', 'artDialog', 'iframeTools', function() {
            //批量移动
            $('.js-articles-move').click(function(e) {
                var str = 0;
                var id = tag = '';
                $("input[name='ids[]']").each(function() {
                    if ($(this).attr('checked')) {
                        str = 1;
                        id += tag + $(this).val();
                        tag = ',';
                    }
                });
                if (str == 0) {
                    art.dialog.through({
                        id : 'error',
                        icon : 'error',
                        content : '您没有勾选信息，无法进行操作！',
                        cancelVal : '关闭',
                        cancel : true
                    });
                    return false;
                }
                var $this = $(this);

                var httpurl = "<?php echo U('article/move');?>";

                art.dialog.open(httpurl, {
                    title : "批量移动",
                    width : "80%"
                });
            });
        });
    });
</script>