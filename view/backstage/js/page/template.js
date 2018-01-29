$(document).ready(function(){

	//页面初始化
	function pageInit(){
		vefLogin();
		var iUploadImg = new uploadImg();
		iUploadImg.init(uploadImgUrl);
	}//end func
	pageInit();
});