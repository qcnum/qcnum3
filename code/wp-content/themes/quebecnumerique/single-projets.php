<?php 
get_header(); 
$nouvelles = new WP_Query( array(
	'connected_type' => 'projets-to-post',
	'connected_items' => get_queried_object(),
	'nopaging' => true,
) );

$evenements = new WP_Query( array(
	'connected_type' => 'projets-to-evenements',
	'connected_items' => get_queried_object(),
	'nopaging' => true,
) );

$organisations = new WP_Query( array(
	'connected_type' => 'organisations-to-projets',
	'connected_items' => get_queried_object(),
	'nopaging' => true,
) );
?>

	<div id="content" role="main">

		<?php while ( have_posts() ) : the_post(); ?>

			<article <?php post_class(); ?>>

				<header class="entry-header">

					<span><?php echo get_post_type(); ?></span>

					<h1 class="entry-title"><?php the_title(); ?></h1>

				</header>
				
				<div class="entry-content">

					<?php the_content(); ?>

					<h2>Nouvelles</h2>

					<?php if ( $nouvelles->have_posts() ) :

						while ( $nouvelles->have_posts() ) : $nouvelles->the_post(); ?>

							<h3><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h3>

						<?php endwhile; wp_reset_postdata();

					endif; ?>

					<h2>Événements</h2>

					<?php if ( $evenements->have_posts() ) :

						while ( $evenements->have_posts() ) : $evenements->the_post(); ?>

							<h3><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h3>

						<?php endwhile; wp_reset_postdata();

					endif; ?>

					<h2>Organisations</h2>

					<?php if ( $organisations->have_posts() ) :

						while ( $organisations->have_posts() ) : $organisations->the_post(); ?>

							<h3><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h3>

						<?php endwhile; wp_reset_postdata();

					endif; ?>
					
				</div>

				<footer class="entry-meta">

					<?php edit_post_link( __( 'Edit', THEME_NAME ), '<span class="edit-link">', '</span>' ); ?>

				</footer>

			</article>

		<?php endwhile; ?>

	</div><!-- #content -->

<?php get_footer(); ?>
