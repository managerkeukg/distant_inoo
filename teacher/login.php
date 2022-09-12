<?php
header('Content-Type: text/html; charset=utf-8');
if (isset($_COOKIE['id']) AND !empty($_COOKIE['id']))
{
	@header("Location:main/index.php");
}
if (isset($_POST) and !empty($_POST))
{
	require_once "../common_data/config.php";
	require_once "../common_data/classes/ClassTableQuery.php";
	$login=htmlspecialchars(trim($_POST['login'])); 
	$password=htmlspecialchars(trim($_POST['password'])); 
	$password = mysql_real_escape_string ($password);
	$query = "SELECT * FROM  `inoo_teachers` WHERE  `login` = '".$login."' AND (`password`='".$password."')  AND `status`='1';";
	$object_teachers = new TableQuery;
	$object_teachers -> order_by_field="id";
	$array_teachers = $object_teachers->query ($query);
	if (isset($array_teachers) AND !empty($array_teachers) AND is_array($array_teachers))
	{
		////echo "<pre> teachers count "; print_r(count($array_teachers)); echo "</pre>";
		////echo "<pre> teachers "; print_r($array_teachers); echo "</pre>";
		foreach ($array_teachers as $value) {
			setcookie("id",$value['id']);
			setcookie("name",$value['name']);
			setcookie("surname",$value['surname']);
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
			<div style="width:100%; text-align:center;">
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
			</div>
		</td>
		<td width="200"></td>
	</tr>
</table>