<?php
require_once "../settings.php";
require_once _DATA_PATH_."top.php";

user_access_module ("marquee");

if (isset($_POST['marquee_text']) AND !empty($_POST['marquee_text']))
{
	$text= htmlspecialchars(trim($_POST['marquee_text']));
	if(file_put_contents(_ROOT_PATH_."marquee.php", $text))
	{ 
		echo "<HTML><HEAD>
          <META HTTP-EQUIV='Refresh' CONTENT='0; URL=index.php'>
          </HEAD></HTML>";
	} else {
		exit("Ошибка при добавлении данных - ");
	}
} else {echo "Введите текст";}
?>