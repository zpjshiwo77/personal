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
						<p><img src="img/4/4-01/code.jpg"></p>
						<p>附上原文地址：<a href="http://www.miyay.cn/83.html">http://www.miyay.cn/83.html</a></p>
						<p style="color:rgb(235, 110, 98)">------------------------我是分割线----------------------</p>
						<p>然后我这里在附上自己调用时，用到的东西。</p>
						<p>首先，我只用到了get_music_info("28949444");的方法，该方法的参数是歌曲的ID。这个ID可以通过网易云音乐的Web版去查，只要输入你想要的歌的歌名，进入那首歌以后，你会发现URL里面的结尾处带有一个参数，这个参数就是该歌曲的ID。</p>
						<p>我通过AJAX的请求，传入ID，最后返回的结果是一个JSON数据。这里我也把这个JSON数据分享一下：</p>
						<p><img src="img/4/4-01/song_code.jpg"></p>
						<p>这里我只用到了歌曲资源的url，歌手名，歌曲名和，歌曲图片</p>
						<p>歌曲url：<span style="color:rgb(235, 110, 98)">data.songs[0].mp3Url</span></p>
						<p>歌手名：<span style="color:rgb(235, 110, 98)">data.songs[0].artists[0].name</span></p>
						<p>歌曲名：<span style="color:rgb(235, 110, 98)">data.songs[0].name</span></p>
						<p>歌曲图片：<span style="color:rgb(235, 110, 98)">data.songs[0].album.picUrl</span></p>
						<p>然后稍微提示两点：</p>
						<p>1.注意一下调用格式，不要忽略[0],因为本人开始写成data.songs.mp3Url，所以一直失败。</p>
						<p>2.歌曲的图片和歌手的图片不知道为什么都是默认图片，所以只能用专辑的图片。</p>
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
	title:'网易云音乐常用API浅析',
	content:' ', 
	name:'清风',
	time:'2015-6-09',
};
(function(){
	$("title").html(article.title);
	$(".message-title .titile-word span").after(article.title);
	$(".message-title .titile-word2").html(article.name+"&nbsp&nbsp&nbsp"+article.time);
	// $(".blog-article-content").html(article.content);
}());
</script>
</html>