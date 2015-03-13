<?php get_header(); ?>

	<div id="content" class="large-wrapper" role="main">

		<header class="page-header c12">
			<div class="padding">
				<div class="group">
					<span class="legende autre">Autre</span>
					<span class="legende projets">Projets</span>
					<span class="legende organisations">Organisations</span>
					<span class="legende evenements">Événements</span>
					<span class="legende articles">Articles</span>
					<span class="legende nouvelles">Nouvelles</span>
				</div>
			</div>
		</header>

			<div class="group">

				<div class="resultats c12">

					<?php if ( have_posts() ) : ?>

						<ul class="padding">

						<?php while ( have_posts() ) : the_post(); ?>
							<?php
							$class="" ;
							$info=""; 
							$date = get_the_date('j F y');
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

				<?php else : ?>

					<?php get_template_part( 'content', 'none' ); ?>
						
				<?php endif; ?>

			</div>

		</div>

	</div><!-- #content -->
			
<?php get_footer(); ?>