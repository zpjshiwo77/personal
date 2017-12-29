<?php
	//新增blog
	function addBlog(){
		$classId = $_POST["classId"];
		$hasId = hasBlogId("blog_class",$classId);

		$sign = $_POST["sign"];
		$title = $_POST["title"];
		$author = $_POST["author"];
		$time = $_POST["time"];
		$Content = $_POST["Content"];

		if(!isset($_SESSION['login']) || empty($_SESSION['login'])){
			echoErrInfo(110,"您没有权限");
		}
		else if(empty($hasId)){
			echoErrInfo(2,"分类不存在");
		}
		else if($sign == ""){
			echoErrInfo(1,"标签不能为空");
		}
		else if($title == ""){
			echoErrInfo(1,"标题不能为空");
		}
		else if($author == ""){
			echoErrInfo(1,"作者不能为空");
		}
		else if($time == ""){
			echoErrInfo(1,"时间不能为空");
		}
		else if($Content == ""){
			echoErrInfo(1,"内容不能为空");
		}
		else{
			addBlogToSql($classId,$sign,$title,$author,$time,$Content);
		}
	}//end func

	//添加进入数据库
	function addBlogToSql($classId,$sign,$title,$author,$time,$Content){
		include "../common/constant.php";
		include "../common/connectSQL.php";

		$sign = escaped($sign,$conn);
		$title = escaped($title,$conn);
		$author = escaped($author,$conn);

		$sql = "INSERT INTO blog (ClassId,Sign,Title,Author,Time,Content) VALUES ('$classId','$sign','$title','$author','$time','$Content')";

		if ($conn->query($sql) === TRUE) {
			$totalPage = getPageTotal("blog");
			$result -> errorCode = 0;
			$result -> emsg = "博客添加成功";
			$result -> result = $totalPage;
		    echo json_encode($result);
		} else {
			echoErrInfo(2,"Error:" . $conn->error);
		}
		$conn->close();
	}//end func

	//删除blog记录
	function deleteBlog(){
		$id = $_GET["id"];
		$hasId = hasBlogId("blog",$id);

		if(!isset($_SESSION['login']) || empty($_SESSION['login'])){
			echoErrInfo(110,"您没有权限");
		}
		else if(empty($hasId)){
			echoErrInfo(2,"BlogID不存在");
		}
		else{
			DeleteRecord("blog");
		}
	}//end func

	//获取blog总页码数
	function getBlogTotalPage(){
		include "../common/constant.php";
		$id = $_GET["id"];
		if($id == 0) $totalPage = getPageTotal("blog");
		else $totalPage = getPageTotal("blog",$id,"ClassID");
		$result -> errorCode = 0;
		$result -> emsg = "查询成功";
		$result -> result = $totalPage;
	    echo json_encode($result);
	}//end func

	//判断blog是否存在
	function hasBlogId($sweat,$BlogId){
		include "../common/connectSQL.php";

		$BlogId = escaped($BlogId,$conn);
		$sql = "SELECT ID FROM $sweat WHERE ID = '". $BlogId ."'";
		$data = mysqli_fetch_array(mysqli_query($conn,$sql));
		$item = $data["ID"];
		return $item;
	}//end func

	//获取blog的列表
	function getBlogList(){
		$page = $_GET["page"];
		$classId = $_GET["classId"];
		$hasId = hasBlogId("blog_class",$classId);

		if(empty($hasId) && $classId != 0){
			echoErrInfo(1,"分类不存在");
			return;
		}

		if($page && $page > 0){
			include "../common/constant.php";
			include "../common/connectSQL.php";

			$page = escaped($page,$conn) - 1;

			if($_GET["classId"] == 0) $sql = "SELECT * FROM blog order by Id desc limit ".($page * 12 ).",12";
			else $sql = "SELECT * FROM blog WHERE ClassId = $classId order by Id desc limit ".($page * 12 ).",12";
			$totalPage = getPageTotal("blog",$classId,"ClassID");

			$data = mysqli_query($conn,$sql);
			if (mysqli_num_rows($data) > 0) {
				$result -> errorCode = 0;
				$result -> emsg = "查询成功";
				$blogs = array();
				$iresult = new stdClass();

			    while($row = mysqli_fetch_assoc($data)) {
			    	$item = new stdClass();
			    	$item -> classId = $row["ClassID"];
			    	$item -> id = $row["ID"];
			    	$item -> sign = $row["Sign"];
			    	$item -> title = $row["Title"];
			    	$item -> author = $row["Author"];
			    	$item -> time = $row["Time"];
			        array_push($blogs,$item);
			    }

			    $iresult -> blogs = $blogs;
			    $iresult -> totalPage = $totalPage;
			    $result -> result = $iresult;
			    echo json_encode($result);
			} else {
			    echoErrInfo(1,"后面没有了~");
			}
		}
	}//end func

	//获取一条博客的信息
	function getBlogDetail(){
		$id = $_GET["id"];
		$hasId = hasBlogId("blog",$id);
		if(empty($hasId)){
			echoErrInfo(1,"blog不存在");
		}
		else{
			include "../common/constant.php";
			include "../common/connectSQL.php";
			$sql = "SELECT * FROM blog WHERE ID = $id";
			$data = mysqli_query($conn,$sql);
			if (mysqli_num_rows($data) > 0) {
				$result -> errorCode = 0;
				$result -> emsg = "查询成功";
				$iresult = new stdClass();

			    while($row = mysqli_fetch_assoc($data)) {
			    	$iresult -> classId = $row["ClassID"];
			    	$iresult -> sign = $row["Sign"];
			    	$iresult -> title = $row["Title"];
			    	$iresult -> author = $row["Author"];
			    	$iresult -> time = $row["Time"];
			    	$iresult -> Content = $row["Content"];
			    }
			    $result -> result = $iresult;
			    echo json_encode($result);
			} else {
			    echoErrInfo(2,"查询错误");
			}
		}
	}//end func

	//修改博客
	function changeBlog(){
		$id = $_POST["id"];
		$hasId = hasBlogId("blog",$id);

		$classId = $_POST["classId"];
		$sign = $_POST["sign"];
		$title = $_POST["title"];
		$author = $_POST["author"];
		$time = $_POST["time"];
		$Content = $_POST["Content"];

		if(!isset($_SESSION['login']) || empty($_SESSION['login'])){
			echoErrInfo(110,"您没有权限");
		}
		else if(empty($hasId)){
			echoErrInfo(2,"博客不存在");
		}
		else if($sign == ""){
			echoErrInfo(1,"标签不能为空");
		}
		else if($title == ""){
			echoErrInfo(1,"标题不能为空");
		}
		else if($author == ""){
			echoErrInfo(1,"作者不能为空");
		}
		else if($time == ""){
			echoErrInfo(1,"时间不能为空");
		}
		else if($Content == ""){
			echoErrInfo(1,"内容不能为空");
		}
		else{
			ChangeBlogSql($id,$classId,$sign,$title,$author,$time,$Content);
		}
	}//end func

	//修改数据库中博客的信息
	function ChangeBlogSql($id,$classId,$sign,$title,$author,$time,$Content){
		include "../common/constant.php";
		include "../common/connectSQL.php";

		$sign = escaped($sign,$conn);
		$title = escaped($title,$conn);
		$author = escaped($author,$conn);

		$sql = "UPDATE blog SET Sign='$sign',ClassID='$classId',Title='$title',Author='$author',Time='$time',Content='$Content' WHERE ID = " . $id;

		if ($conn->query($sql) === TRUE) {
			$result -> errorCode = 0;
			$result -> emsg = "博客修改成功";
		    echo json_encode($result);
		} else {
		    echoErrInfo(2,"Error:" . $conn->error);
		}
		$conn->close();
	}//end func
?>