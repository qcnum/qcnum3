<?php get_header(); ?>

	<div id="content">



		<header class="page-header">
			<h1 class="page-title"><?php post_type_archive_title(); ?></h1>
		</header>
		<p>ici</p>
		<?php if ( have_posts() ) : ?>

			<?php while ( have_posts() ) : the_post(); ?>

				<div class="group">

					<div class="c1">
						
						<?php the_date('F') ?>

					</div>
	
					<div class="c11">

						<article <?php post_class(); ?>>

							<?php echo get_the_date() ?>


							<h1 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>

							
							<div class="entry-content">

								<?php the_excerpt(); ?>

							</div>

						

						</article>

					</div>

				</div>

			<?php endwhile; ?>
			
			<?php paging_nav(); ?>

		<?php else : ?>

			<?php get_template_part( 'content', 'none' ); ?>
				
		<?php endif; ?>

	</div><!-- #content -->

<?php get_footer(); ?>
