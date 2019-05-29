$(document).ready(function(){
	var ipager = new pager();

	//页面初始化
	function pageInit(){
		vefLogin();
		eventInit();
		requestTotalPage(ipagerInit);
	}//end func

	//事件初始化
	function eventInit(){
		$("#list").on("click",".del",delMGame);
	}//end func

	//删除
	function delMGame(){
		var id = $(this).attr("data-val");
		confirm("确定要删除吗？",function(result){
			if(result) {
				loadingShow();
				iAjax(gameUrl,{method:"deleteGame",id:id},function(data){
					alert("删除成功");
					requestTotalPage(function(total){
						ipager.reRender({total:total});
					});
				});
			}
		});
	}//end func

	//请求总页码
	function requestTotalPage(callback){
		iAjax(gameUrl,{method:"getTotalPage"},function(data){
			if(data.errorCode == 0) callback(data.result);
		},true);
	}//end func

	//分页器初始化
	function ipagerInit(total){
		ipager.init($("#pager"),{now:1,total:total,callback:function(page){requestGameList(page)}});
	}//end func

	//获取分类的列表
	function requestGameList(page){
		loadingShow();
		iAjax(gameUrl,{method:"getGameList",page:page},function(data){
			if(data.errorCode == 0) renderGameList(data.result.games);
			else $("#list").empty();
		},true);
	}//end func

	//渲染分类的列表
	function renderGameList(data){
		var cont = "";
		var table = $("#list");
		table.empty();
		for (var i = 0; i < data.length; i++) {
			var type = data[i].Type == 0 ? "链接" : "图片";
			cont += "<tr> <td>"+data[i].ID+"</td><td>"+data[i].Name+"</td><td>"+type+"</td> <td>"+data[i].Url+"</td> <td><a class='btn black' href='game_edit.php?id="+data[i].ID+"'>修改</a> <div class='btn red del m_left' data-val='"+data[i].ID+"'>删除</div> </td> </tr>";
		};
		table.append(cont);
	}//end func

	pageInit();
});