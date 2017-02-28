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
<?php if (!defined ('ABSPATH')) die ('No direct access allowed'); ?><?php if (!empty ($gallery)) : ?>

<div id="section_wrapper mcb-section-inner">

	<!-- Thumbnails -->
    <?php $i = 0; ?>
	<?php foreach ( $images as $image ) : ?>
	
	<div class="wrap mcb-wrap one  valign-top clearfix box-shadow" >
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
 	
	<!-- Pagination -->
 	<?php echo $pagination ?>
 	
</div>

<?php endif; ?>
