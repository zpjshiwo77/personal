$(document).ready(function(){
	var ipager = new pager();
	var foodId = getUrlParam("id");
	var name = getUrlParam("n");

	//页面初始化
	function pageInit(){
		vefLogin();
		renderTitle();
		requestTotalPage();
		btnInit();
	}//end func
	pageInit();

	//渲染标题
	function renderTitle(){
		$(".content .title").html(name+"-步骤列表");
		$("#new_step").attr('href', 'food_step_edit.php?fid=' + foodId + "&n=" + name);
	}//end func

	//按钮初始化
	function btnInit(){
		$("#stepList").on("click",".del",deleteStep);
	}//end func

	//删除步骤
	function deleteStep(){
		var id = $(this).attr("data-val");
		confirm("确定要删除吗？",function(result){
			if(result) {
				loadingShow();
				iAjax(foodUrl,{method:"DeleteStep",id:id},function(data){
					alert("删除成功");
					ipager.reRender({total:data.result});
				});
			}
		});
	}//end func

	//请求列表总数
	function requestTotalPage(){
		var total = 1;
		iAjax(foodUrl,{method:"GetStepList",page:1,foodId:foodId},function(data){
			if(data.errorCode == 0) total = data.result.totalPage;
			ipager.init($("#pager"),{now:1,total:total,callback:function(page){requestStepList(page)}});
		},true);
	}//end func

	//请求美食步骤列表
	function requestStepList(page){
		loadingShow();
		iAjax(foodUrl,{method:"GetStepList",page:1,foodId:foodId},function(data){
			if(data.errorCode == 0) {
				renderSteplist(data.result.list);
			}
			else $("#stepList").empty();
		},true);
	}//end func

	//渲染页面
	function renderSteplist(data){
		var cont = "";
		var table = $("#stepList");
		table.empty();
		for (var i = 0; i < data.length; i++) {
			cont += "<tr> <td>"+data[i].id+"</td> <td>"+data[i].title+"</td> <td>"+data[i].cont+"</td> <td>"+data[i].tips+"</td><td><a class='btn black m_left' href='food_step_edit.php?n="+name+"&id="+data[i].id+"&fid="+foodId+"'>修改</a><div class='btn red del m_left' data-val='"+data[i].id+"'>删除</div></td> </tr>";
		};
		table.append(cont);
	}//end func
});