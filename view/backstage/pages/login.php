<?php 
include '../publicHtml/common_css.html';
?>
<div class="login">
    <div class="logo red">柒</div>
    <p class="tip">Page的管理系统</p>

    <div class="form-group">
        <input type="text" id="username" placeholder="管理员帐号">
    </div>
    <div class="form-group">
        <input type="password" id="password" placeholder="密码">
    </div>
    <div class="form-group">
		<p class="remember active"><i class="icon-ok-circle"></i>记住账号</p>
    </div>
    <div class="btn black" id="login">立即登录</div>
</div>
<?php
include '../publicHtml/common_js.html';
?>
<script src="../js/page/login.js"></script>
</body>
</html>
