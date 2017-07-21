<?php
require 'function.php';

$dbname = "member";
$table = "member_table1";

$pdo = _mysql(array(
    'table' => $table,
    'dbname' => $dbname
))[0];
?>

<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/bootstrap.min.new.css"/>
    <link rel="stylesheet" href="css/back_end_HP.css"/>
    <style>
        .table > thead > tr > th, .table > tbody > tr > th, .table > tfoot > tr > th, .table > thead > tr > td, .table > tbody > tr > td {
            border-top: none;
            vertical-align: middle;

        }

    </style>
</head>
<body>
<!--导航-->
<nav class="navbar navbar-default">
    <div class="container">
        <div class="navbar-header">
            <button class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a href="" class="navbar-brand">Maizi Admin</a>
        </div>

        <!--导航内容-->
        <div class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
                <li><a href="back_end_HP.html"><span class="glyphicon glyphicon-home"></span>&nbsp;&nbsp;后台首页</a>
                </li>
                <li class="active"><a href="back_end_UserManagement.html"><span class="glyphicon glyphicon-user"></span>&nbsp;&nbsp;用户管理</a>
                </li>
                <li><a href="back_end_ContentManagement.html"><span class="glyphicon glyphicon-list-alt"></span>&nbsp;&nbsp;内容管理</a>
                </li>
                <li><a href="back_end_TagManagement.html"><span class="glyphicon glyphicon-tags"></span>&nbsp;&nbsp;标签管理</a>
                </li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li class="dropdown">
                    <a id="dLabel" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        admin
                        <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="dLabel">
                        <li><a href=""><span class="glyphicon glyphicon-screenshot"></span>&nbsp;&nbsp;前台首页</a></li>
                        <li><a href=""><span class="glyphicon glyphicon-user"></span>&nbsp;&nbsp;个人主页</a></li>
                        <li><a href=""><span class="glyphicon glyphicon-cog"></span>&nbsp;&nbsp;个人设置</a></li>
                        <li><a href=""><span class="glyphicon glyphicon-credit-card"></span>&nbsp;&nbsp;账户中心</a></li>
                        <li><a href=""><span class="glyphicon glyphicon-heart"></span>&nbsp;&nbsp;我的收藏</a></li>
                    </ul>
                </li>
                <li><a href="#bbs"><span class="glyphicon glyphicon-off"></span>&nbsp;&nbsp;退出</a></li>
            </ul>
        </div>
    </div>
</nav>

<!--主要内容-->
<div class="container">
    <div class="row">
        <div class="col-md-2">
            <div class="list-group">
                <a href="back_end_UserManagement.html" class="list-group-item active">用户管理</a>
                <a href="" role="button" class="list-group-item" data-toggle="modal" data-target="#myModal">添加用户</a>
            </div>
        </div>
        <div class="col-md-10">
            <div class="page-header">
                <h1>用户管理</h1>
            </div>
            <table class="table">
                <thead>
                <tr>
                    <th>用户名</th>
                    <th>邮箱</th>
                    <th>创建时间</th>
                    <th>操作</th>
                </tr>
                </thead>
                <tbody id="Mytbody">
               
                <?php
                $data = _mysql(array())[1];
                _mytable($data);
                
                if ($_GET['id']) {
                    
                    $sql = "delete from " . $table . " where id=" . $_GET['id'];
                    $result = $pdo->exec($sql);
                    
                    if ($result) {
                        echo "<script>alert('删除成功');window.history.go(-1);</script>";
                    } else {
                        echo "<script>alert('删除失败');window.history.go(-1);</script>";
                    }
                }
                
                ?>
                
                </tbody>
            </table>
            <form action="" id="pagecountgroup" class="form-group pull-left" style="padding: 20px 0;margin: 0px">
            </form>
            <nav class="mypull-right pull-right">
            </nav>
        </div>
    </div>
</div>
<!-- Modal -->

<?php
// _updata($pdo);
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

?>

<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" id="modalDialog" role="document">
        <div class="modal-content" style="height:auto">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">添加用户</h4>
            </div>
            <div class="modal-body">
                <form action="" method="post" name="myform" id="form">
        			<div class="form-group has-feedback">
            			<label>用户名</label>
            			<input type="text" name="username" class="form-control" placeholder="用户名">
            			<span></span>
        			</div>
        		<div class="form-group has-feedback">
            		<label>用户密码</label>
            		<input id="pwd1" type="password" name="pwd" class="form-control" placeholder="请输入用户密码">
            		<span></span>
        		</div>
        		<div class="form-group has-feedback">
            		<label>确认用户密码</label>
            		<input type="password" name="confirm" class="form-control" placeholder="请确认输入用户密码">
            		<span></span>
        		</div>
				<div class="form-group has-feedback">
            		<label>邮箱</label>
            		<input type="text" name="email" class="form-control" placeholder="邮箱地址">
            		<span></span>
        		</div>
        		<div class="form-group has-feedback" style="padding: 0">
            		<input name="send" type="submit" class=" inline-block btn btn-default" value="注册" style="margin=0;text-align:center";>
        		</div>
    			</form>
            </div>
        </div>
    </div>
</div>
<!--Modal_update-->
<?php

