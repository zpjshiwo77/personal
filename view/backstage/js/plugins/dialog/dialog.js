var dialog = function () {
 	var self = this;

 	var btn_ok = '<a class="ibtn" id="d_true">确定</a>';
 	var btn_cancel = '<a class="ibtn w-red" id="d_false">取消</a>';
 	var btn_close = '<a class="ibtn" id="d_close">关闭</a>';

 	var BUTTON_OK = [{name:"ok"}];
 	var BUTTON_OK_CANCEL = [{name:"ok"},{name:"cancel"}];

 	self.init = function(){
 		self.register();
 	}//end func

    self.shadow = function(word){
        $("body").append('<div class="uploadShadow" id="uploadShadow"><p>'+word+'</p></div>');
    }//end func

    self.shadowClose = function(){
        $("#uploadShadow").remove();
    }//end func

 	self.show = function(options,callback){
        var w = options["width"] ? options["width"] : 400;
        var dialogShadow = $("<div>",{"class":"dialogShadow"});
        dialogShadow.append('<div class="dialog"> <div class="d_cont"></div> <div class="btns"></div> </div>');
 		$("body").append(dialogShadow);
        if(typeof options["width"] != "undefined"){
            dialogShadow.find(".dialog").css({
                "width": options["width"]
            });
        }
 		if(typeof options["msg"] != "undefined"){
            var msgArr = options['msg'].split("<br>");
            var msg = "";
            
            for (var i = 0; i < msgArr.length; i++) {
                var p = $("<p>",{"style":"margin-bottom:0;"}).text(msgArr[i]);
                dialogShadow.find(".d_cont").append(p);
            };
 		}
 		if(typeof options["img"] != "undefined"){
			dialogShadow.find(".d_cont").append('<img src="'+options['img']+'">');
           dialogShadow.find(".d_cont").find('img')[0].onload = function(){
                dialogShadow.find(".dialog").css("margin-top",-dialogShadow.find(".dialog").outerHeight()/2);
            }
 		}
        if(typeof options["control"] != "undefined") {
            dialogShadow.find(".d_cont").append('<div id="'+options["control"].id+'" style="float:left;">'+options["control"].name+'</div>');
        }
 		if(typeof options["btns"] != "undefined"){
 			var btns = options["btns"];
 			var btnsBox = dialogShadow.find(".btns")
			for(var i in btns){
				if(btns[i].name == "ok"){btnsBox.append('<a class="ibtn" val="yes">确定</a>')}
                if(btns[i].name == "upload"){btnsBox.append('<a class="ibtn" val="upload">上传</a>')}
				if(btns[i].name == "cancel"){btnsBox.append('<a class="ibtn w-red" val="no">取消</a>')}
				if(btns[i].name == "close"){btnsBox.append('<a class="ibtn" val="close">关闭</a>')}
			}
            $(".ibtn").css('width', 100 / btns.length + "%");
 		}
        if(typeof options["right"] != "undefined"){
            dialogShadow.find(".dialog").css({
                "left": '100%',
                "margin-left": -w
            });
        }
        
        dialogShadow.find(".dialog").css("margin-top",-dialogShadow.find(".dialog").outerHeight()/2);

 		self.closeDialog(callback);
 	}//end func

 	self.closeDialog = function(callback){
 		var val = "close";
 		$(".dialog .ibtn").on("click",function(){
 			var that = $(this);
 			val = that.attr("val");
            if(typeof callback != "undefined"){ callback(val); }
 			that.parents(".dialogShadow").remove();
 		})
 	}//end func

 	self.register = function () {
        self._originalAlertHandler = window.alert; 
        self._originalConfirmHandler = window.confirm;
        window.alert = function (message,onClose) {
            self.show({"msg": message, "btns": BUTTON_OK},function (result) {
                if(typeof onClose != "undefined"){
                    var x = onClose(result == "yes" ? true : false);
                    return x;
                }
            });
        };
        window.confirm = function (message, onClose) {   
            self.show({"msg": message, "btns": BUTTON_OK_CANCEL}, function (result) {
                var x = onClose(result == "yes" ? true : false);
                return x;
            });
        };
        return this;
    };//end func

    // 恢复系统全局接口
    self.restore = function () {
        self._originalAlertHandler && (window.alert = this._originalAlertHandler);
        self._originalConfirmHandler && (window.confirm = this._originalConfirmHandler);
    };//end func
 }

var idialog = new dialog();

idialog.init();