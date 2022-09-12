<?php 
error_reporting(0);
/*
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
*/
header('Content-Type: text/html; charset=UTF-8');
if (!isset($_COOKIE['id']))
{
	@header("Location:../login.php");
}
//echo "<pre>"; print_r($_COOKIE); echo "</pre>";
define( 'USER_FIRST_NAME', $_COOKIE['name']); // SESS_MEMBER_ID
define( 'USER_LAST_NAME', $_COOKIE['surname'] ); // SESS_MEMBER_ID
?>
<!DOCTYPE html>
<html lang="ru">
<head>
	<title>Админка</title>
	<meta name="description" content="Админка" />
	<!-- 
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" /> 
	charset=iso-utf-8 
	-->
</head>
<link href="<?php echo _ROOT_PATH_;?>css/main.css" rel="stylesheet">
<link href="<?php echo _ROOT_PATH_;?>css/menu_vertical.css" rel="stylesheet">
<link href="<?php echo _ROOT_PATH_;?>css/header.css" rel="stylesheet">
<link href="<?php echo _ROOT_PATH_;?>css/consult.css" rel="stylesheet">
<link href="<?php echo _ROOT_PATH_;?>css/base0000.css" rel="stylesheet">
<link href="<?php echo _ROOT_PATH_;?>css/buttons0.css" rel="stylesheet">
<link href="<?php echo _ROOT_PATH_;?>css/css00000.css" rel="stylesheet">
<link href="<?php echo _ROOT_PATH_;?>css/distant.css" rel="stylesheet">
<body style="background-color:#EDEDED;">
    <div id="all">
		<table style="width:90%; margin:0 auto; text-align:center;">
		<tbody>
			<tr>
				<td>
					<div id="header">
						<div style="text-align:center; width:100%; padding-bottom:20px;">
							 <?php include _DATA_PATH_."header.php"; ?>
						</div>
					</div><!-- end header -->
					<div id="content">
						<table>
							<tbody>
								<tr> 
									<td style="width:17%; vertical-align:top; padding: 0px 3px 15px 3px;"> 
										<div id="left" style="width:100%;">
											<?php
											//$left=$_GET['left'];
											if (!empty($left))
											{
												include _DATA_PATH_.$left.'.php' ; 
											}  
											else {
												include _DATA_PATH_."1.php";
											}
											?>
										</div><!-- left -->
									</td>
									<td style="width:64%;  vertical-align:top; padding: 0px 0px 15px 20px; min-height:400px;">
										<div id="center" style="width:100%;">