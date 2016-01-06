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
						<p>最近在学习写一个基于jquery的js插件时，因为需要用到键盘按键事件，所以就用了bind的方法去绑定元素事件。可用的时候发现，在绑定事件和解绑事件时bind的方法无法满足我的需求。</p>
						<p style="color:#2E6DA4">ps：（我的需求）键盘按键事件是绑定在body上的，但同一页面可能出现两个不同的元素响应同一个的按钮的事件，例如，有一组弹窗，分别为一级弹窗和二级弹窗，两个弹窗都有关闭按钮，都需要响应Esc键。当二级弹窗存在时，Esc只响应二级弹窗，且关闭二级弹窗，解除二级弹窗上Esc事件。如果不使用命名空间来解绑特定的事件，那么二级弹窗关闭时解除了body上的所有事件，那么一级弹窗就无法响应Esc键关闭弹窗了。有人会问为什么不把keydown事件绑定在弹窗的关闭按钮上，我会给你说，我试过，但没有成功，所以在这里就不讨论了，如果有大神能成功，那我就在这里受教了~</p>
						<p>好了，说了那么多废话现在就来正是介绍on方法。</p>
						<p>首先，我们先看一下on方法和bind方法的区别：</p>
						<p style="color:green">$(selector).bind(event,data,function)</p>
						<p style="color:green">event:必需。规定添加到元素的一个或多个事件。由空格分隔多个事件值。必须是有效的事件。</p>
						<p style="color:green">data:可选。规定传递到函数的额外数据。</p>
						<p style="color:green">function:必需。规定当事件发生时运行的函数。</p>
						<p style="color:green">------------------------------------------------------------------------------------------------------</p>
						<p style="color:green">$(selector).on(event,childSelector,data,function)</p>
						<p style="color:green">event:必需。必需。规定添加到被选元素的一个或多个事件或<span style="color:#D9534F;background:#ccc">命名空间。由空格分隔多个事件值。必须是有效的事件。</p>
						<p style="color:green"><span style="color:#D9534F;background:#ccc">childSelector:可选。规定只能添加到指定的子元素上的事件处理程序（且不是选择器本身，比如已废弃的delegate() 方法）。</span></p>
						<p style="color:green">data:可选。规定传递到函数的额外数据。</p>
						<p style="color:green">function:必需。规定当事件发生时运行的函数。</p>
						<p>由上述所述，我们可以看到，on的方法实际上和bind的方法差不多，但on方法在bind方法在基础上增加了绑定事件的命名空间和一个叫childSelector的参数。因为本文会侧重介绍怎么解绑特定的事件，所以childSelector不会在这里多说了。</p>
						<p>那么我们该如何运用这个命名空间来解绑特定事件呢？下面我们来看一个简单的例子：</p>
						<p><img src="img/1/1-01/1.jpg"></p>
						<p>这里我们给body绑定了一个keydown事件，而且我们在keydown后面加上了一个命名空间“Enter”+this.symbol。其中this.symbol是一个变量。</p>
						<p>而解绑的时候，同样的我们使用off的方法解绑的时候只需要加上“Enter”+this.symbol这个命名空间就可以解绑指定的事件了。</p>
						<p><img src="img/1/1-01/2.jpg"></p>
						<p> 这样做以后，你就能解绑指定事件了，而不是解除所有的事件了。</p>
						<p>附上弹窗插件的下载地址：</p>
						<p><a href="https://github.com/zpjshiwo77/dialog" target="_blank">https://github.com/zpjshiwo77/dialog</a></p>
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
	title:'Jquery的on，off事件详解，如何利用命名空间来解绑特定的事件',
	content:' 最近在学习写一个基于jquery的js插件时，因为需要用到键盘按键事件，所以就用了bind的方法去绑定元素事件。可用的时候发现，在绑定事件和解绑事件时bind的方法无法满足我的需求。 ps：（我的需求）键盘按键事件是绑定在body上的，但同一页面可能出现两个不同的元素响应同一个的按钮的事件，例如，有一组弹窗，分别为一级弹窗和二级弹窗，两个弹窗都有关闭按钮，都需要响应Esc键。当二级弹窗存在时，Esc只响应二级弹窗，且关闭二级弹窗，解除二级弹窗上Esc事件。如果不使用命名空间来解绑特定的事件，那么二级弹窗关闭时解除了body上的所有事件，那么一级弹窗就无法响应Esc键关闭弹窗了。有人会问为什么不把keydown事件绑定在弹窗的关闭按钮上，我会给你说，我试过，但没有成功，所以在这里就不讨论了，如果有大神能成功，那我就在这里受教了~ 好了，说了那么多废话现在就来正是介绍on方法。 首先，我们先看一下on方法和bind方法的区别：  event:必需。规定添加到元素的一个或多个事件。由空格分隔多个事件值。必须是有效的事件。 data:可选。规定传递到函数的额外数据。 function:必需。规定当事件发生时运行的函数。 ------------------------------------------------------------------------------------------------event:必需。必需。规定添加到被选元素的一个或多个事件或命名空间。由空格分隔多个事件值。必须是有效的事件。 childSelector:可选。规定只能添加到指定的子元素上的事件处理程序（且不是选择器本身，比如已废弃的 delegate() 方法）。 data:可选。规定传递到函数的额外数据。 function:必需。规定当事件发生时运行的函数。 由上述所述，我们可以看到，on的方法实际上和bind的方法差不多，但on方法在bind方法在基础上增加了绑定事件的命名空间和一个叫childSelector的参数。因为本文会侧重介绍怎么解绑特定的事件，所以childSelector不会在这里多说了。 那么我们该如何运用这个命名空间来解绑特定事件呢？下面我们来看一个简单的例子： 这里我们给body绑定了一个keydown事件，而且我们在keydown后面加上了一个命名空间“Enter”+this.symbol。其中this.symbol是一个变量。 而解绑的时候，同样的我们使用off的方法解绑的时候只需要加上“Enter”+this.symbol这个命名空间就可以解绑指定的事件了。 这样做以后，你就能解绑指定事件了，而不是解除所有的事件了。', 
	name:'柒柒',
	time:'2015-11-06',
};
(function(){
	$("title").html(article.title);
	$(".message-title .titile-word span").after(article.title);
	$(".message-title .titile-word2").html(article.name+"&nbsp&nbsp&nbsp"+article.time);
	// $(".blog-article-content").html(article.content);
}());
</script>
</html>