<?php
// 创建连接
$conn = mysqli_connect(servername, username, password, dbname);
mysqli_set_charset($conn,"utf8");

// 检测连接
if ($conn->connect_error) {
    die("连接失败: " . $conn->connect_error);
} 
?>