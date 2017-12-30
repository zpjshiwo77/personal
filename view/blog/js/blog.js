$(document).ready(function(){
	var id = getUrlParam("id");
	var classId = getUrlParam("cid");
	var blogUrl = domain + "/modal/blog/blog.php";

	//页面初始化
	function pageInit(){
		eventInit();
		scrollInit();
		requestClass();
		requestBlogDetail();
	}//end func

	//事件初始化
	function eventInit(){
		$("#classBox").on("click",".classBtn",function(){
			window.location.href = "blogs.php?cid=" + $(this).attr("data-id");
		})
	}//end func

	//请求blog详情
	function requestBlogDetail(){
		iAjax(blogUrl,{method:"getBlogDetail",id:id},function(data){
			if(data.errorCode == 0) renderBlogDetail(data.result);
		});	
	}//end func

	//渲染blog详情
	function renderBlogDetail(data){
		$("title").html(data.title);
		$(".message-title .titile-word b").after(data.title);
		$(".message-title .titile-word2").html(data.author+"&nbsp&nbsp&nbsp"+data.time);
		$("#content").html(data.Content);
		 $('pre').each(function(i, block) {
            hljs.highlightBlock(block);
        });
	}//end func

	//请求分类
	function requestClass(){
		iAjax(blogUrl,{method:"getClassList",page:1},function(data){
			if(data.errorCode == 0) {
				var list = data.result.classList;
				var cont = "";
				for (var i = 0; i < list.length; i++) {
					cont += '<li class="classBtn" data-id="'+list[i].id+'">'+list[i].name.toUpperCase()+'</li>';
				};
				$("#classBox").empty().append(cont);

				$("#classBox li").removeClass('active');
				$("[data-id='"+classId+"']").addClass('active');
			}
		},true);
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