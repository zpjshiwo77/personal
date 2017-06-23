$(document).ready(function(){
	var ipager = new pager();

	//页面初始化
	function pageInit(){
		vefLogin();
		requestTotalPage();
		btnInit();
	}//end func
	pageInit();

	//按钮初始化
	function btnInit(){
		$("#foodList").on("click",".del",deleteFood);
	}//end func

	//删除美食blog
	function deleteFood(){
		var id = $(this).attr("data-val");
		confirm("确定要删除吗？",function(result){
			if(result) {
				loadingShow();
				iAjax(foodUrl,{method:"DeleteFood",id:id},function(data){
					alert("删除成功");
					ipager.reRender({total:data.result});
				});
			}
		});
	}//end func

	//请求总页数
	function requestTotalPage(){
		var total = 1;
		iAjax(foodUrl,{method:"GetFoodList",page:1},function(data){
			if(data.errorCode == 0) total = data.result.totalPage;
			ipager.init($("#pager"),{now:1,total:total,callback:function(page){requestList(page)}});
		},true);
	}//end func

	//请求美食列表
	function requestList(page){
		loadingShow();
		iAjax(foodUrl,{method:"GetFoodList",page:page},function(data){
			if(data.errorCode == 0) {
				renderFoodlist(data.result.foods);
			}
			else $("#foodList").empty();
		},true);
	}//end func

	//渲染页面
	function renderFoodlist(data){
		var cont = "";
		var table = $("#foodList");
		table.empty();
		for (var i = 0; i < data.length; i++) {
			cont += "<tr> <td>"+data[i].id+"</td> <td>"+data[i].name+"</td> <td>"+data[i].like+"</td> <td>"+data[i].time+"</td><td><a class='btn yellow' href='food_m_list.php?n="+data[i].name+"&t=m&id="+data[i].id+"'>主料</a><a class='btn yellow m_left' href='food_m_list.php?n="+data[i].name+"&t=n&id="+data[i].id+"'>辅料</a><a class='btn blue m_left' href='food_step_list.php?n="+data[i].name+"&id="+data[i].id+"'>步骤</a><a class='btn black m_left' href='food_edit.php?n="+data[i].name+"&id="+data[i].id+"'>修改</a><div class='btn red del m_left' data-val='"+data[i].id+"'>删除</div></td> </tr>";
		};
		table.append(cont);
	}//end func
});