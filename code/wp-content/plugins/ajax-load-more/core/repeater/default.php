<div class="c3">
										<div class="padding"><article >
		<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
			<div class="content">
				<span class="date"><?php echo get_the_date(); ?></span>
				<h3 class="grisopac-bg"><?php the_title(); ?><span class="triangle"></span></h3>
				<div class="excerpt-hover"><?php the_excerpt(); ?></div>
			</div>

			<?php if(has_post_thumbnail()) : 
				$id = get_post_thumbnail_id();
			else : 
				$category = get_the_category();
				if ( $category[0]->cat_ID == 2) {$id = get_field('img-nouvelles', 'options'); }
				if ( $category[0]->cat_ID == 3) {$id = get_field('img-articles', 'options'); }
				
			endif; 

			$url = wp_get_attachment_image_src( $id , 'rectangle');?>

			<div class="img" style="background-image: url('<?php echo $url[0]; ?>')" ></div>
		</a>
                                        </article></div></div>