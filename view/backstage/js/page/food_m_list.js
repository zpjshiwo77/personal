$(document).ready(function(){
	var ipager = new pager();
	var foodId = getUrlParam("id");
	var m = getUrlParam("t");
	var name = getUrlParam("n");

	//页面初始化
	function pageInit(){
		vefLogin();
		btnInit();
		jadgeType();
		requestTotalPage();
	}//end func
	pageInit();

	//判断是主料还是辅料
	function jadgeType(){
		if(m == "m"){
			$(".content .title").html(name+"-主料");
			m = "Mmaterial";
		}
		else if(m == "n"){
			$(".content .title").html(name+"-辅料");
			m = "Nmaterial";
		}
	}//end func

	//请求总页码
	function requestTotalPage(){
		var total = 1;
		iAjax(foodUrl,{method:"Get"+m+"List",page:1,foodId:foodId},function(data){
			if(data.errorCode == 0) total = data.result.totalPage;
			ipager.init($("#pager"),{now:1,total:total,callback:function(page){requestMaterial(page)}});
		},true);
	}//end func

	//获取材料的列表
	function requestMaterial(page){
		loadingShow();
		iAjax(foodUrl,{method:"Get"+m+"List",page:page,foodId:foodId},function(data){
			if(data.errorCode == 0) renderMaterial(data.result.ilist);
			else $("#list").empty();
		},true);
	}//end func

	//渲染材料的列表
	function renderMaterial(data){
		var cont = "";
		var table = $("#list");
		table.empty();
		for (var i = 0; i < data.length; i++) {
			cont += "<tr> <td>"+data[i].id+"</td> <td>"+data[i].name+"</td> <td>"+data[i].num+"</td> <td><div class='btn red del' data-val='"+data[i].id+"'>删除</div></td> </tr>";
		};
		table.append(cont);
	}//end func

	//按钮初始化
	function btnInit(){
		$(".add").on("click",addMaterial);
		$("#list").on("click",".del",delMaterial);
	}//end func

	//新增材料
	function addMaterial(){
		var name = $("#name").val();
		var num = $("#num").val();
		if(name == ""){
			alert("名称不能为空!");
		}
		else if(num == ""){
			alert("数量不能为空!");
		}
		else{
			loadingShow();
			iAjax(foodUrl,{method:"Add"+m,foodId:foodId,name:name,count:num},function(data){
				alert("添加成功");
				ipager.reRender({total:data.result});
			});
		}
	}//end func

	//删除材料
	function delMaterial(){
		var id = $(this).attr("data-val");
		confirm("确定要删除吗？",function(result){
			if(result) {
				loadingShow();
				iAjax(foodUrl,{method:"Delete"+m,id:id},function(data){
					alert("删除成功");
					ipager.reRender({total:data.result});
				});
			}
		});
	}//end func
});