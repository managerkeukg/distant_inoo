<?php
require_once "../settings.php";
require_once _DATA_PATH_."top.php";

require_once _COMMON_DATA_PATH_."classes/ClassDataTable.php"; 
require_once _COMMON_DATA_PATH_."classes/ClassTableQuery.php"; 

user_access_module ("results_change");

require_once _FUNCTIONS_PATH_."f_group_members.php";

$object_modules_type= new TableQuery;
$object_modules_type->order_by_field="id";
$array_modules_type=$object_modules_type -> query ("SELECT * FROM `"._TABLE_PREFIX_."type_modules` WHERE `status`='1' ORDER BY `id` ASC;" );
if (isset($array_modules_type) AND !empty($array_modules_type))
{
	////echo count($array_modules_type)." записей";
	////echo "<pre>modules_type "; print_r($array_modules_type); echo "</pre>"; 
	$mod_arr = array();
	$modules_tests = array();
	foreach ($array_modules_type as $key => $value) {
		if (isset($_POST['id_test_'.$key]) AND !empty($_POST['id_test_'.$key])) {
			$mod_arr[$key]=$key;
			$modules_tests[$key]=$_POST['id_test_'.$key];
			//echo "<br> id_test of module  - ".$value['name_ru']." - ".$_POST['id_test_'.$key];
		}
	}
}

$group=$_POST['group'];
echo "<br>group ".$group;

$group_members=group_members($group);
//echo "<pre>modules posted "; print_r($mod_arr); echo "</pre>"; 
//echo "<pre>modules tests "; print_r($modules_tests); echo "</pre>"; 
//echo "<pre> group_members "; print_r($group_members); echo "</pre>"; 
$try_arr= array (1=>1, 2=>2);
// echo "<pre>POST "; print_r($_POST); echo "</pre>"; //exit;
//    [mod1_try_1_1599] => 2
//    [mod1_try_2_1599] => 1
foreach ($group_members as $id_user)
{ 
	foreach ($mod_arr as $mod)
	{ 
		echo "<br><br><br>MOD ".$mod;
		foreach ($try_arr as $try)
		{
			$text=""; $text="mod".$mod."_try_".$try."_".$id_user;
			if (isset($_POST[$text]) ) // AND !empty($_POST[$text])
			{  
				$cat="";
				$query="SELECT * FROM `"._TABLE_PREFIX_."test_users` WHERE `discipline`='".$modules_tests[$mod]."' AND `user_id`='".$id_user."' AND `mod`='".$mod."' ";
				$object_test_users = new TableQuery;
				$object_test_users -> order_by_field="id";
				$array_test_users = $object_test_users->query ($query);
				if (isset($array_test_users) AND !empty($array_test_users) AND is_array($array_test_users))
				{
					////echo "<pre> test_users count "; print_r(count($array_test_users)); echo "</pre>";
					////echo "<pre> test_users "; print_r($array_test_users); echo "</pre>";
					if (count($array_test_users) > $try-1)
					{ 	
						$data_array = array();
						foreach ($array_test_users as $value) {
							$data_array[]=$value;
			   			}  
						// echo "<pre>data "; print_r($data_array); echo "</pre>";
						$id_test="";
						$id_test=$data_array[$try-1]['id'];
						echo "<br>user ".$id_user." subj ".$modules_tests[$mod]." mod - ".$mod." try - ".$try; 
						echo " must be updated id_test - ".$id_test;
						$yes=""; $yes=$_POST[$text]; echo "<BR>".$_POST[$text];
						$no=""; $no=$array_modules_type[$mod]['n_questions']-$yes;
						$query="update `"._TABLE_PREFIX_."test_users` SET 
							yes='".$yes."',
							no='".$no."'
							WHERE `id`='".$id_test."'";
						echo "<br> &nbsp;&nbsp;&nbsp;&nbsp;".$query;
					   ///*
					   $cat_update = mysql_query($query);
					   if($cat_update) {  }  
					   else {
						   $error_update[$id_user][$modules_tests[$mod]][$mod][$try]=$id_test;
					   }
					   //*/   
						// echo "<pre>"; print_r($data_array); echo "</pre>";
					} else 
					{  
						echo "<br>user ".$id_user." subj ".$modules_tests[$mod]." mod ".$mod." try".$try."  must be inserted";
						$yes=""; $yes=$_POST[$text];
						$no=""; $no=$array_modules_type[$mod]['n_questions']-$yes;
						$query = "INSERT INTO `"._TABLE_PREFIX_."test_users` (`id`, `discipline`, `year`, `user_id`, `mod`, `yes`, `no`, `session`)
							VALUES(
							NULL,
							'".$modules_tests[$mod]."',
							'"._CURRENT_EDU_YEAR_."',
							'".$id_user."',
							'".$mod."',
							'".$yes."',
							'".$no."',
							'6o8HnoIYvjaiBaa'
							)";
						echo "<br> &nbsp;&nbsp;&nbsp;&nbsp;".$query;
						///*
						if(mysql_query($query))
						{   } 
						else {$error_insert[$id_user][$modules_tests[$mod]][$mod][$try]=$id_user; }
						//*/	   
					}
  		        }
                else {}
            } // if isset
        } // foreach try
    } // foreach mod
} // foreach students
echo "<pre> error insert "; print_r($error_insert); echo "</pre>";
echo "<pre> error update "; print_r($error_update); echo "</pre>";
// /*
if (empty($error_insert) AND empty ($error_update)) 
{
	/*
	echo "<HTML><HEAD>
	  <META HTTP-EQUIV='Refresh' CONTENT='0; URL=325.php'>
	  </HEAD></HTML>";
	//  */
}
//  */
//echo "<pre>"; print_r($_POST); echo "</pre>";
//echo "<pre>"; print_r($group_members); echo "</pre>";
?>