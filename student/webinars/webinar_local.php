<?php
$m="0";
foreach ($array_webinar_files[$value['id']] as $array) {
	?>
	<DIV class="webinar_video">
		<!--
		<div id="player<?php echo $array['id']; ?>_vod"> Возможно ваш браузер не поддерживает flash.</div>
		<script type='text/javascript'>
			var so = new SWFObject('js/player.swf','mpl','320','240','8');
			so.addParam('allowfullscreen','true');
			so.addParam('flashvars','file='+'<?php echo $array['id'];?>'+'.mp4&provider=rtmp&streamer=rtmp://178.217.173.109:1935/vod/mp4:'+'<?php echo $array['id'];?>'+'.mp4'); 
			so.write('player'+'<?php echo $array['id'];?>'+'_vod');
		</script> 
		-->
		<video width="320" height="240" controls>
			<source src="http://178.217.173.109/webinar/content/<?php echo $array['id'];?>.mp4" type="video/mp4">
			<!-- <source src="movie.ogg" type="video/ogg"> -->
			Your browser does not support the video tag.
		</video>
		<BR> Часть <?php $m=$m+1; echo $m; 
		/*
		if (!empty($array['youtube'])) {
			?>
			<iframe width="360" height="270"
				src="<?php echo $array['youtube']; ?>">
			</iframe>
			<?php
		}
		*/
		?>
	</DIV>
	<?php		
}
?>	