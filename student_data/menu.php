<style>
.table_menu_student {
	width:100%; 
	margin:5px auto; 
	text-align:center; 
	border:1px solid blue;
}

.table_menu_student td {
	vertical-align:top;
	width:125px;
	/* border: 1px solid blue; */
}
</style>
<?php
$object_student_menu= new TableQuery;
$object_student_menu->order_by_field="id";
$array_student_menu=$object_student_menu -> query ("SELECT * FROM `"._TABLE_PREFIX_."student_menu` WHERE `status`='1' ORDER BY `order` ASC;" );
if (isset($array_student_menu) AND !empty($array_student_menu))
{
	////echo count($array_student_menu)." записей";
	////echo "<pre>student_menu "; print_r($array_student_menu); echo "</pre>"; 
	echo "<table class=\"table_menu_student\" >
				<tr>";
	$menu_link = "";
	foreach ($array_student_menu as $value) {
		if (empty($value['link_outer'])) {
			$menu_link = "../".$value['link']."/"; 
			$target_text = "";
		} else {
			$menu_link = $value['link_outer'];
			$target_text = "target=\"_blank\"";
		}
		?>
		<td width="125">
			<table style="text-align:center;">
				<tr>
					<td>
						<a href="<?php echo $menu_link;?>" <?php echo $target_text; ?>>
							<img src="<?php echo _UPLOADS_PATH_."images/student_menu/".$value['image'];?>" height="100px">
						</a>
					</td>
				</tr>
				<tr>
					<td style="text-align:center;">
						<a href="<?php echo $menu_link;?>" <?php echo $target_text; ?>>
							<p style="color:#1A3867; font-size:1em;"><?php echo $value['name_ru'];?></p>
						</a>
					</td>
				</tr>
			</table>
		</td>
		<?php
	}
	echo "		</tr>
	</table>";
}
?>