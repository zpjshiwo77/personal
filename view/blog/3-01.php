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
						<p>写在前面：</p>
						<p>转载这篇文章是因为之前在做弹窗插件的时候，发现边框用了透明但实际上并没有透明。这里除了介绍如何使边框变透明外，稍微介绍一下 <b>background-clip</b>这个属性。如需要了解更详细的东西请直接阅读原文：<a href="http://bbs.html5cn.org/thread-10516-1-1.html">http://bbs.html5cn.org/thread-10516-1-1.html</a></p>
						<p style="color:rgb(245, 173, 85)">----------------我是分割线-------------------</p>
						<p>CSS3有一个新属性可以解决这个问题！这个属性大名鼎鼎，掷地有声……别介，还是从地上捡起来吧，它叫background-clip，是专门用来指定盒模型中哪一部分显示背景的。别告诉我你不知道盒模型中用于显示背景的范围可以是内容区、内边距区和边框区，这三个区域一个比一个大。这个属性只有三个值，现在要用的话得加上厂商前缀。为了方便，我把三个值都写在一块了，实际上当然只能用一个：</p>
						<p><img src="img/3/3-01/1.jpg"></p>
						<p><img src="img/3/3-01/1.png"></p>
						<p>background-origin:</p>
						<p>如果你只想做个“亮盒”，元素背景多半会是实色。此时，当然不关background-origin属性什么事儿。可是，假如元素背景中有一张图片，那设定背景图片的起点就全靠它了。 这好像跟background-clip无关哪？当然有关。如果把background-clip设定为padding-box（像前面那样），而background-origin仍然是默认的border-box，那图片的外围就会有一圈被裁掉。有时候，这恐怕不是你想要的。对了，光顾说话儿了，上菜上菜。</p>
						<p><img src="img/3/3-01/3.png"></p>
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
	status:'转载',
	title:'亲，这就是透明边框',
	content:'',
	name:'禹司凤',
	time:'2012-12-12',
};
(function(){
	$("title").html(article.title);
	$(".message-title .titile-word span").after(article.title);
	$(".message-title .titile-word2").html(article.name+"&nbsp&nbsp&nbsp"+article.time);
	// $(".blog-article-content").html(article.content);
}());
</script>
</html>