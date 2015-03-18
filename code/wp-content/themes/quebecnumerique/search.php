<?php get_header(); ?>

	<div id="content" class="large-wrapper group" role="main">

		<header class="page-header c12">
			<div class="padding">
				<div class="group">
					<div class="c6 postCount"><?php echo posts_count(); ?> | <a href="#" class="critere" title="<?php _e('Afficher mes critères', THEME_NAME); ?>"><?php _e('Afficher mes critères', THEME_NAME); ?></a></div>
					<div class="c6">
						<span class="legende autre"><?php _e('Autre', THEME_NAME); ?></span>
						<span class="legende projets"><?php _e('Projets', THEME_NAME); ?></span>
						<span class="legende organisations"><?php _e('Organisations', THEME_NAME); ?></span>
						<span class="legende evenements"><?php _e('Événements', THEME_NAME); ?></span>
						<span class="legende articles"><?php _e('Articles', THEME_NAME); ?></span>
						<span class="legende nouvelles"><?php _e('Nouvelles', THEME_NAME); ?></span>
					</div>
				</div>
			</div>
		</header>

		<div class="resultats c12">
			<div class="padding">
				<?php if ( have_posts() ) : ?>

					<ul>
					<?php while ( have_posts() ) : the_post(); ?>
						<?php
						$class="" ;
						$info=""; 
						$date = get_the_date('j F Y');
						$type = get_post_type(); 
						$url = get_permalink();
						if ( is_category( '2' ) ||  has_category( '2') ) { $class = 'nouvelles'; $info = 'Par ' . get_the_author(); }
						else if ( is_category( '3' ) ||  has_category( '3') ) { $class = 'articles'; $info = 'Par ' . get_the_author(); }
						else if ( $type == 'organisations' ) { $class = 'organisations'; }
						else if ( $type == 'projets' ) { $class = 'projets'; }
						else if ( $type == 'evenements' ) { $class = 'evenements'; }
						else { $class = 'autre'; }
						?>
						<li class="<?php echo $class ?> group">
							<div class="content-wrapper">
								<a href="<?php echo $url ?>">
									<div class="content">
										<h2 class="fl"><?php the_title(); ?></h2>
										<span class="info fl"><?php echo $info; ?></span>
										<span class="fr"><?php echo $date; ?></span>
									</div>
								</a>
							</div>
							<div class="pastille"></div>
						</li>

					<?php endwhile; ?>
					</ul>
					<?php paging_nav(); ?>

				</div>

			<?php else : ?>

				<ul>
					<li class="no-result group">
						<div class="content-wrapper">
							<div class="content">
								<h2><?php _e('Aucun résultat ne correspond à vos critères de recherche', THEME_NAME); ?></h2>
							</div>
						</div>
						<div class="pastille"></div>
					</li>
				</ul>

			<?php endif; ?>

		</div>

		<hr class="clear" >

	</div><!-- #content -->

<?php get_footer(); ?>
