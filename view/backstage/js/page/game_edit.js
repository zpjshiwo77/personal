$(document).ready(function(){
	var id = getUrlParam("id");
	var method = "addGame";
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
		$("#type").on("change",typeChange);
    }//end func
    
    //类型改变
    function typeChange(){
        var type = $("#type").val();
        if(type == 0){
            $(".urlBox").show();
            $(".codeImgBox").hide();
        }
        else {
            $(".urlBox").hide();
            $(".codeImgBox").show();
        }
    }

	//上传图片初始化
	function uploadImgInit(){
		var fileName = Math.random().toString(36).substr(2);
		iUploadImg.init(uploadImgUrl,{"srcName":"game","fileName":fileName});
	}//end func

	//判断类型
	function jadgeType(){
		if(id){
			$(".content .title").html("编辑游戏");
			method = "changeGame";
			addData();
		}
		else{
			$(".content .title").html("新增游戏");			
		}
	}//end func

	//添加数据
	function addData(){
		iAjax(gameUrl,{method:"getGameDetail",id:id},function(data){
			var r = data.result;
			if(r.Type) renderSelect($("#type"),r.Type,r.Url);
			if(r.Name) $("#name").val(r.Name);
			if(r.SImg) renderUploadImg($("#sImg"),r.SImg);
		});	
	}//end func

	//渲染select
	function renderSelect(ele,chose,url){
		ele.find("option").each(function (index, el) {
	        $(this).attr('selected', false);
	    });
        ele[0].selectedIndex = ele.find('option[value="'+chose+'"]').index();

        if(chose == 0){
            $("#url").val(url);
        }
        else {
            renderUploadImg($("#codeImg"),url);
            $(".urlBox").hide();
            $(".codeImgBox").show();
        }
	}//end func

	//提交数据
	function VefData(){
		var sImg = $("#sImg").val();
		var type = $("#type").val();
		var name = $("#name").val();
		if(type == 0){
            var url = $("#url").val();
        }
        else{
            var url = $("#codeImg").val();
        }

		if(sImg == ""){
			alert("缩略图不能为空");
		}
		else if(name == ""){
			alert("名称不能为空");
		}
		else if(url == ""){
			alert("链接不能为空");
		}
		else{
			submitData(sImg,type,name,url);
		}
	}//end func

	//提交数据
	function submitData(sImg,type,name,url){
		var info = {
			method:method,
			SImg:sImg,
			Type:type,
            Name:name,
            Url:url
		};
		if(id) info.id = id;

		iAjax(gameUrl,info,function(data){
			var word = "新增成功!";
			if(id) var word = "修改成功!";
			alert(word,function(){location.href="game_list.php"});
		},false,"POST");
	}//end func
});