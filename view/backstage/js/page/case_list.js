$(document).ready(function(){
	var classId = 0;
	var classList;
	var ipager = new pager();

	//页面初始化
	function pageInit(){
		vefLogin();
		eventInit();
		requestClassList();
		requestTotalPage(0,ipagerInit);
	}//end func

	//事件初始化
	function eventInit(){
		$("#list").on("click",".del",delBlog);
		$("#classification").on("change",function(){
			classId = $(this).val();
			requestTotalPage(classId,function(total){
				ipager.reRender({total:total,now:1});
			});
		})
	}//end func

	//删除
	function delBlog(){
		var id = $(this).attr("data-val");
		confirm("确定要删除吗？",function(result){
			if(result) {
				loadingShow();
				iAjax(caseUrl,{method:"deleteCase",id:id},function(data){
					alert("删除成功");
					requestTotalPage(classId,function(total){
						ipager.reRender({total:total});
					});
				});
			}
		});
	}//end func

	//请求总页码
	function requestTotalPage(id,callback){
		iAjax(caseUrl,{method:"getCaseTotalPage",id:id},function(data){
			if(data.errorCode == 0) callback(data.result);
		},true);
	}//end func

	//分页器初始化
	function ipagerInit(total){
		ipager.init($("#pager"),{now:1,total:total,callback:function(page){requesCaseList(page)}});
	}//end func

	//请求分类列表
	function requestClassList(){
		loadingShow();
		iAjax(caseUrl,{method:"getClassList",page:1},function(data){
			if(data.errorCode == 0) {
				var list = data.result.classList;
				classList = list;
				var cont = "";
				for (var i = 0; i < list.length; i++) {
					cont += '<option value="'+list[i].id+'">'+list[i].name+'</option>';
				};
				$("#classification").append(cont);
			}
		},true);
	}//end func

	//获取分类的列表
	function requesCaseList(page){
		loadingShow();
		iAjax(caseUrl,{method:"getCaseList",page:page,classId:classId},function(data){
			if(data.errorCode == 0) renderCaseList(data.result.cases);
			else $("#list").empty();
		},true);
	}//end func

	//渲染分类的列表
	function renderCaseList(data){
		var cont = "";
		var table = $("#list");
		var className = "";
		table.empty();
		for (var i = 0; i < data.length; i++) {
			for (var j = 0; j < classList.length; j++) {
				if(data[i].classId == classList[j].id) className = classList[j].name;
			};
			cont += "<tr> <td>"+data[i].id+"</td> <td>"+className+"</td> <td>"+data[i].name+"</td> <td>"+data[i].time+"</td> <td><a class='btn black' href='case_edit.php?t="+data[i].name+"&id="+data[i].id+"'>修改</a> <div class='btn red del m_left' data-val='"+data[i].id+"'>删除</div> </td> </tr>";
		};
		table.append(cont);
	}//end func

	pageInit();
});