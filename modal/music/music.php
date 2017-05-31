<?php
	include "../common/common.php";
	include "getSongDetail.php";
	include "../common/connectSQLconstant.php";

	// 路由的方法
	function routingMethod(){
		$m = $_GET["method"];

		switch ($m){
			case "addSongs":
				addSongs();
				break;
			case "getSongs":
				getSongs();
				break;
			case "deleteSongs":
				deleteSongs();
				break;
			case "getSongDetail":
				getSongDetail();
				break;
		}
	}//end func
	routingMethod();

	//新增歌曲
	function addSongs(){
		$song = $_GET["song"];
		include "../common/constant.php";
		include "../common/connectSQL.php";

		if($song){
			if(judgeSame($song,$conn)){
				$result -> errorCode = 3;
				$result -> emsg = "歌曲编号已存在";
		    	echo json_encode($result);
			}
			else{
				addSongsToSql($song,$conn);
			}
		}
		else{
			$result -> errorCode = 1;
			$result -> emsg = "歌曲编号不能为空";
		    echo json_encode($result);
		}
	}//end func

	//把歌曲加入数据库
	function addSongsToSql($song,$conn){
		include "../common/constant.php";

		$song = escaped($song,$conn);

		$sql = "INSERT INTO songs (songID) VALUES ('" . $song . "')";

		if ($conn->query($sql) === TRUE) {
			$totalPage = getSongsPageTotal();
			$result -> errorCode = 0;
			$result -> emsg = "新歌添加成功";
			$result -> result = $totalPage;
		    echo json_encode($result);
		} else {
			$result -> errorCode = 2;
			$result -> emsg = "Error:" . $conn->error;
		    echo json_encode($result);
		}
		$conn->close();
	}//end func

	//判断歌曲是否存在
	function judgeSame($song,$conn){
		include "../common/constant.php";

		$song = escaped($song,$conn);

		$sql = "SELECT songID FROM songs WHERE songID = '". $song ."'";
		$data = mysqli_fetch_array(mysqli_query($conn,$sql));
		$item = $data["songID"];
		return $item;
	}//end func

	//获取歌曲
	function getSongs(){
		$page = $_GET["page"];
		// $x = str_replace("'","''",$_GET["x"]);

		if($page && $page > 0){
			include "../common/constant.php";
			include "../common/connectSQL.php";

			$page = escaped($page,$conn) - 1;

			$sql = "SELECT * FROM songs order by id desc limit ".($page * 12 ).",12";
			$totalPage = getSongsPageTotal();

			$data = mysqli_query($conn,$sql);
			if (mysqli_num_rows($data) > 0) {
				$result -> errorCode = 0;
				$result -> emsg = "查询成功";
				$songs = array();
				$iresult = new stdClass();

			    while($row = mysqli_fetch_assoc($data)) {
			    	$item = new stdClass();
			    	$item -> id = $row["id"];
			    	$item -> song = $row["songID"];
			        array_push($songs,$item);
			    }

			    $iresult -> songs = $songs;
			    $iresult -> totalPage = $totalPage;
			    $result -> result = $iresult;
			    echo json_encode($result);
			} else {
			    $result -> errorCode = 1;
				$result -> emsg = "没有歌曲了~";
			    echo json_encode($result);
			}
		}
	}//end func

	//获取页码总数
	function getSongsPageTotal(){
		include "../common/connectSQL.php";
		$sqlCount = "SELECT COUNT(*) as count FROM songs";

		$CountResult = mysqli_fetch_assoc(mysqli_query($conn,$sqlCount));
		$totalPage = ceil($CountResult["count"] / 12);

		return $totalPage;
	}//end func

	//删除歌曲
	function deleteSongs(){
		include "../common/constant.php";
		include "../common/connectSQL.php";
		$id = $_GET["id"];

		if($id){
			
			$sql = "DELETE FROM songs WHERE id = " . $id;
			if(mysqli_query($conn,$sql)){
				$totalPage = getSongsPageTotal();
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

	//获取歌曲详细信息
	function getSongDetail(){
		echo get_music_info($_GET['id']);
	}//end func
?>	