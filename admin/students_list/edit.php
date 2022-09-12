<?php 
require_once "../settings.php";
require_once _DATA_PATH_."top.php";

require_once _COMMON_DATA_PATH_."classes/ClassTableQuery.php";

user_access_module ("students_list");

is_int_obligatory ($_GET['id']);
$id=$_GET['id'];

echo "<h2>Редактирование</h2>";

$query="SELECT * FROM `"._TABLE_PREFIX_."students`  WHERE `id`='".$id."' AND (`status`='1')";
$object_students = new TableQuery;
$object_students -> order_by_field="id";
$array_students = $object_students->query ($query);
if (isset($array_students) AND !empty($array_students) AND is_array($array_students))
{
	////echo "<pre> students count "; print_r(count($array_students)); echo "</pre>";
	////echo "<pre> students "; print_r($array_students); echo "</pre>";
	foreach ($array_students as $value) {
		?>
		<div style="width=100%; margin-left:35px;"> 
		<form action="<?php echo "update.php?id=".$id."";?>" method="post">
		<table>
		<tr><td>Логин</td>
			<td><input type="text" id="username" name="username" size="100" value="<?php echo $value['username'];?>"></input></td></tr>
		<tr><td>Имя Отчество</td>
			<td><input type="text" id="firstname" name="firstname" size="100" value="<?php echo $value['firstname'];?>"></input> </td></tr>
		<tr><td>Фамилия</td>
			<td> <input type="text" id="lastname" name="lastname" size="100" value="<?php echo $value['lastname'];?>"></input> </td></tr>
		<tr><td>e-mail</td>
			<td><input type="text" id="email" name="email" value="<?php echo $value['email'];?>"></input></td></tr>
		<tr><td>Изменить пароль</td>
			<td><input type="checkbox" id="password_change_allow" name="password_change_allow" 
					   onclick="this.form.password.disabled = !this.checked; this.form.password_again.disabled = !this.checked; this.form.password_visible.disabled = !this.checked;"></td></tr>
		<tr><td>Пароль</td>
			<td><input type="password" id="password" name="password" disabled="disabled" value="<?php if (isset ($_POST['password'])) {echo $_POST['password']; }?>"></input></td></tr>
		<tr><td>Пароль (подтверждение)</td>
			<td><input type="password" id="password_again" name="password_again" disabled="disabled" value="<?php if (isset ($_POST['password_again'])) {echo $_POST['password_again']; }?>"></input></td></tr>
		<tr><td>Просмотр <br> паролей</td>
			<td><input type="checkbox" id="password_visible" name="password_visible" disabled="disabled" value="<?php if (isset ($_POST['password_visible'])) {echo $_POST['password_visible']; }?>"
					   onclick="if (this.checked==true) { document.getElementById('password').type='text'; document.getElementById('password_again').type='text';} 
							   if (this.checked==false) { document.getElementById('password').type='password'; document.getElementById('password_again').type='password';} 
							   "
					   ></input></td></tr>
					   
		<tr><td></td><td><input name="btnSubmit" type="submit" value="Изменить" 
			onclick="
			if(document.getElementById('username').value==0) {alert('Поле Логин пустое!'); return false; }
			if(document.getElementById('firstname').value==0) {alert('Поле Имя Отчество пустое!'); return false; }
			if(document.getElementById('lastname').value==0) {alert('Поле Фамилия пустое!'); return false; }
			if(document.getElementById('email').value==0) {alert('Поле email пустое!'); return false; }
			if(document.getElementById('password_change_allow').checked) {
			   if(document.getElementById('password').value==0) {alert('Поле Пароль пустое!'); return false; }
			   if(document.getElementById('password_again').value==0) {alert('Поле Пароль (подтверждение) пустое!'); return false; }
			   if(document.getElementById('password').value!= document.getElementById('password_again').value) {alert('Пароли не совпадают!'); return false; }
			}
			"
		></td></tr>
		</table>
		</form>
		</div>
		<?php	
	}
}
else {
	echo "<BR>К сожалению такого студента нету<BR>";
}

require_once _DATA_PATH_."bottom.php";
?>