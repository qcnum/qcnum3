<?php get_header(); ?>

	<div id="content">

		<div class="blanc-bg group">

			<?php if ( have_posts() ) : ?>

				<div class="partenaires">

					<?php while ( have_posts() ) : the_post(); ?>

						<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_post_thumbnail('medium'); ?></a>

					<?php endwhile; ?>

				</div>

			<?php else : ?>

				<?php get_template_part( 'content', 'none' ); ?>
					
			<?php endif; ?>

		</div>

	</div><!-- #content -->
			
<?php get_footer(); ?>