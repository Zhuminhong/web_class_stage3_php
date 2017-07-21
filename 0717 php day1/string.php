<?php
/**
 *作者:
 *邮箱:
 *创建日期:
 */
$username = "my name is peter"; // 引号时定界符,引号之间的是字符
$len = strlen($username);
echo $len;
echo strlen("上海"); // 166 错误长度
echo "<hr>";
echo mb_strlen("上海", "utf8"); // 多字节正常读取中文长度
echo "<hr>";
echo "welcome,$username"; // 字符串+变量
echo "<hr>";
// echo "<img src='image/timg.jpg'>";
echo "<hr>";
$num = timg;
$num = rand(1, 4); // 可以放随机数
echo "<img src='image/" . $num . ".jpg'>"; // 与js相比,"+"→"."
?>