<?php
	//新增Case
	function addCase(){
		$classId = $_POST["classId"];
		$hasId = hasCaseId("case_class",$classId);

		$ctype = $_POST["type"];
		$cbanner = $_POST["banner"];
		$cname = $_POST["name"];
		$ctime = $_POST["time"];
		$cintro = $_POST["intro"];
		$clabel = $_POST["label"];
		$curl = $_POST["url"];

		if(!isset($_SESSION['login']) || empty($_SESSION['login'])){
			echoErrInfo(110,"您没有权限");
		}
		else if(empty($hasId)){
			echoErrInfo(2,"分类不存在");
		}
		else if($cbanner == ""){
			echoErrInfo(1,"图片不能为空");
		}
		else if($cname == ""){
			echoErrInfo(1,"名称不能为空");
		}
		else if($cintro == ""){
			echoErrInfo(1,"介绍不能为空");
		}
		else if($clabel == ""){
			echoErrInfo(1,"标签不能为空");
        }
        else if($curl == ""){
			echoErrInfo(1,"地址不能为空");
		}
		else{
			addCaseToSql($classId,$ctype,$cbanner,$cname,$ctime,$cintro,$clabel,$curl);
		}
	}//end func

	//添加进入数据库
	function addCaseToSql($classId,$ctype,$cbanner,$cname,$ctime,$cintro,$clabel,$curl){
		include "../common/constant.php";
		include "../common/connectSQL.php";

		$cname = escaped($cname,$conn);
        $cintro = escaped($cintro,$conn);
        $clabel = escaped($clabel,$conn);

		$sql = "INSERT INTO showcase (ClassId,Type,Banner,Name,AddTime,Intro,Label,Url) VALUES ('$classId','$ctype','$cbanner','$cname','$ctime','$cintro','$clabel','$curl')";

		if ($conn->query($sql) === TRUE) {
			$totalPage = getPageTotal("showcase");
			$result -> errorCode = 0;
			$result -> emsg = "案例添加成功";
			$result -> result = $totalPage;
		    echo json_encode($result);
		} else {
			echoErrInfo(2,"Error:" . $conn->error);
		}
		$conn->close();
	}//end func

	//删除记录
	function deleteCase(){
		$id = $_GET["id"];
		$hasId = hasCaseId("showcase",$id);

		if(!isset($_SESSION['login']) || empty($_SESSION['login'])){
			echoErrInfo(110,"您没有权限");
		}
		else if(empty($hasId)){
			echoErrInfo(2,"案例ID不存在");
		}
		else{
			DeleteRecord("showcase");
		}
	}//end func

	//获取总页码数
	function getCaseTotalPage(){
		include "../common/constant.php";
		$id = $_GET["id"];
		if($id == 0) $totalPage = getPageTotal("showcase");
		else $totalPage = getPageTotal("showcase",$id,"ClassID");
		$result -> errorCode = 0;
		$result -> emsg = "查询成功";
		$result -> result = $totalPage;
	    echo json_encode($result);
	}//end func

	//判断类型是否存在
	function hasCaseId($sweat,$Id){
		include "../common/connectSQL.php";

		$Id = escaped($Id,$conn);
		$sql = "SELECT ID FROM $sweat WHERE ID = '". $Id ."'";
		$data = mysqli_fetch_array(mysqli_query($conn,$sql));
		$item = $data["ID"];
		return $item;
	}//end func

	//获取案例的列表
	function getCaseList(){
		$page = $_GET["page"];
		$classId = $_GET["classId"];
		$hasId = hasCaseId("case_class",$classId);

		if(empty($hasId) && $classId != 0){
			echoErrInfo(1,"分类不存在");
			return;
		}

		if($page && $page > 0){
			include "../common/constant.php";
			include "../common/connectSQL.php";

			$page = escaped($page,$conn) - 1;

			if($_GET["classId"] == 0) $sql = "SELECT * FROM showcase order by Id desc limit ".($page * 12 ).",12";
			else $sql = "SELECT * FROM showcase WHERE ClassId = $classId order by Id desc limit ".($page * 12 ).",12";
			$totalPage = getPageTotal("showcase",$classId,"ClassID");

			$data = mysqli_query($conn,$sql);
			if (mysqli_num_rows($data) > 0) {
				$result -> errorCode = 0;
				$result -> emsg = "查询成功";
				$cases = array();
				$iresult = new stdClass();

			    while($row = mysqli_fetch_assoc($data)) {
			    	$item = new stdClass();
			    	$item -> classId = $row["ClassID"];
			    	$item -> id = $row["ID"];
			    	$item -> type = $row["Type"];
			    	$item -> banner = $row["Banner"];
			    	$item -> name = $row["Name"];
                    $item -> time = $row["AddTime"];
                    $item -> intro = $row["Intro"];
			    	$item -> label = $row["Label"];
			    	$item -> url = $row["Url"];
                    array_push($cases,$item);
			    }

			    $iresult -> cases = $cases;
			    $iresult -> totalPage = $totalPage;
			    $result -> result = $iresult;
			    echo json_encode($result);
			} else {
			    echoErrInfo(1,"后面没有了~");
			}
		}
    }//end func
    
    //获取一条案例的信息
	function getCaseDetail(){
		$ID = $_GET["id"];
        $hasId = hasCaseId("showcase",$ID);
		if(empty($hasId)){
			echoErrInfo(1,"案例不存在");
		}
		else{
			include "../common/constant.php";
			include "../common/connectSQL.php";
			$sql = "SELECT * FROM showcase WHERE ID = $ID";
			$data = mysqli_query($conn,$sql);
			if (mysqli_num_rows($data) > 0) {
				$result -> errorCode = 0;
				$result -> emsg = "查询成功";
				$iresult = new stdClass();

			    while($row = mysqli_fetch_assoc($data)) {
                    $iresult -> classId = $row["ClassID"];
			    	$iresult -> id = $row["ID"];
			    	$iresult -> type = $row["Type"];
			    	$iresult -> banner = $row["Banner"];
			    	$iresult -> name = $row["Name"];
                    $iresult -> time = $row["AddTime"];
                    $iresult -> intro = $row["Intro"];
			    	$iresult -> label = $row["Label"];
			    	$iresult -> url = $row["Url"];
			    }
			    $result -> result = $iresult;
			    echo json_encode($result);
			} else {
			    echoErrInfo(2,"查询错误");
			}
		}
	}//end func

	//修改案例
	function changeCase(){
		$id = $_POST["id"];
		$hasId = hasCaseId("showcase",$id);

        $classId = $_POST["classId"];
		$ctype = $_POST["type"];
		$cbanner = $_POST["banner"];
		$cname = $_POST["name"];
		$ctime = $_POST["time"];
		$cintro = $_POST["intro"];
		$clabel = $_POST["label"];
		$curl = $_POST["url"];

		if(!isset($_SESSION['login']) || empty($_SESSION['login'])){
			echoErrInfo(110,"您没有权限");
		}
		else if(empty($hasId)){
			echoErrInfo(2,"分类不存在");
		}
		else if($cbanner == ""){
			echoErrInfo(1,"图片不能为空");
		}
		else if($cname == ""){
			echoErrInfo(1,"名称不能为空");
		}
		else if($cintro == ""){
			echoErrInfo(1,"介绍不能为空");
		}
		else if($clabel == ""){
			echoErrInfo(1,"标签不能为空");
        }
        else if($curl == ""){
			echoErrInfo(1,"地址不能为空");
		}
		else{
			ChangeCaseSql($id,$classId,$ctype,$cbanner,$cname,$ctime,$cintro,$clabel,$curl);
		}
	}//end func

	//修改数据库中案例的信息
	function ChangeCaseSql($id,$classId,$ctype,$cbanner,$cname,$ctime,$cintro,$clabel,$curl){
		include "../common/constant.php";
		include "../common/connectSQL.php";

		$cname = escaped($cname,$conn);
        $cintro = escaped($cintro,$conn);
        $clabel = escaped($clabel,$conn);

		$sql = "UPDATE showcase SET ClassID='$classId',Type='$ctype',Banner='$cbanner',Name='$cname',AddTime='$ctime',Intro='$cintro',Label='$clabel',Url='$curl' WHERE ID = " . $id;

		if ($conn->query($sql) === TRUE) {
			$result -> errorCode = 0;
			$result -> emsg = "案例修改成功";
		    echo json_encode($result);
		} else {
		    echoErrInfo(2,"Error:" . $conn->error);
		}
		$conn->close();
	}//end func
?>