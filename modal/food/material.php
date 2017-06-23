<?php
	//像$sweat表新增记录
	function AddMaterial($sweat){
		$foodId = $_GET["foodId"];
		$name = $_GET["name"];
		$count = $_GET["count"];
		$hasId = hasFoodId($foodId);

		if($foodId == ""){
			echoErrInfo(1,"id不能为空");
		}
		else if(empty($hasId)){
			echoErrInfo(2,"foodId不存在");
		}
		else if($name== ""){
			echoErrInfo(1,"名字不能为空");
		}
		else if($count == ""){
			echoErrInfo(1,"数量不能为空");
		}
		else{
			addMaterialToSql($sweat,$foodId,$name,$count);
		}
	}//end func

	//把信息加入数据库
	function addMaterialToSql($sweat,$foodId,$name,$count){
		include "../common/constant.php";
		include "../common/connectSQL.php";

		$foodId = escaped($foodId,$conn);
		$name = escaped($name,$conn);
		$count = escaped($count,$conn);

		$sql = "INSERT INTO $sweat (FoodID,Name,Count) VALUES ('$foodId','$name','$count')";

		if ($conn->query($sql) === TRUE) {
			$totalPage = getPageTotal($sweat,$foodId);
			$result -> errorCode = 0;
			$result -> emsg = "材料添加成功";
			$result -> result = $totalPage;
		    echo json_encode($result);
		} else {
			echoErrInfo(2,"Error:" . $conn->error);
		}
		$conn->close();
	}//end func

	//获取材料列表
	function GetMaterialList($sweat){
		include "../common/constant.php";
		$page = $_GET["page"];
		$foodId = $_GET["foodId"];
		$hasId = hasFoodId($foodId);

		if($page && $page > 0){
			if(empty($hasId)){
				echoErrInfo(1,"foodId不存在");
			}
			else{
				$totalPage = getPageTotal($sweat,$foodId);
				$List = GetMaterialListFromSql($sweat,$page,$foodId);
				if($List){
					$iresult = new stdClass();
					$result -> errorCode = 0;
					$result -> emsg = "查询成功";
					$iresult -> ilist = $List;
				    $iresult -> totalPage = $totalPage;
				    $result -> result = $iresult;
				    echo json_encode($result);
				}
				else{
					echoErrInfo(2,"后面没有了~");
				}
			}
		}
	}//end func

	//从数据库中获取材料列表
	function GetMaterialListFromSql($sweat,$page,$foodId){
		include "../common/connectSQL.php";
		if($page == 999){
			$sql = "SELECT * FROM $sweat WHERE FoodID = $foodId order by ID asc";
		}
		else{
			$page = escaped($page,$conn) - 1;
			$sql = "SELECT * FROM $sweat WHERE FoodID = $foodId order by ID asc limit ".($page * 12 ).",12";
		}
		
		$data = mysqli_query($conn,$sql);
		if (mysqli_num_rows($data) > 0) {
			$m = array();

		    while($row = mysqli_fetch_assoc($data)) {
		    	$item = new stdClass();
		    	$item -> id = $row["ID"];
		    	$item -> name = $row["Name"];
		    	$item -> num = $row["Count"];
		        array_push($m,$item);
		    }

		    return $m;
		} else {
		    return false;
		}
	}//end func
?>