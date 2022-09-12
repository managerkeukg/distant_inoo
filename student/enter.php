<?php
header('Content-Type: text/html; charset=utf-8');

require_once "../common_data/settings_variables.php";
require_once "../common_data/config.php";
require_once "../common_data/functions/f_is_int.php";
require_once "../common_data/classes/ClassTableQuery.php";
require_once "../functions/f_clean.php";

is_int_obligatory ($_GET['id']);
$id=$_GET['id'];
$id = clean($_GET['id']);

$query = "SELECT * FROM  `"._TABLE_PREFIX_."students` WHERE  `id` = '".$id."' AND `id`>'8';";
$object_students = new TableQuery;
$object_students -> order_by_field="id";
$array_students = $object_students->query ($query);
if (isset($array_students) AND !empty($array_students) AND is_array($array_students))
{
	////echo "<pre> students count "; print_r(count($array_students)); echo "</pre>";
	////echo "<pre> students "; print_r($array_students); echo "</pre>"; exit; 
	foreach ($array_students as $value) {
		setcookie("id",$value['id']);
		setcookie("name",$value['firstname']);
		setcookie("surname",$value['lastname']);
		@header("Location:online_test/index.php");
	}
} else {
	echo "<h3><p style=\"color:red;\">Пароль и Логин пользователя не соответствуют - </p></h3>";
}
echo "<p style=\"color:green;\"><b>Вход только для зарегистрированных пользователей <br>
(СТУДЕНТОВ И СОТРУДНИКОВ ИНОО)<br> Пожалуйста авторизуйтесь</b></p>";

if (isset($dbcnx)) { mysql_close($dbcnx); } 
?>