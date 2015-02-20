
	<a href="#" class="fa fa-search"></a>
	<form method="get" id="searchform" class="hidden" action="<?php echo esc_url( home_url( '/' ) ); ?>">
		<a href="#" class="fa fa-close"></a>
		<input type="text" class="field" name="s" id="s" />
		<input type="submit" class="submit" name="submit" id="searchsubmit" value="<?php esc_attr_e( 'Recherche', THEME_NAME ); ?>" />
	</form>
