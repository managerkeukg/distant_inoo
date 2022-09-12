<?php 
require_once "../settings.php";
require_once _DATA_PATH_."top.php";
require_once _COMMON_DATA_PATH_."classes/ClassDataTable.php"; 
require_once _COMMON_DATA_PATH_."classes/ClassTableQuery.php"; 

user_access_module ("access_roles");

is_int_obligatory ($_POST['role']);
$role=$_POST['role'];
// get modules array
$query="SELECT * from `"._TABLE_PREFIX_._USER_PREFIX_."_access_modules` WHERE status='1';";
$object_access_modules = new TableQuery;
$object_access_modules -> order_by_field="id";
$array_access_modules = $object_access_modules->query ($query);
if (isset($array_access_modules) AND !empty($array_access_modules) AND is_array($array_access_modules))
{
	////echo "<pre> access_modules count "; print_r(count($array_access_modules)); echo "</pre>";
	////echo "<pre> access_modules "; print_r($array_access_modules); echo "</pre>";
	$modules_array = array ();
	foreach ($array_access_modules as $value) {
		$modules_array[]=$value;	
	}  
	
}
///echo "<pre>List of all Modules  "; print_r($modules_array) ; echo "</pre>";
$count_modules=count($modules_array);
///echo $count_modules." count modules";
//get user's permissions
$query = "SELECT * FROM `"._TABLE_PREFIX_._USER_PREFIX_."_access_role_permissions`
    WHERE `role` = '".$role."' AND `status`='1'; ";
$object_access_role_permissions = new TableQuery;
$object_access_role_permissions -> order_by_field="id";
$array_access_role_permissions = $object_access_role_permissions->query ($query);
if (isset($array_access_role_permissions) AND !empty($array_access_role_permissions) AND is_array($array_access_role_permissions))
{
	////echo "<pre> access_role_permissions count "; print_r(count($array_access_role_permissions)); echo "</pre>";
	////echo "<pre> access_role_permissions "; print_r($array_access_role_permissions); echo "</pre>";
	$ex_array = array ();
	foreach ($array_access_role_permissions as $value) {
		$ex_array[$value['module']] [$value['permission']]=$value['permission']; // ['permission']
	}
}
///  	echo "<pre>Ex permissions  "; print_r($ex_array) ; echo "</pre>";
foreach ($_POST as $key=>$value)
{
	$arr=explode("_", $key);
	///echo "<pre>"; print_r($arr); echo "</pre>";
	if (!empty($arr['1']))
	{
		///echo "<br>module ".$arr['0']." permission".$arr['1'];
		$new_array[$arr['0']] [$arr['1']]=$arr['1'];
	}
} // end foreach
///echo "<pre>New permissions  "; print_r($new_array) ; echo "</pre>";

/// i = count modules; j = count permissions 
for ($i=1; $i<=$count_modules; $i++)
{
	for($j=1; $j<=6; $j++)
	{
		if ($new_array[$i][$j]==$ex_array[$i][$j])
		{  
			//echo "<br>not changed"; 
		} else { 
			///echo "<br>must be updated";  
			$change_array[$i][$j]=$j;
		}
   }
}
///echo "<pre>Change permissions  "; print_r($change_array) ; echo "</pre>";

foreach ($change_array as $module => $data)
{
	foreach ($data as $permission)
	{
		$query = "SELECT * FROM `"._TABLE_PREFIX_._USER_PREFIX_."_access_role_permissions`
            WHERE `role` = '".$role."' AND `module`='".$module."' AND `permission`='".$permission."'; ";
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
			$query="update `"._TABLE_PREFIX_._USER_PREFIX_."_access_role_permissions` 
				SET 
					`status`='".$status."'
				WHERE `module`='".$module."' AND `role`='".$role."' AND `permission`='".$permission."'; 
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
			$query = "INSERT INTO `"._TABLE_PREFIX_._USER_PREFIX_."_access_role_permissions`
            VALUES(
				NULL,
				'".$role."',
				'".$module."',
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