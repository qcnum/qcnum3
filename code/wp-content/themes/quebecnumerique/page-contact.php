<?php 
/*
* Template name: Contact
*/
get_header(); ?>

	<div id="content" role="main" class="a-propos">




		<?php if( have_posts() ) while ( have_posts() ) : the_post(); ?>

			<div class="coordonees large-wrapper group">
				<div class="c12">
					<div class="padding">
						<div class="entry-content">
							<?php 
							$telephone = get_field('telephone'); 
							$email = get_field('courriel'); 
							?>
							<a href="#" class="bleufonce-bg"><?php echo $telephone ?></a>
							<hr class="clear">
							<a href="#" class="bleufonce-bg"><?php echo $email ?></a>
						</div>
					</div>
				</div>
			</div>



			<section class="equipe large-wrapper white-post group">

				<div class="entry-content c12 padding ">
					<h2><?php the_field('equipe_titre'); ?> </h2>
					<?php the_field('equipe_texte'); ?>

				</div>

				<?php $membres = get_field('membres'); ?>



				<div class="group padding">
				
					
					<?php foreach($membres as $m) : 
						$nom = $m['nom'];
						$photoid = $m['photo'];
						$titre = $m['titre'];
						$url = wp_get_attachment_image_src($photoid, 'profil');
						?>
						<a href="#" class="c3 pb1em">
							<div class="padding">
								<div class="membre">
									<div class="img" style="background-image: url('<?php echo $url[0]; ?>')" ></div>
									<div class="content">
										<span class="bleufonce-bg"><?php echo $nom; ?></span>
										<hr class="clear">
										<?php if ($titre != null){ ?>
											<span class="orange-bg"><?php echo $titre; ?></span>
										<?php }; ?>
										
									</div>

								</div>
							</div>
						</a>


					<?php endforeach; ?>

	
				</div>

			</section>


		<?php endwhile; ?>

	</div><!-- #content -->

<footer class="entry-meta">
	<?php edit_post_link( __( 'Edit', THEME_NAME ), '<span class="edit-link">', '</span>' ); ?>
</footer>

<?php get_footer(); ?>
