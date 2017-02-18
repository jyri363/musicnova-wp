<?php
/**
 * The template for displaying content in the single-portfolio.php template
 *
 * @package Betheme
 * @author Muffin group
 * @link http://muffingroup.com
 */

// prev & next post -------------------
mfn_post_navigation_sort();

$single_post_nav = array(
	'hide-header'	=> false,
	'hide-sticky'	=> false,
	'in-same-term'	=> false,
);

$opts_single_post_nav = mfn_opts_get( 'prev-next-nav' );
if( is_array( $opts_single_post_nav ) ){

	if( isset( $opts_single_post_nav['hide-header'] ) ){
		$single_post_nav['hide-header'] = true;
	}
	if( isset( $opts_single_post_nav['hide-sticky'] ) ){
		$single_post_nav['hide-sticky'] = true;
	}
	if( isset( $opts_single_post_nav['in-same-term'] ) ){
		$single_post_nav['in-same-term'] = true;
	}

}

$post_prev = get_adjacent_post( $single_post_nav['in-same-term'], '', true, 'portfolio-types' );
$post_next = get_adjacent_post( $single_post_nav['in-same-term'], '', false, 'portfolio-types' );
$portfolio_page_id = mfn_opts_get( 'portfolio-page' );


// categories -------------------------
$categories 	= '';
$aCategories 	= '';

$terms = get_the_terms( get_the_ID(), 'portfolio-types' );
if( is_array( $terms ) ){
	foreach( $terms as $term ){
		$categories		.= '<li><a href="'. get_term_link($term) .'">'. $term->name .'</a></li>';
		$aCategories[]	= $term->term_id;  
	}
}


// post classes -----------------------
$classes = array();
if( get_post_meta(get_the_ID(), 'mfn-post-slider-header', true) ) $classes[] = 'no-img';

if( mfn_opts_get( 'share' ) == 'hide-mobile' ){
	$classes[] = 'no-share-mobile';
} elseif( ! mfn_opts_get( 'share' ) ) {
	$classes[] = 'no-share';
}


$translate['published'] 	= mfn_opts_get('translate') ? mfn_opts_get('translate-published','Published by') : __('Published by','betheme');
$translate['at'] 			= mfn_opts_get('translate') ? mfn_opts_get('translate-at','at') : __('at','betheme');
$translate['categories'] 	= mfn_opts_get('translate') ? mfn_opts_get('translate-categories','Categories') : __('Categories','betheme');
$translate['all'] 			= mfn_opts_get('translate') ? mfn_opts_get('translate-all','Show all') : __('Show all','betheme');
$translate['related'] 		= mfn_opts_get('translate') ? mfn_opts_get('translate-related','Related posts') : __('Related posts','betheme');
$translate['readmore'] 		= mfn_opts_get('translate') ? mfn_opts_get('translate-readmore','Read more') : __('Read more','betheme');
$translate['client'] 		= mfn_opts_get('translate') ? mfn_opts_get('translate-client','Client') : __('Client','betheme');
$translate['date'] 			= mfn_opts_get('translate') ? mfn_opts_get('translate-date','Date') : __('Date','betheme');
$translate['website'] 		= mfn_opts_get('translate') ? mfn_opts_get('translate-website','Website') : __('Website','betheme');
$translate['view'] 			= mfn_opts_get('translate') ? mfn_opts_get('translate-view','View website') : __('View website','betheme');
$translate['task'] 			= mfn_opts_get('translate') ? mfn_opts_get('translate-task','Task') : __('Task','betheme');
?>

<div id="portfolio-item-<?php the_ID(); ?>" <?php post_class( $classes ); ?>>

	<?php 
		// single post navigation | sticky
		if( ! $single_post_nav['hide-sticky'] ){
			echo mfn_post_navigation_sticky( $post_prev, 'prev', 'icon-left-open-big' ); 
			echo mfn_post_navigation_sticky( $post_next, 'next', 'icon-right-open-big' );
		} 
	?>
	
	<?php if( get_post_meta( get_the_ID(), 'mfn-post-template', true ) != 'intro' ): // sisu kustutatud 17.02.17 ?>


	<?php endif; ?>	
	
	<div class="entry-content" itemprop="mainContentOfPage">
		<?php
			// Content Builder & WordPress Editor Content
			mfn_builder_print( get_the_ID() );
		?>
	</div>
	
	<div class="section section-post-footer">
		<div class="section_wrapper clearfix">
		
			<div class="column one post-pager">
				<?php
					// List of pages
					wp_link_pages(array(
						'before'			=> '<div class="pager-single">',
						'after'				=> '</div>',
						'link_before'		=> '<span>',
						'link_after'		=> '</span>',
						'next_or_number'	=> 'number'
					));
				?>
			</div>
			
		</div>
	</div>
	
	<div class="section section-post-related">
		<div class="section_wrapper clearfix">
			
			<?php
				if( mfn_opts_get( 'portfolio-related' ) && $aCategories ){
					
					$related_count  = intval( mfn_opts_get( 'portfolio-related' ) );
					$related_cols 	= 'col-'. absint( mfn_opts_get( 'portfolio-related-columns', 3 ) );
					$related_style	= mfn_opts_get( 'related-style' );
					
					$args = array(
						'post_type' 			=> 'portfolio',
						'tax_query' => array(
							array(
								'taxonomy'	=> 'portfolio-types',
								'field'		=> 'term_id',
								'terms'		=> $aCategories
							),
						),
						'post__not_in'			=> array( get_the_ID() ),
						'posts_per_page'		=> $related_count,
						'post_status'			=> 'publish',
						'no_found_rows'			=> true,
						'ignore_sticky_posts'	=> true,
					);

					$query_related_posts = new WP_Query( $args );
					if ( $query_related_posts->have_posts() ){

						echo '<div class="section-related-adjustment '. $related_style .'">';
						
							echo '<h4>'. $translate['related'] .'</h4>';
							
							echo '<div class="section-related-ul '. $related_cols .'">';
							
								while ( $query_related_posts->have_posts() ){
									$query_related_posts->the_post();
									
									echo '<div class="column post-related '. implode(' ',get_post_class()).'">';	
										
										echo '<div class="image_frame scale-with-grid">';
										
											echo '<div class="image_wrapper">';
												echo mfn_post_thumbnail( get_the_ID(), 'portfolio' );
											echo '</div>';
											
											if( has_post_thumbnail() && $caption = get_post( get_post_thumbnail_id() )->post_excerpt ){
												echo '<p class="wp-caption-text '. mfn_opts_get( 'featured-image-caption' ) .'">'. $caption .'</p>';
											}
											
										echo '</div>';
										
										echo '<div class="date_label">'. get_the_date() .'</div>';
									
										echo '<div class="desc">';
											echo '<h4><a href="'. get_permalink() .'">'. get_the_title() .'</a></h4>';
											echo '<hr class="hr_color" />';
											echo '<a href="'. get_permalink() .'" class="button button_left button_js"><span class="button_icon"><i class="icon-layout"></i></span><span class="button_label">'. $translate['readmore'] .'</span></a>';
										echo '</div>';
										
									echo '</div>';
								}
							
							echo '</div>';
							
						echo '</div>';
					}	
					wp_reset_postdata();
				}	
			?>
			
		</div>
	</div>
	
</div>