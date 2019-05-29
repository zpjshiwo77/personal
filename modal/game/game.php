<?php
	session_start();
	include "../common/common.php";
	include "../common/connectSQLconstant.php";

	// 路由的方法
	function routingMethod(){
		$m = $_REQUEST["method"];
		switch ($m){
			case "addGame":
                addGame();
				break;
			case "getGameList":
                getGameList();
				break;
			case "getGameDetail":
                getGameDetail();
				break;
			case "changeGame":
				changeGame();
				break;
			case "deleteGame":
				deleteGame();
				break;
			case "getTotalPage":
				getGameTotalPage();
				break;
		}		
	}//end func
	routingMethod();

	//获取游戏总页码
	function getGameTotalPage(){
		include "../common/constant.php";
		$totalPage = getPageTotal("game");
		$result -> errorCode = 0;
		$result -> emsg = "查询成功";
		$result -> result = $totalPage;
	    echo json_encode($result);
	}//end func

	//新增游戏
	function addGame(){
		$Name = $_POST["Name"];
		$SImg = $_POST["SImg"];
		$Type = $_POST["Type"];
		$Url = $_POST["Url"];

		if(!isset($_SESSION['login']) || empty($_SESSION['login'])){
			echoErrInfo(110,"您没有权限");
		}
		else if($Name == ""){
			echoErrInfo(2,"名称不能为空");
		}
		else if($SImg == ""){
			echoErrInfo(1,"缩略图不能为空");
		}
		else if($Type == ""){
			echoErrInfo(1,"类型不能为空");
		}
		else if($Url == ""){
			echoErrInfo(1,"链接不能为空");
		}
		else{
			addGameToSql($Name,$SImg,$Type,$Url);
		}
	}//end func

	//添加进入数据库
	function addGameToSql($Name,$SImg,$Type,$Url){
		include "../common/constant.php";
		include "../common/connectSQL.php";

		$Name = escaped($Name,$conn);
		$SImg = escaped($SImg,$conn);
		$Type = escaped($Type,$conn);
		$Url = escaped($Url,$conn);

		$sql = "INSERT INTO game (Name,SImg,Type,Url) VALUES ('$Name','$SImg','$Type','$Url')";

		if ($conn->query($sql) === TRUE) {
			$totalPage = getPageTotal("game");
			$result -> errorCode = 0;
			$result -> emsg = "游戏添加成功";
			$result -> result = $totalPage;
		    echo json_encode($result);
		} else {
			echoErrInfo(2,"Error:" . $conn->error);
		}
		$conn->close();
	}//end func

	//删除游戏记录
	function deleteGame(){
		$ID = $_GET["id"];
		$hasId = hasGameId("game",$ID);

		if(!isset($_SESSION['login']) || empty($_SESSION['login'])){
			echoErrInfo(110,"您没有权限");
		}
		else if(empty($hasId)){
			echoErrInfo(2,"游戏ID不存在");
		}
		else{
			DeleteRecord("game");
		}
	}//end func

	//判断是否存在
	function hasGameId($sweat,$ID){
		include "../common/connectSQL.php";

		$ID = escaped($ID,$conn);
		$sql = "SELECT ID FROM $sweat WHERE ID = '". $ID ."'";
		$data = mysqli_fetch_array(mysqli_query($conn,$sql));
		$item = $data["ID"];
		return $item;
	}//end func

	//获取游戏的列表
	function getGameList(){
		$page = $_GET["page"];

		if($page && $page > 0){
			include "../common/constant.php";
			include "../common/connectSQL.php";

			$page = escaped($page,$conn) - 1;

			$sql = "SELECT * FROM game order by ID desc limit ".($page * 12 ).",12";

			$totalPage = getPageTotal("game");

			$data = mysqli_query($conn,$sql);
			if (mysqli_num_rows($data) > 0) {
				$result -> errorCode = 0;
				$result -> emsg = "查询成功";
				$games = array();
				$iresult = new stdClass();

			    while($row = mysqli_fetch_assoc($data)) {
			    	$item = new stdClass();
			    	$item -> ID = $row["ID"];
			    	$item -> Name = $row["Name"];
			    	$item -> SImg = $row["SImg"];
			    	$item -> Type = $row["Type"];
			    	$item -> Url = $row["Url"];
			        array_push($games,$item);
			    }

			    $iresult -> games = $games;
			    $iresult -> totalPage = $totalPage;
			    $result -> result = $iresult;
			    echo json_encode($result);
			} else {
			    echoErrInfo(1,"后面没有了~");
			}
		}
	}//end func

	//获取一条游戏的信息
	function getGameDetail(){
		$ID = $_GET["id"];
		$hasId = hasGameId("game",$ID);
		if(empty($hasId)){
			echoErrInfo(1,"游戏不存在");
		}
		else{
			include "../common/constant.php";
			include "../common/connectSQL.php";
			$sql = "SELECT * FROM game WHERE ID = $ID";
			$data = mysqli_query($conn,$sql);
			if (mysqli_num_rows($data) > 0) {
				$result -> errorCode = 0;
				$result -> emsg = "查询成功";
				$iresult = new stdClass();

			    while($row = mysqli_fetch_assoc($data)) {
			    	$iresult -> Name = $row["Name"];
			    	$iresult -> SImg = $row["SImg"];
			    	$iresult -> Type = $row["Type"];
			    	$iresult -> Url = $row["Url"];
			    }
			    $result -> result = $iresult;
			    echo json_encode($result);
			} else {
			    echoErrInfo(2,"查询错误");
			}
		}
	}//end func

	//修改游戏详细信息
	function changeGame(){
		$ID = $_POST["id"];
		$hasId = hasGameId("game",$ID);

		$Name = $_POST["Name"];
		$SImg = $_POST["SImg"];
		$Type = $_POST["Type"];
		$Url = $_POST["Url"];

		if(!isset($_SESSION['login']) || empty($_SESSION['login'])){
			echoErrInfo(110,"您没有权限");
		}
		else if($Name == ""){
			echoErrInfo(2,"名称不能为空");
		}
		else if($SImg == ""){
			echoErrInfo(1,"缩略图不能为空");
		}
		else if($Type == ""){
			echoErrInfo(1,"类型不能为空");
		}
		else if($Url == ""){
			echoErrInfo(1,"链接不能为空");
		}
		else{
			ChangeGameSql($ID,$Name,$SImg,$Type,$Url);
		}
	}//end func

	//修改数据库中的信息
	function ChangeGameSql($ID,$Name,$SImg,$Type,$Url){
		include "../common/constant.php";
		include "../common/connectSQL.php";

        $ID = escaped($ID,$conn);
		$Name = escaped($Name,$conn);
		$SImg = escaped($SImg,$conn);
		$Type = escaped($Type,$conn);
		$Url = escaped($Url,$conn);

		$sql = "UPDATE game SET Name='$Name',SImg='$SImg',Type='$Type',Url='$Url' WHERE ID = " . $ID;

		if ($conn->query($sql) === TRUE) {
			$result -> errorCode = 0;
			$result -> emsg = "游戏修改成功";
		    echo json_encode($result);
		} else {
		    echoErrInfo(2,"Error:" . $conn->error);
		}
		$conn->close();
	}//end func
?>