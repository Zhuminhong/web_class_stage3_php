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
    </style>
</head>
<body>
<div class="container">
<div class='col-md-4 col-sm-3' ></div>
<div class='col-md-4 col-sm-6' style="border: 1px solid #f1f1f1">
    <div class="header">
        <h4 class="title" id="myModalLabel">用户注册</h4>
    </div>
    <form action="regcheck.php" method="post" name="myform" id="form">
        <div class="form-group has-feedback">
            <label>用户名</label>
            <input type="text" name="username" class="form-control" placeholder="用户名">
            <span></span>
        </div>
        <div class="form-group has-feedback">
            <label>用户密码</label>
            <input id="pwd1" type="password" name="userpwd" class="form-control" placeholder="请输入用户密码">
            <span></span>
        </div>
        <div class="form-group has-feedback">
            <label>确认用户密码</label>
            <input type="password" name="confirm" class="form-control" placeholder="请确认输入用户密码">
            <span></span>
        </div>
		
        <div class="clearfix" style="margin-bottom:10px"></div>
        <div class="form-group has-feedback col-xs-4" style="padding: 0">
            <input name="send" type="submit" class=" inline-block btn btn-default" value="注册" style="margin=0;text-align:center";>
            <span><a class="inline-block btn btn-default" href="login.php">登陆</a></span>
        </div>
    </form>
    </div>
<div class='col-md-4 col-sm-3'></div>
</div>
</body>
<script src="/script/jquery-3.2.1.min.js"></script>
<script src="/script/bootstrap.min.js"></script>
<script src="/script/jquery.validate.js"></script>
<script>

    //表单验证
    formCheck("form");
    function formCheck(obj1, obj2) {
        var form1 = $("#" + obj1 + "").validate({
            errorLabelContainer: "ol.error-box",
            wrapper: "li",
            errorClass: "control-label",
            rules: {
                username: {
                    required: true,
                    minlength: 1,
                    maxlength: 16,
                    //validate expand
                },
                userpwd: {
                    required: true,
                    minlength: 1,
                    maxlength: 8
                },
                confirm: {
                    required: true,
                    equalTo: "#pwd1"
                }

            },
            messages: {
                username: {
                    required: "支持中文、字母、数字的组合，8-12个字符",
                    minlength: "账号长度不足1个字符",
                    maxlength: "账号长度超过16个字符",
                },
                userpwd: {
                    required: "建议使用字符、数字、符号两种以上的组合，8-12个字符",
                    minlength: "密码长度不足1个字符",
                    maxlength: "密码长度超过82个字符"
                },
                confirm: {
                    required: "请和密码一致",
                    equalTo: "两次密码输入不一致"
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