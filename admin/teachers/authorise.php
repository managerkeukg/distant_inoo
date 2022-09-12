<?php 
require_once "../settings.php";
require_once _DATA_PATH_."top.php";

require_once _COMMON_DATA_PATH_."classes/ClassDataTable.php"; 

user_access_module ("teachers");

//is_int_obligatory ($_GET['log']);
//is_int_obligatory ($_GET['pass']);

echo "<h2>Авторизация преподавателя</h2>";
?>
<form action="<?php echo _ROOT_PATH_;?>teacher/login.php" method="POST">
	<input type="hidden" name="login" value="<?php echo $_GET['log']; ?>">
	<input type="hidden" name="password" value="<?php echo $_GET['pass']; ?>">
	<input type="submit" value="Перейти на страницу преподавателя"></input>
<form>
<?

require_once _DATA_PATH_."bottom.php";
?>