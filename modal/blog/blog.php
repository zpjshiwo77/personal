<?php
	session_start();
	include "../common/common.php";
	include "../common/connectSQLconstant.php";
	include "../blog/blogClass.php";
	include "../blog/blogDetail.php";

	// 路由的方法
	function routingMethod(){
		$m = $_REQUEST["method"];
		switch ($m){
			case "addClass":
				addClass();
				break;
			case "getClassList":
				getClassList();
				break;
			case "deleteClass":
				deleteClass();
				break;
			case "addBlog":
				addBlog();
				break;
			case "deleteBlog":
				deleteBlog();
				break;
			case "getBlogList":
				getBlogList();
				break;
			case "getBlogDetail":
				getBlogDetail();
				break;
			case "changeBlog":
				changeBlog();
				break;
			case "getBlogTotalPage":
				getBlogTotalPage();
				break;
		}		
	}//end func
	routingMethod();
?>