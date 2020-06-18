$(document).ready(function(){
	var id = getUrlParam("id");
	var method = "addCase";
	var iUploadImg = new uploadImg();

	//页面初始化
	function pageInit(){
		vefLogin();
		requestClassList();
		uploadImgInit();
		btnInit();
		$('#time').dcalendarpicker({
            format: 'yyyy-mm-dd'
        });
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
	
	/**
	 * 请求分类列表
	 */
	function requestClassList(){
		loadingShow();
		iAjax(caseUrl,{method:"getClassList",page:1},function(data){
			if(data.errorCode == 0) {
				var list = data.result.classList;
				var cont = "";
				for (var i = 0; i < list.length; i++) {
					cont += '<option value="'+list[i].id+'">'+list[i].name+'</option>';
				};
				$("#classId").empty().append(cont);
				jadgeType();
			}
		},true);
	}

	//上传图片初始化
	function uploadImgInit(){
		var fileName = Math.random().toString(36).substr(2);
		iUploadImg.init(uploadImgUrl,{"srcName":"case","fileName":fileName});
	}//end func

	//判断类型
	function jadgeType(){
		if(id){
			$(".content .title").html("编辑案例");
			method = "changeCase";
			addData();
		}
		else{
			$(".content .title").html("新增案例");			
		}
	}//end func

	//添加数据
	function addData(){
		iAjax(caseUrl,{method:"getCaseDetail",id:id},function(data){
			var r = data.result;
			if(r.banner) renderUploadImg($("#banner"),r.banner);
			if(r.type) renderSelect($("#type"),r.type,r.url);
			if(r.classId) renderSelect($("#classId"),r.classId);
			if(r.name) $("#name").val(r.name);
			if(r.time) $("#time").val(r.time);
			if(r.label) $("#label").val(r.label);
			if(r.intro) $("#intro").val(r.intro);
		});	
	}//end func

	//渲染select
	function renderSelect(ele,chose,url){
		ele.find("option").each(function (index, el) {
	        $(this).attr('selected', false);
	    });
        ele[0].selectedIndex = ele.find('option[value="'+chose+'"]').index();

        if(chose == 0 && url){
            $("#url").val(url);
        }
        else if(chose == 1 && url){
            renderUploadImg($("#codeImg"),url);
            $(".urlBox").hide();
            $(".codeImgBox").show();
        }
	}//end func

	//提交数据
	function VefData(){
		var classId = $("#classId").val();
		var banner = $("#banner").val();
		var name = $("#name").val();
		var time = $("#time").val();
		var label = $("#label").val();
		var intro = $("#intro").val();
		var type = $("#type").val();
		if(type == 0){
            var url = $("#url").val();
        }
        else{
            var url = $("#codeImg").val();
        }

		if(banner == ""){
			alert("banner不能为空");
		}
		else if(name == ""){
			alert("名称不能为空");
		}
		else if(time == ""){
			alert("时间不能为空");
		}
		else if(label == ""){
			alert("标签不能为空");
		}
		else if(intro == ""){
			alert("简介不能为空");
		}
		else{
			submitData(classId,banner,name,time,label,intro,url,type);
		}
	}//end func

	//提交数据
	function submitData(classId,banner,name,time,label,intro,url,type){
		var info = {
			method:method,
			classId:classId,
			type:type,
            banner:banner,
            name:name,
            time:time,
            intro:intro,
            label:label,
            url:url
		};
		if(id) info.id = id;
		console.log(info)
		iAjax(caseUrl,info,function(data){
			var word = "新增成功!";
			if(id) var word = "修改成功!";
			alert(word,function(){location.href="case_list.php"});
		},false,"POST");
	}//end func
});