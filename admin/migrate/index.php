<?php 
require_once "../settings.php";
require_once _DATA_PATH_."top.php";

user_access_module ("migrate");

echo "<BR><BR><a href=table_to_table.php target=\"_blank\">copy from one table to another one</a>";
echo "<BR><BR><a href=all_array.php target=\"_blank\">ok all_array</a>";
echo "<BR><BR><a href=show_columns.php target=\"_blank\">ok show_dBase_columns</a>";

require_once _DATA_PATH_."bottom.php";
?>