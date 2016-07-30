var m_material = [{name:"土豆",num:"两个"},{name:"猪肉",num:"二两"},{name:"卷心菜",num:"半个"},{name:"火腿肠",num:"一根"}];
var n_material = [{name:"盐",num:"少许"},{name:"贵州辣椒面",num:"少许"},{name:"香菜",num:"少许"}];

$(document).ready(function(){
	document.onreadystatechange = function () { 
		if(document.readyState == "complete"){ //当页面加载状态为完全结束时进入
			$(".loading").hide();
			materialMove();
			showMoving();
		}
	}
});

var mark = 0;
function materialMove(){
	var main = $(".seasoning .m");
	var need = $(".seasoning .n")
	main.on('click',function() {
		if(!$(this).hasClass('active')){
			need.removeClass('active');
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
	need.on('click',function() {
		if(!$(this).hasClass('active')){
			main.removeClass('active');
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
	
}

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
}

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
}