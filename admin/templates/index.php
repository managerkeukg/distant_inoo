<?php 
require_once "../settings.php";
require_once _DATA_PATH_."top.php";
require_once _COMMON_DATA_PATH_."classes/ClassDataTable.php"; 

user_access_module ("templates");

echo "<h1>Текущий шаблон предметов</h1>";
?>
<script type="text/javascript" src="<?php echo _ROOT_PATH_;?>js/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo _ROOT_PATH_;?>js/remove_div.js"></script>
<form method="post">
<?php
//require_once ""._ROOT_PATH_."js/choose_box.php";
require_once _COMMON_DATA_PATH_."classes/TableSelectBox.php";
if (isset($semesters_array) AND !empty($semesters_array))
{
	// echo "<pre>"; print_r($semesters_array); echo "</pre>";
	$i=0;
	foreach ($semesters_array as $value)
	{ 
		$i++;
		$table_array[]= array ($i, $value['name'], "<a href=\"subjects.php?sem=".$value['id']."\" target=\"_blank\">=></a>");
	}

	$settings='
		<table class="table_default">
			<thead>
				<tr class="tr_head">
					<th width="5px">No</th>
					<th width="30%">Семестр</th>
					<th width="30%">Предметы</th>
				</TR>
			</thead>
	';
	require_once (_COMMON_DATA_PATH_."classes/ClassTable.php");
	$table= new TableHtml;
	unset($array['info']);
	$table->display ($table_array, $settings);
}
	?>
</form>
<?php
require_once "choose_box_class.php";
///
echo "<pre>"; print_r($array); echo "</pre>";
if (isset($_POST['semester_choose']) AND !empty($_POST['semester_choose']))
{
	echo "<DIV id=\"sdf\" > <a href=\"subjects.php?sem=".$_POST['semester_choose']."\" target=\"_blank\">Редактировать предметы семестра</a> </DIV> ";
}

require_once _DATA_PATH_."bottom.php";
?>