<?php
require_once "../settings.php";
require_once _COMMON_DATA_PATH_."classes/ClassTableQuery.php"; 

require_once _FUNCTIONS_PATH_."ft_type_points.php";	
require_once _FUNCTIONS_PATH_."ft_type_points_gak.php";	
require_once _FUNCTIONS_PATH_."f_points_convert.php";

////echo "<pre>Points "; print_r(table_type_points()) ; echo "</pre>"; 
////echo "<pre>Points gak "; print_r(table_type_points_gak()) ; echo "</pre>"; 
$array_points = table_type_points();
/*
echo "<br>0-60 50 - ".convert_points (50, $array_points); 
echo "<br>60 - ".convert_points (60, $array_points); 
echo "<br>61-73 61 - ".convert_points (61, $array_points); 
echo "<br>73 - ".convert_points (73, $array_points); 
echo "<br>74-86 74 - ".convert_points (74, $array_points); 
echo "<br>85 - ".convert_points (85, $array_points); 
echo "<br>86 - ".convert_points (86, $array_points); 
echo "<br>87-100 87 - ".convert_points (87, $array_points); 
echo "<br>90 - ".convert_points (90, $array_points); 
exit;
*/
//phpinfo ();
if (isset($_POST['pdf_array']) AND !empty($_POST['pdf_array']))
{
	//echo "<pre>"; print_r($_POST['pdf_array']) ; echo "</pre>";
	$array=unserialize($_POST['pdf_array']);
	////echo "<pre>"; print_r($array) ; echo "</pre>"; exit;
	$header="";
	$header=$header.'<DIV style="padding-left:80px; padding-top:30px;">';
	$header=$header.'    <DIV style="text-align:center;"><h4>Кыргызский Экономический Университет им. М.Рыскулбекова</h4>';
	$header=$header.'       <h4>Институт Непрерывного Открытого Образования</h4>';
	$header=$header.'       <h4>Ведомость №__________ учёта текущей и итоговой успеваемости</h4>';
	$header=$header.'    </DIV>';
	$header=$header.'    <TABLE cellPadding="2" cellSpacing="0">';
	$header=$header.'      <TR>';
	$header=$header.'       <TD>Курс  <u></u></TD>';
	$header=$header.'       <TD>Дисциплина <u>'.$array['info']['coursename'].'</u></TD>';
	$header=$header.'      </TR>';
	$header=$header.'      <TR>';
	$header=$header.'       <TD>Семестр <u>'.$array['info']['semestr'].'</u></u></TD>';
	$header=$header.'       <TD>Преподаватель  <u>____________________________</u></TD>';
	$header=$header.'      </TR>';
	$header=$header.'      <TR>';
	$header=$header.'       <TD>Группа <u>'.$array['info']['group'].'</u></TD>';
	$header=$header.'       <TD>Подпись преподавателя: _________________</TD>';
	$header=$header.'      </TR>';
	$header=$header.'      <TR>';
	$header=$header.'       <TD>Дата  "____" _________________</TD>';
	$header=$header.'       <TD></TD>';
	$header=$header.'      </TR>';
	$header=$header.'    </TABLE>';

	// table head
	$table_head="";
	$table_head=$table_head.'  <TABLE border="1" cellPadding="2" cellSpacing="0" width="100%" align="center">';
	$table_head=$table_head.'   <TR>
							   <TD>No</TD>
							   <TD width="350px">ФИО студента</TD>
							   '.
							//'<TD>Зачётная <br> книжка</TD>
							   '<TD text-rotate="90" style="text-align:center;">1 модуль</TD>
							   <TD text-rotate="90" style="text-align:center;">2 модуль</TD>
							   <TD text-rotate="90" style="text-align:center;">Итог.  контроль</TD>
							   <TD text-rotate="90" style="text-align:center;">Доп. Баллы</TD>
							   <TD text-rotate="90" style="text-align:center;">Сумма Баллов</TD>
							   <TD style="text-align:center;">Оценка</TD>
							   <TD style="text-align:center;">Подпись <br> преп-я</TD>
							 </TR>
							   ';
	// Итоговый  контроль
	// Дополнительные Баллы
	// end table head

	// bottom 
	$bottom="";
	$bottom=$bottom.'<br><br>';
	$bottom=$bottom.'    <TABLE>';
	$bottom=$bottom.'     <TR><TD> Число студентов на экзамене </TD><TD></TD><TD>_______________</TD><TD></TD><TD> Не явилось</TD><TD>_______________</TD></TR>';
	$bottom=$bottom.'     <TR><TD> Из них получили: </TD><TD></TD><TD></TD><TD></TD><TD> Не допущено деканатом </TD><TD>_______________</TD></TR>';
	$bottom=$bottom.'     <TR><TD> '.$array_points[4]['name_ru'].' </TD><TD>('.$array_points[4]['from'].'-'.$array_points[4]['till'].')</TD><TD></TD><TD></TD><TD></TD><TD></TD></TR>';
	$bottom=$bottom.'     <TR><TD> '.$array_points[3]['name_ru'].' </TD><TD>('.$array_points[3]['from'].'-'.$array_points[3]['till'].')</TD><TD></TD><TD></TD><TD></TD><TD></TD></TR>';
	$bottom=$bottom.'     <TR><TD> '.$array_points[2]['name_ru'].' </TD><TD>('.$array_points[2]['from'].'-'.$array_points[2]['till'].')</TD><TD></TD><TD></TD><TD></TD><TD></TD></TR>';
	$bottom=$bottom.'     <TR><TD> '.$array_points[1]['name_ru'].' </TD><TD>('.$array_points[1]['from'].'-'.$array_points[1]['till'].')</TD><TD></TD><TD></TD><TD> Директор ИНОО </TD><TD>_______________</TD></TR>';
	$bottom=$bottom.'     </TABLE>';
	// end bottom


	unset($array['info']);
	/*
	$grade_best=$array['grades']['best'];
	$grade_good=$array['grades']['good'];
	$grade_enough=$array['grades']['enough'];
	$grade_bad=$array['grades']['bad'];
	*/
	$grade_best="";
	$grade_good="";
	$grade_enough="";
	$grade_bad="";
	unset($array['grades']);


	$html="";
	$html=$html.$header;
	$html=$html.$table_head;

	$number_students=count($array);
	$i="0"; $j="0";
	foreach ($array as $key => $value)
	{ 
		$i++; //foreach student
		$j++;
		$html=$html.'<TR>';
		//$html=$html.'<TD>'.$i.'</TD>';
		if ( 
			$i=='25' OR $i=='50' OR $i=='75' OR $i=='100' 
			OR $i=='125' OR $i=='150' OR $i=='175' OR $i=='200'
			OR $i=='225' OR $i=='250' OR $i=='275' OR $i=='300'
			OR $i=='325' OR $i=='350' OR $i=='375' OR $i=='400'
		)
		{  
			$html=$html.'<TD>'.$j.'</TD>';
			$j="0"; // reset
			foreach ($value as $key1 => $value1)
			{ 	 
				$html=$html.'<TD>'.$value1.'</TD>';
			}                
			//close page
			///*
			$html=$html.'</TR>';
			$html=$html.'</TABLE>'; // close table in $table_head
			$html=$html.$bottom;
			$html=$html.'</DIV>'; // close div in $header
			//*/
			if ($i==$number_students) 
			{ 
			}
			else {
				$html=$html.$header;
				$html=$html.$table_head;
				$html=$html.'<TR>';              
			}
			//*/
		} else {
			$html=$html.'<TD>'.$j.'</TD>';
			foreach ($value as $key1 => $value1)
			{  
				$html=$html.'<TD>'.$value1.'</TD>';
			}
			if ($i==$number_students) 
			{ 
				///*
				$html=$html.'</TR>';
				$html=$html.'</TABLE>'; // close table in $table_head
				$html=$html.$bottom;
				$html=$html.'</DIV>'; // close div in $header
				///*/
			}
			else {

			}
		}
     
		//$html=$html.'</TR>';
			  
	} //end  foreach student
	/*
	$html=$html.'</TABLE>';
	$html=$html.$bottom;
	$html=$html.'</DIV>';
	*/
	//echo $html; exit;
	require_once (_COMMON_DATA_PATH_."mpdf60/mpdf.php");
	//$mpdf=new mPDF('c'); 
	//Кодировка | Формат | Размер шрифта | Шрифт
	//Отступы:    слева | справа | сверху | снизу | шапка | подвал
	$mpdf= new mPDF('utf-8', 'A4', '10', 'Arial', 7, 7, 5, 5, 5, 5);
	$mpdf->charset_in = 'utf-8';
	$mpdf->WriteHTML($html);
	$mpdf->Output();
}
?>