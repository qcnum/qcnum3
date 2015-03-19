<?php 
get_header(); 
wp_enqueue_script('slick', get_template_directory_uri().'/js/slick.min.js', 'jquery', '', true);
?>
<script>
jQuery(document).ready(function(){

	jQuery('.slick').on('init', function(event, slick, currentSlide, nextSlide){
		jQuery(this).removeClass('hide');
		jQuery('.loading').addClass('hide');

	});

	jQuery('.slick').slick({
		variableWidth: true,
		autoplay: true,
		slidesToScroll: 4,
		autoplaySpeed: 4000,
		infinite: false,
		responsive: [{
			breakpoint: 1600,
			settings: {
				slidesToShow: 3,
				slidesToScroll: 1,
				infinite: false,
				//centerMode: true
			}
		}, {
			breakpoint: 1200,
			settings: {
				slidesToShow: 2,
				slidesToScroll: 1,
				infinite: true,
				centerMode: true
			}
		}, {
		breakpoint: 767,
		settings: {
				slidesToShow: 1,
				slidesToScroll: 1,
				infinite: true,
				centerMode: true
			}
		}
	]
	});
});
</script>

	<div id="content">

		<div class="blanc-bg group">
		
			<?php if ( have_posts() ) :

				$categories = get_terms('secteurs', 'orderby=term_order&hide_empty=1');
				foreach( $categories as $category ): ?>

					<div class="organisation entry-content">

						<div class="large-wrapper">

							<div class="padding">
								<div class="all-org group">
									<h2 class="h2 fl"><?php echo $category->name; ?></h2>
									<a class="fr" title="<?php _e('Voir toute la liste', THEME_NAME); ?>" href="<?php echo get_term_link( $category, 'secteurs' ); ?>"><?php _e('Voir toute la liste', THEME_NAME); ?></a>
								</div>
							</div>

						</div>

						<div class="loading">
							<img src="<?php echo get_template_directory_uri(); ?>/images/loading-blanc.gif" alt="">
						</div>
	
						<div class="slick group hide">

							<?php
							$posts = get_posts(array(
								'post_type' => 'organisations',
								'taxonomy' => $category->taxonomy,
								'term' => $category->slug,
								'nopaging' => true,
								'posts_per_page' => -1
							));
							foreach($posts as $post): 
								setup_postdata($post); ?>
								<div><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
									<?php 
									if(has_post_thumbnail()) :
										the_post_thumbnail('medium');
									else:
										echo '<span class="no-img">' . get_the_title() . '</span>';
									endif; 
									?> 
								</a></div>

							<?php endforeach; ?>

						</div>

					</div>

				<?php endforeach; ?>

			<?php else : ?>

				<?php get_template_part( 'content', 'none' ); ?>
					
			<?php endif; ?>

		</div>

	</div><!-- #content -->
			
<?php get_footer(); ?>
