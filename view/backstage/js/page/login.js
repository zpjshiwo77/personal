$(document).ready(function(){

	//页面初始化
	function pageInit(){
		vefLogin(function(data){
			if(data.errorCode == 0) location.href = "index.php";
		});
		
		btnInit();

		if(localStorage.pageUserName) $("#username").val(localStorage.pageUserName);
	}//end func
	pageInit();

	//按钮初始化
	function btnInit(){
		$("#login").on("click",login);

	  	document.onkeydown=function(event){
            var e = event || window.event || arguments.callee.caller.arguments[0];          
             if(e && e.keyCode==13) login();
        };

        $(".remember").on("click",rememberUser);
	}//end func

	//记住账号
	function rememberUser(){
		var ele = $(this);
		if(ele.hasClass('active')){
			ele.removeClass('active');
			ele.find('i').removeClass('icon-ok-circle').addClass('icon-circle-blank');
		}
		else{
			ele.addClass('active');
			ele.find('i').removeClass('icon-circle-blank').addClass('icon-ok-circle');
		}
	}//end func

	//登录
	function login(){
		var user = $("#username").val();
		var psw = $("#password").val();
		if(user == "") alert("账号不能为空");
		else if(psw == "") alert("密码不能为空");
		else {
			loadingShow();
			if($(".remember").hasClass('active')) localStorage.pageUserName = user;
			else localStorage.pageUserName = "";
			iAjax(domain + "modal/user/user.php",{"method":"login","user":user,"psw":psw},function(data){
				location.href="index.php";
			});
		}
	}//end func
});