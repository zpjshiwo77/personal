var domain = location.protocol +"//"+location.host+"/";
if(domain == "http://t.page.be-xx.com/" || domain == "http://127.1.1.1/") domain += "seventh77/personal/";

var songUrl = domain + "/modal/music/music.php";
var foodUrl = domain + "/modal/food/food.php";
var blogUrl = domain + "/modal/blog/blog.php"

//侧边导航的方法
function sidebarF(){
	if($("#sidebar").length > 0){
		$("#sidebar").load("../publicHtml/sidebar.html?v="+Math.random(),function(){
			var info = $("#sidebar").data('info');
			if(info.act) $("#"+info.act).addClass('active');
			if(info.fold) $('#'+info.fold).click();
		});
	}
	$("#sidebar").on("click",".fold",function(){
		if($(this).hasClass('collapsed')) $(this).find('.icon-chevron-right').removeClass('icon-chevron-right').addClass('icon-chevron-down');
		else $(this).find('.icon-chevron-down').removeClass('icon-chevron-down').addClass('icon-chevron-right');
	});
}
sidebarF();
//end func
	
//退出登录
function exitLogin(){
	$("#exit").on("click",function(){
		loadingShow();
		iAjax(domain + "/modal/user/user.php",{"method":"exit"},function(data){
			location.href="login.php";
		});
	});
}//end func
exitLogin();

//验证是否登录
function vefLogin(callback){
	iAjax(domain + "/modal/user/user.php",{"method":"vefLogin"},function(data){
		if(callback) callback(data);
		else{
			if(data.errorCode != 0) location.href = "login.php";
			else {
				$("header .name").html(data.result);
				loginShow();
			}
		}
	},true);
}//end func
	
//登录以后页面元素可见
function loginShow(){
	$(".content").show();
	$("header").show();
	$("#sidebar").show();
}//end func
	
//显示loading
function loadingShow(){
	$("body").append('<div class="loading "><img src="../images/loading.gif"></div>');
	$(".loading").transition({opacity:1},200);
}//end func

//隐藏loading
function loadingHide(){
	$(".loading").transition({opacity:0},200,function(){$(this).remove()});
}//end func

// AJAX请求的方法
function iAjax(url,data,callback,typeR,type){
	var iType = typeR || false;
	var postType = type || "GET";

	$.ajax({
        type: postType,
        url: url,
        dataType: 'json',
        async: true,
        data:data,
        success: successF,
        error: errorF
    });

    function successF(data){
    	loadingHide();
    	if(iType){
    		callback(data);
    	}
    	else{
    		if(data.errorCode == 0){
	    		if (callback) callback(data);
	    	}
	    	else{
	    		alert(data.emsg);
	    	}
    	}
    }

    function errorF(data){
    	console.log(data);
    }
}//end func

//获取url中的参数
function getUrlParam(name) {
    var reg = new RegExp("(^|&)" + name + "=([^&]*)(&|$)"); //构造一个含有目标参数的正则表达式对象
    var r = window.location.search.substr(1).match(reg);  //匹配目标参数
    if (r != null) return decodeURI(r[2]); return null; //返回参数值
}//end func