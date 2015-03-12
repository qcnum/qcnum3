
	</div><!-- #main -->

	<?php
		if ( is_home() ) {
		    ?>
		    <div class="large-wrapper group">
				<div class="stats c12">
					<div class="padding">
						<?php 
						$stats = get_field('phrase_stats', 'options');
						?>
						<p><?php echo $stats ?></p>
				
						<?php
						$nb_evenements = wp_count_posts('evenements');
						$nb_organisations = wp_count_posts('organisations');
						$nb_projets = wp_count_posts('projets');
						$nb_articles = get_category('3');
						$nb_nouvelles = get_category('2');
						?>
					</div>
				</div>
			</div>
		    <?php
		}
		?>
     
    <div class="map-content">
	    <nav id="menu-map" class="gris-bg">

	    	<div class="large-wrapper group">

				<div class="c12">

					<div class="padding">

						<div class="filtre nouvelles">
					    	<?php 
					    	$check="";
					    	if ( is_home() || is_category( '2' ) ||  has_category( '2') || is_page() ) {$check = 'checked="checked"';}?>
							<input id="nouvelles" class="selection" type="checkbox" name="nouvelles" <?php echo $check; ?>>

							<label for="nouvelles">Nouvelles</label>
							<?php if ( is_home() ){
								echo "<span class='nbr-count'>" . $nb_nouvelles->category_count . "</span>";
							}; ?>
						</div>

						<div class="filtre articles">
					    	<?php 
					    	$check="";
					    	if ( is_home() || is_category( '3' ) ||  has_category( '3') || is_page() ) {$check = 'checked="checked"';}?>
							<input id="articles" class="selection" type="checkbox" name="articles" <?php echo $check; ?>>

							<label for="articles">Articles</label>
							<?php if ( is_home() ){
								echo "<span class='nbr-count'>" . $nb_articles->category_count . "</span>";
							}; ?>
						</div>


						<div class="filtre evenements">

							<?php 
					    	$check="";
					    	if ( is_home() || is_post_type_archive('evenements')  ||  is_singular('evenements') || is_page() ) {$check = 'checked="checked"';}?>
							<input id="evenements" class="selection" type="checkbox" name="evenements" <?php echo $check; ?>>

							<label for="evenements">Événements</label>
							<?php if ( is_home() ){
								echo "<span class='nbr-count'>" . $nb_evenements->publish . "</span>";
							}; ?>
						</div>

						<div class="filtre organisations">

							<?php 
					    	$check="";
					    	if ( is_home() ||  is_post_type_archive('organisations') || is_singular('organisations') || is_page() ) {$check = 'checked="checked"';}?>
							<input id="organisations" class="selection" type="checkbox" name="organisations" <?php echo $check; ?>>

							<label for="organisations">Organisations</label>
							<?php if ( is_home() ){
								echo "<span class='nbr-count'>" . $nb_organisations->publish . "</span>";
							}; ?>
						</div>

						<div class="filtre projets">

							<?php 
					    	$check="";
					    	if ( is_home() ||  is_post_type_archive('projets') || is_singular('projets') || is_page() ) {$check = 'checked="checked"';}?>
							<input id="projets" class="selection" type="checkbox" name="projets" <?php echo $check; ?>>

							<label for="projets">Projets</label>
							<?php if ( is_home() ){
								echo "<span class='nbr-count'>" . $nb_projets->publish . "</span>";
							}; ?>
						</div>

						<div class="filtre twitter">

							<?php if ( is_home() || is_page() ) {$check = 'checked="checked"';}?>
							<input id="twitter" class="selection" type="checkbox" name="twitter" <?php echo $check; ?>>
							<label for="twitter">Twitter</label>
						</div>


				    	<a href="#" id="full-screen">
				    		<i class="fa"></i>
				    	</a>

					</div>

				</div>

	    	</div>

	    </nav>

		<div id="map">

		</div>
	</div>

	<footer id="colophon" role="contentinfo">
	

		<div class="large-wrapper group">
				
			<div class="c6 center contact-form entry-content">
				<?php echo do_shortcode('[gravityform id=1 title=true description=true]'); ?>
			</div>

		</div>

		<div class="gris-bg">

			<div class="large-wrapper group">
			
				<div class="c6 email">
					<div class="padding">
						<?php _e('Pour informations', THEME_NAME); ?> : <a href="mailto:<?php echo get_option( 'admin_email' ); ?>"><?php echo get_option( 'admin_email' ); ?></a>
					</div>
				</div>

				<div class="c6">
					<div class="padding">
						<?php echo get_social_media(); ?>
					</div>
				</div>

			</div>

		</div>

		<div class="blanc-bg">

			<div class="large-wrapper group">
				
				<?php 
				$propos = get_field('propos', 'options');
				$partenaires = get_field('partenaires', 'options');
				?>

				<div class="c5 entry-content">
					<div class="padding">
						<?php echo $propos; ?>
					</div>
				</div>

				<div class="c7 partenaires">
					<div class="padding">
					
						<?php foreach($partenaires as $p) : 
							$site = $p['site_web'];
							$nom = $p['nom'];
							$logoid = $p['logo'];
							$logo = wp_get_attachment_image_src($logoid, 'medium');
							?>
							<?php if($p['site_web']) : ?>
								<a href="<?php echo $site; ?>"><img src="<?php echo $logo[0]; ?>" alt="<?php echo $nom; ?>"></a>
							<?php else : ?>
								<img src="<?php echo $logo[0]; ?>" alt="<?php echo $nom; ?>">
							<?php endif; ?>

						<?php endforeach; ?>

					</div>
				</div>

			</div>

		</div>

	</footer><!-- #colophon -->

</div><!-- .wrapper -->

<?php wp_footer(); ?>

</body>
</html>
