<?php
foreach ($array_webinar_files_youtube[$value['id']] as $array) {
	?>
	<DIV class="webinar_video">
		<?php
		//echo "<pre>"; print_r($array); echo "<pre>";
		//echo "<pre>"; print_r($value); echo "<pre>";
		///*
		if (!empty($array)) {
			?>
			<iframe width="360" height="270"
				src="https://www.youtube.com/embed/<?php echo $array; ?>">
			</iframe>
			<?php
		}
		//*/
		?>
	</DIV>
	<?php		
}
?>	