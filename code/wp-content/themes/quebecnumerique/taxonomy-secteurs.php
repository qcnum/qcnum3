<?php get_header(); ?>

	<div id="content">

		<div class="blanc-bg group">

			<div class="c12 group all-org">
				<h2 class="h2 fl"><?php //echo $category->name; ?></h2>
			</div>

			<?php if ( have_posts() ) : ?>

				<?php while ( have_posts() ) : the_post(); ?>

					<div class="c6">

						<div class="white-box event">

							<img src="http://placehold.it/300x300" alt="">
							
						</div>
						
					</div>

				<?php endwhile; ?>

			<?php else : ?>

				<?php get_template_part( 'content', 'none' ); ?>
					
			<?php endif; ?>

		</div>

	</div><!-- #content -->
			
<?php get_footer(); ?>