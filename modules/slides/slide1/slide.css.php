<style>
caption{ text-align:left;}

#container { 
	width:<?php echo $slide_width+10 ?>px;
	padding:10px;
	margin:0 auto;
	position:relative;
	z-index:0;
}

#example { 
	width:<?php echo $slide_width+30 ?>px;
	height:<?php echo $slide_height+80 ?>px;
	position:relative;
}

#frame { 
	position:absolute;
	z-index:0;
	width:<?php echo $slide_width+169?>px;
	height:<?php echo $slide_height+71?>px;
	top:-3px;
	left:-80px;
}


#slides { 
	position:absolute;
	top:15px;
	left:4px;
	z-index:100;
}


.slides_container {
	width:<?php echo $slide_width?>;
	overflow:hidden;
	position:relative;
	display:none; 
}


.slides_container div.slide {
	width:<?php echo $slide_width?>;
	height:<?php echo $slide_height-15 ?>px;
	display:block;
}



#slides .next,#slides .prev {
	position:absolute;
	top:<?php echo ($slide_height/2)-30?>px;
	left:-39px;
	width:24px;
	height:43px;
	display:block;
	z-index:101;
}

#slides .next {
	left:<?php echo $slide_width+15?>px;
}

/*
	Pagination
*/

.pagination {
	margin:46px auto 0;
	width:300px;
}

.pagination li {
	float:left;
	margin:0 1px;
	list-style:none;
}

.pagination li a {
	display:block;
	width:12px;
	height:0;
	padding-top:12px;
	background-image:url(slide/img/pagination.png);
	background-position:0 0;
	float:left;
	overflow:hidden;
}

.pagination li.current a {
	background-position:0 -12px;
}

.caption {
	position:absolute;
	bottom:5px;
	height:30px;
	padding:5px 20px 20 20px;
	background:rgba(55,5,255,.5);
	width:<?php echo $slide_width-30?>px;
	color:#fff; <!--  white -->
	border-top:1px solid #000;
	text-shadow:none;
}
</style>