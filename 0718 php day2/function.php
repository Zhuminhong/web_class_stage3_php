<?php

/**
 *作者:
 *邮箱:
 *创建日期:
 *@param $username:string
 */
// function Msg($username = "tom")
// {
// echo $username;
// }
// Msg("peter")//peter
function Msg($username, $gender, $phone)
{
    if ($username === null)
        $gender = 1;
    if ($gender === null)
        $gender = 2;
    if ($phone === null)
        $phone = 3;
    echo $username . "|" . $gender . "|" . $phone;
}
Msg("bao", null, "guo");
echo "<hr>";

function Msg2($array = array())
{
    extract($array);
    if (! isset($username))
        $username = 1;
    if (! isset($gender))
        $gender = 2;
    if (! isset($phone))
        $phone = 3;
    echo $username . "|" . $gender . "|" . $phone;
}
Msg2(array(
    'username' => 'bao'
));
echo "<hr>";

date_default_timezone_set("PRC");
echo date("Y-m-d H:i:s", time() + 3600 * 24 * 30);
echo "<pre>";
var_dump(getdate());
echo "</pre>";
?>