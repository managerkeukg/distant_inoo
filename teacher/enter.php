<?php
header('Content-Type: text/html; charset=utf-8');

require_once "../common_data/config.php";
require_once "../common_data/functions/f_is_int.php";
require_once "../common_data/classes/ClassTableQuery.php";
require_once "../functions/f_clean.php";

is_int_obligatory ($_GET['id']);
$id=$_GET['id'];

$id = clean($_GET['id']);

$query = "SELECT * FROM  `inoo_teachers` WHERE  `id` = '".$id."' AND `status`='1';";
$object_teachers = new TableQuery;
$object_teachers -> order_by_field="id";
$array_teachers = $object_teachers->query ($query);
if (isset($array_teachers) AND !empty($array_teachers) AND is_array($array_teachers))
{
	////echo "<pre> teachers count "; print_r(count($array_teachers)); echo "</pre>";
	////echo "<pre> teachers "; print_r($array_teachers); echo "</pre>";
	foreach ($array_teachers as $value) {
		setcookie("id",$value['id']);
		setcookie("name",$value['name']);
		setcookie("surname",$value['surname']);
		@header("Location:main/index.php");
	}
} else {
	echo "<h3><p style=\"color:red;\">Пароль и Логин пользователя не соответствуют - </p></h3>";
}
echo "<p style=\"color:green;\"><b>Вход только для зарегистрированных пользователей <br>
(СОТРУДНИКОВ ИНОО)<br> Пожалуйста авторизуйтесь</b></p>";

if (isset($dbcnx)) { mysql_close($dbcnx); } 
?>