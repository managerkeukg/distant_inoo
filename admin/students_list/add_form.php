<?php 
require_once "../settings.php";
require_once _DATA_PATH_."top.php";
?>

<div style="width=100%; margin-left:35px;"> 
<FORM action="<?php echo "insert.php";?>" method="POST">
	<table>
		<tr><td>Логин</td>
			<td><input type="text" id="username" name="username" size="100" value="<?php if (isset ($_POST['username'])) {echo $_POST['username']; }?>"></input></td></tr>
		<tr><td>Имя Отчество</td>
			<td><input type="text" id="firstname" name="firstname" size="100" value="<?php if (isset ($_POST['firstname'])) {echo $_POST['firstname']; }?>"></input> </td></tr>
		<tr><td>Фамилия</td>
			<td> <input type="text" id="lastname" name="lastname" size="100" value="<?php if (isset ($_POST['lastname'])) {echo $_POST['lastname']; }?>"></input> </td></tr>
		<tr><td>e-mail</td>
			<td><input type="text" id="email" name="email" value="<?php if (isset ($_POST['email'])) {echo $_POST['email']; }?>"></input></td></tr>
		<tr><td>Пароль</td>
			<td><input type="password" id="password" name="password" value="<?php if (isset ($_POST['password'])) {echo $_POST['password']; }?>"></input></td></tr>
		<tr><td>Пароль (подтверждение)</td>
			<td><input type="password" id="password_again" name="password_again" value="<?php if (isset ($_POST['password_again'])) {echo $_POST['password_again']; }?>"></input></td></tr>
		<tr><td>Просмотр <br> паролей</td>
			<td><input type="checkbox" id="password_visible" name="password_visible"  value="<?php if (isset ($_POST['password_visible'])) {echo $_POST['password_visible']; }?>"
					   onclick="if (this.checked==true) { document.getElementById('password').type='text'; document.getElementById('password_again').type='text';} 
							   if (this.checked==false) { document.getElementById('password').type='password'; document.getElementById('password_again').type='password';} 
							   "
					   ></input>
			</td>
		</tr>
		<tr><td></td>
			<td><input type="submit" value="Зарегистрировать студента"
				onclick="
				if(document.getElementById('username').value==0) {alert('Поле Логин пустое!'); return false; }
				if(document.getElementById('firstname').value==0) {alert('Поле Имя Отчество пустое!'); return false; }
				if(document.getElementById('lastname').value==0) {alert('Поле Фамилия пустое!'); return false; }
				if(document.getElementById('email').value==0) {alert('Поле email пустое!'); return false; }
				if(document.getElementById('password').value==0) {alert('Поле Пароль пустое!'); return false; }
				if(document.getElementById('password_again').value==0) {alert('Поле Пароль (подтверждение) пустое!'); return false; }
				if(document.getElementById('password').value!= document.getElementById('password_again').value) {alert('Пароли не совпадают!'); return false; }
				">
			</td>
		</tr>
	</table>
</FORM>
</div>
<?php
require_once _DATA_PATH_."bottom.php";
?>