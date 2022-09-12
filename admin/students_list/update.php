<?php 
require_once "../settings.php";
require_once _DATA_PATH_."top.php";

user_access_module ("students_list");

echo "<h2>Обновление</h2>";

require_once _FUNCTIONS_PATH_."f_exist_student.php";

is_int_obligatory ($_GET['id']);
$id=$_GET['id'];

$username=$_POST['username'];
$firstname=$_POST['firstname'];
$lastname=$_POST['lastname'];
$email=$_POST['email'];
$error="0"; $error_text="";
if (isset($_POST['password']) AND isset($_POST['password_again']))
{ 
	$password=htmlspecialchars(trim($_POST['password']));
	$password_again=htmlspecialchars(trim($_POST['password_again']));
	if ($password != $password_again) {$error="1"; $error_text=$error_text."<br>Пароль и подтверждение пароля не совпадают";} else {}
	$query_login=" password='".md5(trim($password)._PASSWORD_SALT_)."',";
}
$exist_username=exist_user($username);
if ($exist_username !="no" AND ($exist_username !=$id)) {
	$error_text=$error_text."<br />Пользователь с таким логином <p style=\"color:red;\">".$username."</p> существует, выберите другой логин &nbsp;";
	$error="1";
} else { }

if ($error=="0")
{
    $query="update `"._TABLE_PREFIX_."students` SET 
		username='".$username."',
		firstname='".$firstname."',
		lastname='".$lastname."',
	";
	if (isset($query_login) AND !empty($query_login)) {$query=$query.$query_login;}
	$query=$query." email='".$email."'  WHERE `id`='".$id."'";
	$cat = mysql_query($query);
	if($cat) 
	{ 
		echo "<HTML><HEAD>
			<META HTTP-EQUIV='Refresh' CONTENT='0; URL=index.php?#".$id."'>
			</HEAD></HTML>";
	} else {}
} else { 
	echo $error_text=$error_text."<br><br><a href=\"edit.php?id=".$id."\">Вернуться назад </a><br><br>";
}

require_once _DATA_PATH_."bottom.php";
?>