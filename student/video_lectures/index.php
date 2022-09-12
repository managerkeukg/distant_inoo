<?php
require_once "../settings.php";
require_once _DATA_PATH_."top.php";

require_once _COMMON_DATA_PATH_."classes/ClassDataTable.php";
require_once _COMMON_DATA_PATH_."classes/ClassTableQuery.php";
?>
<H4>Видеолекции</H4>
<?php
$query = "SELECT * FROM `"._TABLE_PREFIX_."video_lectures` where `status`='1';";
$object_video_lectures = new TableQuery;
$object_video_lectures -> order_by_field="id";
$array_video_lectures = $object_video_lectures -> query ($query);
if (isset($array_video_lectures) AND !empty($array_video_lectures) AND is_array($array_video_lectures))
{
	////echo "<pre> files_gak count "; print_r(count($array_video_lectures)); echo "</pre>";
	////echo "<pre> files_gak "; print_r($); echo "</pre>";
	foreach ($array_video_lectures as $value) {
		?>
		<DIV class="webinar">
			<DIV class="webinar_text">
				<?php echo $value['name']; ?>
			</DIV>
			<DIV class="webinar_video">
				<?php
				if (!empty($value['youtube'])) {
					?>
					<iframe width="360" height="270"
						src="https://www.youtube.com/embed/<?php echo $value['youtube']; ?>">
					</iframe>
					<?php
				}
				//*/
				?>
			</DIV>
		</DIV>
		<?php
	}
}

require_once _DATA_PATH_."bottom.php";
?>