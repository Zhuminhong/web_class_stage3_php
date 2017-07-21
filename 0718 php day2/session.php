<?php
/**
 *作者:
 *邮箱:
 *创建日期:
 */
session_start();

$_SESSION['username'] = "tom"; // 每个页面都能显示,生命周期为关闭浏览器之前
unset($_SESSION['username']);
echo "<pre>";
var_dump($_SESSION);
echo "</pre>a";
?>