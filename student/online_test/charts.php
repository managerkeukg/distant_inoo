<?php
		$chart_line_series="";  
		$chart_line_categories = "";
		$i=0;
		foreach ($answer_array as $key => $value) {
			$i++;
			if ($answer_array[$key]==$correct_array[trim($array_questions[$key-1])]) 
			{ 
				$zn= "1"; $true++; 
			} else {
				$zn= "0"; $false++;
			}
			if ($i==1) {
				$chart_line_series .= "".$zn."";
				$chart_line_categories .= "'".$i."'";
			} else {
				$chart_line_series .= ", ".$zn."" ;
				$chart_line_categories .= ", '".$i."'";
			}
		}
		echo "<br>chart_line_categories - ".$chart_line_categories;
		echo "<br>chart_line_series - ".$chart_line_series;
		
		$array_error_warnings = array ();
		function if_file_exists ($file_path, $array){
			
			if (file_exists($file_path)) {
				
			} else {
				$array[]="File does not exists - ".$file_path;
			}
			////echo "<pre> array_error_warnings "; print_r($array_error_warnings); echo "</pre>";
			return $array;
		}
		
		$array_error_warnings = if_file_exists (_ROOT_PATH_."js/jquery.min.js", $array_error_warnings);
		$array_error_warnings = if_file_exists (_ROOT_PATH_."js/chart_line.js", $array_error_warnings);
		$array_error_warnings = if_file_exists (_ROOT_PATH_."js/highcharts.js", $array_error_warnings);
		$array_error_warnings = if_file_exists (_ROOT_PATH_."js/exporting.js", $array_error_warnings);
		$array_error_warnings = if_file_exists (_ROOT_PATH_."js/chart_pie.js", $array_error_warnings);
		
		if (!empty($array_error_warnings)) {
			////
			echo "<pre> array_error_warnings "; print_r($array_error_warnings); echo "</pre>";
		}
		
		?>
		<script type="text/javascript" src="<?php echo _ROOT_PATH_;?>js/jquery.min.js"></script> 
		<script src="<?php echo _ROOT_PATH_;?>js/highcharts.js"></script> 
		<script type="text/javascript" src="<?php echo _ROOT_PATH_;?>js/chart_line.js"></script>
		<script src="<?php echo _ROOT_PATH_;?>js/exporting.js"></script> 
	 
		<div id="line_chart_container" style="min-width: 800px; height: 400px; margin: 0 auto" width="100%"></div> 
		1- Правильно            0- Неправильно  &nbsp;&nbsp;&nbsp;&nbsp; <?php echo "Правильных ответов   ".$true;  echo  "   Неправильных ответов  ".$false; ?>
		<!-- -->
		<hr>
		<script type="text/javascript" src="<?php echo _ROOT_PATH_;?>js/chart_pie.js"></script>
		<div id="pie_chart" style="min-width: 800px; height: 400px; margin: 0 auto"></div>
		<?php