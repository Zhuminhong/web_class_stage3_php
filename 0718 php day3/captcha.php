<?php
/**
 *作者:
 *邮箱:
 *创建日期:
 */
session_start();
$_width = 120;
$_height = 38;
$image = imagecreatetruecolor($_width, $_height);
$bgColor = imagecolorallocate($image, rand(200, 255), rand(200, 255), rand(200, 255));
imagefill($image, 0, 0, $bgColor);

$str = "0123456789abcdefghijklmnopqrestuvwxyz";
$len = strlen($str);
$num_len = 4;
$temp = null;
for ($i = 0; $i < 4; $i ++) {
    $temp .= $str[rand(0, $len - 1)];
}
$_SESSION['captcha'] = $temp;
$textcolor = imagecolorallocate($image, rand(0, 100), rand(0, 155), rand(0, 200));
// imagettftext($image, rand(10, 25), rand(- 10, 10), 10, 30, $textcolor, "GEORGIA.TTF", $temp);

/*
 * for ($i = 0; $i < 4; $i ++) {
 * imagettftext($image, mt_rand(3, 5), $i * $_width / 4 + mt_rand(1, 10), mt_rand(1, $_height / 2), $textcolor, "GEORGIA.TTF", $temp[$i]);
 * }
 */

for ($i = 0; $i < 4; $i ++) {
    imagestring($image, mt_rand(3, 5), $i * $_width / 4 + mt_rand(1, 10), mt_rand(1, $_height / 2), $temp[$i], $textcolor);
}

imagepng($image);
?>