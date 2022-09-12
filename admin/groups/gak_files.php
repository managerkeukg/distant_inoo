<?php 
require_once "../settings.php";
require_once _DATA_PATH_."top.php";
require_once _COMMON_DATA_PATH_."classes/ClassDataTable.php";
require_once _COMMON_DATA_PATH_."classes/ClassTableQuery.php"; 

user_access_module ("groups");

require_once _FUNCTIONS_PATH_."f_group_name.php";

is_int_obligatory ($_GET['id']);
$group=$_GET['id'];
echo "<h2>Группы</h2>";
$group_name=identify_group_name($group);
?>
<a href="index.php">Назад</a><br>
<h4>ГАК   Группа <?php echo $group_name;?></h4>
<?php
$datagrid= new DataTable;
$datagrid-> url="gak_files.php?id=".$group;// not
$datagrid-> status_field="status"; //obligatory if 

$datagrid-> query(_TABLE_PREFIX_."files_gak", " AND (`group`=".$group." ) ");
$datagrid-> table_field_caption("id", "Номер");
$datagrid-> table_field_caption("group", "Группа");
$datagrid-> foreign_key ("group", _TABLE_PREFIX_."groups", "name", "id"); //
$datagrid-> bind_field_with_parameter("group", $group);

$datagrid-> table_field_caption("name", "Название");
$datagrid-> column_hide_table("filename");
$datagrid-> table_field_caption("filename", "Это поле не изменять");
//$datagrid-> column_hide_table("ext");
$datagrid-> table_field_caption("ext", "Это поле не изменять");
$datagrid-> column_value("ext", '<a href="dl_gak_file.php?id={{id}}" target=_blank >Скачать</a>
<BR><BR><a href="file_gak.php?id={{id}}&group={{group}}" target=_blank>загрузить/изменить файл</a>');



$datagrid-> user_module_permissions = user_access_module ("groups");

$datagrid-> display("table");

require_once _DATA_PATH_."bottom.php";
?>