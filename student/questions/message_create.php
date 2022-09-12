<?php
require_once "../settings.php";
require_once _DATA_PATH_."top.php";

require_once _COMMON_DATA_PATH_."classes/ClassTableQuery.php"; 

$query = "SELECT * FROM `"._TABLE_PREFIX_."staff`
            WHERE  `status`='1';";
$object_staff= new tableQuery;

$object_staff->order_by_field="id";
$array_staff=$object_staff -> query ($query);
if (isset($array_staff) AND !empty($array_staff)) {
	////echo count($array_staff)." записей";
	////echo "<pre>staff "; print_r($array_staff); echo "</pre>"; 
}			
?>

<h3>Отправка сообщений</h3>
<form id="myForm" action="message_new_update.php" method="POST">
<table style="width:100%;">
    <tr>
		<td width="160">
			Задать вопрос:
		</td>
		<td>
			<select id="id_staff" name="id_staff" style="width:100%">
				<?php 
				if (!empty($array_staff)) {
					foreach ($array_staff as $key => $value) 
					{
						echo "<option value=\"".$key."\" style=\"background-image:url('"._UPLOADS_PATH_."images/staff/".$value['photo']."');\" > ".$value['duty']." ".$value['degree']." ".$value['surname']." ".$value['name']." ".$value['patronymic']."</option>";
					}
				}
				?>
			</select>
		</td>
	</tr>
	<tr>
		<td width="160">
			Тема сообщения:
		</td>
		<td>
			<input id="msg_theme" name="msg_theme" style="width:100%">
		</td>
	</tr>
	<tr>
		<td style="width:160; vertical-align:top;">
			Сообщение:
		</td>
		<td>
			<textarea id="msg" name="msg" style="width:100%" rows="5"></textarea>
		</td>
	</tr>		
	<tr>
		<td width="160">
			&nbsp;
		</td>
		<td>
			<input id="btn" type="submit" value="Отправить сообщение" >
			<input  type="reset" name="reset" value="Сбросить данные" >
			
		</td>
	</tr>
	<tr>
		<td width="160">
			&nbsp;
		</td>
		<td>
			<input type="button" value="Отменить" onClick="history.back()">
		</td>
	</tr>
</table>
</form>

<script src="<?php echo _ROOT_PATH_;?>js/check_empty_value.js"></script>	
<?php
require_once _DATA_PATH_."bottom.php";
?>
