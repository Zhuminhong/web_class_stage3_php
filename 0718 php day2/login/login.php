<?php
if (isset($_COOKIE['username'])) {
    echo "<script>location.href='gerenzhongxin.php';</script>";
}
?>


<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title></title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="/css/bootstrap.min.new.css"/>
    <style>
        .container{
            margin-top: 30px;
            padding: 10px;
        }
        .header{
        	padding: 15px;
            border-bottom: 1px solid #282828;
        }
        .title{
        	line-height: 1.42857143;
        }
        input[type=submit]{
        	margin=0;
        	text-align:center";
        }
        .captcha{
        	cursor:pointer;
        }
    </style>
</head>
<body>
<div class="container">
<div class='col-md-4 col-sm-3' ></div>
<div class='col-md-4 col-sm-6' style="border: 1px solid #f1f1f1">
    <div class="header ">
        <h4 class="title" id="myModalLabel">用户登陆</h4>
    </div>
    <form action="logincheck.php" method="post" name="myform">
        <div class="form-group has-feedback">
            <label>用户名</label>
            <input type="text" name="username" class="form-control" placeholder="用户名">
            <span></span>
        </div>
        <div class="form-group has-feedback">
            <label>用户密码</label>
            <input type="password" name="password" class="form-control" placeholder="请输入用户密码">
            <span></span>
        </div>
        <div class="form-group has-feedback">
			<div class="col-xs-4" style="padding: 0;margin-right:10px">
            	<label>验证码</label>
            	<input type="text" name="code" class="form-control" placeholder="验证码">
        	</div >
        	<div class="col-xs-7" style="height:38px;padding: 0;margin-top:27px;">
        		<img src="./captcha.php" class="captcha" style="border-radius:5px;">
        		<a  class="refresh">点击刷新</a>
        	</div>
        </div>
        <div class="clearfix"></div>
        <div class="checkbox" >
    		<label>
      		<input type="checkbox" name="autologin" value="1"> 10天内自动登陆
    		</label>
  		</div>
        <div class="form-group has-feedback col-xs-12" style="padding: 0;margin-top:10px">
            <input name="send" type="submit" class=" inline-block btn btn-default" value="登陆" >
            <span><a class="inline-block btn btn-default" href="register.php">注册</a></span>
        </div>
    </form>
</div>
<div class='col-md-4 col-sm-3'></div>
</body>
<script src="/script/jquery-3.2.1.min.js"></script>
<script src="/script/bootstrap.min.js"></script>

<script>

$(".captcha").click(function(){

	this.src='./captcha.php?tm='+Math.random();
})

$(".refresh").click(function(){

	$(".captcha").attr("src","./captcha.php?tm="+Math.random()+"");
})


</script>
</html>