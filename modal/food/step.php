<?php
	//向step表新增记录
	function AddStep(){
		$foodId = $_GET["foodId"];
		$title = $_GET["title"];
		$cont = $_GET["cont"];
		$tips = $_GET["tips"];
		$img = $_GET["img"];
		$hasId = hasFoodId($foodId);

		if($foodId == ""){
			echoErrInfo(1,"id不能为空");
		}
		else if(empty($hasId)){
			echoErrInfo(2,"foodId不存在");
		}
		else if($title== ""){
			echoErrInfo(1,"标题不能为空");
		}
		else if($cont == ""){
			echoErrInfo(1,"内容不能为空");
		}
		else if($tips== ""){
			echoErrInfo(1,"tips不能为空");
		}
		else if($img == ""){
			echoErrInfo(1,"图片地址不能为空");
		}
		else{
			addStepToSql($foodId,$title,$cont,$tips,$img);
		}
	}//end func

	//把信息加入数据库
	function addStepToSql($foodId,$title,$cont,$tips,$img){
		include "../common/constant.php";
		include "../common/connectSQL.php";

		$foodId = escaped($foodId,$conn);
		$title = escaped($title,$conn);
		$cont = escaped($cont,$conn);
		$tips = escaped($tips,$conn);
		$img = escaped($img,$conn);

		$sql = "INSERT INTO step (FoodID,Title,Content,Tips,Img) VALUES ('$foodId','$title','$cont','$tips','$img')";

		if ($conn->query($sql) === TRUE) {
			$totalPage = getPageTotal("step",$foodId);
			$result -> errorCode = 0;
			$result -> emsg = "步骤添加成功";
			$result -> result = $totalPage;
		    echo json_encode($result);
		} else {
			echoErrInfo(2,"Error:" . $conn->error);
		}
		$conn->close();
	}//end func

	//获取步骤列表
	function GetStepList(){
		include "../common/constant.php";
		$page = $_GET["page"];
		$foodId = $_GET["foodId"];
		$hasId = hasFoodId($foodId);

		if($page && $page > 0){
			if(empty($hasId)){
				echoErrInfo(1,"foodId不存在");
			}
			else{
				$totalPage = getPageTotal("step",$foodId);
				$List = GetStepListFromSql($page,$foodId);
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

	//从数据库中获取步骤列表
	function GetStepListFromSql($page,$foodId){
		include "../common/connectSQL.php";
		if($page == 999){
			$sql = "SELECT * FROM step WHERE FoodID = $foodId order by ID asc";
		}
		else{
			$page = escaped($page,$conn) - 1;
			$sql = "SELECT * FROM step WHERE FoodID = $foodId order by ID asc limit ".($page * 12 ).",12";
		}
		
		$data = mysqli_query($conn,$sql);
		if (mysqli_num_rows($data) > 0) {
			$m = array();

		    while($row = mysqli_fetch_assoc($data)) {
		    	$item = new stdClass();
		    	$item -> id = $row["ID"];
		    	$item -> title = $row["Title"];
		    	$item -> cont = $row["Content"];
		    	$item -> tips = $row["Tips"];
		    	$item -> img = $row["Img"];
		        array_push($m,$item);
		    }

		    return $m;
		} else {
		    return false;
		}
	}//end func

	//获取一条美食博客的信息
	function GetStepOne(){
		$id = $_GET["id"];

		include "../common/constant.php";
		include "../common/connectSQL.php";
		$sql = "SELECT * FROM step WHERE ID = $id";
		$data = mysqli_query($conn,$sql);
		if (mysqli_num_rows($data) > 0) {
			$result -> errorCode = 0;
			$result -> emsg = "查询成功";
			$iresult = new stdClass();

		    while($row = mysqli_fetch_assoc($data)) {
		    	$iresult -> title = $row["Title"];
		    	$iresult -> content = $row["Content"];
		    	$iresult -> tips = $row["Tips"];
		    	$iresult -> img = $row["Img"];
		    }
		    $result -> result = $iresult;
		    echo json_encode($result);
		} else {
		    echoErrInfo(2,"查询错误");
		}
	}//end func

	//修改步骤
	function ChangeStep(){
		$id = $_GET["id"];
		$title = $_GET["title"];
		$cont = $_GET["cont"];
		$tips = $_GET["tips"];
		$img = $_GET["img"];

		if($id == ""){
			echoErrInfo(1,"id不能为空");
		}
		else if($title== ""){
			echoErrInfo(1,"标题不能为空");
		}
		else if($cont == ""){
			echoErrInfo(1,"内容不能为空");
		}
		else if($tips== ""){
			echoErrInfo(1,"tips不能为空");
		}
		else if($img == ""){
			echoErrInfo(1,"图片地址不能为空");
		}
		else{
			ChangeStepSql($id,$title,$cont,$tips,$img);
		}
	}//end func

	//修改数据库中步骤的信息
	function ChangeStepSql($id,$title,$cont,$tips,$img){
		include "../common/constant.php";
		include "../common/connectSQL.php";

		$id = escaped($id,$conn);
		$title = escaped($title,$conn);
		$cont = escaped($cont,$conn);
		$tips = escaped($tips,$conn);
		$img = escaped($img,$conn);

		$sql = "UPDATE step SET Title='$title',Content='$cont',Tips='$tips',Img='$img' WHERE ID = " . $id;

		if ($conn->query($sql) === TRUE) {
			$result -> errorCode = 0;
			$result -> emsg = "步骤修改成功";
		    echo json_encode($result);
		} else {
		    echoErrInfo(2,"Error:" . $conn->error);
		}
		$conn->close();
	}//end func
?>