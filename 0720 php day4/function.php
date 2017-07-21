<?php

/**
 *作者:
 *邮箱:
 *创建日期:
 *@param array();
 *@method _mysql()
 *   */
session_start();
date_default_timezone_set("PRC");
error_reporting(E_ALL ^ E_NOTICE);

// 创建数据库
function _mysql($array = array())
{
    extract($array);
    if (! isset($servername))
        $servername = "localhost";
    if (! isset($dbname))
        $dbname = "member";
    if (! isset($username))
        $username = "root";
    if (! isset($password))
        $password = "";
    if (! isset($table))
        $table = "member_table1";
    if (! isset($_boolen))
        $_boolen = "true";
    
    try {
        $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        echo "数据库连接成功";
    } catch (PDOException $e) {
        // $e=new PDOException;
        echo "数据库连接失败," . $e->getMessage();
    }
    
    // 设置字符集
    $pdo->query("set names utf8");
    
    // 获取表格数据
    if ($_boolen) {
        $sql = "select * from " . $table . " order by id asc";
        // 返回结果集
        $result = $pdo->query($sql);
    }
    
    // 数组
    // var_dump($result->fetchAll());
    
    // 对象
    $data = $result->fetchAll(PDO::FETCH_OBJ);
    return array(
        $pdo,
        $data
    );
}

// 创建表格
function _mytable($data)
{
    echo "<table border='1' align='center' width=95% cellpadding=0 cellspacing=0>";
    echo "<tr><th>用户名</th><th>邮箱</th><th>时间</th><th>操作</th></tr>";
    foreach ($data as $key => $value) {
        echo "<tr>";
        echo "<td>" . $value->username . "</td>";
        echo "<td>" . $value->email . "</td>";
        echo "<td>" . $value->regTime . "</td>";
        echo "<td>";
        echo "<a href='updata.php?id=" . $value->id . "'>修改</a>&nbsp;&nbsp;&nbsp;";
        echo "<a href='delete.php?id=" . $value->id . "'>删除</a>";
        echo "</td>";
        echo "</tr>";
    }
    echo "<tr><td colspan='4'><a href='add.php'>添加数据</a></td></tr>";
    echo "</table >";
}
?>