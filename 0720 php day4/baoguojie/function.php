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
error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);

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

// 更新数据库
function _updata($pdo)
{
    if ($_POST['send']) {
        
        /* ------------------验证是否重复----------------- */
        $searchSql = "select *
    from " . $table . "
    where username='" . $_POST['username'] . "'";
        $searchResult = $pdo->query($searchSql);
        $oneUser = $searchResult->fetchAll(PDO::FETCH_OBJ);
        // var_dump($oneUser[0]);
        // exit();
        if ($oneUser[0]) {
            echo "<script>alert('用户名已存在');history.go(-1);</script>";
            return false;
        }
        $sql = "insert into " . $table . "(
        username,
        pwd,
        email,
        regTime
    )values(
        '" . $_POST['username'] . "',
        '" . MD5($_POST['pwd']) . "',
        '" . $_POST['email'] . "',
        '" . date('Y-m-d H:i:s') . "'
    )";
        // $pdo->query("set names utf8");
        $result = $pdo->exec($sql);
        if ($result) {
            
            echo "<script>
          alert('创建数据成功');
          location.href='back_end_UserManagement.php';
         </script>";
        } else {
            echo "fail";
        }
    }
}

// 创建表格
function _mytable($data)
{
    foreach ($data as $key => $value) {
        echo "<tr class='" . $value->id . "'>";
        echo "<td>" . $value->username . "</td>";
        echo "<td>" . $value->email . "</td>";
        echo "<td>" . $value->regTime . "</td>";
        echo "<td>";
        echo "<div role='presentation' class='dropdown'>";
        echo "<button class='btn btn-default dropdown-toggle' data-toggle='dropdown' href='#' role='button' aria-haspopup='true' aria-expanded='false'>";
        echo "操作<span class='caret'></span>";
        echo "</button>";
        echo "<ul class='dropdown-menu'>";
        echo "<li><a class='myUpdate' name='" . $value->id . "' data-toggle='modal' data-target='#updata'>编辑</a></li>";
        echo "<li><a href='back_end_UserManagement.php?id=" . $value->id . "' href='#'>删除</a></li>";
        echo "</ul>";
        echo "</div>";
        echo "</td>";
        echo "</tr>";
    }
}
?>