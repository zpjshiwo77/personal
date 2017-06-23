<?php 
include '../publicHtml/common_css.html';
include '../publicHtml/header.html';
?>
<div id="sidebar" class="sidebar" data-info='{"act":"food"}' style="display:none;"></div>
<div class="content" style="display:none;">
	<div class="title">美食</div>
	<div class="cont">
		<div class="form-group">
            <div class="col-sm-5" style="padding:0;">
            	<span class="name f_left">名称</span>
            	<div class="col-sm-5">
            		<input type="text" id="name" class="form-control">
            	</div>
                <span class="name f_left">数量</span>
				<div class="col-sm-5">
					<input type="text" id="num" class="form-control f_left">
				</div>
            </div>
            <div class="btn black add" style="color:#fff;">添加</div>
        </div>
        <table class="table table-hover table-striped table-bordered">
    	 	<thead>
	            <tr>
	                <th>id</th>
	                <th>名称</th>
	                <th>数量</th>
	                <th>操作</th>
	            </tr>
        	</thead>
	        <tbody id="list">
	        </tbody>
    	<table>
	</div>
	<div class="form-group" style="float:right;" id="pager"></div>
</div>
<?php
include '../publicHtml/common_js.html';
?>
<script src="../js/page/food_m_list.js"></script>
</body>
</html>