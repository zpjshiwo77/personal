$(document).ready(function(){
	document.onreadystatechange = function () { 
		if(document.readyState == "complete"){ //当页面加载状态为完全结束时进入
			$(".loading").hide();
			
		}
	}
});