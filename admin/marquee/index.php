<?php 
require_once "../settings.php";
require_once _DATA_PATH_."top.php";

user_access_module ("marquee");

$text=file_get_contents(_ROOT_PATH_."marquee.php");
?>
<h2>Бегущая строка</h2>

<FORM action="save.php" method="POST">
	<textarea name="marquee_text" rows="20" cols="100%"><?php echo $text;?></textarea>
	<br>
	<input type="submit" value="Сохранить">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	<input type="button" value="Отменить" onclick="window.location = 'index.php'">
</FORM>
<?php
require_once _DATA_PATH_."bottom.php";
?>