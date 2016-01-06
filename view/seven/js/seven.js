$("#test").highcharts({
	chart:{
		backgroundColor:'rgba(0,0,0,0.1)'
	},
 	title: {
        text: '2015年销售趋势',
        x: -20,
        style:{
        	color:'#fff',
        },
    },
    subtitle: {
        text: 'Source: www.seventh77.com',
        x: -20,
        style:{
        	color:'#fff',
        },
    },
    xAxis: {
        categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun','Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
        labels:{
        	style:{
        		color:'#fff',
        	}
        }
    },
    yAxis: {
        title: {
            text: '销售额 (万元)',
            style:{
            	color:'#fff',
            },
        },
        plotLines: [{
            value: 0,
            width: 1,
            color: '#808080'
        }],
        labels:{
    		style:{
    			color:'#fff',
    		}
        }
    },
    tooltip: {
        valueSuffix: '万元'
    },
    legend: {
        layout: 'vertical',
        align: 'right',
        verticalAlign: 'middle',
        borderWidth: 0
    },
    series: [{
        name: '一号员工',
        data: [3.9, 4.2, 5.7, 8.5, 11.9, 15.2, 17.0, 16.6, 14.2, 10.3, 6.6, 4.8],
        },
        {
        name: '二号员工',
        data: [-0.2, 0.8, 5.7, 11.3, 17.0, 22.0, 24.8, 24.1, 20.1, 14.1, 8.6, 2.5],
        color:'#9B59B6'
    	},
    	{
            name: '三号员工',
            data: [7.0, 6.9, 9.5, 14.5, 18.2, 21.5, 25.2, 26.5, 23.3, 18.3, 13.9, 9.6],
            color:'#2ABB9B'
        },
        ]
});
$("body").delegate(".icons-remove","click",function(){
	$(this).parent().siblings(".Mconcent").slideUp(500,function(){
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
var div='<div class="theme01 margin box-shadow" style="width:0%;display:none"><div class="theme-title"><div class="blank"></div>我是标题<span class="icons-remove"></span></div><div class="Mconcent" style="height:200px; display:none"></div></div>';
$(".xxx").click(function(){
	add("center",div);
});
function add(station,elm){
	station="."+station;
	$(station).children().first().before(elm);
	var that=$(station).children().first();
	$(station).children().first().slideDown(300);
	$(station).children().first().addClass("animation-show");
	var t=setTimeout(function(){
		$(that).removeClass("animation-show")
		$(that).css("width","100%");
		$(that).children().last().slideDown(500);
	},1500);
}