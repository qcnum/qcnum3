<?php 
$query_q = $_GET['quartiers']; 
$query_mc = $_GET['mots-cles']; 
?>

	<a href="#" class="fa fa-search"></a>
	<form method="get" id="searchform" class="hidden" action="<?php echo esc_url( home_url( '/' ) ); ?>">

		<div class="absolute">

			<a href="#" class="fa fa-close"></a>
			<input type="text" class="field" name="s" id="s" value="<?php echo get_search_query(); ?>" />
			<button type="submit" class="fa fa-search"></button>
			<input type="button" class="advanced" value="<?php _e('Recherche avancée', THEME_NAME); ?>">

		</div>

		<div class="recherche hidden group">

			<div class="c6">

				<h2><?php _e('Mots-clés', THEME_NAME); ?></h2>

				<?php $motsCles = get_terms('mots-cles');
				foreach ($motsCles as $mc) {
					$mc_slug = $mc->slug;
					$mc_id = $mc->term_id;
					$mc_name = $mc->name;?>
					<div class="mot-cle">
						<input id="<?php echo $mc_slug; ?>" type="checkbox" name="mots-cles[]" value="<?php echo $mc_slug; ?>" <?php if (in_array($mc_slug, $query_mc)) { echo 'checked="checked"'; } ?> >
						<label for="<?php echo $mc_slug; ?>" id=""><?php echo $mc_name;?></label>
					</div>
				<?php } ?>	

			</div>

			<div class="c6">

				<h2><?php _e('Quartier', THEME_NAME); ?></h2>

				<?php $quartiers = get_terms('quartier');
				foreach ($quartiers as $q) {
					$q_slug = $q->slug;
					$q_id = $q->term_id;
					$q_name = $q->name; ?>
					<div class="mot-cle">
						<input id="<?php echo $q_slug; ?>" type="checkbox" name="quartiers[]" value="<?php echo $q_slug; ?>" <?php if (in_array($q_slug, $query_q)) { echo 'checked="checked"'; } ?> >
						<label for="<?php echo $q_slug; ?>"><?php echo $q_name; ?></label>
					</div>
				<?php } ?>

			</div>
			
			<div><input type="submit" id="searchsubmit" value="Search" /></div>

		</div>
	</form>
