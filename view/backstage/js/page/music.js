$(document).ready(function(){
	var songUrl = domain + "/modal/music/music.php";
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
		iAjax(songUrl,{method:"getSongs",page:1},function(data){
			if(data.errorCode == 0) {
				ipager.init($("#pager"),{now:1,total:data.result.totalPage,callback:function(page){requestSongs(page)}});
			}
			if(data.errorCode == 1) $("#pager").empty();
		},true);
	}//end func

	//按钮初始化
	function btnInit(){
		$(".add").on("click",addSong);
		$("body").on("click",".del",delSong);
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
		if(song != ""){
			loadingShow();
			iAjax(songUrl,{method:"addSongs",song:song},function(data){
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
			cont = "<tr id='s"+songs[i].song+"'> <td>"+songs[i].id+"</td> <td>"+songs[i].song+"</td> <td></td> <td></td> <td></td> <td><div class='btn red del'>删除</div></td> </tr>";
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