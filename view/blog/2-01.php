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
						<p>在我开始接触前端到现在近半年了，从一个前端菜鸟，到现在应该算是“小鸟”了吧。写这篇的目的一是总结自己半年来学到了哪些东西，二是希望可以帮助一些像要学习前端开发的朋友，让他们能在这条路上走得更顺利。</p>
						<p>话不多说，直接开始整理。</p>
						<p>首先是基础，无论做什么事都需要有一定基础吧，如果你搭房子没有砖，那房子是肯定打不起来的。所以我的建议是先从最基础的html，css学起，先学会做一些简单的网页，然后再开始进一步的学习。这里我推荐一个比较好的网站：<a href="http://www.w3school.com.cn">http://www.w3school.com.cn</a>。我一些基础性的知识都是在这面学习的。</p>
						<p>在学习基础的这段时间里，相信你会遇到很多“经验”上的问题。往往这些东西你很难在网上找到，这个时候你需要有人来帮助你。所以这个时候你最好是找一个能共同学习交流的群或者是说找一个论坛。我当时就找到<a href="http://bbs.csdn.net/home">CSDN论坛</a>，在里面发帖求助，看帖学习。在这个工程中学习到了非常多的东西。总的一句话，在这个阶段你需要与人交流。</p>
						<p>接下来，就需要学习一些稍微深入一点的东西了，例如JS，Jquery库等。同样这些东西的基础都可以在w3school上学习。</p>
						<p>有了一定基础后，就要开始着手做一些实际的项目了。这个项目该怎么选择呢？我的建议是做一些自己感兴趣的东西，不要去照着哪些学习视频做什么管理系统之类的，感觉做起来会很没有意思，越做越会让你对前端失去兴趣。所以建议找一些兴趣相关的东西做，例如：如果你喜欢音乐，做一个自己的音乐网站；如果你喜欢游戏，自己用js开发一个游戏等等。我开始就自己做了一个宠物小精灵的开场特效。虽然这些东西可能没有现成的，做起来会比较困难，但如果你真的一步一步慢慢地去做，等真的做出来之后，你会发现你提高了很多。</p>
						<p>然后这里在插一下，很多刚开始接触前端的朋友都会问用什么样的IDE好？这个其实有很多，例如DW，Hbulider，UltraEdit，eclipse等...我个人用的是sublime+chrome。sublime是一款非常不错的文本编辑器，支持非常多的开发语言，还有文本高亮，代码填充等很多强大的功能。chrome就不用多说了，现在比较主流的浏览器之一，一般都是用它来进行调试的。</p>
						<p>然后，开始了解一些比较深入的东西了，js的原型链与闭包。这个东西我看了非常久，算是一知半解，现在用到的地方不多。但不得不多这东西非常有价值！</p>
						<p>虽然是做前端，但web毕竟不单单的前端，所以后端的东西也要稍微了解一些，这个时候你需要去学下一门后端的语言。我选择的是PHP，因为这门语言比较简单，而且国内的资源非常多。</p>
						<p>最后在说一下前端的趋势，很多新技术听起来很难但只要你去认真学了，就会觉得其他也就那样。然后前端的趋势肯定是往移动端发展的，所以H5什么的是必须要会的。举个例子，我现在实习的公司在双十二做了一个活动，然后对双十二的活动界面进行了统计，PC端的日浏览量不足3位数，而移动端的日浏览量超过了5000，可见现在大家用手机上网的比例远远超过了PC。</p>
						<p>可能我同样作为一个前端新手没有那些老鸟的有经验，这些东西是我半年来所学到的，希望对一些新手朋友有用。</p>
						<p>附上一篇大神的博文：<a href="http://www.cnblogs.com/wangfupeng1988/p/4649709.html">自己总结的web前端知识体系大全</a></p>
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
	title:'前端基础知识小结',
	content:'',
	name:'柒柒',
	time:'2016-1-07',
};
(function(){
	$("title").html(article.title);
	$(".message-title .titile-word span").after(article.title);
	$(".message-title .titile-word2").html(article.name+"&nbsp&nbsp&nbsp"+article.time);
	// $(".blog-article-content").html(article.content);
}());
</script>
</html>