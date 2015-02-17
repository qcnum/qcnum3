<?php get_header(); ?>

	<div id="content" role="main">

		<header class="page-header">
			<h1 class="page-title">
				<?php printf( __( 'Archive du mot-clé : %s' ), '<span>' . single_tag_title( '', false ) . '</span>' ); ?>
			</h1>
		</header>

		<?php if ( have_posts() ) : ?>

			<?php
				$tag_description = tag_description();
				if ( ! empty( $tag_description ) )
					echo '<div class="archive-meta">' . $tag_description . '</div>';
			?>

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
