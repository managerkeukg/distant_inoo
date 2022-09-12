<?php 
require_once "../settings.php";
require_once _DATA_PATH_."top.php";
require_once _COMMON_DATA_PATH_."classes/ClassDataTable.php"; 
require_once _COMMON_DATA_PATH_."classes/ClassTableQuery.php"; 

user_access_module ("choose");

echo "<h2>Выборка</h2>";

$object_base_edu= new TableQuery;
$object_base_edu -> order_by_field="id";
$array_base_edu = $object_base_edu -> query ("SELECT * FROM `"._TABLE_PREFIX_."base_edu` WHERE `status`='1'");
?>
<FORM method="post">
	<?php
		if (isset($array_base_edu) AND !empty($array_base_edu))
		{
			///echo "<pre>"; print_r($array_base_edu); echo "</pre>";
			echo "<select name=\"base_edu\" onchange='this.form.submit()'>";  //  onchange='this.form.submit()'
            echo "<option value=\"all\">Все</option>";
			foreach ($array_base_edu as $value)
			{
				if( $_POST['base_edu'] == $value['id'])   {$selected = "selected";	}  else {$selected = ""; }
                echo "<option value=\"".$value['id']."\" $selected>".$value['id']." - ".$value['name_ru']."</option>	";
			}
			echo "</select><br><br>";
		}
		
		if(isset($_POST['base_edu']))
		{
			is_int_obligatory ($_POST['base_edu']);
			$base_edu=$_POST['base_edu']; //$base_edu="2";
			$object_directions= new TableQuery;
			$object_directions -> order_by_field="id";
			$array_directions = $object_directions -> query ("SELECT * FROM `"._TABLE_PREFIX_."directions` WHERE `status`='1' AND `base_edu`=$base_edu");
			if (isset($array_directions) AND !empty($array_directions))
			{
				///echo "<pre>"; print_r($array_directions); echo "</pre>"; //exit;
				echo "<select name=\"directions\" onchange='this.form.submit()'>";  //  onchange='this.form.submit()'
				echo "<option value=\"all\">Все</option>";
				foreach ($array_directions as $value_directions)
				{
					if( $_POST['directions'] == $value_directions['id'])   {$selected = "selected";	}  else {$selected = ""; }
					echo "<option value=\"".$value_directions['id']."\" $selected>".$value_directions['id']." - ".$value_directions['name_ru']."</option>	"; // very important
				}
				echo "</select><br><br>";
			}
		}
		
		if(isset($_POST['directions']))
		{
			is_int_obligatory ($_POST['directions']);
			$directions=$_POST['directions']; //$directions="2";
			$object_semesters= new TableQuery;
			$object_semesters -> order_by_field="id";
			$array_semesters = $object_semesters -> query ("SELECT * FROM `"._TABLE_PREFIX_."semester` WHERE `status`='1' AND `direction`=$directions");
			if (isset($array_semesters) AND !empty($array_semesters))
			{
				///echo "<pre>"; print_r($array_semesters); echo "</pre>"; //exit;
				echo "<select name=\"semesters\" onchange='this.form.submit()'>";  //  onchange='this.form.submit()'
				echo "<option value=\"all\">Все</option>";
				foreach ($array_semesters as $value_semesters)
				{
					if( $_POST['semesters'] == $value_semesters['id'])   {$selected = "selected";	}  else {$selected = ""; }
					echo "<option value=\"".$value_semesters['id']."\" $selected>".$value_semesters['id']." - ".$value_semesters['name_ru']."</option>	"; // very important
				}
				echo "</select><br><br>";
			}
		}
		
		if(isset($_POST['semesters']))
		{
			is_int_obligatory ($_POST['semesters']);
			$semesters=$_POST['semesters']; //$semesters="2";
			$object_disciplines= new TableQuery;
			$object_disciplines -> order_by_field="id";
			$array_disciplines = $object_disciplines -> query ("SELECT * FROM `"._TABLE_PREFIX_."disciplines` WHERE `status`='1' AND `semester`=".$semesters."");
			if (isset($array_disciplines) AND !empty($array_disciplines))
			{
				///echo "<pre>"; print_r($array_semesters); echo "</pre>"; //exit;
				echo "<select name=\"disciplines\" onchange='this.form.submit()'>";  //  onchange='this.form.submit()'
				echo "<option value=\"all\">Все</option>";
				foreach ($array_disciplines as $value_disciplines)
				{
					if( $_POST['disciplines'] == $value_disciplines['id'])   {$selected = "selected";	}  else {$selected = ""; }
					echo "<option value=\"".$value_disciplines['id']."\" ".$selected.">".$value_disciplines['id']." - ".$value_disciplines['name_ru_detailed']."</option>	"; // very important
				}
				echo "</select><br><br>";
			}
		}
	?>
</FORM>
<?php

$datagrid-> user_module_permissions = user_access_module ("choose");

$datagrid-> display("table");

require_once _DATA_PATH_."bottom.php";
?>