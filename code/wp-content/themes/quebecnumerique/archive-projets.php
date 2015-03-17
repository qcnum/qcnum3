<?php get_header(); ?>

	<div id="content" role="main">

		<?php if ( have_posts() ) : ?>

			<div class="large-wrapper">

				<div class="group all-projets">
				
					<?php while ( have_posts() ) : the_post(); ?>

					<?php 
					$organisations = new WP_Query( array(
						'connected_type' => 'organisations-to-projets',
						'connected_items' => $post,
						'nopaging' => true,
					) );
					?>

						<div class="c6">
							<div class="padding">
								<article class="white-post group">
									<div class="padding">
										<div class="c3">
											<div class="padding">
												<aside class="featured-img">
													<?php 
													if(has_post_thumbnail()) : $id = get_post_thumbnail_id();
													else : $id = get_field('img-evenements', 'options'); endif; 
													$url = wp_get_attachment_image_src( $id , 'profil'); ?>
													<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><img src="<?php echo $url[0]; ?>" alt=""></a>
												</aside>
											</div>
										</div>
										<div class="c9">
											<div class="padding entry-content">
												<h1 class="h2"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h1>
												<?php 
												$secteurs = get_field('secteurs');
												if($secteurs) : ?>
													<p class="list-secteurs group">
														<?php foreach($secteurs as $s) :
															echo '<span>'.$s->name.'</span>';
														endforeach; ?>
													</p>
												<?php endif; ?>
												
												<?php the_excerpt(); ?>

												<?php 
												if ( $organisations->have_posts() ) : $numO = $organisations->post_count; ?>
												<p><strong><?php echo _n('Organisation', 'Organisations', $numO, THEME_NAME); ?> : </strong>
													<?php while ( $organisations->have_posts() ) : $organisations->the_post(); ?>
														<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a>
													<?php endwhile; wp_reset_postdata(); ?></p>
												<?php endif; ?>

											</div>
										</div>
									</div>
								</article>
							</div>
						</div>

					<?php endwhile; ?>

					<?php paging_nav(); ?>

				</div>
				
			</div>

		<?php else : ?>

			<?php get_template_part( 'content', 'none' ); ?>
				
		<?php endif; ?>

	</div><!-- #content -->
	
<?php get_footer(); ?>
