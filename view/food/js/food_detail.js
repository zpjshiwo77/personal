$(document).ready(function(){
	document.onreadystatechange = function () { 
		if(document.readyState == "complete"){ //当页面加载状态为完全结束时进入
			$(".loading").hide();
			materialMove();
			showMoving();
		}
	}
});
function materialMove(){
	var main = $(".seasoning .m");
	var need = $(".seasoning .n")
	main.on('click',function() {
		if(!$(this).hasClass('active')){
			need.removeClass('active');
			$(this).addClass('active');
			toggle();
		}
	});
	need.on('click',function() {
		if(!$(this).hasClass('active')){
			main.removeClass('active');
			$(this).addClass('active');
			toggle();
		}
	});
	function toggle(){
		$(".s_word .w_b").each(function() {
			$(this).html("");
		});
		$(".s_block").each(function(index,ele){
			var that = $(this);
			if(index == 0){
				that.transition({ y: 50, opacity: 0 , rotate: 45},200);
			}
			else if(index == 1){
				var ta = setTimeout(function(){
					that.transition({ x: -50, opacity: 0 , rotate: 45},200);
				},150);
			}
			else if(index == 2){
				var tb = setTimeout(function(){
					that.transition({ y: -50, opacity: 0 , rotate: 45},200);
				},300);
				
			}
			else if(index == 3){
				var tc = setTimeout(function(){
					that.transition({ x: 50, opacity: 0 , rotate: 45},200);
				},450);
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
		},700);
	}
}
function showMoving(){
	moving();
	var t = setInterval(function(){
		moving();
	},84000);
	function moving(){
		$(".food .show").css("backgroundPosition","-600px 0px");
		var t = setTimeout(function(){
			$(".food .show").css("backgroundPosition","0px 0px");
		},42000);
	}
}