<?php 
include '../publicHtml/common_css.html';
include '../publicHtml/header.html';
?>
<div id="sidebar" class="sidebar" data-info='{"act":"game"}' style="display:none;"></div>
<div class="content" style="display:none;">
	<div class="title">游戏</div>
	<div class="cont">
		<div class="form-group">
            <a href="game_edit.php" class="btn black" style="color:#fff;">新增游戏</a>
        </div>
		<table class="table table-hover table-striped table-bordered">
    	 	<thead>
	            <tr>
	                <th>id</th>
	                <th>名称</th>
	                <th>类型</th>
                    <th>链接</th>
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
<script src="../js/page/game_list.js"></script>
</body>
</html>