<?php 
$query_types = $_GET['post_type']; 
$query_cat = $_GET['category_name']; 
?>

<div class="recherche">
	<form role="search" method="get" id="searchform" action="">
		<input type="text" name="s" id="s" value="<?php the_search_query(); ?>" /><br />
		<?php $categories = get_categories();
		foreach ($categories as $cat) {
			$cat_slug = $cat->slug;
			$cat_id = $cat->term_id;
			$cat_name = $cat->name;?>
			<input type="checkbox" class="unecat" name="category_name[]" value="<?php echo $cat_id; ?>" <?php if (in_array($cat_id, $query_cat)) { echo 'checked="checked"'; } ?> >
			<label><?php echo $cat->cat_name;?></label>
		<?php } ?>	

		<input type="checkbox" name="post_type[]" class="post-checkbox visuallyhidden" value="post" <?php if (in_array('post', $query_types)) { echo 'checked="checked"'; } ?> />
		<input type="checkbox" name="post_type[]" value="organisations" <?php if (in_array('organisations', $query_types)) { echo 'checked="checked"'; } ?> /><label>Organisations</label>
		<input type="checkbox" name="post_type[]" value="projets" <?php if (in_array('projets', $query_types)) { echo 'checked="checked"'; } ?> /><label>Projets</label>
		<input type="checkbox" name="post_type[]" value="evenements" <?php if (in_array('evenements', $query_types)) { echo 'checked="checked"'; } ?> /><label>Événements</label>
		<input type="submit" id="searchsubmit" value="Search" />
	</form>

	<?php 
		$myterms = get_terms('mots-cles');
		foreach($myterms as $term){
			$term_taxonomy=$term->Categories;
			$term_slug=$term->slug;
			$term_name =$term->name;
			$link = $term_slug;

			echo $term_name;

			//$output .="<input type="" value='".$link."'>".$term_name."</option>";
		}
	?>


</div>