<?php get_header(); ?>

	<div id="content" role="main">

		<header class="page-header">
			<h1 class="page-title"><?php single_cat_title(); ?></h1>
		</header>

		
		<div class="c12">
			<?php if ( have_posts() ) : ?>

				<?php
					$category_description = category_description();
					if ( ! empty( $category_description ) )
						echo '<div class="archive-meta">' . $category_description . '</div>';
				?>

				<?php while ( have_posts() ) : the_post(); ?>

					<?php get_template_part( 'content', get_post_format() ); ?>

				<?php endwhile; ?>

				<?php paging_nav(); ?>

			<?php else : ?>

				<?php get_template_part( 'content', 'none' ); ?>

			<?php endif; ?>
		</div>

	</div><!-- #content -->

<?php get_footer(); ?>
