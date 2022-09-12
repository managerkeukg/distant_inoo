<?php
require_once "../settings.php";
require_once _DATA_PATH_."top.php";
require_once _COMMON_DATA_PATH_."classes/ClassTableQuery.php";
require_once _COMMON_DATA_PATH_."classes/ClassTableHtml.php";
?>
<br><br>
<p style="color:green;">Гак</p>
<br><br>
<?php
$query="SELECT * FROM `"._TABLE_PREFIX_."files_gak` where `status`='1' AND `group`="._USER_GROUP_." ORDER BY `id`;";
$object_files_gak = new TableQuery;
$object_files_gak -> order_by_field="id";
$array_files_gak = $object_files_gak->query ($query);
if (isset($array_files_gak) AND !empty($array_files_gak) AND is_array($array_files_gak))
{
	////echo "<pre> files_gak count "; print_r(count($array_files_gak)); echo "</pre>";
	////echo "<pre> files_gak "; print_r($array_files_gak); echo "</pre>";
	
	$object_table=new TableHtml5;
	$object_table -> css_file = "css/html_table_blue.css";
	
	$headers= array("id"=>"No", "name"=>"Название", "filename"=>"Гак файлы");
	$object_table -> set_th_array ($headers);
	//$object_table->column_value_array_foreign ("discipline", $array_files_gak , array("name_ru_detailed"));
	$object_table -> set_data($array_files_gak);
	$object_table -> data_key_delete ("group");
	$object_table -> data_key_delete ("filename");
	$object_table -> data_key_delete ("ext");
	$object_table -> data_key_delete ("status");
	
	$object_table -> data_key_add ("gak_files", "Гак файлы");
	$object_table -> data_key_value ("gak_files", "<a href=\"dl_gak_file.php?id={{id}}\" target=\"_blank\">Скачать</a>");
	
	$object_table->display ();
}
else {
	echo "<BR>Нет данных<BR>";
}

require_once _DATA_PATH_."bottom.php";
?>