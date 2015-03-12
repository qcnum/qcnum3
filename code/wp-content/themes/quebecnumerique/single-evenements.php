<?php 
get_header(); 
$nouvelles = new WP_Query( array(
	'connected_type' => 'evenements-to-post',
	'connected_items' => get_queried_object(),
	'nopaging' => true,
) );

$organisations = new WP_Query( array(
	'connected_type' => 'organisations-to-evenements',
	'connected_items' => get_queried_object(),
	'nopaging' => true,
) );

$projets = new WP_Query( array(
	'connected_type' => 'projets-to-evenements',
	'connected_items' => get_queried_object(),
	'nopaging' => true,
) );
?>

	<div id="content">

		<?php while ( have_posts() ) : the_post(); ?>

			<article <?php post_class('white-post group'); ?>>

				<div class="large-wrapper">

					<div class="c7" role="main">

						<div class="padding">

							<header class="entry-header">

								<h1 class="entry-title"><?php the_title(); ?></h1>

								<?php echo get_the_date(); ?>

							</header>
							
							<div class="entry-content">

								<?php the_content(); ?>
								
							</div>

							<footer class="entry-meta">

								<?php edit_post_link( __( 'Edit', THEME_NAME ), '<span class="edit-link">', '</span>' ); ?>

							</footer>

						</div>

					</div>

					<secondary class="c5 fr group">

						<div class="c11">

							<div class="padding">

								<aside class="featured-img">
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

								<?php if ( $nouvelles->have_posts() ) : ?>

									<aside>

										<div class="evenements">

											<h2><?php _e('Nouvelles en lien', THEME_NAME); ?></h2>

											<?php while ( $nouvelles->have_posts() ) : $nouvelles->the_post(); ?>
												
												<a title="<?php the_title(); ?>" href="<?php the_permalink(); ?>">
													<?php the_title(); ?>
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

							</div>

						</div>

						<div class="c1">

							<div class="padding">

								<div class="sharing">
									<a href="#" class="sharer" title="Sharing"><i class="fa fa-share-alt"></i></a>
									<div>
										<?php 
										$urlimg = wp_get_attachment_url( get_post_thumbnail_id($post->ID) ); 
										$title = get_the_title(); $title = urlencode($title);
										$desc = get_the_excerpt(); $desc = urlencode($desc);
										$source = get_bloginfo('name'); $source = urlencode($source);
										?>

										<a target="_blank" href="http://www.facebook.com/sharer/sharer.php?u=<?php the_permalink(); ?>" class="fb" title="Facebook"><span>Facebook</span> <i class="fa fa-facebook"></i></a>
										<a target="_blank" href="https://twitter.com/intent/tweet?url=<?php the_permalink(); ?>&amp;text=<?php echo $title; ?>&amp;via=<?php echo $source; ?>" class="tw" title="Twitter"><span>Twitter</span> <i class="fa fa-twitter"></i></a>
										<a target="_blank" href="https://plus.google.com/share?url=<?php the_permalink(); ?>&amp;title=<?php echo $title; ?>" class="gp" title="Google+"><span>Google+</span> <i class="fa fa-google-plus"></i></a>
										<a target="_blank" href="https://www.linkedin.com/shareArticle?mini=true&amp;url=<?php the_permalink(); ?>&amp;title=<?php echo $title; ?>&amp;summary=<?php echo $desc; ?>&amp;source=<?php echo $source; ?>" class="li" title="Linkedin"><span>Linkedin</span> <i class="fa fa-linkedin"></i></a>
										<a target="_blank" href="https://pinterest.com/pin/create/button/?url=<?php the_permalink(); ?>&amp;media=<?php echo $urlimg; ?>&amp;description=<?php echo $desc; ?>" class="pin" title="Pinterest"><span>Pinterest</span> <i class="fa fa-pinterest-p"></i></a>
										<a href="mailto:?subject=<?php echo $title; ?>&amp;body=<?php echo $desc; ?>" class="email" title="Courriel"><span>Courriel</span> <i class="fa fa-envelope"></i></a>
													
									</div>
								</div>

							</div>

						</div>

					</secondary>

				</div>

			</article>

		<?php endwhile; ?>

	</div><!-- #content -->

<?php get_footer(); ?>
