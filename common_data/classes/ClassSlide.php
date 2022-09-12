<?php
require_once $slide_path."slide.css1.php";
class Slide {
public $id="2";
public $slide_width="570"; // 570
public $slide_height="380"; // 380
public $div_class_caption = "";
public $div_class_slide="";
public $div_id_container="";
public $div_id_example="";
public $div_id_slides="";
public $img_id="";
public $div_id_slides_container="slides_container"; // can not create variable in js
public $slide_path="modules/slides/slide1/";
function build ()
	{
$this->div_class_caption = $this->id ;
$this->div_class_slide="slide_".$this->id;
$this->div_id_container=$this->id."_container";
$this->div_id_example=$this->id."_example";
$this->div_id_slides=$this->id."_slides";
$this->img_id=$this->id."_frame";
}	

 echo    "<script src=".this->slide_path."jquery.min.js\"></script>"; 
		?>
	<script src="<?php echo $slide_path;?>slides.min.jquery.js"></script>
	<script>
		$(function(){
			$('#<?php echo $div_id_slides;?>').slides({
				preload: true,
				preloadImage: '<?php echo $slide_path;?>img/loading.gif',
				play: 4000,
				pause: 2500,
				hoverPause: true,
				animationStart: function(current){
					$('.<?php echo $div_class_caption;?>').animate({
						bottom:-35
					},100);
					if (window.console && console.log) {
						// example return of current slide number
						console.log('animationStart on slide: ', current);
					};
				},
				animationComplete: function(current){
					$('.<?php echo $div_class_caption;?>').animate({
						bottom:0
					},200);
					if (window.console && console.log) {
						// example return of current slide number
						console.log('animationComplete on slide: ', current);
					};
				},
				slidesLoaded: function() {
					$('.<?php echo $div_class_caption;?>').animate({
						bottom:0
					},200);
				}
			});
		});
	</script>


	<div id="<?php echo $div_id_container;?>"> <!-- css -->
		<div id="<?php echo $div_id_example;?>">  <!-- css -->
			<div id="<?php echo $div_id_slides;?>"> <!-- css -->
				<div class="<?php echo $div_id_slides_container;?>"> <!-- js css -->
				<?php 
				foreach ($data_array as  $array)
                {?>
		           <div class="<?php echo $div_class_slide;?>">
						<a href="index.php?show=53&id=<?php echo $array['id_news']; ?>"><img  src="uploads/images/news/<?php echo $array['image']; ?>" 
						width="<?php echo $slide_width; ?>" height="<?php echo $slide_height; ?>" alt="<?php echo $array['short_title']; ?>"></a>
						<div class="<?php echo $div_class_caption;?>" style="bottom:0"> <!-- css -->
							<p><?php echo $array['short_title']; ?></p>
						</div>
					</div>
                <?php }
				?>
				</div>
				<a href="#" class="prev"><img src="<?php echo $slide_path;?>img/arrow-prev.png" width="24" height="43" alt="Arrow Prev"></a>
				<a href="#" class="next"><img src="<?php echo $slide_path;?>img/arrow-next.png" width="24" height="43" alt="Arrow Next"></a>
			</div>
			<img src="<?php echo $slide_path;?>img/example-frame.png" width="<?php echo $slide_width+169;?>" height="<?php echo $slide_height+71;?>" id="<?php echo $img_id;?>">
		</div>
</div>
<?php
}
?>