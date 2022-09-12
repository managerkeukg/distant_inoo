<?php 
require_once "../settings.php";
require_once _DATA_PATH_."top.php";
require_once _COMMON_DATA_PATH_."classes/ClassDataTable.php"; 
require_once _COMMON_DATA_PATH_."classes/ClassTableQuery.php"; 

user_access_module ("access");

is_int_obligatory ($_GET['id']);
$id=$_GET['id'];

echo "<h2>Модули Пользователя</h2>";

$query = "SELECT * FROM `"._TABLE_PREFIX_._USER_PREFIX_."_access_user_permissions`
    WHERE `user` = '".$id."' AND `status`='1';";
$object_user_permissions = new TableQuery;
$object_user_permissions -> order_by_field="id";
$array_user_permissions = $object_user_permissions->query ($query);
if (isset($array_user_permissions) AND !empty($array_user_permissions) AND is_array($array_user_permissions))
{
	////echo "<pre> user_permissions count "; print_r(count($array_user_permissions)); echo "</pre>";
	////echo "<pre> user_permissions "; print_r($array_user_permissions); echo "</pre>";
	$user_permissions = array ();
	foreach ($array_user_permissions as $value) {
		$user_permissions[$value['module']] [$value['permission']]=$value['permission'];
	}
	////echo "<pre>user permissions  (module permission permission)"; print_r($user_permissions) ; echo "</pre>";
}

$query="SELECT * from `"._TABLE_PREFIX_._USER_PREFIX_."_access_modules` WHERE `status`='1';";
$object_access_modules = new TableQuery;
$object_access_modules -> order_by_field="id";
$array_access_modules = $object_access_modules->query ($query);
if (isset($array_access_modules) AND !empty($array_access_modules) AND is_array($array_access_modules))
{
	////echo "<pre> access_modules count "; print_r(count($array_access_modules)); echo "</pre>";
	////echo "<pre> access_modules "; print_r($array_access_modules); echo "</pre>";
	?>
	<FORM action="save.php" method="POST">
	<table class="table_default">
		<thead>
			<tr class="tr_head">
				<th>Номер</th>
				<th>Название модуля</th>
				<th>Путь</th>
				<th>ВСЕ</th>
				<th>Просмотр</th>
				<th>Скрытие/Открытие</th>
				<th>Добавление</th>
				<th>Редактирование</th>
				<th>Удаление</th>
			</tr>
		</thead>
		<tbody>
	<?php
	foreach ($array_access_modules as $value) {
		?>
		<TR>
		<TD><?php echo $value['id']; ?></TD>
		<TD><?php echo $value['name']; ?></TD>
		<TD><?php echo $value['path']; ?></TD>
		<TD><INPUT type="checkbox"  name="<?php echo $value['id']; ?>_1"  <?php if ($user_permissions[$value['id']] [1]==1) { echo "checked";} ?> ></INPUT></TD>
		<TD><INPUT type="checkbox"  name="<?php echo $value['id']; ?>_2"  <?php if ($user_permissions[$value['id']] [2]==2) { echo "checked";} ?> ></INPUT></TD>
		<TD><INPUT type="checkbox"  name="<?php echo $value['id']; ?>_3"  <?php if ($user_permissions[$value['id']] [3]==3) { echo "checked";} ?> ></INPUT></TD>
		<TD><INPUT type="checkbox"  name="<?php echo $value['id']; ?>_4"  <?php if ($user_permissions[$value['id']] [4]==4) { echo "checked";} ?>></INPUT></TD>
		<TD><INPUT type="checkbox"  name="<?php echo $value['id']; ?>_5"  <?php if ($user_permissions[$value['id']] [5]==5) { echo "checked";} ?>></INPUT></TD>
		<TD><INPUT type="checkbox"  name="<?php echo $value['id']; ?>_6"  <?php if ($user_permissions[$value['id']] [6]==6) { echo "checked";} ?>></INPUT></TD>
		</TR>
		<?php
	}  
	?>
		<TR>
			<TD></TD>
			<TD><INPUT type="submit" value="Сохранить"></INPUT></TD>
			<TD></TD>
			<TD></TD>
			<TD></TD>
			<TD></TD>
			<TD></TD>
			<TD></TD>
		</TR>
	</tbody>
	</table>
	<INPUT type="hidden" name="user" value="<?php echo $id; ?>"></INPUT>
	</FORM>
	<?php			
} else {
	echo "No module exists.";	
}

require_once _DATA_PATH_."bottom.php";
?>