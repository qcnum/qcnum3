<?php 
get_header(); 

$tag1 = get_field('dossier1', 'options');
$tag2 = get_field('dossier2', 'options');
$tag1_name =  $tag1->name;
$tag2_name =  $tag2->name;

$dossier1 = new WP_Query( array( 'post_type' => 'post', 'cat' => '2', 'mots-cles' => $tag1_name, 'posts_per_page' => 2 ) );
$dossier2 = new WP_Query( array( 'post_type' => 'post', 'cat' => '2', 'mots-cles' => $tag2_name, 'posts_per_page' => 2 ) );
$nouvelles = new WP_Query( array( 'post_type' => 'post', 'cat' => '2', 'posts_per_page' => 3 ) );
$articles = new WP_Query( array( 'post_type' => 'post', 'cat' => '3', 'posts_per_page' => 2 ) );
$evenements = new WP_Query( array( 'post_type' => 'evenements', 'posts_per_page' => 4 ) );

?>


	<div id="content" class="accueil" role="main">


		<!DOCTYPE svg PUBLIC "-//W3C//DTD SVG 1.1//EN" "http://www.w3.org/Graphics/SVG/1.1/DTD/svg11.dtd">
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

					<g id="Layer_1" class="organisations ">
						<polygon style="filter:url(#dropshadow)" class="triangle" fill="#9B2B78" points="994.595,244.59 534.72,22.201 937.352,-71.57 	"/>
					</g>
					<g id="Layer_2" class="articles">
						<polygon id="test" style="filter:url(#dropshadow)" class="triangle" fill="#A0AD00" points="303.649,246.253 49.253,-28.406 462.604,-21.581 	"/>
					</g>
					<g id="Layer_3" class="projets">
						<polygon style="filter:url(#dropshadow)" class="triangle" fill="#009861" points="568.919,262.833 225.676,8.104 558.835,-113.713 	"/>
					</g>
					<g id="Layer_4" class="nouvelles" >
						<polygon style="filter:url(#dropshadow)" class="triangle" fill="#00ACA7" points="33.108,250.671 -23,-47.708 297.297,-13.517 	"/>
					</g>
					<g id="Layer_5" class="evenements">
						<polygon  style="filter:url(#dropshadow)" class="triangle" fill="#D39B00" points="397.297,212.161 445.946,-16.897 843.379,8.43 	"/>
					</g>
					<g id="Layer_6" class="orange">
						<polygon style="filter:url(#dropshadow)" class="triangle" fill="#E14E24" points="722.973,266.888 681.757,-28.406 1012.162,-38.515 	"/>
					</g>


				</svg>

				<div class="shadow-svg">
					<svg class="shadow-svg" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" preserveAspectRatio="xMinYMin meet" viewBox="0 0 1000 300" xml:space="preserve">

						<?php $opacity = '0.1' ?>

						<g id="Layer_7" class="shadow" opacity="<?php echo $opacity ?>">
							<polygon points="147.603,239.927 -94.5,6.324 431.5,-60.676 	"/>
						</g>
						<g id="Layer_8" class="shadow" opacity="<?php echo $opacity ?>">
							<polygon points="608.603,212.161 438,-107.336 872.206,-66.954 	"/>
						</g>
						<g id="Layer_9" class="shadow" opacity="<?php echo $opacity ?>">
							<polygon points="419.532,246.115 164.287,-10.856 591.774,-96.995 	"/>
						</g>
						<g id="Layer_10" class="shadow" opacity="<?php echo $opacity ?>">
							<polygon points="862.603,249.375 692,-70.123 1166.5,21.469 	"/>
						</g>

					</svg>
				</div>


			</div>




		<hr class="clear">



		<div class="group">

			<div class="large-wrapper">

				<div class="c6">
					
					<div class="nouvelles group trois img-box">
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

					<div class="articles group img-box">
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
					
						<div class="box-evenements group">
							<?php 
							$titre = get_field('titre_evenements', 'options');
							?>
							<h2><a class="gris-bg" href="<?php echo get_post_type_archive_link( 'evenements' ); ?>" title="<?php echo $titre?>"><?php echo $titre?><i class="fa fa-plus"></i></a></h2>

							<?php if ( $evenements->have_posts() ) while ( $evenements->have_posts() ) : $evenements->the_post(); ?>

								<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
									<article class="group">
										<?php the_post_thumbnail('thumbnail'); ?>
										<div class="content">
											<div class="ellipsis info-event">
												<span class="date"><?php echo get_the_date(); ?></span>
												<span class="lieu"><i class="fa fa-map-marker"></i> L'Abri-co / 255 boulevard Charest Est</span>
											</div>
											<h3 class="ellipsis"><?php the_title(); ?></h3>
										</div>
									</article>
								</a>

							<?php endwhile; ?>
						
						</div>

					</div>

					<div class="nouvelles group img-box">
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

					<div class="nouvelles group img-box">
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

				</div>

			</div>

		</div>

	</div><!-- #content -->

<?php get_footer(); ?>
