$(document).ready(function(){
	var mark = 0;
	var id = getUrlParam("id") || 1;
	var foodUrl = domain + "/modal/food/food.php";
	var m_material = [{name:"虾仁",num:"六个"},{name:"鸡蛋",num:"两个"},{name:"米饭",num:"一碗"},{name:"胡萝卜",num:"半截"},{name:"豌豆",num:"若干"}];
	var n_material = [{name:"香葱",num:"若干"},{name:"盐",num:"少许"},{name:"鸡精",num:"少许"},{name:"料酒",num:"少许"}];


	document.onreadystatechange = function () { 
		if(document.readyState == "complete"){ //当页面加载状态为完全结束时进入
			// showMoving();
			pageInit();
		}
	}

	//页面初始化
	function pageInit(){
		requestFoodDetail();
		materialMove();
	}//end func

	//请求菜单详细信息
	function requestFoodDetail(){
		var data ={
	        method:"GetFoodDetail",
	        id:id
      	};
		iAjax(foodUrl,data,function(data){
			if(data.errorCode == 0) renderFoodsDetail(data);
			else alert(data.emsg);
			$(".loading").hide();
		},true);
	}//end func

	//渲染菜单详细信息
	function renderFoodsDetail(data){
		var result = data.result;
		var steps = result.step;
		m_material = result.m_material;
		n_material = result.n_material;
		
		var main = renderMain(result);
		var show = renderShow();

		$("#foodDetail").empty().append(main);

		for (var i = 0; i < steps.length; i++) {
			if(i == 1) $("#foodDetail").append(show);
			var step = renderStep(steps[i],i+1);
			$("#foodDetail").append(step);
		};
	}//end func

	//渲染步骤
	function renderStep(step,item){
		var cont = step.cont;
		var contEle = "<p>"+step.title+"</p>";
		var direction = item%2 == 0 ? "stepR" : "stepL";
		var j = item >= 10 ? item : "0" + item; 

		cont = cont.split(";");
		cont.pop();
		for (var i = 0; i < cont.length; i++) {
			contEle += "<p>"+cont[i]+"</p>";
		};
		if(step.tips != 0 && step.tips) contEle += '<p class="tips">tips:'+step.tips+'</p>';
		
		return '<section class="step step'+j+'"> <div class="'+direction+'"> <img src="img/'+item+'.png" height="400" width="270"> <div class="triangleB"> <span class="triangle"></span> <span class="triangle"></span> <span class="triangle"></span> <span class="triangle"></span> <span class="triangle"></span> <span class="triangle"></span> <span class="triangle"></span> <span class="triangle"></span> <span class="triangle"></span> <span class="triangle"></span> <span class="triangle"></span> <span class="triangle"></span> <span class="triangle"></span> <span class="triangle"></span> <span class="triangle"></span> <span class="triangle"></span> <span class="triangle"></span> <span class="triangle"></span> <span class="triangle"></span> <span class="triangle"></span> </div> </div> <div class="contentR"> <div class="intro_word">'+contEle+'</div> <div class="intro_img"> <img src="'+step.img+'"> </div> </div> </section>';
	}//end func

	//渲染打赏部分
	function renderShow(){
		return '<section class="show"> <div class="shadow"> <div class="reward"> <div class="word">REWARD ME</div> <img src="img/QRcode.png"> </div> </div> </section>';
	}//end func

	//渲染主体部分
	function renderMain(result){
		return '<section class="main"> <div class="intro"> <img style="height:540px;width:720px;" src="'+result.img+'"> <div class="title"> <h1>'+result.name+'</h1> <h2 class="ff-youyuan">'+result.Ename+'</h2> </div> </div> <div class="x" id="y"></div> <div class="seasoning"> <div class="seasoning_shadow"> <h3>FOOD MATERIAL</h3> <div class="content"> <div class="s_block"></div> <div class="s_block"></div> <div class="s_block"></div> <div class="s_block"></div> <div class="circle"> <div class="m">主料</div> <div class="n">辅料</div> </div> <div class="s_word"> <div class="w_b"> </div> </div> <div class="s_word"> <div class="w_b"> </div> </div> <div class="s_word"> <div class="w_b"> </div> </div> <div class="s_word"> <div class="w_b"> </div> </div> </div> </div> </div> </section>';
	}//end func

	//渲染主辅料的事件绑定的方法
	function materialMove(){
		$("#foodDetail").on('click',".seasoning .m",function() {
			if(!$(this).hasClass('active')){
				$(".seasoning .n").removeClass('active');
				$(this).addClass('active');
				if(mark == 0){
					toggle(m_material,10);
					mark = 1;
				}
				else{
					toggle(m_material);
				}
			}
		});
		$("#foodDetail").on('click',".seasoning .n",function() {
			if(!$(this).hasClass('active')){
				$(".seasoning .m").removeClass('active');
				$(this).addClass('active');
				if(mark == 0){
					toggle(n_material,10);
					mark = 1;
				}
				else{
					toggle(n_material);
				}
			}
		});
	}//end func

	// 渲染主辅料的方法
	function toggle(material,time){
		var m = material ? material : [{name:"盐",num:"若干"},{name:"味精",num:"若干"},{name:"葱",num:"若干"},{name:"醋",num:"若干"},{name:"香菜",num:"若干"},{name:"大蒜",num:"若干"}];
		if(time){
			var timeA = time;
			var timeB = time; 
			var timeC = time;
			var timeD = time;
		}
		else{
			var time = 200;
			var timeA = 150;
			var timeB = 300;
			var timeC = 450;
			var timeD = 700;
		}
		$(".s_word .w_b").each(function() {
			var that = $(this);
			that.fadeOut(200, function() {
				that.html("");
			});
		});
		$(".s_block").each(function(index,ele){
			var that = $(this);
			if(index == 0){
				that.transition({ y: 50, opacity: 0 , rotate: 45},time);
			}
			else if(index == 1){
				var ta = setTimeout(function(){
					that.transition({ x: -50, opacity: 0 , rotate: 45},time);
				},timeA);
			}
			else if(index == 2){
				var tb = setTimeout(function(){
					that.transition({ y: -50, opacity: 0 , rotate: 45},time);
				},timeB);
				
			}
			else if(index == 3){
				var tc = setTimeout(function(){
					that.transition({ x: 50, opacity: 0 , rotate: 45},time);
				},timeC);
			}
		});
		var t = setTimeout(function(){
			$(".s_block").each(function(index,ele){
				var that = $(this);
				if(index == 3){
					that.transition({ x: 0, opacity: 1 , rotate: 45},200);
				}
				else if(index == 2){
					var td = setTimeout(function(){
						that.transition({ y: 0, opacity: 1 , rotate: 45},200);
					},150);
				}
				else if(index == 1){
					var te = setTimeout(function(){
						that.transition({ x: 0, opacity: 1 , rotate: 45},200);
					},300);
					
				}
				else if(index == 0){
					var tf = setTimeout(function(){
						that.transition({ y: 0, opacity: 1 , rotate: 45},200);
					},450);
				}
			});
		},timeD);
		var t = setTimeout(function(){
			for(var i = 0;i < m.length;i++){
				$(".seasoning .w_b").each(function(index, el) {
					if(index == i%4){
						$(this).append("<p>"+m[i].name+"<span>"+m[i].num+"</span></p>")
						$(this).fadeIn();
					}
				});
			}
		},timeD+500);
	}//end func

	//打赏移动的方法
	function showMoving(){
		moving();
		var t = setInterval(function(){
			moving();
		},24000);
		function moving(){
			$(".food .show").css("backgroundPosition","-80px 0px");
			var t = setTimeout(function(){
				$(".food .show").css("backgroundPosition","0px 0px");
			},12000);
		}
	}//end func
});


