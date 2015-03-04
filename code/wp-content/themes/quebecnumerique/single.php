<?php 
get_header(); 
$projets = new WP_Query( array(
	'connected_type' => 'projets-to-post',
	'connected_items' => get_queried_object(),
	'nopaging' => true,
) );

$evenements = new WP_Query( array(
	'connected_type' => 'evenements-to-post',
	'connected_items' => get_queried_object(),
	'nopaging' => true,
) );

$organisations = new WP_Query( array(
	'connected_type' => 'organisations-to-post',
	'connected_items' => get_queried_object(),
	'nopaging' => true,
) );
?>

	<div id="content" role="main">

		<?php while ( have_posts() ) : the_post(); ?>

			<article <?php post_class('wrapper group'); ?>>

				<div class="c4">

					<?php the_post_thumbnail('large'); ?>

					<?php 
					$motsCles = wp_get_post_terms(get_the_ID(), 'mots-cles');
					if ( $motsCles ) : ?>

						<div class="grispalepale-bg">

							<div>

								<h3><?php _e('Mots-clés', THEME_NAME); ?></h3>

								<?php foreach ( $motsCles as $mc ) : ?>

									<a href="<?php echo get_term_link( $mc, 'mots-cles' ); ?>" title="<?php echo $mc->name; ?>"><?php echo $mc->name ?></a>

								<?php endforeach; ?>
									
							</div>

						</div>

					<?php endif; ?>

					<?php if ( $projets->have_posts() ) : ?>

						<div class="grispalepale-bg">

							<div>

								<h3><?php _e('Projets en lien', THEME_NAME); ?></h3>

								<?php while ( $projets->have_posts() ) : $projets->the_post(); ?>

									<h3><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h3>

								<?php endwhile; wp_reset_postdata(); ?>

							</div>

						</div>

					<?php endif; ?>

					<?php if ( $evenements->have_posts() ) : ?>

						<div class="grispalepale-bg">

							<div class="evenements">

								<h3><?php _e('Événements en lien', THEME_NAME); ?></h3>

								<?php while ( $evenements->have_posts() ) : $evenements->the_post(); ?>
									
									<a title="<?php the_title(); ?>" href="<?php the_permalink(); ?>">
										<article class="gris-bg group">
											<?php the_post_thumbnail('thumbnail'); ?>
											<div class="content">
												<span class="date"><?php echo get_the_date(); ?></span>
												<span class="lieu"><i class="fa fa-map-marker"></i> L'Abri-co / 255 boulevard Charest Est</span>
												<h3><?php the_title(); ?></h3>
											</div>
										</article>
									</a>

								<?php endwhile; wp_reset_postdata(); ?>

							</div>

						</div>

					<?php endif; ?>

					<?php if ( $organisations->have_posts() ) : ?>

						<div class="grispalepale-bg">

							<div>

								<h3><?php _e('Organisation en lien', THEME_NAME); ?></h3>

								<div class="group">

									<?php while ( $organisations->have_posts() ) : $organisations->the_post(); ?>

										<a class="c6" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_post_thumbnail('medium'); ?></a>

									<?php endwhile; wp_reset_postdata(); ?>

								</div>

							</div>

						</div>

					<?php endif; ?>
					
				</div>

				<div class="c7">

					<header class="entry-header">

						<h1 class="entry-title"><?php the_title(); ?></h1>
						<span class="author"><?php _e('Par', THEME_NAME); ?> <?php the_author(); ?></span>

					</header>
					
					<div class="entry-content">

						<?php the_content(); ?>
						
					</div>

					<footer class="entry-meta">

						<?php edit_post_link( __( 'Edit', THEME_NAME ), '<span class="edit-link">', '</span>' ); ?>

					</footer>

				</div>

				<div class="c1">
					
					partage

				</div>

			</article>

		<?php endwhile; ?>

	</div><!-- #content -->

<?php get_footer(); ?>
