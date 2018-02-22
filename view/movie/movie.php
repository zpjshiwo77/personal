<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta charset="utf-8">
	<title>电影-柒柒的个人空间</title>
	<link rel="Shortcut Icon" href="../img/logo.png" type="image/x-icon">
	<meta name="keywords" content="">
	<meta name="description" content="">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<link rel="stylesheet" type="text/css"  href="../publiccss/bootstrap.min.css">
	<link rel="stylesheet" type="text/css"  href="../publiccss/bootstrap-theme.min.css">
	<link rel="stylesheet" type="text/css"  href="css/movie.css">
	<link rel="stylesheet" type="text/css"  href="../css/public.css">
	<script src="../publicjs/jquery-2.1.4.min.js"></script>
	<script src="../publicjs/bootstrap.min.js"></script>
</head>
<body>
	<div class="loading">
		<div class="loading-position">
			<div style="height:175px;width:180px;margin:0 auto">
				<img class="loading-ra" src="../img/loading.gif">
			</div>
			<img src="../img/loading02.gif">
		</div>
	</div>
	<?php 
    include '../public/head.html';
	?>
	<div class="wrap">
		<!-- 图片轮播 start-->
		<div class="movie-banner" id="bannerWrap">
			<div class="movie-banner-content">
				<div class="banner-cont swiper-move" id="banner">
					<div class="movie-banner-img" style="left:0px"><img src="img/amaze.jpg"></div>
				</div>
			</div>
			<!-- 轮播遮罩 start -->
			<div class="movie-banner-mask">
				<div class="movie-mask-left"></div>
				<div class="movie-mask-center">
					<div class="movie-banner-introduce swiper-word">
						<h1></h1>
						<p></p>
						<a href="../comesoon.html" class="movie-banner-btn box-shadow" target="_blank"><span>KNOW MORE</span></a>
					</div>
				</div>
				<div class="movie-mask-right"></div>
				<div class="movie-banner-next">
					<div class="movie-banner-next-R">〉</div>
					<div style="height: 80px; width: 35px; position: absolute; z-index: 101; top:120px;"></div>
				</div>
			</div>
			<!-- 轮播遮罩 end -->
		</div>
		<!-- 图片轮播 end -->
		<div class="background" style="background-color:rgb(50, 184, 176)">
			<div class="movie-contents" id="movieCont">
				<div class="movie-contents-layout" style="margin-left:0px;"></div>
				<div class="movie-contents-layout"></div>
				<div class="movie-contents-layout"></div>
				<div class="movie-contents-layout"></div>
				<div class="movie-contents-layout"></div>
				<div class="movie-tips">正在加载，请稍等......</div>
				<div style="height:10px;width:100%;clear:both"></div>
			</div>
		</div>
	</div>
	<?php 
    include '../public/footer.html';
	?>
	<div id="back-to-top" class="box-shadow" onclick="backtop();"><b style="font-size:18px">↑</b><br>top</div>
</body>
<script src="../publicjs/jquery.transit.js"></script>
<script src="js/swiper.js?v=2"></script>
<script src="../publicjs/public.js"></script>
<script src="js/movies.js"></script>
</html>