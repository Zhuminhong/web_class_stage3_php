<?php
/**
 *作者:
 *邮箱:
 *创建日期:
 */
if (isset($_POST['username'])) {
    echo "正常提交";
    $username = $_POST['username'];
    // $username = htmlspecialchars($username); // 解析变成普通文本
    echo $username;
}
if ($_POST['send']) {
    echo "<pre>";
    var_dump($_POST);
    echo "</pre>";
} else {
    echo "未点击提交按钮";
}

if (is_numeric($_POST['pwd'])) {
    echo "不要纯数字";
}

if (preg_match('/([\w\.]{2,255})@([\w\-]{1,255}).([a-z]{2,4})/', $_POST['email'])) {
    echo '电子邮件合法';
} else {
    echo '电子邮件不合法';
}
?>