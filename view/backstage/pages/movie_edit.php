<?php 
include '../publicHtml/common_css.html';
include '../publicHtml/header.html';
?>
<div id="sidebar" class="sidebar" data-info='{"act":"movie"}' style="display:none;"></div>
<div class="content" style="display:none;">
	<div class="title">电影</div>
	<div class="cont" style="width:800px;">
		<div class="form-group">
			<label class="col-sm-2">海报</label>
			<div class="col-sm-10">
				<div class="uploadImg" data-id="poster">上传图片</div>
				<input type="text" id="poster" class="ImgInput">
			</div>
			<p class="tips w-red">推荐海报建议尺寸：770 * 336</p>
		</div>
		<div class="form-group">
			<label class="col-sm-2">是否推荐</label>
			<div class="col-sm-10">
				<select id="recommend" class="btn black" style="color:#fff;padding-bottom:7px;">
	            	<option value="0">否</option>
	            	<option value="1">是</option>
	            </select>
				</div>
		</div>
		<div class="form-group">
			<label class="col-sm-2">名称</label>
			<div class="col-sm-10">
				<input type="text" id="name" class="form-control">
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-2">点赞数</label>
			<div class="col-sm-10">
				<input type="text" id="hite" class="form-control">
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-2">外链</label>
			<div class="col-sm-10">
				<input type="text" id="DBurl" class="form-control">
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-2">简介</label>
			<div class="col-sm-10">
				<textarea rows="4" id="intro" maxlength="200" class="form-control"></textarea>
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
<script src="../js/page/movie_edit.js"></script>
</body>
</html>