<?php
require_once('../../../../../wp-config.php');

$nouvelles = new WP_Query(array(
        'post_type' => 'post',
        'post_per_page' => 50,
        'orderby' => 'the_date', 
        'order' => 'DESC'));

/* 
 * Fichier JSON des Evènements
 */

//Exemple il faudra le générer plus tard
$data    = array();

foreach($nouvelles->posts as $e){
    $localisation    = get_post_meta($e->ID, 'localisation');
    if(isset($localisation[0]['lat']) && !empty($localisation[0]['lat']) && isset($localisation[0]['lng']) && !empty($localisation[0]['lng'])){
        $ligne['id']     = $e->ID;
        $ligne['title']  = $e->post_title;
        $ligne['window'] = $e->post_title.'<br />'.  get_the_permalink($e->ID);
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
