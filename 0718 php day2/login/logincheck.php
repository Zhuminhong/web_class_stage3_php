<?php
session_start();
if ($_POST['send']) {
    
    $user = $_POST["username"];
    $psw = $_POST["password"];
    $code = $_POST['code'];
    if ($user == "" || $psw == "") {
        echo "<script>alert('请输入用户名或密码！'); location.href='login.php';</script>";
    } else {
        if ($code == "") {
            echo "<script>alert('请输入验证码！');history.go(-1);</script>";
        } else {
            if (strtolower($code == strtolower($_SESSION['captcha']))) {
                mysql_connect("localhost", "root", "");
                mysql_select_db("userdb");
                mysql_query("set names 'gdk'");
                $sql = "select username,userpwd from user where username = '$user' and userpwd = '$psw'";
                $result = mysql_query($sql);
                $num = mysql_num_rows($result);
                if ($num) {
                    
                    $_SESSION['username'] = $user;
                    echo "<script>alert('登陆成功！');location.href='gerenzhongxin.php';</script>";
                } else {
                    echo "<script>alert('用户名或密码不正确！');location.href='login.php';</script>";
                }
            } else {
                echo "<script>alert('验证码不正确！');location.href='login.php';</script>";
            }
        }
    }
    
    $user = $_POST["username"];
    $psw = $_POST["password"];
    $code = $_POST['code'];
    
    if ($_POST['autologin'] == "1") {
        setcookie("username", $user, time() + 60 * 60 * 24 * 10);
        setcookie("password", $psw, time() + 60 * 60 * 24 * 10);
    } else {
        setcookie('username', '', time() - 1);
        setcookie('password', '', time() - 1);
    }
    
    echo "<a href=\"logincheck.php\">返回</a>";
} else {
    echo "<script>alert('提交未成功！'); location.href='login.php';</script>";
}

?>  