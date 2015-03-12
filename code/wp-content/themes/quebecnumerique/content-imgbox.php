
	<article >
		<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
			<div class="content">
				<span class="date"><?php echo get_the_date(); ?></span>
				<h3 class="grisopac-bg"><?php the_title(); ?><div class="triangle"></div></h3>
				<div class="excerpt-hover"><?php the_excerpt(); ?></div>
			</div>
			<?php if(has_post_thumbnail()) : ?>
				<?php 
				$id = get_post_thumbnail_id();
				$url = wp_get_attachment_image_src( $id , 'rectangle');
				?>

				<div class="img" style="background-image: url('<?php echo $url[0]; ?>')" ></div>
				
			<?php else : ?>
				<div class="img" style="background-image: url('http://placehold.it/700x500')" ></div>
			<?php endif; ?>
		</a>
	</article>