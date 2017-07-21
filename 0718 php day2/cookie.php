<?php
/**
 *作者:
 *邮箱:
 *创建日期:
 */
error_reporting(E_ALL ^ E_NOTICE);
// echo time();
// setcookie("username", "baoguojie", time() + 60 * 60 * 24 * 7);
// setcookie("age", "27", time() + 60 * 60 * 24 * 7);
// // 键,值,保存时间(用一次之后需要注销)
// var_dump($_COOKIE);

if ($_COOKIE['username']) {
    echo "不用登陆";
} else {
    echo "需要登陆";
}

if ($_POST['send']) {
    if ($_POST['oneweek'] == "1") {
        // echo 'ok';
        setcookie("username", 'tom', time() + 60 * 60 * 24 * 7);
    } else {
        // echo 'failed';
        setcookie("username", 'tom', time()); // 销毁cookie
        unset($_COOKIE['username']);
    }
    
    echo "<script>location.href='session_test.php';<script>";
}
?>

<form action="" method="post">
	<input id="oneweek" type="checkbox" name="oneweek" value="1">
	<label for="oneweek">一周内不用登陆</label>
	<input type="submit" name="send" value="submit">
</form>