if ($_COOKIE['id']) {
    $sql = "select * from " . $table . " where id=" . $_COOKIE['id'];
    $result = $pdo->query($sql);
    $data_2 = $result->fetchAll(PDO::FETCH_OBJ);
    // $data是数组对象
    // var_dump($data[0]);
    if ($data_2[0] == null) {
        echo "";
    } else {
        /* -------------判断密码有无修改--------------------- */
        if ($_POST['send2']) {
            if ($_POST['pwd2'] == $_POST['pwd']) {
                $pwd = $_POST['pwd'];
            } else {
                $pwd = md5($_POST['pwd']);
            }
            /* ----------------------------------------------- */
            $sql = "update " . $table . "
                 set   username='" . $_POST['username'] . "',
                       pwd='" . $pwd . "',
                       email='" . $_POST['email'] . "'
                 where id=" . $_COOKIE['id'];
            
            $result = $pdo->exec($sql);
            /* ----------------------------------------------- */
            if ($result) {
                // header("location:homepage.php");
                // header("location:updata.php?id=" . $_GET['id'] . "'");
                echo "<script>alert('修改成功');window.history.go(-1);</script>";
                // echo "<script>window.location.reload();</script>";
                // 没有修改
            } else if ($result == 0) {
                echo "<script>alert('没有修改');window.history.go(-1);</script>";
            } else {
                echo "<script>alert('修改失败');window.history.go(-1);</script>";
            }
        }
    }
} else {
    header("location:back_end_UserManagement.php");
}

?>
<div class="modal fade" id="updata" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">编辑</h4>
            </div>
            <div class="modal-body">
                <form action="" method="post" name="myform" id="form2">
                <input type="hidden" name="username2" >
        			<div class="form-group has-feedback">
            			<label>用户名</label>
            			<input type="text" name="username" class="form-control" placeholder="用户名" value=<?php
            echo $data_2[0]->username?>>
            			<span></span>
        			</div>
        		<div class="form-group has-feedback">
            		<label>用户密码</label>
            		<input id="pwd2" type="password" name="pwd" class="form-control" placeholder="请输入用户密码">
            		<span></span>
        		</div>
        		<div class="form-group has-feedback">
            		<label>确认用户密码</label>
            		<input type="password" name="confirm" class="form-control" placeholder="请确认输入用户密码">
            		<span></span>
        		</div>
				<div class="form-group has-feedback">
            		<label>邮箱</label>
            		<input type="text" name="email" class="form-control" placeholder="邮箱地址">
            		<span></span>
        		</div>
        		<div class="form-group has-feedback" style="padding: 0">
            		<input name="send2" type="submit" class=" inline-block btn btn-default" value="修改" style="margin=0;text-align:center";>
        		</div>
    			</form>
            </div>

        </div>
    </div>
</div>
<!--footer-->
<footer>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <p>
                    Copyright&nbsp;©&nbsp;2012-2015&nbsp;&nbsp;www.maiziedu.com&nbsp;&nbsp;蜀ICP备13014270号-4
                </p>
            </div>
        </div>
    </div>
</footer>
</body>
<script src="js/jquery-3.2.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/jquery.validate.js"></script>
<!-- <script src="js/back_end_Registion2.js"></script> -->
<script src="js/validate.expand.js"></script>
<script src="js/jquery-ui.min.js"></script>
<script>


	/* ----------------模态对话框添加拖拽 -------------------*/
    $(".modal-dialog").draggable();
    $("#myModal").css("overflow", "hidden");



    /* ----------------自动添加当前用户名、邮箱值 至 修改框 -------------------*/
	$(".myUpdate").click(function(){
		var id = $(this).attr("name");
		document.cookie="id="+id;
		var form2 =$("#form2");
		var username = $("tr[class='" + id + "']").children().eq(0).text()
		var email = $("tr[class='" + id + "']").children().eq(1).text()
		form2.find("input[name=username2]").val(username);
		form2.find("input[name=username]").val(username);
        form2.find("input[name=email]").val(email);
	})

	
	
	/* ----------------验证表单 -------------------*/
    formCheck("form","pwd1");
    formCheck("form2","pwd2");
    
    function formCheck(obj1, password) {
        var form1 = $("#" + obj1 + "").validate({
            errorLabelContainer: "ol.error-box",
            wrapper: "li",
            errorClass: "control-label",
            rules: {
                username: {
                    required: true,
                    minlength: 3,
                    maxlength: 10,
                    //用户名重复验证
                    noRepeat: true
                },
                pwd: {
                    required: true,
                    minlength: 3,
                    maxlength: 6
                },
                confirm: {
                    required: true,
                    equalTo: "#"+password+""
                },
                email: {
                    required: true,
                    email: true
                }

            },
            messages: {
                username: {
                    required: "支持中文、字母、数字的组合，8-12个字符",
                    minlength: "账号长度不足3个字符",
                    maxlength: "账号长度超过10个字符",
                    noRepeat: "该账户已存在"
                },
                pwd: {
                    required: "建议使用字符、数字、符号两种以上的组合，8-12个字符",
                    minlength: "密码长度不足3个字符",
                    maxlength: "密码长度超过6个字符"
                },
                confirm: {
                    required: "请和密码一致",
                    equalTo: "两次密码输入不一致"
                },
                email: {
                    required: "请输入合法邮箱",
                    email: "非正确格式"
                }

            },
            highlight: function (element) {
                $(element).parent().removeClass("has-success")
                $(element).parent().find("span").removeClass("glyphicon glyphicon-ok form-control-feedback")
                $(element).parent().addClass("has-error")
                $(element).parent().find("span").addClass("glyphicon glyphicon-remove form-control-feedback")
            },
            unhighlight: function (element) {
                $(element).parent().removeClass("has-error")
                $(element).parent().find("span").removeClass("glyphicon glyphicon-remove form-control-feedback")
                $(element).parent().addClass("has-success")
                $(element).parent().find("span").addClass("glyphicon glyphicon-ok form-control-feedback")
            },
           
        });
    }
</script>

</html>