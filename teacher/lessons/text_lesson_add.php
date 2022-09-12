<?php
require_once "../settings.php";
require_once _DATA_PATH_."top.php";

$id=$_GET['id'];
$id_l=$_GET['id_l'];
?>
<html>
<head>
	<script type="text/javascript" src="<?php echo _COMMON_DATA_PATH_;?>ckeditor/ckeditor.js"></script>
	<link href="<?php echo _ROOT_PATH_;?>css/calendar.css" rel="stylesheet">	
    <script type="text/javascript" src="<?php echo _ROOT_PATH_;?>js/jquery.js"></script>
    <script type="text/javascript" src="<?php echo _ROOT_PATH_;?>js/ui.datepicker.js"></script>
</head>
<body>
<div style="width=100%; margin-left:35px;">
	<form action="text_lesson_insert.php?id=<?php echo $id; ?>&id_l=<?php echo $id_l; ?>" method="post">
		<table>
			<tr><td>Тема урока</td>
				<td><input type="text" id="theme_name" name="theme_name" size="100"></input></td></tr>
			<tr><td>Текст урока</td>
				<td>
				<textarea id="editor1" name="editor1" cols="100%" rows="20">
				</textarea>
				</td>
			</tr>
			<script type="text/javascript" src="<?php echo _ROOT_PATH_;?>js/ckeditor_replace.js"></script>
			<tr><td></td><td><input type="submit" value="Добавить текстовой урок" 
			onclick="
			if(document.getElementById('theme_name').value==0) {alert('Поле Тема урока пустое!'); return false; }
			if(document.getElementById('editor1').value==0) {alert('Поле Текст урока пустое!'); return false; }
			"
			></input></td></tr>
		</table>
	</form>
</div>

</body>
</html>
<?php
require_once _DATA_PATH_."bottom.php";
?>