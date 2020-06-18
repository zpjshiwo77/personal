<?php 
include '../publicHtml/common_css.html';
include '../publicHtml/header.html';
?>
<div id="sidebar" class="sidebar" data-info='{"act":"case"}' style="display:none;"></div>
<div class="content" style="display:none;">
	<div class="title">案例</div>
	<div class="cont">
		<div class="form-group">
            <a href="case_class_edit.php" class="btn black" style="color:#fff;">新增类别</a>
            <a href="case_edit.php" class="btn black" style="color:#fff;">新增案例</a>
            <select id="classification" class="btn black" style="color:#fff;padding-bottom:7px;">
            	<option value="0">全部类别</option>
            </select>
        </div>
		<table class="table table-hover table-striped table-bordered">
    	 	<thead>
	            <tr>
	                <th>id</th>
	                <th>类别</th>
	                <th>名称</th>
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
<script src="../js/page/case_list.js"></script>
</body>
</html>