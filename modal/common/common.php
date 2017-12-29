<?php
//转义sql语句
function escaped($s,$conn){
	if (get_magic_quotes_gpc()) 
	{
	  $s = stripslashes($s);
	}
	$s = mysqli_real_escape_string($conn, $s);
	return $s;
}//end func

//输出错误信息
function echoErrInfo($code,$word){
	include "../common/constant.php";
	$result -> errorCode = $code;
	$result -> emsg = $word;
    echo json_encode($result);
}//end func

//获取页码总数
function getPageTotal($sweat,$id = 0,$letter = "FoodID"){
	include "../common/connectSQL.php";
	
	if(!empty($id) && $id != 0) {
		$sqlCount = "SELECT COUNT(*) as count FROM $sweat WHERE $letter = $id";
		$CountResult = mysqli_fetch_assoc(mysqli_query($conn,$sqlCount));
	}
	else{
		$sqlCount = "SELECT COUNT(*) as count FROM " . $sweat;
		$CountResult = mysqli_fetch_assoc(mysqli_query($conn,$sqlCount));
	}
	$totalPage = ceil($CountResult["count"] / 12);

	return $totalPage;
}//end func

//删除$sweat表的id的记录
function DeleteRecord($sweat){
	include "../common/constant.php";
	include "../common/connectSQL.php";
	$id = $_GET["id"];
	if(!isset($_SESSION['login']) || empty($_SESSION['login'])){
		echoErrInfo(110,"您没有权限");
	}
	else if($id){
		$sql = "DELETE FROM " . $sweat . " WHERE id = " . $id;
		if(mysqli_query($conn,$sql)){
			$totalPage = getPageTotal($sweat);
			$result -> errorCode = 0;
			$result -> emsg = "删除成功";
			$result -> result = $totalPage;
	    	echo json_encode($result);
		}
		else{
	    	getPageTotal(1,"删除失败");
		}
	}
}//end func
?>