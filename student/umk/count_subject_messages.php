<?php
$query = "SELECT * FROM `"._TABLE_PREFIX_."subject_messages` WHERE `subject` = '".$course_id."'  
	AND (`student`='"._ID_USER_."') ORDER BY date DESC;" ;
$object_subject_messages = new TableQuery;
$object_subject_messages -> order_by_field="id";
$array_subject_messages = $object_subject_messages->query ($query);
if (isset($array_subject_messages) AND !empty($array_subject_messages) AND is_array($array_subject_messages))
{
	////echo "<pre> subject_messages count "; print_r(count($array_subject_messages)); echo "</pre>";
	////echo "<pre> subject_messages "; print_r($array_subject_messages); echo "</pre>";
	$new_array="0";
	$message_number = count($array_subject_messages);
	foreach ($array_subject_messages as $key => $value) {
		if (($value['active']=='2') AND ($value['from']=='1')) 
		{ 
			$new_array++; 
		} 
	}
}
else {
	//echo "No subject_messages existed";
}
?>