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
						$id = get_field('img-nouvelles', 'options');
						$url = wp_get_attachment_image_src( $id , 'rectangle'); ?>
						<div class="img" style="background-image: url('<?php echo $url[0]; ?>')" ></div>
						</article>

					</div>
				</div>
			</div>
		</div>
	</div>
