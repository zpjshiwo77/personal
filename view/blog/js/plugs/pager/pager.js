var pager = function(){
	var _self = this;
	var nowPage = 0;
	var totalPage = 0;
	var pagerEle;
	var callback;

	//插件初始化
	_self.init = function(ele,options){
		var defaults = {
			now:1,
			total:1,
			callback:function(page){
				console.log(page);
			}
		}

		var opts = $.extend(defaults, options);

		pagerEle = ele;
		nowPage = opts.now;
		totalPage = opts.total;
		callback = opts.callback;

		renderPager();
		btnInit();
	}//end func

	//重新渲染页面
	_self.reRender = function(opts){
		if(opts.total && opts.total != totalPage) {
			totalPage = opts.total;
			if(nowPage > totalPage) nowPage = totalPage;
			renderPager();
		}
		if(opts.now && opts.now != nowPage){
			jumpPage(opts.now);
		} 
		else jumpPage(nowPage);
	}//end func

	//渲染分页器
	function renderPager(){
		var cont = '<div class="pager"><span class="prev">上一页</span>';
		if(totalPage > 6){
			for (var i = 0; i < 4; i++) {
            	cont += "<b>"+(i+1)+"</b>";
            };
            cont += '<b class="more">...</b><b>'+totalPage+'</b><span class="next">下一页</span><input type="text" id="pageNum"><span class="go">GO</span></div>';
		}
		else{
            for (var i = 0; i < totalPage; i++) {
            	if(nowPage == (i+1)) cont += "<b class='active'>"+(i+1)+"</b>";
            	else cont += "<b>"+(i+1)+"</b>";
            };
            cont +='<span class="next">下一页</span><input type="text" id="pageNum"><span class="go">GO</span></div>';
		}
		pagerEle.empty().append(cont);
        jumpPage(nowPage);
	}//end func

	//按键初始化
	function btnInit(){
		pagerEle.on("click",".prev",prevPage);
		pagerEle.on("click",".next",nextPage);
		pagerEle.on("click","b",function(){
			var that = $(this);
			if(!that.hasClass('more')){
				var page = parseInt(that.html());
				jumpPage(page);
			}
		});
		pagerEle.on("click",".go",function(){
			var num = parseInt($("#pageNum").val());
			if(num <= totalPage && num >= 1 && num != nowPage) jumpPage(num);
		});
	}//end func

	//下一页
	function nextPage(){
		if(nowPage < totalPage){
			nowPage++;
			jumpPage(nowPage);
		}
	}//end func

	//前一页一页
	function prevPage(){
		if(nowPage > 1){
			nowPage--;
			jumpPage(nowPage);
		}
	}//end func

	//跳转到某页
	function jumpPage(num){
		var ele = pagerEle.find('b');
		ele.removeClass('active');
		nowPage = num;

		if(totalPage <= 6){
			ele.eq(num - 1).addClass('active');
		}
		else{
			if(num <= 3){
				for (var i = 0; i < 4; i++) {
					ele.eq(i).html(i+1).removeClass('more');
				};
				ele.eq(4).html("...").addClass('more');
				ele.eq(num - 1).addClass('active');
			}
			else if(num >= (totalPage - 2)){
				for (var i = 2; i < 6; i++) {
					ele.eq(i).html(totalPage - (5 - i)).removeClass('more');
				};
				ele.eq(1).html("...").addClass('more');
				ele.eq(5 + (num - totalPage)).addClass('active');
			}
			else{
				ele.eq(1).html("...").addClass('more');
				ele.eq(2).html(num).addClass('active');
				ele.eq(3).html(num+1);
				ele.eq(4).html("...").addClass('more');
			}
		}

		callback(num);
	}//end func
}