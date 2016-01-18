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
						<P>正则表达式算是自己比较薄弱的地方，前两天面试叫写一个非常简单的137开头的11位电话号码都写不出来，原因是每次写正则的时候都会去参考一下w3school各种符号。今天准备好好恶补一下，争取把所有符号都记住！</P>
						<p>首先说一下，一般我们在写正则的时候是这样的：<span>/pattern/attributes</span>。其中attributes是修饰符，一般有三种：</p>
						<p>i:<span>执行对大小写不敏感的匹配。</span></p>
						<p>g:<span>执行全局匹配（查找所有匹配而非在找到第一个匹配后停止）。</span></p>
						<p>m:<span>执行多行匹配。</span></p>
						<p>但一般很少用到这个。</p>
						<p>关键是里面的pattern。首先要先记住三个点，括号：<span>[]</span>，量词和元字符。</p>
						<p>括号：<span>[]</span>。一定要和<span>{}</span>口号区别开来，两个括号所表达的意思是完全不一样的。<span>[]</span>代表的是匹配<span>[]</span>之间的所有字符，例如：</p>
						<p><span>[137]</span>匹配的是字符137；</p>
						<p><span>[^abc]</span>表示匹配的是除了字符abc以外的字符。</p>
						<p><span>[a-c]</span>表示匹配的是a-c的字符，即a,b,v。</p>
						<p><span>(137|138)</span>查找任何指定的选项,这里指查找137或者138。</p>
						<p>元字符：拥有特殊含义的字符。常用的主要有下面几种：</p>
						<p><span>\w</span>:表示查找单词字符。</p>
						<p><span>\d</span>:表示查找数字。</p>
						<p><span>\s</span>:表示查找空白字符。</p>
						<p>这里要注意一下，正则表达式是对大小敏感的。如果把量词里面的小写字母换成大写字母就会变成匹配不是该字符的字符。例如，<span>\W</span>表示查找非单词字符。</p>
						<p>最后是量词，也是最关键的一个点。量词符号如下：</p>
						<p><span>^n</span>:匹配任何开头为 n 的字符串。</p>
						<p><span>n$</span>:匹配任何结尾为 n 的字符串。</p>
						<p><span>n{x}</span>:匹配包含 x 个 n 的序列的字符串。</p>
						<p><span>n{x,y}</span>:匹配包含 x 或 y 个 n 的序列的字符串。</p>
						<p><span>n{x,}</span>:匹配至少包含 x 个 n 的序列的字符串。</p>
						<p><span>n+</span>:匹配任何包含至少一个 n 的字符串。</p>
						<p><span>n?</span>:匹配任何包含零个或一个 n 的字符串。</p>
						<p><span>?=n</span>:匹配任何其后紧接指定字符串 n 的字符串。</p>
						<p><span>?!n</span>:匹配任何其后没有紧接指定字符串 n 的字符串。</p>
						<p>这样只要结合量词和元字符或者是括号字符串，或者是三者那么就是一个正则表达式了。下面再举一些实际的例子：</p>
						<p><span>/^[\u4E00-\u9FA5\uf900-\ufa2d\w]{2,16}$/</span>,匹配2-16位的中文姓名。</p>
						<p><span>/^\d{4}-\d{1,2}-\d{1,2}$/</span>,匹配xxxx-xx-xx格式的日期。</p>
						<p><span>/^([a-zA-Z0-9])+@([a-zA-Z0-9])+(\.[a-zA-Z0-9])+/</span>,匹配邮箱。</p>
						<p><span>/^\d{11}$/</span>,匹配11位的数字。</p>
						<p><span>/^\d{5,12}$/</span>,匹配5-12位的数字。</p>
						<p>然后在写一下我遇到的那到面试题：<span>/^(137)\d{8}$/</span>或者<span>/^[137]\d{10}$/</span>。第一种表示以三位数字137开头，加上8位数字结尾。第二种表示以一位字符串137开头，加上10位数字字符结尾。一般第一种用得比较多，因为其意义上也比较符合11位的数字手机号码。</p>
						<p>最后附上非常有用的w3school上正则表达式的介绍：<a href="http://www.w3school.com.cn/jsref/jsref_obj_regexp.asp">http://www.w3school.com.cn/jsref/jsref_obj_regexp.asp</a></p>
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
	title:'正则表达式，轻松、简单学',
	content:' ', 
	name:'柒柒',
	time:'2016-1-12',
};
(function(){
	$("title").html(article.title);
	$(".message-title .titile-word span").after(article.title);
	$(".message-title .titile-word2").html(article.name+"&nbsp&nbsp&nbsp"+article.time);
	// $(".blog-article-content").html(article.content);
}());
</script>
</html>