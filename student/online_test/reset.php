<?php
require_once "../settings.php";
require_once _DATA_PATH_."top.php";

require_once _COMMON_DATA_PATH_"config.php";
$query="UPDATE `"._TABLE_PREFIX_."test_users` SET `user_id`='1' WHERE `user_id`='9';";
$cat = mysql_query($query);
if($cat) 
{	
	echo "<HTML><HEAD><META HTTP-EQUIV='Refresh' CONTENT='0; URL=index.php'></HEAD></HTML>";
}
else {exit(mysql_error());}


require_once _DATA_PATH_."bottom.php";
?>