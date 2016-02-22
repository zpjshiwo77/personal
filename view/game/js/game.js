var housegame = function () {
    this.players = {players:[]};//记录有多少位玩家玩家
    this.playerNum = 0;//记录玩家人数
    this.playerNow = 0;//记录当前的玩家
    this.specialLand = {specialLands:[],specialNow:""} //记录黑房子
    this.rollNext = null;//记录摇完骰子后下一步该干什么
    var that = this;
    this.pic = ["img/1.png","img/2.png","img/3.png","img/4.png","img/5.png","img/6.png"];//记录玩家头像
    this.luckpic = ["img/luck1.jpg","img/luck2.jpg","img/luck3.jpg","img/luck4.jpg"];//记录幸运事件图片
    this.color = ["#333","rgb(235, 110, 98)","rgb(249, 163, 108)","rgb(50, 184, 176)","rgb(130, 148, 160)","rgb(129, 210, 238)","rgb(193, 153, 209)"];
     // 产生6个不同的随机数
    this.random = function(range,arr,n){
        while(arr.length != n){
            var x = Math.floor(Math.random()*range);
            if(judge(x,arr)){
                arr.push(x);
            }
        }
        function judge(x,arr){
            for(var i in arr){
                if(x == arr[i]){
                    return false;
                }
            }
            return true;
        }
    }
    // 初始化游戏
    this.init = function () {
        //创建地图 start
        for(var i = 0;i<140;i++){//生成地图
            var land=$("<div>",{"class":"game-lands","id":"land"+i,"belong":"none","special":false,"road":["land"+(i+20),"land"+(i-1),"land"+(i-20),"land"+(i+1)],"temporary":"none"});
            $(".game-content").append(land);
        }
        //添加获得金币的额外机会
        $("body").append("<div class='game-luck-shadow'> <div class='game-luck-content'> <img src=''> <div class='game-btn' style='margin-right:85px;margin-top:50px;' id='luckbtn'>确认</div> </div> </div>");
        $("#luckbtn").click(function(){
            $(".game-luck-shadow").hide();
        });
        //  添加筛子的动画弹窗 start
        $("body").append("<div class='game-dice-shadow'> <div style='height:400px;width:300px;position: absolute; left: 50%; top: 50%; margin-left: -150px; margin-top: -200px;'> <div class='game-dice'></div> <div class='game-btn' id='game-ok' style='margin-right:85px;display:none'>确认</div> <div class='game-dice-add'> <input><div class='game-dice-addbtn'>增加</div> <p></p> </div> </div> </div>");
        $("#game-ok").click(function(){
            $(".game-dice-shadow").hide();
            $(this).hide();
            $(".game-dice-add").hide();
            if(that.playerNow < that.playerNum){
                $("#"+that.players.players[that.playerNow-1].name).css("border-color","#ddd");//清除上一个玩家的提示
                $("#"+that.players.players[that.playerNow-1].name).children(".game-rollnum").children().html(that.players.players[that.playerNow-1].rollNum);//显示上一个玩家摇出的骰子数
                $("#"+that.players.players[that.playerNow].name).css("border-color",that.players.players[that.playerNow].color);
            }
            else if(that.playerNow == that.playerNum){
                $("#"+that.players.players[that.playerNow-1].name).css("border-color","#ddd");//清除上一个玩家的提示
                $("#"+that.players.players[that.playerNow-1].name).children(".game-rollnum").children().html(that.players.players[that.playerNow-1].rollNum);//显示上一个玩家摇出的骰子数
                that.rollNext();
            }
        });
        //  添加筛子的动画弹窗 end
        //  按钮的创建 start
        $(".game-content").append("<div class='game-control'> <div class='game-btn' id='game-addplayer'>Add Player</div> <div class='game-btn' id='game-start'>Start</div> <div class='game-btn' style='display:none' id='game-turn-end'>结束选择</div><div class='game-btn' style='display:none' id='game-roll'>掷骰子</div></div><div class='game-rule'><b>游戏规则：</b>1.添加新的玩家（最少3人，最多6人）； 2.扔骰子决定每个玩家初始土地数量； 3.当全员扔完骰子后，可以选择灰色的块做为自己的地盘。当选择完自己的地盘之后，要选择一块地盘藏自己的房产证（注意不要让其他玩家看见哦~）； 4.全员选择结束后，开始向目标地盘前进。（只能移动到自己周围的地盘哦，当要移动到其他玩家的地盘时，需要交过路费）； 5.前进到目标地盘的时候，有一定几率会触发特殊事件，祝您好运~ 6.全员都进入目标地盘后，开始侵占运动。每人能侵占的地盘数量由掷骰子决定（偷偷的告诉你:“能‘作弊’哦~”）； 7.当你侵占其他玩家的地盘的时候，选择到了他的房产证位置，你就可以获得他的所有地盘了~ 8.当你占领了所有的地盘，恭喜你，获得了这局游戏的胜利~！</div>");
        $("body").delegate("#game-addplayer","click",function(){
            that.AddPlayer();
        });
        $("body").delegate("#game-start","click",function(){
            that.start();
        })
        //  按钮的创建 end
        //  生成特殊地盘 start
        var Num = new Array();//记录随机数的数组
        this.random(140,Num,6);
        for(var i = 0;i<6;i++){
            var name = "land"+ Num[i];
            $("#"+name).attr("special",true);
            $("#"+name).html(i+1);
            $("#"+name).css("background-color",this.color[0]);
            that.specialLand.specialLands.push(name);
        }
        //  生成特殊地盘 end
        //创建地图 end
    };    
    //增加游戏玩家
    this.AddPlayer = function() { 
        if(this.playerNum < 6){//限制玩家人数
            var player = {//新建一个玩家
                name:"default",//姓名
                money:10,//钱
                rollNum:0,//掷骰子的点数
                landCount:0,//一共拥有的土地数量
                land:[],//拥有的土地位置记录
                landKey:0,//土地房产证位置
                location:0,//目前人所在的位置
                color:"#fff",//土地颜色
                inroad:0,//能侵占的土地数量
                pic:""
            };
            this.playerNum++;
            player.name = "player"+this.playerNum;
            player.color = this.color[this.playerNum];
            player.pic = this.pic[this.playerNum-1];
            this.players.players.push(player);
            $(".game-control").append("<div class='game-player' id='"+player.name+"'><p><img src='"+player.pic+"'>Player"+this.playerNum+"<span>"+player.money+"</span></p><p class='game-landnum'>土地数量：<b>0</b></p><p class='game-rollnum'>骰子点数：<b></b></p><p class='game-inroad'>侵占土地：<b></b></p></div>");
        }
        else{
            alert("游戏人数过多！");
        }
    }
    //游戏开始
    this.start = function(){
        if(this.playerNum >= 3){
            $("#game-addplayer").hide();
            $("#game-start").hide();
            $("#game-roll").show();
            $("#player"+(this.playerNow+1)).css("border-color",this.players.players[this.playerNow].color);
            $("body").on('click.diceone','#game-roll',function(){
                that.diceOne();
            });
            this.rollNext = this.assignLand
        }
        else{
            alert("游戏人数不能少于3人！");
        }
    }
    //掷骰子
    this.dice = function (n,callback){//n代表生成1至n的随机数，callback为掷骰子之后所执行的回调函数
        var num = Math.floor(Math.random()*n+1);
        $(".game-dice-shadow").show();
        var x = setInterval(function(){
            $(".game-dice").html(Math.floor(Math.random()*n+1));
        },50);
        var y = setTimeout(function(){
            clearInterval(x);
            $(".game-dice").html(num);
            $("#game-ok").show();
            if(typeof callback != 'undefined'){
                callback();
            }
        },3000);
        return num;
    }
    //掷骰子决定每个玩家的块数
    this.diceOne = function(){
        if(this.playerNow < this.playerNum){
            var num = this.dice(this.playerNum*2);
            this.players.players[this.playerNow].rollNum = num;
            this.playerNow++;
        }
        else{
            alert("下一步");
        }
    }
    //掷骰子决定每个玩家的去向
    this.diceTwo = function(){
        this.specialLand.specialNow = this.specialLand.specialLands[this.dice(6)-1];
        this.rollNext = this.diceTwoShow;
    }
    this.diceTwoShow = function(){//筛子二游戏的显示
        this.playerNow = 0;
        $("#"+this.specialLand.specialNow).css("font-size","35px");
        this.randomLocation();
    }
    //掷骰子决定每个玩家小游戏排名
    this.diceThree = function(){
        if(this.playerNow < this.playerNum){
            var num = this.dice(this.playerNum*2,this.addDiceNum);
            this.players.players[this.playerNow].rollNum = num;
            this.playerNow++;
        }
    }
    //增加骰子点数
    this.addDiceNum = function(){
        $("body").off("click.adddice");
        $(".game-dice-add").show();
        $(".game-dice-add p").html("你最多只能使用 "+that.playerNow+" 个金币，每使用一个金币能增加1个点数。");
        $("body").on("click.adddice",".game-dice-addbtn",function(){
            var num = parseInt($(".game-dice-add input").val());
            var player = that.players.players[that.playerNow-1];
            if(num > player.money){
                alert("你没有那么多的金币了！");
            }
            else{
                if(num <= that.playerNow){
                    player.money -= num;
                    $("#"+player.name).children().first().children("span").html(player.money);
                    player.rollNum += num;
                    $(".game-dice").html(parseInt($(".game-dice").html()) + num);
                    $(".game-dice-add").hide();
                    $(".game-dice-add input").val("");
                }
                else if($(".game-dice-add input").val() == ""){
                    $(".game-dice-add").hide();
                }
                else{
                    alert("你不能使用那么多金币！");
                }
            }
        })
    }
    //分配每人能侵占的地盘数量
    this.assignInroad = function(){
        $("body").off("click.roll2");
        this.rang(this.players.players);//根据摇出的骰子数进行排名
        this.playerNow = 0;
        this.assign(20,2);//分配每一个玩家能侵占的土地数量
        $("#"+that.players.players[that.playerNow].name).css("border-color",that.players.players[that.playerNow].color);
        this.inroad();
    }
    //开始侵占土地
    this.inroad = function(){
        var player = that.players.players[that.playerNow];
        var playershow = $("#"+player.name);
        //土地的侵占点击事件
        $("body").on("click.inroad",".game-lands",function(){
            if(player.inroad > 0){
                if($(this).attr("belong") == player.name){
                    alert("这是你自己的地盘！");
                }
                else if($(this).attr("special") == "true"){
                    alert("你不能选择这个地盘！");
                }
                else{
                    player.inroad--;
                    for(var i in that.players.players){//找到当前土地的所有人
                        if(that.players.players[i].name == $(this).attr("belong")){
                            var playerL = that.players.players[i];//当前土地所有人
                        }
                    }
                    if($(this).attr("id") == playerL.landKey){
                        alert("恭喜你选中了"+playerL.name+"玩家的房产证的位子！");
                        that.giveLand(playerL,player);
                        if(that.playerNum == 1){//只剩下一个玩家时，游戏结束
                            alert("游戏结束~恭喜"+that.players.players[0].name+"获得胜利~");
                        }
                    }
                    else{
                        //改变当前土地属性
                        $(this).css("background-color",player.color);
                        $(this).attr("belong",player.name);
                        //改变当前玩家的属性
                        player.landCount++;
                        player.land.push($(this).attr("id"));
                        $("#"+player.name).children(".game-landnum").children().html(player.landCount);
                        //改变被侵占的玩家的属性
                        var num = 0;//记录要被删除的土地的数组下标
                        for(var j in playerL.land){
                            if(playerL.land[j] == $(this).attr("id")){
                                num = j;
                            }
                        }
                        playerL.landCount--;
                        playerL.land.splice(num,1);
                        $("#"+playerL.name).children(".game-landnum").children().html(playerL.landCount);
                    }
                    if(player.inroad <= 0){//当当前玩家侵占结束时，绑定结束回合按键
                        $("body").on("click.end02","#game-turn-end",function(){
                            if(that.playerNow < that.playerNum - 1){
                                that.playerNow++;
                                $("#"+player.name).css("border-color","#ddd");
                                $("#"+that.players.players[that.playerNow].name).css("border-color",that.players.players[that.playerNow].color);
                                $("body").off("click.end02");
                                $("body").off("click.inroad");
                                that.inroad();
                            }
                            else if(that.playerNow == that.playerNum - 1){
                                that.playerNow++;
                                $("#"+player.name).css("border-color","#ddd");
                                $("body").off("click.end02");
                                $("body").off("click.inroad");
                                $(".game-inroad").each(function(){
                                    $(this).children().html("");
                                });
                                that.diceTwo();
                            }
                        })
                    }
                }
            }
            else{
                alert("你不能侵占更多的地盘了！");
            }
        });
    }
    //分配地盘
    this.assignLand = function(){
        $("body").off('click.diceone');
        $("#game-turn-end").show();
        this.rang(this.players.players);//根据摇出的骰子数进行排名
        this.playerNow = 0;
        this.assign(134,1);//分配每一个玩家的土地数量
        $("#"+that.players.players[that.playerNow].name).css("border-color",that.players.players[that.playerNow].color);
        this.chooseLand();
    }
    //选择地盘
    this.chooseLand = function(){
        var player = that.players.players[that.playerNow];
        var playershow = $("#"+player.name);
        //给土地绑定点击事件
        $("body").on("click.assign",".game-lands",function(){
            if($(this).attr("special") == "true" || $(this).attr("belong") != "none"){
                alert("你不能选择这个地盘！");
            }
            else{
                if(player.land.length < player.landCount){
                    $(this).css("background-color",player.color);
                    $(this).attr("belong",player.name);
                    player.land.push($(this).attr("id"));
                }
                if(player.land.length == player.landCount){
                    alert("请选择您隐藏房产证的位置（注意不要让其他人看见哦！）");
                    $("body").off("click.assign");
                    $("body").on("click.key",".game-lands",function(){
                        if(player.land.indexOf($(this).attr("id")) >= 0){
                            player.landKey = $(this).attr("id");
                            alert("选择房产证成功！");
                            $("body").off("click.key");
                            $("body").on("click.next","#game-turn-end",function(){
                                that.playerNow++;
                                if(that.playerNow < that.playerNum){
                                    $("#"+that.players.players[that.playerNow-1].name).css("border-color","#ddd");
                                    $("#"+that.players.players[that.playerNow].name).css("border-color",that.players.players[that.playerNow].color);
                                    that.chooseLand();
                                    $("body").off("click.next");
                                }
                                if(that.playerNow == that.playerNum){
                                    $("#"+that.players.players[that.playerNow-1].name).css("border-color","#ddd");
                                    $("body").off("click.next");
                                    $("#game-turn-end").html("结束回合");
                                    that.diceTwo();
                                }
                            });
                        }
                        else{
                            alert("这不是你的地盘！");
                        }
                    });
                }
            }
        });
    }
    //根据排名进行分配
    this.assign = function(n,attr){
        var total = 0;
        for(var i in this.players.players)
        {
            total += this.players.players[i].rollNum;
        }
        if(attr == 1){
            var sum1 = 0;
            for(var j =0; j < this.players.players.length-1;j++){
                this.players.players[j].landCount = Math.round(n*(this.players.players[j].rollNum / total));
                sum1 += this.players.players[j].landCount;
                $("#"+this.players.players[j].name).children(".game-landnum").children().html(this.players.players[j].landCount);
            }
            this.players.players[this.players.players.length-1].landCount = n - sum1;
            $("#"+this.players.players[this.players.players.length-1].name).children(".game-landnum").children().html(this.players.players[this.players.players.length-1].landCount);
        }
        else{
            var sum2 = 0; 
            for(var j =0; j < this.players.players.length-1;j++){
                this.players.players[j].inroad =  Math.round(n*(this.players.players[j].rollNum / total));
                sum2 += this.players.players[j].inroad;
                $("#"+this.players.players[j].name).children(".game-inroad").children().html(this.players.players[j].inroad);
            }
            this.players.players[this.players.players.length-1].inroad = n - sum2;
            $("#"+this.players.players[j].name).children(".game-inroad").children().html(this.players.players[j].inroad);
        }
    }
    //排名
    this.rang = function(x){ 
        for(var i=0;i<x.length;i++){
            for(var j=i+1;j<x.length;j++){
                if(x[i].rollNum < x[j].rollNum){
                    var item = x[i];
                    x[i] = x[j];
                    x[j] = item;
                }
            }
        }
    }
    //随机分配人员位置
    this.randomLocation = function(){
        var player = this.players.players[this.playerNow];
        $("#"+player.name).css("border-color",player.color);
        var location = player.land[Math.floor(Math.random()*player.landCount)];
        player.location = location;
        $("#"+location).html("<img src='"+player.pic+"'>");
        this.walk();
    }
    //给予某个玩家自己的所有土地
    this.giveLand = function(playerF,playerT){
        playerT.money += playerF.money;
        for(var i in playerF.land){
            playerT.land.push(playerF.land[i]);
            playerT.landCount++;
            $("#"+playerF.land[i]).css("background-color",playerT.color);
            $("#"+playerF.land[i]).attr("belong",playerT.name);
        }
        $("#"+playerT.name).children(".game-landnum").children().html(playerT.landCount);
        $("#"+playerT.name).children().first().children("span").html(playerT.money);
        $("#"+playerF.location).html("");
        var num = 0;//记录要被删除玩家的数组下标
        for(var j in this.players.players){
            if(this.players.players[j].name == playerF.name){
                num = j;
            }
        }
        this.playerNum--;
        if(num < this.playerNow){//纠正当前玩家的位置
            this.playerNow--;
        }
        this.players.players.splice(num,1);
        $("#"+playerF.name).remove();
    }
    //另当前玩家有其他玩家的土地过路权
    this.giveToUse = function(name1,player){
        for(var i in this.players.players){
            if(this.players.players[i].name == name1){
                var playerL = this.players.players[i];
            }
        }
        if(player.money <= 0){
            if(confirm("不好意思，你的钱不够了，你确定要把所有地盘交给"+name1+"吗？")){
                this.giveLand(player,playerL);
                return 1;
            }
            else{
                return 3;
            }
        }
        else{
            playerL.money++;
            player.money--;
            $("#"+player.name).children().first().children("span").html(player.money);
            $("#"+playerL.name).children().first().children("span").html(playerL.money);
            for(var j in playerL.land){
                $("#"+playerL.land[j]).attr("temporary",player.name);
            }
            return 2;
        }
    }
    //步行到目标位置
    this.walk = function(){
        var player = this.players.players[this.playerNow];
        $("body").on("click.walk",".game-lands",function(){
            if(close($(this),$("#"+player.location))){
                if($(this).attr("belong") != player.name && $(this).attr("temporary") != player.name){
                    if($(this).attr("belong") == "none" && $(this).attr("id") == that.specialLand.specialNow){//当走到目标位置时，进行下一个玩家
                        $("#"+player.location).html("");
                        that.goodluck();
                        $("body").on("click.next2","#game-turn-end",function(){
                            $("#"+player.name).css("border-color","#ddd");
                            that.playerNow++;
                            $("body").off("click.walk");
                            $("body").off("click.next2");
                            if(that.playerNum == 1){//只剩下一个玩家时，游戏结束
                                alert("游戏结束~恭喜"+that.players.players[0].name+"获得胜利~");
                            }
                            else{
                                if(that.playerNow < that.playerNum){
                                    that.randomLocation();
                                }
                                if(that.playerNow == that.playerNum){//全部都走到目标位子后玩下一个游戏
                                    next();
                                }
                            }
                        });
                    }
                    else if($(this).attr("belong") != "none"){//要路过其他玩家的地盘
                        if(confirm("确定要交过路费给"+$(this).attr("belong")+"吗？")){
                            var judge = that.giveToUse($(this).attr("belong"),player);
                            if(judge == 2){
                                $("#"+player.location).html("");
                                player.location = $(this).attr("id");
                                $(this).html("<img src='"+player.pic+"'>");
                            }
                            else if(judge == 1){
                                $("body").off("click.walk");
                                if(that.playerNum == 1){//只剩下一个玩家时，游戏结束
                                    alert("游戏结束~恭喜"+that.players.players[0].name+"获得胜利~");
                                }
                                else{
                                    if(that.playerNow < that.playerNum){
                                        that.randomLocation();
                                    }
                                    if(that.playerNow == that.playerNum){//全部都走到目标位子后玩下一个游戏
                                        next();
                                    }
                                }
                            }
                        }
                    }
                }
                else{//在允许的情况下移动
                    $("#"+player.location).html("");
                    player.location = $(this).attr("id");
                    $(this).html("<img src='"+player.pic+"'>");
                }
            }
        })
        function close(x,y){//判断是否为临近的路
            var arr = y.attr("road").split(",");
            for (var i in arr){
                if(x.attr("id") == arr[i]){
                    return true;
                }
            }
            return false;
        }
        function next(){//全部走到目标位置后进行下一个游戏
            that.playerNow = 0;
            for(var i = 0;i < 140;i++){//重置所有地盘的过路权
                $("#land"+i).attr("temporary","none");
            }
            for(var j in that.players.players){//重置每个玩家的骰子点数
                $("#" + that.players.players[j].name).children(".game-rollnum").children().html("");
            }
            $("#"+that.specialLand.specialNow).css("font-size","15px");//重置目标位置
            that.specialLand.specialNow = "";
            var player = that.players.players[that.playerNow];//标示当前玩家
            $("#"+player.name).css("border-color",player.color);
            that.rollNext = that.assignInroad;//小游戏后分配每个人能侵占的土地数量
            $("body").on("click.roll2","#game-roll",function(){
                that.diceThree();
            });
        }
    }
    this.goodluck = function(){
        var num = Math.floor(Math.random()*14);
        if(num == 7){
            var player = this.players.players[this.playerNow];
            var money = Math.floor(Math.random()*4 - 1);
            player.money += money;
            $("#"+player.name).children().first().children("span").html(player.money);
            $(".game-luck-shadow").show();
            $(".game-luck-content #luckbtn").html(money);
        }
    }
}