var domain = location.protocol +"//"+location.host;
if(domain == "http://t.page.be-xx.com" || domain == "http://127.1.1.1") domain += "/seventh77/personal/";

// AJAX请求的方法
function iAjax(url,data,callback,type){
	var iType = type || false;

	$.ajax({
        type: 'GET',
        url: url,
        dataType: 'json',
        async: true,
        data:data,
        success: successF,
        error: errorF
    });

    function successF(data){
    	if(iType){
    		callback(data);
    	}
    	else{
    		if(data.errorCode == 0){
	    		if (callback) callback(data);
	    	}
	    	else{
	    		alert(data.emsg);
	    	}
    	}
    }

    function errorF(data){
    	console.log(data);
    }
}//end func

//获取url中的参数
function getUrlParam(name) {
    var reg = new RegExp("(^|&)" + name + "=([^&]*)(&|$)"); //构造一个含有目标参数的正则表达式对象
    var r = window.location.search.substr(1).match(reg);  //匹配目标参数
    if (r != null) return unescape(r[2]); return null; //返回参数值
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

function backtop(){
    $('body,html').animate({scrollTop:0},500);
}

//加载图片
function loadImgs(arr,callback) {
    var total = arr.length;
    var readyImg = 0;
    for (var i = 0; i < arr.length; i++) {
        var img = new Image();
        img.src = arr[i];
        img.onload = function(){
            readyImg++;
            if(total == readyImg && callback) callback();
        }
    };
}//end func