<?php
require_once('../../../../../wp-config.php');


$projets = new WP_Query(array(
        'post_type' => 'projets',
        'post_per_page' => 100,
        'orderby' => 'the_date', 
        'order' => 'DESC'));


/* 
 * Fichier JSON des Evènements
 */

//Exemple il faudra le générer plus tard
$data    = array();

foreach($projets->posts as $e){
    $localisation    = get_post_meta($e->ID, 'localisation');
    if(isset($localisation[0]['lat']) && !empty($localisation[0]['lat']) && isset($localisation[0]['lng']) && !empty($localisation[0]['lng'])){
        $ligne['id']     = $e->ID;
        $ligne['title']  = $e->post_title;
        $ligne['window'] = '<div class="nouvelles window"><h3>' . $e->post_title.'</h3><a class="btn-map" href="'. get_the_permalink($e->ID) .'">Plus de détails</a></div>';
        $ligne['lat']    = $localisation[0]['lat'];
        $ligne['long']   = $localisation[0]['lng'];
        array_push($data, $ligne);
    }
}

/*$data[0]['id']     = 'id1';
$data[0]['title']  = 'Title1 Evènement';
$data[0]['window'] = 'Window1';
$data[0]['lat']    = '46.812375';
$data[0]['long']   = '-71.203567';*/

header('Content-type: application/json');

echo json_encode($data);
