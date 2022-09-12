<?php
require_once "../security.php";
require_once "../../common_data/settings.php";

define('_DATA_PATH_', _ROOT_PATH_."kel_data_admin/"); 
require_once _COMMON_DATA_PATH_."functions/f_is_int.php";
require_once _COMMON_DATA_PATH_."classes/ClassTableQuery.php";

//--- --- modules
require_once _COMMON_DATA_PATH_."functions/UserModulePermissions.php";
$ARRAY_USER_MODULE_PERM = user_module_permissions(_ID_USER_);
////echo "<pre>array_user_module_perm - "; print_r($ARRAY_USER_MODULE_PERM); echo "</pre>";

require_once _COMMON_DATA_PATH_."functions/get_module_id.php";
require_once _COMMON_DATA_PATH_."functions/get_modules.php";
require_once _COMMON_DATA_PATH_."functions/user_access_module.php";
//--- --- end modules

//--- --- submodules
require_once _COMMON_DATA_PATH_."functions/UserSubModulePermissions.php";
$ARRAY_USER_SUBMODULE_PERM = user_submodule_permissions(_ID_USER_);
////echo "<pre>array_user_submodule_perm - "; print_r($ARRAY_USER_SUBMODULE_PERM); echo "</pre>";

require_once _COMMON_DATA_PATH_."functions/get_submodules.php";
require_once _COMMON_DATA_PATH_."functions/get_submodule_id.php";
require_once _COMMON_DATA_PATH_."functions/user_access_submodule.php";
//--- --- end submodules

?>