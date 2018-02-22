$(document).ready(function(){
	var movieUrl = domain + "/modal/movie/movie.php";
	var bannerFlag = false;
	var normalFlag = false;
	var loadFlag = true;
	var nowPage = 1;
	var bannerData;
	var iswiper;
	var overtime;

	//页面初始化
	function pageInit(){
		eventInit();
		scrollInit();
		requestBanner();
		requestMovies();
	}//end func

	//事件初始化
	function eventInit(){
		$(".movie-banner-next").on("click",function(){
			iswiper.nextItem();
		});
		$("#movieCont").on("click",".hiteBtn",addHite);
	}//end func

	//点赞
	function addHite(){
		var that = $(this);
		if(that.hasClass('active')) alert("你点过赞了哦~");
		else{
			that.addClass('active');
			var id = that.attr('data-val');
			iAjax(movieUrl,{method:"addAHite",id:id},function(data){
				if(data.errorCode == 0) {
					that.find('b').html(data.result);
				}
			},true);
		}
	}//end func

	//请求电影
	function requestMovies(){
		if(loadFlag){
			loadFlag = false;
			$(".movie-tips").html("正在加载，请稍等......").show();
			overtime = setTimeout(function(){
				$(".movie-tips").html("加载超时，请刷新重试！");
			},60000);
			iAjax(movieUrl,{method:"getNormalList",page:nowPage},function(data){
				if(data.errorCode == 0) {
					normalFlag = true;
					if(bannerFlag && normalFlag) $(".loading").hide();
					loadPoster(data.result.movies,renderMovies);
					nowPage++;
				}
				else if(data.errorCode == 1){
					$(".movie-tips").html("后面没有了，敬请期待~");
					clearTimeout(overtime);
				}
			},true);
		}
		
	}//end func

	//渲染电影列表
	function renderMovies(data){
		var box = $("#movieCont");
		var rowBox = box.children();
		for (var i = 0; i < data.length; i++) {
			var row = i % 5;
			rowBox.eq(row).append("<div class='movie-content box-shadow'><a href='"+data[i].DBurl+"' target='_blank'><img src='"+data[i].poster+"'></a> <h2>"+data[i].name+"</h2> <h3 class='hiteBtn' data-val='"+data[i].id+"'><span></span><b >"+data[i].hite+"</b></h3> <p>"+data[i].intro+"</p> </div>");
		};
	}//end func

	//加载海报
	function loadPoster(data,callback){
		var imgs = [];
		for (var i = 0; i < data.length; i++) {
			imgs.push(data[i].poster);
		};
		loadImgs(imgs,function(){
			loadFlag = true;
			$(".movie-tips").hide();
			if(callback) callback(data);
		});
	}//end func

	//请求banner
	function requestBanner(){
		iAjax(movieUrl,{method:"getBannerList",page:1},function(data){
			if(data.errorCode == 0) {
				bannerFlag = true;
				if(bannerFlag && normalFlag) $(".loading").hide();
				bannerData = data.result.movies;
				renderBanner();
			}
		},true);
	}//end func

	//渲染banner
	function renderBanner(){
		var box = $("#banner");
		var cont = "";
		for (var i = 0; i < bannerData.length; i++) {
			cont += '<div class="movie-banner-img"><img src="'+bannerData[i].poster+'"></div>';
		};
		box.empty().append(cont);
		bannerSwiperInit();
	}//end func

	//轮播初始化
	function bannerSwiperInit(){
		iswiper = new swiper();
		iswiper.init($("#bannerWrap"),{data:bannerData,delay:5000});
	}//end func

	//滚动初始化
	function scrollInit(){
	    $(window).scroll(function(){
	        if($(window).scrollTop()>500) $("#back-to-top").fadeIn(500);
	        else $("#back-to-top").fadeOut(500);

	        var scrollTop = $(this).scrollTop();
	    	var scrollHeight = $(document).height();
	        var windowHeight = $(this).height();
	        if (scrollTop + windowHeight >= scrollHeight){
	        	requestMovies();
	        }
	    });
	}//end func

	pageInit();
});