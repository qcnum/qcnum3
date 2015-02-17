
	<article <?php post_class(); ?>>

		<header class="entry-header">

			<?php the_post_thumbnail(); ?>

			<h1 class="entry-title"><?php the_title(); ?></h1>

		</header>

		
		<div class="entry-content">

			<?php the_content(); ?>

		</div>

		<footer class="entry-meta">

			<?php edit_post_link( __( 'Edit', THEME_NAME ), '<span class="edit-link">', '</span>' ); ?>

		</footer>

	</article>