$(document).ready(function(){
	var name = getUrlParam("n");
	var foodId = getUrlParam("id");
	var method = "AddFood";

	//页面初始化
	function pageInit(){
		vefLogin();
		jadgeType();
		btnInit();
	}//end func
	pageInit();

	//判断类型
	function jadgeType(){
		if(name && foodId){
			$(".content .title").html(name+"-编辑");
			method = "ChangeFood";
			addData();
		}
		else{
			$(".content .title").html("新增美食博客");			
		}
	}//end func

	function addData(){
		iAjax(foodUrl,{method:"GetFoodOne",id:foodId},function(data){
			var r = data.result;
			if(r.name) $("#name").val(r.name);
			if(r.Ename) $("#Ename").val(r.Ename);
			if(r.addTime) $("#time").val(r.addTime);
			if(r.hite) $("#hite").val(r.hite);
			if(r.Simg) $("#Simg").val(r.Simg);
			if(r.Bimg) $("#Bimg").val(r.Bimg);
			if(r.intro) $("#intro").val(r.intro);
		});	
	}

	//按钮初始化
	function btnInit(){
		$("#submit").on("click",VefData);
	}//end func

	//提交数据
	function VefData(){
		var name = $("#name").val();
		var Ename = $("#Ename").val();
		var time = $("#time").val();
		var hite = $("#hite").val();
		var Simg = $("#Simg").val();
		var Bimg = $("#Bimg").val();
		var intro = $("#intro").val();

		if(name == ""){
			alert("名称不能为空");
		}
		else if(Ename == ""){
			alert("英文名称不能为空");
		}
		else if(!/^[1-9]{1}[0-9]{3}-[0-1]{0,1}[0-9]{1}-[0-3]{0,1}[0-9]{1}$/.test(time)){
			alert("时间格式应该为yyyy-mm-dd，请检查");
		}
		else if(!/^[0-9]+$/.test(hite)){
			alert("点赞数必须为正整数");
		}
		else if(Simg == ""){
			alert("缩略图地址不能为空");
		}
		else if(Bimg == ""){
			alert("大图地址不能为空");
		}
		else if(intro == ""){
			alert("简介不能为空");
		}
		else{
			submitData(name,Ename,time,hite,Simg,Bimg,intro);
		}
	}//end func

	//提交数据
	function submitData(name,Ename,time,hite,Simg,Bimg,intro){
		var info = {
			name:name,
			ename:Ename,
			addTime:time,
			intro:intro,
			hite:hite,
			simg:Simg,
			bimg:Bimg
		};
		if(foodId) info.id = foodId;

		iAjax(foodUrl,{method:method,food:info},function(data){
			var word = "新增成功!";
			if(foodId) var word = "修改成功!";
			alert(word,function(){location.href="food.php"});
		});
	}//end func
});