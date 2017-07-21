
<?php
date_default_timezone_set("PRC");
date("Y-m-d H:i:s", time() + 3600 * 24 * 30);
if ($_POST['send']) {
    $user = $_POST["username"];
    $psw = $_POST["userpwd"];
    $psw_confirm = $_POST["confirm"];
    if ($user == "" || $psw == "" || $psw_confirm == "") {
        echo "<script>alert('请确认信息完整性！'); history.go(-1);</script>";
    } else {
        if ($psw == $psw_confirm) {
            mysql_connect("localhost", "root", "");
            mysql_select_db("userdb");
            mysql_query("set names 'gdk'");
            $sql = "select username from user where username = '$_POST[username]'";
            $result = mysql_query($sql);
            $num = mysql_num_rows($result);
            if ($num) {
                echo "<script>alert('用户名已存在'); history.go(-1);</script>";
            } else {
                $reIP = $_SERVER["REMOTE_ADDR"];
                $time = date("Y-m-d H:i:s", time() + 3600 * 24 * 30);
                $sql_insert = "INSERT INTO user (username,userpwd,createtime,createip) values ('$user','$psw','$time','$reIP')";
                $res_insert = mysql_query($sql_insert);
                if ($res_insert) {
                    echo "<script>alert('注册成功！'); location.href='login.php';</script>";
                } else {
                    echo mysql_error();
                }
            }
        } else {
            echo "<script>alert('密码不一致！'); history.go(-1);</script>";
        }
    }
} else {
    echo "<script>alert('提交未成功！'); history.go(-1);</script>";
}
?>  