<?php 
require_once "../settings.php";
require_once _DATA_PATH_."top.php";
require_once _COMMON_DATA_PATH_."classes/ClassDataTable.php"; 
require_once _COMMON_DATA_PATH_."classes/ClassTableQuery.php"; 

user_access_module ("access");

if (isset($_POST) AND !empty($_POST)) {
	//echo "<pre>POST "; print_r($_POST); echo "</pre>";
	is_int_obligatory ($_POST['user']);
	$user=$_POST['user'];
	unset($_POST['user']);
} else {
	echo "No POST values";
}

$object_query = new TableQuery;
$object_query -> order_by_field="id";
$array_modules = $object_query->query ("SELECT * from `"._TABLE_PREFIX_._USER_PREFIX_."_access_modules` WHERE status='1';");
if (isset($array_modules) AND !empty($array_modules)) {
	$count_modules = count ($array_modules);
	//echo "<pre>modules "; print_r($array_modules); echo "</pre>";
}

//get user's ex permissions
$object_query = new TableQuery;
$object_query -> order_by_field="id";
$array_user_permissions = $object_query->query ("SELECT * from `"._TABLE_PREFIX_._USER_PREFIX_."_access_user_permissions` 
	WHERE `user` = '".$user."' AND `status`='1';");	
if (isset($array_user_permissions) AND !empty($array_user_permissions)) {
	//echo "<pre>user_permissions "; print_r($array_user_permissions); echo "</pre>";
	$array_user_permissions_ex = array ();
	foreach ($array_user_permissions as $key => $value) {
		$array_user_permissions_ex[$value['module']] [$value['permission']]= $value['permission'];
	}
	ksort($array_user_permissions_ex);
}
//echo "<pre>user_permissions_ex "; print_r($array_user_permissions_ex); echo "</pre>";

$array_user_permissions_new = array();
foreach ($_POST as $key=>$value)
{
	$arr= array ();
	$arr=explode("_", $key);
	///	echo "<pre>"; print_r($arr); echo "</pre>"; 
	/*
		Array
		( 
			[0] => 25 // module
			[1] => 1  // permission
		)
	*/
	if (!empty($arr['1']))
	{
		///echo "<br>module ".$arr['0']." permission".$arr['1'];
		$array_user_permissions_new[$arr['0']] [$arr['1']]=$arr['1'];
	}
} // end foreach
///echo "<pre>user_permissions_new  "; print_r($array_user_permissions_new) ; echo "</pre>";
/// i = count modules; j = count permissions 
$array_update= array ();
foreach ($array_modules as $module => $array_module) {
	for($j=1; $j<=6; $j++)
	{
		$ex_value = $array_user_permissions_ex[$module][$j];
		$new_value=$array_user_permissions_new[$module][$j];
		if ($ex_value==$new_value)
		{
			//$array_not_changed[$module][$j]=$j;
		} else {
			if (!empty($ex_value) or !empty($new_value))
			{
				//
				$array_update[$module][$j]=$j;
			}
			
			//
			/*
			if (!empty($ex_value) AND empty($new_value)) {
				$array_update[$module][$j]=$j;
			}
			if (empty($ex_value) AND !empty($new_value)) {
				$array_update_insert[$module][$j]=$j;
			}
			//*/
		}
	}
}
////echo "<pre>array_not_changed "; print_r($array_not_changed) ; echo "</pre>";
////echo "<pre>update  "; print_r($array_update) ; echo "</pre>";
////echo "<pre>update_insert set status 1 "; print_r($array_update_insert) ; echo "</pre>";

foreach ($array_update as $module => $data)
{
	foreach ($data as $permission)
	{
		$query = "SELECT * FROM `"._TABLE_PREFIX_._USER_PREFIX_."_access_user_permissions`
            WHERE `user` = '".$user."' AND `module`='".$module."' AND `permission`=".$permission."; ";
		$object_access_user_permissions = new TableQuery;
		$object_access_user_permissions -> order_by_field="id";
		$array_access_user_permissions = $object_access_user_permissions->query ($query);
		if (isset($array_access_user_permissions) AND !empty($array_access_user_permissions) AND is_array($array_access_user_permissions))
		{
			////echo "<pre> access_user_permissions count "; print_r(count($array_access_user_permissions)); echo "</pre>";
			////echo "<pre> access_user_permissions "; print_r($array_access_user_permissions); echo "</pre>";
			///echo "<br>must be updated"; 
			$status="";
			foreach ($array_access_user_permissions as $value) {
				if ($value['status']=='1') {$status="0";} else {$status="1";}
			}

			// update script
			///*
			$query="update `"._TABLE_PREFIX_._USER_PREFIX_."_access_user_permissions` 
				SET 
					`status`='".$status."'
				WHERE `module`='".$module."' AND `user`='".$user."' AND `permission`='".$permission."'
				;
			";
			$cat = mysql_query($query);
			if($cat) 
			{
			}
			else {$error_update[]="0";}
			// */
		} else { 
			///echo "<br> must be inserted";
			// insert script
			///*
			$query = "INSERT INTO `"._TABLE_PREFIX_._USER_PREFIX_."_access_user_permissions`
			VALUES(
				NULL,
				'".$module."',
				'".$user."',
				'".$permission."',
				'1'
			)";
			if(mysql_query($query))
			{   } else {$error_insert[]="0";}
			//*/
		}
	}
}

if (isset($error_update) AND !empty($error_update)) {echo "<pre>Update error  "; print_r($error_update) ; echo "</pre>"; }
if (isset($error_insert) AND !empty($error_insert))  {echo "<pre>Insert error "; print_r($error_insert) ; echo "</pre>"; }
if (empty($error_update) AND empty($error_update)) {
	echo "<HTML><HEAD>
    <META HTTP-EQUIV='Refresh' CONTENT='0; URL=index.php'>
    </HEAD></HTML>";
}

require_once _DATA_PATH_."bottom.php";
?>