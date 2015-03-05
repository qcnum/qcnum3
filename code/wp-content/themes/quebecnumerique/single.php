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

	<div id="content">

		<?php while ( have_posts() ) : the_post(); ?>

			<article <?php post_class('wrapper group'); ?>>

				<secondary class="c4">

					<aside>
						<?php the_post_thumbnail('large'); ?>
					</aside>

					<?php 
					$map = get_field('localisation');
					if ( $map ) : ?>

						<aside>

							<div>

								<i class="fa fa-map-marker"></i> <?php echo $map['address']; ?>
									
							</div>

						</aside>

					<?php endif; ?>

					<?php 
					$motsCles = wp_get_post_terms(get_the_ID(), 'mots-cles');
					if ( $motsCles ) : ?>

						<aside>

							<div class="group">

								<h2><?php _e('Mots-clés', THEME_NAME); ?></h2>

								<?php foreach ( $motsCles as $mc ) : ?>

									<a class="mot-cle" href="<?php echo get_term_link( $mc, 'mots-cles' ); ?>" title="<?php echo $mc->name; ?>"><?php echo $mc->name ?></a>

								<?php endforeach; ?>
									
							</div>

						</aside>

					<?php endif; ?>

					<?php if ( $projets->have_posts() ) : ?>

						<aside>

							<div>

								<h2><?php _e('Projets en lien', THEME_NAME); ?></h2>

								<?php while ( $projets->have_posts() ) : $projets->the_post(); ?>

									<h3><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h3>

								<?php endwhile; wp_reset_postdata(); ?>

							</div>

						</aside>

					<?php endif; ?>

					<?php if ( $evenements->have_posts() ) : ?>

						<aside>

							<div class="evenements">

								<h2><?php _e('Événements en lien', THEME_NAME); ?></h2>

								<?php while ( $evenements->have_posts() ) : $evenements->the_post(); ?>
									
									<a title="<?php the_title(); ?>" href="<?php the_permalink(); ?>">
										<article class="grispale-bg group">
											<?php the_post_thumbnail('thumbnail'); ?>
											<div class="content">
												<div class="ellipsis info">
													<span class="date"><?php echo get_the_date(); ?></span>
													<span class="lieu"><i class="fa fa-map-marker"></i> L'Abri-co / 255 boulevard Charest Est</span>
												</div>
												<h3 class="ellipsis"><?php the_title(); ?></h3>
											</div>
										</article>
									</a>

								<?php endwhile; wp_reset_postdata(); ?>

							</div>

						</aside>

					<?php endif; ?>

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

				</secondary>
			
				<div class="c7" role="main">

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

					<div class="sharing">
						<a href="#" class="sharer" title="Sharing"><span>Partager</span> <i class="fa fa-share-alt"></i></a>
						<div>
							<?php $urlimg = wp_get_attachment_url( get_post_thumbnail_id($post->ID) ); ?>
							<a target="_blank" href="http://www.facebook.com/sharer/sharer.php?u=<?php the_permalink(); ?>" class="fb" title="Facebook"><span>Facebook</span> <i class="fa fa-facebook"></i></a>
							<a target="_blank" href="https://twitter.com/intent/tweet?url=<?php the_permalink(); ?>&amp;text=<?php the_title(); ?>&amp;via=<?php echo bloginfo('name'); ?>" class="tw" title="Twitter"><span>Twitter</span> <i class="fa fa-twitter"></i></a>
							<a target="_blank" href="https://plus.google.com/share?url=<?php the_permalink(); ?>&amp;title=<?php the_title(); ?>" class="gp" title="Google+"><span>Google+</span> <i class="fa fa-google-plus"></i></a>
							<a target="_blank" href="https://www.linkedin.com/shareArticle?mini=true&amp;url=<?php the_permalink(); ?>&amp;title=<?php the_title(); ?>&amp;summary=<?php echo get_the_excerpt(); ?>&amp;source=<?php echo bloginfo('name'); ?>" class="li" title="Linkedin"><span>Linkedin</span> <i class="fa fa-linkedin"></i></a>
							<a target="_blank" href="https://pinterest.com/pin/create/button/?url=<?php the_permalink(); ?>&amp;media=<?php echo $urlimg; ?>&amp;description=<?php echo get_the_excerpt(); ?>" class="pin" title="Pinterest"><span>Pinterest</span> <i class="fa fa-pinterest-p"></i></a>
							<a href="mailto:?subject=<?php the_title(); ?>&amp;body=<?php echo get_the_excerpt(); ?>" class="email" title="Courriel"><span>Courriel</span> <i class="fa fa-envelope"></i></a>
						</div>
					</div>

				</div>

			</article>

		<?php endwhile; ?>

	</div><!-- #content -->

<?php get_footer(); ?>
