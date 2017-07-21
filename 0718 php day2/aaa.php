<?php
/**
 *作者:
 *邮箱:
 *创建日期:
 */
error_reporting(E_ALL ^ E_NOTICE);

session_start();
echo "欢迎会员中心" . $_SESSION["username"] . "登录";
echo ",<a href='session_test.php?action=logout'>注销</a>";

if ($_GET['action'] == 'logout') {
    unset($_SESSION['username']);
    echo "<script>location.href='session_test.php';<script>";
}

?>



