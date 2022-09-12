<?php
$array="";
$array[]= array (
	"id"=> "years",
	"id_sub"=> "universities",
	"table"=> "`"._TABLE_PREFIX_."type_years`",
	"select_name"=> "years_choose",
	"caption"=> "Учебный год:",
	"autoincrement_field"=> "id",
	"show_field"=> "name"
);

$array[]= array (
	"id"=> "universities",
	"id_sub"=> "institutes",
	"table"=> "`"._TABLE_PREFIX_."universities`",
	/*
	"query_and" => array ("0" => array("field"=>"start", "post"=>"years_choose", "equation"=>"<="),
	"1" => array("field"=>"end", "post"=>"years_choose", "equation"=>">=")
	),
	*/
	"select_name"=> "university_choose",
	"caption"=> "Университеты:",
	"autoincrement_field"=> "id",
	"show_field"=> "name"
	//"query_and"=>" AND `start`>='8' AND `end`<='13' ",
);

$array[]= array (
	"parent_table"=> "universities",
	"parent_select_name"=> "university_choose",
	//"parent_table_id"=> "id",
	"key_field"=> "university",
	"id"=> "institutes",
	"id_sub"=> "departments",
	"table"=> "`"._TABLE_PREFIX_."institutes` ",

	"query_and" => array ("0" => array("field"=>"start", "post"=>"years_choose", "equation"=>"<="),
	"1" => array("field"=>"end", "post"=>"years_choose", "equation"=>">=")
	),
	"select_name"=> "institute_choose",
	"caption"=> "Институты:",
	"autoincrement_field"=> "id",
	"show_field"=> "name"
);

$array[]= array (
	"parent_table"=> "institutes",
	"parent_select_name"=> "institute_choose",
	//"parent_table_id"=> "id",
	"key_field"=> "institute",
	"id"=> "departments",
	"id_sub"=> "specialities",
	"table"=> "`"._TABLE_PREFIX_."departments2` ",
	/*
	"query_and" => array ("0" => array("field"=>"start", "post"=>"years_choose", "equation"=>"<="),
	"1" => array("field"=>"end", "post"=>"years_choose", "equation"=>">=")
	),
	*/
	"select_name"=> "department_choose",
	"caption"=> "Факультеты:",
	"autoincrement_field"=> "id",
	"show_field"=> "name"
);

$array[]= array (
	"parent_table"=> "departments",
	"parent_select_name"=> "department_choose",
	//"parent_table_id"=> "id",
	"key_field"=> "department",
	"id"=> "specialities",
	"id_sub"=> "semesters",
	"table"=> "`"._TABLE_PREFIX_."specialities` ",
	/*
	"query_and" => array ("0" => array("field"=>"start", "post"=>"years_choose", "equation"=>"<="),
	"1" => array("field"=>"end", "post"=>"years_choose", "equation"=>">=")
	),
	*/
	"select_name"=> "speciality_choose",
	"caption"=> "Специальности:",
	"autoincrement_field"=> "id",
	"show_field"=> "name"
);

$array[]= array (
	"parent_table"=> "specialities",
	"parent_select_name"=> "speciality_choose",
	//"parent_table_id"=> "id",
	"key_field"=> "speciality",
	"id"=> "semesters",
	"id_sub"=> "subjects",
	"table"=> "`"._TABLE_PREFIX_."semesters` ",
	"select_name"=> "semester_choose",
	"caption"=> "Семестры:",
	"autoincrement_field"=> "id",
	"show_field"=> "name"
);

///*
//$query_and[] = array ("year"=>"years_choose");
$array[]= array (
	"parent_table"=> "semesters",
	"parent_select_name"=> "semester_choose",
	//"parent_table_id"=> "id",
	"key_field"=> "semester",
	"id"=> "subjects",
	"id_sub"=> "subjects2",
	"table"=> "`"._TABLE_PREFIX_."disciplines` ",
	//"query_and" => array ("field"=>"year", "post"=>"years_choose", "equation"=>"="),
	//"query_ands" => array ("year"=>"years_choose"),  //" `year`='8' AND ",
	//"and_field"=> "year", 
	//"and_post_value"=> "years_choose",
	"select_name"=> "subject_choose",
	"caption"=> "Предметы:",
	"autoincrement_field"=> "id",
	"show_field"=> "name_ru"
);
//*/
//echo "<pre>"; print_r($array); echo "</pre>";
$TableBox= new TableSelectBox;
$TableBox->data_array=$array;
$TableBox->DisplayTableSelectBox();
?>