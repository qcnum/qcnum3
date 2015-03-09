<?php

/* 
 * Fichier JSON des Evènements
 */

//Exemple il faudra le générer plus tard
$data    = array();

$data[0]['id']     = 'id1';
$data[0]['title']  = 'Title1 Evènement';
$data[0]['window'] = 'Window1';
$data[0]['lat']    = '46.812375';
$data[0]['long']   = '-71.203567';

$data[1]['id']     = 'id2';
$data[1]['title']  = 'Title2 Evènement';
$data[1]['window'] = 'Window2';
$data[1]['lat']    = '46.812834';
$data[1]['long']   = '-71.202752';

$data[2]['id']     = 'id3';
$data[2]['title']  = 'Title3 Evènement';
$data[2]['window'] = 'Window3';
$data[2]['lat']    = '46.812404';
$data[2]['long']   = '-71.202902';

$data[3]['id']     = 'id4';
$data[3]['title']  = 'Title4 Evènement';
$data[3]['window'] = 'Window4';
$data[3]['lat']    = '46.812011';
$data[3]['long']   = '-71.203278';

header('Content-type: application/json');

echo json_encode($data);
