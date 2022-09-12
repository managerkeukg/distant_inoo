<?php
error_reporting(E_ALL ^ E_DEPRECATED);
function convert_date_rus_to_sql($date)
{
	list($day, $month, $year ) = split('[.]', $date);
	$date_array= array ($day, $month, $year);
	return $date_array;
}

/*
$date="27.03.2020";  echo "<pre>"; print_r(convert_date_sql($date)); echo "</pre>";
$date_array=convert_date_sql($date);
echo $date_array[0]."".$date_array[1]."".$date_array[2];
*/
?>