<?php 
require_once "../settings.php";
require_once _DATA_PATH_."top.php";

require_once _COMMON_DATA_PATH_."classes/ClassDataTable.php"; 

user_access_module ("delete_files");

echo "<h2>Удалить лишние файлы</h2>";

?> 
<a href="delete_lesson_files.php" target="_blank">delete lesson_files</a>
<br><br>
<a href="delete_lesson_files_umk.php" target="_blank">delete lesson_files_umk</a>
<?php

require_once _DATA_PATH_."bottom.php";
?>