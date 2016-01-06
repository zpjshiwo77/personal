var elm='<div class="margin box-shadow" style="width:0%;display:none"><div class="theme-title"><div class="blank"></div><span class="icons-remove"></span></div><div class="Mconcent"  style="display:none"></div></div>';
function add(id,title,station,elm,content,theme,height){
	station="."+station;
	theme="theme0"+theme;
	$(station).children().first().before(elm);
	var that=$(station).children().first();
	$(that).attr("id",id);
	$(that).addClass(theme);
	$(that).children().last().css("height",height);
	$(that).children().last().append(content);
	$(that).children().first().children().first().after(title);
	$(that).slideDown(300);
	$(that).addClass("animation-show");
	var t=setTimeout(function(){
		$(that).removeClass("animation-show");
		$(that).css("width","100%");
		$(that).children().last().slideDown(2.5*height);
	},1500);
}
//维修开单
$("#wxkdB").click(function(){
	if($("#wxkd").length==0){
		backtop();
		var wxkdC='<form class="form"> <div style="float:left;width:310px;margin-left:40px;"> <p>车牌号<span>*</span><input type="text"></p> <p>客户名称<span>*</span><input type="text"></p> <p>联系手机<span>*</span><input type="text"></p> <p>车架号VIN<input type="text"></p> <p>车型备注<input type="text"></p> <p>购车时间<input type="text"></p> <p>全拼<input type="text"></p> <p>下次保养<input type="text"></p> <p>下次保险<input type="text"></p> <p>保险公司<input type="text"></p> </div> <div style="float:left;width:310px;"> <p>颜色<input type="text"></p> <p>联系人<input type="text"></p> <p>联系电话<input type="text"></p> <p>发动机号<input type="text"></p> <p>最新里程<input type="text"></p> <p>发动机型号<input type="text"></p> <p>简拼<input type="text"></p> <p>下次年审<input type="text"></p> <p>下次回访<input type="text"></p> <p>客户类型<input type="text"></p> </div> <div style="float:left;width:620px;margin-left:40px;"> <p>保险备注<input style="width:520px;" type="text"></p> <p>备注<input style="width:520px;" type="text"></p> <input class="submit" style="width:600px;" id="wxkdSubmit" type="submit" value="提交"> </div> </form> ';
		add("wxkd","创建订单","center",elm,wxkdC,3,550);
	}
	else{
		window.location="#wxkd";
	}
});
//维修单管理
$("#wxdglB").click(function(){
	if($("#wxdgl").length==0){
		backtop();
		var wx='<div style="height: 50px;width: 680px;" class="contentBg"> <form class="form"> <div style="width:185px;float:left"><p>维修单号<input style="width:100px;" type="text"></p></div> <div style="width:185px;float:left"><p>车牌号<input style="width:100px;" type="text"></p></div> <div style="width:185px;float:left"><p>维修状态<select style="width:100px;"><option>所有</option><option>在修</option><option>完工</option></select></p></div> <input class="submit" style="width:93px; padding:2.5px 0px;" id="fitbtn" type="submit" value="查询"> </form> </div> <div style="height:189px; width:680px; margin-top:10px;" class="contentBg"> <table class="mytable" id="RepairOrder"> <tr> <th style="width: 80px;">维修单号</th> <th style="width: 80px;">客户名称</th> <th style="width: 90px;">车牌号</th> <th style="width: 80px;">结算金额</th> <th style="width: 80px;">已收金额</th> <th style="width: 80px;">尚欠金额</th> <th style="width: 80px;">维修状态</th> <th style="width: 107px;">操作</th> </tr> <tr> <td>100001</td> <td>柒柒</td> <td>贵H00000</td> <td>100.00</td> <td>77.00</td> <td>23.00</td> <td>在修</td> <td><div class="mybtn" style="margin:0px 20px;">完成</div></td> </tr> <tr> <td>100001</td> <td>柒柒</td> <td>贵H00000</td> <td>100.00</td> <td>77.00</td> <td>23.00</td> <td>在修</td> <td><div class="mybtn" style="margin:0px 20px;">完成</div></td> </tr> <tr> <td>100001</td> <td>柒柒</td> <td>贵H00000</td> <td>100.00</td> <td>77.00</td> <td>23.00</td> <td>完成</td> <td><div class="mybtn" style="margin:0px 20px;">删除</div></td> </tr> <tr> <td>100001</td> <td>柒柒</td> <td>贵H00000</td> <td>100.00</td> <td>77.00</td> <td>23.00</td> <td>在修</td> <td><div class="mybtn" style="margin:0px 20px;">完成</div></td> </tr> <tr> <td>100001</td> <td>柒柒</td> <td>贵H00000</td> <td>100.00</td> <td>77.00</td> <td>23.00</td> <td>在修</td> <td><div class="mybtn" style="margin:0px 20px;">完成</div></td> </tr> </table> </div>';
		add("wxdgl","维修单管理","center",elm,wx,2,270);
	}
	else{
		window.location="#wxdgl";
	}
});
//销售开单
$("#xskdB").click(function(){
	if($("#xskd").length==0){
		backtop();
		var kd = '<div class="contentBg"><form class="form"> <p>客户名称<input type="text"></p> <p>客户电话<input type="text"></p> <p>车牌号<input type="text"></p> <p>购买物品<input type="text"></p> <p>物品单价<input type="text"></p> <p>购买数量<input type="text"></p> <input style="width:268px;" class="submit" id="fitbtn" type="submit" value="提交"> </form></div>'; 
		add("xskd","销售开单","right",elm,kd,2,310);
	}
	else{
		window.location="#xskd";
	}
});
//销售单管理
$("#xsdglB").click(function(){
	if($("#xsdgl").length==0){
		backtop();
		var wx='<div style="height: 50px;width: 680px;" class="contentBg"> <form class="form"> <div style="width:185px;float:left"><p>销售单号<input style="width:100px;" type="text"></p></div> <div style="width:185px;float:left"><p>车牌号<input style="width:100px;" type="text"></p></div> <div style="width:185px;float:left"></div> <input class="submit" style="width:93px; padding:2.5px 0px;" id="fitbtn" type="submit" value="查询"> </form> </div> <div style="height:189px; width:680px; margin-top:10px;" class="contentBg"> <table class="mytable" id="RepairOrder"> <tr> <th style="width: 80px;">销售单号</th> <th style="width: 80px;">客户名称</th> <th style="width: 90px;">车牌号</th> <th style="width: 80px;">物品名称</th> <th style="width: 80px;">结算金额</th> <th style="width: 80px;">已收金额</th> <th style="width: 80px;">尚欠金额</th>  <th style="width: 107px;">操作</th> </tr> <tr> <td>100001</td> <td>柒柒</td> <td>贵H00000</td><td>车轮</td> <td>100.00</td> <td>77.00</td> <td>23.00</td>  <td><div class="mybtn" style="margin:0px 20px;">退货</div></td> </tr> <tr> <td>100001</td> <td>柒柒</td> <td>贵H00000</td><td>车轮</td> <td>100.00</td> <td>77.00</td> <td>23.00</td> <td><div class="mybtn" style="margin:0px 20px;">退货</div></td> </tr> <tr> <td>100001</td> <td>柒柒</td> <td>贵H00000</td><td>车轮</td> <td>100.00</td> <td>77.00</td> <td>23.00</td><td><div class="mybtn" style="margin:0px 20px;">退货</div></td> </tr> <tr> <td>100001</td> <td>柒柒</td> <td>贵H00000</td><td>车轮</td> <td>100.00</td> <td>77.00</td> <td>23.00</td> <td><div class="mybtn" style="margin:0px 20px;">退货</div></td> </tr> <tr> <td>100001</td> <td>柒柒</td> <td>贵H00000</td><td>车轮</td> <td>100.00</td> <td>77.00</td> <td>23.00</td> <td><div class="mybtn" style="margin:0px 20px;">退货</div></td> </tr> </table> </div>';
		add("xsdgl","销售单管理","center",elm,wx,2,270);
	}
	else{
		window.location="#xsdgl";
	}
});
//销售退货
$("#xsthB").click(function(){
	if($("#xsdgl").length==0){
		backtop();
		var wx='<div style="height: 50px;width: 680px;" class="contentBg"> <form class="form"> <div style="width:185px;float:left"><p>销售单号<input style="width:100px;" type="text"></p></div> <div style="width:185px;float:left"><p>车牌号<input style="width:100px;" type="text"></p></div> <div style="width:185px;float:left"></div> <input class="submit" style="width:93px; padding:2.5px 0px;" id="fitbtn" type="submit" value="查询"> </form> </div> <div style="height:189px; width:680px; margin-top:10px;" class="contentBg"> <table class="mytable" id="RepairOrder"> <tr> <th style="width: 80px;">销售单号</th> <th style="width: 80px;">客户名称</th> <th style="width: 90px;">车牌号</th> <th style="width: 80px;">物品名称</th> <th style="width: 80px;">结算金额</th> <th style="width: 80px;">已收金额</th> <th style="width: 80px;">尚欠金额</th>  <th style="width: 107px;">操作</th> </tr> <tr> <td>100001</td> <td>柒柒</td> <td>贵H00000</td><td>车轮</td> <td>100.00</td> <td>77.00</td> <td>23.00</td>  <td><div class="mybtn" style="margin:0px 20px;">退货</div></td> </tr> <tr> <td>100001</td> <td>柒柒</td> <td>贵H00000</td><td>车轮</td> <td>100.00</td> <td>77.00</td> <td>23.00</td> <td><div class="mybtn" style="margin:0px 20px;">退货</div></td> </tr> <tr> <td>100001</td> <td>柒柒</td> <td>贵H00000</td><td>车轮</td> <td>100.00</td> <td>77.00</td> <td>23.00</td><td><div class="mybtn" style="margin:0px 20px;">退货</div></td> </tr> <tr> <td>100001</td> <td>柒柒</td> <td>贵H00000</td><td>车轮</td> <td>100.00</td> <td>77.00</td> <td>23.00</td> <td><div class="mybtn" style="margin:0px 20px;">退货</div></td> </tr> <tr> <td>100001</td> <td>柒柒</td> <td>贵H00000</td><td>车轮</td> <td>100.00</td> <td>77.00</td> <td>23.00</td> <td><div class="mybtn" style="margin:0px 20px;">退货</div></td> </tr> </table> </div>';
		add("xsdgl","销售单管理","center",elm,wx,2,270);
	}
	else{
		window.location="#xsdgl";
	}
});
//配件采购
$("#pjcgB").click(function(){
	if($("#pjcg").length==0){
		backtop();
		var wx='<form class="form"> <p>配件编码<input type="text"></p> <p>配件名称<input type="text"></p> <p>采购量<input type="text"></p> <p>成本价<input type="text"></p> <p>销售价<input type="text"></p> <input class="submit" id="pjcgS" type="submit" value="提交"> </form>'; 
		add("pjcg","配件采购","right",elm,wx,3,270);
	}
	else{
		window.location="#pjcg";
	}
});
//采购单采购
$("#cgdcgB").click(function(){
	if($("#cgdcg").length==0){
		backtop();
		var wx='<form class="form"> <div class="contentBg" style="height:425px"><div style="float:left;width:310px;margin-left:28px;"> <p>配件编码<span>*</span><input type="text"></p> <p>当前库存<span>*</span><input type="text"></p> <p>成本价<span>*</span><input type="text"></p> <p>单位<input type="text"></p> <p>品牌<input type="text"></p> <p>产地<input type="text"></p> <p>全拼<input type="text"></p></div> <div style="float:left;width:310px;"> <p>配件名称<span>*</span><input type="text"></p> <p>安全库存<span>*</span><input type="text"></p> <p>销售价<span>*</span><input type="text"></p> <p>会员价<span>*</span><input type="text"></p> <p>规格<input type="text"></p> <p>货位<input type="text"></p> <p>简拼<input type="text"></p> </div> <div style="float:left;width:620px;margin-left:28px;"> <p>适用车型<input style="width:520px;" type="text"></p> <p>OEM码<input style="width:520px;" type="text"></p> <input class="submit" style="width:600px;" id="wxkdSubmit" type="submit" value="提交"> </div></div></form> ';
		add("cgdcg","采购单采购","center",elm,wx,2,440);
	}
	else{
		window.location="#cgdcg";
	}
});
//采购退货
$("#cgthB").click(function(){
	if($("#cgth").length==0){
		backtop();
		var wx='<div style="height: 50px;width: 680px;" class="contentBg"> <form class="form"> <div style="width:185px;float:left"><p>采购单号<input style="width:100px;" type="text"></p></div> <div style="width:185px;float:left"></div> <div style="width:185px;float:left"></div> <input class="submit" style="width:93px; padding:2.5px 0px;" id="fitbtn" type="submit" value="查询"> </form> </div> <div style="height:126px; width:680px; margin-top:10px;" class="contentBg"> <table class="mytable" id="RepairOrder"> <tr> <th style="width: 80px;">采购单号</th> <th style="width: 80px;">操作员</th> <th style="width: 90px;">物品名称</th> <th style="width: 80px;">价格</th> <th style="width: 80px;">数量</th> <th style="width: 80px;">品牌</th> <th style="width: 80px;">适用车型</th>  <th style="width: 107px;">操作</th> </tr> <tr> <td>17777777</td> <td>王五</td> <td>尾翼</td><td>1380.00</td> <td>10.00</td> <td>新尾翼</td> <td>福特SUV</td>  <td><div class="mybtn" style="margin:0px 20px;">退货</div></td> </tr><tr> <td>17777778</td> <td>张三</td> <td>尾翼</td><td>1380.00</td> <td>5.00</td> <td>新尾翼</td> <td>福特SUV</td>  <td><div class="mybtn" style="margin:0px 20px;">退货</div></td> </tr><tr> <td>17777779</td> <td>李四</td> <td>轮胎</td><td>580.00</td> <td>20.00</td> <td>德玛轮胎</td> <td>福特SUV</td>  <td><div class="mybtn" style="margin:0px 20px;">退货</div></td> </tr></table> </div>';
		add("cgth","采购退货","center",elm,wx,2,205);
	}
	else{
		window.location="#cgth";
	}
});
//采购退货单管理
$("#cgthdglB").click(function(){
	if($("#cgth").length==0){
		backtop();
		var wx='<div style="height: 50px;width: 680px;" class="contentBg"> <form class="form"> <div style="width:185px;float:left"><p>采购单号<input style="width:100px;" type="text"></p></div> <div style="width:185px;float:left"></div> <div style="width:185px;float:left"></div> <input class="submit" style="width:93px; padding:2.5px 0px;" id="fitbtn" type="submit" value="查询"> </form> </div> <div style="height:126px; width:680px; margin-top:10px;" class="contentBg"> <table class="mytable" id="RepairOrder"> <tr> <th style="width: 80px;">采购单号</th> <th style="width: 80px;">操作员</th> <th style="width: 90px;">物品名称</th> <th style="width: 80px;">价格</th> <th style="width: 80px;">数量</th> <th style="width: 80px;">品牌</th> <th style="width: 80px;">适用车型</th>  <th style="width: 107px;">操作</th> </tr> <tr> <td>17777777</td> <td>王五</td> <td>尾翼</td><td>1380.00</td> <td>10.00</td> <td>新尾翼</td> <td>福特SUV</td>  <td><div class="mybtn" style="margin:0px 20px;">退货</div></td> </tr><tr> <td>17777778</td> <td>张三</td> <td>尾翼</td><td>1380.00</td> <td>5.00</td> <td>新尾翼</td> <td>福特SUV</td>  <td><div class="mybtn" style="margin:0px 20px;">退货</div></td> </tr><tr> <td>17777779</td> <td>李四</td> <td>轮胎</td><td>580.00</td> <td>20.00</td> <td>德玛轮胎</td> <td>福特SUV</td>  <td><div class="mybtn" style="margin:0px 20px;">退货</div></td> </tr></table> </div>';
		add("cgth","采购退货","center",elm,wx,2,205);
	}
	else{
		window.location="#cgth";
	}
});
//员工管理
$("#ygglB").click(function(){
	if($("#MyStaff").length==0){
		backtop();
		var wx='<div class="TolSales "> <img src="img/sales.png"><div><span class="Tolmath">1023.3万</span><span class="Tolep">总销售额</span></div> <img src="img/Elpe.png"><div><span class="Tolmath">7人</span><span class="Tolep">员工总数</span></div> </div> <ul style="margin-bottom:0px;"> <li> <div class="PerSales"> <span class="PerMath">118.9万</span> <span class="PerEp">个人销售额</span> </div> <div class="PerPot"><img src="img/pot/1.jpg"></div> <div class="PerIndus"> <span>张三</span> <p>新晋职员，第一年就有着非常不错的销售业绩！</p> </div> </li> <li> <div class="PerSales"> <span class="PerMath">150.8万</span> <span class="PerEp">个人销售额</span> </div> <div class="PerPot"><img src="img/pot/2.jpg"></div> <div class="PerIndus"> <span>李四</span> <p>勤勤恳恳的老员工。</p> </div> </li> <li> <div class="PerSales"> <span class="PerMath">194.4万</span> <span class="PerEp">个人销售额</span> </div> <div class="PerPot"><img src="img/pot/3.jpg"></div> <div class="PerIndus"> <span>王五</span> <p>每年的销售之王！</p> </div> </li> </ul> <div class="PreMore">More staffs ......</div>';
		add("MyStaff","我的员工","right",elm,wx,2,300);
	}
	else{
		window.location="#MyStaff";
	}
});
//配件管理
$("#pjglB").click(function(){
	if($("#pjgl").length==0){
		backtop();
		var wx='<div class="contentBg" style="height:300px;"> <div class="goods"> <div class="status color02"></div> <span></span> <p>德玛轮胎</p> <p>库存：<b>50</b></p> </div> <div class="goods"> <div class="status color01"></div> <span>缺</span> <p>易刹车</p> <p>库存：<b>3</b></p> </div> <div class="goods"> <div class="status color02"></div> <span></span> <p>蛮王轮胎</p> <p>库存：<b>70</b></p> </div> <div class="goods"> <div class="status color02"></div> <span></span> <p>瑞兹轮胎</p> <p>库存：<b>30</b></p> </div> <div class="goods"> <div class="status color02"></div> <span></span> <p>水杯</p> <p>库存：<b>500</b></p> </div> <div class="goods"> <div class="status color03"></div> <span>无</span> <p>新尾翼</p> <p>库存：<b>0</b></p> </div> <div class="goods"> <div class="status color01"></div> <span>缺</span> <p>手刹</p> <p>库存：<b>11</b></p> </div> <div class="goods"> <div class="status color02"></div> <span></span> <p>泽拉斯螺丝</p> <p>库存：<b>3000</b></p> </div> <div class="goods"> <div class="status color03"></div> <span>无</span> <p>车牌</p> <p>库存：<b>0</b></p> </div> <div class="goods"> <div class="status color01"></div> <span>缺</span> <p>车座</p> <p>库存：<b>5</b></p> </div> <div class="goods"> <div class="status color03"></div> <span>无</span> <p>GPS</p> <p>库存：<b>0</b></p> </div> <div class="goods"> <div class="status color02"></div> <span></span> <p>车载音响</p> <p>库存：<b>77</b></p> </div> <div class="goods"> <div class="status color02"></div> <span></span> <p>德玛轮胎</p> <p>库存：<b>50</b></p> </div> <div class="goods"> <div class="status color02"></div> <span></span> <p>德玛轮胎</p> <p>库存：<b>50</b></p> </div> <div class="goods"> <div class="status color02"></div> <span></span> <p>德玛轮胎</p> <p>库存：<b>50</b></p> </div> <div class="goods"> <div class="status color02"></div> <span></span> <p>德玛轮胎</p> <p>库存：<b>50</b></p> </div> <div class="goods"> <div class="status color02"></div> <span></span> <p>德玛轮胎</p> <p>库存：<b>50</b></p> </div> <div class="goods"> <div class="status color02"></div> <span></span> <p>德玛轮胎</p> <p>库存：<b>50</b></p> </div> </div> </div>';
		add("pjgl","配件管理","center",elm,wx,2,320);
	}
	else{
		window.location="#pjgl";
	}
});
//维修项目管理
$("#wxxmglB").click(function(){
	if($("#wxxmgl").length==0){
		backtop();
		var wx='<div class="project"> <ul> <li> <div class="PojName">xxx维修项目<p>工时：<span style="color:#03A678">15</span>/60</p></div> <span class="ProBar"></span> <span class="ProBar jindu" style="background-color:#2e6da4; width:25%"></span> </li> <li> <div class="PojName">xxx维修项目<p>工时：<span style="color:#03A678">30</span>/45</p></div> <span class="ProBar"></span> <span class="ProBar jindu" style="background-color:rgb(204,55,71); width:66.7%"></span> </li> <li> <div class="PojName">xxx维修项目<p>工时：<span style="color:#03A678">77</span>/100</p></div> <span class="ProBar"></span> <span class="ProBar jindu" style="background-color:rgb(204,55,71); width:77%"></span> </li> <li> <div class="PojName">xxx维修项目<p>工时：<span style="color:#03A678">35</span>/100</p></div> <span class="ProBar"></span> <span class="ProBar jindu" style="background-color:#f0ad4e; width:35%"></span> </li> <li> <div class="PojName">xxx维修项目<p>工时：<span style="color:#03A678">1</span>/15</p></div> <span class="ProBar"></span> <span class="ProBar jindu" style="background-color:#2e6da4; width:7%"></span> </li> <li> <div class="PojName">xxx维修项目<p>工时：<span style="color:#03A678">5</span>/12</p></div> <span class="ProBar"></span> <span class="ProBar jindu" style="background-color:#f0ad4e; width:41.7%"></span> </li> </ul> </div> <div class="PojSeach"> <div class="seach"> <div><img src="img/poj.png"></div> <input type="text" name="pojseach"  onfocus=\'if(this.value == "请输入需要搜索的项目名称.....") this.value = ""\' onblur=\'if(this.value =="") this.value = "请输入需要搜索的项目名称....."\' value="请输入需要搜索的项目名称....."> <span><img src="img/seach.png"></span> </div> </div>';
		add("wxxmgl","维修项目管理","center",elm,wx,2,350);
	}
	else{
		window.location="#wxxmgl";
	}
});