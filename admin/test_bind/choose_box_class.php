<?php
$array="";
$array[]= array (
	"id"=> "universities",
	"id_sub"=> "institutes",
	"table"=> "`"._TABLE_PREFIX_."universities`",
	"select_name"=> "university_choose",
	"caption"=> "Университеты:",
	"autoincrement_field"=> "id",
	"show_field"=> "name"
);

$array[]= array (
	"parent_table"=> "universities",
	"parent_select_name"=> "university_choose",
	//"parent_table_id"=> "id",
	"key_field"=> "university",
	"id"=> "institutes",
	"id_sub"=> "departments",
	"table"=> "`"._TABLE_PREFIX_."institutes` ",
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
	"table"=> "`"._TABLE_PREFIX_."departments` ",
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
$array[]= array (
	"parent_table"=> "semesters",
	"parent_select_name"=> "semester_choose",
	//"parent_table_id"=> "id",
	"key_field"=> "semester",
	"id"=> "subjects",
	"id_sub"=> "tests",
	"table"=> "`"._TABLE_PREFIX_."subjects` ",
	"select_name"=> "subject_choose",
	"caption"=> "Предметы:",
	"autoincrement_field"=> "id",
	"show_field"=> "name"
);
//*/
/*

$array[]= array (
	"parent_table"=> "subjects",
	"parent_select_name"=> "subject_choose",
	//"parent_table_id"=> "id",
	"key_field"=> "subject",
	"id"=> "tests",
	"id_sub"=> "subjects2",
	"table"=> "`"._TABLE_PREFIX_."subject_bind_test` ",
	"select_name"=> "test_choose",
	"caption"=> "Тесты:",
	"autoincrement_field"=> "id",
	"show_field"=> "test"
);
*/
///echo "<pre>"; print_r($array); echo "</pre>";
$TableBox= new TableSelectBox;
$TableBox->data_array=$array;
$TableBox->DisplayTableSelectBox();
?>