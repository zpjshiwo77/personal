<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta charset="utf-8">
	<title>技术博客-柒柒的个人空间</title>
	<link rel="Shortcut Icon" href="../img/logo.png" type="image/x-icon">
	<meta name="keywords" content="">
	<meta name="description" content="">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<link rel="stylesheet" type="text/css"  href="../publiccss/bootstrap.min.css">
	<link rel="stylesheet" type="text/css"  href="../publiccss/bootstrap-theme.min.css">
	<link rel="stylesheet" type="text/css"  href="css/blog.css">
	<link rel="stylesheet" type="text/css"  href="../css/public.css">
	<script src="../publicjs/jquery-2.1.4.min.js"></script>
	<script src="../publicjs/bootstrap.min.js"></script>
</head>
<body>
	<?php 
    include '../public/head.html';
	?>
	<div class="background">
		<div class="blog-content">
			<?php 
    		include 'public/left.html';
			?>
			<div class="blog-right">
				<div style="width:900px;margin:60px 0 0 100px;" id="article">
					<div class="message-title">
						<div class="titile-word" style="font-family:'微软雅黑'"><span class="icons" style="margin:13px 15px; background-position:-95px 0px;"></span></div>
						<div class="titile-word2"></div>
					</div>
					<div class="blog-article-content">
						<p>因为项目需要，做了一个老虎机，但功能和实现方面都不怎么样。后来在白叔的做的老虎机的启发下，重新修改了做法，并集成了一个插件以后方便调用。</p>
						<p>老虎机截图：</p>
						<p><img src="img/1/1-07/1.png"></p>
						<p>html结构：</p>
						<p><img src="img/1/1-07/2.png"></p>
						<p>li标签为老虎机的奖项，可以设置多个（建议三个以上）</p>
						<p>调用方法：</p>
						<p>首先new一个对象：<span style="color:#D9534F;">var islot = new slot();</span></p>
						<p>一共提供四个方法：</p>
						<p><span style="color:#D9534F;">.init(ele)  初始化插件</span> 参数 ele 为老虎机插件的jquery元素</p>
						<p><span style="color:#D9534F;">.slotBegin(speed)  老虎机转动开始的方法</span> 参数 speed: 老虎机最大移动速度，范围 1 - 无穷，建议20左右效果比较好</p>
						<p><span style="color:#D9534F;">.slotEnd(award,callback)  老虎机停止转动发方法</span> 参数 award: 中的奖，0代表未中奖，1代表中第一个元素的奖品（依次推类，不能超过奖项总数）;callback: 动画停止后的回调函数</p>
						<p><span style="color:#D9534F;">.resetSlot()  重置老虎机的方法</span> 每进行过一次老虎机，需要接着转动，需要执行此方法</p>
						<p>插件演示地址：</p>
						<p><a href="http://seventh77.com/slot" target="_blank">http://seventh77.com/slot</a></p>
						<p>gitHub地址：</p>
						<p><a href="https://github.com/zpjshiwo77/SlotMachine" target="_blank">https://github.com/zpjshiwo77/SlotMachine</a></p>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php 
    include '../public/footer.html';
	?>
	</div>
</body>
<script type="text/javascript">
var article={
	status:'原创',
	title:'老虎机插件',
	content:'',
	name:'柒柒',
	time:'2016-12-27',
};
(function(){
	$("title").html(article.title);
	$(".message-title .titile-word span").after(article.title);
	$(".message-title .titile-word2").html(article.name+"&nbsp&nbsp&nbsp"+article.time);
	// $(".blog-article-content").html(article.content);
}());
</script>
</html>