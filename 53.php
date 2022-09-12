<?php
if (isset($_GET['id']) AND !empty($_GET['id']) ) {
	is_int_obligatory ($_GET['id']);
} else { 
	exit("error");
}
$id=$_GET['id'];

require_once "config.php";
require_once "common_data/classes/ClassTableQuery.php";

$query = "SELECT * FROM `inoo_news` where `id`='".$id."' AND `status`='1';";
$object_news = new TableQuery;
$object_news -> order_by_field="id";
$array_news = $object_news->query ($query);
if (isset($array_news) AND !empty($array_news) AND is_array($array_news))
{
	////echo "<pre> news count "; print_r(count($array_news)); echo "</pre>";
	////echo "<pre> news "; print_r($array_news); echo "</pre>";
}
foreach ($array_news as  $array)
{ 
	?>
	<hr>
	<br><a href="index.php?show=50">Назад в список новостей</a>
	<h4>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $array['title']; ?></h4>
	<?php 
	if (!empty($array['image'])) { 
		?>
		<img src="uploads/images/news/<?php echo $array['image']; ?>" style="text-align:left; width:200px; padding-right:20px;"> 
		<?php 
	}
	echo "<div style=\"padding-left:10\">".$array['text']."</div>"; 
	$object = new TableQuery;
	$image_array=$object-> query("SELECT * FROM `inoo_news_files` where `key`='".$array['id']."' AND `status`='1'; ");
	//echo "<pre>"; print_r($image_array); echo "</pre>";
	if (!empty($image_array))
	{ 
		$i="0"; echo "<div style=\"text-align:center;\"><table><tr>";
		foreach ($image_array as  $image)
		{   
			?>
			<td><img style="height:150px; padding-left:3px" src="uploads/images/news/<?php echo $image['filename'];?>"></td>
			<?php $i++; if ($i % 3 == 0) {echo "</tr><tr>";}
		}
		echo "</tr></table></div>";  
	} 
	?>
	<div style="text-align:right;">Дата:&nbsp;&nbsp;&nbsp; <?php echo $array['date']; ?></div>
	<br><div style="text-align:bottom;" ><a href="index.php?show=50">Назад в список новостей</a></div>
	<?php
}
?>