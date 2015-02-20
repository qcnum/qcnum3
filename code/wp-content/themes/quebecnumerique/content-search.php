<?php 
$query_q = $_GET['quartiers']; 
$query_mc = $_GET['mots-cles']; 
$recherche = $_GET['recherche']; 
?>

<div class="recherche">

	<form role="search" method="get" id="searchform" action="recherche">
		<input type="text" name="recherche" id="s" value="<?php echo $recherche; ?>" /><br />

		<h2>Mots-clés</h2>

		<?php $motsCles = get_terms('mots-cles');
		foreach ($motsCles as $mc) {
			$mc_slug = $mc->slug;
			$mc_id = $mc->term_id;
			$mc_name = $mc->name;?>
			<input type="checkbox" name="mots-cles[]" value="<?php echo $mc_slug; ?>" <?php if (in_array($mc_slug, $query_mc)) { echo 'checked="checked"'; } ?> >
			<label><?php echo $mc_name;?></label>
		<?php } ?>	

		<h2>Quartier</h2>

		<?php $quartiers = get_terms('quartier');
		foreach ($quartiers as $q) {
			$q_slug = $q->slug;
			$q_id = $q->term_id;
			$q_name = $q->name; ?>
			<input type="checkbox" name="quartiers[]" value="<?php echo $q_slug; ?>" <?php if (in_array($q_slug, $query_q)) { echo 'checked="checked"'; } ?> >
			<label><?php echo $q_name; ?></label>
		<?php } ?>	
		
		<input type="submit" id="searchsubmit" value="Search" />
	</form>

</div>