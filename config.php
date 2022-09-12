<?php
  // Адрес сервера MySQL
  $dblocation = "mysql";
  // Имя базы данных, на хостинге или локальной машине
  $dbname = "user13092_distant"; // user1631_d
  // Имя пользователя базы данных
  $dbuser = "user13092_d";  // user1631_d
  // и его пароль
  $dbpasswd = "ILvahbcZtZbktpUN";

  $dbcnx = @mysql_connect($dblocation, $dbuser, $dbpasswd);
  if (!$dbcnx)
  {
    exit ("<P>В настоящий момент сервер базы данных не доступен, поэтому
              корректное отображение страницы невозможно.</P>" );
  }
  if (!@mysql_select_db($dbname, $dbcnx))
  {
    exit( "<P>В настоящий момент база данных не доступна, поэтому
              корректное отображение страницы невозможно.</P>" );
  }
  @mysql_query("SET NAMES 'utf8'"); // cp1251
?>
