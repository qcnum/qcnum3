
	</div><!-- #main -->

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
				
				<?php foreach($partenaires as $p) : ?>
					
					<a href="<?php echo $p['site_web']; ?>"><img src="http://placehold.it/150x85" alt=""></a>

				<?php endforeach; ?>

			</div>

		</div>

	</footer><!-- #colophon -->

</div><!-- .wrapper -->

<?php wp_footer(); ?>

</body>
</html>
