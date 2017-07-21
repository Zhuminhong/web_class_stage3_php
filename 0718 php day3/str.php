<?php
/**
 *作者:
 *邮箱:
 *创建日期:
 */
$str = "0123456789abcdefghijklmnopqrestuvwxyz";
$len = strlen($str);
$num_len = 4;
$temp = null;
for ($i = 0; $i < 4; $i ++) {
    $temp .= $str[rand(0, $len - 1)];
}
echo $temp;

?>