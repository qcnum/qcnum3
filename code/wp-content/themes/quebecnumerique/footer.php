
	</div><!-- #main -->


	<div id="map">
		<?php
		if ( is_home() ) {
		    ?>
			<div class="stats c12">
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
				<ul>
					<li><?php echo $nb_nouvelles->category_count; ?></li>
					<li><?php echo $nb_articles->category_count; ?></li>
					<li><?php echo $nb_evenements->publish; ?></li>
					<li><?php echo $nb_organisations->publish; ?></li>
					<li><?php echo $nb_projets->publish; ?></li>
				</ul>
			</div>
			<hr class="clear">	
		    <?php
		}
		?>
	</div>

	<footer id="colophon" role="contentinfo">
	
		<div class="group">
				
			<div class="c6 center entry-content">
				<?php echo do_shortcode('[gravityform id=1 title=true description=true]'); ?>
			</div>

		</div>

		<div class="gris-bg group">
			
			<p class="c6 email">
				<?php _e('Pour informations', THEME_NAME); ?> : <a href="mailto:<?php echo get_option( 'admin_email' ); ?>"><?php echo get_option( 'admin_email' ); ?></a>
			</p>

			<div class="c6">
				<?php echo get_social_media(); ?>
			</div>

		</div>

		<div class="blanc-bg group">
			
			<?php 
			$propos = get_field('propos', 'options');
			$partenaires = get_field('partenaires', 'options');
			?>

			<div class="c5 entry-content">
				<?php echo $propos; ?>
			</div>

			<div class="c7 partenaires">
				
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

	</footer><!-- #colophon -->

</div><!-- .wrapper -->

<?php wp_footer(); ?>

</body>
</html>
