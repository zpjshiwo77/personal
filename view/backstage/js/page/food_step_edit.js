$(document).ready(function(){
	var name = getUrlParam("n");
	var foodId = getUrlParam("fid");
	var id = getUrlParam("id");
	var method = "AddStep";
	var iUploadImg = new uploadImg();

	//页面初始化
	function pageInit(){
		vefLogin();
		jadgeType();
		btnInit();
		uploadImgInit();
	}//end func
	pageInit();

	//上传图片初始化
	function uploadImgInit(){
		var fileName = Math.random().toString(36).substr(2);
		// if(foodId) fileName = foodId;
		iUploadImg.init(uploadImgUrl,{"srcName":"food","fileName":fileName});
	}//end func

	//判断类型
	function jadgeType(){
		if(id){
			$(".content .title").html("编辑"+name+"步骤");
			method = "ChangeStep";
			addData();
		}
		else{
			$(".content .title").html("新增"+name+"步骤");			
		}
	}//end func

	function addData(){
		iAjax(foodUrl,{method:"GetStepOne",id:id},function(data){
			var r = data.result;
			if(r.title) $("#title").val(r.title);
			if(r.img) renderUploadImg($("#img"),r.img);
			if(r.tips) $("#tips").val(r.tips);
			if(r.content) $("#step").val(r.content);
		});	
	}

	//按钮初始化
	function btnInit(){
		$("#submit").on("click",VefData);
	}//end func

	//提交数据
	function VefData(){
		var title = $("#title").val();
		var img = $("#img").val();
		var tips = $("#tips").val();
		var step = $("#step").val();

		if(title == ""){
			alert("步骤名称不能为空");
		}
		else if(img == ""){
			alert("步骤图片地址不能为空");
		}
		else if(tips == ""){
			alert("小贴士不能为空");
		}
		else if(step == ""){
			alert("步骤描述不能为空");
		}
		else{
			step = step.replace(/\n/g,";");
			submitData(title,img,tips,step);
		}
	}//end func

	//提交数据
	function submitData(title,img,tips,step){
		var info = {
			method:method,
			foodId:foodId,
			title:title,
			cont:step,
			tips:tips,
			img:img,
		};
		if(id) info.id = id;

		iAjax(foodUrl,info,function(data){
			var word = "新增成功!";
			if(id) var word = "修改成功!";
			alert(word,function(){location.href="food_step_list.php?n="+name+"&id="+foodId});
		});
	}//end func
});