<?php 
get_header(); 
$lastM;
query_posts(array(
	'post_type' => 'evenements',
	'post_status' => array('publish', 'future'),
	'order' => 'ASC'
));


//wp_enqueue_script('waypoint', get_template_directory_uri().'/js/jquery.waypoints.min.js', 'jquery', '', true);
//wp_enqueue_script('sticky', get_template_directory_uri().'/js/sticky.js', 'jquery', '', true);
?>
<script>
jQuery(document).ready(function(){

	//var sticky = new Waypoint.Sticky({
	//  element: jQuery('header.c1')[0],
	//  offset: 50
	//});
});
</script>

	<div id="content">

		<?php if ( have_posts() ) : ?>

			<div class="nav sticky-event">
				
				<div class="scroller">

					<section class="group">

						<?php while ( have_posts() ) : the_post(); ?>

							<?php 
							$month = get_the_date('M'); 
							if($month != $lastM && $lastM != null) { 
								$lastM = $month; 
								$firstMonth = $month;
								echo '</div></section>';
								echo '<section class="group">';
								echo '<header class="c1">';
								echo $firstMonth . ' ' . get_the_date('Y');
								echo '</header><div class="c11 fr">';
							} elseif($month != $lastM && $lastM == null) {
								$lastM = $month; 
								$firstMonth = $month;
								echo '<header class="c1">';
								echo $firstMonth . ' ' . get_the_date('Y');
								echo '</header><div class="c11 fr">';
							} else { $firstMonth = ''; }
							?>

								<article class="white-post evenements group">

									<?php 
									$date_exp = get_post_meta( $post->ID, 'postexpired', true );
									$date_arr = explode('-', $date_exp);
									$mois = array('01'=>'janvier', '02'=>'février', '03'=>'mars', '04'=>'avril', '05'=>'mai', '06'=>'juin', '07'=>'juillet', '08'=>'août', '09'=>'septembre', '10'=>'octobre', '11'=>'novembre', '12'=>'décembre');
									?>

									<div class="c3">
										<?php the_post_thumbnail(); ?>
									</div>

									<div class="c7">
										<div class="entry-content">
											<div class="ellipsis info-event">
												<span class="date"><?php echo get_the_date(); ?></span>
												<span class="lieu"><i class="fa fa-map-marker"></i> L'Abri-co / 255 boulevard Charest Est</span>
											</div>
											<h1 class="h2"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h1>
											<?php the_excerpt(); ?>
											<hr class="clear">
											<p><a class="btn" href="<?php the_permalink(); ?>" title="<?php _e('En savoir plus', THEME_NAME); ?>"><?php _e('En savoir plus', THEME_NAME); ?></a></p>

										</div>
										
									</div>

									<div class="c2 group">

										<div class="fr">
											<div class="sharing">
												<a href="#" class="sharer" title="Sharing"><i class="fa fa-share-alt"></i></a>
												<div>
													<?php $urlimg = wp_get_attachment_url( get_post_thumbnail_id($post->ID) ); ?>
													<a target="_blank" href="http://www.facebook.com/sharer/sharer.php?u=<?php the_permalink(); ?>" class="fb" title="Facebook"><span>Facebook</span> <i class="fa fa-facebook"></i></a>
													<a target="_blank" href="https://twitter.com/intent/tweet?url=<?php the_permalink(); ?>&amp;text=<?php the_title(); ?>&amp;via=<?php echo bloginfo('name'); ?>" class="tw" title="Twitter"><span>Twitter</span> <i class="fa fa-twitter"></i></a>
													<a target="_blank" href="https://plus.google.com/share?url=<?php the_permalink(); ?>&amp;title=<?php the_title(); ?>" class="gp" title="Google+"><span>Google+</span> <i class="fa fa-google-plus"></i></a>
													<a target="_blank" href="https://www.linkedin.com/shareArticle?mini=true&amp;url=<?php the_permalink(); ?>&amp;title=<?php the_title(); ?>&amp;summary=<?php echo get_the_excerpt(); ?>&amp;source=<?php echo bloginfo('name'); ?>" class="li" title="Linkedin"><span>Linkedin</span> <i class="fa fa-linkedin"></i></a>
													<a target="_blank" href="https://pinterest.com/pin/create/button/?url=<?php the_permalink(); ?>&amp;media=<?php echo $urlimg; ?>&amp;description=<?php echo get_the_excerpt(); ?>" class="pin" title="Pinterest"><span>Pinterest</span> <i class="fa fa-pinterest-p"></i></a>
													<a href="mailto:?subject=<?php the_title(); ?>&amp;body=<?php echo get_the_excerpt(); ?>" class="email" title="Courriel"><span>Courriel</span> <i class="fa fa-envelope"></i></a>
												</div>
											</div>
										</div>

										<div class="fr">
											<a href="<?php the_permalink(); ?>" class="btn-orange">M'inscrire</a>
										</div>
						
									</div>

								</article>

						<?php endwhile; ?>

					</section>
					
				</div>

			</div>
			
			<?php paging_nav(); ?>

		<?php else : ?>

			<?php get_template_part( 'content', 'none' ); ?>
				
		<?php endif; ?>

	</div><!-- #content -->

<?php get_footer(); ?>
