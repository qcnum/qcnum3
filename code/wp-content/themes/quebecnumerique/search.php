<?php get_header(); ?>

	<div id="content" class="large-wrapper" role="main">

		<div class="padding">

			<header class="page-header c12">

				<?php 
				if($_GET['quartiers'] || $_GET['mots-cles']) {
					$query_q = $_GET['quartiers']; 
					$query_mc = $_GET['mots-cles'];
				} else {
					$o = get_queried_object();
					$query_q = array();
					$query_mc = array();
					if($o->taxonomy == 'quartier') {
						array_push($query_q, $o->slug); 
					} elseif($o->taxonomy == 'mots-cles') {
						array_push($query_mc, $o->slug); 
					}
				}
				?>

				<?php if(isset($_GET['s'])) : ?>

					<h2>Terme recherché</h2>
					<p><?php echo $_GET['s']; ?></p>

				<?php endif; ?>

				<?php if($query_mc) : ?>

					<h2><?php echo _n('Mot-clé', 'Mots-clés', count($query_mc), THEME_NAME); ?></h2>
					<?php foreach($query_mc as $mc) : ?>
						<p><?php echo $mc; ?></p>
					<?php endforeach; ?>

				<?php endif; ?>

				<?php if($query_q) : ?>

					<h2><?php echo _n('Quartier', 'Quartiers', count($query_q), THEME_NAME); ?></h2>
					<?php foreach($query_q as $q) : ?>
						<p><?php echo $q; ?></p>
					<?php endforeach; ?>

				<?php endif; ?>


				<div class="group header-recherche">

			    	<?php $check = 'checked="checked"'?>
			    	<span class="fl">Filtres :</span>

					<div class="filtre nouvelles">
						<input id="recherche-nouvelles" class="resultat" type="checkbox" name="recherche-nouvelles" value="1" <?php echo $check; ?> ;>
						<label class="filtre-recherche" for="recherche-nouvelles" value="nouvelles" id="">Nouvelles</label>
					</div>

					<div class="filtre articles">
						<input id="recherche-articles" class="resultat" type="checkbox" name="recherche-articles" value="1" <?php echo $check; ?> ;>
						<label class="filtre-recherche" for="recherche-articles" value="articles" id="">Articles</label>
					</div>

					<div class="filtre evenements">
						<input id="recherche-evenements" class="resultat" type="checkbox" name="recherche-evenements" value="1"  <?php echo $check; ?> ;>
						<label class="filtre-recherche" for="recherche-evenements" value="evenements" id="">Événements</label>
					</div>

					<div class="filtre organisations">
						<input id="recherche-organisations" class="resultat" type="checkbox" name="recherche-organisations" value="1"  <?php echo $check; ?> ;>
						<label class="filtre-recherche" for="recherche-organisations" value="organisations" id="">Organisations</label>
					</div>

					<div class="filtre projets">
						<input id="recherche-projets" class="resultat" type="checkbox" name="recherche-projets" value="1" <?php echo $check; ?> ;>
						<label class="filtre-recherche" for="recherche-projets" value="projets" id="">Projets</label>
					</div>

					<div class="filtre autre">
						<input id="recherche-autre" class="resultat" type="checkbox" name="recherche-autre" value="1" <?php echo $check; ?> ;>
						<label class="filtre-recherche" for="recherche-autre" value="autre" id="">Autre</label>
					</div>

					<span class="fr">Date de parution</span>

				</div>

			</header>

			<div class="resultats c12">
				<?php if ( have_posts() ) : ?>

				<?php echo posts_count(); ?>

					<ul>
					<?php while ( have_posts() ) : the_post(); ?>
						<?php
						$class="" ;
						$info=""; 
						$date = get_the_date('j F Y');
						$type = get_post_type(); 
						$url = get_permalink();
						if ( is_category( '2' ) ||  has_category( '2') ) {
							$class = 'nouvelles';
							$info = 'Par ' . get_the_author();
						}
						else if ( is_category( '3' ) ||  has_category( '3') ) {
							$class = 'articles';
							$info = 'Par ' . get_the_author();
						}
						else if ( $type == 'organisations' ) {
							$class = 'organisations';
						}
						else if ( $type == 'projets' ) {
							$class = 'projets';
						}
						else if ( $type == 'evenements' ) {
							$class = 'evenements';
						}
						else {
							$class = 'autre';
						}
						?>
						<li class="<?php echo $class ?>">

							<div class="content-wrapper">
								<a href="<?php echo $url ?>">
									<div class="content">
										<h2 class="fl"><?php the_title(); ?></h2>
										<span class="info fl"><?php echo $info; ?></span>
										<span class="fr"><?php echo $date; ?></span>
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

		</div>

	<hr class="clear" >
	</div><!-- #content -->

<?php get_footer(); ?>
