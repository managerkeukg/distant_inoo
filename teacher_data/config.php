<?php
  $dblocation = "localhost";
  $dbname = "distant_inoo"; // user1631_d
  $dbuser = "root";  // user1631_d
  $dbpasswd = "";

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
