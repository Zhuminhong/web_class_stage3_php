<?php
/**
 *作者:
 *邮箱:
 *创建日期:
 */

// 关联数组
$member = array(
    "username1" => 'tom',
    "username2" => "marry",
    "username3" => "peter"
);

echo "<pre>";
var_dump($member);
echo "</pre>";

echo "<hr>";

// 索引数组
$vip = array(
    "tom",
    "peter",
    "marry"
);
echo "<pre>";
var_dump($vip);
echo "</pre>";

echo "<hr>";
// 遍历数组(索引数组)
for ($i = 0; $i < count($vip); $i ++) { // 可以循环索引,不能循环关联
    echo $vip[$i];
}

echo "<hr>";
// 遍历数组(关联数组)
foreach ($ages as $key => $value) { // 可以循环关联,也可以循环索引
    echo $key . "=>" . $value . "<br>";
}

foreach ($member as $key => $value) {
    echo $value . "<br>";
}

foreach ($vip as $key => $value) {
    echo $key . "<br>";
}

echo "<hr>";
$member2 = array(
    "username" => "grace",
    "level" => "VIP"
);
/*
 * unset($member2['username']); // 删除数组中的某个元素
 * echo "<pre>";
 * var_dump($member2);
 * echo "</pre>";
 */

echo "<hr>";
echo implode("@", $member2); // 用@拼接数组元素,js:join();
echo gettype(implode("@", $member2)); // 元素类型

echo "<hr>";
$str = "tom,perter,marry";
echo "<pre>";
var_dump(explode(",", $str)); // 分隔符 ,js:split()
echo "</pre>";

echo "<hr>";

$ages["吴祁"] = 19;
$ages["李炎恢"] = 27;
$ages["胡心鹏"] = 23;

while (! ! $element = each($ages)) {
    echo $element["key"];
    echo "=>";
    echo $element["value"];
    echo "<br />";
}

?>