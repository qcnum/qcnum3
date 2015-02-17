<?php get_header(); ?>

		<div id="content" role="main">

			<article <?php post_class(); ?>>

				<header class="entry-header">

					<h1 class="entry-title">404</h1>

				</header>

				<div class="entry-content">

					<?php _e( 'Page introuvable', THEME_NAME ); ?>

				</div>

			</article>

		</div><!-- #content -->
	
<?php get_footer(); ?>