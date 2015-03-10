<?php get_header(); ?>

	<div id="content" class="c12" role="main">

		<!--header class="page-header">
			<h1 class="page-title">
				<?php printf( __( 'Résultat de recherche pour: %s', THEME_NAME ), '<span></span>' ); ?>
			</h1>
		</header-->

		<?php if ( have_posts() ) : ?>

			<ul class="resultats">
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

					<div class="pastille">
					</div>

					<h1><?php echo get_post_type(); ?></h1>
					<h2><?php the_title(); ?></h2>
					<h3><?php the_category(); ?></h3>
					<hr>
				</li>
			<?php endwhile; ?>
			</ul>
			<?php paging_nav(); ?>

		<?php else : ?>

			<?php get_template_part( 'content', 'none' ); ?>
				
		<?php endif; ?>

	<hr class="clear" >
	</div><!-- #content -->

<?php get_footer(); ?>
