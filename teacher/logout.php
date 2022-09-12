<?php 
setcookie('id','');
setcookie('name','');
setcookie('surname','');
@header("Location:http://inoo.keu.kg/main/index.php"); // @header("Location:".$_SERVER['HTTP_REFERER']);
?>