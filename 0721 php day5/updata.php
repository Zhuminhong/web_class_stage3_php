<?php
/**
 *作者:
 *邮箱:
 *创建日期:
 *@param array();
 *@method _mysql()
 *   */
require 'function.php';
$pdo = _mysql(array())[0];
/* ----------------------------------------------- */
echo "<hr>";
if ($_GET['id']) {
    $sql = "select * from member_table1 where id=" . $_GET['id'];
    $result = $pdo->query($sql);
    $data = $result->fetchAll(PDO::FETCH_OBJ);
    // $data是数组对象
    // var_dump($data[0]);
    if ($data[0] == null) {
        echo "数据不存在";
    } else {
        
        /* -------------判断密码有无修改--------------------- */
        if ($_POST['send']) {
            if ($_POST['pwd2'] == $_POST['pwd']) {
                $pwd = $_POST['pwd'];
            } else {
                $pwd = md5($_POST['pwd']);
            }
            /* ----------------------------------------------- */
            $sql = "update member_table1
                 set   username='" . $_POST['username'] . "',
                       pwd='" . $pwd . "',
                       email='" . $_POST['email'] . "'
                 where id=" . $_GET['id'];
            
            $result = $pdo->exec($sql);
            /* ----------------------------------------------- */
            if ($result) {
                // header("location:homepage.php");
                // header("location:updata.php?id=" . $_GET['id'] . "'");
                echo "<script>alert('修改成功');location.href='homepage.php'</script>";
                // echo "<script>window.location.reload();</script>";
                echo "修改成功";
                // 没有修改
            } else if ($result == 0) {
                echo "没有修改";
            } else {
                echo "修改失败";
            }
        }
    }
} else {
    header("location:homepage.php");
}

?>


<style>
.reg {
	border: 1px solid #ddd;
	position: absolute;
	padding: 15px;
	right: 0;
	left: 0;
	top: 0;
	bottom: 0;
	margin: auto;
	height: 136px;
	width: 205px;
	box-shadow: 0 0 3px #ddd;
}

.reg input {
	margin-top: 5px;
	width: 95%;
}
</style>

<form action="" method="post" class="reg">
<input type="hidden" name="pwd2" value=<?php
echo $data[0]->pwd?>>
	<input type="text" name="username"
		value=<?php
echo $data[0]->username?>><br> 
	<input type="password" name="pwd"
		value=<?php
echo $data[0]->pwd?>><br> 
	<input type="text" name="email"
		value=<?php
echo $data[0]->email?>><br> 
	<input type="submit" name="send"
		value="submit"><br>
</form>