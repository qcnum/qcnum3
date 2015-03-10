<?php 
get_header(); ?>

	<div id="content" role="main">

		<?php

		$queried_object = get_queried_object();
		$id = $queried_object->cat_ID;	
		if ($id == 2) {
		  	$class="nouvelles";
		} else if ($id == 3) {
			$class="articles";
		};
		?>
		<!--header class="page-header header-post-type <?php echo $class?>">
			<div class="c12">
				<h1 class="page-title"><?php single_cat_title(); ?></h1>
			</div>
			<div class="shapeheader tri1"></div>
			<div class="shapeheader tri2"></div>
			<div class="shapeheader tri3"></div>
			<div class="shapeheader tri4"></div>
			<div class="shapeheader tri5"></div>
			<hr class="clear"></hr>

		</header-->

			
			<div class="<?php echo $class?> group img-box">
				<?php if ( have_posts() ) : ?>

					<?php
						$category_description = category_description();
						if ( ! empty( $category_description ) )
							echo '<div class="archive-meta">' . $category_description . '</div>';
					?>

					<div class="large-wrapper">

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

					</div>

					<?php paging_nav(); ?>

				<?php else : ?>

					<?php get_template_part( 'content', 'none' ); ?>

				<?php endif; ?>
			</div>


	</div><!-- #content -->

	<hr class="clear"></hr>

<?php get_footer(); ?>
