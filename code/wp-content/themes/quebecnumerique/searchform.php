<?php 
$query_q = array();
$query_mc= array();
$query_p = array();
if(isset($_GET['quartiers'])) { $query_q = $_GET['quartiers']; }
if(isset($_GET['mots-cles'])) { $query_mc = $_GET['mots-cles']; }
if(isset($_GET['post_type'])) { $query_p = $_GET['post_type']; }
if(empty($query_q) && empty($query_mc) && empty($query_p)) {
	$o = get_queried_object();
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

				<h3><?php _e('Type de contenus', THEME_NAME); ?></h3>

				<div class="group">

					<div class="filtre nouvelles">
						<input id="recherche-nouvelles" class="resultat" type="checkbox" name="post_type[]" value="post" <?php if (in_array('post', $query_p)) { echo 'checked="checked"'; } ?>>
						<label class="filtre-recherche" for="recherche-nouvelles">Nouvelles</label>
					</div>

					<div class="filtre articles">
						<input id="recherche-articles" class="resultat" type="checkbox" name="post_type[]" value="post" <?php if (in_array('post', $query_p)) { echo 'checked="checked"'; } ?>>
						<label class="filtre-recherche" for="recherche-articles">Chroniques</label>
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
						<input id="recherche-autre" class="resultat" type="checkbox" name="post_type[]" value="page" <?php if (in_array('page', $query_p)) { echo 'checked="checked"'; } ?>>
						<label class="filtre-recherche" for="recherche-autre">Autre</label>
					</div>

				</div>

			</div>

			<div class="c12">

				<h3><?php _e('Mots-clés', THEME_NAME); ?></h3>

				<div class="group">
					<?php 
					$args = array(
						'orderby' => 'count',
						'order' => 'DESC',
						'hide_empty' => true,
					    'parent ' => 0,
					    'number' => 15
					);
					$motsCles = get_terms('mots-cles', $args);

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

			</div>

			<div class="c12">

				<h3><?php _e('Quartiers', THEME_NAME); ?></h3>

				<div class="group">
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

			</div>

			<hr class="clear">
			
			<div><input type="submit" id="searchsubmit" value="<?php _e('Rechercher', THEME_NAME); ?>" /></div>

		</div>
	</form>
