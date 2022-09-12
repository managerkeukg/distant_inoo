<?php 
function f_attach_student_to_discipline ($id_student, $discipline, $selected_array ) 
{
	// get student assignmrent to discipline
	$query = "SELECT * FROM `"._TABLE_PREFIX_."discipline_assignments`
        WHERE `userid` = '".$id_student."'  AND (`discipline`='".$discipline."')
    "; 
	$object_discipline_assignments = new TableQuery;
	$object_discipline_assignments -> order_by_field="id";
	$array_discipline_assignments = $object_discipline_assignments->query ($query);
	if (isset($array_discipline_assignments) AND !empty($array_discipline_assignments) AND is_array($array_discipline_assignments))
	{
		////echo "<pre> discipline_assignments count "; print_r(count($array_discipline_assignments)); echo "</pre>";
		////echo "<pre> discipline_assignments "; print_r($array_discipline_assignments); echo "</pre>";
		$yet_array = array();
		foreach ($array_discipline_assignments as $value) {
			$yet_array[$discipline][]= $value['status'];
		} //end for while
	}  
	////echo "<pre> Student's discipline Assignments "; print_r($yet_array); echo "</pre>"; ///	exit;
	   ?>
        <tr><td><?php echo $id_student; ?></td>
		    <td><?php echo $discipline; ?></td>
		    <td><?php if (isset($selected_array[$discipline])) {echo "was selected";} ?></td>
		    <td><?php if (isset($yet_array[$discipline])) {echo "yet was assigned as";} ?></td>
			<td><?php  echo $yet_array[$discipline]['0']." ".$yet_array[$discipline]['1']; 
			 //echo "<pre>yet  "; print_r($yet_array[$discipline]); echo "</pre>";  
				?>
			</td>
			<td><?php 
				if (isset($selected_array[$discipline]) AND (!isset($yet_array[$discipline])) ) 
				{ 
					echo "<br>a record must be inserted"; 
					$query = "INSERT INTO `"._TABLE_PREFIX_."discipline_assignments` (id,	discipline, userid, status)
					VALUES (
					NULL,
					'".$discipline."',
					'".$id_student."',
					'1'
					)";
					if(mysql_query($query)) { echo "<br>a record was inserted  with status 1"; } 
					else { $notinsertedarray[]=$discipline; echo "could not be inserted";}
				} 
				?>
			</td>
            <td><?php 
			if ( isset($yet_array[$discipline])  ) 
			{  	
				if (isset($selected_array[$discipline]) AND  $yet_array[$discipline]['0']=='1' ) { }
				if (isset($selected_array[$discipline]) AND  $yet_array[$discipline]['0']=='0' ) 
				{ 
					echo "<br>status must be updated to 1"; 
					///*
					$update_query="update `"._TABLE_PREFIX_."discipline_assignments` SET  `status`='1'
						WHERE `userid` = '".$id_student."' AND (`discipline`='".$discipline."')  AND (`status`='0') ";
					$cat = mysql_query($update_query);
					if($cat)  { echo "<br>status updated to 1";} 
					else { $error_update[]=$id_student; echo "<br>error";}
					//*/
				}
				if (!isset($selected_array[$discipline]) AND  $yet_array[$discipline]['0']=='0' ) { }
				if (!isset($selected_array[$discipline]) AND  $yet_array[$discipline]['0']=='1' ) 
				{
					echo "<br>status must be updated to 0"; 
					///*
					$update_query="update `"._TABLE_PREFIX_."discipline_assignments` SET  `status`='0'
					WHERE `userid` = '".$id_student."' AND (`discipline`='".$discipline."')  AND (`status`='1') ";
					$cat = mysql_query($update_query);
					if($cat)  { echo "<br>status updated to 0";} 
					else { $error_update[]=$id_student; echo "<br>error";}
					//*/
				}   
			} 
			?>
			</td>
		</tr>
		<?php
} // end function
?>