<?php
header('Content-Type: text/html; charset=utf-8');
if (isset($_COOKIE['id']) AND !empty($_COOKIE['id']))
{
	@header("Location:main/index.php");
}
if (isset($_POST) and !empty($_POST))
{
	require_once "../kel_data_admin/config.php";
	require_once "../common_data/classes/ClassTableQuery.php";
	$login=htmlspecialchars(trim($_POST['login'])); $password=htmlspecialchars(trim($_POST['password'])); 
	$password = mysql_real_escape_string ($password);
	$query = "SELECT * FROM  `inoo_admin` WHERE  `login` = '".$login."' AND (`password`='".$password."')";
	$object_admin = new TableQuery;
	$object_admin -> order_by_field="id";
	$array_admin = $object_admin->query ($query);
	if (isset($array_admin) AND !empty($array_admin) AND is_array($array_admin))
	{
		////echo "<pre> admin count "; print_r(count($array_admin)); echo "</pre>";
		////echo "<pre> admin "; print_r($array_admin); echo "</pre>";
		foreach ($array_admin as $value) { 
			setcookie("id",$value['id']);
			setcookie("name",$value['name']);
			setcookie("surname",$value['surname']);
			@header("Location:main/index.php"); // @header("Location:".$_SERVER['HTTP_REFERER']);
		} 
	}  else { 
		echo "<h3><p color=red>Пароль и Логин пользователя не соответствуют - </p></h3>";
	}
	echo "<p color=green size=3><b>Вход только для зарегистрированных пользователей <br>
	<br> Пожалуйста авторизуйтесь</b></p>";
}
?>
<table>
	<tr>
		<td style="width:200px"></td>
		<td>
			<div  style="width:100%; text-align:center;" >
				<form  name="login_form" action="" method="POST" >
					<table  style="text-align:center; border:0px solid silver" >
						<tr><td ><h3>Авторизация</h3>
						   <!-- text -->
							</td></tr>
						<tr>
							<td > 
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
		<td style="width:200px"></td>
	</tr>
</table>