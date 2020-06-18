$(document).ready(function(){
	var ipager = new pager();

	//页面初始化
	function pageInit(){
		vefLogin();
		btnInit();
		requestTotalPage();
	}//end func
	pageInit();

	//请求总页码
	function requestTotalPage(){
		var total = 1;
		iAjax(caseUrl,{method:"getClassList",page:1},function(data){
			if(data.errorCode == 0) total = data.result.totalPage;
			ipager.init($("#pager"),{now:1,total:total,callback:function(page){requestClassList(page)}});
		},true);
	}//end func

	//获取分类的列表
	function requestClassList(page){
		loadingShow();
		iAjax(caseUrl,{method:"getClassList",page:page},function(data){
			if(data.errorCode == 0) renderClassList(data.result.classList);
			else $("#list").empty();
		},true);
	}//end func

	//渲染分类的列表
	function renderClassList(data){
		var cont = "";
		var table = $("#list");
		table.empty();
		for (var i = 0; i < data.length; i++) {
			cont += "<tr> <td>"+data[i].id+"</td> <td>"+data[i].name+"</td> <td><div class='btn red del' data-val='"+data[i].id+"'>删除</div></td> </tr>";
		};
		table.append(cont);
	}//end func

	//按钮初始化
	function btnInit(){
		$(".add").on("click",addClassName);
		$("#list").on("click",".del",delClass);
	}//end func

	//新增分类
	function addClassName(){
		var name = $("#name").val();
		if(name == ""){
			alert("名称不能为空!");
		}
		else{
			loadingShow();
			iAjax(caseUrl,{method:"addClass",name:name},function(data){
				alert("添加成功");
				ipager.reRender({total:data.result});
			});
		}
	}//end func

	//删除分类
	function delClass(){
		var id = $(this).attr("data-val");
		confirm("确定要删除吗？",function(result){
			if(result) {
				loadingShow();
				iAjax(caseUrl,{method:"deleteClass",id:id},function(data){
					alert("删除成功");
					ipager.reRender({total:data.result});
				});
			}
		});
	}//end func
});