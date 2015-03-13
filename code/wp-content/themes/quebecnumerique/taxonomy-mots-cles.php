<?php 
get_header();
$term = get_queried_object(); 
query_posts( array( 'post_type' => 'post', 'mots-cles' => $term->name ));
?>

	<div id="content" class="large-wrapper" role="main">

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

					<?php paging_nav(); ?>

				<?php else : ?>

					<?php get_template_part( 'content', 'none' ); ?>

				<?php endif; ?>

			</div>

		</div>

	</div><!-- #content -->
			
<?php get_footer(); ?>