<?php
require_once "../settings.php";
require_once _DATA_PATH_."top.php";

is_int_obligatory ($_GET['id']);
$id=$_GET['id'];
?>
<br>
<div style="width:100%; margin-left:35px;">
	<form action="lesson_insert.php?id=<?php echo $id; ?>" method="post">
		<table>
			<tr><td>Название урока</td>
				<td><input type="text" name="lesson_name" size="100"></input></td>
			</tr>
			<tr><td></td><td><input type="submit" value="Добавить урок"></input></td></tr>
		</table>
	</form>
</div>

<br>
<br>
<a href="index.php?discipline=<?php echo $id; ?>">Отменить</a>

<?php
require_once _DATA_PATH_."bottom.php";
?>