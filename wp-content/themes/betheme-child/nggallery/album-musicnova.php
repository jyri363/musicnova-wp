<?php
/**
Template Page for the album overview

Follow variables are useable :

    $album     	 : Contain information about the first album
    $albums    	 : Contain information about all albums
	$galleries   : Contain all galleries inside this album
	$pagination  : Contain the pagination content

 You can check the content when you insert the tag <?php var_dump($variable) ?>
 If you would like to show the timestamp of the image ,you can use <?php echo $exif['created_timestamp'] ?>
**/
?>
<?php if (!defined ('ABSPATH')) die ('No direct access allowed'); ?><?php if (!empty ($galleries)) : ?>

<div class="portfolio_wrapper isotope_wrapper">
	<ul class="portfolio_group lm_wrapper isotope flat col-4">
	<!-- List of galleries -->
	<?php foreach ($galleries as $gallery) : ?>
	<li class="portfolio-item isotope-item">
		<div class="image_frame scale-with-grid">
			<div class="image_wrapper">
				
					<a class="Link" href="<?php echo nextgen_esc_url($gallery->pagelink) ?>">
					<div class="mask"></div>
						<img class="Thumb" alt="<?php echo esc_attr($gallery->title) ?>" src="<?php echo nextgen_esc_url($gallery->previewurl) ?>"/>
					</a>
					<div class="image_links hover-title">
						<a href="<?php echo nextgen_esc_url($gallery->pagelink) ?>"><?php echo $gallery->title ?></a>
					</div>
			</div>
		</div>
	</li>
 	<?php endforeach; ?>
	</ul>
	<!-- Pagination -->
    <br class="ngg-clear"/>
 	<?php echo $pagination ?>
</div>

<?php endif; ?>
