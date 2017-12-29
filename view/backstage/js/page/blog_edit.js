$(document).ready(function(){
	var ititle = getUrlParam("t");
	var id = getUrlParam("id");
	var method = "addBlog";
	var classFlag = false;

	//编辑器对象
    var Editor = UE.getEditor('Editor',{
    	autoHeightEnabled:false
    });
    var EditorText = "";

	//页面初始化
	function pageInit(){
		vefLogin();
		requestClassList();
		jadgeType();
		btnInit();
	}//end func
	pageInit();

	//按钮初始化
	function btnInit(){
		$("#submit").on("click",VefData);
		$("#switch").on("click",function(){
            Editor.ready(function () {
                Editor.execCommand("source");
            });
        });
	}//end func

	//判断类型
	function jadgeType(){
		if(ititle && id){
			$(".content .title").html("编辑博客");
			method = "changeBlog";
			addData();
		}
		else{
			$(".content .title").html("新增博客");			
		}
	}//end func

	//请求分类列表
	function requestClassList(){
		loadingShow();
		iAjax(blogUrl,{method:"getClassList",page:1},function(data){
			if(data.errorCode == 0) {
				var list = data.result.list;
				var cont = "";
				for (var i = 0; i < list.length; i++) {
					cont += '<option value="'+list[i].id+'">'+list[i].name+'</option>';
				};
				$("#classId").append(cont);
				classFlag = true;
			}
		},true);
	}//end func

	//添加数据
	function addData(){
		iAjax(blogUrl,{method:"getBlogDetail",id:id},function(data){
			var r = data.result;
			if(r.classId) renderSelect($("#classId"),r.classId);
			if(r.sign) $("#sign").val(r.sign);
			if(r.title) $("#title").val(r.title);
			if(r.author) $("#author").val(r.author);
			if(r.time) $("#time").val(r.time);
			if(r.Content){
				Editor.ready(function () {
	                Editor.setContent(r.Content);
	            });
			}
		});	
	}//end func

	//渲染select
	function renderSelect(ele,chose){
		if(classFlag){
			ele.find("option").each(function (index, el) {
		        $(this).attr('selected', false);
		    });
		    ele[0].selectedIndex = ele.find('option[value="'+chose+'"]').index();
		}
		else{
			setTimeout(function(){
				renderSelect(ele,chose);
			},50);
		}
	}//end func

	//提交数据
	function VefData(){
		var classId = $("#classId").val();
		var sign = $("#sign").val();
		var title = $("#title").val();
		var author = $("#author").val();
		var time = $("#time").val();
		EditorText = Editor.getContent();

		if(sign == ""){
			alert("标签不能为空");
		}
		else if(title == ""){
			alert("标题不能为空");
		}
		else if(author == ""){
			alert("作者不能为空");
		}
		else if(!/^[1-9]{1}[0-9]{3}-[0-1]{0,1}[0-9]{1}-[0-3]{0,1}[0-9]{1}$/.test(time)){
			alert("时间格式应该为yyyy-mm-dd，请检查");
		}
		else if(EditorText == ""){
			alert("内容不能为空");
		}
		else{
			submitData(classId,sign,title,author,time,EditorText);
		}
	}//end func

	//提交数据
	function submitData(classId,sign,title,author,time,Content){
		var info = {
			classId:classId,
			sign:sign,
			title:title,
			author:author,
			time:time,
			Content:Content,
			method:method
		};
		if(id) info.id = id;

		iAjax(blogUrl,info,function(data){
			var word = "新增成功!";
			if(id) var word = "修改成功!";
			alert(word,function(){location.href="blog_list.php"});
		},false,"POST");
	}//end func
});