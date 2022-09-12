<?php
function identify_test_image($question, $answer)
{
	$query = "SELECT * FROM `"._TABLE_PREFIX_."test_images`
        WHERE `key` = ".$question." AND `ans`='".$answer."' AND `status`='1'";
    $object_test_images = new TableQuery;
	$object_test_images -> order_by_field="id";
	$array_test_images = $object_test_images -> query ($query);
	if (isset($array_test_images) AND !empty($array_test_images) AND is_array($array_test_images))
	{
		////echo "<pre> Count test_images - "; print_r(count($array_test_images)); echo "</pre>";
		////echo "<pre>test_images "; print_r($array_test_images); echo "</pre>";
		$image = "";
		foreach ($array_test_images as $value) {
			$image=$value['image'];
		}
		return $image;
	} else {
		return 0;
	}
}
?>