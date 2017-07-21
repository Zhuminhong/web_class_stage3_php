/**
 * Created by Administrator on 2017/7/12.
 */
/*预处理*/
$(function () {

    var container = "Mytbody";
    var container2 = "";
    formCheck("form", "form2");


    var dataBase = openDatabase('userinfo', '1.0', 'Test DB', 2 * 1024 * 1024);
    var resultArray = [];
    var mytable = "user_info";
    dataBase_query();

//表单验证
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
                    noRepeat: true
                },
                psd: {
                    required: true,
                    minlength: 1,
                    maxlength: 8
                },
                rpsd: {
                    required: true,
                    equalTo: "#pwd1"
                },
                email: {
                    required: true,
                    email: true
                }
            },
            messages: {
                username: {
                    required: "支持中文、字母、数字的组合，8-12个字符",
                    minlength: "账号长度不足1个字符",
                    maxlength: "账号长度超过16个字符",
                    noRepeat: "该账户已存在"
                },
                psd: {
                    required: "建议使用字符、数字、符号两种以上的组合，8-12个字符",
                    minlength: "密码长度不足1个字符",
                    maxlength: "密码长度超过82个字符"
                },
                rpsd: {
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
            submitHandler: function (form) {
                if (confirm("你确定要注册吗?")) {
                    alert("注册成功")

                    var username = form.elements[0].value;
                    var psd = form.elements[1].value;
                    var email = form.elements[3].value;
                    var level = $("#addyonghuzu option:selected").text();
                    if (sessionStorage.clickcount)
                    {
                        sessionStorage.clickcount=Number(sessionStorage.clickcount)+1;
                    }
                    else
                    {
                        sessionStorage.clickcount=1;
                    }

                    /*数据库启动*/


                    mydatabase_start(sessionStorage.clickcount, username, psd, email, level)
                    dataBase_query(page)
                    $("form1").modal('hide');

                    //window.location.reload()
                } else {
                    return false;
                }
            }
        });
        var form2 = $("#" + obj2 + "").validate({
            errorLabelContainer: "ol.error-box",
            wrapper: "li",
            errorClass: "control-label",
            rules: {
                psd: {
                    required: true,
                    minlength: 1,
                    maxlength: 2
                },
                rpsd: {
                    required: true,
                    equalTo: "#pwd2"
                },
                email: {
                    required: true,
                    email: true
                }
            },
            messages: {
                psd: {
                    required: "建议使用字符、数字、符号两种以上的组合，8-12个字符",
                    minlength: "密码长度不足8个字符",
                    maxlength: "密码长度超过12个字符"
                },
                rpsd: {
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
            submitHandler: function (form) {

                var psd = $("#pwd2").val();
                var email = $("#emailname").val();
                var level = $("#addyonghuzu2 option:selected").text();

                var id = parseInt($("#updataconfirm").attr("name"))
                updataconfirm(id, psd, email, level)
            }
        });
    }

//数据库相关

    function mydatabase_start(key, id1, id2, id3, id4) {


        database_insert(key, id1, id2, id3, id4);

        dataBase_query()

    }

    //创建表格+插入数据
    function database_insert(key, id1, id2, id3, id4) {

        var mykey = key ? key : localStorage.clickcount;
        var myid1 = id1 ? id1 : "";
        var myid2 = id2 ? id2 : "";
        var myid3 = id3 ? id3 : "";
        var myid4 = id4 ? id4 : "";

        dataBase.transaction(function (tx) {
            tx.executeSql("create table if not exists " + mytable + "(id REAL UNIQUE,username TEXT,psd TEXT,email TEXT,level TEXT)")
            tx.executeSql("insert into " + mytable + "(id,username,psd,email,level) values (?,?,?,?,?)", [mykey, myid1, myid2, myid3, myid4],
                function(){

                },
                function(tx,err){
                    alert(err.message)
                }
            )
        })
    }

    //导出数据至页面
    function dataBase_query(page) {
         dataBase.transaction(function (tx) {
             tx.executeSql(
                "select * from " + mytable + "",
                [],
                function (tx, result) {
                    $("#Mytbody").empty();
                    $("#pagecountgroup").empty()
                    $(".mypull-right").empty()
                    $("#" + container + "").empty();
                    for (var i = 0; i < result.rows.length; i++) {
                        var id = result.rows.item(i)['id'];
                        var name = result.rows.item(i)['username'];
                        var Email = result.rows.item(i)['email'];
                        var dataItem = [];

                        resultArray[i] = {};
                        resultArray[i].id = i + 1;
                        resultArray[i].Mail = Email;
                        resultArray[i].name = name;


                        dataItem[i] = $("<tr>" +
                            "<th scope='row'>" + (i + 1) + "</th>" +
                            "<td name='" + name + "'>" + name + "</td>" +
                            "<td>" + Email + "</td>" +
                            "<td>" +
                            "<div role='presentation' class='dropdown'>" +
                            "<button class='btn btn-default dropdown-toggle' data-toggle='dropdown' href='#' role='button' aria-haspopup='true' aria-expanded='false'>" +
                            "操作<span class='caret'></span>" +
                            "</button>" +
                            "<ul class='dropdown-menu'>" +
                            "<li><a class='" + id + " ' href='#' data-toggle='modal' data-target='#updata'>编辑</a></li>" +
                            "<li ><a name='" + id + "' href='#'>删除</a></li>" +
                            "<li><a href='#'>锁定</a></li>" +
                            "<li><a href='#'>修改密码</a></li>" +
                            "</ul>" +
                            "</div>" +
                            "</td>" +
                            "</tr>")

                        $("#" + container + "").append(dataItem[i]);
                        //编辑
                        $("." + id + "").bind("click", function () {
                            $("#updataconfirm").attr("name", $(this).attr("class"))
                            $("#updata").modal();
                            return false
                        })
                        //删除
                        $("a[name='" + id + "']").bind("click", function () {
                            del($(this).attr("name"))
                            return false;
                        })

                    }

                    page_js(resultArray, page);//分页
                })
        })
    }

    //删除一条数据
    function del(id) {
        dataBase.transaction(function (tx) {
            tx.executeSql(
                "delete from " + mytable + " where id=?",
                [id],
                function () {
                },
                function (tx, err) {
                    alert("删除失败" + err.message)
                }
            )
        })
        $("#" + container + "").empty();
        dataBase_query();
        $(".mypull-right").empty()
        window.location.reload()

    }

    //更新数据
    function updataconfirm(id, psd, email, level) {

        dataBase.transaction(function (tx) {
            tx.executeSql(
                "UPDATE " + mytable + " SET psd=?, email=?, level=? " +
                "WHERE id=?",
                [psd, email, level, id],
                function () {
                    $(".mypull-right").empty();
                    window.location.reload()
                },
                function (tx, err) {
                    alert("更新失败")
                }
            )
        })
    }

//分页相关
    function page_js(data, page) {
    //初始化

        //初始化页码
        var nowPage = 1;
        var pageSize = page ? page : 2;
        var len = data.length;

        //初始化页数功能
        $("#pagecountgroup").append($("<select class='form-control' id='pagecount'><option>请选择</option></option></select>"))

        $("#pagecount").change(function () {
            var page1 = $("#pagecount option:selected").text();
            $("#pagecountgroup").empty();
            $(".mypull-right").empty()
            dataBase_query(page1);
        })

        var pageItem = [];
        for (var i = 0; i < len; i++) {
            pageItem[i] = $("<option>" + (i + 1) + "</option>")
            $("#pagecount").append(pageItem[i]);
        }
        var pageCount = Math.ceil(len / pageSize);
        //初始tr边框高度

       /* var tr_height = $("#Mytbody").find("tr").height();
        var thead_height = $(".table").find("thead").height();
        $(".table").height(tr_height * pageSize + thead_height);*/

        //初始添加左右箭头
        var pagechangeMark = $("<ul class='pagination' id='pagination2'>" +
            "<li id='previous'><a href='#'><span aria-hidden='true'>&laquo;</span></a></li>" +
            "<li id='next'><a href='#'><span aria-hidden='true'>&raquo;</span></a></li>" +
            "</ul>")
        $(".mypull-right").append(pagechangeMark);

        //左右箭头样式设置
        $("#previous").mouseup(function () {
            $("#previous").css("background", "#222222")
        })
        $("#previous").mousedown(function () {
            $("#previous").css("background", "#2a9fd6")
        })

        $("#next").mouseup(function () {
            $("#next").css("background", "#222222")
        })
        $("#next").mousedown(function () {
            $("#next").css("background", "#2a9fd6")
        })


        if (pageCount == 1) {
            $("#previous").addClass("disabled");
            $("#next").addClass("disabled");
        }
        //初始化
        var pageCount = Math.ceil(data.length / pageSize);
        $("#previous").addClass("disabled");
        pagechange(nowPage);
        //初始化后
        for (var i = 1; i <= pageCount; i++) {
            //添加页码
            var page = $("<li class='pagenumber' name='" + i + "'><a href='#'>" + i + "</a></li>")
            $("#next").before(page);
            $("li[name='" + nowPage + "']").addClass("active");

            //给每页附函数
            $("li[name='" + i + "']").bind("click", function () {
                nowPage = $(this).attr("name");
                $("li[name='" + nowPage + "']").siblings().removeClass("active");
                if (nowPage == 1) {
                    $("#previous").addClass("disabled")
                    $("#next").removeClass("disabled")
                } else if (nowPage == pageCount) {
                    $("#next").addClass("disabled")
                    $("#previous").removeClass("disabled")
                } else {
                    $("#next").removeClass("disabled")
                    $("#previous").removeClass("disabled")
                }
                pagechange(nowPage); //当前页
                return false

            })
        }


        $("#previous").click(function () {
            if (nowPage > 1) {
                nowPage--;
                mypreviou(nowPage)
            }
            return false;
        })
        $("#next").click(function () {
            if (nowPage < pageCount) {
                nowPage++;
                myNext(nowPage)
            }
            return false;
        })

        function pagechange(nowPage) {

            if (pageSize == 1) {
                $("#Mytbody tr:eq(" + (nowPage - 1) + ")").stop().fadeIn();
                $("#Mytbody tr:eq(" + (nowPage - 1) + ")").siblings().hide();
            } else {

                var startIndex = (nowPage - 1) * pageSize + 1;//每页开始序号
                var endIndex = nowPage * pageSize; //每页结束序号

                if (endIndex > data.length) { //数据无法全部塞满时
                    endIndex = data.length;
                }
                if (data.length < pageSize) { //一页可容纳所有数据时
                    endIndex = data.length;
                }
                if (startIndex == endIndex) { //
                    $("#Mytbody tr:eq(" + (startIndex - 1) + ")").stop().fadeIn();
                    $("#Mytbody tr:lt(" + (startIndex - 1) + ")").hide();
                } else {
                    $("#Mytbody tr:gt(" + (startIndex - 1) + ")").stop().fadeIn();
                    $("#Mytbody tr:lt(" + (endIndex - 1) + ")").stop().fadeIn();//每页显示全部数据

                    $("#Mytbody tr:lt(" + (startIndex - 1) + ")").hide();//每页开始序号之前的数据隐藏
                    $("#Mytbody tr:gt(" + (endIndex - 1) + ")").hide();//每页结束序号之后的数据隐藏
                }
            }

        }

        //下一页
        function myNext(nowPage) {
            if (nowPage < pageCount) {
                $("#next").removeClass("disabled");
                $("li[name='" + nowPage + "']").addClass("active");
                $("li[name='" + nowPage + "']").siblings().removeClass("active");

                pagechange(nowPage)
            } else {
                //箭头变暗,移除事件
                $("li[name='" + nowPage + "']").addClass("active");
                $("li[name='" + nowPage + "']").siblings().removeClass("active");
                pagechange(nowPage)
                $("#next").addClass("disabled");
                $("#previous").removeClass("disabled");
            }
        }

        //上一页
        function mypreviou(nowPage) {
            if (nowPage > 1) {
                $("#previous").removeClass("disabled");
                $("#next").removeClass("disabled");
                $("li[name='" + nowPage + "']").addClass("active");
                $("li[name='" + nowPage + "']").siblings().removeClass("active");
                pagechange(nowPage)
            } else {
                $("li[name='" + nowPage + "']").addClass("active");
                $("li[name='" + nowPage + "']").siblings().removeClass("active");
                $("#previous").addClass("disabled");
                $("#next").removeClass("disabled");
                pagechange(nowPage)
            }
        }

    }


})