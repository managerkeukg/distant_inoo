<?php
header('Content-Type: text/html; charset=utf-8');
if (isset($_COOKIE['id']) AND !empty($_COOKIE['id']))
{
	@header("Location:main/index.php");
}
if (isset($_POST) and !empty($_POST))
{
	require_once "../common_data/settings_variables.php";
	require_once "../common_data/config.php";
	require_once "../common_data/classes/ClassTableQuery.php";
	
	$login=htmlspecialchars(trim($_POST['login'])); 
	$password=htmlspecialchars(trim($_POST['password'])); 
	$password = mysql_real_escape_string ($password);
	$query = "SELECT * FROM  `"._TABLE_PREFIX_."students` WHERE  `username` = '".$login."' AND (`password`='".md5($password._PASSWORD_SALT_)."')  AND `status`='1';";
	$object_students = new TableQuery;
	$object_students -> order_by_field="id";
	$array_students = $object_students->query ($query);
	if (isset($array_students) AND !empty($array_students) AND is_array($array_students))
	{
		////echo "<pre> students count "; print_r(count($array_students)); echo "</pre>";
		////echo "<pre> students "; print_r($array_students); echo "</pre>";
	 
		foreach ($array_students as $value) { 
			setcookie("id",$value['id']);
			setcookie("name",$value['firstname']);
			setcookie("surname",$value['lastname']);
			@header("Location:main/index.php"); // @header("Location:".$_SERVER['HTTP_REFERER']);
		} 
	} else { 
		echo "<h3><p style=\"color:red;\">Пароль и Логин пользователя не соответствуют - </p></h3>";
	}
	echo "<p style=\"color:green;\"><b>Вход только для зарегистрированных пользователей <br>
		<br> Пожалуйста авторизуйтесь</b></p>";
}
?>
<table>
	<tr>
		<td width="200"></td>
		<td>
			<DIV  style="text-align:center; width:100%;">
				<form  name="login_form" action="" method="POST" >
				<table style="text-align:center;">
					<tr>
						<td><h3>Авторизация</h3></td>
					</tr>
					<tr>
						<td> 
							<table>
								<tr>
									<td>Логин</td>
									<td>
										<input type="text" name="login" value='<?php if (isset($_POST['login'])) {echo $_POST['login']; } else {}?>'></input>
									</td>
								</tr>
								<tr><td></td><td></td></tr>
								<tr>
									<td>Пароль</td>
									<td>
										<input type="password" name="password" value='<?php if (isset($_POST['login'])) {echo $_POST['password']; } else {}?>'></input>
									</td>
								</tr>
								<tr>
									<td></td>
									<td>
										<input type="button" name="password" value="Войти" onclick="this.form.submit()"></input>
									</td>
								</tr>
							</table>
						</td>
					</tr>
					<tr><td ></td></tr>
					<tr><td></td></tr>
				</table>
				</form>
			</DIV>
		</td>
		<td width="200"></td>
	</tr>
</table>