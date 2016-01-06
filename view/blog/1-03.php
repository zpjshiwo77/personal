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
						<p> 如果你想给网页添加点JavaScript的交互性，也许你已经听过JavaScript的事件代理（event delegation），并且觉得这是那些发烧友级别的JavaScript程序员才会关心的什么费解的设计模式之一。事实上，如果你已经知道怎么添加JavaScript的事件处理器（event handler），实现事件代理也是件轻而易举的事情。</p>
						<p> JavaScript事件是所有网页互动性的根基（我指的是真正的互动性，而不仅是那些CSS下拉菜单）。在传统的事件处理中，你按照需要为每一个元素添加或者是删除事件处理器。然而，事件处理器将有可能导致内存泄露或者是性能下降——你用得越多这种风险就越大。JavaScript事件代理则是一种简单的技巧，通过它你可以把事件处理器添加到一个父级元素上，这样就避免了把事件处理器添加到多个子级元素上。</p>
						<p>它是怎么运作的呢？</p>
						<p>事件代理用到了两个在JavaSciprt事件中常被忽略的特性：事件冒泡以及目标元素。当一个元素上的事件被触发的时候，比如说鼠标点击了一个按钮，同样的事件将会在那个元素的所有祖先元素中被触发。这一过程被称为事件冒泡；这个事件从原始元素开始一直冒泡到DOM树的最上层。任何一个事件的目标元素都是最开始的那个元素，在我们的这个例子中也就是按钮，并且它在我们的元素对象中以属性的形式出现。使用事件代理，我们可以把事件处理器添加到一个元素上，等待一个事件从它的子级元素里冒泡上来，并且可以得知这个事件是从哪个元素开始的。</p>
						<p>这对我有什么好处呢？</p>
						<p>想象一下现在我们有一个10列、100行的HTML表格，你希望在用户点击表格中的某一单元格的时候做点什么。比如说我有一次就需要让表格中的每一个单元格在被点击的时候变成可编辑状态。如果把事件处理器加到这1000个单元格会产生一个很大的性能问题，并且有可能导致内存泄露甚至是浏览器的崩溃。相反地，使用事件代理，你只需要把一个事件处理器添加到table元素上就可以了，这个函数可以把点击事件给截下来，并且判断出是哪个单元格被点击了。</p>
						<p>用代码写出来是什么样呢？</p>
						<p>代码很简单，我们所要关心的只是如何检测目标元素而已。比方说我们有一个table元素，ID是“report”，我们为这个表格添加一个事件处理器以调用editCell函数。editCell函数需要判断传到table来的事件的目标元素。考虑到我们要写的几个函数中都有可能用到这一功能，所以我们把它单独放到一个名为getEventTarget的函数中：</p>
						<p>function getEventTarget(e) {</p>
						<p>  e = e || window.event;</p>
						<p>  return e.target || e.srcElement;</p>
						<p>}</p>
						<p>e这个变量表示的是一个事件对象，我们只需要写一点点跨浏览器的代码来返回目标元素，在IE里目标元素放在srcElemnt属性中，而在其它浏览器里则是target属性。接下来就是editCell函数了，这个函数调用到了getEventTarget函数。一旦我们得到了目标元素，剩下的事情就是看看它是否是我们所需要的那个元素了。</p>
						<p>function editCell(e) </p>
						<p>{</p>
						<p>  var target = getEventTarget(e);</p>
						<p>  if(target.tagName.toLowerCase() =='td') { // DO SOMETHING WITH THE CELL }</p>
						<p>}</p>
						<p>在editCell函数中，我们通过检查目标元素标签名称的方法来确定它是否是一个表格的单元格。这种检查也许过于简单了点；如果它是这个目标元素单元格里的另一个元素呢？我们需要为代码做一点小小的修改以便于其找出父级的td元素。如果说有些单元格不需要被编辑怎么办呢？此种情况下我们可以为那些不可编辑的单元格添加一个指定的样式名称，然后在把单元格变成可编辑状态之前先检查它是否不包含那个样式名称。选择总是多样化的，你只需找到适合你应用程序的那一种。</p>
						<p>有哪些优点和缺点呢？</p>
						<p>JavaScript事件代理带来的好处有：</p>
						<p>那些需要创建的以及驻留在内存中的事件处理器少了。这是很重要的一点，这样我们就提高了性能，并降低了崩溃的风险。在DOM更新后无须重新绑定事件处理器了。如果你的页面是动态生成的，比如说通过Ajax，你不再需要在元素被载入或者卸载的时候来添加或者删除事件处理器了。潜在的问题也许并不那么明显，但是一旦你注意到这些问题，你就可以轻松地避免它们：你的事件管理代码有成为性能瓶颈的风险，所以尽量使它能够短小精悍。 </p>
						<p>不是所有的事件都能冒泡的。blur、focus、load和unload不能像其它事件一样冒泡。事实上blur和focus可以用事件捕获而非事件冒泡的方法获得（在IE之外的其它浏览器中）。在管理鼠标事件的时候有些需要注意的地方。如果你的代码处理mousemove事件的话你遇上性能瓶颈的风险可就大了，因为mousemove事件触发非常频繁。而mouseout则因为其怪异的表现而变得很难用事件代理来管理。</p>
						<p>总结:</p>
						<P> 已经有一些使用主流类库的事件代理示例出现了，比如说jQuery、Prototype以及Yahoo! UI。你也可以找到那些不用任何类库的例子，比如说Usable Type blog上的这一个。一旦需要的话，事件代理将是你工具箱里的一件得心应手的工具，而且它很容易实现。</P>
						<p>本文来自CSDN博客，转载请标明出处：<a href="http://blog.csdn.net/weinideai/archive/2009/01/19/3835839.aspx" target="_blank">http://blog.csdn.net/weinideai/archive/2009/01/19/3835839.aspx</a></p>
						<p style="color:rgb(235, 110, 98)">------------------------我是分割线----------------------</p>
						<p>接下来我在说一下，我在实际做项目的时候所遇见的问题。</p>
						<p>我在用到事件代理机制时，是如上文所说的：“在DOM更新后无须重新绑定事件处理器”。因为所做的网页的按钮是通过AJAX动态生成的，开始在绑定按钮的click事件时用的是jquery的click()方法，可发现新生成的按钮都不能响应点击效果。然后在网上查找了很多资料后，发现了Jquery的另一种绑定事件的方法：</p>
						<p style="color:rgb(235, 110, 98)">delegate()</p>
						<p>具体使用方法如下：</p>
						<P>$("body").delegate(".btn","click",function(){});</P>
						<p>我把btn的click事件绑定在了body上，达到了我的目的。</p>
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
	status:'转载',
	title:'JavaScript的事件代理',
	content:' ', 
	name:'weinideai',
	time:'2016-1-04',
};
(function(){
	$("title").html(article.title);
	$(".message-title .titile-word span").after(article.title);
	$(".message-title .titile-word2").html(article.name+"&nbsp&nbsp&nbsp"+article.time);
	// $(".blog-article-content").html(article.content);
}());
</script>
</html>