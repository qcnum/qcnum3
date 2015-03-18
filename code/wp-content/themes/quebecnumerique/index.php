<?php 
get_header(); 

$tag1 = get_field('dossier1', 'options');
$tag2 = get_field('dossier2', 'options');
$tag1_name =  $tag1->name;
$tag2_name =  $tag2->name;

$diffGMT = get_option('gmt_offset') * 3600;  
$currentDate = time() + $diffGMT;

if ($tag1_name != ''){ $dossier1 = new WP_Query( array( 'post_type' => 'post', 'cat' => '2', 'mots-cles' => $tag1_name, 'posts_per_page' => 2 ) );};
if ($tag2_name != ''){ $dossier2 = new WP_Query( array( 'post_type' => 'post', 'cat' => '2', 'mots-cles' => $tag2_name, 'posts_per_page' => 2 ) );};
$nouvelles = new WP_Query( array( 'post_type' => 'post', 'cat' => '2', 'posts_per_page' => 3 ) );
$articles = new WP_Query( array( 'post_type' => 'post', 'cat' => '3', 'posts_per_page' => 2 ) );

$evenements = new WP_Query( 
	array( 
		'post_type' => 'evenements', 
		'posts_per_page' => 4, 
		'meta_key' => 'startdate',
		'orderby' => 'meta_value',
		'order' => 'ASC',
		'meta_query'  => array(
			'relation' => 'AND',
				array(
				'key' => 'enddate',
				'value' => $currentDate,
				'compare' => '>='
			)
		)
	) );

