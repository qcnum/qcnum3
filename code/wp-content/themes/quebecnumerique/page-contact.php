<?php 
/*
* Template name: Contact
*/
get_header(); ?>

	<div id="content" role="main" class="a-propos">

		<?php if( have_posts() ) while ( have_posts() ) : the_post(); ?>

			<div class="large-wrapper">
			
				


				<div class="c12">

					<div class="padding">
						
						<div class="entry-content">
							<?php 
							$telephone = get_field('telephone'); 
							$email = get_field('courriel'); 
							?>
							<a href="#"><?php echo $telephone ?></a>
							<a href="#"><?php echo $email ?></a>

						</div>

						<footer class="entry-meta">

							<?php edit_post_link( __( 'Edit', THEME_NAME ), '<span class="edit-link">', '</span>' ); ?>

						</footer>

					</div>
	
				</div>



			</div>

			<!--section class="white-post group">

				<div class="entry-content c6 center">

					<?php the_field('texte_contributeurs'); ?>

				</div>

				<?php $partenaires = get_field('partenaires', 'options'); ?>
				
				<div class="c7 partenaires center">
					<div class="padding">
					
						<?php foreach($partenaires as $p) : 
							$site = $p['site_web'];
							$nom = $p['nom'];
							$logoid = $p['logo'];
							$logo = wp_get_attachment_image_src($logoid, 'medium');
							?>
							<?php if($p['site_web']) : ?>
								<a href="<?php echo $site; ?>"><img src="<?php echo $logo[0]; ?>" alt="<?php echo $nom; ?>"></a>
							<?php else : ?>
								<img src="<?php echo $logo[0]; ?>" alt="<?php echo $nom; ?>">
							<?php endif; ?>

						<?php endforeach; ?>

					</div>
				</div>

			</section-->

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

<?php get_footer(); ?>
