<?php
header('Content-Type: text/html; charset=utf-8');
require_once "common_data/functions/f_is_int.php";

if (isset($_GET['show']))
{
	is_int_($_GET['show']);
	$show=$_GET['show'];
}

$head_settings = file_get_contents("head.xml");
$head_xml = simplexml_load_string($head_settings);
?>
<!DOCTYPE html>
<html lang="ru">
<head>
	<?php 
	echo "<title>".$head_xml->title."</title>"; 
	echo "<meta name=\"description\" content=\"".$head_xml->title."\"/>"; 
	echo "<meta name=\"keywords\" content=\"".$head_xml->title."\"/>"; 
	?>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"> <!-- ; charset=UTF-8 --> 
	<link href="css/main.css" rel="stylesheet">
	<link href="css/distant.css" rel="stylesheet">
	<link href="css/template_default.css" rel="stylesheet">
	<link href="css/menu_15.css" rel="stylesheet">
	<link href="css/consult.css" rel="stylesheet">
</head>
<body>
    <div id="all">
    <div id="wrapper">
		<div id="header">
			<div class="separador"></div>
			<?php include "header.php"; ?>
			<div class="separador"></div>
			<div style="text-align:left;">
				<p style="color:blue; font-size:10px;"> 
					<a href="index.php">Главная страница</a>&nbsp;»&nbsp;&nbsp;&nbsp;&nbsp;
				</p>
				<div class="separador"></div>
			</div>
			<marquee behavior="scroll" direction="left">
				<span style="color:#f25100; font-size:10px;">
					<?php include "marquee.php";?> 
				</span>
			</marquee>
			
		</div><!-- end header -->
        
		<div id="content">
			<div id="left">
				<?php
				include "1.php";
				?>
			</div><!-- left -->

			<div id="center">
				<?php
				if (!empty($show))
				{  			                      
					if (file_exists($show.'.php')) { include $show.'.php' ;} else { include "2.php"; }
				}
				else { 
					include "2.php";
				}
				?>
			</div><!-- center -->
			
			<div id="right">
				<?php
				include "3.php";
				?>
			</div><!-- right -->
			<div id="footer">
				<?php include "footer.php"; ?>
			</div>
		</div > <!--id="content" -->
    </div>	<!-- wrapper -->
	</div><!-- all -->
</body>
</html>