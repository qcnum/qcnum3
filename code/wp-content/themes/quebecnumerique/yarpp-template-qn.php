<?php 
/*
YARPP Template: Québec Numérique
*/
?>


<?php if (have_posts()):?>

	<div class="group img-box">

		<div class="large-wrapper">

			<div class="padding">
				<h3>D'autres nouvelles qui pourraient vous intéresser...</h3>

			</div>

			<div class="group">

				<?php while (have_posts()) : the_post(); ?>

					<div class="c3">
						<div class="padding">
							<?php get_template_part('content', 'imgbox'); ?>
						</div>
					</div>
			
				<?php endwhile; ?>

			</div>

		</div>

	</div>

<?php endif; ?>



	