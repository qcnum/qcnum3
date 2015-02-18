<?php get_header(); ?>

	<div id="content" role="main">

		<header class="page-header">
			<h1 class="page-title">
				<?php if ( is_day() ) : ?>
								<?php printf( __( 'Archive hebdomadaire : <span>%s</span>' ), get_the_date() ); ?>
				<?php elseif ( is_month() ) : ?>
								<?php printf( __( 'Archive mensuelle : <span>%s</span>' ), get_the_date( _x( 'F Y', 'monthly archives date format' ) ) ); ?>
				<?php elseif ( is_year() ) : ?>
								<?php printf( __( 'Archive annuelle : <span>%s</span>' ), get_the_date( _x( 'Y', 'yearly archives date format' ) ) ); ?>
				<?php else : ?>
								<?php _e( 'Archives', THEME_NAME ); ?>
				<?php endif; ?>
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

<?php get_footer(); ?>
