<?php
	session_start();
	include "../common/common.php";
	include "../common/connectSQLconstant.php";

	// 路由的方法
	function routingMethod(){
		$m = $_GET["method"];

		switch ($m){
			case "login":
				login();
				break;
			case "exit":
				exitLogin();
				break;
			case "vefLogin":
				vefLogin();
				break;
		}
	}//end func
	routingMethod();

	//登录的方法
	function login(){
		$user = $_GET["user"];
		$psw = $_GET["psw"];

		include "../common/constant.php";
		include "../common/connectSQL.php";

		if($user && $psw){
			$user = escaped($user,$conn);
			$psw = escaped($psw,$conn);
			$psw = hash("sha256", $psw);
			$sql = "SELECT * FROM user WHERE (user='$user') AND (password='$psw')";

			$iresult = $conn->query($sql);
			if ($iresult->num_rows > 0) {
				$_SESSION['login'] = $user;
				$result -> errorCode = 0;
				$result -> emsg = "登录成功";
			    echo json_encode($result);
			} else {
				$result -> errorCode = 2;
				$result -> emsg = "用户名或密码错误";
			    echo json_encode($result);
			}
			$conn->close();
		}
		else{
			$result -> errorCode = 1;
			$result -> emsg = "用户名或密码不能为空";
		    echo json_encode($result);
		}
	}//end func

	//退出登录的方法
	function exitLogin(){
		include "../common/constant.php";
		$_SESSION['login'] = "";
		$result -> errorCode = 0;
		$result -> emsg = "已退出";
	    echo json_encode($result);
	}//end func

	//验证是否登录的方法
	function vefLogin(){
		include "../common/constant.php";
		if(isset($_SESSION['login']) && !empty($_SESSION['login'])){
			$result -> errorCode = 0;
			$result -> emsg = "已登录";
			$result -> result = $_SESSION['login'];
	    	echo json_encode($result);
		}
		else{
			$result -> errorCode = 1;
			$result -> emsg = "未登录";
	    	echo json_encode($result);
		}
	}//end func
?>