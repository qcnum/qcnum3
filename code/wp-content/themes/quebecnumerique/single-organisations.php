<?php 
get_header(); 
/*$nouvelles = new WP_Query( array(
	'connected_type' => 'organisations-to-post',
	'connected_items' => get_queried_object(),
	'nopaging' => true,
) ); */

$evenements = new WP_Query( array(
	'connected_type' => 'organisations-to-evenements',
	'connected_items' => get_queried_object(),
	'nopaging' => true,
) );

$projets = new WP_Query( array(
	'connected_type' => 'organisations-to-projets',
	'connected_items' => get_queried_object(),
	'nopaging' => true,
) );
?>

	<div id="content" role="main">

		<?php while ( have_posts() ) : the_post(); ?>

			<article <?php post_class('white-post group'); ?>>

				<div class="large-wrapper">

					<div class="c7" role="main">

						<div class="padding entry-content">

							<?php the_content(); ?>
							
						</div>

					</div>

					<div class="c1">
						<div class="padding">
							<?php echo do_shortcode('[juiz_sps counters="1" buttons="facebook, twitter, google, pinterest, linkedin, mail"]'); ?>
						</div>
					</div>

					<div class="c4">
						<div class="padding">

							<aside class="featured-img">
								<?php 
								if(has_post_thumbnail()) : $id = get_post_thumbnail_id();
								else : $id = get_field('img-organisations', 'options'); endif; 
								$url = wp_get_attachment_image_src( $id , 'rectangle-nocrop'); ?>
								<img src="<?php echo $url[0]; ?>" alt="">
							</aside>

							<?php 
							$map = get_field('localisation');
							if ( $map["address"] != "" ) : ?>
								<aside class="info-event group">
									<div class="date">
										<i class="fa fa-map-marker"></i> <?php echo $map['address']; ?>	
									</div>
								</aside>
							<?php endif; ?>

							<?php 
							$motsCles = wp_get_post_terms(get_the_ID(), 'mots-cles');
							if ( $motsCles ) : $numMC = count($motsCles); ?>
								<aside>
									<div class="group">
										<h2 class="h2"><?php echo _n('Mot-clé', 'Mots-clés', $numMC, THEME_NAME); ?> <?php _e('en lien', THEME_NAME); ?></h2>
										<?php foreach ( $motsCles as $mc ) : ?>
											<a class="mot-cle" href="/index.php?s=&amp;mots-cles[]=<?php echo $mc->slug; ?>" title="<?php echo $mc->name; ?>"><?php echo $mc->name ?></a>
										<?php endforeach; ?>	
									</div>
								</aside>
							<?php endif; ?>

							<?php if ( $projets->have_posts() ) : $numP = $projets->post_count; ?>
								<aside>
									<div>
										<h2 class="h2"><?php echo _n('Projet', 'Projets', $numP, THEME_NAME); ?> <?php _e('en lien', THEME_NAME); ?></h2>
										<?php while ( $projets->have_posts() ) : $projets->the_post(); ?>
											<h3><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h3>
										<?php endwhile; wp_reset_postdata(); ?>
									</div>
								</aside>
							<?php endif; ?>

							<?php if ( $evenements->have_posts() ) : $numE = $evenements->post_count; ?>
								<aside>
									<div class="box-evenements">
										<h2><?php echo _n('Événement', 'Événements', $numE, THEME_NAME); ?> <?php _e('en lien', THEME_NAME); ?></h2>
										<?php while ( $evenements->have_posts() ) : $evenements->the_post();
											$startDate = get_field('startdate');
											$myDate = strftime('%e %B %Y', $startDate/1000);
											$endDate = get_field('enddate');
											$myDate2 = strftime('%e %B %Y', $endDate/1000);
											if($startDate != $endDate) { $date = 'Du ' . $myDate . ' au ' . $myDate2; } 
											else { $date = 'Le ' . $myDate; }
											$startHrs = get_field('hrs_debut');
											$endHrs = get_field('hrs_fin');
											if($startHrs && !$endHrs) {
												$hrs = ' | <span class="hrs">' . date('G\hi', $startHrs) . '</span>';
											} elseif($startHrs && $endHrs) {
												$hrs = ' | <span class="hrs">' . date('G\hi', $startHrs) . ' à ' . date('G\hi', $endHrs) . '</span>';
											}
											?>
											<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
												<article class="group">

													<?php if(has_post_thumbnail()) : 
														the_post_thumbnail('thumbnail');
													else : 
														$category = get_the_category();
														$id = get_field('img-evenements', 'options'); 
														$url = wp_get_attachment_image_src( $id , 'thumbnail');
														?>
														
														<img src="<?php echo $url[0] ?>" alt="Événements">
													<?php endif; ?>

													<div class="content">
														<div class="ellipsis info-event">
															<span class="date"><?php echo $date; ?><?php if($hrs) echo $hrs; ?></span>
															<?php if(get_field('nom_du_lieu')) : ?><span class="lieu"><i class="fa fa-map-marker"></i> <?php the_field('nom_du_lieu'); ?></span><?php endif; ?>
														</div>
														<h3 class="ellipsis"><?php the_title(); ?></h3>
													</div>
												</article>
											</a>
										<?php endwhile; wp_reset_postdata(); ?>
									</div>
								</aside>
							<?php endif; ?>
						</div>
					</div>

				</div>

			</article>

			<?php related_posts(); ?>

		<?php endwhile; ?>

	</div><!-- #content -->

<?php get_footer(); ?>
