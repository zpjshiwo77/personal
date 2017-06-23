<?php 
include '../publicHtml/common_css.html';
include '../publicHtml/header.html';
?>
<div id="sidebar" class="sidebar" data-info='{"act":"food"}' style="display:none;"></div>
<div class="content" style="display:none;">
	<div class="title">美食</div>
	<div class="cont" style="width:800px;">
		<div class="form-group">
			<label class="col-sm-2">步骤名称</label>
			<div class="col-sm-10">
				<input type="text" id="title" class="form-control">
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-2">步骤图片地址</label>
			<div class="col-sm-10">
				<input type="text" id="img" class="form-control">
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-2">小贴士</label>
			<div class="col-sm-10">
				<textarea rows="2" id="tips" maxlength="150" class="form-control"></textarea>
			</div>
			<p class="tips w-red" style="padding-top:5px;">若不存在请填0</p>
		</div>
		<div class="form-group">
			<label class="col-sm-2">步骤描述</label>
			<div class="col-sm-10">
				<textarea rows="4" id="step" maxlength="300" class="form-control"></textarea>
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
<script src="../js/page/food_step_edit.js"></script>
</body>
</html>