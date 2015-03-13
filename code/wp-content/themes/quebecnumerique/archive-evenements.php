<?php 
get_header();

$lastM;
$diffGMT = get_option('gmt_offset') * 3600;  
$currentDate = time() + $diffGMT;
query_posts(
	array(
		'post_type' => 'evenements',
		'meta_key' => 'startdate',
		'orderby' => 'meta_value',
		'order' => 'ASC',
		'posts_per_page' => -1,
		'meta_query'  => array(
			'relation' => 'AND',
				array(
				'key' => 'enddate',
				'value' => $currentDate,
				'compare' => '>='
			)
		)
	)
);
?>


	<div id="content" class="sticky-event">

		<?php if ( have_posts() ) : ?>

			<div class="large-wrapper">

				<section class="group">

					<?php while ( have_posts() ) : the_post(); ?>

						<?php 
						
						$startDate = get_field('startdate');
						$myDate = strftime('%e %B %Y', $startDate/1000);

						$endDate = get_field('enddate');
						$myDate2 = strftime('%e %B %Y', $endDate/1000);

						if($startDate != $endDate) {
							$date = 'Du ' . $myDate . ' au ' . $myDate2;
						} else {
							$date = 'Le ' . $myDate;
						}

						$startHrs = get_field('hrs_debut');
						$endHrs = get_field('hrs_fin');

						if($startHrs && !$endHrs) {
							$hrs = ' | <span class="hrs">' . date('G\hi', $startHrs) . '</span>';
						} elseif($startHrs && $endHrs) {
							$hrs = ' | <span class="hrs">' . date('G\hi', $startHrs) . ' à ' . date('G\hi', $endHrs) . '</span>';
						}
						
						$month = strftime('%b', $endDate/1000); 
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

									<div class="c2">
										<div class="padding">
											<?php 
											if(has_post_thumbnail()) : $id = get_post_thumbnail_id();
											else : $id = get_field('img-evenements', 'options'); endif; 
											$url = wp_get_attachment_image_src( $id , 'thumb-nocrop'); ?>
											<img src="<?php echo $url[0]; ?>" alt="">
										</div>
									</div>

									<div class="c8">
										<div class="padding">
											<div class="entry-content">
												<div class="ellipsis info-event">
													<span class="date"><?php echo $date; ?><?php if($hrs) echo $hrs; ?></span>
													<?php if(get_field('nom_du_lieu')) : ?><span class="lieu"><i class="fa fa-map-marker"></i> <?php the_field('nom_du_lieu'); ?></span><?php endif; ?>
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
													$source = get_bloginfo('name'); $source = urlencode($source);
													?>

													<a target="_blank" href="http://www.facebook.com/sharer/sharer.php?u=<?php the_permalink(); ?>" class="fb" title="Facebook"><span>Facebook</span> <i class="fa fa-facebook"></i></a>
													<a target="_blank" href="https://twitter.com/intent/tweet?url=<?php the_permalink(); ?>&amp;text=<?php echo $title; ?>&amp;via=<?php echo $source; ?>" class="tw" title="Twitter"><span>Twitter</span> <i class="fa fa-twitter"></i></a>
													<a target="_blank" href="https://plus.google.com/share?url=<?php the_permalink(); ?>&amp;title=<?php echo $title; ?>" class="gp" title="Google+"><span>Google+</span> <i class="fa fa-google-plus"></i></a>
													<a target="_blank" href="https://www.linkedin.com/shareArticle?mini=true&amp;url=<?php the_permalink(); ?>&amp;title=<?php echo $title; ?>&amp;summary=<?php echo $desc; ?>&amp;source=<?php echo $source; ?>" class="li" title="Linkedin"><span>Linkedin</span> <i class="fa fa-linkedin"></i></a>
													<a target="_blank" href="https://pinterest.com/pin/create/button/?url=<?php the_permalink(); ?>&amp;media=<?php echo $urlimg; ?>&amp;description=<?php echo $desc; ?>" class="pin" title="Pinterest"><span>Pinterest</span> <i class="fa fa-pinterest-p"></i></a>
													<a href="mailto:?subject=<?php echo $title; ?>&amp;body=<?php echo $desc; ?>" class="email" title="Courriel"><span>Courriel</span> <i class="fa fa-envelope"></i></a>
													
												</div>
											</div>
										</div>
										<?php if(get_field('lien_inscription')) : ?>
											<div class="padding fr">
												<a href="<?php the_permalink(); ?>" class="btn-orange">M'inscrire</a>
											</div>
										<?php endif; ?>
						
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
