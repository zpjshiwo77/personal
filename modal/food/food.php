<?php
	include "../common/common.php";
	include "../common/connectSQLconstant.php";
	include "../food/material.php";
	include "../food/step.php";

	// 路由的方法
	function routingMethod(){
		$m = $_GET["method"];

		switch ($m){
			case "AddFood":
				AddFood();
				break;
			case "DeleteFood":
				DeleteFood();
				break;
			case "GetFoodList":
				GetFoodList();
				break;
			case "GetFoodOne":
				GetFoodOne();
				break;
			case "ChangeFood":
				ChangeFood();
				break;
			case "AddMmaterial":
				AddMaterial("mmaterial");
				break;
			case "DeleteMmaterial":
				DeleteRecord("mmaterial");
				break;
			case "GetMmaterialList":
				GetMaterialList("mmaterial");
				break;
			case "AddNmaterial":
				AddMaterial("nmaterial");
				break;
			case "DeleteNmaterial":
				DeleteRecord("nmaterial");
				break;
			case "GetNmaterialList":
				GetMaterialList("nmaterial");
				break;
			case "AddStep":
				AddStep();
				break;
			case "DeleteStep":
				DeleteRecord("step");
				break;
			case "GetStepList":
				GetStepList();
				break;
			case "GetStepOne":
				GetStepOne();
				break;
			case "ChangeStep":
				ChangeStep();
				break;
			case "GetFoodDetail":
				GetFoodDetail();
				break;
			case "addAHite":
				addAHite();
		}
	}//end func
	routingMethod();


	
	//添加美食博客
	function AddFood(){
		$food = $_GET["food"];

		$name = $food["name"];
		$ename = $food["ename"];
		$addTime = $food["addTime"];
		$intro = $food["intro"];
		$hite = (int)$food["hite"];
		$simg = $food["simg"];
		$bimg = $food["bimg"];

		if($name == ""){
			echoErrInfo(1,"美食名字不能为空");
		}
		else if($ename == ""){
			echoErrInfo(1,"美食英文名字不能为空");
		}
		else if($addTime == ""){
			echoErrInfo(1,"添加时间不能为空");
		}
		else if($intro == ""){
			echoErrInfo(1,"美食简介不能为空");
		}
		else if($hite <= 0 || !is_int($hite)){
			echoErrInfo(1,"赞数必须为正整数");
		}
		else if($simg == ""){
			echoErrInfo(1,"不能为空");
		}
		else if($bimg == ""){
			echoErrInfo(1,"美食名字不能为空");
		}
		else{
			addFoodToSql($name,$ename,$addTime,$intro,$hite,$simg,$bimg);
		}
	}//end func

	//把美食博客基本信息加入数据库
	function addFoodToSql($name,$ename,$addTime,$intro,$hite,$simg,$bimg){
		include "../common/constant.php";
		include "../common/connectSQL.php";

		$name = escaped($name,$conn);
		$ename = escaped($ename,$conn);
		$intro = escaped($intro,$conn);
		$simg = escaped($simg,$conn);
		$bimg = escaped($bimg,$conn);

		$sql = "INSERT INTO food (Name,EName,AddTime,Intro,Hite,Simg,Bimg) VALUES ('$name','$ename','$addTime','$intro','$hite','$simg','$bimg')";

		if ($conn->query($sql) === TRUE) {
			$totalPage = getPageTotal("food");
			$result -> errorCode = 0;
			$result -> emsg = "新美食博客添加成功";
			$result -> result = $totalPage;
		    echo json_encode($result);
		} else {
			echoErrInfo(2,"Error:" . $conn->error);
		}
		$conn->close();
	}//end func

	//删除美食blog记录
	function DeleteFood(){
		$id = $_GET["id"];
		if(deleteFromFoodID("mmaterial",$id) && deleteFromFoodID("nmaterial",$id) && deleteFromFoodID("step",$id)){
			DeleteRecord("food");
		}
		else{
			getPageTotal(1,"删除失败");
		}
	}//end func

	//获取美食blog的列表
	function GetFoodList(){
		$page = $_GET["page"];

		if($page && $page > 0){
			include "../common/constant.php";
			include "../common/connectSQL.php";

			$page = escaped($page,$conn) - 1;

			$sql = "SELECT * FROM food order by id desc limit ".($page * 12 ).",12";
			$totalPage = getPageTotal("food");

			$data = mysqli_query($conn,$sql);
			if (mysqli_num_rows($data) > 0) {
				$result -> errorCode = 0;
				$result -> emsg = "查询成功";
				$foods = array();
				$iresult = new stdClass();

			    while($row = mysqli_fetch_assoc($data)) {
			    	$item = new stdClass();
			    	$item -> id = $row["ID"];
			    	$item -> name = $row["Name"];
			    	$item -> Ename = $row["EName"];
			    	$item -> img = $row["Simg"];
			    	$item -> time = $row["AddTime"];
			    	$item -> description = $row["Intro"];
			    	$item -> like = $row["Hite"];
			        array_push($foods,$item);
			    }

			    $iresult -> foods = $foods;
			    $iresult -> totalPage = $totalPage;
			    $result -> result = $iresult;
			    echo json_encode($result);
			} else {
			    echoErrInfo(1,"后面没有了~");
			}
		}
	}//end func

	//获取一条美食博客的信息
	function GetFoodOne(){
		$id = $_GET["id"];
		$hasId = hasFoodId($id);
		if(empty($hasId)){
			echoErrInfo(1,"foodId不存在");
		}
		else{
			include "../common/constant.php";
			include "../common/connectSQL.php";
			$sql = "SELECT * FROM food WHERE ID = $id";
			$data = mysqli_query($conn,$sql);
			if (mysqli_num_rows($data) > 0) {
				$result -> errorCode = 0;
				$result -> emsg = "查询成功";
				$iresult = new stdClass();

			    while($row = mysqli_fetch_assoc($data)) {
			    	$iresult -> name = $row["Name"];
			    	$iresult -> Ename = $row["EName"];
			    	$iresult -> addTime = $row["AddTime"];
			    	$iresult -> intro = $row["Intro"];
			    	$iresult -> hite = $row["Hite"];
			    	$iresult -> Simg = $row["Simg"];
			    	$iresult -> Bimg = $row["Bimg"];
			    }
			    $result -> result = $iresult;
			    echo json_encode($result);
			} else {
			    echoErrInfo(2,"查询错误");
			}
		}
	}//end func

	//修改美食博客
	function ChangeFood(){
		$food = $_GET["food"];

		$id = $food["id"];
		$name = $food["name"];
		$ename = $food["ename"];
		$addTime = $food["addTime"];
		$intro = $food["intro"];
		$hite = (int)$food["hite"];
		$simg = $food["simg"];
		$bimg = $food["bimg"];

		if($id == ""){
			echoErrInfo(1,"id不能为空");
		}
		else if($name == ""){
			echoErrInfo(1,"美食名字不能为空");
		}
		else if($ename == ""){
			echoErrInfo(1,"美食英文名字不能为空");
		}
		else if($addTime == ""){
			echoErrInfo(1,"添加时间不能为空");
		}
		else if($intro == ""){
			echoErrInfo(1,"美食简介不能为空");
		}
		else if($hite <= 0 || !is_int($hite)){
			echoErrInfo(1,"赞数必须为正整数");
		}
		else if($simg == ""){
			echoErrInfo(1,"不能为空");
		}
		else if($bimg == ""){
			echoErrInfo(1,"美食名字不能为空");
		}
		else{
			ChangeFoodSql($id,$name,$ename,$addTime,$intro,$hite,$simg,$bimg);
		}
	}//end func

	//修改数据库中美食博客的信息
	function ChangeFoodSql($id,$name,$ename,$addTime,$intro,$hite,$simg,$bimg){
		include "../common/constant.php";
		include "../common/connectSQL.php";

		$name = escaped($name,$conn);
		$ename = escaped($ename,$conn);
		$intro = escaped($intro,$conn);
		$simg = escaped($simg,$conn);
		$bimg = escaped($bimg,$conn);

		$sql = "UPDATE food SET Name='$name',EName='$ename',AddTime='$addTime',Intro='$intro',Hite='$hite',Simg='$simg',Bimg='$bimg' WHERE ID = " . $id;

		if ($conn->query($sql) === TRUE) {
			$result -> errorCode = 0;
			$result -> emsg = "美食博客修改成功";
		    echo json_encode($result);
		} else {
		    echoErrInfo(2,"Error:" . $conn->error);
		}
		$conn->close();
	}//end func

	//根据FoodId删除数据
	function deleteFromFoodID($sweat,$foodId){
		include "../common/connectSQL.php";

		if($foodId){
			$sql = "DELETE FROM " . $sweat . " WHERE FoodID = " . $foodId;
			if(mysqli_query($conn,$sql)){
				return true;
			}
			else{
		    	return false;
			}
		}

		return false;
	}//end func

	//判断美食blog是否存在
	function hasFoodId($foodId){
		include "../common/connectSQL.php";

		$foodId = escaped($foodId,$conn);
		$sql = "SELECT ID FROM food WHERE ID = '". $foodId ."'";
		$data = mysqli_fetch_array(mysqli_query($conn,$sql));
		$item = $data["ID"];
		return $item;
	}//end func

	//获取美食文章详细内容
	function GetFoodDetail(){
		$id = $_GET["id"];
		$hasId = hasFoodId($id);

		if(empty($hasId)){
			echoErrInfo(1,"foodId不存在");
		}
		else{
			include "../common/constant.php";
			include "../common/connectSQL.php";
			$sql = "SELECT * FROM food WHERE ID = $id";
			$data = mysqli_query($conn,$sql);
			if (mysqli_num_rows($data) > 0) {
				$result -> errorCode = 0;
				$result -> emsg = "查询成功";
				$iresult = new stdClass();

			    while($row = mysqli_fetch_assoc($data)) {
			    	$iresult -> name = $row["Name"];
			    	$iresult -> Ename = $row["EName"];
			    	$iresult -> img = $row["Bimg"];
			    }

			    $iresult -> m_material = GetMaterialListFromSql("mmaterial",999,$id);
			    $iresult -> n_material = GetMaterialListFromSql("nmaterial",999,$id);
			    $iresult -> step = GetStepListFromSql(999,$id);
			    $result -> result = $iresult;
			    echo json_encode($result);
			} else {
			    echoErrInfo(2,"查询错误");
			}
		}
		$conn->close();
	}//end func

	//新增一个点赞数
	function addAHite(){
		include "../common/connectSQL.php";
		$id = $_GET["id"];
		$id = escaped($id,$conn);

		$sql = "SELECT Hite From food WHERE ID = $id";
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

		$sql = "UPDATE food SET Hite='$hite' WHERE ID = " . $id;

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
?>	