?>


	<div id="content" class="accueil" role="main">


		
			<div class="abstract">
				<svg class="abstract-svg" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" preserveAspectRatio="xMinYMin meet" viewBox="0 0 1000 300" xml:space="preserve">

					<filter id="dropshadow" height="130%">
					  <feGaussianBlur in="SourceAlpha" stdDeviation="12"/> <!-- stdDeviation is how much to blur -->
					  <feOffset dx="2" dy="2" result="offsetblur"/> <!-- how much to offset -->
					  <feMerge> 
					    <feMergeNode/> <!-- this contains the offset blurred image -->
					    <feMergeNode in="SourceGraphic"/> <!-- this contains the element that the filter is applied to -->
					  </feMerge>
					</filter>

					<?php $opacity = '1' ?>

					<g id="test" class="organisations " opacity="<?php echo $opacity ?>">
						<polygon style="filter:url(#dropshadow)" class="triangle" fill="#9B2B78" points="1091.5,203.877 584.414,-6.327 987.046,-100.097 	"/>
					</g>
					<g id="Layer_2" class="articles" opacity="<?php echo $opacity ?>">
						<polygon  style="filter:url(#dropshadow)" class="triangle" fill="#A0AD00" points="220.5,131.928 56.242,-44.939 469.592,-38.114 	"/>
					</g>
					<g id="Layer_3" class="projets" opacity="<?php echo $opacity ?>">
						<polygon style="filter:url(#dropshadow)" class="triangle" fill="#009861" points="492.5,141.324 119.07,-27.821 556.507,-30.78 	"/>
					</g>
					<g id="Layer_4" class="nouvelles" opacity="<?php echo $opacity ?>" >
						<polygon style="filter:url(#dropshadow)" class="triangle" fill="#00ACA7" points="-29.5,191.877 -22.5,-20.676 279.219,-21.995 	"/>
					</g>
					<g id="Layer_5" class="evenements" opacity="<?php echo $opacity ?>">
						<polygon  style="filter:url(#dropshadow)" class="triangle" fill="#D39B00" points="584.414,136.824 443.313,-37.993 840.746,-12.666 	"/>
					</g>
					<g id="Layer_6" class="orange" opacity="<?php echo $opacity ?>">
						<polygon style="filter:url(#dropshadow)" class="triangle" fill="#E14E24" points="796.5,145.386 751.56,-44.939 1074.693,-5.387 	"/>
					</g>


				</svg>

				<div class="shadow-svg">
					<svg class="shadow-svg" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" preserveAspectRatio="xMinYMin meet" viewBox="0 0 1000 300" xml:space="preserve">

						<?php $opacity = '0.08' ?>

						<g id="Layer_7" class="shadow" opacity="<?php echo $opacity ?>">
							<polygon points="143.39,193.797 -38.466,18.325 374.409,-50.818 	"/>
						</g>
						<g id="Layer_8" class="shadow" opacity="<?php echo $opacity ?>">
							<polygon  points="697.603,193.797 575.5,-21.995 961.206,-85.319 	"/>
						</g>
						<g id="Layer_9" class="shadow" opacity="<?php echo $opacity ?>">
							<polygon points="412.171,185.525 175.5,-37.993 541.5,-28.676 	"/>
						</g>
						<g id="Layer_10" class="shadow" opacity="<?php echo $opacity ?>">
							<polygon points="862.603,249.375 768.354,-50.818 1166.5,21.469 	"/>
						</g>

					</svg>
				</div>


			</div>


		<hr class="clear">

		<div class="group">

			<div class="large-wrapper">

				<div class="c6">
					
					<div class="nouvelles group trois img-box padding">
						<?php 
						$titre = get_field('titre_nouvelles', 'options');
						$url = get_category_link('2');
						?>

						<div class="padding">
							<h2><a class="gris-bg" href="<?php echo $url ?>" title="<?php echo $titre?>"><?php echo $titre?><i class="fa fa-plus"></i></a></h2>
						</div>

						<div>

							<?php if ( $nouvelles->have_posts() ) while ( $nouvelles->have_posts() ) : $nouvelles->the_post(); ?>
								<div class="c6">
									<div class="padding">
										<?php get_template_part('content', 'imgbox'); ?>
									</div>
								</div>
							<?php endwhile; ?>

						</div>
					
					</div>

					<div class="articles group img-box padding">
						<?php 
						$titre = get_field('titre_articles', 'options');
						$url = get_category_link('3');
						?>
						<div class="padding">
							<h2><a class="gris-bg" href="<?php echo $url ?>" title="<?php echo $titre?>"><?php echo $titre?><i class="fa fa-plus"></i></a></h2>
						</div>	
					
						<?php if ( $articles->have_posts() ) while ( $articles->have_posts() ) : $articles->the_post(); ?>
						<div class="c6">
							<div class="padding">
								<?php get_template_part('content', 'imgbox'); ?>
							</div>
						</div>
						<?php endwhile; ?>
					
					</div>

				</div>

				<div class="c6">

					<div class="padding">

						<?php if ( $evenements->have_posts() ) : ?>
					
							<div class="box-evenements group padding">
								<?php $titre = get_field('titre_evenements', 'options'); ?>
								<h2><a class="gris-bg" href="<?php echo get_post_type_archive_link( 'evenements' ); ?>" title="<?php echo $titre?>"><?php echo $titre?><i class="fa fa-plus"></i></a></h2>
								<?php while ( $evenements->have_posts() ) : $evenements->the_post();
									$startDate = get_field('startdate');
									$myDate = strftime('%e %B %Y', $startDate/1000);
									$endDate = get_field('enddate');
									$myDate2 = strftime('%e %B %Y', $endDate/1000);
									if($startDate != $endDate) { $date = 'Du ' . $myDate . ' au ' . $myDate2; } 
									else { $date = 'Le ' . $myDate; }
									$startHrs = get_field('hrs_debut');
									$endHrs = get_field('hrs_fin');
									if($startHrs && !$endHrs) {
										$hrs = ' | <span class="hrs">' . date('G\hi', $startHrs) . '</span>';
									} elseif($startHrs && $endHrs) {
										$hrs = ' | <span class="hrs">' . date('G\hi', $startHrs) . ' à ' . date('G\hi', $endHrs) . '</span>';
									}
									?>

									<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
										<article class="group">

											<?php if(has_post_thumbnail()) : 
												the_post_thumbnail('thumbnail');
											else : 
												$category = get_the_category();
												$id = get_field('img-evenements', 'options'); 
												$url = wp_get_attachment_image_src( $id , 'thumbnail');
												?>
												
												<img src="<?php echo $url[0] ?>" alt="Événements">
											<?php endif; ?>

											<div class="content">
												<div class="ellipsis info-event">
													<span class="date"><?php echo $date; ?><?php if($hrs) echo $hrs; ?></span>
													<?php if(get_field('nom_du_lieu')) : ?><span class="lieu"><i class="fa fa-map-marker"></i> <?php the_field('nom_du_lieu'); ?></span><?php endif; ?>
												</div>
												<h3 class="ellipsis"><?php the_title(); ?></h3>
											</div>
										</article>
									</a>

								<?php endwhile; ?>
							
							</div>

						<?php endif; ?>

					</div>

					<?php if ($tag1_name != ''){ ?>
						<div class="nouvelles group img-box padding">
							<?php $url = get_term_link($tag1);?>
							<div class="padding">
								<h2><a class="gris-bg" href="<?php echo $url ?>" title="<?php echo $tag1_name?>"><?php echo $tag1_name?><i class="fa fa-plus"></i></a></h2>
							</div>

							<?php if ( $dossier1->have_posts() ) while ( $dossier1->have_posts() ) : $dossier1->the_post(); ?>
								<div class="c6">
									<div class="padding">
										<?php get_template_part('content', 'imgbox'); ?>
									</div>
								</div>
							<?php endwhile; ?>
						
						</div>
					<?php }; ?>

					<?php if ($tag2_name != ''){ ?>
						<div class="nouvelles group img-box padding">
							<?php $url = get_term_link($tag2);?> 
							<div class="padding">
								<h2><a class="gris-bg" href="<?php echo $url ?>" title="<?php echo $tag2_name?>"><?php echo $tag2_name?><i class="fa fa-plus"></i></a></h2>
							</div>

							<?php if ( $dossier2->have_posts() ) while ( $dossier2->have_posts() ) : $dossier2->the_post(); ?>
								<div class="c6">
									<div class="padding">
										<?php get_template_part('content', 'imgbox'); ?>
									</div>
								</div>
							<?php endwhile; ?>
						
						</div>
					<?php }; ?>





				</div>

			</div>

		</div>

	</div><!-- #content -->

<?php get_footer(); ?>
