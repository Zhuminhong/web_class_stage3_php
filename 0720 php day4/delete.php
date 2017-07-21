<?php
/**
 *作者:
 *邮箱:
 *创建日期:
 */
require 'function.php';
$pdo = _mysql(array())[0];
/* ----------------------------------------------- */
if ($_GET['id']) {
    
    $sql = "delete from member_table1 where id=" . $_GET['id'];
    $result = $pdo->exec($sql);
    
    if ($result) {
        header("location:homepage.php");
    } else {
        echo "<script>alert('删除失败');location.href='homepage.php'</script>";
    }
} else {
    
    // 防止用户直接访问本页面
    header("location:homepage.php");
}

?>