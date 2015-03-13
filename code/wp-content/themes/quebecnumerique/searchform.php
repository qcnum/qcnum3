<?php 
if($_GET['quartiers'] || $_GET['mots-cles'] || $_GET['post_type']) {
	$query_q = $_GET['quartiers']; 
	$query_mc = $_GET['mots-cles'];
	$query_p = $_GET['post_type'];
} else {
	$o = get_queried_object();
	$query_q = array();
	$query_mc = array();
	if($o->taxonomy == 'quartiers') {
		array_push($query_q, $o->slug); 
	} elseif($o->taxonomy == 'mots-cles') {
		array_push($query_mc, $o->slug); 
	}
}
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

			<div class="c12">

				<div class="filtre nouvelles">
					<input id="recherche-nouvelles" class="resultat" type="checkbox" name="post_type[]" value="post" <?php if (in_array('post', $query_p)) { echo 'checked="checked"'; } ?>>
					<label class="filtre-recherche" for="recherche-nouvelles">Nouvelles</label>
				</div>

				<div class="filtre articles">
					<input id="recherche-articles" class="resultat" type="checkbox" name="post_type[]" value="post" <?php if (in_array('post', $query_p)) { echo 'checked="checked"'; } ?>>
					<label class="filtre-recherche" for="recherche-articles">Articles</label>
				</div>

				<div class="filtre evenements">
					<input id="recherche-evenements" class="resultat" type="checkbox" name="post_type[]" value="evenements" <?php if (in_array('evenements', $query_p)) { echo 'checked="checked"'; } ?>>
					<label class="filtre-recherche" for="recherche-evenements">Événements</label>
				</div>

				<div class="filtre organisations">
					<input id="recherche-organisations" class="resultat" type="checkbox" name="post_type[]" value="organisations" <?php if (in_array('organisations', $query_p)) { echo 'checked="checked"'; } ?>>
					<label class="filtre-recherche" for="recherche-organisations">Organisations</label>
				</div>

				<div class="filtre projets">
					<input id="recherche-projets" class="resultat" type="checkbox" name="post_type[]" value="projets" <?php if (in_array('projets', $query_p)) { echo 'checked="checked"'; } ?>>
					<label class="filtre-recherche" for="recherche-projets">Projets</label>
				</div>

				<div class="filtre autre">
					<input id="recherche-autre" class="resultat" type="checkbox" name="post_type[]" value="page" <?php echo $check; ?>>
					<label class="filtre-recherche" for="recherche-autre">Autre</label>
				</div>

			</div>

			<div class="c6">

				<h3><?php _e('Mots-clés', THEME_NAME); ?></h3>

				<?php $motsCles = get_terms('mots-cles');
				foreach ($motsCles as $mc) {
					$mc_slug = $mc->slug;
					$mc_id = $mc->term_id;
					$mc_name = $mc->name;?>
					<div class="mot-cle filtre">
						<input id="<?php echo $mc_slug; ?>" type="checkbox" name="mots-cles[]" value="<?php echo $mc_slug; ?>" <?php if (in_array($mc_slug, $query_mc)) { echo 'checked="checked"'; } ?> >
						<label for="<?php echo $mc_slug; ?>"><?php echo $mc_name;?></label>
					</div>
				<?php } ?>	

			</div>

			<div class="c6">

				<h3><?php _e('Quartier', THEME_NAME); ?></h3>

				<?php $quartiers = get_terms('quartiers');
				foreach ($quartiers as $q) {
					$q_slug = $q->slug;
					$q_id = $q->term_id;
					$q_name = $q->name; ?>
					<div class="mot-cle filtre">
						<input id="<?php echo $q_slug; ?>" type="checkbox" name="quartiers[]" value="<?php echo $q_slug; ?>" <?php if (in_array($q_slug, $query_q)) { echo 'checked="checked"'; } ?> >
						<label for="<?php echo $q_slug; ?>"><?php echo $q_name; ?></label>
					</div>
				<?php } ?>

			</div>

			<hr class="clear">
			
			<div><input type="submit" id="searchsubmit" value="Search" /></div>

		</div>
	</form>
