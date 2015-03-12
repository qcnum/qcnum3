<?php 
get_header(); 
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

	<div id="content" class="large-wrapper" role="main">

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
		

		<header class="page-header c12">
			<div class="padding">
				<div class="group">
					<div class="c6"><?php echo posts_count(); ?></div>
					<div class="c6">
						<span class="legende autre">Autre</span>
						<span class="legende projets">Projets</span>
						<span class="legende organisations">Organisations</span>
						<span class="legende evenements">Événements</span>
						<span class="legende articles">Articles</span>
						<span class="legende nouvelles">Nouvelles</span>
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

							<div class="pastille">
							</div>

						</li>

					<?php endwhile; ?>
					</ul>
					<?php paging_nav(); ?>

				</div>

			<?php else : ?>

				<?php get_template_part( 'content', 'none' ); ?>
					
			<?php endif; ?>

		</div>

		<hr class="clear" >

	</div><!-- #content -->

<?php get_footer(); ?>
