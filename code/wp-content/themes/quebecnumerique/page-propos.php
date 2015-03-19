<?php 
/*
* Template name: À propos
*/
get_header(); ?>

	<div id="content" role="main" class="a-propos">

		<?php if( have_posts() ) while ( have_posts() ) : the_post(); ?>

			<div class="large-wrapper">
			
				<article <?php post_class('group'); ?>>

					<div class="c6">

						<div class="padding">
							
							<div class="entry-content">

								<?php the_content(); ?>

							</div>

							<footer class="entry-meta">

								<?php edit_post_link( __( 'Edit', THEME_NAME ), '<span class="edit-link">', '</span>' ); ?>

							</footer>

						</div>
		
					</div>

				</article>

			</div>

			<section class="white-post group equipe">

				<div class="entry-content large-wrapper">

					<div class="c12">
					<?php the_field('texte_contributeurs'); ?>
					</div>

				</div>

				<?php $partenaires = get_field('partenaires', 'options'); ?>
				
				<div class="c12 partenaires">
					<div class="padding">
					
						<?php foreach($partenaires as $p) : 
							$site = $p['site_web'];
							$nom = $p['nom'];
							$logoid = $p['logo'];
							$logo = wp_get_attachment_image_src($logoid, 'medium');
							?>
							<?php if($p['site_web']) : ?>
								<a href="<?php echo $site; ?>" target="_blank"><img src="<?php echo $logo[0]; ?>" alt="<?php echo $nom; ?>"></a>
							<?php else : ?>
								<img src="<?php echo $logo[0]; ?>" alt="<?php echo $nom; ?>">
							<?php endif; ?>

						<?php endforeach; ?>

					</div>
				</div>

			</section>

			<section class="group equipe collaborateurs">

				<div class="entry-content large-wrapper">
					<div class="padding white-text">
						<?php the_field('texte_collaborateurs'); ?>
					</div>

					<?php
					$collab = get_field('collaborateurs');
					$chunk = partition($collab, 4); ?>

					<div class="group">
						<?php foreach ($chunk as $ch) : ?>
							<div class="c3 ">
								<?php foreach($ch as $c) :
									$id = $c['ID'];
									$name = $c['display_name'];
									$titre = get_field('titre', 'user_'.$id);
									$photo = $c['user_avatar'];
									$desc = $c['user_description']; ?>
									<div class="padding">
										
										<div class="white-post entry-content collaborateur">
											<!--div class="padding"-->
												<?php echo get_avatar( $id, 200 ); ?> 
												<h3><?php echo $name; ?></h3>
												<span><?php echo $titre; ?></span>
												<p><?php echo $desc; ?></p>

												<a href="<?php echo get_author_posts_url($id); ?>" class="btn">Voir les collaborations</a>

											<!--/div-->
		
										</div>
									</div>
									
								<?php endforeach; ?>
							</div>
						<?php endforeach; ?>
					</div>

				</div>
				

			</section>

		<?php endwhile; ?>

	</div><!-- #content -->

<?php get_footer(); ?>
