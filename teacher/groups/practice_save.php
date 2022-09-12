<?php
require_once "../settings.php";
require_once _DATA_PATH_."top.php";

if (isset($_POST) AND !empty($_POST))
{
	////echo "<pre>Members of  groups <br>"; print_r($_POST); echo "</pre>"; exit;
	$discipline= htmlspecialchars(trim($_POST['discipline']));
	$discipline= mysql_real_escape_string ($discipline);
	$edu_year= htmlspecialchars(trim($_POST['edu_year']));
	$edu_year= mysql_real_escape_string ($edu_year);

	$edu_semestr= htmlspecialchars(trim($_POST['edu_semestr']));
	$edu_semestr= mysql_real_escape_string ($edu_semestr);

	$practice= htmlspecialchars(trim($_POST['practice']));
	$practice= mysql_real_escape_string ($practice);

	foreach ($_POST as $id_student => $value)
	{ 
		$value=trim($value);
		if (is_int($id_student)) 
		{ 
			$where="WHERE `user` ='".$id_student."' AND (`status`=1)  AND (`year`=".$edu_year.") 
				AND (`course`=".$discipline.") AND (`practice`=".$practice.") AND (`semestr`=".$edu_semestr.")";
			$query = "SELECT * FROM `"._TABLE_PREFIX_."practice_values` ".$where."";
			$rez = mysql_query($query);
			if(!$rez) exit(mysql_error());
			if(mysql_num_rows($rez) > 0)
			{
				//echo "<br>must be updated";
				$query="update `"._TABLE_PREFIX_."practice_values` 
					SET 
						`value`='".$value."'
					".$where."
				";
				$cat_update = mysql_query($query);
				if($cat_update) 
				{}
				else {$update_error[]=$id_student;}
			} else 
			{ 
				//echo "<br>must be inserted";
				///*
				$query = "INSERT INTO `"._TABLE_PREFIX_."practice_values`
					VALUES(
						NULL,
						'".$id_student."',
						'".$discipline."',
						'".$edu_year."',
						'".$edu_semestr."',
						'".$practice."',
						'".$value."',
						'"._ID_USER_."',
						'1'
						)
					";
				if(mysql_query($query)) {  }
				else { $insert_error[]=$id_student;};  
				//*/
			}
		} else { 
			//echo "<br>not integer".$id_student;
		}
	} // foreach

	if (isset($update_error) AND !empty($update_error)) { echo "<pre>Update error<br>"; print_r($update_error); echo "</pre>";}
	if (isset($insert_error) AND !empty($insert_error)) { echo "<pre>INSERT error<br>"; print_r($insert_error); echo "</pre>";}
}
if (!isset($update_error) AND !isset($insert_error)) {
	echo "Данные успешно введены";
	echo "<HTML><HEAD><META HTTP-EQUIV='Refresh' CONTENT='0; URL=\"index.php?discipline=".$discipline."\"'></HEAD></HTML>";
}
echo "<br><a href=\"javascript:history.back();\">Назад</a><DIV>";

require_once _DATA_PATH_."bottom.php";
?>
