<?php
session_start();

_code(array(
    'height' => '35'
));

function _code($array = array())
{
    // 初始参数
    extract($array);
    if (! isset($width))
        $width = 75;
    if (! isset($height))
        $height = 25;
    if (! isset($num_len))
        $num_len = 4;
    if (! isset($flag))
        $flag = false;
    
    // 创建随机码
    $str = "0123456789abcdefghijklmnopqrestuvwxyz";
    $len = strlen($str);
    $temp = null;
    for ($i = 0; $i < $num_len; $i ++) {
        $temp .= $str[rand(0, $len - 1)];
    }
    $_SESSION['captcha'] = $temp;
    // 保存在session
    
    // 创建一张图像
    $img = imagecreatetruecolor($width, $height);
    
    // 白色
    $white = imagecolorallocate($img, 255, 255, 255);
    
    // 填充
    imagefill($img, 0, 0, $white);
    
    if ($flag) {
        // 黑色,边框
        $black = imagecolorallocate($img, 0, 0, 0);
        imagerectangle($img, 0, 0, $width - 1, $height - 1, $black);
    }
    
    // 随即画出6个线条
    for ($i = 0; $i < 6; $i ++) {
        $color = imagecolorallocate($img, mt_rand(0, 255), mt_rand(0, 255), mt_rand(0, 255));
        imageline($img, mt_rand(0, $width), mt_rand(0, $height), mt_rand(0, $width), mt_rand(0, $height), $color);
    }
    
    // 随即雪花
    for ($i = 0; $i < 100; $i ++) {
        $color = imagecolorallocate($img, mt_rand(200, 255), mt_rand(200, 255), mt_rand(200, 255));
        imagestring($img, 1, mt_rand(1, $width), mt_rand(1, $height), '*', $color);
    }
    
    // 输出验证码
    for ($i = 0; $i < strlen($_SESSION['captcha']); $i ++) {
        $color = imagecolorallocate($img, mt_rand(0, 100), mt_rand(0, 150), mt_rand(0, 200));
        imagestring($img, 5, $i * $width / $num_len + mt_rand(1, 10), mt_rand(1, $height / 2), $_SESSION['captcha'][$i], $color);
    }
    
    // 输出图像
    imagepng($img);
}
?>