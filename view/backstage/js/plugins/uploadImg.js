var uploadImg = function(){
	var self = this;

	var api = "";
	var srcName = "default";
	var fileName = "default";
	
	//插件初始化
	self.init = function(url,opts){
		api = url;
		if(opts){
			if(opts.hasOwnProperty("srcName")) srcName = opts.srcName;
			if(opts.hasOwnProperty("fileName")) fileName = opts.fileName;
		}

		$(".uploadImg").each(function () {
            var that = $(this);
            initPreFile(that, that.attr("data-id"));
        });

        $("body").on("click",".previewBtn",function(){
        	idialog.show({img: $(this).attr('data-url')+'?v='+Math.random(), btns: [{name: "close"}]});
        });
	}//end func

	//初始化每一个插件
	function initPreFile(ele,id){
		$("body").append('<input type="file" class="uploadImgInput" id="input'+id+'">')
		var input = $("#input"+id);

		input.on("change",function(){
			upload(this.files[0],id,ele);
		});

		ele.on("click",function(){
			input.click();
		});
	}//end func

	//上传
	function upload(files,id,ele){
		var data = new FormData();
		data.append("fileName",id+fileName);
		data.append("srcName",srcName);
		data.append('files', files);
		if(files.size > 5 * 1024 * 1024){
			alert("请上传小于5MB的图片");
		}
		else{
			idialog.shadow("正在上传，请稍等......");
			$.ajax({
		        type: 'POST',
		        url: api,
		        dataType: 'json',
		        async: false,
		        data: data,
		        processData:false,
				contentType:false,
				success:function(data){
					idialog.shadowClose();
					if(data.errorCode != 0) alert(data.emsg);
					else creatPreView(data.imgUrl,id,ele);
				}
		    });
		}
		
	}//end func

	//生成预览
	function creatPreView(img,id,ele){
		var fEle = ele.parent();
		var preEle = fEle.children('.previewBtn');
		var inputEle = $("#"+id);

		if(preEle.length == 0){
			fEle.append('<div class="previewBtn" data-url="'+img+'">预览</div>');
		}
		else{
			preEle.attr('data-url', img);
		}

		if(inputEle.length == 0){
			fEle.append('<input type="text" id="'+id+'" class="ImgInput">');
		}
		$("#"+id).val(img);
	}//end func
}