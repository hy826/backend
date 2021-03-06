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
	<div class="wrap">
		<ul class="nav nav-tabs">
			<li><a href="<?php echo U('Indexadmin/news');?>">关注推送列表</a></li>
			<li class="active"><a href="<?php echo U('Indexadmin/add_news');?>" target="_self">添加关注推送</a></li>
		</ul>
		<form method="post" class="form-horizontal js-ajax-form" action="<?php echo U('Weixin/Indexadmin/add_news_post');?>">
			<fieldset>
				<div class="control-group">
					<label class="control-label">关键字：</label>
					<div class="controls">
						<select name="keyword">
							<?php echo ($option); ?>
						</select>
						<span class="form-required">请选择关键字</span>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label">资源：</label>
					<div class="controls">
						<a class="btn btn-primary btn-sm" onclick="selectImg()"><?php echo L('选择');?></a>
					</div>
				</div>
			</fieldset>
			<div class="form-actions">
				<input type="hidden" id="img_id" name="img_id">
				<button type="submit" class="btn btn-primary js-ajax-submit"><?php echo L('ADD');?></button>
				<a class="btn" href="<?php echo U('Indexadmin/concern');?>"><?php echo L('BACK');?></a>
			</div>
		</form>
		<div class="col-lg-3">
			<!-- small box -->
			<div class="small-box bg-aqua" style="border: solid 1px saddlebrown;word-break: break-all">

				<div class="inner" style="text-align: center">
					<img src="/0.jpg" id="first-img" width="300" height="150" alt="">
				</div>
				<div class="icon">
					<i class="ion ion-bag"></i>
				</div>
				<a class="small-box-footer" id="first-text" href="#">这里是标题呢</a>

			</div>

		</div>
	</div>
	<link rel="stylesheet" href="/public/js/layer/skin/layer.css" id="layui_layer_skinlayercss">
	<script src="/public/js/layer/layer-min.js"></script>
	<script type="text/javascript" src="/public/js/common.js"></script>
	<script type="text/javascript">

		function selectImg(){
			layer.open({
				type: 2,
				title: '添加资源',
				shadeClose: true,
				shade: 0.8,
				area: ['60%', '60%'],
				content: '<?php echo U("Indexadmin/select");?>', //iframe的url
			})	;
		}

		function selected(img,title,id){
			var selected = $('input[name="img_id"]').val();
			var s = selected.split(',');
			s.pop();
			if($.inArray(id,s) != -1){
				layer.alert('已经存在', {icon: 2});  //alert(alert("已经存在");
				return;
			}
			//判断是否第一条
			var img_id = $('input[name="img_id"]').val();
			if(!img_id){
				$('#first-img').attr('src',img);
				$('#first-text').text(title);
				$('input[name="img_id"]').val(id+',');
			}else{
				var tpl = '';
				tpl = '<div class="inner" style="height: 70px;border:solid 1px saddlebrown">';
				tpl +='<div class="pull-right">';
				tpl = tpl + '<img src="'+img+'" alt="" width="50" height="50">';
				tpl +='</div>';
				tpl = tpl + '<p>'+title+'</p>';
				tpl +='</div>';
				$('.bg-aqua').append(tpl);
				$('input[name="img_id"]').val(img_id+id+',');

			}
			layer.closeAll();
		}
	</script>
</body>
</html>