<?php
if (!isset($_COOKIE['id']))
{  
	if ($_SERVER['HTTP_HOST']=="localhost") {
		$host_path="http://".$_SERVER['HTTP_HOST']."/kelechek";
	} 
	else {
		$host_path="http://".$_SERVER['HTTP_HOST'];
	}
	echo "<HTML><HEAD><META HTTP-EQUIV='Refresh' CONTENT='0; URL=".$host_path."/student/login.php"."'></HEAD></HTML>";
}
?>