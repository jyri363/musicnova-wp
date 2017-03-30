<?php 
/**
Template Page for the gallery overview

Follow variables are useable :

	$gallery     : Contain all about the gallery
	$images      : Contain all images, path, title
	$pagination  : Contain the pagination content

 You can check the content when you insert the tag <?php var_dump($variable) ?>
 If you would like to show the timestamp of the image ,you can use <?php echo $exif['created_timestamp'] ?>
**/
?>

<style type="text/css">




</style>

<script type="text/javascript">

jQuery(window).load(function() {

var $container = jQuery('#isotopegallery');

$container.isotope({
itemSelector: '.photo'
});

jQuery('#filters a').click(function(){
var selector = jQuery(this).attr('data-filter');
$container.isotope({ filter: selector });
return false;
});
});
</script>
<div class="section section-filters">
	<div class="section_wrapper clearfix">
		<!-- #Filters -->
		<div id="Filters" class="column one isotope-filters only only-categories">
			<div class="filters_wrapper">
				<ul id="filters" class="categories">
					<li class="current-cat"><a href="#" data-filter="*">Kaikki</a></li>
					<?php  
					//lets get all the nextgen gallery image tags. we only want the ones that have images
					//this will create a nice button style list of each tag that we can filter by
					$filtertags = get_terms('ngg_tag');
					foreach ( $filtertags as $filtertag ) : ?> 
					<li><a href="#" data-filter=".<?php echo $filtertag->slug; ?>"><?php echo $filtertag->name; ?></a></li>
					<?php endforeach; ?>
				</ul>
			</div>
		</div>
	</div>
</div>

<?php if (!defined ('ABSPATH')) die ('No direct access allowed'); ?><?php if (!empty ($gallery)) : ?>
<div id="section_wrapper mcb-section-inner">
	<div id="isotopegallery" class="photos clearfix isotope">
 
        <?php
                //Used to break down and extract the width and height of each image
                function get_string_between($string, $start, $end){
                        $string = " ".$string;
                        $ini = strpos($string,$start);
                        if ($ini == 0) return "";
                        $ini += strlen($start);
                        $len = strpos($string,$end,$ini) - $ini;
                        return substr($string,$ini,$len);
                }
        ?>
 
        <!-- Thumbnails -->
        <?php foreach ( $images as $image ) : 
			//Get the TAGS for this image  
			$tags = wp_get_object_terms($image->pid,'ngg_tag');
			$tag_string = ''; //store the list of strings to be put into the class menu for isotpe filtering       
			?>
			<?php foreach ( $tags as $tag ) : ?>     
			  <?php $tag_string = $tag_string.$tag->slug.' ';  //alternativley can use $tag->name;, slug with put hyphen between words ?>      
			<?php endforeach; ?> 
			<?php if ( !$image->hidden ) {
                        //GET the Size parameters for each image. this i used to size the div box that the images goes inside of.
                        $the_size_string = $image->size;
                        $thewidth = get_string_between($the_size_string, "width=\"", "\"");
                        $theheight = get_string_between($the_size_string, "height=\"", "\"");
                        $divstyle = 'width:'.$thewidth.'px; height:'.$theheight.'px;'; 
                }?>
        <div class="wrap mcb-wrap one  valign-top clearfix box-shadow photo <?php echo $tag_string ?> isotope-item" >
			<div class="mcb-wrap-inner">
				<div class="column mcb-column one-fifth column_photo_box column-margin-0px">
					<div class="photo_box  without-desc" style="">
						<div class="image_frame" style="">
							<a href="<?php echo nextgen_esc_url($image->imageURL) ?>"
							   title="<?php //echo esc_attr($image->description) ?>"
							   <?php echo $image->thumbcode ?> >
								<?php if ( !$image->hidden ) { ?>
							
								<img title="<?php echo esc_attr($image->alttext) ?>" alt="<?php echo esc_attr($image->alttext) ?>" src="<?php echo nextgen_esc_url($image->thumbnailURL) ?>" <?php echo $image->size ?> />
								<?php } ?>
							</a>
						</div>
					</div>
				</div>
               	<div class="column mcb-column three-fifth column_column  column-margin-10px">
					<div class="column_attr clearfix" style=" padding:0px 0 0 0;">
						<h2><?php echo esc_attr($image->alttext) ?></h2>
						<?php echo esc_attr($image->description) ?>
					</div>
				</div>
				<div class="column mcb-column one-sixth column_column  column-margin-10px">
					<div class="column_attr clearfix align_right" style="padding:0px 0 0 0;">
						<h3><?php echo nggcf_get_field($image->pid, "price"); ?></h3>
					</div>
				</div>
			</div>					
		</div>

    <?php if ( $image->hidden ) continue; ?>
    <?php if ($gallery->columns > 0): ?>
        <?php if ((($i + 1) % $gallery->columns) == 0 ): ?>
            <br style="clear: both" />
        <?php endif; ?>
    <?php endif; ?>
    <?php $i++; ?>

 	<?php endforeach; ?>

    </div>   
</div>
 
<?php endif; ?>
