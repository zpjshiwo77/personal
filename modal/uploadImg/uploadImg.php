<?php
	session_start();
	include "../common/common.php";

	//验证文件的正确性
	function vefFileCorrect(){
		$iFiles = $_FILES['files'];
		if(!isset($_SESSION['login']) || empty($_SESSION['login'])){
			echoErrInfo(110,"您没有权限");
		}
		else if($iFiles['size'] > 5 * 1024 * 1024){
			echoErrInfo(1,"请上传小于5MB的图片");
		}
		else{
			creatImg();
		}
	}//end func
	vefFileCorrect();

	//创建图片
	function creatImg(){
		include "../common/constant.php";

		$iFiles = $_FILES['files'];
		$FileName = $_REQUEST['fileName'];
		$SrcName = $_REQUEST['srcName'];
		$types = explode(".",$iFiles['name']);
		$imgType = ".".$types[1];
		$isite = $_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'];
		$itemSrc = str_replace("uploadImg.php","images/",$isite);
		$imgSrc = "http://" . $itemSrc;

		define('DIR_ROOT', str_replace('\\','/',dirname(__FILE__)));//获取当前文件物理路径
		$tmp_file_path = DIR_ROOT.'/images/'.$SrcName;//在根目录下增加tmp目录的路径
		if(!is_dir($tmp_file_path)) mkdir($tmp_file_path, 0777);
		//不存在当前上传文件则上传
		if(!file_exists($iFiles['name'])) move_uploaded_file($iFiles['tmp_name'],$tmp_file_path."/".iconv('utf-8','gb2312',$FileName.$imgType));
		$imgurl = $imgSrc.$SrcName."/".$FileName.$imgType;

		$result -> errorCode = 0;
		$result -> emsg = "上传成功";
		$result -> imgUrl = $imgurl;
		echo json_encode($result);
	}//end func

?>