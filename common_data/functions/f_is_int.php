<?php
function is_int_obligatory ($variable) 
{
	if (isset($variable) AND !empty($variable)) {
		if  (!empty($variable)) 
		{ 
			if(!preg_match("|^[\d]+$|", $variable)) { 
				exit("Недопустимый формат URL-запроса."); 
			} 
		}	
	} else {
		exit("Недопустимый формат URL-запроса.");
	}	 
}

function is_int_ ($variable) 
{
	if (isset($variable) AND !empty($variable)) {
		if  (!empty($variable)) 
		{ 
			if(!preg_match("|^[\d]+$|", $variable)) { 
				exit("Недопустимый формат URL-запроса."); 
			} 
		}	
	} else {}	 
}

function is_obligatory ($variable) 
{
	if (isset($variable) AND !empty($variable)) {
     
	} else {
		exit("Недопустимый формат URL-запроса.");
	}	 
}
?>