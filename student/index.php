<?php
if (!isset($_COOKIE['id']))
{
	header("Location:login.php");
	//OR empty ($_COOKIE['id'])
	//echo "<HTML><HEAD><META HTTP-EQUIV='Refresh' CONTENT='0; URL=\"../login.php\"'></HEAD></HTML>";
} else {
	header("Location:main/index.php");
}
?>