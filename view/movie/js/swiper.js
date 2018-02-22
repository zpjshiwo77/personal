var swiper = function(){
	var _self = this;
	var swiperEle;								//容器
	var moveEle;								//移动的容器
	var animeFlag = true;						//动画的
	var data;									//数据
	var totalNum = 0;							//总数
	var nowId = 0;								//当前项
	var moveDis = 0;							//移动的距离
	var swiperT;								//轮播的时间对象
	var delay = 5000;							//轮播延迟

	//初始化
	_self.init = function(ele,opts){
		swiperEle = ele;
		data = opts.data;
		delay = opts.delay;
		totalNum = data.length;
		moveEle = swiperEle.find('.swiper-move');
		moveDis = moveEle.children().width();
		moveEleInit();
		renderContent();
		swiperT = setTimeout(function(){
			_self.nextItem();
		},delay);
	}//end func

	//下一项目
	_self.nextItem = function(){
		if(animeFlag){
			animeFlag = false;
			clearTimeout(swiperT);
			nowId++;
			nowId = nowId >= totalNum ? 0 : nowId;
			renderContent();
			moveEle.transition({x:-1*nowId*moveDis},300,function(){
				animeFlag = true;
				swiperT = setTimeout(function(){
					_self.nextItem();
				},delay);
			});
		}
	}//end func

	//渲染内容
	function renderContent(){
		var cont = data[nowId];
		var box = swiperEle.find('.swiper-word');

		box.find('h1').html(cont.name);
		box.find('p').html(setString(cont.intro,250));
		box.find('a').attr('href', cont.DBurl);
	}//end func

	//移动的元素初始化
	function moveEleInit(){
		moveEle.width(moveDis * totalNum);
	}//end func

	function setString(str, len) {  //截取字符串长度
	    var strlen = 0;  
	    var s = "";  
	    for (var i = 0; i < str.length; i++) {  
	        if (str.charCodeAt(i) > 128) {  
	            strlen += 2;  
	        } else {  
	            strlen++;  
	        }  
	        s += str.charAt(i);  
	        if (strlen >= len) {  
	            return s+"...";  
	        }  
	    }  
	    return s;  
	} 
}