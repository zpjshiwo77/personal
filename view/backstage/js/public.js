var domain = location.protocol +"//"+location.host+"/";
if(domain == "http://t.page.be-xx.com" || domain == "http://127.1.1.1") domain += "/seventh77/personal/";
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
			else $("header .name").html(data.result);
		}
	},true);
}//end func
	
//显示loading
function loadingShow(){
	$("body").append('<div class="loading "><img src="../images/loading.gif"></div>');
	$(".loading").transition({opacity:1},500);
}//end func

//隐藏loading
function loadingHide(){
	$(".loading").transition({opacity:0},500,function(){$(this).remove()});
}//end func

// AJAX请求的方法
function iAjax(url,data,callback,type){
	var iType = type || false;

	$.ajax({
        type: 'GET',
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