<?php
/**
 *作者:
 *邮箱:
 *创建日期:
 */
$products = array(
    array(
        "苹果",
        2,
        1
    ),
    array(
        "猪肉",
        3,
        2
    ),
    array(
        "饼干",
        2,
        1
    )
);
echo "<pre>";
var_dump($products);
echo "</pre>";

for ($i = 0; $i < count($products); $i ++) {
    for ($j = 0; $j < count($products[$i]); $j ++) {
        echo "|" . $products[$i][$j];
    }
    echo "|<br/>";
}

$product2 = array(
    array(
        "产品" => "苹果",
        '价格' => 2,
        '数量' => 1
    ),
    array(
        "产品" => "猪肉",
        '价格' => 2,
        '数量' => 1
    ),
    array(
        "产品" => "饼干",
        '价格' => 2,
        '数量' => 1
    )

);

for ($i = 0; $i < count($product2); $i ++) {
    while (! ! list ($key, $value) = each($product2[$i])) {
        echo "|" . $value;
    }
    echo "|<br>";
}
for ($i = 0; $i < count($product2); $i ++) {
    foreach ($product2[$i] as $key => $value) {
        echo "|" . $value;
    }
    echo "|<br>";
}
?>
