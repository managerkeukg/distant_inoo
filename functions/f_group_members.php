<?php
require "f_student_deleted.php";
function group_members($group)
{
	$query = "SELECT * FROM `"._TABLE_PREFIX_."group_members`
        WHERE `group` = '".$group."' AND `status`='1'";
    $object_group_members = new TableQuery;
	$object_group_members -> order_by_field="id";
	$array_group_members = $object_group_members -> query ($query);
	if (isset($array_group_members) AND !empty($array_group_members) AND is_array($array_group_members))
	{
		////echo "<pre> Count group_members - "; print_r(count($array_group_members)); echo "</pre>";
		////echo "<pre>group_members "; print_r($array_group_members); echo "</pre>";
		$member_array = array();
		foreach ($array_group_members as $value) {
			if(get_user_status($value['id_user'])==0) {}
			else {
				$member_array[trim($value['id_user'])]=trim($value['id_user']);
			}
		}
		return $member_array;
	} else {
		return 0;
	}
}
?>