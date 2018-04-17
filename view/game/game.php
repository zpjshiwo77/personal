<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta charset="utf-8">
	<title>娱乐-柒柒的个人空间</title>
	<link rel="Shortcut Icon" href="../img/logo.png" type="image/x-icon">
	<meta name="keywords" content="">
	<meta name="description" content="">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<link rel="stylesheet" type="text/css"  href="../publiccss/bootstrap.min.css">
	<link rel="stylesheet" type="text/css"  href="../publiccss/bootstrap-theme.min.css">
	<link rel="stylesheet" type="text/css"  href="css/game.css">
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
		<div class="game-content">
			<div class="games-pre">
				<a href="game-house.php">
					<img src="img/game-house.jpg">
					<div class="games-shadow">The House</div>
				</a>	
			</div>
			<div class="games-pre">
				<a href="game-pixels-sketchpad.php">
					<img src="img/game-pixels-sketchpad.jpg">
					<div class="games-shadow">像素画板</div>
				</a>
			</div>
			<div class="games-pre">
				<a href="javascript:void(0)" class="phoneGame" data-code="img/MarblesGameCode.jpg">
					<img src="img/MarblesGame.jpg">
					<div class="games-shadow">三维弹球</div>
				</a>
			</div>
		</div>
		<div class="gameCode"> 
			<img src=""> 
			<p>请扫码体验</p> 
		</div>
	</div>
	<?php 
    include '../public/footer.html';
	?>
</body>
<style type="text/css">
</style>
<script type="text/javascript">
$(document).ready(function(){
	document.onreadystatechange = function () { 
		if(document.readyState == "complete"){ //当页面加载状态为完全结束时进入
			$(".loading").hide();
			$(".phoneGame").on("click",function(){
				$(".gameCode img").attr("src",$(this).attr('data-code'));
				$(".gameCode").fadeIn();
			});
			$(".gameCode").on("click",function(){
				$(this).fadeOut();
			})
		}
	}
});

</script>
</html>