<?php 
get_header(); 
$nouvelles = new WP_Query( array( 'post_type' => 'post', 'category_name' => 'nouvelles', 'posts_per_page' => 3 ) );
$veilles = new WP_Query( array( 'post_type' => 'post', 'category_name' => 'veilles', 'posts_per_page' => 2 ) );
$evenements = new WP_Query( array( 'post_type' => 'evenements', 'posts_per_page' => 3 ) );

?>

	<div id="content" role="main">

		<div class="c6">
			
			<div class="nouvelles group trois img-box">

				<h2><?php _e('Aux dernières nouvelles', THEME_NAME); ?></h2>

				<div>

					<?php if ( $nouvelles->have_posts() ) while ( $nouvelles->have_posts() ) : $nouvelles->the_post(); ?>

						<article class="c6">
							<div class="content"><?php the_title(); ?></div>
							<img src="http://placehold.it/580x440" alt="">
						</article>

					<?php endwhile; ?>

				</div>
			
			</div>

			<div class="veilles group img-box">

				<h2><?php _e('Les derniers articles', THEME_NAME); ?></h2>

				<?php if ( $veilles->have_posts() ) while ( $veilles->have_posts() ) : $veilles->the_post(); ?>

					<article class="c6">
						<div class="content"><?php the_title(); ?></div>
						<img src="http://placehold.it/580x440" alt="">
					</article>

				<?php endwhile; ?>
			
			</div>

		</div>

		<div class="c6">
			
			<div class="evenements group">

				<?php if ( $evenements->have_posts() ) while ( $evenements->have_posts() ) : $evenements->the_post(); ?>

					<article class="c12">
						<img src="http://placehold.it/75x75" class="fl" alt="">
						<div class="content"><?php the_title(); ?></div>
					</article>

				<?php endwhile; ?>
			
			</div>

		</div>

		<hr class="clear">

	</div><!-- #content -->

<?php get_footer(); ?>
