<?php 
require_once "../settings.php";
require_once _DATA_PATH_."top.php";
require_once _COMMON_DATA_PATH_."classes/ClassDataTable.php"; 

user_access_module ("subjects_year");

echo "<h1>Предметы учебного года</h1>";
?>
<script type="text/javascript" src="<?php echo _ROOT_PATH_;?>js/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo _ROOT_PATH_;?>js/remove_div.js"></script>
<?php
require_once _COMMON_DATA_PATH_."classes/TableSelectBox.php";
require_once "choose_box_class.php";
if (isset($_POST['semester_choose']) AND !empty($_POST['semester_choose']))
{
	echo "<DIV id=\"sdf\" > <a href=\"subjects.php?sem=".$_POST['semester_choose']."&year=".$_POST['years_choose']."\" target=\"_blank\">Редактировать предметы семестра</a> </DIV> ";
	echo "<BR><BR><DIV id=\"sdfg\" > <a href=\"template.php\" target=\"_blank\">Импортировать из шаблона</a> </DIV> ";
}

require_once _DATA_PATH_."bottom.php";
?>