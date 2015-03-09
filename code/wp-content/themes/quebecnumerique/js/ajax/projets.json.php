<?php

/* 
 * Fichier JSON des projets
 */

//Exemple il faudra le générer plus tard
$data    = array();

$data[0]['id']     = 'id1';
$data[0]['title']  = 'Title1 projet';
$data[0]['window'] = 'Window1';
$data[0]['lat']    = '46.812025';
$data[0]['long']   = '-71.205589';

$data[1]['id']     = 'id2';
$data[1]['title']  = 'Title2 projet';
$data[1]['window'] = 'Window2';
$data[1]['lat']    = '46.811835';
$data[1]['long']   = '-71.206453';

$data[2]['id']     = 'id3';
$data[2]['title']  = 'Title3 projet';
$data[2]['window'] = 'Window3';
$data[2]['lat']    = '46.816883';
$data[2]['long']   = '-71.213593';

$data[3]['id']     = 'id4';
$data[3]['title']  = 'Title4 projet';
$data[3]['window'] = 'Window4';
$data[3]['lat']    = '46.814798';
$data[3]['long']   = '-71.224193';

header('Content-type: application/json');

echo json_encode($data);
