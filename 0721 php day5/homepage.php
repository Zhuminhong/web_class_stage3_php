<?php
/**
 *作者:孔老师
 *邮箱:
 *创建日期:
 */
require 'function.php';
$data = _mysql(array())[1];
$pdo = _mysql(array())[0];
$data2 = _page($pdo);
_mytable($data2);
?>


<style>
.page{
	border:1px solid green;
}
.page ul{
	text-align:center;
}
.page ul li{
	display:inline-block;
	margin-left:5px;
}
</style>

<script>
var changePage = document.querySelector(".changePage");
console.log(changePage);
changePage.addEventListener("keyup",function(){
	location.href="homepage.php?page="+this.value;
});


</script>