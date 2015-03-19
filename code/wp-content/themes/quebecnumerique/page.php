<?php get_header(); ?>

	<div id="content" role="main">

		<?php if( have_posts() ) while ( have_posts() ) : the_post(); ?>

			<article <?php post_class('white-post group'); ?>>

				<div class="c12">
			
					<header class="entry-header">

						<h1 class="entry-title"><?php the_title(); ?></h1>

					</header>

					<div class="entry-content">

						<?php the_content(); ?>

					</div>

				</div>

			</article>

		<?php endwhile; ?>

	</div><!-- #content -->

<?php get_footer(); ?>
