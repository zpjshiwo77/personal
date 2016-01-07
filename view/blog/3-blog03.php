<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta charset="utf-8">
	<title>技术博客-CSS-柒柒的个人空间</title>
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
				<div style="height:600px;width:900px;margin:60px 0 0 100px;" id="article">
					<div class="message-title">
						<div class="titile-word"><span class="icons" style="margin:13px 15px; background-position:-95px 0px;"></span>CSS</div>
					</div>
					<div class="myMessage">
						<table>
							<thead>
								<tr> <th style="width:10%"></th> <th style="width:40%"></th> <th style="width:15%"></th> <th style="width:15%"></th> </tr>
							</thead>
							<tbody>
							</tbody>
						</table>
						<div class="finisher">
							<span>上一页</span><b style="background-color:rgb(245, 173, 85);color:rgb(51,51,51)">1</b><span>下一页</span> 
						</div>
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
var msg={
	name:'CSS',
	message:[{
		status:'转载',
		title:'亲，这就是透明边框',
		url:'3-01.php',
		name:'禹司凤',
		time:'2012-12-12',
	}
	]
};
(function(){  //显示blog文章
	for(var i in msg.message){
		if(msg.message[i].title.length>23){
			var y = setString(msg.message[i].title,39);
		}
		else{
			var y = msg.message[i].title;
		}
		var x = "<tr> <td><span class='message-status'>"+msg.message[i].status+"</span></td> <td><a href='"+msg.message[i].url+"'>"+y+"</a></td> <td>"+msg.message[i].name+"</td> <td>"+msg.message[i].time+"</td> </tr>";
		$(".myMessage tbody").append(x);
	}
}());
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
</script>
</html>