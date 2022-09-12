<?php
require_once "../settings.php";
require_once _DATA_PATH_."top.php";

if (isset($_POST) AND !empty($_POST))
{
	//echo "<pre>Members of  groups <br>"; print_r($_POST); echo "</pre>";
	$discipline= htmlspecialchars(trim($_POST['discipline']));
	$discipline= mysql_real_escape_string ($discipline);
	$year= htmlspecialchars(trim($_POST['year']));
	$year= mysql_real_escape_string ($year);
	$semestr= htmlspecialchars(trim($_POST['semestr']));
	$semestr= mysql_real_escape_string ($semestr);

	foreach ($_POST as $id_student => $value)
	{ 
		$value=trim($value);
		if (is_int($id_student)) 
		{ 
			$where="WHERE `user`='".$id_student."' AND (`status`=1)  AND (`year`=".$year.") AND (`course`=".$discipline.") 
				AND (`semestr`=".$semestr.")";
			$query = "SELECT * FROM `"._TABLE_PREFIX_."exam_values` ".$where."";
			$rez = mysql_query($query);
			if(!$rez) exit(mysql_error());
			if(mysql_num_rows($rez) > 0)
			{
				//echo "<br>must be updated";
				$query="update `"._TABLE_PREFIX_."exam_values` 
					SET 
					value='".$value."'
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
				$query = "INSERT INTO `"._TABLE_PREFIX_."exam_values`
				VALUES(NULL,
				'".$id_student."',
				'".$discipline."',
				'".$year."',
				'".$semestr."',
				'".$value."',
				'"._ID_USER_."',
				'1'
				)";
				if(mysql_query($query)) {  }
				else { $insert_error[]=$id_student;} 
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
