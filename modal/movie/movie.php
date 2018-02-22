<?php
	session_start();
	include "../common/common.php";
	include "../common/connectSQLconstant.php";

	// 路由的方法
	function routingMethod(){
		$m = $_REQUEST["method"];
		switch ($m){
			case "addMovie":
				addMovie();
				break;
			case "getMovieList":
				getMovieList("all");
				break;
			case "getBannerList":
				getMovieList("banner");
				break;
			case "getNormalList":
				getMovieList("normal");
				break;
			case "getMovieDetail":
				getMovieDetail();
				break;
			case "changeMovie":
				changeMovie();
				break;
			case "deleteMovie":
				deleteMovie();
				break;
			case "getTotalPage":
				getMovieTotalPage();
				break;
			case "addAHite":
				addAHite();
		}		
	}//end func
	routingMethod();

	//新增一个点赞数
	function addAHite(){
		include "../common/connectSQL.php";
		$id = $_GET["id"];
		$id = escaped($id,$conn);

		$sql = "SELECT Hite From movie WHERE ID = $id";
		$data = mysqli_query($conn,$sql);
		if (mysqli_num_rows($data) > 0) {
		    while($row = mysqli_fetch_assoc($data)) {
		    	$hite = $row["Hite"] + 1;
		    }
			updateHite($id,$hite);
		} else {
		    echoErrInfo(1,"foodId不存在");
		}
		$conn->close();
	}//end func

	//更新点赞数
	function updateHite($id,$hite){
		include "../common/constant.php";
		include "../common/connectSQL.php";

		$sql = "UPDATE movie SET Hite='$hite' WHERE ID = " . $id;

		if ($conn->query($sql) === TRUE) {
			$result -> errorCode = 0;
			$result -> emsg = "点赞成功~";
			$result -> result = $hite;
		    echo json_encode($result);
		} else {
		    echoErrInfo(2,"Error:" . $conn->error);
		}
		$conn->close();
	}//end func

	//获取电影总页码
	function getMovieTotalPage(){
		include "../common/constant.php";
		$totalPage = getPageTotal("movie");
		$result -> errorCode = 0;
		$result -> emsg = "查询成功";
		$result -> result = $totalPage;
	    echo json_encode($result);
	}//end func

	//新增电影
	function addMovie(){
		$poster = $_POST["poster"];
		$recommend = $_POST["recommend"];
		$name = $_POST["name"];
		$hite = $_POST["hite"];
		$DBurl = $_POST["DBurl"];
		$intro = $_POST["intro"];

		if(!isset($_SESSION['login']) || empty($_SESSION['login'])){
			echoErrInfo(110,"您没有权限");
		}
		else if($poster == ""){
			echoErrInfo(2,"海报不能为空");
		}
		else if($recommend == ""){
			echoErrInfo(1,"推荐不能为空");
		}
		else if($name == ""){
			echoErrInfo(1,"名称不能为空");
		}
		else if($hite == ""){
			echoErrInfo(1,"点赞数不能为空");
		}
		else if($DBurl == ""){
			echoErrInfo(1,"外链不能为空");
		}
		else if($intro == ""){
			echoErrInfo(1,"简介不能为空");
		}
		else{
			addMovieToSql($poster,$recommend,$name,$hite,$DBurl,$intro);
		}
	}//end func

	//添加进入数据库
	function addMovieToSql($poster,$recommend,$name,$hite,$DBurl,$intro){
		include "../common/constant.php";
		include "../common/connectSQL.php";

		$poster = escaped($poster,$conn);
		$recommend = escaped($recommend,$conn);
		$name = escaped($name,$conn);
		$hite = escaped($hite,$conn);
		$DBurl = escaped($DBurl,$conn);
		$intro = escaped($intro,$conn);

		$sql = "INSERT INTO movie (Poster,Recommend,Name,Hite,DBurl,Intro) VALUES ('$poster','$recommend','$name','$hite','$DBurl','$intro')";

		if ($conn->query($sql) === TRUE) {
			$totalPage = getPageTotal("movie");
			$result -> errorCode = 0;
			$result -> emsg = "电影添加成功";
			$result -> result = $totalPage;
		    echo json_encode($result);
		} else {
			echoErrInfo(2,"Error:" . $conn->error);
		}
		$conn->close();
	}//end func

	//删除电影记录
	function deleteMovie(){
		$id = $_GET["id"];
		$hasId = hasMovieId("movie",$id);

		if(!isset($_SESSION['login']) || empty($_SESSION['login'])){
			echoErrInfo(110,"您没有权限");
		}
		else if(empty($hasId)){
			echoErrInfo(2,"movieID不存在");
		}
		else{
			DeleteRecord("movie");
		}
	}//end func

	//判断电影是否存在
	function hasMovieId($sweat,$ID){
		include "../common/connectSQL.php";

		$ID = escaped($ID,$conn);
		$sql = "SELECT ID FROM $sweat WHERE ID = '". $ID ."'";
		$data = mysqli_fetch_array(mysqli_query($conn,$sql));
		$item = $data["ID"];
		return $item;
	}//end func

	//获取电影的列表
	function getMovieList($type){
		$page = $_GET["page"];

		if($page && $page > 0){
			include "../common/constant.php";
			include "../common/connectSQL.php";

			$page = escaped($page,$conn) - 1;

			if($type == "all") $sql = "SELECT * FROM movie order by ID desc limit ".($page * 12 ).",12";
			else if($type == "banner") $sql = "SELECT * FROM movie WHERE Recommend = 1 order by ID desc limit ".($page * 12 ).",12";
			else if($type == "normal") $sql = "SELECT * FROM movie WHERE Recommend = 0 order by ID desc limit ".($page * 10 ).",10";

			$totalPage = getPageTotal("movie");

			$data = mysqli_query($conn,$sql);
			if (mysqli_num_rows($data) > 0) {
				$result -> errorCode = 0;
				$result -> emsg = "查询成功";
				$movies = array();
				$iresult = new stdClass();

			    while($row = mysqli_fetch_assoc($data)) {
			    	$item = new stdClass();
			    	$item -> id = $row["ID"];
			    	$item -> name = $row["Name"];
			    	$item -> poster = $row["Poster"];
			    	$item -> recommend = $row["Recommend"];
			    	$item -> hite = $row["Hite"];
			    	$item -> DBurl = $row["DBurl"];
			    	$item -> intro = $row["Intro"];
			        array_push($movies,$item);
			    }

			    $iresult -> movies = $movies;
			    $iresult -> totalPage = $totalPage;
			    $result -> result = $iresult;
			    echo json_encode($result);
			} else {
			    echoErrInfo(1,"后面没有了~");
			}
		}
	}//end func

	//获取一条电影的信息
	function getMovieDetail(){
		$id = $_GET["id"];
		$hasId = hasMovieId("movie",$id);
		if(empty($hasId)){
			echoErrInfo(1,"电影不存在");
		}
		else{
			include "../common/constant.php";
			include "../common/connectSQL.php";
			$sql = "SELECT * FROM movie WHERE ID = $id";
			$data = mysqli_query($conn,$sql);
			if (mysqli_num_rows($data) > 0) {
				$result -> errorCode = 0;
				$result -> emsg = "查询成功";
				$iresult = new stdClass();

			    while($row = mysqli_fetch_assoc($data)) {
			    	$iresult -> name = $row["Name"];
			    	$iresult -> poster = $row["Poster"];
			    	$iresult -> recommend = $row["Recommend"];
			    	$iresult -> hite = $row["Hite"];
			    	$iresult -> DBurl = $row["DBurl"];
			    	$iresult -> intro = $row["Intro"];
			    }
			    $result -> result = $iresult;
			    echo json_encode($result);
			} else {
			    echoErrInfo(2,"查询错误");
			}
		}
	}//end func

	//修改电影详细信息
	function changeMovie(){
		$id = $_POST["id"];
		$hasId = hasMovieId("movie",$id);

		$poster = $_POST["poster"];
		$recommend = $_POST["recommend"];
		$name = $_POST["name"];
		$hite = $_POST["hite"];
		$DBurl = $_POST["DBurl"];
		$intro = $_POST["intro"];

		if(!isset($_SESSION['login']) || empty($_SESSION['login'])){
			echoErrInfo(110,"您没有权限");
		}
		else if($poster == ""){
			echoErrInfo(2,"海报不能为空");
		}
		else if($recommend == ""){
			echoErrInfo(1,"推荐不能为空");
		}
		else if($name == ""){
			echoErrInfo(1,"名称不能为空");
		}
		else if($hite == ""){
			echoErrInfo(1,"点赞数不能为空");
		}
		else if($DBurl == ""){
			echoErrInfo(1,"外链不能为空");
		}
		else if($intro == ""){
			echoErrInfo(1,"简介不能为空");
		}
		else{
			ChangeMovieSql($id,$poster,$recommend,$name,$hite,$DBurl,$intro);
		}
	}//end func

	//修改数据库中博客的信息
	function ChangeMovieSql($id,$poster,$recommend,$name,$hite,$DBurl,$intro){
		include "../common/constant.php";
		include "../common/connectSQL.php";

		$poster = escaped($poster,$conn);
		$recommend = escaped($recommend,$conn);
		$name = escaped($name,$conn);
		$hite = escaped($hite,$conn);
		$DBurl = escaped($DBurl,$conn);
		$intro = escaped($intro,$conn);

		$sql = "UPDATE movie SET Poster='$poster',Recommend='$recommend',Name='$name',Hite='$hite',DBurl='$DBurl',Intro='$intro' WHERE ID = " . $id;

		if ($conn->query($sql) === TRUE) {
			$result -> errorCode = 0;
			$result -> emsg = "电影修改成功";
		    echo json_encode($result);
		} else {
		    echoErrInfo(2,"Error:" . $conn->error);
		}
		$conn->close();
	}//end func
?>