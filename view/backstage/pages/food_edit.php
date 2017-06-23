<?php 
include '../publicHtml/common_css.html';
include '../publicHtml/header.html';
?>
<div id="sidebar" class="sidebar" data-info='{"act":"food"}' style="display:none;"></div>
<div class="content" style="display:none;">
	<div class="title">美食</div>
	<div class="cont" style="width:800px;">
		<div class="form-group">
			<label class="col-sm-2">名称</label>
			<div class="col-sm-10">
				<input type="text" id="name" class="form-control">
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-2">英文名称</label>
			<div class="col-sm-10">
				<input type="text" id="Ename" class="form-control">
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-2">添加时间</label>
			<div class="col-sm-10">
				<input type="text" id="time" class="form-control">
			</div>
			<p class="tips w-red">时间格式 yyyy-mm-dd</p>
		</div>
		<div class="form-group">
			<label class="col-sm-2">点赞数</label>
			<div class="col-sm-10">
				<input type="text" id="hite" class="form-control">
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-2">缩略图地址</label>
			<div class="col-sm-10">
				<input type="text" id="Simg" class="form-control">
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-2">大图地址</label>
			<div class="col-sm-10">
				<input type="text" id="Bimg" class="form-control">
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-2">简介</label>
			<div class="col-sm-10">
				<textarea rows="3" id="intro" maxlength="200" class="form-control"></textarea>
			</div>
		</div>
		<div class="form-group">
			<div class="col-sm-2 f_right">
				<a href="javascript:void(0)" onclick="history.go(-1)" class="btn btn-lg btn-block red w-white">返  回</a>
			</div>
			<div class="col-sm-2 f_right">
				<div class="btn btn-lg btn-block black w-white" id="submit">提  交</div>
			</div>
		</div>
	</div>
</div>
<?php
include '../publicHtml/common_js.html';
?>
<script src="../js/page/food_edit.js"></script>
</body>
</html>