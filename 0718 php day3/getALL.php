<?php
/**
 *作者:
 *邮箱:
 *创建日期:
 */
$servername = "localhost";
$username = "root";
$password = "";

try {
    $conn = new PDO("mysql:host=$servername;dbname=member", $username, $password);
    echo "连接成功";
    var_dump($conn);
} catch (PDOException $e) {
    echo $e->getMessage();
}
?>