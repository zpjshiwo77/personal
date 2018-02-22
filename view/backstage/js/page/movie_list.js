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
		$("#list").on("click",".del",delMovie);
	}//end func

	//删除博客
	function delMovie(){
		var id = $(this).attr("data-val");
		confirm("确定要删除吗？",function(result){
			if(result) {
				loadingShow();
				iAjax(movieUrl,{method:"deleteMovie",id:id},function(data){
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
		iAjax(movieUrl,{method:"getTotalPage"},function(data){
			if(data.errorCode == 0) callback(data.result);
		},true);
	}//end func

	//分页器初始化
	function ipagerInit(total){
		ipager.init($("#pager"),{now:1,total:total,callback:function(page){requestMovieList(page)}});
	}//end func

	//获取分类的列表
	function requestMovieList(page){
		loadingShow();
		iAjax(movieUrl,{method:"getMovieList",page:page},function(data){
			if(data.errorCode == 0) renderMovieList(data.result.movies);
			else $("#list").empty();
		},true);
	}//end func

	//渲染分类的列表
	function renderMovieList(data){
		var cont = "";
		var table = $("#list");
		table.empty();
		for (var i = 0; i < data.length; i++) {
			var type = data[i].recommend == 0 ? "普通" : "banner";
			cont += "<tr> <td>"+data[i].id+"</td><td>"+data[i].name+"</td><td>"+type+"</td> <td>"+data[i].hite+"</td> <td>"+data[i].DBurl+"</td> <td><a class='btn black' href='movie_edit.php?id="+data[i].id+"'>修改</a> <div class='btn red del m_left' data-val='"+data[i].id+"'>删除</div> </td> </tr>";
		};
		table.append(cont);
	}//end func

	pageInit();
});