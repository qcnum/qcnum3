<?php 
get_header(); ?>

	<div id="content" class="category" role="main">

		<?php

		$queried_object = get_queried_object();
		$id = $queried_object->cat_ID;	
		if ($id == 2) {
		  	$class="nouvelles";
		} else if ($id == 3) {
			$class="articles";
		};
		?>

			
			<div class="<?php echo $class?> group img-box">

				<div class="large-wrapper">
					<?php if ( have_posts() ) : ?>

						<?php
							$category_description = category_description();
							if ( ! empty( $category_description ) )
								echo '<div class="archive-meta">' . $category_description . '</div>';
						?>

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

						$category = get_the_category();
						if ( $category[0]->cat_ID == 2) { $cat = 'nouvelles'; }
						if ( $category[0]->cat_ID == 3) { $cat = 'chroniques'; }
						echo do_shortcode('[ajax_load_more post_type="post" category="'.$cat.'" offset="15" pause="true" scroll="false" posts_per_page="8" transition="fade" button_label="Afficher plus de '.$cat.'"]'); 
						?>
						
						<?php //paging_nav(); ?>

					<?php else : ?>

						<?php get_template_part( 'content', 'none' ); ?>

					<?php endif; ?>

				</div>

			</div>


	</div><!-- #content -->

	<hr class="clear">

<?php get_footer(); ?>
