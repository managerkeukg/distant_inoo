<?php 
require_once "config.php";
require_once "common_data/classes/ClassTableQuery.php";

$query = "SELECT * FROM `inoo_news` WHERE  `status`='1' ORDER BY `id` DESC;";
$object_news = new TableQuery;
$object_news -> order_by_field="id";
$array_news = $object_news->query ($query);
if (isset($array_news) AND !empty($array_news) AND is_array($array_news))
{
	////echo "<pre> news count "; print_r(count($array_news)); echo "</pre>";
	////echo "<pre> news "; print_r($array_news); echo "</pre>";
	?>
	<div  class="news_distant">
		<?php
		foreach ($array_news as  $value)
		{  
			if (!empty($value['image'])) {
				$img_text = "<img class=\"news_img\" src=\"uploads/images/news/".$value['image']."\"  alt=\"Some image\">";
			} 
			else {
				$img_text = '<img class="news_img" src="uploads/images/news/6.jpg" alt="Some image">';
				
			} 
			?>
			<div class="news_distant_rows">
				<div class="news_distant_divs">
					<?php echo  $img_text; ?>
				</div>
				<div class="news_distant_divs">
					<?php echo  $value['title']; ?>
				</div>
				<div>
					<br><a href="index.php?show=53&id=<?php echo $value['id'];?>">	 далее ...</a>
				</div>
			</div>
			<?php
		} // foreach
		?>
	</div>
	<?php
}
?>