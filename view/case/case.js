$(document).ready(function(){
    var caseUrl = domain + "/modal/case/case.php";
    var nowPage = 1;
    var loadFlag = true;
    var overtime;
    var classId = 0;

    /**
     * 页面初始化
     */
    function pageInit(){
        eventInit();
        scrollInit();
        requestClassList();
        requestCase();
    }
    pageInit();

    /**
     * 事件初始化
     */
    function eventInit(){
        $(".choseBox").on("click",".chose",changeType);
    }

    /**
     * 修改类型
     */
    function changeType(){
        var that = $(this);
        if(!that.hasClass("act")){
            $(".choseBox .chose").removeClass("act");
            that.addClass("act");
            classId = that.data("val");
            nowPage = 1;
            requestCase();
        }
    }

    /**
	 * 请求分类列表
	 */
	function requestClassList(){
		iAjax(caseUrl,{method:"getClassList",page:1},function(data){
			if(data.errorCode == 0) {
				var list = data.result.classList;
				var cont = '<div class="chose act" data-val="0">全部</div>';
				for (var i = 0; i < list.length; i++) {
                    cont += `<div class="chose" data-val="${list[i].id}">${list[i].name}</div>`;
				};
				$(".choseBox").empty().append(cont);
                $(".loading").hide();
			}
		},true);
	}

    /**
     * 滚动初始化
     */
	function scrollInit(){
	    $(window).scroll(function(){
	        if($(window).scrollTop()>500) $("#back-to-top").fadeIn(500);
	        else $("#back-to-top").fadeOut(500);

	        var scrollTop = $(this).scrollTop();
	    	var scrollHeight = $(document).height();
	        var windowHeight = $(this).height();
	        if (scrollTop + windowHeight >= scrollHeight){
	        	requestCase();
	        }
	    });
	}

    /**
     * 请求案例
     */
    function requestCase(){
        if(loadFlag){
			loadFlag = false;
			$(".loadtips").html("正在加载，请稍等......").show();
			overtime = setTimeout(function(){
				$(".loadtips").html("加载超时，请刷新重试！");
			},60000);
			iAjax(caseUrl,{method:"getCaseList",page:nowPage,classId:classId},function(data){
				if(data.errorCode == 0) {
                    renderPage(data.result.cases);
                    clearTimeout(overtime);
                    nowPage++;
                    loadFlag = true;
                    $(".loadtips").hide();
				}
				else if(data.errorCode == 1){
                    if(nowPage == 1){
                        var boxs = [$("#listOne"),$("#listTwo"),$("#listThree")];
                        for (let i = 0; i < boxs.length; i++) {
                            boxs[i].empty();
                        }
                    }
					$(".loadtips").html("没有更多了，敬请期待~");
                    clearTimeout(overtime);
                    loadFlag = true;
				}
			},true);
		}
    }

    /**
     * 渲染页面
     */
    function renderPage(cases){
        var boxs = [$("#listOne"),$("#listTwo"),$("#listThree")];
        if(nowPage == 1){
            for (let i = 0; i < boxs.length; i++) {
                boxs[i].empty();
            }
        }
        for (let i = 0; i < cases.length; i++) {
            let labels = cases[i].label.split(",");
            let labelDom = "";
            for (let j = 0; j < labels.length; j++) {
                labelDom += `<div class="ilabel">${labels[j]}</div>`;
            }
            let cont = `<div class="block">
                            <div class="banner" style="background: url(${cases[i].banner}) no-repeat;background-size: cover;background-position: center center;"></div>
                            <p class="title">${cases[i].name}</p>
                            <div class="labelBox">
                                ${labelDom}
                                <div class="date">${cases[i].time}</div>
                            </div>
                            <div class="cont">
                                <div class="intro">${cases[i].intro}</div>
                                <div class="enterBox" style="${cases[i].type == '0' ? 'display:none;' : ''}">
                                    <p>扫码体验</p>
                                    <img src="${cases[i].url}" class="code">
                                </div>
                                <a href="${cases[i].url}" style="${cases[i].type == '1' ? 'display:none;' : ''}" class="linkUrl"  target="_blank">点击体验</a>
                            </div>
                        </div>`;
            let box = boxs[i % 3];
            box.append(cont);
        }
    }
});