<?php
require_once "../settings.php";
require_once _DATA_PATH_."top.php";

require_once _COMMON_DATA_PATH_."classes/ClassDataTable.php";
require_once _COMMON_DATA_PATH_."classes/ClassTableQuery.php";
require_once _FUNCTIONS_PATH_."f_set_array_key.php";
?>
<script type="text/javascript" src="<?php echo _ROOT_PATH_;?>js/swfobject.js"></script>
<?php
$query = "SELECT * FROM `"._TABLE_PREFIX_."webinar` where `status`='1' ORDER BY `id` DESC;";
$object_webinar = new TableQuery;
$object_webinar -> order_by_field="id";
$array_webinar = $object_webinar -> query ($query);
if (isset($array_webinar) AND !empty($array_webinar) AND is_array($array_webinar))
{
	////echo "<pre> webinar count "; print_r(count($array_webinar)); echo "</pre>";
	////echo "<pre> webinar "; print_r($array_webinar); echo "</pre>";
}

$query = "SELECT * FROM `"._TABLE_PREFIX_."webinar_files` where `status`='1';";
$object_webinar_files = new TableQuery;
$object_webinar_files -> order_by_field="id";
$array_webinar_files = $object_webinar_files -> query ($query);
if (isset($array_webinar_files) AND !empty($array_webinar_files) AND is_array($array_webinar_files))
{
	////echo "<pre> webinar_files count "; print_r(count($array_webinar_files)); echo "</pre>";
	////echo "<pre> webinar_files "; print_r($array_webinar_files); echo "</pre>";
}

$array_webinar_files_youtube = set_array_keys($array_webinar_files, "webinar", "youtube");
//echo "<pre> ALL webinar_files youtube "; print_r($array_webinar_files_youtube); echo "</pre>";
$array_webinar_files = set_array_keys($array_webinar_files, "webinar", "id");
//echo "<pre> ALL webinar_files "; print_r($array_webinar_files); echo "</pre>";

if (isset($array_webinar) AND !empty($array_webinar)) 
{
	foreach ($array_webinar as $value) {
		?>
		<DIV class="webinar">
			<DIV class="webinar_text">
				<?php echo $value['text']; ?>
			</DIV>
			<?php
			//include "webinar_local.php";
			include "webinar_youtube.php";
			?>
		</DIV>
		<?php
	}
}

require_once _DATA_PATH_."bottom.php";
?>