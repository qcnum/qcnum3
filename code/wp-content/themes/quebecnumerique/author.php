<?php get_header(); ?>

	<div id="content" role="main">

		<header class="page-header">
			<h1 class="page-title">
				<?php printf( __( 'Tous les articles de %s', THEME_NAME ), get_the_author() ); ?>
			</h1>
		</header>

		<?php if ( have_posts() ) : ?>

			<?php while ( have_posts() ) : the_post(); ?>

				<?php get_template_part( 'content', get_post_format() ); ?>

			<?php endwhile; ?>

			<?php paging_nav(); ?>

		<?php else : ?>

			<?php get_template_part( 'content', 'none' ); ?>
				
		<?php endif; ?>
		
	</div><!-- #content -->

<?php get_sidebar(); ?>

<?php get_footer(); ?>
