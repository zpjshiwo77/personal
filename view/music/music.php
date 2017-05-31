<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta charset="utf-8">
	<title>音乐-柒柒的个人空间</title>
	<link rel="Shortcut Icon" href="../img/logo.png" type="image/x-icon">
	<meta name="keywords" content="">
	<meta name="description" content="">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<link rel="stylesheet" type="text/css"  href="../publiccss/bootstrap.min.css">
	<link rel="stylesheet" type="text/css"  href="../publiccss/bootstrap-theme.min.css">
	<link rel="stylesheet" type="text/css"  href="css/music.css">
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
		<div class="music-content">
		</div>
		<div class="music-more">加载更多......</div>
		<div class="music-player-bg box-shadow">
			<!-- <audio style="display:none" id='MyAudio' src="http://m2.music.126.net/W8mcwcONibEgo4BIuLw0lw==/3295236355160055.mp3"></audio>
			<img src="http://p3.music.126.net/obu1uFbrm9EjrVpqaaKQvw==/90159953489756.jpg" class="music-player-img">
			<div style="height:95px;width:175px;float:left">
				<div class="music-player-play" stutas='1'></div>
				<p class="music-song-name">淘汰</p>
				<p class="music-singer-name">陈奕迅</p>
			</div> -->
			<div class="musicControl">
				<iframe frameborder="no" border="0" marginwidth="0" marginheight="0" width=270 height=95 src="//music.163.com/outchain/player?type=2&id=411988502&auto=0&height=66"></iframe>
			</div>
			<div class="music-player-show">〉</div>
		</div>
	</div>
	<?php 
    include '../public/footer.html';
	?>
	<div id="back-to-top" class="box-shadow" onclick="backtop();"><b style="font-size:18px">↑</b><br>top</div>
</body>
<style type="text/css">
</style>
<script type="text/javascript">
$(document).ready(function(){
	document.onreadystatechange = function () { 
		console.log(document.readyState);
		if(document.readyState == "complete"){ //当页面加载状态为完全结束时进入
			$(".loading").hide();
		}
	}
});
</script>
<script src="../publicjs/public.js"></script>
<script src="js/music.js"></script>
</html>