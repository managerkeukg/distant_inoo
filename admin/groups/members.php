<?php 
require_once "../settings.php";
require_once _DATA_PATH_."top.php";
require_once _COMMON_DATA_PATH_."classes/ClassDataTable.php"; 
require_once _COMMON_DATA_PATH_."classes/ClassTableQuery.php";

user_access_module ("groups"); 

require_once _FUNCTIONS_PATH_."f_group_name.php";
require_once _FUNCTIONS_PATH_."f_group_members.php";

is_int_obligatory ($_GET['id']);
$group=$_GET['id'];
echo "<h2>Студенты Группы</h2>";
$group_name=identify_group_name($group);
$user_array=group_members($group);
?>
<a href="index.php">Назад</a><br>
<h4>Группа <?php echo $group_name;?></h4>
<?php
$object_group_students= new TableQuery;
$object_group_students -> order_by_field="id";
$array_group_students = $object_group_students -> query ("SELECT `id` FROM `"._TABLE_PREFIX_."group_members` WHERE `group`=".$group." AND `status`='1'");
echo "В группе ".count ($array_group_students)." Студентов";

$datagrid= new DataTable;
$datagrid-> url="members.php?id=".$group;// not
$datagrid-> status_field="status"; //obligatory if 

$datagrid-> query(_TABLE_PREFIX_."group_members", " AND (`group`=".$group." ) ");
$datagrid-> table_field_caption("id", "Номер записи");
$datagrid-> table_field_caption("group", "Группа");
$datagrid-> foreign_key ("group", _TABLE_PREFIX_."groups", "name", "id"); //
$datagrid-> bind_field_with_parameter("group", $group);

$datagrid-> table_field_caption("id_user", "Фамилия");
$datagrid-> foreign_key ("id_user", _TABLE_PREFIX_."students", "lastname", "id"); //

$datagrid-> addcolumn("student_enter", "<a href=\"disciplines.php\"></a>");
$datagrid-> table_field_caption("student_enter", "Войти");
$datagrid-> column_value("student_enter", '<a href="'._ROOT_PATH_.'student/enter.php?id={{id_user}}"  target="_blank">Войти</a>');


$datagrid-> addcolumn("disciplines_list", "<a href=\"disciplines.php\"></a>");
$datagrid-> table_field_caption("disciplines_list", "Предметы <br>Список");
$datagrid-> column_value("disciplines_list", '<a href="disciplines_list.php?student={{id_user}}"  target="_blank">=></a>');

$datagrid-> addcolumn("disciplines", "<a href=\"disciplines.php\"></a>");
$datagrid-> table_field_caption("disciplines", "Предметы <br>Редактировать");
$datagrid-> column_value("disciplines", '<a href="disciplines.php?group='.$group.'&student={{id_user}}"  target="_blank">=></a>');

$datagrid-> addcolumn("test_results", "<a href=\"test_results.php\"></a>");
$datagrid-> table_field_caption("test_results", "Результаты теста");
$datagrid-> column_value("test_results", '<a href="test_results.php?student={{id_user}}" target="_blank">=></a>');


$datagrid-> user_module_permissions = user_access_module ("groups");

$datagrid-> display("table");


require_once _DATA_PATH_."bottom.php";
?>