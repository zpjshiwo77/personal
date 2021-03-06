<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta charset="utf-8">
	<title>动漫-柒柒的个人空间</title>
	<link rel="Shortcut Icon" href="../img/logo.png" type="image/x-icon">
	<meta name="keywords" content="">
	<meta name="description" content="">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<link rel="stylesheet" type="text/css"  href="../publiccss/bootstrap.min.css">
	<link rel="stylesheet" type="text/css"  href="../publiccss/bootstrap-theme.min.css">
	<link rel="stylesheet" type="text/css"  href="css/anime.css">
	<link rel="stylesheet" type="text/css"  href="../css/public.css">
	<script src="../publicjs/jquery-2.1.4.min.js"></script>
	<script src="../publicjs/bootstrap.min.js"></script>
	<script src="js/theater.min.js"></script>
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
	<div class="anime-background">
		<!-- 导航简介 -->
		<div style="width: 100%;height:533px;background:rgb(250,250,250)">
			<div class="anime-main-nav">
				<div class="anime-nav-intus margin">
					<h1 id="vader"></h1>
					<h2 id="luke"></h2>
					<p id="anime-type-01"></p>
					<p id="anime-type-02"></p>
					<p id="anime-type-03"></p>
					<p id="anime-type-04"></p>
					<p id="anime-type-05"></p>
				</div>
				<div style="width:492px; height:142px;float:left" class="margin">
					<div class="anime-nav-01 translate02" >
						<div class="anime-change-01 anime-translate-x-origin">
							<h1 ><span>0</span>ne Piece</h1>
						</div>
						<div class="anime-change-02 anime-translate-x-origin anime-translate-x-m90" style="background:url(img/nav01.jpg);"></div>
					</div>
					<div class="anime-nav-02 translate03"  style="margin-left:15px;">
						<div class="anime-change-01 anime-translate-x-origin" style="background-color: rgb(77,78,86);">
							<p>名探偵</p>
							<h1>コナン</h1>
						</div>
						<div class="anime-change-02 anime-translate-x-origin anime-translate-x-90" style="background:url(img/nav02.jpg);"></div>
					</div>
				</div>
				<div style="width:492px; height:142px;float:left" class="margin">
					<div class="anime-nav-02 translate01" >
						<div class="anime-change-01 anime-translate-y-origin" style="background-color: rgb(77,78,86);">
							<img src="img/nav-tri.png">
						</div>
						<div class="anime-change-02 anime-translate-y-origin anime-translate-y-m90" style="background:url(img/nav03.jpg);"></div>
					</div>
					<div class="anime-nav-01 translate04"  style="margin-left:15px;">
						<div class="anime-change-01 anime-translate-x-origin" >
							<h1><span>N</span><span>A</span><span>R</span><span>U</span><span>T</span><span>O</span></h1>
						</div>
						<div class="anime-change-02 anime-translate-x-origin anime-translate-x-90" style="background:url(img/nav04.jpg);"></div>
					</div>
				</div>
				<div class="anime-nav-03">
					<div class="anime-change-01 anime-read-on" style="background-color: rgb(77,78,86);">
						<h3>Do Not Think That Is All</h3>
						<h4>If You Want To Know More<span>Read On</span></h4>
					</div>
				</div>
				<div class="anime-nav-04">
					<div class="anime-change-01 anime-clickme" id="go">Let's Go!</div>
				</div>
				<div class="anime-nav-05">
					<div class="anime-change-01 anime-read-ct" style="background-color: rgb(77,78,86);">
						<h3>ˇ</h3><h2>ˇ</h2><h1>ˇ</h1>
					</div>
				</div>
			</div>
		</div>
		<!-- 主体部分 -->
		<!--背景图像-->
		<div id="onepiece-bg" class="anime-background-img"></div>
		<div id="tri-bg" class="anime-background-img" style="background: url(img/tri.jpg) no-repeat; z-index: -2; background-size: cover; background-position:center;"></div>
		<div id="conan-bg" class="anime-background-img" style="background: url(img/conan.jpg) no-repeat; z-index: -3; background-size: cover; background-position:center;"></div>
		<div id="pokemon-bg" class="anime-background-img" style="background: url(img/pokemon.jpg) no-repeat; z-index: -4;  background-size: cover; background-position:center;"></div>
		<!-- 海贼王部分 -->
		<div class="anime-introduce-word">
			<div style="width: 1200px; height: 100%; margin: 0 auto;">
				<div style="height:100%;width:100%">
					<!-- <canvas id="onepiece" height="995" width="1200"></canvas> -->
					<div style="height:465px;width:100%;"><div id="op01" class="anime-line-left" style="left:490px;"></div></div>
					<div style="height:345px;width:100%;"><div id="op02" class="anime-line-right" style="left:30px;"></div></div>
				</div>
				<img src="img/onepiece01.png">
			</div>
		</div>
		<div class="anime-introduce-img"></div> 
		<!-- 数码宝贝部分 -->
		<div class="anime-introduce-word">
			<div style="width: 1200px; height: 100%; margin: 0 auto;">
				<div style="height:100%;width:100%">
					<!-- <canvas id="tri" height="995" width="1200"></canvas> -->
					<div style="height:465px;width:100%;"><div id="tri01" class="anime-line-right" style="left:716px; top:20px;"></div></div>
					<div style="height:348px;width:100%;"><div id="tri02" class="anime-line-left" style="left:1167px;"></div></div>
				</div>
				<img src="img/tri02.png">
			</div>
		</div>
		<div class="anime-introduce-img"></div>
		 <!-- 柯南 -->
		<div class="anime-introduce-word">
			<div style="width: 1200px; height: 100%; margin: 0 auto;">
				<div style="height:100%;width:100%">
					<!-- <canvas id="conan" height="995" width="1200"></canvas> -->
					<div style="height:465px;width:100%;"><div id="conan01" class="anime-line-left" style="left:473px; top:20px;"></div></div>
					<div style="height:348px;width:100%;"><div id="conan02" class="anime-line-right" style="left:30px;"></div></div>
				</div>
				<img src="img/conan03.png">
			</div>
		</div>
		<div class="anime-introduce-img"></div>
		<!-- 神奇宝贝  -->
		<div class="anime-introduce-word">
			<div style="width: 1200px; height: 100%; margin: 0 auto;">
				<div style="height:100%;width:100%">
					<!-- <canvas id="pokemon" height="995" width="1200"></canvas> -->
					<div style="height:465px;width:100%;"><div id="pokemon01" class="anime-line-right" style="left:716px; top:20px;"></div></div>
					<div style="height:348px;width:100%;"><div id="pokemon02" class="anime-line-left" style="left:1167px;"></div></div>
				</div>
				<img src="img/pokemon04.png">
			</div>
		</div>
		<div class="anime-introduce-img"></div>
		<!-- 待定  -->
		<div class="anime-introduce-word">
			<div style="width: 1200px; height: 100%; margin: 0 auto;">
				<div style="background:url(img/end.png);height:100%;width:100%">
					<!-- <canvas id="end" height="995" width="1200"></canvas> -->
					<div style="height:300px;width:100%;"><div id="end" class="anime-line-center"></div></div>
				</div>
			</div>
		</div>
	</div>
	<?php 
    include '../public/footer.html';
	?>
	<div class="anime-right-nav">
		<ul>
			<li class="anime-right-nav-color"></li>
			<li></li>
			<li></li>
			<li></li>
			<li></li>
		</ul>
	</div>
	<!-- <div class="anime-loading">页面正在加载中</div> -->
