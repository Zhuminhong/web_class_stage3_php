<?php
session_start();
if (isset($_SESSION['username'])) {
    echo "欢迎  " . $_SESSION["username"] . "登录";
    echo "<a href='logout.php'>注销</a>";
} else {
    echo "欢迎  " . $_COOKIE["username"] . "登录";
    echo "<a href='logout.php'>注销</a>";
}
?>