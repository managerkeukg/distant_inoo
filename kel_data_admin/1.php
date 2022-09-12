<?php
include "security.php";
require_once _DATA_PATH_."config.php";
echo "Привет!!!  ".USER_FIRST_NAME."   ".USER_LAST_NAME;
?>
<div class="grid_3 blq-navegacion-lateral">	
	<div class="caixa">
		<ul>
			<li class="titulo" >Главная														  
			<li ><a href="../logout.php">Выход</a>
		</ul>		
	</div>
</div>
<?php 
require_once _COMMON_DATA_PATH_."classes/classUserAccess.php";
$user_perm_obj = new UserAccess ;
$user_perm_obj-> table_prefix=_TABLE_PREFIX_; 
$user_perm_obj-> user_prefix=_USER_PREFIX_; 
$user_perm_obj-> getModules();
$user_perm_obj-> getUserPermissions(_ID_USER_);
$user_perm_obj-> showUserModules (array ("user" =>_ID_USER_, "perm_array"=>$ARRAY_USER_MODULE_PERM));
?>