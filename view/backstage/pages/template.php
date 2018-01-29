<?php 
include '../publicHtml/common_css.html';
include '../publicHtml/header.html';
?>
<div id="sidebar" class="sidebar" data-info='{"act":"music"}' style="display:none;"></div>
<div class="content" style="display:none;">
	<div class="title">音乐</div>
	<div class="cont" style="width:800px;">
		<div class="form-group">
			<label class="col-sm-2">图片上传测试</label>
			<div class="col-sm-10">
				<div class="uploadImg" data-id="test">上传图片</div>
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-2">图片上传测试</label>
			<div class="col-sm-10">
				<div class="uploadImg" data-id="test1">上传图片</div>
			</div>
		</div>
	</div>
</div>
<?php
include '../publicHtml/common_js.html';
?>
<script src="../js/page/template.js"></script>
</body>
</html>