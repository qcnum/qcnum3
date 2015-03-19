<?php 
/*
* Template name: Contact
*/
get_header(); ?>

	<div id="content" role="main" class="a-propos">




		<?php if( have_posts() ) while ( have_posts() ) : the_post(); ?>
 
			<div class="coordonees large-wrapper group">
				<div class="c12">
					<div class="entry-content">
							<?php 
							$telephone = get_field('telephone'); 
							$mail = get_field('courriel'); 
							?>
							<a href="mailto:<?php echo antispambot($mail); ?>" class="gris-bg"><?php echo antispambot($mail); ?><i class="fa fa-plus"></i></a>
							<hr class="clear">
							<a href="tel:<?php echo $telephone ?>" class="gris-bg"><?php echo $telephone ?><i class="fa fa-plus"></i></a>
							
					</div>
				</div>
			</div>



			<section class="equipe large-wrapper white-post group">

				<div class="entry-content c12 ">
					<div class="padding">
						<h2><?php the_field('equipe_titre'); ?> </h2>
						<?php the_field('equipe_texte'); ?>
					</div>
				</div>

				<?php $membres = get_field('membres'); ?>



				<div class="group padding">
				
					
					<?php foreach($membres as $m) : 
						$nom = $m['nom'];
						$photoid = $m['photo'];
						$titre = $m['titre'];
						$linkedin = $m['linkedin'];
						$url = wp_get_attachment_image_src($photoid, 'profil');

						?>
						<a href="<?php echo $linkedin ?>" class="c3 pb1em">
							<div class="padding">
								<div class="membre">
									<div class="img" style="background-image: url('<?php echo $url[0]; ?>')" ></div>
									<div class="content">
										<i class="fa fa-linkedin"></i>
										<hr class="clear">
										<span class="bleufonce-bg"><?php echo $nom; ?></span>
										<hr class="clear">
										<?php if ($titre != null){ ?>
										<span class="titre orange-bg"><?php echo $titre; ?></span>
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
