<?php 
require_once "../settings.php";
require_once _DATA_PATH_."top.php";

require_once _FUNCTIONS_PATH_."f_exist_student.php";

user_access_module ("students_list");

//if(isset($_POST)) {echo "<pre>"; print_r($_POST); echo "</pre>";}
$username=htmlspecialchars(trim($_POST['username']));
$firstname=htmlspecialchars(trim($_POST['firstname']));
$lastname=htmlspecialchars(trim($_POST['lastname']));
$email=htmlspecialchars(trim($_POST['email']));
$password=htmlspecialchars(trim($_POST['password']));
$password_again=htmlspecialchars(trim($_POST['password_again']));
if (exist_user($username) !="no") 
{
	echo  "<br />Пользователь с таким логином <p style=\"color:red;\">".$username."</p> существует, выберите другой логин &nbsp;";
    echo "<br><br><a href=\"add_form.php\">Вернуться назад </a><br><br>";
} else { 
    if ($password==$password_again) 
    {
		$query = "INSERT INTO `"._TABLE_PREFIX_."students` (id,  username, password, firstname, lastname, email, status)
			VALUES (
				NULL,
				'".$username."',
				'".md5(trim($password)._PASSWORD_SALT_)."',
				'".trim($firstname)."',
				'".trim($lastname)."',
				'".$email."',
				'1'
			)";
		if(mysql_query($query))
		{ 
			echo "<HTML><HEAD>
            <META HTTP-EQUIV='Refresh' CONTENT='0; URL=index.php'>
            </HEAD></HTML>";
		} else {}
    }
    else { 
		echo "Пароль и подтверждение пароля не совпадают";
        echo "<br><a href=\"add_form.php\">Назад</a>";
    }
}

require_once _DATA_PATH_."bottom.php";
?>