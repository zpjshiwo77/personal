<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta charset="utf-8">
	<title>项目案例-柒柒的个人空间</title>
	<link rel="Shortcut Icon" href="../img/logo.png" type="image/x-icon">
	<meta name="keywords" content="">
	<meta name="description" content="">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<link rel="stylesheet" type="text/css"  href="../publiccss/bootstrap.min.css">
	<link rel="stylesheet" type="text/css"  href="../publiccss/bootstrap-theme.min.css">
	<link rel="stylesheet" type="text/css"  href="case.css">
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
	<div class="background">
		<div class="wrap">
			<div class="p_info">
				<p class="name">Page</p>
				<p class="nickname">项目合作请联系我</p>
				<p class="contact">微信：Seventh_Page</p>
				<p class="description"><img src="../img/weixin.jpg"></p>
			</div>

			<div class="choseBox">
				<!-- <div class="chose act">全部</div> -->
			</div>

			<div class="caseList">
				<div class="listBox" id="listOne">
					<!-- <div class="block">
						<div class="banner"></div>
						<p class="title">标题</p>
						<div class="labelBox">
							<div class="ilabel">互动</div>
							<div class="date">2020-05-20</div>
						</div>
						<div class="cont">
							<div class="intro">内容</div>
							<div class="enterBox" style="display:none">
								<p>扫码体验</p>
								<img src="../img/weixin.jpg" class="code">
							</div>
							<a href=""  class="linkUrl"  target="_blank"></a>
						</div>
					</div> -->
				</div>
				<div class="listBox" id="listTwo">
					
				</div>
				<div class="listBox" id="listThree">
					
				</div>
				<div class="loadtips">正在加载，请稍等......</div>
			</div>
		</div>
	</div>
	<?php 
    include '../public/footer.html';
	?>
	<div id="back-to-top" class="box-shadow" onclick="backtop();"><b style="font-size:18px">↑</b><br>top</div>
</body>
<style type="text/css">
</style>
<script src="../publicjs/public.js"></script>
<script src="case.js"></script>
</html>