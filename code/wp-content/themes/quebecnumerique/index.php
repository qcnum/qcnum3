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


	<div id="content" role="main">

		<div class="abstract">

		</div>

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
									<article class="opac-bg group">
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
