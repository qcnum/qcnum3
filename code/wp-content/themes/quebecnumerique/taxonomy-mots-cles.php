<?php 
get_header(); 

$queried_object = get_queried_object();
$dossier = new WP_Query( array( 'post_type' => 'post', 'mots-cles' => $tag1_name, 'posts_per_page' => 2 ) );

?>

<?php get_footer(); ?>
