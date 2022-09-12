<?php 
require_once "../settings.php";
require_once _DATA_PATH_."top.php";
require_once _COMMON_DATA_PATH_."classes/ClassShowDiv.php"; 
require_once _COMMON_DATA_PATH_."classes/ClassTableQuery.php"; 

user_access_module ("migrate");
?>
<SCRIPT type="text/javascript" src="<?php echo _ROOT_PATH_;?>js/jquery.js"> </SCRIPT> 
<SCRIPT type="text/javascript" src="<?php echo _ROOT_PATH_;?>js/show.js"> </SCRIPT> 
<?php
function get_base_edu () {
	$object_base_edu = new TableQuery;
	$object_base_edu -> order_by_field="id";
	$array_base_edu = $object_base_edu-> query ("SELECT * FROM `inoo_base_edu` WHERE `status`='1';"); // limit 10, 10
    return $array_base_edu;
}

function get_directions ($base_edu) {
   $object_directions = new TableQuery;
   $object_directions -> order_by_field="id";
   $array_directions = $object_directions -> query ("SELECT * FROM `inoo_directions` where `status`='1';"); // limit 10, 10
   return $array_directions;
}

function get_semesters () {
   $object_semesters = new TableQuery;
   $object_semesters -> order_by_field="id";
   $array_semesters = $object_semesters -> query ("SELECT * FROM `inoo_semester` where `status`='1'"); // limit 10, 10
   return $array_semesters;
}

function get_disciplines () {
   $object_disciplines = new TableQuery;
   $object_disciplines -> order_by_field="id";
   $array_disciplines = $object_disciplines -> query ("SELECT * FROM `inoo_disciplines` WHERE `status`='1';"); // limit 10, 10
   return $array_disciplines;
}

$array_base_edu = get_base_edu();
$div_hide_settings['title']="base_edu";
$div_hide_settings['id']="base_edu";
$div_hide_base_edu = new ShowDiv ;
$div_hide_base_edu -> CreateHiddenDiv ($array_base_edu, $div_hide_settings);
////echo "<pre> Base edu "; print_r ($array_base_edu); echo "</pre>";

$array_directions = get_directions();
$div_hide_settings['title']="directions";
$div_hide_settings['id']="directions";
$div_hide_directions = new ShowDiv ;
$div_hide_directions -> CreateHiddenDiv ($array_directions, $div_hide_settings);
////echo "<pre> directions "; print_r ($array_directions); echo "</pre>";

$array_semesters = get_semesters();
$div_hide_settings['title']="semesters";
$div_hide_settings['id']="semesters";
$div_hide_semesters = new ShowDiv ;
$div_hide_semesters -> CreateHiddenDiv ($array_semesters, $div_hide_settings);
////echo "<pre> semesters "; print_r ($array_semesters); echo "</pre>";

$array_disciplines = get_disciplines();
$div_hide_settings['title']="disciplines";
$div_hide_settings['id']="disciplines";
$div_hide_disciplines = new ShowDiv ;
$div_hide_disciplines -> CreateHiddenDiv ($array_disciplines, $div_hide_settings);
////echo "<pre> disciplines "; print_r ($array_disciplines); echo "</pre>";

require_once _DATA_PATH_."bottom.php";
?>