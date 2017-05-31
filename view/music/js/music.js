var nowPage = 1;
var musicUrl = domain + "/modal/music/music.php";

$(document).ready(function(){
	//页面初始化
	function pageInit(){
		requestSongs(nowPage);
		btnInit();
	}//end func
	pageInit();

	function btnInit(){
		$(".music-more").on("click",function(){
			requestSongs(nowPage);
		});
		$("body").on("click",".music-name-artist",appendWYYplayer);
		$(".music-player-show").on("click",function(){
			controlShow("showAhide");
		});
	};

	//添加网易云播放器
	function appendWYYplayer(){
		var id = $(this).attr("ids");
		var box = $(".musicControl");
		box.empty().append('<iframe frameborder="no" border="0" marginwidth="0" marginheight="0" width=270 height=95 src="//music.163.com/outchain/player?type=2&id='+id+'&auto=1&height=66"></iframe>');
		controlShow("show");
	}//end func
	
	//请求歌曲
	function requestSongs(page){
		iAjax(musicUrl,{method:"getSongs",page:page},function(data){
			if(data.errorCode == 0) {
				requestSongsDetail(data.result.songs);
				nowPage++;
			}
			else if(data.errorCode == 1) $(".music-more").html("没有更多了~");
		},true)
	}//end func

	//请求歌曲详情
	function requestSongsDetail(songs){
		$(".music-content").append("<div class='music-more-tip'>正在加载，请稍等......</div>");
		for (var i = 0; i < songs.length; i++) {
			iAjax(musicUrl,{method:"getSongDetail",id:songs[i].song},function(data){
				if(data.code == 200) renderSongs(data);
			},true);
		};
	}//end func

	//渲染歌曲
	function renderSongs(data){
		$(".music-more-tip").hide();
    	var song = "<div class='music-song box-shadow' style='background:url("+data.songs[0].album.picUrl+");background-size: 100%;'> <div class='music-desc'> <a class='music-name-artist' ids='"+data.songs[0].id+"' href='javascript:void(0)'> <div class='music-line' style='top:40px; left:60px;'></div> <div class='music-line' style='top:150px; left:60px;'></div> <p>"+data.songs[0].name+"</p> <p>"+data.songs[0].artists[0].name+"</p> </a> </div> </div>";
    	$(".music-content").append(song);
	}//end func

	//播放器显示
	function controlShow(type){
		var itype = type || "showAhide";
		if($(".music-player-show").html() == "〉"){
			$(".music-player-bg").animate({left:"0px"},"nomal",function(){
				$(".music-player-show").html("〈");
			});
		}
		else if($(".music-player-show").html() == "〈" && itype == "showAhide"){
			$(".music-player-bg").animate({left:"-270px"},"nomal",function(){
				$(".music-player-show").html("〉");
			});
		}
	}

	//播放器播放
	// $(function(){
	// 	var audio = document.getElementById("MyAudio");
	// 	$("body").delegate(".music-name-artist","click",function(){
	// 		var id = $(this).attr("ids");
	// 		$.ajax({
	// 		    type: 'POST',
	// 		    url: '../../modal/test.php' ,
	// 		    dataType: 'json',
	// 		    data: "id="+id,
	// 		    success: function(data){
	// 		    	$(".music-player-img")[0].src=data.songs[0].album.picUrl;
	// 		    	$(".music-song-name").html(data.songs[0].name);
	// 		    	$(".music-singer-name").html(data.songs[0].artists[0].name);
	// 		    	$(".music-player-bg").animate({left:"0px"},"nomal",function(){
	// 					$(".music-player-show").html("〈");
	// 				});
	// 				$(".music-player-play").attr("stutas","2");
	// 				$(".music-player-play").css("backgroundPosition","0px 0px");
	// 				audio.src=data.songs[0].mp3Url;
	// 				audio.play();
	// 		    }
	// 		});
	// 	})
	// 	$(".music-player-play").click(function(){
	// 		if($(this).attr("stutas") == '1'){
	// 			$(this).attr("stutas","2");
	// 			$(this).css("backgroundPosition","0px 0px");
	// 			audio.play();
	// 		}
	// 		else{
	// 			$(this).attr("stutas","1");
	// 			$(this).css("backgroundPosition","0px -39px");
	// 			audio.pause();
	// 		}
	// 	});
	// 	$(".music-player-play").mouseenter(function(){
	// 		if($(this).attr("stutas") == '1'){
	// 			$(this).css("backgroundPosition","-40px -39px");
	// 		}
	// 		else{
	// 			$(this).css("backgroundPosition","-40px 0px");
	// 		}
	// 	})
	// 	$(".music-player-play").mouseleave(function(){
	// 		if($(this).attr("stutas") == '1'){
	// 			$(this).css("backgroundPosition","0px -39px");
	// 		}
	// 		else{
	// 			$(this).css("backgroundPosition","0px 0px");
	// 		}
	// 	})
	// }());
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