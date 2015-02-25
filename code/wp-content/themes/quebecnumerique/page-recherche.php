<?php 
/*
* Template name: Recherche
*/
get_header(); 

$query_q = $_GET['quartiers']; 
$query_mc = $_GET['mots-cles']; 
$recherche = $_GET['recherche']; 
$taxQuery = array( 'relation' => 'AND' );

if(isset($query_mc)) {
	$mc = array(
		'taxonomy' => 'mots-cles',
		'field'    => 'slug',
		'terms'    => $query_mc,
	); array_push($taxQuery, $mc);
}

if(isset($query_q)) {
	$q = array(
		'taxonomy' => 'quartier',
		'field'    => 'slug',
		'terms'    => $query_q
	); array_push($taxQuery, $q);
}

$args = array(
	'post_type' => 'any',
	'tax_query' => $taxQuery,
	's' => $recherche
);


echo '<pre>';
var_dump($args);
echo '</pre>';

$results = new WP_Query($args);

?>

	<div id="content" role="main">

		<?php if( $results->have_posts() ) : while ( $results->have_posts() ) : $results->the_post(); ?>

			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

				<header class="entry-header">

					<h1 class="entry-title"><?php the_title(); ?></h1>

				</header>
					
				<div class="entry-content">

					<?php the_content(); ?>

				</div>

				<footer class="entry-meta">

					<?php edit_post_link( __( 'Edit', THEME_NAME ), '<span class="edit-link">', '</span>' ); ?>

				</footer>

			</article>

		<?php endwhile; ?>

		<?php else : ?>

			rien

		<?php endif; ?>

	</div><!-- #content -->

<?php get_footer(); ?>
