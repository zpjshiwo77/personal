function backtop(){
	$('body,html').animate({scrollTop:0},500);
}
window.onload=function(){
	var elm='<div class="margin box-shadow" style="width:0%;display:none"><div class="theme-title"><div class="blank"></div><span class="icons-remove"></span></div><div class="Mconcent"  style="display:none"></div></div>';
	function add(id,title,station,elm,theme,height,chart){
		station="."+station;
		theme="theme0"+theme;
		$(station).children().first().before(elm);
		var that=$(station).children().first();
		$(that).attr("id",id);
		$(that).addClass(theme);
		$(that).children().last().css("height",height);
		$(that).children().first().children().first().after(title);
		$(that).slideDown(300);
		$(that).addClass("animation-show");
		var t=setTimeout(function(){
			$(that).removeClass("animation-show");
			$(that).css("width","100%");
			$(that).children().last().slideDown(2.5*height,function(){
				$(that).children().last().highcharts(chart);
			});
		},1500);
	}
	//remove
	$("body").delegate(".icons-remove","click",function(){
		var x=$(this).parent().siblings(".Mconcent")
		$(x).slideUp($(x).height()*2.5,function(){
			var that=this;
			$(this).parent().addClass("animation-remove");
			var t=setTimeout(function(){
				$(that).parent().css("width","0");
				$(that).parent().slideUp(500,function(){
					$(that).parent().remove();
				})
			},1000);
		});
	});
	//back to top
	$(function () {
	    $(window).scroll(function(){
	        if ($(window).scrollTop()>200){
	            $("#back-to-top").fadeIn(500);
	        }
	        else
	        {
	            $("#back-to-top").fadeOut(500);
	        }
	    });
	});
	//员工个人销售趋势
	$("#persalesB").click(function(){
		window.location="#persales";
	});
	//当月员工业绩对比
	$("#percomparedlB").click(function(){
		if($("#percomparedl").length==0){
			backtop();
			var x ={chart: {type: 'column', backgroundColor:'rgba(0,0,0,0)', dataLabels: {enabled: false }, }, title: {text: null }, xAxis: {categories: ['张三', '李四', '王五', '小小', '愤怒的蛮王','暴走的盖伦','易大师'], labels:{style:{color:'#fff'}} }, yAxis: {title: {text: '销售额 (万元)', style:{color:'#fff'}},labels:{style:{color:'#fff'}}}, credits: {enabled: false }, plotOptions:{column:{borderColor: ""} }, series: [{name: '10月', data: [10.3, 14.1, 15.8, -2.5, 11.2,17.5,13.8], }, {name: '11月', data: [6.6, 8.6, 13.9, -0.2, 9.0,15.3,5.0], color: '#DE6565', } ] };
			add("percomparedl","2015年10-12月员工绩效","center",elm,2,300,x);
		}
		else{
			window.location="#percomparedl";
		}
	});
	//总销售趋势
	$("#totalsalesB").click(function(){
		if($("#totalsales").length==0){
			backtop();
			add("totalsales","总销售趋势","center",elm,2,250,tatol);
		}
		else{
			window.location="#totalsales";
		}
	});
	//各品牌配件市场份额
	$("#MarketshareB").click(function(){
		window.location="#Marketshare";
	});
	//德玛轮胎
	$("#dmltB").click(function(){
		if($("#dmlt").length==0){
			backtop();
			var x={chart:{backgroundColor:'rgba(0,0,0,0)'}, title: {text: null, }, xAxis: {categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun','Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'], labels:{style:{color:'#fff', } } }, yAxis: {title: {text: '销售量 (个)', style:{color:'#fff', }, }, plotLines: [{value: 0, width: 1, color: '#808080'}], labels:{style:{color:'#fff', } } }, tooltip: {valueSuffix: '个'}, legend: {layout: 'vertical', align: 'right', verticalAlign: 'middle', borderWidth: 0 }, series: [{name: '德玛轮胎', data: [5, 5, 6, 8, 10, 15, 14, 12, 16, 20, 10, 8], color:'#f0ad4e'}, ]};
			add("dmlt","德玛轮胎2015年销售趋势","center",elm,2,250,x);
		}
		else{
			window.location="#dmlt";
		}
	});
	//易刹车
	$("#yscB").click(function(){
		if($("#ysc").length==0){
			backtop();
			var x={chart:{backgroundColor:'rgba(0,0,0,0)'}, title: {text: null, }, xAxis: {categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun','Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'], labels:{style:{color:'#fff', } } }, yAxis: {title: {text: '销售量 (个)', style:{color:'#fff', }, }, plotLines: [{value: 0, width: 1, color: '#808080'}], labels:{style:{color:'#fff', } } }, tooltip: {valueSuffix: '个'}, legend: {layout: 'vertical', align: 'right', verticalAlign: 'middle', borderWidth: 0 }, series: [{name: '易刹车', data: [20, 28, 35, 40, 42, 45, 60, 50, 43, 42, 50, 24], color:'rgb(89,171,227)'}, ]};
			add("ysc","易刹车2015年销售趋势","center",elm,2,250,x);
		}
		else{
			window.location="#ysc";
		}
	});
	//新尾翼
	$("#xwyB").click(function(){
		if($("#xwy").length==0){
			backtop();
			var x={chart:{backgroundColor:'rgba(0,0,0,0)'}, title: {text: null, }, xAxis: {categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun','Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'], labels:{style:{color:'#fff', } } }, yAxis: {title: {text: '销售量 (个)', style:{color:'#fff', }, }, plotLines: [{value: 0, width: 1, color: '#808080'}], labels:{style:{color:'#fff', } } }, tooltip: {valueSuffix: '万元'}, legend: {layout: 'vertical', align: 'right', verticalAlign: 'middle', borderWidth: 0 }, series: [{name: '新尾翼', data: [50, 46, 58, 70, 15, 16, 15, 20, 30, 24, 35, 17], color:'rgb(204,55,71)'}, ]};
			add("xwy","新尾翼2015年销售趋势","center",elm,2,250,x);
		}
		else{
			window.location="#xwy";
		}
	});
	//泽拉斯螺丝
	$("#zlslsB").click(function(){
		if($("#zlsls").length==0){
			backtop();
			var x={chart:{backgroundColor:'rgba(0,0,0,0)'}, title: {text: null, }, xAxis: {categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun','Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'], labels:{style:{color:'#fff', } } }, yAxis: {title: {text: '销售量 (个)', style:{color:'#fff', }, }, plotLines: [{value: 0, width: 1, color: '#808080'}], labels:{style:{color:'#fff', } } }, tooltip: {valueSuffix: '个'}, legend: {layout: 'vertical', align: 'right', verticalAlign: 'middle', borderWidth: 0 }, series: [{name: '泽拉斯螺丝', data: [1500, 1700, 2000, 800, 850, 780, 1200, 1500, 1660, 2000, 1500, 1300], color:'rgb(42,187,155)'}, ]};
			add("zlsls","泽拉斯螺丝2015年销售趋势","center",elm,2,250,x);
		}
		else{
			window.location="#zlsls";
		}
	});
}