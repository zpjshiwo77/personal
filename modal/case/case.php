<?php
	session_start();
	include "../common/common.php";
	include "../common/connectSQLconstant.php";
	include "../case/caseClass.php";
	include "../case/caseDetail.php";

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
			case "addCase":
				addCase();
				break;
			case "deleteCase":
				deleteCase();
				break;
			case "getCaseList":
				getCaseList();
				break;
			case "changeCase":
				changeCase();
                break;
            case "getCaseDetail":
                getCaseDetail();
                break;
			case "getCaseTotalPage":
				getCaseTotalPage();
				break;
		}		
	}//end func
	routingMethod();
?>