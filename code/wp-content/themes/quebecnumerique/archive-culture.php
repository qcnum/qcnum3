<?php
get_header();

query_posts(
	array(
		'post_type' => 'culture',
		'posts_per_page' => 5
	)
);
?>


	<div id="content" class="sticky-event">

		<?php if ( have_posts() ) : ?>

			<div class="large-wrapper">

					<?php while ( have_posts() ) : the_post(); ?>

							<article class="white-post evenements">

								<div class="padding">

									<?php
										if(has_post_thumbnail()) :
										$id = get_post_thumbnail_id();
										$url = wp_get_attachment_image_src( $id , 'thumbnail'); ?>
										<div class="c2">
											<div class="padding">
												<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><img src="<?php echo $url[0]; ?>" alt=""></a>
											</div>
										</div>
									<?php endif; ?>

									<div class="c10">
										<div class="c10">
											<div class="entry-content padding">
												<h3 class="h2"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h3>
												<div class="excerpt"><?php the_excerpt(); ?></div>
												<hr class="clear">
												<p><a class="btn" href="<?php the_permalink(); ?>" title="<?php _e('En savoir plus', THEME_NAME); ?>"><?php _e('En savoir plus', THEME_NAME); ?></a></p>
											</div>
										</div>
									</div>


								</div>

							</article>

					<?php endwhile; ?>

				</div>

				</section>

				<?php paging_nav(); ?>

			</div>

		<?php else : ?>

			<div class="large-wrapper">
				<section class="group">
					<header class="c1"><h2>⊙︿⊙</h2></header>
					<div class="c11 fr">
						<article class="white-post evenements group">
							<div class="padding">
								<div class="c12">
									<p><?php _e('Aucun article', THEME_NAME); ?></p>
								</div>
							</div>
						</article>
					</div>
				</section>
			</div>

		<?php endif; ?>

	</div><!-- #content -->

<?php get_footer(); ?>
