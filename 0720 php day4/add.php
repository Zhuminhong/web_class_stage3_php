<?php
/**
 *作者:
 *邮箱:
 *创建日期:
 */
require 'function.php';
$pdo = _mysql(array())[0];
/* ----------------------------------------------- */
//
// var_dump($_POST);

if ($_POST['send']) {
    
    /* ------------------验证是否重复----------------- */
    $searchSql = "select *
    from member_table1
    where username='" . $_POST['username'] . "'";
    $searchResult = $pdo->query($searchSql);
    $oneUser = $searchResult->fetchAll(PDO::FETCH_OBJ);
    // var_dump($oneUser[0]);
    // exit();
    if ($oneUser[0]) {
        echo "<script>alert('用户名已存在');history.go(-1);</script>";
        return false;
    }
    $sql = "insert into member_table1(
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
          location.href='homepage.php';
         </script>";
    } else {
        echo "fail";
    }
}

echo "<hr>";
?>
<style>
.reg{
	border:1px solid #ddd;
	position:absolute;
	padding:15px;
	right:0;
	left:0;
	top:0;
	bottom:0;
	margin:auto;
	height:136px;
	width:205px;
	box-shadow:0 0 3px #ddd;
	
}
.reg input{
	margin-top:5px;
	width:95%;
}
</style>

<form action="" method="post" class="reg">
<input type="text" name="username"><br>
<input type="password" name="pwd"><br>
<input type="text" name="email"><br>
<input type="submit" name="send" value="submit" class="addBtn"><br>
</form>

