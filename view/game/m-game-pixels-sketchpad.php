<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta charset="utf-8">
	<title>娱乐-柒柒的个人空间</title>
	<link rel="Shortcut Icon" href="../img/logo.png" type="image/x-icon">
	<meta name="keywords" content="">
	<meta name="description" content="">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
	<meta name="apple-mobile-web-app-capable" content="yes" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<link rel="stylesheet" type="text/css"  href="../publiccss/bootstrap.min.css">
	<link rel="stylesheet" type="text/css"  href="../publiccss/bootstrap-theme.min.css">
	<link rel="stylesheet" type="text/css"  href="css/m-game-pixels-sketchpad.css">
	<link rel="stylesheet" type="text/css"  href="../css/public.css">
	<link rel="stylesheet" type="text/css"  href="http://www.seventh77.com/view/Plugins/colpick/colpick.css">
	<script src="../publicjs/jquery-2.1.4.min.js"></script>
	<script src="../publicjs/bootstrap.min.js"></script>
	<script src="http://www.seventh77.com/view/Plugins/html2canvas/html2canvas.js"></script>
	<script src="js/m-game-pixels-sketchpad.js"></script>
	<script src="http://www.seventh77.com/view/Plugins/colpick/colpick.js"></script>
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
	<div class="m-background"></div>
	<div class="m-shadow">
		<img class='m-tip' src="img/tip.png">
		<img class='m-arrow' src="img/arrow.png">
	</div>
</body>
<style type="text/css">
</style>
<script type="text/javascript">
$(document).ready(function(){
	document.onreadystatechange = function () { 
		if(document.readyState == "complete"){ //当页面加载状态为完全结束时进入
			$(".loading").hide();
			if(judgeQQ()){
				$(".m-shadow").show();
			}
			var sket = new PixelsSketchpad(".m-background",parseTen(window.document.body.offsetHeight),parseTen(window.document.body.offsetWidth));
			sket.init();
		}
	}

});
function parseTen(x){
	if(x%20 != 0){
		return parseInt(x/20)*20;
	}
	return x;
}
function judgeQQ(){
	var ua = navigator.userAgent.toLowerCase();//获取判断用的对象
	if(ua.match(/MicroMessenger/i) == "micromessenger" || ua.match(/QQ/i) == "qq"){
		return true;
	}
	return false;
}
</script>
</html>