<?php 
/*$organisations = new WP_Query( array(
	'connected_type' => 'organisations-to-evenements',
	'connected_items' => get_queried_object(),
	'nopaging' => true,
) );*/
?>

<?php if ( $organisations->have_posts() ) : ?>

	<aside>

		<div>

			<h2><?php _e('Organisation en lien', THEME_NAME); ?></h2>

			<div class="group">

				<?php while ( $organisations->have_posts() ) : $organisations->the_post(); ?>

					<a class="c6" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_post_thumbnail('medium'); ?></a>

				<?php endwhile; wp_reset_postdata(); ?>

			</div>

		</div>

	</aside>

<?php endif; ?>