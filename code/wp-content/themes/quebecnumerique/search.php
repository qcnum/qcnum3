<?php get_header(); ?>

	<div id="content" role="main">

		<header class="page-header">
			<h1 class="page-title">
				<?php printf( __( 'Résultat de recherche pour: %s', THEME_NAME ), '<span></span>' ); ?>
			</h1>
		</header>

		<?php if ( have_posts() ) : ?>

			<?php while ( have_posts() ) : the_post(); ?>

				<h1><?php echo get_post_type(); ?></h1>
				<h2><?php the_title(); ?></h2>
				<h3><?php the_category(); ?></h3>
				<hr>
			<?php endwhile; ?>

			<?php paging_nav(); ?>

		<?php else : ?>

			<?php get_template_part( 'content', 'none' ); ?>
				
		<?php endif; ?>

	</div><!-- #content -->

<?php get_footer(); ?>
