	<a href="<?php the_permalink(); ?>">
		<div class="content">
			<span class="date"><?php echo get_the_date(); ?></span>
			<h3 class="grisopac-bg"><?php the_title(); ?></h3>
			<hr class="clear">
			<div class="excerpt-hover"><?php the_excerpt(); ?></div>
		</div>
		<?php the_post_thumbnail('rectangle'); ?>
	</a>