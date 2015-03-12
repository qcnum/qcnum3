
	<article >
		
		<h2 class="grisopac-bg"><?php _e( 'Rien de trouvé', THEME_NAME ); ?></h2>

		<div class="entry-content">

			<?php if ( is_search() ) : ?>

				<p><?php _e( 'Désolé, mais rien ne correspond à votre critère de recherche. Veuillez réessayer avec d\'autres mots-clés.', THEME_NAME ); ?></p>

			<?php else : ?>

				<p><?php _e( 'Il semblerait que nous ne soyons pas en mesure de trouver votre contenu. Essayez en lançant une recherche.', THEME_NAME ); ?></p>

			<?php endif; ?>

		</div>
				
	</article>
