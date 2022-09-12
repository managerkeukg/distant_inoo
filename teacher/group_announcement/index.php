<?php 
require_once "../settings.php";
require_once _DATA_PATH_."top.php";

require_once _COMMON_DATA_PATH_."classes/ClassDataTable.php"; 
require_once _FUNCTIONS_PATH_."f_clean.php";

if (isset($_GET['group']) AND !empty($_GET['group'])) {is_int_obligatory ($_GET['group']);} else {exit('access restricted');}
if (isset($_GET['discipline']) AND !empty($_GET['discipline'])) {is_int_obligatory ($_GET['discipline']);} else {exit('access restricted');}
$id=$_GET['group'];  
$discipline=$_GET['discipline'];
echo  "<h3>Объявления группе</h3>";

$datagrid= new DataTable;
$datagrid-> url("index.php?group=".$id."&discipline=".$discipline."");
$datagrid-> id_user=_ID_USER_; // not
$datagrid-> user_field="id_user"; 
$datagrid-> status_field="status"; //obligatory if 

$datagrid-> query(_TABLE_PREFIX_."group_messages_teacher", "AND (`group`='".$id."' ) AND (`course`='".$discipline."') AND (`id_user`="._ID_USER_.")");


//$datagrid-> deletecolumn ("message");
//$datagrid-> deletecolumn ("discipline");
//$datagrid-> table_field_caption("edit", "");
//$datagrid-> table_field_caption("delete", "");
//$datagrid-> sort_by("id", "Номеру");

$datagrid-> table_field_caption("id", "Номер");
$datagrid-> table_field_caption("group", "Группа");
$datagrid-> table_field_caption("course", "Дисциплина");
$datagrid-> table_field_caption("title", "Заголовок");

$datagrid-> table_field_caption("message", "Сообщение");
$datagrid-> field_type("edit", "message", "textarea");
$datagrid-> field_type("add", "message", "textarea");
$datagrid-> ckeditor_replace ("edit", "message");
$datagrid-> ckeditor_replace ("add", "message");

$datagrid-> table_field_caption("date", "Дата");
$datagrid-> table_field_caption("id_user", "user");

$datagrid-> display("table");
?>