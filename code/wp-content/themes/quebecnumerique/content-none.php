	<div class="img-box">
		<div class="cinq">
			<div class="group">
				<div class="c3">
					<div class="padding">
						<article >
						<div class="content content-none">
							<h3 class="grisopac-bg"><?php _e( 'Rien de trouvé', THEME_NAME ); ?></h3>
							<div class="excerpt-hover"><p><?php _e( 'Désolé, mais rien ne correspond.', THEME_NAME ); ?></p></div>
						</div>

						<?php 
						$queried_object = get_queried_object();
						$id = $queried_object->cat_ID;	
						$name = $queried_object->name;
						if ($id == 2) { $id = get_field('img-nouvelles', 'options'); } 
						elseif ($id == 3) { $id = get_field('img-articles', 'options'); } 
						elseif ($name == 'projets') { $id = get_field('img-projets', 'options');
						} else { $id = get_field('img-nouvelles', 'options'); }
						$url = wp_get_attachment_image_src( $id , 'rectangle'); ?>
						<div class="img" style="background-image: url('<?php echo $url[0]; ?>')" ></div>
						</article>

					</div>
				</div>
			</div>
		</div>
	</div>
