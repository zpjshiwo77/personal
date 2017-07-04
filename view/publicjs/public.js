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