</body>
<style type="text/css">
</style>
<script type="text/javascript">
window.onload = function(){
	$(".loading").hide();
	(function(){ //打字机
		var theater = new TheaterJS();
		theater
		  .describe("Vader", 0.7, "#vader")
		  .describe("Luke", 0.7, "#luke")
		  .describe("anime-type-01", 0.8, "#anime-type-01")
		  .describe("anime-type-02", 0.8, "#anime-type-02")
		  .describe("anime-type-03", 0.8, "#anime-type-03")
		  .describe("anime-type-04", 0.8, "#anime-type-04")
		  .describe("anime-type-05", 0.8, "#anime-type-05");
		theater
		  .write("Vader:你知道吗？",300)
		  .write("Luke:真相はひとつだけあり！", 400)
		  .write("anime-type-01:当上海贼王的竟然是汉库克", 400)
		  .write("anime-type-02:柯南会在1879集吃下小哀发明的解药恢复成新一", 400)
		  .write("anime-type-03:火影忍者并没有完结，下个BOSS是卡卡西", 400)
		  .write("anime-type-04:数码宝贝tri中本宫大辅会回归，然后和嘉儿在一起了", 400)
		  .write("anime-type-05:兵长其实有1米77", 400);
	}());
}
$(document).ready(function(){
(function () { //翻转
	$(".translate01").mouseenter(function(){
		$(this).children().first().addClass("anime-translate-y-90");
		$(this).children().last().addClass("anime-translate-y-0")
	});
	$(".translate01").mouseleave(function(){
		$(this).children().first().removeClass("anime-translate-y-90");
		$(this).children().last().removeClass("anime-translate-y-0")
	});
	$(".translate02").mouseenter(function(){
		$(this).children().first().addClass("anime-translate-x-90");
		$(this).children().last().addClass("anime-translate-x-0")
	});
	$(".translate02").mouseleave(function(){
		$(this).children().first().removeClass("anime-translate-x-90");
		$(this).children().last().removeClass("anime-translate-x-0")
	});
	$(".translate03").mouseenter(function(){
		$(this).children().first().addClass("anime-translate-x-m90");
		$(this).children().last().addClass("anime-translate-x-0")
	});
	$(".translate03").mouseleave(function(){
		$(this).children().first().removeClass("anime-translate-x-m90");
		$(this).children().last().removeClass("anime-translate-x-0")
	});
	$(".translate04").mouseenter(function(){
		$(this).children().first().addClass("anime-translate-x-m90");
		$(this).children().last().addClass("anime-translate-x-0")
	});
	$(".translate04").mouseleave(function(){
		$(this).children().first().removeClass("anime-translate-x-m90");
		$(this).children().last().removeClass("anime-translate-x-0")
	});
}());
$(window).on("scroll",function(){ //滚动事件监听
    var scrollTop = $(this).scrollTop();
    //导航显示
    if(scrollTop <583){
    	$(".anime-right-nav ul li").removeClass("anime-right-nav-color");
    	$(".anime-right-nav ul li:eq(0)").addClass("anime-right-nav-color");
    }
    if(scrollTop >= 583 && scrollTop < 2573){
    	$(".anime-right-nav ul li").removeClass("anime-right-nav-color");
    	$(".anime-right-nav ul li:eq(1)").addClass("anime-right-nav-color");
    }
   	if(scrollTop >= 2573 && scrollTop < 4563){
   		$(".anime-right-nav ul li").removeClass("anime-right-nav-color");
    	$(".anime-right-nav ul li:eq(2)").addClass("anime-right-nav-color");
   	}
	if(scrollTop >= 4563 && scrollTop < 6653){
		$(".anime-right-nav ul li").removeClass("anime-right-nav-color");
    	$(".anime-right-nav ul li:eq(3)").addClass("anime-right-nav-color");
	}
	if(scrollTop >= 6553){
		$(".anime-right-nav ul li").removeClass("anime-right-nav-color");
    	$(".anime-right-nav ul li:eq(4)").addClass("anime-right-nav-color");
	}
	//背景更换显示
	if(scrollTop >= 2573){
		$("#onepiece-bg").hide();
	}
	if(scrollTop >= 4563){
		$("#tri-bg").hide();
	}
	if(scrollTop >= 6553){
		$("#conan-bg").hide();
	}
	if(scrollTop < 2573){
		$("#onepiece-bg").show();
	}
	if(scrollTop < 4563){
		$("#tri-bg").show();
	}
	if(scrollTop < 6553){
		$("#conan-bg").show();
	}
	//滚动画线
	(function(){
		// console.log(scrollTop);
		//画线
		if(scrollTop >= 390){
			$("#op01").height(200);
		}
		if(scrollTop >= 590){
			$("#op02").height(700);
		}
		if(scrollTop >= 2200){
			$("#tri01").height(200);
		}
		if(scrollTop >= 2600){
			$("#tri02").height(700);
		}
		if(scrollTop >= 4300){
			$("#conan01").height(200);
		}
		if(scrollTop >= 4650){
			$("#conan02").height(700);
		}
		if(scrollTop >= 6200){
			$("#pokemon01").height(200);
		}
		if(scrollTop >= 6700){
			$("#pokemon02").height(700);
		}
		if(scrollTop >= 8200){
			$("#end").height(85);
		}
		//消除线
		if(scrollTop < 390){
			$("#op01").height(0);
		}
		if(scrollTop < 590){
			$("#op02").height(0);
		}
		if(scrollTop < 2200){
			$("#tri01").height(0);
		}
		if(scrollTop < 2600){
			$("#tri02").height(0);
		}
		if(scrollTop < 4300){
			$("#conan01").height(0);
		}
		if(scrollTop < 4500){
			$("#conan02").height(0);
		}
		if(scrollTop < 6300){
			$("#pokemon01").height(0);
		}
		if(scrollTop < 6700){
			$("#pokemon02").height(0);
		}
		if(scrollTop < 8200){
			$("#end").height(0);
		}
	}());
});
(function(){ //侧面导航栏
	$(".anime-right-nav ul li:eq(0)").click(function(){
		$('body,html').animate({scrollTop:0},1000);
	});
	$("#go").click(function(){
		$('body,html').animate({scrollTop:583},1000);
	});
	$(".anime-right-nav ul li:eq(1)").click(function(){
		$('body,html').animate({scrollTop:583},1000);
	});
	$(".anime-right-nav ul li:eq(2)").click(function(){
		$('body,html').animate({scrollTop:2573},1000);
	});
	$(".anime-right-nav ul li:eq(3)").click(function(){
		$('body,html').animate({scrollTop:4563},1000);
	});
	$(".anime-right-nav ul li:eq(4)").click(function(){
		$('body,html').animate({scrollTop:6553},1000);
	});
}());
// canvas实现画线，未完成版
// var lineon;
// function animeline(dom,x1,y1,x2,y2,dr){
// 	clearInterval(lineon);
// 	this.line = dom;
// 	this.itemx = x1;
// 	this.itemy = y1;
// 	var that = this;
// 	this.strokeline = function(){
// 		var cans = line.getContext('2d');
//     	cans.lineWidth = 5;
//     	cans.strokeStyle = 'rgb(235, 110, 98)';
//     	cans.moveTo(x1,y1);
//     	cans.lineTo(itemx,itemy);
//     	cans.stroke();
//     	if(dr == "left"){
//     		itemx = itemx - 1;
//     		itemy = itemy + 1;
//     	}
//     	if(dr == "right"){
//     		itemx = itemx + 1;
//     		itemy = itemy + 1;
//     	}
//     	if(dr == "center"){
//     		itemy = itemy + 1;
//     	}
//     	if(itemx == x2){
// 			clearInterval(lineon);
// 		}
// 	};
// 	lineon = setInterval('strokeline()',1);
// }
});
</script>
</html>