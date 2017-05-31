<?php 
include '../publicHtml/common_css.html';
include '../publicHtml/header.html';
?>
<div id="sidebar" class="sidebar" data-info='{"act":"music"}' style="display:none;"></div>
<div class="content" style="display:none;">
	<div class="title">音乐</div>
	<div class="cont">
		<div class="form-group">
            <div class="col-sm-2" style="padding:0;">
                <input type="text" id="songId" class="form-control">
            </div>
            <div class="btn black add" style="margin-left:10px;color:#fff;">添加</div>
        </div>
        <table class="table table-hover table-striped table-bordered">
    	 	<thead>
	            <tr>
	                <th>id</th>
	                <th>歌曲编号</th>
	                <th>歌名</th>
	                <th>歌手</th>
	                <th>所属专辑</th>
	                <th>操作</th>
	            </tr>
        	</thead>
	        <tbody id="songs">
	        </tbody>
    	<table>
	</div>
	<div class="form-group" style="float:right;" id="pager"></div>
</div>
<?php
include '../publicHtml/common_js.html';
?>
<script src="../js/page/music.js"></script>
</body>
</html>