<?php 
/*
* Template name: Événements passés
*/
get_header();

$lastM;
$diffGMT = get_option('gmt_offset') * 3600;  
$currentDate = time() + $diffGMT;
query_posts(
	array(
		'post_type' => 'evenements',
		'meta_key' => 'enddate',
		'orderby' => 'meta_value',
		'order' => 'DESC',
		'posts_per_page' => -1,
		'meta_query'  => array(
			'relation' => 'AND',
				array(
				'key' => 'enddate',
				'value' => $currentDate,
				'compare' => '<'
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
											<?php the_post_thumbnail('thumbnail'); ?>
										</div>
									</div>

									<div class="c10">
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
									
								</div>

							</article>

					<?php endwhile; ?>

				</div>

				</section>

				<?php //paging_nav(); ?>

			</div>

		<?php else : ?>

			<?php get_template_part( 'content', 'none' ); ?>
				
		<?php endif; ?>

	</div><!-- #content -->

<?php get_footer(); ?>
