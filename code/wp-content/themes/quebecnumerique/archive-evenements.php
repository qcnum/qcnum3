<?php 
get_header(); 
$lastM;
query_posts(array(
	'post_type' => 'evenements',
	'post_status' => array('publish', 'future'),
	'order' => 'ASC'
));
?>


	<div id="content" class="sticky-event">

		<?php if ( have_posts() ) : ?>

			<div class="large-wrapper">

				<section class="group">

					<?php while ( have_posts() ) : the_post(); ?>

						<?php 
						$month = get_the_date('M'); 
						if($month != $lastM && $lastM != null) { 

							/* On change de mois */

							$lastM = $month; 
							$firstMonth = $month;
							echo '</div></section>';
							echo '<section class="group">';
							echo '<header class="c1"><h2>';
							echo $firstMonth . ' ' . get_the_date('Y');
							echo '</h2></header><div class="c11 fr">';
						} elseif($month != $lastM && $lastM == null) {

							/* Premier mois */

							$lastM = $month; 
							$firstMonth = $month;
							echo '<header class="c1"><h2>';
							echo $firstMonth . ' ' . get_the_date('Y');
							echo '</h2></header><div class="c11 fr">';
						} else { /* On continue */ $firstMonth = ''; }
						?>

							<article class="white-post evenements group">

								<div class="padding">

									<?php 
									$date_exp = get_post_meta( $post->ID, 'postexpired', true );
									$date_arr = explode('-', $date_exp);
									$mois = array('01'=>'janvier', '02'=>'février', '03'=>'mars', '04'=>'avril', '05'=>'mai', '06'=>'juin', '07'=>'juillet', '08'=>'août', '09'=>'septembre', '10'=>'octobre', '11'=>'novembre', '12'=>'décembre');
									?>

									<div class="c2">
										<div class="padding">
											<?php the_post_thumbnail('thumb-nocrop'); ?>
										</div>
									</div>

									<div class="c8">
										<div class="padding">
											<div class="entry-content">
												<div class="ellipsis info-event">
													<span class="date"><?php echo get_the_date(); ?></span>
													<span class="lieu"><i class="fa fa-map-marker"></i> L'Abri-co / 255 boulevard Charest Est</span>
												</div>
												<h3 class="h2"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h3>
												<?php the_excerpt(); ?>
												<hr class="clear">
												<p><a class="btn" href="<?php the_permalink(); ?>" title="<?php _e('En savoir plus', THEME_NAME); ?>"><?php _e('En savoir plus', THEME_NAME); ?></a></p>

											</div>
										</div>
									</div>
									
									<div class="c2">
										
										<div class="fr padding">
											<div class="sharing">
												<a href="#" class="sharer" title="Sharing"><i class="fa fa-share-alt"></i></a>
												<div>
													<?php 
													$urlimg = wp_get_attachment_url( get_post_thumbnail_id($post->ID) ); 
													$title = get_the_title(); $title = urlencode($title);
													$desc = get_the_excerpt(); $desc = urlencode($desc);
													?>

													<a target="_blank" href="http://www.facebook.com/sharer/sharer.php?u=<?php the_permalink(); ?>" class="fb" title="Facebook"><span>Facebook</span> <i class="fa fa-facebook"></i></a>
													<a target="_blank" href="https://twitter.com/intent/tweet?url=<?php the_permalink(); ?>&amp;text=<?php echo $title; ?>&amp;via=<?php echo urlencode(bloginfo('name')); ?>" class="tw" title="Twitter"><span>Twitter</span> <i class="fa fa-twitter"></i></a>
													<a target="_blank" href="https://plus.google.com/share?url=<?php the_permalink(); ?>&amp;title=<?php echo $title; ?>" class="gp" title="Google+"><span>Google+</span> <i class="fa fa-google-plus"></i></a>
													<a target="_blank" href="https://www.linkedin.com/shareArticle?mini=true&amp;url=<?php the_permalink(); ?>&amp;title=<?php echo $title; ?>&amp;summary=<?php echo $desc; ?>&amp;source=<?php echo urlencode(bloginfo('name')); ?>" class="li" title="Linkedin"><span>Linkedin</span> <i class="fa fa-linkedin"></i></a>
													<a target="_blank" href="https://pinterest.com/pin/create/button/?url=<?php the_permalink(); ?>&amp;media=<?php echo $urlimg; ?>&amp;description=<?php echo $desc; ?>" class="pin" title="Pinterest"><span>Pinterest</span> <i class="fa fa-pinterest-p"></i></a>
													<a href="mailto:?subject=<?php echo $title; ?>&amp;body=<?php echo $desc; ?>" class="email" title="Courriel"><span>Courriel</span> <i class="fa fa-envelope"></i></a>
													
												</div>
											</div>
										</div>

										<div class="padding fr">
											<a href="<?php the_permalink(); ?>" class="btn-orange">M'inscrire</a>
										</div>
						
									</div>

								</div>

							</article>

					<?php endwhile; ?>

				</div>

				</section>

				<?php paging_nav(); ?>

			</div>

		<?php else : ?>

			<?php get_template_part( 'content', 'none' ); ?>
				
		<?php endif; ?>

	</div><!-- #content -->

<?php get_footer(); ?>
