<?php
session_start();
var_dump($_SESSION);

if (strtolower($_POST['code'] == strtolower($_SESSION['captcha']))) {
    echo "ok";
} else {
    echo 'false';
}
?>