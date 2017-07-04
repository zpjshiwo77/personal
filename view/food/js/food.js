var nowPage = 1;
var foodUrl = domain + "/modal/food/food.php";
var requestFlag = true;
var likeFlag = true;

$(document).ready(function(){
	document.onreadystatechange = function () { 
		if(document.readyState == "complete"){ //当页面加载状态为完全结束时进入
			$(".loading").hide();
		}
	}	

	//页面初始化
    function pageInit(){
    	requestFoodsList();
    	btnInit();
	}//end func
	pageInit();

	//请求美食列表
	function requestFoodsList(){
		var data ={
	        method:"GetFoodList",
	        page:nowPage,
      	};
      	if(requestFlag){
      		requestFlag = false;
			iAjax(foodUrl,data,function(data){
				if(data.errorCode == 0) {
					renderFoodsList(data.result.foods);
					nowPage++;
					requestFlag = true;
				}
				else if(data.errorCode == 1){
					requestFlag = false;
				}
			},true);
		}
	}//end func

	//渲染美食列表
	function renderFoodsList(foods){
		var cont = "";
		for (var i = 0; i < foods.length; i++) {
			var food = foods[i];
			cont += '<a href="food_detail.php?id='+food.id+'"> <div class="moment"> <div class="img"> <img src="'+food.img+'"> </div> <div class="content"> <p class="name">'+food.name+'<span>'+food.Ename+'</span></p> <p class="description">'+food.description+'</p> <div class="time">'+food.time+'</div> </div> <div class="d_s_z"> <div class="block dianzan" data-id="'+food.id+'"> <i></i><span>'+food.like+'</span> </div> <div class="block shoucang"> <i></i><span>收藏</span> </div> <div class="block zhuanfa"> <i></i><span>转发</span> </div> </div> </div> </a>';
		};
		$(".moments").append(cont);
	}//end func

	//按钮初始化
	function btnInit(){
		$(window).scroll(scrollLoad);
		$(".moments").on("click",".dianzan",likeThisFood);
		$("#back-to-top").on("click",backtop);
	}//end func

	//回到顶部
	function backtop(){
		$('body,html').animate({scrollTop:0},500);
	}//end func

	//点赞
	function likeThisFood(event){
		event.preventDefault();
		var that = $(this);
	    var id =  that.attr('data-id');   
	    if(likeFlag){
			var data = {
				method:"addAHite",
				id:id
			};
	      	iAjax(foodUrl,data,function(data){
	      		that.children('span').html(data.result);
	    		likeFlag = false;
			});
	    }
	    else{
	      alert("您已经点过赞了~")
	    }
	}//end func

	//滚动加载
	function scrollLoad(){
		if($(window).scrollTop() > $(".moments").height() - $(window).height()){
			requestFoodsList();
		}

		if ($(window).scrollTop()>200){
            $("#back-to-top").fadeIn(500);
        }
        else
        {
            $("#back-to-top").fadeOut(500);
        }
    }//end func
});