<?php
//error_reporting(E_ALL ^ E_DEPRECATED);
function convert_date_sql_to_rus($date)
{
	list($year, $month, $day) = split('[-]', $date);
	$date_array= array ($year, $month, $day);
	return $date_array;
}

/*$date="2010-03-20";  echo "<pre>"; print_r(convert_date_rus($date)); echo "</pre>";
$date_array=convert_date_rus($date);
echo $date_array[0];
*/
?>