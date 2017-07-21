<?php
error_reporting(E_ALL ^ E_NOTICE ^ E_DEPRECATED ^ E_STRICT);
// 报错中排除notice,语法陈旧,语法不严格提示
// $userName = null;
// echo $userName;
date_default_timezone_set("PRC"); // 设置默认时区
echo date("Y-m-d H:i:s");
?>