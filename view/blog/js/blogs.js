$(document).ready(function(){
	var classId = 0;
	var className = "";
	var blogUrl = domain + "/modal/blog/blog.php";
	var ipager = new pager();

	//页面初始化
	function pageInit(){
		eventInit();
		scrollInit();
		requestClass();
	}//end func

	//事件初始化
	function eventInit(){
		$("#classBox").on("click",".classBtn",switchClass);
	}//end func

	//转换分类
	function switchClass(){
		classId = $(this).attr("data-id");
		className = $(this).html();
		requestTotalPage(classId,function(total){
			ipager.reRender({total:total,now:1});
		});
	}//end func

	//请求分类
	function requestClass(){
		iAjax(blogUrl,{method:"getClassList",page:1},function(data){
			if(data.errorCode == 0) {
				var list = data.result.list;
				var cont = "";
				for (var i = 0; i < list.length; i++) {
					cont += '<li class="classBtn" data-id="'+list[i].id+'">'+list[i].name.toUpperCase()+'</li>';
				};
				$("#classBox").empty().append(cont);
				classId = getUrlParam("cid") || list[0].id;
				className = $("[data-id='"+classId+"']").html();
				requestTotalPage(classId,ipagerInit);
			}
		},true);
	}//end func

	//请求总页码
	function requestTotalPage(id,callback){
		iAjax(blogUrl,{method:"getBlogTotalPage",id:id},function(data){
			if(data.errorCode == 0) callback(data.result);
		},true);
	}//end func

	//分页器初始化
	function ipagerInit(total){
		ipager.init($("#pager"),{now:1,total:total,callback:function(page){requestBlogList(page)}});
	}//end func

	//请求blog列表
	function requestBlogList(page){
		iAjax(blogUrl,{method:"getBlogList",page:page,classId:classId},function(data){
			if(data.errorCode == 0) renderBlogList(data.result.blogs);
			else $("#list").empty();
		},true);
	}//end func

	//渲染分类的列表
	function renderBlogList(data){
		var cont = "";
		var table = $("#list");
		table.empty();
		$(".message-title b").html(className.toUpperCase());
		$("#classBox li").removeClass('active');
		$("[data-id='"+classId+"']").addClass('active');

		for (var i = 0; i < data.length; i++) {
			cont += "<tr> <td><span class='message-status'>"+data[i].sign+"</span></td> <td><a href='blog.php?id="+data[i].id+"&cid="+classId+"'>"+setString(data[i].title,39)+"</a></td> <td>"+data[i].author+"</td> <td>"+data[i].time+"</td> </tr>";
		};
		table.append(cont);
	}//end func

	//滚动初始化
	function scrollInit(){
	    $(window).scroll(function(){
	        if($(window).scrollTop()>500) $("#back-to-top").fadeIn(500);
	        else $("#back-to-top").fadeOut(500);
	    });
	}//end func

	pageInit();
});

function backtop(){
	$('body,html').animate({scrollTop:0},500);
}