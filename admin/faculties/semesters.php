<?php 
require_once "../settings.php";
require_once _DATA_PATH_."top.php";
require_once _COMMON_DATA_PATH_."classes/ClassDataTable.php"; 

user_access_module ("departments");

is_int_obligatory ($_GET['spec']);
is_int_obligatory ($_GET['dep']);
$spec=$_GET['spec'];
$dep=$_GET['dep'];

require_once _FUNCTIONS_PATH_."ft_specialities.php";
$speciality_array = get_speciality($spec);
echo "<h4>Специальность:".$speciality_array['name']."</h4>";
echo "<h4>Семестры</h4>";
echo "<a href=\"specialities.php?dep=".$dep."\">Назад</a><br><br>";
$datagrid= new DataTable;
$datagrid-> url="semesters.php?spec=".$spec."&dep=".$dep ;// not
$datagrid-> id_user="1"; // not
$datagrid-> status_field="status"; //obligatory if 
$datagrid-> user_field="id_user"; //obligatory if 

$datagrid-> query(_TABLE_PREFIX_."semesters", " AND (`speciality`=".$spec." ) "); // 
$datagrid-> table_field_caption("id", "Номер");
$datagrid-> table_field_caption("name", "Семестр");
$datagrid-> table_field_caption("speciality", "Специальность");
$datagrid-> foreign_key ("speciality", _TABLE_PREFIX_."specialities", "name", "id");

$datagrid-> user_module_permissions = user_access_module ("departments");

$datagrid-> display("table");

require_once _DATA_PATH_."bottom.php";
?>