$(document).ready(function(){
    var gameUrl = domain + "/modal/game/game.php";
    var nowPage = 1;
    
    /**
     * 页面初始化
     */
    function pageInit(){
        eventInit();
        requestGames();
    }
    pageInit();

    /**
     * 事件初始化
     */
    function eventInit(){
        $(".game-content").on("click",".phoneGame",function(){
            $(".gameCode img").attr("src",$(this).attr('data-code'));
            $(".gameCode").fadeIn();
        });
        $(".gameCode").on("click",function(){
            $(this).fadeOut();
        });
    }

    /**
     * 请求游戏
     */
    function requestGames(){
        iAjax(gameUrl,{method:"getGameList",page:nowPage},function(data){
            if(data.errorCode == 0) {
                $(".loading").hide();
                renderGames(data.result.games);
                nowPage++;
                if(data.result.games.length == 12) requestGames();
            }
        },true);
    }

    /**
     * 渲染页面
     */
    function renderGames(data){
        var box = $(".game-content");
        var cont = "";
        for (var i = 0; i < data.length; i++) {
            var ele = data[i];
            cont += `<div class="games-pre">
                        <a href="${ele.Type == 0 ? ele.Url : 'javascript:void(0)'}" ${ele.Type == 0 ? '' : 'class="phoneGame" data-code="'+ele.Url+'"'}>
                            <img src="${ele.SImg}">
                            <div class="games-shadow">${ele.Name}</div>
                        </a>	
                    </div>`
        }
        box.append(cont);
    }
});