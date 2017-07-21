<?php
/**
 *作者:
 *邮箱:
 *创建日期:
 */
// 背景图片
$image = imagecreatetruecolor(500, 500);
$bgColor = imagecolorallocate($image, 255, 255, 22);
imagefill($image, 10, 10, $bgColor);
// 点颜色
$dotColor = imagecolorallocate($image, 0, 0, 250);
// 画点
for ($i = 350; $i < 400; $i ++) {
    imagesetpixel($image, $i, $i, $dotColor);
}

// 直线颜色
$lineColor = imagecolorallocate($image, 10, 250, 20);
// 画直线
imageline($image, 120, 50, 300, 89, $lineColor);
// 字符串颜色
$strColor = imagecolorallocate($image, 255, 150, 200);
// 画字符串
// imagestring($image, 13, 50, 30, "baoguojie", $strColor);
//
imagettftext($image, 25, 40, 150, 100, $strColor, "GEORGIA.TTF", "baoguojie");
//
// 填充颜色
$rectColor = imagecolorallocate($image, 10, 250, 20);
// 画一个有填充色的四边形
imagefilledrectangle($image, 50, 50, 150, 150, $rectColor);
// 设置背景颜色

imagepng($image); // 指定目录输出图片
?>