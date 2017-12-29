<?php
	//新增分类
	function addClass(){
		$name = $_GET["name"];
		include "../common/constant.php";
		include "../common/connectSQL.php";

		if($name){
			if(judgeSame($name,$conn)){
				$result -> errorCode = 3;
				$result -> emsg = "分类名称已存在";
		    	echo json_encode($result);
			}
			else{
				addClassToSql($name,$conn);
			}
		}
		else{
			$result -> errorCode = 1;
			$result -> emsg = "分类名称不能为空";
		    echo json_encode($result);
		}
	}//end func

	//把分类名称加入数据库
	function addClassToSql($name,$conn){
		include "../common/constant.php";

		$song = escaped($name,$conn);

		$sql = "INSERT INTO blog_class (name) VALUES ('" . $name . "')";

		if ($conn->query($sql) === TRUE) {
			$totalPage = getClassPageTotal();
			$result -> errorCode = 0;
			$result -> emsg = "分类添加成功";
			$result -> result = $totalPage;
		    echo json_encode($result);
		} else {
			$result -> errorCode = 2;
			$result -> emsg = "Error:" . $conn->error;
		    echo json_encode($result);
		}
		$conn->close();
	}//end func

	//判断分类是否存在
	function judgeSame($name,$conn){
		include "../common/constant.php";

		$song = escaped($name,$conn);

		$sql = "SELECT name FROM blog_class WHERE name = '". $name ."'";
		$data = mysqli_fetch_array(mysqli_query($conn,$sql));
		$item = $data["name"];
		return $item;
	}//end func

	//获取分类列表
	function getClassList(){
		$page = $_GET["page"];
		// $x = str_replace("'","''",$_GET["x"]);

		if($page && $page > 0){
			include "../common/constant.php";
			include "../common/connectSQL.php";

			$page = escaped($page,$conn) - 1;

			$sql = "SELECT * FROM blog_class order by ID desc limit ".($page * 12 ).",12";
			$totalPage = getClassPageTotal();

			$data = mysqli_query($conn,$sql);
			if (mysqli_num_rows($data) > 0) {
				$result -> errorCode = 0;
				$result -> emsg = "查询成功";
				$list = array();
				$iresult = new stdClass();

			    while($row = mysqli_fetch_assoc($data)) {
			    	$item = new stdClass();
			    	$item -> id = $row["ID"];
			    	$item -> name = $row["name"];
			        array_push($list,$item);
			    }

			    $iresult -> list = $list;
			    $iresult -> totalPage = $totalPage;
			    $result -> result = $iresult;
			    echo json_encode($result);
			} else {
			    $result -> errorCode = 1;
				$result -> emsg = "没有更多了~";
			    echo json_encode($result);
			}
		}
	}//end func

	//获取页码总数
	function getClassPageTotal(){
		include "../common/connectSQL.php";
		$sqlCount = "SELECT COUNT(*) as count FROM blog_class";

		$CountResult = mysqli_fetch_assoc(mysqli_query($conn,$sqlCount));
		$totalPage = ceil($CountResult["count"] / 12);

		return $totalPage;
	}//end func

	//删除歌曲
	function deleteClass(){
		include "../common/constant.php";
		include "../common/connectSQL.php";
		$id = $_GET["id"];

		if($id){
			
			$sql = "DELETE FROM blog_class WHERE ID = " . $id;
			if(mysqli_query($conn,$sql)){
				$totalPage = getClassPageTotal();
				$result -> errorCode = 0;
				$result -> emsg = "删除成功";
				$result -> result = $totalPage;
		    	echo json_encode($result);
			}
			else{
				$result -> errorCode = 1;
				$result -> emsg = "删除失败";
		    	echo json_encode($result);
			}
		}
	}//end func
?>	