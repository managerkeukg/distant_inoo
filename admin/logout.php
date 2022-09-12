<?php 
setcookie('usertype','');
setcookie('id','');
setcookie('name','');
setcookie('surname','');
@header("Location:login.php"); // @header("Location:".$_SERVER['HTTP_REFERER']);
?>