<?php get_header(); ?>

	<div id="content" class="large-wrapper" role="main">

		<header class="page-header c12">
			<h1 class="page-title">
				<?php printf( __( 'Résultat de recherche pour: %s', THEME_NAME ), '<span></span>' ); ?>
			</h1>
			<div>

		    	<?php $check = 'checked="checked"'?>

				<div class="filtre nouvelles">
					<input id="nouvelles" class="resultat" type="checkbox" name="nouvelles" value="1" <?php echo $check; ?> ;>
					<label class="filtre-recherche" for="nouvelles" id="">Nouvelles</label>
				</div>

				<div class="filtre articles">
					<input id="articles" class="resultat" type="checkbox" name="articles" value="1" <?php echo $check; ?> ;>
					<label class="filtre-recherche" for="articles" id="">Articles</label>
				</div>

				<div class="filtre evenements">
					<input id="evenements" class="resultat" type="checkbox" name="evenements" value="1"  <?php echo $check; ?> ;>
					<label class="filtre-recherche" for="evenements" id="">Événements</label>
				</div>

				<div class="filtre organisations">
					<input id="organisations" class="resultat" type="checkbox" name="organisations" value="1"  <?php echo $check; ?> ;>
					<label class="filtre-recherche" for="organisations" id="">Organisations</label>
				</div>

				<div class="filtre projets">
					<input id="projets" class="resultat" type="checkbox" name="projets" value="1" <?php echo $check; ?> ;>
					<label class="filtre-recherche" for="projets" id="">Projets</label>
				</div>

				<div class="filtre autre">
					<input id="autre" class="resultat" type="checkbox" name="autre" value="1" <?php echo $check; ?> ;>
					<label class="filtre-recherche" for="autre" id="">Autre</label>
				</div>






			</div>


		</header>

		<div class="resultats c12">
			<?php if ( have_posts() ) : ?>
				<ul>
				<?php while ( have_posts() ) : the_post(); ?>
					<?php
					$class="" ;
					$type = get_post_type(); 
					$url = get_permalink();
					if ( is_category( '2' ) ||  has_category( '2') ) {$class = 'nouvelles';}
					else if ( is_category( '3' ) ||  has_category( '3') ) {$class = 'articles';}
					else if ( $type == 'organisations' ) {$class = 'organisations';}
					else if ( $type == 'projets' ) {$class = 'projets';}
					else if ( $type == 'evenements' ) {$class = 'evenements';}
					else {$class = 'autre';}
					?>
					<li class="<?php echo $class ?>">

						<div class="content-wrapper">
							<a href="<?php echo $url ?>">
								<div class="content">
									<h2><?php the_title(); ?></h2>
								</div>
							</a>
						</div>

						<div class="pastille">
						</div>

					</li>
					<hr class="clear">

				<?php endwhile; ?>
				</ul>
				<?php paging_nav(); ?>

			<?php else : ?>

				<?php get_template_part( 'content', 'none' ); ?>
					
			<?php endif; ?>
		</div>

	<hr class="clear" >
	</div><!-- #content -->

<?php get_footer(); ?>
