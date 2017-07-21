<?php
/**
 *作者:
 *邮箱:
 *创建日期:
 */
/*
 * echo "<pre>";
 * var_dump($_GET);
 * echo "</pre>";
 */
echo "<pre>";
var_dump($_REQUEST);
echo "</pre>";

echo "<hr>";
echo "<pre>";
var_dump($_FILES); // 保存文件上传信息
echo "</pre>";

// move_uploaded_file() 函数将上传的文件移动到新位置。

/*
 * if ($_POST['send']) {
 * if (move_uploaded_file($_FILES['pic']['tmp_name'], '../css/' . $_FILES['pic']['name'])) {
 * echo "ok"; // ['必需':规定要移动的文件,'必需':规定文件的新位置+(新)文件名]
 * } else {
 * echo "failed" . $_FILES['pic']['error'];
 * }
 * }
 */

// is_uploaded_file() 函数判断指定的文件是否是通过 HTTP POST 上传的。

if ($_POST['send']) {
    if (is_uploaded_file($_FILES['pic']['tmp_name'])) {
        $orignal_name = $_FILES['pic']['name'];
        // 把文件名转换为数组
        var_dump(explode(".", "$orignal_name"));
        $arr = explode(".", "$orignal_name");
        
        // 随机数+时间日期+jpg
        $newName = rand(1, 999) . date("YmdHis") . "." . $arr[count($arr) - 1];
        
        if (move_uploaded_file($_FILES['pic']['tmp_name'], '../css/' . $newName)) {
            echo "ok";
        } else {
            echo "move failed" . $_FILES['pic']['error'];
        }
    } else {
        echo 'upload failed' . $_FILES['error'];
    }
}

?>