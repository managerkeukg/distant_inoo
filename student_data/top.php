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
<?php
$head_settings = file_get_contents(_ROOT_PATH_."head.xml");
$head_xml = simplexml_load_string($head_settings);
echo "<title>".$head_xml->title."</title>"; 
echo "<meta name=\"description\" content=\"".$head_xml->title."\"/>"; 
echo "<meta name=\"keywords\" content=\"".$head_xml->title."\"/>"; 
?>
</head>
<link href="<?php echo _ROOT_PATH_;?>css/main.css" rel="stylesheet">
<link href="<?php echo _ROOT_PATH_;?>css/header.css" rel="stylesheet">
<link href="<?php echo _ROOT_PATH_;?>css/consult.css" rel="stylesheet">
<link href="<?php echo _ROOT_PATH_; ?>css/distant.css" rel="stylesheet">
<link href="<?php echo _ROOT_PATH_;?>css/base0000.css" rel="stylesheet">
<link href="<?php echo _ROOT_PATH_;?>css/buttons0.css" rel="stylesheet">
<link href="<?php echo _ROOT_PATH_;?>css/css00000.css" rel="stylesheet">
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
			<div style="text-align:left;">
				<p style="color:blue;" >
					<a href="../main/">Главная страница</a>&nbsp;»&nbsp;&nbsp;&nbsp;&nbsp;
				</p>
				<marquee behavior="scroll" direction="left">
					<span style="color:#f25100">
						<?php require_once _ROOT_PATH_."marquee.php";?> 
					</span>
				</marquee>
			</div>
		</div><!-- end header -->
		<div>
			<?php
			require_once _FUNCTIONS_PATH_."f_iden_group_of_student.php";
			require_once _FUNCTIONS_PATH_."f_group_name.php";
			define( '_USER_GROUP_', identify_group_of_student(trim(_ID_USER_)));
			$student_group = _USER_GROUP_;
			define( '_USER_GROUP_NAME_', identify_group_name(_USER_GROUP_));
			?>
			<form action='../logout.php' method="post">
				<table style="text-align:center; background-color:#023183; font-size:100%; width:100%;">
					<tbody>
					<tr>
						<td style="text-align:left;"  >
							<?php
							 
								?>
								<h2 style="color:white;"><b><?php echo "Ваша группа "._USER_GROUP_NAME_;?></b></h2>
								<?php
							
							?>
							<h2 style="color:white;"><b><?php echo _ID_USER_."  ".USER_FIRST_NAME ."  ".USER_LAST_NAME ;?></b></h2>
						</td>
						<td style="padding-right: 7px">
			   				<input style="font: 11px Arial, Helvetica, sans-serif" type="submit" value="Выход" name="exit"></input>
						</td>
					</tr>
					</tbody>
				</table>
			</form>
			<?php require_once "menu.php"; ?>
		</div>
		
		<div id="content">
			<div id="center" style="width:100%; min-height:400px;">
				<table ><tbody>
					<tr> 
						<td style="width:5%; vertical-align:top; padding:0px 3px 15px 3px;"> 
							
						</td>
						<td  style="width:64%; min-height:400px; vertical-align:top; padding:0px 0px 15px 20px;">