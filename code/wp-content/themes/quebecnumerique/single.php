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

			<article <?php post_class('white-post group'); ?>>

				<div class="large-wrapper">

					<div class="c7" role="main">

						<div class="padding entry-content">

							<div class="ellipsis info-event">
								<span class="date"><?php the_date(); ?> | <span class="hrs"><?php the_time(); ?></span></span>
							</div>

							<?php the_content(); ?>

						</div>

						<div class="author entry-content group">

							<hr>
									
							<?php 
							$id =  get_the_author_meta( 'ID' );
							$name = get_the_author_meta( 'display_name' );
							$titre = get_field('titre', 'user_'.$id);
							$desc = get_the_author_meta( 'description' ); ?>

							<div class="c2"><div class="padding"><?php echo get_avatar( $id, 200 ); ?></div></div>
							<div class="c10">
								<div class="padding">
									<h2 class="h4"><?php _e('Par', THEME_NAME); ?> <?php the_author(); ?></h2>
									<?php if($desc) : ?><p><?php echo $desc; ?></p><?php endif; ?>
									<?php 
									$collab = get_posts('posts_per_page=3&author='.$id);
									if($collab) : ?>
										<h3 class="h5"><?php _e('Collaborations récentes'); ?></h3>
										<ul>
										<?php foreach($collab as $post) : setup_postdata( $post ); ?>
											<li><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></li>
										<?php endforeach; ?>
										</ul>
									<?php endif; wp_reset_postdata(); ?>
									<a href="<?php echo get_author_posts_url(get_the_author_meta( 'ID' )); ?> " class="btn" title="<?php _e('Voir toutes les collaborations', THEME_NAME); ?>"><?php _e('Voir toutes les collaborations', THEME_NAME); ?></a>
								</div>
							</div>

							<?php // comments_template(); ?>
							
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
								<?php if(has_post_thumbnail()) : 
									$id = get_post_thumbnail_id();
								else : 
									$category = get_the_category();
									if ( $category[0]->cat_ID == 2) {$id = get_field('img-nouvelles', 'options'); }
									if ( $category[0]->cat_ID == 3) {$id = get_field('img-articles', 'options'); }
								endif; 
								$url = wp_get_attachment_image_src( $id , 'rectangle-nocrop'); ?>
								<img src="<?php echo $url[0]; ?>" alt="">
							</aside>

							<?php 
							$map = get_field('localisation');
							if ( $map["address"] != "" ) : ?>
								<aside class="info-event">
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
										<div class="entry-content">
											<ul>
												<?php while ( $projets->have_posts() ) : $projets->the_post(); ?>
													<li><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></li>
												<?php endwhile; wp_reset_postdata(); ?>
											</ul>
										</div>
									</div>
								</aside>
							<?php endif; ?>

							<?php if ( $evenements->have_posts() ) : $numE = $evenements->post_count; ?>
								<aside>
									<div class="box-evenements">
										<h2><?php echo _n('Événement', 'Événements', $numE, THEME_NAME); ?> <?php _e('en lien', THEME_NAME); ?></h2>
										<?php while ( $evenements->have_posts() ) : $evenements->the_post(); ?>
											<a title="<?php the_title(); ?>" href="<?php the_permalink(); ?>">
												<article class="grispale-bg group">
													<?php the_post_thumbnail('thumbnail'); ?>
													<div class="content">
														<div class="ellipsis info-event">
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

							<?php if ( $organisations->have_posts() ) : $numO = $organisations->post_count; ?>
								<aside class="featured-img">
									<h2><?php echo _n('Organisation', 'Organisations', $numO, THEME_NAME); ?> <?php _e('en lien', THEME_NAME); ?></h2>
									<div class="group org">
										<?php while ( $organisations->have_posts() ) : $organisations->the_post(); ?>
											<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_post_thumbnail('medium'); ?></a>
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
