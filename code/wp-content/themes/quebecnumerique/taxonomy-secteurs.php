<?php 
get_header(); 
$queried_object = get_queried_object();
query_posts(array(
	'posts_per_page' => -1,
	'orderby' => 'name',
	'order' => 'ASC',
	'secteurs' => $queried_object->slug
));
?>

	<div id="content">

		<article <?php post_class('white-post group'); ?>>

			<div class="c12">

				<div class="padding entry-content">

					<?php if ( have_posts() ) : ?>

						<ul>
							<?php while ( have_posts() ) : the_post(); ?>
								<li><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></li>
							<?php endwhile; ?>
						</ul>

					<?php endif; ?>

				</div>

			</div>

		</article>

	</div><!-- #content -->
			
<?php get_footer(); ?>