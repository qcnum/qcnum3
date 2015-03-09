<?php 
get_header(); 
wp_enqueue_script('slick', get_template_directory_uri().'/js/slick.min.js', 'jquery', '', true);
?>
<script>
jQuery(document).ready(function(){

	jQuery('.slick').slick({
		centerMode: true,
		variableWidth: true,
		autoplay: true,
		autoplaySpeed: 4000,
		/*responsive: [{
			breakpoint: 1024,
			settings: {
				slidesToShow: 3,
				slidesToScroll: 3,
				infinite: true
			}
		}, {
			breakpoint: 600,
			settings: {
				slidesToShow: 2,
				slidesToScroll: 2
			}
		}, {
		breakpoint: 480,
		settings: {
				slidesToShow: 2,
				slidesToScroll: 2
			}
		}
	] */
	});

});
</script>

	<div id="content">

		<div class="blanc-bg group">
		
			<?php if ( have_posts() ) :

				$categories = get_terms('secteurs', 'orderby=menu_orderhide_empty=1');
				foreach( $categories as $category ): ?>

					<div class="organisation entry-content">

						<div class="c12 group all-org">
							<h2 class="h2 fl"><?php echo $category->name; ?></h2>
							<a class="fr" title="<?php _e('Voir toute la liste', THEME_NAME); ?>" href="<?php echo get_term_link( $category, 'secteurs' ); ?>"><?php _e('Voir toute la liste', THEME_NAME); ?></a>
						</div>

						<hr class="clear">

						<div class="slick group">

							<?php
							$posts = get_posts(array(
							'post_type' => 'organisations',
							'taxonomy' => $category->taxonomy,
							'term' => $category->slug,
							'nopaging' => true,
							'posts_per_page' => -1
							));
							foreach($posts as $post): 
								setup_postdata($post);
								?>

								<div><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_post_thumbnail('medium'); ?></a></div>

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
