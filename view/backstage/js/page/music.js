$(document).ready(function(){
	var ipager = new pager();

	//页面初始化
	function pageInit(){
		vefLogin();
		// requestSongs(2);
		btnInit();
		requestTotalPage();
	}//end func
	pageInit();

	//请求总页码
	function requestTotalPage(){
		var total = 1;
		iAjax(songUrl,{method:"getSongs",page:1},function(data){
			if(data.errorCode == 0) total = data.result.totalPage;
			ipager.init($("#pager"),{now:1,total:total,callback:function(page){requestSongs(page)}});
		},true);
	}//end func

	//按钮初始化
	function btnInit(){
		$(".add").on("click",addSong);
		$("body").on("click",".del",delSong);
		$("body").on("click",".openBtn",changeSongState);
	}//end func

	//修改歌曲状态
	function changeSongState(){
		var that = $(this);
		var type = "1";
		var id = that.attr("data-val");
		if(that.hasClass('yellow')) type = "0";
		else if(that.hasClass('blue')) type = "1";
		iAjax(songUrl,{method:"changeSongState",id:id,type:type},function(data){
			if(data.errorCode == 0) {
				if(that.hasClass('yellow')){
					that.removeClass('yellow').addClass('blue').html("关闭");
					alert("开启成功！");
				}
				else if(that.hasClass('blue')){
					that.removeClass('blue').addClass('yellow').html("开启");
					alert("关闭成功！");
				}
			}
		},true);
	}//end func

	//删除歌曲
	function delSong(){
		var id = $(this).parents("tr").find('td').eq(0).html();
		confirm("确定要删除吗？",function(result){
			if(result) {
				loadingShow();
				iAjax(songUrl,{method:"deleteSongs",id:id},function(data){
					alert("删除成功");
					console.log(data);
					ipager.reRender({total:data.result});
				});
			}
		});
	}//end func

	//添加歌曲
	function addSong(){
		var song = $("#songId").val();
		var type = $("#played").val();
		if(song != ""){
			loadingShow();
			iAjax(songUrl,{method:"addSongs",song:song,type:type},function(data){
				alert("添加成功");
				ipager.reRender({total:data.result});
			});
		}
		else alert("歌曲id不能为空!");
	}//end func

	//请求歌曲
	function requestSongs(id){
		loadingShow();
		iAjax(songUrl,{method:"getSongs",page:id},function(data){
			if(data.errorCode == 0) {
				renderSong(data.result);
			}
			if(data.errorCode == 1) $("#songs").empty();
		},true);
	}//end func

	//渲染歌曲
	function renderSong(songs){
		var cont = "";
		var table = $("#songs");
		songs = songs.songs;
		table.empty();
		for (var i = 0; i < songs.length; i++) {
			var openBtn = songs[i].type == "1" ? "<div data-val='"+songs[i].id+"' class='btn yellow openBtn'>开启</div>" : "<div data-val='"+songs[i].id+"' class='btn blue openBtn'>关闭</div>";
			cont = "<tr id='s"+songs[i].song+"'> <td>"+songs[i].id+"</td> <td>"+songs[i].song+"</td> <td></td> <td></td> <td></td> <td>"+openBtn+"<div class='btn red del m_left'>删除</div></td> </tr>";
			table.append(cont);
			iAjax(songUrl,{method:"getSongDetail",id:songs[i].song},function(data){
				if(data.code == 200){
					var isong = data.songs[0];
					var col = $("#s"+isong.id).find('td');
					col.eq(2).html(isong.name);
					col.eq(3).html(isong.artists[0].name);
					col.eq(4).html(isong.album.name);
				}
			},true);
		};
	}//end func
});