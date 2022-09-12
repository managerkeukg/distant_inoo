<?php
class ShowDiv 
{ 
	public function CreateHiddenDiv ($content, $array)
	{
	  echo "<BR><BR>".$array['title']."<BR>";
	  ?>
		<a id="<?php echo $array['id'];?>_show" onclick="$('#<?php echo $array['id']."_reply"?>').show('slow'); $('#<?php echo $array['id'];?>_show').hide('slow');">Показать</a>
		<DIV id="<?php echo $array['id']."_reply";?>" >
		<a id="short_hide" onclick="$('#<?php echo $array['id']."_reply";?>').hide('slow'); $('#<?php echo $array['id'];?>_show').show('slow');">Скрыть</a>
		<?php echo "<pre> "; print_r ($content); echo "</pre>";?>
        </DIV>
	  <?php
	
	}
}
?>