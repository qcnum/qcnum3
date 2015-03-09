
	</div><!-- #main -->

	<?php
	if ( is_home() ) {
	    ?>
		<div class="stats">
			<?php 
			$stats = get_field('phrase_stats', 'options');
			?>
			<p><?php echo $stats ?></p>
		</div>	
	    <?php
	}
	?>
        <div><input type="checkbox" id="nouvelles" value="1" checked="checked" class="selection"/> Nouvelles <input type="checkbox" id="evenements" value="1" checked="checked"  class="selection"/> Evènements <input type="checkbox" id="organisations" value="1" checked="checked" class="selection"/> Organisations <input type="checkbox" id="projets" value="1" checked="checked" class="selection"/> Projets <input type="checkbox" id="twitter" value="1" class="selection"/> Twitter </div>
	<div id="map"></div>

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
