<?php
$query = "SELECT * FROM `"._TABLE_PREFIX_."universities` where `status`='1'" ;
$workrez = mysql_query($query);
if(!$workrez) exit(mysql_error());
if(mysql_num_rows($workrez) > 0)
{ 
	echo "Университеты: <SELECT name=\"university_choose\" onchange='this.form.submit()'>";
	echo "<OPTION value=\"all\">Все</OPTION>";
	while($catalog = mysql_fetch_array($workrez))
	{
		if( $_POST['university_choose'] == $catalog['id'])   {$selected = "selected";}  else { $selected = ""; }
		echo "<OPTION value=\"".$catalog['id']."\" ".$selected."> ".$catalog['name']."</OPTION>"; // very important
	}
	echo "</SELECT><br><br>";
}

//institutes
if(isset($_POST['university_choose']))
{
	$university_choose=$_POST['university_choose']; //$university_choose="2";
	if(preg_match("|^[\d]+$|",$university_choose))
	{
		$query = "SELECT * FROM `"._TABLE_PREFIX_."institutes`
		WHERE `university` =".$university_choose." AND  `status`='1'
		";
		$prd = mysql_query($query);
		if(!$prd) exit(mysql_error());
		if(mysql_num_rows($prd) > 0)
		{
			echo "Институты: <SELECT name=\"institute_choose\" onchange='this.form.submit()'>";
			echo "<OPTION value=\"all\">Все</OPTION>";
			while($product = mysql_fetch_array($prd))
			{
				if( $_POST['institute_choose'] == $product['id'])   {
					$selected = "selected";	
				}  else {
					$selected = ""; 
				}
				echo "<OPTION value=\"".$product['id']."\"  ".$selected.">".$product['name']."</OPTION>";
			}
			echo "</SELECT><br><br>";
		}
	}
}


//departments
if(isset($_POST['institute_choose']))
{
	$institute_choose=$_POST['institute_choose']; 
	if(preg_match("|^[\d]+$|",$institute_choose))
	{
		$query = "SELECT * FROM `"._TABLE_PREFIX_."departments`
		WHERE `institute` =".$institute_choose." AND  `status`='1'
		";
		$rez_2 = mysql_query($query);
		if(!$rez_2) exit(mysql_error());
		if(mysql_num_rows($rez_2) > 0)
		{
			echo "Факультеты: <SELECT name=\"department_choose\" onchange='this.form.submit()'>";
			echo "<OPTION value=\"all\">Все</OPTION>";
			while($rez2 = mysql_fetch_array($rez_2))
			{
				if( $_POST['department_choose'] == $rez2['id'])   {
					$selected = "selected";	
				}  else {
					$selected = ""; 
				}
				echo "<OPTION value=\"".$rez2['id']."\"  ".$selected.">".$rez2['name']."</OPTION>";
			}
			echo "</SELECT><br><br>";
		}
	}
}

//specialities
if(isset($_POST['department_choose']))
{
	$department_choose=$_POST['department_choose']; 
	if(preg_match("|^[\d]+$|",$department_choose))
	{
		$query = "SELECT * FROM `"._TABLE_PREFIX_."specialities`
		WHERE `department` = ".$department_choose." AND `status`='1'
		";
		$rez_3 = mysql_query($query);
		if(!$rez_3) exit(mysql_error());
		if(mysql_num_rows($rez_3) > 0)
		{
			echo "Специальности: <SELECT name=\"speciality_choose\" onchange='this.form.submit()'>";
			echo "<OPTION value=\"all\">Все</OPTION>";
			while($rez3 = mysql_fetch_array($rez_3))
			{
				if( $_POST['speciality_choose'] == $rez3['id'])   {
					$selected = "selected";	
				}  else {
					$selected = ""; 
				}
				echo "<OPTION value=\"".$rez3['id']."\" ".$selected.">".$rez3['name']."</OPTION>";
			}
			echo "</SELECT><br><br>";
		}
	}
}

//semesters
if(isset($_POST['speciality_choose']))
{
	$speciality_choose=$_POST['speciality_choose']; 
	if(preg_match("|^[\d]+$|",$speciality_choose))
	{
		$query = "SELECT * FROM `"._TABLE_PREFIX_."semesters`
		WHERE `speciality` = ".$speciality_choose." AND `status`='1'
		";
		$rez_4 = mysql_query($query);
		if(!$rez_4) exit(mysql_error());
		if(mysql_num_rows($rez_4) > 0)
		{
			while($rez4 = mysql_fetch_array($rez_4))
			{
				$semesters_array[] = $rez4;
			}
		}
	}
}
/*
//semesters
if(isset($_POST['speciality_choose']))
{
	$speciality_choose=$_POST['speciality_choose']; 
	if(preg_match("|^[\d]+$|",$speciality_choose))
	{
		$query = "SELECT * FROM `"._TABLE_PREFIX_."semesters`
		WHERE `speciality` = ".$speciality_choose." AND `status`='1'
		";
		$rez_4 = mysql_query($query);
		if(!$rez_4) exit(mysql_error());
		if(mysql_num_rows($rez_4) > 0)
		{
			echo "Семестры: <SELECT name=\"semester_choose\" onchange='this.form.submit()'>";
			echo "<OPTION value=\"all\">Все</OPTION>";
			while($rez4 = mysql_fetch_array($rez_4))
			{
				if( $_POST['semester_choose'] == $rez4['id'])   {
					$selected = "selected";	
				}  else {
					$selected = ""; 
				}
				echo "<OPTION value=\"".$rez4['id']."\" ".$selected.">".$rez4['name']."</OPTION>";
				//$course_array[$rez4['id']]=$rez4['name'];
			}
			echo "</SELECT><br><br>";
		}
	}
}
*/
////      echo "<pre>"; print_r($course_array); echo "</pre>";

/*
foreach ($course_array as $key=>$value )
{
	//echo $key."-".$value."<br>";
	$query = "SELECT * FROM `mdl_context`
	WHERE instanceid = $key and contextlevel=50
	";
	$rez_4 = mysql_query($query);
	if(!$rez_4) exit(mysql_error());
	if(mysql_num_rows($rez_4) > 0)
	{
		while($rez4 = mysql_fetch_array($rez_4))
		{
			echo "$rez4[id],";
		}
	}
}
*/
?>