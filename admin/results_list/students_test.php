<?php 
require_once "../settings.php";
require_once _DATA_PATH_."top.php";
require_once _COMMON_DATA_PATH_."classes/ClassDataTable.php"; 

user_access_module ("results_list");

is_int_obligatory ($_GET['id']);
$student=$_GET['id'];

echo "<h2>Список пройденных тестов студента</h2>";
echo "Ф.И.О студента Группа Название Курса";

$query = "SELECT * FROM `"._TABLE_PREFIX_."test_users` WHERE `user_id`='".$student."'; ";
$object_test_users= new TableQuery;
$object_test_users -> order_by_field = "id";
$array_test_users = $object_test_users -> query ($query);
if (isset($array_test_users) AND !empty($array_test_users)) {
	////echo "<pre>"; print_r($array_test_users); echo "</pre>";
	$datagrid= new DataTable;
	$datagrid-> url="students_test.php?id=".$student."";// not

	$datagrid-> query(_TABLE_PREFIX_."test_users", " AND `user_id`='".$student."' ");
	$datagrid-> table_field_caption("id", "№ теста");
	$datagrid-> table_field_caption("discipline", "Дисциплина");
	$datagrid-> foreign_key ("discipline", _TABLE_PREFIX_."disciplines", "name_ru", "id");

	$datagrid-> table_field_caption("year", "Учебный год");
	$datagrid-> foreign_key ("year", _TABLE_PREFIX_."type_years", "name", "id");

	$datagrid-> table_field_caption("user_id", "Ф.И.О студента");
	$datagrid-> foreign_key ("user_id", _TABLE_PREFIX_."students", "lastname", "id");
	
	$datagrid-> table_field_caption("mod", "Модуль");
	$datagrid-> table_field_caption("questions", "Вопросы теста");
	$datagrid-> table_field_caption("yes", "Прав. ответов");
	$datagrid-> table_field_caption("no", "Неправ. ответов");
	$datagrid-> table_field_caption("session", "Сессия");
	$datagrid-> table_field_caption("browser", "Браузер");
	$datagrid-> table_field_caption("time", "Время старта");
	$datagrid-> table_field_caption("time_end", "Время окончания");
	$datagrid-> table_field_caption("ip", "Ай пи");
	$datagrid-> table_field_caption("test_ended", "Тест окончен");
	
	$datagrid-> user_module_permissions =array ("2" => "2"); // 1=all 2 = view 3=hide/show 4=add 5=edit 6=delete
	$datagrid-> display("table");
} else {
	echo "No student's tests exists.";
}

require_once _DATA_PATH_."bottom.php";
?>