var PixelsSketchpad = function (ele,height,width) {
   var self = this;
/* ********************
   *****画板的属性*****
   ********page********
   ******************** */
   self.color = "#000";//渲染颜色
   self.pickColor = '#000';//选择的颜色
   self.sketHeight = 550; //画板高度
   self.sketWidth = 800; //画板宽度
   self.renderSize = 1;//渲染的笔头大小
   self.pencilSize = 1;//画笔的笔头大小
   self.eraserSize = 1;//橡皮擦的笔头大小
   self.coloring = "true";//记录像素点渲染的状态
   self.DomPoints = new Array;//记录每一个像素点的jQuery对象
   self.AllRevocation = new Array;//记录所有步骤锁渲染的像素点(撤销)
   self.Revocations = new Array;//记录最后一步渲染的像素点（撤销）
   self.ErrorOperate = false;//防止移动端用户的错误操作
/* ********************
   *****初始化画板*****
   ********page********
   ******************** */
   self.init = function(){
        var contnet = $("<div>",{"class":"sketchpad-content"}); //主内容区
        var sket = $("<div>",{"class":"sketchpad-sket"}); //画板区
        var tool = $("<div>",{"class":"sketchpad-tool"}); //工具栏
        var painting = $("<div>",{"class":"sketchpad-painting"}); //画图区
        var points = ""; //像素点集合

        //重置画板尺寸
        if(height && width){
            self.sketHeight = height;
            self.sketWidth = width;
            sket.css({'height':height,"width":width});
            // tool.css({'height':height,"width":height/3.25});
            contnet.css({'height':height,"width":width});
            painting.css({'height':height,'width':width});
        }
        for(var i = 0;i < self.sketHeight/20;i++){
          for(var j = 0;j < self.sketWidth/20;j++){
             points += "<div class='point' id='z"+j+"and"+i+"' relx='"+j+"' rely='"+i+"' render='false'></div>";
          }
        }
        //生成画板
        $(ele).append(contnet);
        $("body").append('<div class="m-downTip">保存成功！右边的下载按钮可以下载图片呢~如果下载不了图片，请使用截图哦~<div class="m-downTip-ok">确认</div></div>');
        $(".sketchpad-content").append(sket);
        $(".sketchpad-content").append(tool);
        $(".sketchpad-sket").append(points);
        $(".sketchpad-sket").append(painting);
        for(var i = 0;i < self.sketWidth/20;i++){
          self.DomPoints[i] = new Array;
          for(var j = 0;j < self.sketHeight/20;j++){
             self.DomPoints[i][j] = $("#z"+i+"and"+j);
          }
        }
        //生成工具栏
        $(".sketchpad-tool").append("<div class='tool-UpDown'>〈</div>");
        self.showTool();
        $(".sketchpad-tool").append("<div class='tool-btn tool-pencil'>画笔</div>");
        self.pencil();
        $(".sketchpad-tool").append("<div class='tool-btn tool-color'>颜色<div class='tool-color-show'></div></div>");
        $(".tool-color-show").css("background-color",self.pickColor);
        self.ColorPick();
        $(".sketchpad-tool").append("<div class='tool-btn tool-eraser'>橡皮擦</div>");
        self.Eraser();
        $(".sketchpad-tool").append("<div class='tool-btn tool-empty'>清空</div>");
        self.Empty();
        $(".sketchpad-tool").append("<div class='tool-btn tool-bg'>背景填充</div>");
        self.SketchpadBg();
        $(".sketchpad-tool").append("<div class='tool-btn tool-filling'>颜色填充</div>");
        self.filling();
        $(".sketchpad-tool").append("<div class='tool-btn tool-shape'>矩形工具</div>");
        self.shapeChose();
        $(".sketchpad-tool").append("<div class='tool-btn tool-revocation'>撤销</div>");
        self.revocation();
        $(".sketchpad-tool").append("<div class='tool-btn tool-save'>保存为图片</div>");
        self.SaveImg();
        $(".sketchpad-tool").append("<a href='' download='MyPic' class='down tool-btn tool-down'>下载</a>");
        $(".tool-down").click(function(){
          $(this).hide();
        });
        $(".m-downTip-ok").click(function(){
          $(".m-downTip").hide();
        });
        $(".sketchpad-tool").append("<div class='tool-pen-size tool-two-chose'><div class='tool-btn02' size='1'>1</div><div class='tool-btn02' size='2'>2</div><div class='tool-btn02' size='3'>3</div><div class='tool-btn02' size='4'>4</div><div class='tool-btn02' size='5'>5</div></div>");
        $(".sketchpad-tool").append("<div class='tool-shape-chose tool-two-chose'><div class=' tool-btn-shape tool-btn-line'><img src='img/line.png'></div><div class=' tool-btn-shape tool-btn-square'><img src='img/square.png'></div><div class=' tool-btn-shape tool-btn-circle'><img src='img/circle.png'></div><div class=' tool-btn-shape tool-btn-triangle'><img src='img/triangle.png'></div></div>");
        //执行画画的方法
        self.painting();
         // $(".tool-pencil").click();
        self.ToolRender();
   }
/* ********************
   ****解绑所有事件****
   ********page********
   ******************** */
   self.sketchpadRemove = function(){
        // $(".sketchpad-painting").off("mousedown.down");
        $(".sketchpad-painting")[0].removeEventListener("touchstart",self.paintingTouchstart,false);
        // $(".sketchpad-painting").off("mouseup.up");
        $(".sketchpad-painting")[0].removeEventListener("touchend",self.paintingTouchend,false);
        // $(".sketchpad-painting").off("click.click");
        $(".sketchpad-painting")[0].removeEventListener("touchstart",self.fillingClick,false);
        // $(".sketchpad-painting").off("mousedown.shape");
        $(".sketchpad-painting")[0].removeEventListener("touchstart",self.shapePaintingStart,false);
        // $(".sketchpad-painting").off("mouseup.shape");
        $(".sketchpad-painting")[0].removeEventListener("touchend",self.shapePaintingEnd,false);
        $(".sketchpad-painting")[0].removeEventListener("touchmove",self.paintingTouchmove,false);
   }
/* ********************
   *****显示工具栏*****
   ********page********
   ******************** */
   self.showTool = function(){
        $(".tool-UpDown")[0].addEventListener("touchstart",function(){
          self.ErrorOperate = false;
          if($(this).text() == "〈"){
            $(this).text("〉");
            $(".sketchpad-tool").css("right",0);
          }
          else{
            $(this).text("〈");
            $(".sketchpad-tool").css("right",-270);
          }
          var t = setTimeout(function(){
            if($(".sketchpad-tool").css("right") == "0px"){
              self.ErrorOperate = true;
            }
            else{
              self.ErrorOperate = false;
            }
          },500);
        },false);
   }
/* ********************
   ********画画********
   ********page********
   ******************** */
   self.painting = function(){
        $(".sketchpad-painting")[0].addEventListener("touchstart",self.paintingTouchstart = function(e){
            var touch = e.targetTouches[0];
            var x = touch.clientX;
            var y = touch.clientY;
            self.Revocations.push(self.color);//撤销(记录这一次的操作的颜色)
            self.Revocations.push(self.coloring);//撤销（记录这一次操作的状态）
            self.render(x,y);
            $(".sketchpad-painting")[0].addEventListener("touchmove",self.paintingTouchmove = function(e){
              var touch = e.targetTouches[0];
              var x = touch.clientX;
              var y = touch.clientY;
              self.render(x,y);
            },false);
        },false);
        $(".sketchpad-painting")[0].addEventListener("touchend",self.paintingTouchend = function(e){
            // $(".sketchpad-painting").off("mousemove.move");
            $(".sketchpad-painting")[0].removeEventListener("touchmove",self.paintingTouchmove,false);
            self.AllRevocation.push(self.Revocations);//撤销 
            self.Revocations = [];//撤销
        },false);
   }
   
/* ********************
   ****单个像素渲染****
   ********page********
   ******************** */
   self.PointRender = function(x,y,color){
      self.DomPoints[x][y].css('background-color',color).attr("render",self.coloring);
      self.Revocations.push(self.DomPoints[x][y]);
   }
/* ********************
   ********渲染********
   ********page********
   ******************** */
   self.render = function(x,y){
      var Lx = parseInt(x/20); 
      var Ly = parseInt(y/20);
      if(self.renderSize == 1){
        self.PointRender(Lx,Ly,self.color);
      }
      else if(self.renderSize == 2){
        for(var i = Lx;i <= Lx+1;i++){
          for(var j = Ly;j <= Ly+1;j++){
            if(i >= 0 && j >=0 && i < self.DomPoints.length && j < self.DomPoints[0].length){
              self.PointRender(i,j,self.color);
            }
          }
        }
      }
      else if(self.renderSize == 3){
        for(var i = Lx-1;i <= Lx+1;i++){
          for(var j = Ly-1;j <= Ly+1;j++){
            if(i >= 0 && j >=0 && i < self.DomPoints.length && j < self.DomPoints[0].length){
              self.PointRender(i,j,self.color);
            }
          }
        }
      }
      else if(self.renderSize == 4){
        for(var i = Lx-1;i <= Lx+2;i++){
          for(var j = Ly-1;j <= Ly+2;j++){
            if(i >= 0 && j >=0 && i < self.DomPoints.length && j < self.DomPoints[0].length){
             self.PointRender(i,j,self.color);
            }
          }
        }        
      }
      else if(self.renderSize == 5){
        for(var i = Lx-2;i <= Lx+2;i++){
          for(var j = Ly-2;j <= Ly+2;j++){
            if(i >= 0 && j >=0 && i < self.DomPoints.length && j < self.DomPoints[0].length){
              self.PointRender(i,j,self.color);
            }
          }
        } 
      }
   }
/* ********************
   ******颜色选择******
   ********page********
   ******************** */
   self.ColorPick = function(){
      $(".tool-color").colpick();
      $(".colpick_submit").on("click",function(){
        self.color = "#"+$(".colpick_hex_field input").val();
        self.pickColor = "#"+$(".colpick_hex_field input").val();
        $(".tool-color-show").css("background-color",self.pickColor);
        $(".colpick_full").hide();
      });
   }
 /* ********************
   ******按钮渲染******
   ********page********
   ******************** */
   self.ToolRender = function(){
      $(".tool-btn").on("click",function(){
        $(".tool-btn").each(function(){
          $(this).css({"background-color":"rgb(250,250,250)","color":"#000","border-color":"#aaa"});
        });
        $(this).css({"background-color":"rgb(129, 210, 238)","color":"#fff","border-color":"rgb(129, 210, 238)"});
      })
   }
/* ********************
   *******橡皮擦*******
   ********page********
   ******************** */
   self.Eraser = function(){
      $(".tool-eraser").on("click",function(){
        console.log(self.ErrorOperate);
        if(self.ErrorOperate){
          self.sketchpadRemove();
          $(".sketchpad-painting").css('cursor','url(img/eraser.ico),auto');
          self.painting();
          self.color = "#eee";
          self.coloring = "false";
          $(".tool-shape-chose").hide();
          $(".tool-pen-size").show();
          self.sizeChose("eraser");
        }
      });
   }
/* ********************
   ********画笔********
   ********page********
   ******************** */
   self.pencil = function(){
      $(".tool-pencil").on("click",function(){
        if(self.ErrorOperate){
          self.sketchpadRemove();
          $(".sketchpad-painting").css('cursor','url(img/pen.ico),auto');
          self.painting();
          self.color = self.pickColor;
          self.coloring = "true";
          $(".tool-shape-chose").hide();
          $(".tool-pen-size").show();
          self.sizeChose("pencil");
        }
      })
   }
/* ********************
   ********清空********
   ********page********
   ******************** */
   self.Empty = function(){
      $(".tool-empty").on("click",function(){
        if(self.ErrorOperate){
          $(".point").each(function(){
            $(this).css("background-color","#eee").attr("render","false");
          });
          self.Revocations.push("empty");
          self.AllRevocation.push(self.Revocations);
          self.Revocations = [];
        }
      })
   }
/* ********************
   ********撤销********
   ********page********
   ******************** */
   self.revocation = function(){
      $(".tool-revocation").on("click",function(){
        $(".point").each(function(){
          $(this).css("background-color","#eee").attr("render","false");
        });
        if(self.AllRevocation.length > 0){
          self.AllRevocation.pop();
          for(var i = 0;i < self.AllRevocation.length;i++){
            if(self.AllRevocation[i][0] == "empty"){
              $(".point").each(function(){
                $(this).css("background-color","#eee").attr("render","false");
              });
            }
            else if(self.AllRevocation[i][0] == "bg"){
              $(".point").each(function(){
                $(this).css("background-color",self.AllRevocation[i][1]).attr("render","false");
              });
            }
            else{
              for(var j = 2;j < self.AllRevocation[i].length;j++){
                self.AllRevocation[i][j].css('background-color',self.AllRevocation[i][0]).attr("render",self.AllRevocation[i][1]);
              }
            }
          }
        }
      });
   }
/* ********************
   ********背景********
   ********page********
   ******************** */
   self.SketchpadBg = function(){
      $(".tool-bg").on("click",function(){
        if(self.ErrorOperate){
          self.Revocations.push("bg");
          self.Revocations.push(self.pickColor);
          $(".point").each(function(){
            $(this).css("background-color",self.pickColor).attr("render","false");
          });
          self.AllRevocation.push(self.Revocations);
          self.Revocations = [];
        }
      })
   }
/* ********************
   *****保存为图片*****
   ********page********
   ******************** */
   self.SaveImg = function(){
      $(".tool-save").on("click",function(){
        if(self.ErrorOperate){
          html2canvas($('.sketchpad-sket')[0], {
            // allowTaint: true,
            // taintTest: false,
            onrendered: function(canvas) {
                //生成base64图片数据
                var dataUrl = canvas.toDataURL();
                $('.down').attr("href",dataUrl);
                $('.down').show();
                $(".m-downTip").show();
            }
          });
        }
      })
   }
/* ********************
   ******越界判断******
   ********page********
   ******************** */
   self.BoundsX = function(x){
      if(x < 0){
        return 0;
      }
      else if(x >= self.DomPoints.length){
        return self.DomPoints.length - 1;
      }
      return x;
   }
   self.BoundsY = function(y){
      if(y < 0){
        return 0;
      }
      else if(y >= self.DomPoints[0].length){
        return self.DomPoints[0].length - 1;
      }
      return y;
   }
 /* *******************
   ****选择笔头大小****
   ********page********
   ******************** */
   self.sizeChose = function(rel){
      var x = rel == "pencil" ? self.pencilSize : self.eraserSize;
      $(".tool-btn02").off("click");
      $(".tool-btn02").each(function(){
        $(this).css({"background-color":"rgb(250,250,250)","color":"#000","border-color":"#aaa"});
        if(parseInt($(this).attr("size")) == x){
          $(this).css({"background-color":"rgb(129, 210, 238)","color":"#fff","border-color":"rgb(129, 210, 238)"});
          self.renderSize = x;
        }
      });
      $(".tool-btn02").on("click",function(){
        $(".tool-btn02").each(function(){
          $(this).css({"background-color":"rgb(250,250,250)","color":"#000","border-color":"#aaa"});
        });
        $(this).css({"background-color":"rgb(129, 210, 238)","color":"#fff","border-color":"rgb(129, 210, 238)"});
        self.renderSize = parseInt($(this).attr("size"));
        rel == "pencil" ? self.pencilSize = parseInt($(this).attr("size")) : self.eraserSize = parseInt($(this).attr("size"))
      })
   }
/* ********************
   ******颜色填充******
   ********page********
   ******************** */
   self.filling = function(){
      $(".tool-filling").on("click",function(){
        if(self.ErrorOperate){
          self.sketchpadRemove();
          self.coloring = "true";
          $(".sketchpad-painting").css('cursor','url(img/paint.ico),auto');
          $(".sketchpad-painting")[0].addEventListener("touchstart",self.fillingClick = function(e){
            self.Revocations.push(self.pickColor);
            self.Revocations.push(self.coloring);
            var touch = e.targetTouches[0];
            var x = parseInt(touch.clientX/20);
            var y = parseInt(touch.clientY/20);
            self.fill(x,y);
            self.AllRevocation.push(self.Revocations);
            self.Revocations = [];
          },false);
        }
      });
   }
   self.fill = function(x,y){
    var that = self.DomPoints[x][y];
    if(that.attr("render") == "false"){
      self.PointRender(x,y,self.pickColor);
      if(x+1 < self.DomPoints.length && self.DomPoints[x+1][y].attr("render") == "false"){
        self.fill(x+1,y);
      }
      if(y+1 < self.DomPoints[x].length && self.DomPoints[x][y+1].attr("render") == "false"){
        self.fill(x,y+1);
      }
      if(x-1 >= 0 && self.DomPoints[x-1][y].attr("render") == "false"){
        self.fill(x-1,y);
      }
      if(y-1 >= 0 && self.DomPoints[x][y-1].attr("render") == "false"){
        self.fill(x,y-1);
      }
    }
   }
 /* ********************
   ******矩形选择******
   ********page********
   ******************** */
   self.shapeChose = function(){
      $(".tool-shape").on("click",function(){
        $(".tool-pen-size").hide();
        $(".tool-shape-chose").show();
        $(".tool-btn-shape").each(function(){
          $(this).css({"background-color":"rgb(250,250,250)","color":"#000","border-color":"#aaa"});
        });
      });
      $("body").on("click",".tool-btn-shape",function(){
        $(".tool-btn-shape").each(function(){
          $(this).css({"background-color":"rgb(250,250,250)","color":"#000","border-color":"#aaa"});
        });
        $(this).css({"background-color":"rgb(129, 210, 238)","color":"#fff","border-color":"rgb(129, 210, 238)"});
      });
      $("body").on("click",".tool-btn-line",function(){
        self.shapePainting("line");
      });
      $("body").on("click",".tool-btn-square",function(){
        self.shapePainting("square");
      });
      $("body").on("click",".tool-btn-circle",function(){
        self.shapePainting("circle");
      });
      $("body").on("click",".tool-btn-triangle",function(){
        self.shapePainting("triangle");
      });
   }
   self.shapePainting = function(rel){
      self.sketchpadRemove();
      self.coloring = "true";
      $(".sketchpad-painting").css('cursor','crosshair');
      var x1,y1,x2,y2 = 0;
      $(".sketchpad-painting")[0].addEventListener("touchstart",self.shapePaintingStart = function(e){
        var touch = e.targetTouches[0];
        var x = touch.clientX;
        var y = touch.clientY;
        x1 = parseInt(x/20);
        y1 = parseInt(y/20);
        self.Revocations.push(self.pickColor);//撤销(记录这一次的操作的颜色)
        self.Revocations.push(self.coloring);//撤销（记录这一次操作的状态）
      },false);
      $(".sketchpad-painting")[0].addEventListener("touchend",self.shapePaintingEnd = function(e){
        var touch = e.changedTouches[0];
        var x = touch.clientX;
        var y = touch.clientY;
        x2 = parseInt(x/20);
        y2 = parseInt(y/20);
        switch(rel)
        {
          case "line":
            self.shapeLine(x1,y1,x2,y2);
            break;
          case "square":
            self.shapeSquare(x1,y1,x2,y2);
            break;
          case "circle":
            self.shapeCircle(x1,y1,x2,y2);
            break;
          case "triangle":
            self.shapeTriangle(x1,y1,x2,y2);
            break;
        }
        self.AllRevocation.push(self.Revocations);//撤销 
        self.Revocations = [];//撤销
      },false);
   }
   self.shapeLine = function(x1,y1,x2,y2){
      // x1 = self.BoundsX(x1);
      // x2 = self.BoundsX(x2);
      // y1 = self.BoundsY(y1);
      // y2 = self.BoundsY(y2);
      var item;
      if(x2-x1 >= y2-y1 && x2 >= x1 && y2 >= y1){
        item = x1;
        for(var i = y1;i <= y2;i++){
          for(var j = item;j <= item+(x2-x1)/(y2-y1+1);j++){
            self.PointRender(j,i,self.pickColor);
          }
          item += Math.round((x2-x1)/(y2-y1+1));
        }
      }
      else if(x2-x1 <= y2-y1 && x2 >= x1 && y2 >= y1){
        item = y1;
        for(var i = x1;i <= x2;i++){
          for(var j = item;j <= item+(y2-y1)/(x2-x1+1);j++){
            self.PointRender(i,j,self.pickColor);
          }
          item += Math.round((y2-y1)/(x2-x1+1));
        }
      }
      else if(x1-x2 <= y2-y1 && x2 <= x1 && y2 >= y1){
        item = y2;
        for(var i = x2;i <= x1;i++){
          for(var j = item;j >= item-(y2-y1)/(x1-x2+1);j--){
            self.PointRender(i,j,self.pickColor);
          }
          item -= Math.round((y2-y1)/(x1-x2+1));
        }
      }
      else if(x1-x2 >= y2-y1 && x2 <= x1 && y2 >= y1){
        item = x2;
        for(var i = y2;i >= y1;i--){
          for(var j = item;j <= item+(x1-x2)/(y2-y1+1);j++){
            self.PointRender(j,i,self.pickColor);
          }
          item += Math.round((x1-x2)/(y2-y1+1));
        }
      }
      else if(x1-x2 >= y1-y2 && x2 <= x1 && y2 <= y1){
        item = x2;
        for(var i = y2;i <= y1;i++){
          for(var j = item;j <= item+(x1-x2)/(y1-y2+1);j++){
            self.PointRender(j,i,self.pickColor);
          }
          item += Math.round((x1-x2)/(y1-y2+1));
        }
      }
      else if(x1-x2 <= y1-y2 && x2 <= x1 && y2 <= y1){
        item = y2;
        for(var i = x2;i <= x1;i++){
          for(var j = item;j <= item+(y1-y2)/(x1-x2+1);j++){
            self.PointRender(i,j,self.pickColor);
          }
          item += Math.round((y1-y2)/(x1-x2+1));
        }
      }
      else if(x2-x1 <= y1-y2 && x2 >= x1 && y2 <= y1){
        item = y1;
        for(var i = x1;i <= x2;i++){
          for(var j = item;j >= item-(y1-y2)/(x2-x1+1);j--){
            self.PointRender(i,j,self.pickColor);
          }
          item -= Math.round((y1-y2)/(x2-x1+1));
        }
      }
      else if(x2-x1 >= y1-y2 && x2 >= x1 && y2 <= y1){
        item = x1;
        for(var i = y1;i >= y2;i--){
          for(var j = item;j <= item+(x2-x1)/(y1-y2+1);j++){
            self.PointRender(j,i,self.pickColor);
          }
          item += Math.round((x2-x1)/(y1-y2+1));
        }
      }
   }
   self.shapeSquare = function(x1,y1,x2,y2){
      // x1 = self.BoundsX(x1);
      // x2 = self.BoundsX(x2);
      // y1 = self.BoundsY(y1);
      // y2 = self.BoundsY(y2);
      if(x2 >= x1 && y2 >= y1){
        for(var i = x1;i <= x2;i++){
          self.PointRender(i,y1,self.pickColor);
          self.PointRender(i,y2,self.pickColor);
        }
        for(var i = y1;i <= y2;i++){
          self.PointRender(x1,i,self.pickColor);
          self.PointRender(x2,i,self.pickColor);
        }
      }
      else if(x2 <= x1 && y2 >= y1){
        for(var i = x2;i <= x1;i++){
          self.PointRender(i,y1,self.pickColor);
          self.PointRender(i,y2,self.pickColor);
        }
        for(var i = y1;i <= y2;i++){
          var j = x1;
          self.PointRender(x1,i,self.pickColor);
          self.PointRender(x2,i,self.pickColor);
        }
      }
      else if(x2 <= x1 && y2 <= y1){
        for(var i = x2;i <= x1;i++){
          self.PointRender(i,y1,self.pickColor);
          self.PointRender(i,y2,self.pickColor);
        }
        for(var i = y2;i <= y1;i++){
          self.PointRender(x1,i,self.pickColor);
          self.PointRender(x2,i,self.pickColor);
        }
      }
      else if(x2 >= x1 && y2 <= y1){
        for(var i = x1;i <= x2;i++){
          self.PointRender(i,y1,self.pickColor);
          self.PointRender(i,y2,self.pickColor);
        }
        for(var i = y2;i <= y1;i++){
          self.PointRender(x1,i,self.pickColor);
          self.PointRender(x2,i,self.pickColor);
        }
      }
   }
   self.shapeCircle = function(x1,y1,x2,y2){
      // x1 = self.BoundsX(x1);
      // x2 = self.BoundsX(x2);
      // y1 = self.BoundsY(y1);
      // y2 = self.BoundsY(y2);
      if(x2 >= x1 && y2 >= y1){
        for(var i = x1+2;i <= x2-2;i++){
          self.PointRender(i,y1,self.pickColor);
          self.PointRender(i,y2,self.pickColor);
        }
        for(var j = y1+2;j <= y2-2;j++){
          self.PointRender(x1,j,self.pickColor);
          self.PointRender(x2,j,self.pickColor);
        }
        self.PointRender(x1+1,y1+1,self.pickColor);
        self.PointRender(x2-1,y2-1,self.pickColor);
        self.PointRender(x1+1,y2-1,self.pickColor);
        self.PointRender(x2-1,y1+1,self.pickColor);
      }
      else if(x2 <= x1 && y2 >= y1){
        for(var i = x2+2;i <= x1-2;i++){
          self.PointRender(i,y1,self.pickColor);
          self.PointRender(i,y2,self.pickColor);
        }
        for(var j = y1+2;j <= y2-2;j++){
          self.PointRender(x2,j,self.pickColor);
          self.PointRender(x1,j,self.pickColor);
        }
        self.PointRender(x2+1,y1+1,self.pickColor);
        self.PointRender(x1-1,y2-1,self.pickColor);
        self.PointRender(x2+1,y2-1,self.pickColor);
        self.PointRender(x1-1,y1+1,self.pickColor);
      }
      else if(x2 <= x1 && y2 <= y1){
        for(var i = x2+2;i <= x1-2;i++){
          self.PointRender(i,y1,self.pickColor);
          self.PointRender(i,y2,self.pickColor);
        }
        for(var j = y2+2;j <= y1-2;j++){
          self.PointRender(x2,j,self.pickColor);
          self.PointRender(x1,j,self.pickColor);
        }
        self.PointRender(x2+1,y2+1,self.pickColor);
        self.PointRender(x1-1,y1-1,self.pickColor);
        self.PointRender(x2+1,y1-1,self.pickColor);
        self.PointRender(x1-1,y2+1,self.pickColor);
      }
      else if(x2 >= x1 && y2 <= y1){
        for(var i = x1+2;i <= x2-2;i++){
          self.PointRender(i,y1,self.pickColor);
          self.PointRender(i,y2,self.pickColor);
        }
        for(var j = y2+2;j <= y1-2;j++){
          self.PointRender(x2,j,self.pickColor);
          self.PointRender(x1,j,self.pickColor);
        }
        self.PointRender(x1+1,y2+1,self.pickColor);
        self.PointRender(x2-1,y1-1,self.pickColor);
        self.PointRender(x1+1,y1-1,self.pickColor);
        self.PointRender(x2-1,y2+1,self.pickColor);
      }
   }
   self.shapeTriangle = function(x1,y1,x2,y2){
      // x1 = self.BoundsX(x1);
      // x2 = self.BoundsX(x2);
      // y1 = self.BoundsY(y1);
      // y2 = self.BoundsY(y2);
      if(x2 >= x1){
        var k = y1+1;
        for(var i = x1;i <= x2;i++){
          var j = y1;
          self.PointRender(i,j,self.pickColor);
          if(i <= x1 + Math.round((x2-x1)/2)){
            k--;
            self.PointRender(i,k,self.pickColor);
            if(i == x1 + Math.round((x2-x1)/2)){
              k++;
            }
          }
          else{
            self.PointRender(i,k,self.pickColor);
            k++;
          }
          if(i == x2 && k != y1+1){
            self.PointRender(i+1,k,self.pickColor);
          }
        }
      }
      if(x2 <= x1){
        var k = y1+1;
        for(var i = x2;i <= x1;i++){
          var j = y1;
          self.PointRender(i,j,self.pickColor);
          if(i <= x2 + Math.round((x1-x2)/2)){
            k--;
            self.PointRender(i,k,self.pickColor);
            if(i == x2 + Math.round((x1-x2)/2)){
              k++;
            }
          }
          else{
            self.PointRender(i,k,self.pickColor);
            k++;
          }
          if(i == x1 && k != y1+1){
            self.PointRender(i+1,k,self.pickColor);
          }
        }
      }
   }

}
