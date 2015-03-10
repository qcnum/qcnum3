<?php

/* 
 * Fichier JSON des Nouvelles
 */

//Appel GET, possibilité de passer des paramètres afin d'affiner l'affichage
$periode = '';
if(isset($_GET['periode'])){
    
}
$limite = '';
if(isset($_GET['limite'])){
    
}

//Exemple il faudra le générer plus tard
$data    = array();

$data[0]['id']     = 'id1';
$data[0]['title']  = 'Title1 Nouvelle';
$data[0]['window'] = 'Window1';
$data[0]['lat']    = '46.814014';
$data[0]['long']   = '-71.212520';

$data[1]['id']     = 'id2';
$data[1]['title']  = 'Title2 Nouvelle';
$data[1]['window'] = 'Window2';
$data[1]['lat']    = '46.813280';
$data[1]['long']   = '-71.201749';

$data[2]['id']     = 'id3';
$data[2]['title']  = 'Title3 Nouvelle';
$data[2]['window'] = 'Window3';
$data[2]['lat']    = '46.807336';
$data[2]['long']   = '-71.216211';

$data[3]['id']     = 'id4';
$data[3]['title']  = 'Title4 Nouvelle';
$data[3]['window'] = 'Window4';
$data[3]['lat']    = '46.813474';
$data[3]['long']   = '-71.211565';

$data[4]['id']     = 'id5';
$data[4]['title']  = 'Title5 projet';
$data[4]['window'] = 'Window5';
$data[4]['lat']    = '46.814798';
$data[4]['long']   = '-71.224193';

header('Content-type: application/json');
echo json_encode($data);
