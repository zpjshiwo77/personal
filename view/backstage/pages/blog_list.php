<?php 
include '../publicHtml/common_css.html';
include '../publicHtml/header.html';
?>
<div id="sidebar" class="sidebar" data-info='{"act":"blog"}' style="display:none;"></div>
<div class="content" style="display:none;">
	<div class="title">博客</div>
	<div class="cont">
		<div class="form-group">
            <a href="blog_class_edit.php" class="btn black" style="color:#fff;">新增分类</a>
            <a href="blog_edit.php" class="btn black" style="color:#fff;">新增博客</a>
            <select id="classification" class="btn black" style="color:#fff;padding-bottom:7px;">
            	<option value="0">全部分类</option>
            </select>
        </div>
		<table class="table table-hover table-striped table-bordered">
    	 	<thead>
	            <tr>
	                <th>id</th>
	                <th>分类</th>
	                <th>标签</th>
	                <th>标题</th>
	                <th>作者</th>
	                <th>时间</th>
	                <th>操作</th>
	            </tr>
        	</thead>
	        <tbody id="list">
	        </tbody>
    	</table>
	</div>
	<div class="form-group" style="float:right;" id="pager"></div>
</div>
<?php
include '../publicHtml/common_js.html';
?>
<script src="../js/page/blog_list.js"></script>
</body>
</html>