<?php get_header(); ?>

	<div id="content" role="main">

		<header class="page-header c12">
			<h1 class="page-title">
				<?php printf( __( 'Résultat de recherche pour: %s', THEME_NAME ), '<span></span>' ); ?>
			</h1>
		</header>

		<div class="resultats c12">
			<?php if ( have_posts() ) : ?>
				<ul>
				<?php while ( have_posts() ) : the_post(); ?>
					<?php
					$class="" ;
					$type = get_post_type(); 
					if ( is_category( '2' ) ||  has_category( '2') ) {$class = 'nouvelles';}
					else if ( is_category( '3' ) ||  has_category( '3') ) {$class = 'articles';}
					else if ( $type == 'organisations' ) {$class = 'organisations';}
					else if ( $type == 'projets' ) {$class = 'projets';}
					else if ( $type == 'evenements' ) {$class = 'evenements';}
					else {$class = 'autre';}
					?>
					<li class="<?php echo $class ?>">

						<div class="content-wrapper">
							<div class="content">
								<h2><?php the_title(); ?></h2>
							</div>
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
