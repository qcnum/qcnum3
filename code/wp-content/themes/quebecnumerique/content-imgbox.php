
	<article>
		<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
			<div class="content">
				<span class="date"><?php echo get_the_date(); ?></span>
				<h3 class="grisopac-bg"><?php the_title(); ?><div class="triangle"></div></h3>
				<div class="excerpt-hover"><?php the_excerpt(); ?></div>
			</div>
			<?php the_post_thumbnail('rectangle'); ?>
			<div class="excerpt-degrade"></div>
		</a>
	</article>