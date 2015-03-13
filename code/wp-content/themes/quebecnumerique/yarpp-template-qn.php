<?php 
/*
YARPP Template: Québec Numérique
*/
?>


<?php if (have_posts()):?>

	<div class="group related-posts">
		<div class="large-wrapper">
			<div class="padding group">
				<h3 class="c12"><?php _e('D\'autres nouvelles qui pourraient vous intéresser...', THEME_NAME); ?></h3>
			</div>
		</div>

		<div class="group">
			<?php while (have_posts()) : the_post(); ?>
				<div class="c3">
					<article>
						<span class="date"><?php echo get_the_date(); ?></span>
						<a class="img-related" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
							<div class="margin">
								<?php 
								if(has_post_thumbnail()) : 
									$id = get_post_thumbnail_id();
								else : 
									$category = get_the_category();
									if ( $category[0]->cat_ID == 2) { $id = get_field('img-nouvelles', 'options'); }
									if ( $category[0]->cat_ID == 3) { $id = get_field('img-articles', 'options'); }
								endif; 
								$url = wp_get_attachment_image_src( $id , 'rectangle');?>
								<div class="img" style="background-image: url('<?php echo $url[0]; ?>')" ></div>
							</div>
						</a>
						<h4><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h4>
					</article>
				</div>
			<?php endwhile; ?>
		</div>
	</div>

<?php endif; ?>



	