$(document).ready(function(){
	var id = getUrlParam("id");
	var method = "addMovie";
	var iUploadImg = new uploadImg();

	//页面初始化
	function pageInit(){
		vefLogin();
		jadgeType();
		uploadImgInit();
		btnInit();
	}//end func
	pageInit();

	//按钮初始化
	function btnInit(){
		$("#submit").on("click",VefData);
	}//end func

	//上传图片初始化
	function uploadImgInit(){
		var fileName = Math.random().toString(36).substr(2);
		if(id) fileName = id;
		iUploadImg.init(uploadImgUrl,{"srcName":"movie","fileName":fileName});
	}//end func

	//判断类型
	function jadgeType(){
		if(id){
			$(".content .title").html("编辑电影");
			method = "changeMovie";
			addData();
		}
		else{
			$(".content .title").html("新增电影");			
		}
	}//end func

	//添加数据
	function addData(){
		iAjax(movieUrl,{method:"getMovieDetail",id:id},function(data){
			var r = data.result;
			if(r.recommend) renderSelect($("#recommend"),r.recommend);
			if(r.name) $("#name").val(r.name);
			if(r.hite) $("#hite").val(r.hite);
			if(r.DBurl) $("#DBurl").val(r.DBurl);
			if(r.intro) $("#intro").val(r.intro);
			if(r.poster) renderUploadImg($("#poster"),r.poster);
		});	
	}//end func

	//渲染select
	function renderSelect(ele,chose){
		ele.find("option").each(function (index, el) {
	        $(this).attr('selected', false);
	    });
	    ele[0].selectedIndex = ele.find('option[value="'+chose+'"]').index();
	}//end func

	//提交数据
	function VefData(){
		var poster = $("#poster").val();
		var recommend = $("#recommend").val();
		var name = $("#name").val();
		var hite = $("#hite").val();
		var DBurl = $("#DBurl").val();
		var intro = $("#intro").val();

		if(poster == ""){
			alert("海报不能为空");
		}
		else if(name == ""){
			alert("名称不能为空");
		}
		else if(hite == ""){
			alert("点赞数不能为空");
		}
		else if(DBurl == ""){
			alert("外链不能为空");
		}
		else if(intro == ""){
			alert("简介不能为空");
		}
		else{
			submitData(poster,recommend,name,hite,DBurl,intro);
		}
	}//end func

	//提交数据
	function submitData(poster,recommend,name,hite,DBurl,intro){
		var info = {
			method:method,
			poster:poster,
			recommend:recommend,
			name:name,
			hite:hite,
			DBurl:DBurl,
			intro:intro
		};
		if(id) info.id = id;

		iAjax(movieUrl,info,function(data){
			var word = "新增成功!";
			if(id) var word = "修改成功!";
			alert(word,function(){location.href="movie_list.php"});
		},false,"POST");
	}//end func
});