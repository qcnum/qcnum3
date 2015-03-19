
	<article <?php post_class(); ?>>

		<header class="entry-header">

			<?php the_post_thumbnail(); ?>

			<h1 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>

		</header>

		
		<div class="entry-content">

			<?php the_content(); ?>

		</div>
		
	</article>