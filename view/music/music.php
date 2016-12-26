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
			<audio style="display:none" id='MyAudio' src="http://m2.music.126.net/W8mcwcONibEgo4BIuLw0lw==/3295236355160055.mp3"></audio>
			<img src="http://p3.music.126.net/obu1uFbrm9EjrVpqaaKQvw==/90159953489756.jpg" class="music-player-img">
			<div style="height:95px;width:175px;float:left">
				<div class="music-player-play" stutas='1'></div>
				<p class="music-song-name">淘汰</p>
				<p class="music-singer-name">陈奕迅</p>
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
//音乐资源加载
	var songs = new Array("424477572","28747428","30569023","404184209","411988502","408332847","187956","41665696","31545822","168277","65528","34179838","64673","188671","208938","190473","37169617","35403523","209045","409060868","113610","185982","185868","253948","30394763","63650","187966","255858","186125","4950181","720231","36539010","316637","27612267","64959","35847131","31654343","167924","287035","387622","188657","30394771","25877506","30070212","28850212","26348068","286602","30953009");
	var count = 12;//全局变量，记录显示歌曲数量
	(function(){
		for (var i = 0; i < 12; i++) {
				$.ajax({
			    type: 'POST',
			    url: '../../modal/test.php' ,
			    dataType: 'json',
			    async: true,
			    data: 'id='+songs[i],
			    success: function(data){
			    	var song = "<div class='music-song box-shadow' style='background:url("+data.songs[0].album.picUrl+");background-size: 100%;'> <div class='music-desc'> <a class='music-name-artist' ids='"+data.songs[0].id+"' href='javascript:void(0)'> <div class='music-line' style='top:40px; left:60px;'></div> <div class='music-line' style='top:150px; left:60px;'></div> <p>"+data.songs[0].name+"</p> <p>"+data.songs[0].artists[0].name+"</p> </a> </div> </div>";
			    	$(".music-content").append(song);
			    },
			    error: function(){
			    	$(".music-content").html("因为网络原因，加载错误！")
			    }
			});
		};
	}());
	//加载更多
	$(".music-more").click(function(){
		if(count >= songs.length){
			$(".music-more").html("没有更多了~");
		}
		else{
			$(".music-content").append("<div class='music-more-tip'>正在加载，请稍等......</div>");
			for (var i = count; i < count+8; i++) {
					$.ajax({
				    type: 'POST',
				    url: '../../modal/test.php' ,
				    dataType: 'json',
				    async: true,
				    data: 'id='+songs[i],
				    success: function(data){
				    	$(".music-more-tip").hide();
				    	var song = "<div class='music-song box-shadow' style='background:url("+data.songs[0].album.picUrl+");background-size: 100%;'> <div class='music-desc'> <a class='music-name-artist' ids='"+data.songs[0].id+"' href='javascript:void(0)'> <div class='music-line' style='top:40px; left:60px;'></div> <div class='music-line' style='top:150px; left:60px;'></div> <p>"+data.songs[0].name+"</p> <p>"+data.songs[0].artists[0].name+"</p> </a> </div> </div>";
				    	$(".music-content").append(song);
				    },
				    error: function(){
				    	$(".music-content").html("因为网络原因，加载错误！")
				    }
				});
			};
			count+=8;
		}
	});
	//播放器显示
	$(function(){
		$(".music-player-show").click(function(){
			if($(".music-player-show").html() == "〉"){
				$(".music-player-bg").animate({left:"0px"},"nomal",function(){
					$(".music-player-show").html("〈");
				});
			}
			else{
				$(".music-player-bg").animate({left:"-270px"},"nomal",function(){
					$(".music-player-show").html("〉");
				});
			}
		});
	}());
	//播放器播放
	$(function(){
		var audio = document.getElementById("MyAudio");
		$("body").delegate(".music-name-artist","click",function(){
			var id = $(this).attr("ids");
			$.ajax({
			    type: 'POST',
			    url: '../../modal/test.php' ,
			    dataType: 'json',
			    data: "id="+id,
			    success: function(data){
			    	$(".music-player-img")[0].src=data.songs[0].album.picUrl;
			    	$(".music-song-name").html(data.songs[0].name);
			    	$(".music-singer-name").html(data.songs[0].artists[0].name);
			    	$(".music-player-bg").animate({left:"0px"},"nomal",function(){
						$(".music-player-show").html("〈");
					});
					$(".music-player-play").attr("stutas","2");
					$(".music-player-play").css("backgroundPosition","0px 0px");
					audio.src=data.songs[0].mp3Url;
					audio.play();
			    }
			});
		})
		$(".music-player-play").click(function(){
			if($(this).attr("stutas") == '1'){
				$(this).attr("stutas","2");
				$(this).css("backgroundPosition","0px 0px");
				audio.play();
			}
			else{
				$(this).attr("stutas","1");
				$(this).css("backgroundPosition","0px -39px");
				audio.pause();
			}
		});
		$(".music-player-play").mouseenter(function(){
			if($(this).attr("stutas") == '1'){
				$(this).css("backgroundPosition","-40px -39px");
			}
			else{
				$(this).css("backgroundPosition","-40px 0px");
			}
		})
		$(".music-player-play").mouseleave(function(){
			if($(this).attr("stutas") == '1'){
				$(this).css("backgroundPosition","0px -39px");
			}
			else{
				$(this).css("backgroundPosition","0px 0px");
			}
		})
	}());
	//鼠标进入进出效果
	$("body").delegate('.music-song','mouseenter mouseleave',function(e){
        var _this  = $(this), //闭包
        _desc  = _this.find(".music-desc").stop(true),
        width  = _this.width(), //取得元素宽
        height = _this.height(), //取得元素高
        left   = (e.offsetX == undefined) ? getOffset(e).offsetX : e.offsetX, //从鼠标位置，得到左边界，利用修正ff兼容的方法
        top    = (e.offsetY == undefined) ? getOffset(e).offsetY : e.offsetY, //得到上边界
        right  = width - left, //计算出右边界
        bottom = height - top, //计算出下边界
        rect   = {}, //坐标对象，用于执行对应方法。
        _min   = Math.min(left, top, right, bottom), //得到最小值
        _out   = e.type == "mouseleave", //是否是离开事件
        spos   = {}; //起始位置
     
        //console.log(_out)
        rect[left] = function (epos){ //鼠从标左侧进入和离开事件
            spos = {"left": -width, "top": 0};
            if(_out){
                _desc.animate(spos, "fast",function(){
                	_this.find(".music-line:first").css({top:'40px',opacity:'0.2'});
                	_this.find(".music-line:last").css({top:'150px',opacity:'0.2'});
                }); //从左侧离开
            }else{
                _desc.css(spos).animate(epos, "fast",function(){
                	_this.find(".music-line:first").animate({top:'50px',opacity:'1'},"fast");
                	_this.find(".music-line:last").animate({top:'140px',opacity:'1'},"fast");
                }); //从左侧进入
            }
        };
     
        rect[top] = function (epos) { //鼠从标上边界进入和离开事件
            spos = {"top": -height, "left": 0};
            if(_out){
                _desc.animate(spos, "fast",function(){
                	_this.find(".music-line:first").css({top:'40px',opacity:'0.2'});
                	_this.find(".music-line:last").css({top:'150px',opacity:'0.2'});
                }); //从上面离开
            }else{
                _desc.css(spos).animate(epos, "fast",function(){
                	_this.find(".music-line:first").animate({top:'50px',opacity:'1'},"fast");
                	_this.find(".music-line:last").animate({top:'140px',opacity:'1'},"fast");
                }); //从上面进入
            }
        };
     
        rect[right] = function (epos){ //鼠从标右侧进入和离开事件
            spos = {"left": left,"top": 0};
            if(_out){
                _desc.animate(spos, "fast",function(){
                	_this.find(".music-line:first").css({top:'40px',opacity:'0.2'});
                	_this.find(".music-line:last").css({top:'150px',opacity:'0.2'});
                }); //从右侧成离开
            }else{
                _desc.css(spos).animate(epos, "fast",function(){
                	_this.find(".music-line:first").animate({top:'50px',opacity:'1'},"fast");
                	_this.find(".music-line:last").animate({top:'140px',opacity:'1'},"fast");
                }); //从右侧进入
            }
        };
     
        rect[bottom] = function (epos){ //鼠从标下边界进入和离开事件
            spos = {"top": height, "left": 0};
            if(_out){
                _desc.animate(spos, "fast",function(){
                	_this.find(".music-line:first").css({top:'40px',opacity:'0.2'});
                	_this.find(".music-line:last").css({top:'150px',opacity:'0.2'});
                }); //从底部离开
            }else{
                _desc.css(spos).animate(epos, "fast",function(){
                	_this.find(".music-line:first").animate({top:'50px',opacity:'1'},"fast");
                	_this.find(".music-line:last").animate({top:'140px',opacity:'1'},"fast");
                }); //从底部进入
            }
        };
        rect[_min]({"left":0, "top":0}); // 执行对应边界 进入/离开 的方法
    });
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
});
function backtop(){
	$('body,html').animate({scrollTop:0},500);
}
</script>
</html>