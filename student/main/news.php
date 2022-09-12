<?php
require_once "../security.php";

require_once _COMMON_DATA_PATH_."classes/ClassTableQuery.php";

echo "<h2>Объявления</h2>";

$object_news= new TableQuery;
$object_news->order_by_field="id";
$array_news=$object_news -> query ("SELECT * FROM `"._TABLE_PREFIX_."news` WHERE `status`='1' ORDER BY `id` DESC;" );
////echo count($array_news)." записей";
////echo "<pre>News "; print_r($array_news); echo "</pre>"; 

if (isset($array_news) AND !empty($array_news))
{
	$i=0;
	foreach ($array_news as $key=>$value )
	{
		?>	
		<div class="cnsnt_info" style="padding-top: 5; ">
			<p style="color:blue;"><?php echo  $value['title']; ?></p>
			<div class="summary"></div>
			<br>
			<?php echo  $value['text']; ?>
			<div style="text-align:right;">Дата:&nbsp;&nbsp;&nbsp; 
				<?php echo  $value['date']; ?>
			</div>
		</div>
		<?php
	}
}
?>