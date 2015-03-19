<?php 
get_header(); 
$queried_object = get_queried_object();
query_posts(array(
	'post_type' => 'post',
	'mots-cles' => $queried_object->slug
));
?>

	<div id="content" class="large-wrapper" role="main">

		<div class="nouvelles group img-box">

			<div class="large-wrapper">
				<?php if ( have_posts() ) : ?>

					<?php $cpt = 1; ?>

					<div class="cinq">

						<div class="group">

							<?php while ( have_posts() ) : the_post(); ?>

								<div class="c3">
									<div class="padding">
										<?php get_template_part('content', 'imgbox'); ?>
									</div>
								</div>
								
								<?php if ($cpt % 5 == 0) { ?></div><div class="group"><?php } ?>
					
							<?php $cpt++; endwhile; ?>

						</div>

					</div>

					<?php 
					echo do_shortcode('[ajax_load_more post_type="post" taxonomy="mots-cles" taxonomy_terms="'.$queried_object->slug.'" offset="15" pause="true" scroll="false" posts_per_page="8" transition="fade" button_label="Afficher plus de nouvelles"]'); 
					?>

				<?php else : ?>

					<?php get_template_part( 'content', 'none' ); ?>

				<?php endif; ?>

			</div>

		</div>

	</div><!-- #content -->
			
<?php get_footer(); ?>