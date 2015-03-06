<?php get_header(); ?>

	<div id="content" role="main">

		<header class="page-header header-post-type">
			<h1 class="page-title"><?php single_cat_title(); ?></h1>
		</header>

		<p>dsgdfgdfsdfh</p>
		<div class="c12">
			
			<div class="nouvelles group cinq img-box">
				<?php if ( have_posts() ) : ?>

					<?php
						$category_description = category_description();
						if ( ! empty( $category_description ) )
							echo '<div class="archive-meta">' . $category_description . '</div>';
					?>

					<div>
					<?php while ( have_posts() ) : the_post(); ?>
						<article class="c6">
							<?php include 'content-imgbox.php'; ?>
						</article>
					<?php endwhile; ?>
					</div>

					<?php paging_nav(); ?>

				<?php else : ?>

					<?php get_template_part( 'content', 'none' ); ?>

				<?php endif; ?>
			</div>

		</div>

	</div><!-- #content -->

<?php get_footer(); ?>
