<FORM method="post">
	<?php
	is_int_obligatory ($direction);
	$query = "SELECT * FROM `"._TABLE_PREFIX_."semester`
		WHERE `direction` = ".$direction.";
	";
	$object_semester = new TableQuery;
	$object_semester -> order_by_field="id";
	$array_semester = $object_semester->query ($query);
	if (isset($array_semester) AND !empty($array_semester) AND is_array($array_semester))
	{
		////echo "<pre> semester count "; print_r(count($array_semester)); echo "</pre>";
		////echo "<pre> semester "; print_r($array_semester); echo "</pre>";
		echo "<select name=\"semestr\" onchange='this.form.submit()'>";
		echo "<option value=\"\"> выбрать </option>";
		foreach ($array_semester as $value) {
			if( $_POST['semestr'] == $value['id'])   {$selected = "selected";	}  else {$selected = ""; }
			echo "<option value=\"".$value['id']."\" ".$selected.">".$value['name_ru']."</option>";
			$semestr_array[]=$value['id'];
		}
		echo "</select><br><br>"; //// echo "<pre>"; print_r($semestr_array); echo "</pre>";
	}
	?>
</FORM>