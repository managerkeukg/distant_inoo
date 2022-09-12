<?php
require_once "../settings.php";
require_once _COMMON_DATA_PATH_."classes/ClassTableQuery.php"; 

require_once _FUNCTIONS_PATH_."ft_type_points.php";	
require_once _FUNCTIONS_PATH_."ft_type_points_gak.php";	
require_once _FUNCTIONS_PATH_."f_points_convert.php";

////echo "<pre>Points "; print_r(table_type_points()) ; echo "</pre>"; 
////echo "<pre>Points gak "; print_r(table_type_points_gak()) ; echo "</pre>"; 
$array_points_gak = table_type_points_gak();
/*
echo "<br>0-49 49 - ".convert_points (49, $array_points_gak); 
echo "<br>50 - ".convert_points (50, $array_points_gak); 
echo "<br>50-69 51 - ".convert_points (51, $array_points_gak); 
echo "<br>69 - ".convert_points (69, $array_points_gak); 
echo "<br>70-84 70 - ".convert_points (70, $array_points_gak); 
echo "<br>85 - ".convert_points (85, $array_points_gak); 
echo "<br>84 - ".convert_points (84, $array_points_gak); 
echo "<br>85-100 85 - ".convert_points (85, $array_points_gak); 
echo "<br>90 - ".convert_points (90, $array_points_gak); 
exit;
*/
//phpinfo ();
if (isset($_POST['pdf_gak_array']) AND !empty($_POST['pdf_gak_array']))
{
	//echo "<pre>"; print_r($_POST['pdf_gak_array']) ; echo "</pre>";
	$array=unserialize($_POST['pdf_gak_array']);
	///echo "<pre>"; print_r($array) ; echo "</pre>"; exit;
	$header="";
	$header=$header.'<DIV style="padding-left:80px; padding-top:30px;">';
	$header=$header.'    <DIV style="text-align:center;">';
	$header=$header.'    	<h4>МИНИСТЕРСТВО  ОБРАЗОВАНИЯ  И  НАУКИ КЫРГЫЗСКОЙ РЕСПУБЛИКИ</h4>';
	$header=$header.'       <h4>Кыргызский Экономический Университет им. М.Рыскулбекова</h4>';
	$header=$header.'       <h4>Институт Непрерывного Открытого Образования</h4>';
	$header=$header.'       <h4>Ведомость ГАК</h4>';
	$header=$header.'    </DIV>';
	$header=$header.'    <TABLE cellPadding="2" cellSpacing="0">';
	$header=$header.'      <TR>';
	$header=$header.'       <TD>Группа <u>'.$array['info']['group'].'</u></TD>';
	$header=$header.'       <TD>Дисциплина <u>'.$array['info']['coursename'].'</u></TD>';
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
								   <TD width="30px">No</TD>
								   <TD width="350px">ФИО студента</TD>
								   <TD style="text-align:center;">Баллы</TD>
								   <TD style="text-align:center;">Оценка</TD>
								 </TR>
								   ';
	// Итоговый  контроль
	// Дополнительные Баллы
	// end table head

	// bottom 
	$bottom="";
	$bottom=$bottom.'<br><br><br>';
	$bottom=$bottom.'    <TABLE style="padding-bottom:50px;">';
	$bottom=$bottom.'     	<TR>
								<TD> Число студентов на экзамене </TD>
								<TD></TD>
								<TD>_______________</TD>
								<TD></TD>
								<TD> Не допущено деканатом</TD>
								<TD>_______________</TD>
							</TR>';
	$bottom=$bottom.'     <TR><TD> '.$array_points_gak[4]['name_ru'].' </TD><TD>('.$array_points_gak[4]['from'].'-'.$array_points_gak[4]['till'].')</TD><TD></TD><TD></TD><TD>Председатель ГАК</TD><TD>_______________</TD></TR>';
	$bottom=$bottom.'     <TR><TD> '.$array_points_gak[3]['name_ru'].' </TD><TD>('.$array_points_gak[3]['from'].'-'.$array_points_gak[3]['till'].')</TD><TD></TD><TD></TD><TD>Технический секретарь </TD><TD>_______________</TD></TR>';
	$bottom=$bottom.'     <TR><TD> '.$array_points_gak[2]['name_ru'].' </TD><TD>('.$array_points_gak[2]['from'].'-'.$array_points_gak[2]['till'].')</TD><TD></TD><TD></TD><TD>Члены ГАК</TD><TD>_______________</TD></TR>';
	$bottom=$bottom.'     <TR><TD> '.$array_points_gak[1]['name_ru'].' </TD><TD>('.$array_points_gak[1]['from'].'-'.$array_points_gak[1]['till'].')</TD><TD></TD><TD></TD><TD>  </TD><TD>_______________</TD></TR>';
	$bottom=$bottom.'     <TR><TD>  </TD><TD></TD><TD></TD><TD></TD><TD>  </TD><TD>_______________</TD></TR>';
	$bottom=$bottom.'     <TR><TD>  </TD><TD></TD><TD></TD><TD></TD><TD>  </TD><TD>_______________</TD></TR>';
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
				$html=$html.'<TD style="padding-left:5px;"> '.$value1.' </TD>';
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
	require_once (_ROOT_PATH_."common_data/mpdf60/mpdf.php");
	//$mpdf=new mPDF('c'); 
	//Кодировка | Формат | Размер шрифта | Шрифт
	//Отступы:    слева | справа | сверху | снизу | шапка | подвал
	$mpdf= new mPDF('utf-8', 'A4', '10', 'Arial', 7, 7, 5, 5, 5, 5);
	$mpdf->charset_in = 'utf-8';
	$mpdf->WriteHTML($html);
	$mpdf->Output();
}
?>