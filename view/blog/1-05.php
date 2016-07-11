<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta charset="utf-8">
	<title>技术博客-柒柒的个人空间</title>
	<link rel="Shortcut Icon" href="../img/logo.png" type="image/x-icon">
	<meta name="keywords" content="">
	<meta name="description" content="">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<link rel="stylesheet" type="text/css"  href="../publiccss/bootstrap.min.css">
	<link rel="stylesheet" type="text/css"  href="../publiccss/bootstrap-theme.min.css">
	<link rel="stylesheet" type="text/css"  href="css/blog.css">
	<link rel="stylesheet" type="text/css"  href="../css/public.css">
	<script src="../publicjs/jquery-2.1.4.min.js"></script>
	<script src="../publicjs/bootstrap.min.js"></script>
</head>
<body>
	<?php 
    include '../public/head.html';
	?>
	<div class="background">
		<div class="blog-content">
			<?php 
    		include 'public/left.html';
			?>
			<div class="blog-right">
				<div style="width:900px;margin:60px 0 0 100px;" id="article">
					<div class="message-title">
						<div class="titile-word" style="font-family:'微软雅黑'"><span class="icons" style="margin:13px 15px; background-position:-95px 0px;"></span></div>
						<div class="titile-word2"></div>
					</div>
					<div class="blog-article-content">
						<p>最近在做公司项目的时候，在做表单提交的时候遇到了一些问题，经过查阅资料和学习，算是解决了，今天来好好总结一下。</p>
						<p>--------------------------------post,get方法的区别--------------------------------</p>
						<p>首先是关于form表单的post方法提交的问题。</p>
						<p>一般我们在向后台传输数据时会给链接地址加上一些参数，通过这些参数达到前后端交互的效果。这种方式是通过get请求提交。如果需要用post提交，数据则不会放在链接后面。</p>
						<P>例如，用get的方法提交表单。<span style="color:#D9534F;">url：www.a.com/test.html?f=test</span>这里是向www.a.com/test.html提交一个数据f，它的值为test。</P>
						<p>但如果声明了post的方法提交，这里就会提交到<span style="color:#D9534F;">www.a.com/test.html?f=test</span>而不是<span style="color:#D9534F;">www.a.com/test.html</span>。</p>
						<p>-----------------------------------表单提交文件-----------------------------------</p>
						<p>在表单里面声明了<span style="color:#D9534F;">enctype="multipart/form-data"</span>即设置了表单的编码格式。因为表单enctype的默认值是application/x-www-form-urlencoded，是不能用于文件上传的。</p>
						<p>上传的文件在后台的PHP中我们可以$_FILES的方法获取上传的文件，同时可以用$_POST的方法获取表单的数据。</p>、
						<p>---------------------------------Ajax表单提交文件---------------------------------</p>
						<p>说完了表单提交，再来说一下用Ajax的方法进行表单提交。</p>
						<p>用Ajax进行表单提交的时候，一般我们会用jquery的<span style="color:#D9534F;">serialize()</span>方法去处理表单的数据，拼接成一个字符串传给通过data传给后台。但是用这种方法同样是无法传输文件的。</p>
						<p>所以我们要用windows自带的一个方法叫<span style="color:#D9534F;">FormData</span>去创建一个对象。如下：</p>
						<p><span style="color:#D9534F;">var data = new FormData(FormDom)</span>,其中FormDom为一个表单的dom元素。</p>
						<p>这个时候并没有结束，当你调用$ajax的方法时，你会发现jquery报错了，原因是$ajax的默认编码也是<span style="color:#D9534F;">application/x-www-form-urlencoded</span>，而不是<span style="color:#D9534F;">multipart/form-data</span>。</p>
						<p>所以你需要在$ajax里面加上<span style="color:#D9534F;">processData: false,contentType: false</span>,processData这个属性是为了配合application/x-www-form-urlencoded的编码把data转化成为一个查询字符串，所以当我们要传送文件是，这个属性要设为false。 </p>
						<p>最后附上一个例子：（因为还没做代码编辑器，所以暂时放图片，请见谅！）</p>
						<p><img src="img/1/1-05/code.png"></p>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php 
    include '../public/footer.html';
	?>
	</div>
</body>
<script type="text/javascript">
var article={
	status:'原创',
	title:'Ajax的方法提交表单文件',
	content:'', 
	name:'柒柒',
	time:'2016-4-19',
};
(function(){
	$("title").html(article.title);
	$(".message-title .titile-word span").after(article.title);
	$(".message-title .titile-word2").html(article.name+"&nbsp&nbsp&nbsp"+article.time);
	// $(".blog-article-content").html(article.content);
}());
</script>
</html>