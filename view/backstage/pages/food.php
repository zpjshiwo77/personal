<?php 
include '../publicHtml/common_css.html';
include '../publicHtml/header.html';
?>
<div id="sidebar" class="sidebar" data-info='{"act":"food"}' style="display:none;"></div>
<div class="content" style="display:none;">
	<div class="title">美食</div>
	<div class="cont">
		<div class="form-group">
            <a href="food_edit.php" class="btn black" style="color:#fff;">新增美食</a>
        </div>
		<table class="table table-hover table-striped table-bordered">
    	 	<thead>
	            <tr>
	                <th>id</th>
	                <th>名称</th>
	                <th>点赞数</th>
	                <th>添加时间</th>
	                <th>操作</th>
	            </tr>
        	</thead>
	        <tbody id="foodList">
	        </tbody>
    	</table>
	</div>
	<div class="form-group" style="float:right;" id="pager"></div>
</div>
<?php
include '../publicHtml/common_js.html';
?>
<script src="../js/page/food.js"></script>
</body>
</html>