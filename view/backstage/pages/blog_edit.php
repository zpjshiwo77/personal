<?php 
include '../publicHtml/common_css.html';
include '../publicHtml/header.html';
?>
<div id="sidebar" class="sidebar" data-info='{"act":"blog"}' style="display:none;"></div>
<div class="content" style="display:none;">
	<div class="title">新增博客</div>
	<div class="cont" style="width:1000px;">
		<div class="form-group">
            <label class="col-sm-1">分类</label>
            <div class="col-sm-10">
                <select class="select btn black" style="color:#fff;" id="classId">
                </select>
            </div>
        </div>
		<div class="form-group">
			<label class="col-sm-1">标签</label>
			<div class="col-sm-10">
				<input type="text" id="sign" class="form-control">
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-1">标题</label>
			<div class="col-sm-10">
				<input type="text" id="title" class="form-control">
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-1">作者</label>
			<div class="col-sm-10">
				<input type="text" id="author" class="form-control">
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-1">时间</label>
			<div class="col-sm-10">
				<input type="text" id="time" class="form-control">
			</div>
			<p class="tips w-red" style="padding-left:8.33333333%;">时间格式 yyyy-mm-dd</p>
		</div>
		<div class="form-group">
			<label class="col-sm-1">内容</label>
			<div class="col-sm-10">
				<script id="Editor" style="width:100%;height:600px;"></script>
			</div>
		</div>
		
		<div class="form-group">
			<div class="col-sm-1 f_right"></div>
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
<script src="../js/plugins/ueditor/js/ueditor.config.js"></script>
<script src="../js/plugins/ueditor/js/ueditor.all.min.js"></script>
<script src="../js/plugins/ueditor/lang/zh-cn/zh-cn.js"></script>
<script src="../js/page/blog_edit.js"></script>
</body>
</html>

