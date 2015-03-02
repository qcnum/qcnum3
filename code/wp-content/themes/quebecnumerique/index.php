<?php 
get_header(); 

$tag1 = get_field('dossier1', 'options');
$tag2 = get_field('dossier2', 'options');
$tag1_name =  $tag1->name;
$tag2_name =  $tag2->name;

$dossier1 = new WP_Query( array( 'post_type' => 'post', 'mots-cles' => $tag1_name, 'posts_per_page' => 2 ) );
$dossier2 = new WP_Query( array( 'post_type' => 'post', 'mots-cles' => $tag2_name, 'posts_per_page' => 2 ) );
$nouvelles = new WP_Query( array( 'post_type' => 'post', 'category_name' => 'nouvelles', 'posts_per_page' => 3 ) );
$articles = new WP_Query( array( 'post_type' => 'post', 'category_name' => 'articles', 'posts_per_page' => 2 ) );
$evenements = new WP_Query( array( 'post_type' => 'evenements', 'posts_per_page' => 3 ) );

?>

	<div id="content" role="main">

		<div class="abstract">

		</div>

		<div class="c6">
			
			<div class="nouvelles group trois img-box">
				<?php 
				$titre = get_field('titre_nouvelles', 'options');
				?>
				<h2><a class="gris-bg" href="/nouvelles"><?php echo $titre?><i class="fa fa-plus"></i></a></h2>

				<div>

					<?php if ( $nouvelles->have_posts() ) while ( $nouvelles->have_posts() ) : $nouvelles->the_post(); ?>

						<article class="c6">
							
							<a href="<?php the_permalink(); ?>">
								<div class="content">
									<span><?php get_the_date(); ?></span>
									<h3><?php the_title(); ?></h3>
									<div class="excerpt"><?php the_excerpt(); ?></div>
								</div>
								<img src="http://placehold.it/580x440" alt="">
							</a>
						</article>

					<?php endwhile; ?>

				</div>
			
			</div>

			<div class="articles group img-box">
				<?php 
				$titre = get_field('titre_articles', 'options');
				?>
				<h2><a class="gris-bg" href=""><?php echo $titre?><i class="fa fa-plus"></i></a></h2>

				<?php if ( $articles->have_posts() ) while ( $articles->have_posts() ) : $articles->the_post(); ?>

					<article class="c6">
						<div class="content"><?php the_title(); ?></div>
						<img src="http://placehold.it/580x440" alt="">
					</article>

				<?php endwhile; ?>
			
			</div>

		</div>

		<div class="c6">
			
			<div class="evenements group">
				<?php 
				$titre = get_field('titre_evenements', 'options');
				?>
				<h2><a class="gris-bg" href="#"><?php echo $titre?><i class="fa fa-plus"></i></a></h2>

				<?php if ( $evenements->have_posts() ) while ( $evenements->have_posts() ) : $evenements->the_post(); ?>

					<article class="c12">
						<img src="http://placehold.it/75x75" class="fl" alt="">
						<div class="content"><?php the_title(); ?></div>
					</article>

				<?php endwhile; ?>
			
			</div>

			<div class="nouvelles group img-box">
				<h2><a class="gris-bg" href=""><?php echo $tag1_name?><i class="fa fa-plus"></i></a></h2>

				<?php if ( $dossier1->have_posts() ) while ( $dossier1->have_posts() ) : $dossier1->the_post(); ?>

					<article class="c6">
						<div class="content"><?php the_title(); ?></div>
						<img src="http://placehold.it/580x440" alt="">
					</article>

				<?php endwhile; ?>
			
			</div>

			<div class="nouvelles group img-box">
				<h2><a class="gris-bg" href=""><?php echo $tag2_name?><i class="fa fa-plus"></i></a></h2>

				<?php if ( $articles->have_posts() ) while ( $articles->have_posts() ) : $articles->the_post(); ?>

					<article class="c6">
						<div class="content"><?php the_title(); ?></div>
						<img src="http://placehold.it/580x440" alt="">
					</article>

				<?php endwhile; ?>
			
			</div>


		</div>

		<hr class="clear">

	</div><!-- #content -->



<?php get_footer(); ?>
