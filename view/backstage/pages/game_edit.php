<?php 
include '../publicHtml/common_css.html';
include '../publicHtml/header.html';
?>
<div id="sidebar" class="sidebar" data-info='{"act":"game"}' style="display:none;"></div>
<div class="content" style="display:none;">
	<div class="title">游戏</div>
	<div class="cont" style="width:1000px;">
		<div class="form-group">
			<label class="col-sm-2">缩略图</label>
			<div class="col-sm-10">
				<div class="uploadImg" data-id="sImg">上传图片</div>
				<input type="text" id="sImg" class="ImgInput">
			</div>
			<p class="tips w-red">建议尺寸：240 * 148</p>
        </div>
        <div class="form-group codeImgBox" style="display:none">
			<label class="col-sm-2">二维码/小游戏码</label>
			<div class="col-sm-10">
				<div class="uploadImg" data-id="codeImg">上传图片</div>
				<input type="text" id="codeImg" class="ImgInput">
			</div>
			<p class="tips w-red">建议尺寸：280 * 280</p>
		</div>
		<div class="form-group">
			<label class="col-sm-2">类型</label>
			<div class="col-sm-10">
				<select id="type" class="btn black" style="color:#fff;padding-bottom:7px;">
	            	<option value="0">链接</option>
	            	<option value="1">图片</option>
	            </select>
				</div>
		</div>
		<div class="form-group">
			<label class="col-sm-2">名称</label>
			<div class="col-sm-10">
				<input type="text" id="name" class="form-control">
			</div>
		</div>
		<div class="form-group urlBox">
			<label class="col-sm-2">链接</label>
			<div class="col-sm-10">
				<input type="text" id="url" class="form-control">
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
<script src="../js/page/game_edit.js"></script>
</body>
</html>