<?php get_header(); ?>

	<div id="content" role="main">

		<?php
		$id = get_the_ID();
		
		if ($id == 330) {
		  $class="nouvelles";
		} else if ($id == 329) {
			$class="articles";
		};


		?>

		<header class="page-header header-post-type <?php echo $class?>">
			<div class="c12">
				<h1 class="page-title"><?php single_cat_title(); ?></h1>
				
			</div>
			<hr class="clear"></hr>
		</header>

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

	<hr class="clear"></hr>

<?php get_footer(); ?>
