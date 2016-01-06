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
						<p>初学JS，自己尝试着写一些特效。这算是自己学了JS半个月以来第一次完全自己写的，瑕疵也有一点（main只能是正方形，且宽，高度最好是20的倍数，不然会不好看）。喜欢的朋友可以拿去用了~</p>
						<p>一共有三种版本：</p>
						<p>第一种的是方块按对角线消失：</p>
						<p><img src="img/1/1-02/1.jpg"></p>
						<p>第二种是方块按正方形消失：</p>
						<p><img src="img/1/1-02/2.jpg"></p>
						<p>第三种是方块随机消失：</p>
						<p><img src="img/1/1-02/3.jpg"></p>
						<p>附上代码下载地址：</p>
						<p><a href="https://github.com/zpjshiwo77/Pokemon" target="_blank">https://github.com/zpjshiwo77/Pokemon</a></p>
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
	title:'代码分享：宠物小精灵开场特效',
	content:' 初学JS，自己尝试着写一些特效。这算是自己学了JS半个月以来第一次完全自己写的，瑕疵也有一点（main只能是正方形，且宽，高度最好是20的倍数，不然会不好看）。喜欢的朋友可以拿去用了~ 一共有三种版本：第一种的是方块按对角线消失：', 
	name:'柒柒',
	time:'2015-11-09',
};
(function(){
	$("title").html(article.title);
	$(".message-title .titile-word span").after(article.title);
	$(".message-title .titile-word2").html("技术博客-"+article.name+"&nbsp&nbsp&nbsp"+article.time);
	// $(".blog-article-content").html(article.content);
}());
</script>
</html>