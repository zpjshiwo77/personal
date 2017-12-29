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
	<link rel="stylesheet" type="text/css"  href="js/plugs/highlight/styles/rainbow.css">
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
			<!-- 右侧导航部分 start -->
			<div class="blog-left">
				<div class="blog-x">
					<img src="img/blogLogo.png">
				</div>
				<div style="width:100%;height:500px;background:rgb(51,51,51);position: relative;z-index: 11;">
					<ul id="classBox">
					</ul>
				</div>
			</div>
			<!-- 右侧导航部分 end -->

			<!-- 回到顶部 start -->
			<div id="back-to-top" class="box-shadow" onclick="backtop();"><b style="font-size:18px">↑</b><br>top</div>
			<!-- 回到顶部 end -->

			<!-- 左侧内容部分 start -->
			<div class="blog-right">
				<div style="width:900px;margin:60px 0 0 100px;" id="article">
					<div class="message-title">
						<div class="titile-word" style="font-family:'微软雅黑'"><span class="icons" style="margin:13px 15px; background-position:-95px 0px;"></span><b></b></div>
						<div class="titile-word2"></div>
					</div>
					<div class="blog-article-content" id="content">
						
					</div>
				</div>
			</div>
			<!-- 左侧内容部分 start -->
		</div>
	</div>
	<?php 
    include '../public/footer.html';
	?>
	</div>
</body>
<script src="js/plugs/highlight/highlight.pack.js"></script>
<script src="../publicjs/public.js"></script>
<script src="js/blog.js"></script>
</html>