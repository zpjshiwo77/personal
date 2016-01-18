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
	<script src="js/movies.js"></script>
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
	<!-- 图片轮播 start-->
	<div class="movie-banner">
		<div class="movie-banner-content">
			<div class="movie-banner-img" style="left:0px"><img src="img/amaze.jpg"></div>
			<div class="movie-banner-img" style="left:770px;"><img src="img/titanic.jpg"></div>
			<div class="movie-banner-img" style="left:1540px;"><img src="img/onepiece.jpg"></div>
			<div class="movie-banner-img" style="left:2310px;"><img src="img/expendables.jpg"></div>
			<div class="movie-banner-next">
				<div class="movie-banner-next-R">〉</div>
				<div style="height: 80px; width: 35px; position: absolute; z-index: 101; top:120px;"></div>
			</div>
		</div>
		<!-- 轮播遮罩 start -->
		<div class="movie-banner-mask">
			<div class="movie-mask-left"></div>
			<div class="movie-mask-center">
				<div class="movie-banner-introduce">
					<h1></h1>
					<p><span></span></p>
					<a href="../comesoon.html" class="movie-banner-btn box-shadow"><span>KNOW MORE</span></a>
				</div>
			</div>
			<div class="movie-mask-right"></div>
		</div>
		<!-- 轮播遮罩 end -->
	</div>
	<!-- 图片轮播 end -->
	<div class="background" style="background-color:rgb(50, 184, 176)">
		<div style="height: 336px;width: 100%;"></div><!-- 占据图片轮播的位置 -->
		<div class="movie-contents">
			<div class="movie-contents-layout" style="margin-left:0px;"></div>
			<div class="movie-contents-layout"></div>
			<div class="movie-contents-layout"></div>
			<div class="movie-contents-layout"></div>
			<div class="movie-contents-layout"></div>
			<div style="height:10px;width:100%;clear:both"></div>
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
		if(document.readyState == "complete"){ //当页面加载状态为完全结束时进入
			$(".loading").hide();
		}
	}
	//回到顶部
	$(function () {
	    $(window).scroll(function(){
	        if ($(window).scrollTop()>200){
	            $("#back-to-top").fadeIn(500);
	        }
	        else
	        {
	            $("#back-to-top").fadeOut(500);
	        }
	    });
	});
	//图片轮播
	var count = 0;
	var content = {
		contents:[
		{
			title:"奇异博士",
			intr:"奇异博士 本名史蒂芬·斯特兰奇，原本是一名的出色的外科手术专家，因一次车祸导致其双手再也无法使用手术刀正常工作，为了治好自己的双手史蒂芬来到喜马拉雅山上拜访传说中的至尊魔法师古一，却被古一看中并传授其使用魔法的能力，史蒂芬化身奇异博士守卫世界，后在师父阵亡后接任成为至尊法师对抗魔界入侵。奇异博士拥有强大的魔法能力，可以将能量实体化，物质转移、念动力、空间转移、幻像术和精神离体等，体能方面他也接受过严格的武术训练，是漫威世界一线超级英雄之一。",
			url:"../comesoon.html"
		},
		{
			title:"泰坦尼克号",
			intr:"1912年4月15日，载着1316号乘客和891名船员的豪华巨轮“泰坦尼克号”与冰山相撞而沉没，这场海难被认为是20世纪人间十大灾难之一。1985年，“泰坦尼克号”的沉船遗骸在北大西洋两英里半的海底被发现。美国探险家洛维特亲自潜入海底，在船舱的墙壁上看见了一幅画，洛维持的发现立刻引起了一位老妇人的注意。已经是101岁高龄的露丝称她就是画中的少女。在潜水舱里，露丝开始叙述当年在船上发生的故事。年轻的贵族少女露丝与穷画家杰克不顾世俗的偏见坠入爱河，然而就在1912年4月14日，一个风平浪静的夜晚，泰坦尼克号撞上了冰山，“永不沉没的”泰坦尼克号面临沉船的命运，罗丝和杰克刚萌芽的爱情也将经历生死的考验，最终不得不永世相隔。老态龙钟的罗丝讲完这段哀恸天地的爱情之后，把那串价值连城的项链“海洋之心”沉入海底，让它陪着杰克和这段爱情长眠海底。",
			url:"../comesoon.html"
		},
		{
			title:"Strong World",
			intr:"正在向着伟大的航路进发的草帽海贼团，这一天突然听说路飞的故乡东海遭受危机的消息。正当路飞打算中断旅程返回东海的时候，有着恶魔果实能力的海贼“金狮子史基”乘着飞空海贼船出现在众人面前，并强行带走了精通航海术的娜美。与金狮子正面火拼上的草帽海贼团，赫然发现这个强大得难以想象的对手，竟然正是曾让海军蒙羞的，从推进城越狱成功并侵犯海军总部的传说中的海贼。",
			url:"../comesoon.html"
		},{
			title:"敢死队3",
			intr:"巴尼与克里斯马斯领衔的敢死队将正面迎战昔日战友，如今的军火枭雄康拉德·斯通班克斯斯通班克斯曾侥幸死里逃生过一次，他对敢死队下达了绝杀令。 巴尼则另有一番打算：为迎战强敌，巴尼决定给敢死队注入新鲜血液，招募了更快更强的高科技战斗新生，搭配长枪硬炮的硬汉前辈，展开一番大决战。",
			url:"../comesoon.html"
		}
		]
	};
	(function(){//初始化banner电影介绍，截取字符串
		for(var i in content.contents){
			var str = content.contents[i].intr;
			if(str.length>135){
				var item = setString(str, 250);
				content.contents[i].intr = item;
			}
		}
		$(".movie-banner-introduce h1").html(content.contents[0].title);
		$(".movie-banner-introduce p span").html(content.contents[0].intr);
		$(".movie-banner-introduce a").attr("href",content.contents[0].url);
	}());
	function slide(){
		var item = $(".movie-banner-img:last").css("left");
		item = parseInt(item.split("px")[0]);
		if(item % 770 == 0 && item >= 0){
			var num = $(".movie-banner-img").length;
			if(count != num - 1){
				$(".movie-banner-img").each(function(){
					var item = $(this).css("left");
					item = parseInt(item.split("px")[0]);
					$(this).animate({left:item - 770});
				});
				count++;
			}
			else{
				$(".movie-banner-img").each(function(){
					var item = $(this).css("left");
					item = parseInt(item.split("px")[0]);
					$(this).animate({left:item + 770*(num-1)});
				});
				count = 0;
			}
			$(".movie-banner-introduce h1").html(content.contents[count].title);
			$(".movie-banner-introduce p span").html(content.contents[count].intr);
			$(".movie-banner-introduce a").attr("href",content.contents[count].url);
		}
	}
	var t = setInterval(slide,5000);
	$(".movie-banner-next").click(function(){
		slide();
	})
	//加载主体部分电影介绍 start
	function loadmovie(x){
		var count = 0;
		for(var i in x.movies){
			var item = "<div class='movie-content box-shadow'><a href='"+x.movies[i].url+"'><img src='"+x.movies[i].img+"'></a> <h2>"+x.movies[i].title+"</h2> <h3><span></span><b>"+x.movies[i].heart+"</b></h3> <p>"+x.movies[i].word+"</p> </div>";
			$(".movie-contents-layout:eq("+count+")").append(item);
			count++;
			if(count >= 5){
				count = 0;
			}
		}
	}
	(function(){//加载
		var count = 0;
		loadmovie(movie[0]);
		count++;
		$(window).on("scroll",function(){ //滚动事件监听
	    	var scrollTop = $(this).scrollTop();
	    	var scrollHeight = $(document).height();
	        var windowHeight = $(this).height();
	        if (scrollTop + windowHeight >= scrollHeight){
	        	if(count <9){
	        		loadmovie(movie[count]);
	        		count++;
	        	}
	        }
	    });
    }());
	//加载主体部分电影介绍 end
	//红心点击 start
	$("body").delegate(".movie-content h3 span","click",function(){
		var item = $(this).next().html();
		$(this).next().html(parseInt(item)+1);
	});
	// 红心点击 end
});
function backtop(){
	$('body,html').animate({scrollTop:0},500);
}
function setString(str, len) {  //截取字符串长度
    var strlen = 0;  
    var s = "";  
    for (var i = 0; i < str.length; i++) {  
        if (str.charCodeAt(i) > 128) {  
            strlen += 2;  
        } else {  
            strlen++;  
        }  
        s += str.charAt(i);  
        if (strlen >= len) {  
            return s+"...";  
        }  
    }  
    return s;  
} 
</script>
</html>