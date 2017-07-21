<?php
/**
 *作者:
 *邮箱:
 *创建日期:
 */
error_reporting(E_ALL ^ E_NOTICE);

session_start();
if ($_POST['send']) {
    echo "欢迎" . $_SESSION["username"] . "登录";
    echo ",<a href='aaa.php' target='_blank'>会员中心</a>";
    echo ",<a href='session_test.php?action=logout'>注销</a>";
} else {
    echo '未登录';
}

if ($_GET['action'] == 'logout') {
    unset($_SESSION['username']);
}

if ($_POST['send']) {
    $_SESSION[username] = $_POST['username'];
    echo "<script>location.href='session_test.php';<script>";
}

?>

<form action="session_test.php" method="post">
	<input type="text" name="username"><br> 
	<input type="submit" name="send" value="submit"><br>
</form>

