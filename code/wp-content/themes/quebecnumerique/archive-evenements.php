<?php 
get_header(); 
$lastM;
query_posts(array(
	'post_type' => 'evenements',
	'post_status' => array('publish', 'future'),
	'order' => 'ASC'
));


wp_enqueue_script('sticky', get_template_directory_uri().'/js/slinky.js', 'jquery', '', true);
?>
<script>
jQuery(document).ready(function(){

	jQuery('.nav').slinky()
});
</script>

	<div id="content">

		<?php if ( have_posts() ) : ?>

			<div class="nav">
				
				<div class="scroller">

					<section class="group">

						<?php while ( have_posts() ) : the_post(); ?>

							<?php 
							$month = get_the_date('F'); 
							if($month != $lastM && $lastM != null) { 
								$lastM = $month; 
								$firstMonth = $month;
								echo '</div></section>';
								echo '<section class="group">';
								echo '<header class="c1">';
								echo $firstMonth;
								echo '</header><div class="c11 fr">';
							} elseif($month != $lastM && $lastM == null) {
								$lastM = $month; 
								$firstMonth = $month;
								echo '<header class="c1">';
								echo $firstMonth;
								echo '</header><div class="c11 fr">';
							} else { $firstMonth = ''; }
							?>

								<article class="event blanc-bg">

									<?php 
									$date_exp = get_post_meta( $post->ID, 'postexpired', true );
									$date_arr = explode('-', $date_exp);
									$mois = array('01'=>'janvier', '02'=>'février', '03'=>'mars', '04'=>'avril', '05'=>'mai', '06'=>'juin', '07'=>'juillet', '08'=>'août', '09'=>'septembre', '10'=>'octobre', '11'=>'novembre', '12'=>'décembre');
									?>

									<h1><?php the_title(); ?></h1>

								</article>

						<?php endwhile; ?>

						</div>

					</section>
					
				</div>

			</div>
			
			<?php paging_nav(); ?>

		<?php else : ?>

			<?php get_template_part( 'content', 'none' ); ?>
				
		<?php endif; ?>

	</div><!-- #content -->

<?php get_footer(); ?>
