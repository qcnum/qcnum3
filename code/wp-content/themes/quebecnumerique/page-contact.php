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
							<a href="#"><?php echo $telephone ?></a>
							<hr class="clear">
							<a href="#"><?php echo $email ?></a>
						</div>

					</div>
				</div>
			</div>



			<section class="equipe large-wrapper white-post group padding">

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
									<span><?php echo $nom; ?></span>
									<span><?php echo $titre; ?></span>
								</div>
							</div>
						</a>


					<?php endforeach; ?>

	
				</div>

			</section>

			<!--section>

				<div class="entry-content">

					<?php the_field('texte_collaborateurs'); ?>

					<?php
					$collab = get_field('collaborateurs');
					$chunk = partition($collab, 4); ?>

					<div class="group">
						<?php foreach ($chunk as $ch) : ?>
							<div class="c3">
								<?php foreach($ch as $c) :
									$id = $c['ID'];
									$name = $c['display_name'];
									$titre = get_field('titre', 'user_'.$id);
									$photo = $c['user_avatar'];
									$desc = $c['user_description']; ?>
									<div class="padding">
										
										<div class="white-post entry-content">
											<div class="padding">
												<?php echo get_avatar( $id, 200 ); ?> 
												<h2><?php echo $name; ?></h2>
												<?php echo $titre; ?>
												<p><?php echo $desc; ?></p>
												<a href="#" class="btn">Voir les collaborations</a>

											</div>
		
										</div>
									</div>
									
								<?php endforeach; ?>
							</div>
						<?php endforeach; ?>
					</div>

				</div>
				

			</section-->

		<?php endwhile; ?>

	</div><!-- #content -->

<footer class="entry-meta">
	<?php edit_post_link( __( 'Edit', THEME_NAME ), '<span class="edit-link">', '</span>' ); ?>
</footer>

<?php get_footer(); ?>
