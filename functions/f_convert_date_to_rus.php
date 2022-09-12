<?php
function convert_date_rus (&$date_input) {
	$dt = $date_input; // Присвоение переменной $dt значения поля datetime из базы blogg
	$yy = substr($dt,0,4); // Год
	$mm = substr($dt,5,2); // Месяц
	$dd = substr($dt,8,2); // День 
	if ($mm == "01") $mm1="января";
	if ($mm == "02") $mm1="февраля";
	if ($mm == "03") $mm1="марта";
	if ($mm == "04") $mm1="апреля";
	if ($mm == "05") $mm1="мая";
	if ($mm == "06") $mm1="июня";
	if ($mm == "07") $mm1="июля";
	if ($mm == "08") $mm1="августа";
	if ($mm == "09") $mm1="сентября";
	if ($mm == "10") $mm1="октября";
	if ($mm == "11") $mm1="ноября";
	if ($mm == "12") $mm1="декабря";
	if (!empty($dd) and !empty($mm1) and !empty($yy))
	{ $ddtt = $dd." ".$mm1." ".$yy." г."; return $ddtt;} // Конечный вид строки
}
?>