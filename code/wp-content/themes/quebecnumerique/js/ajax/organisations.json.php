<?php

/* 
 * Fichier JSON des Organisations
 */

//Exemple il faudra le générer plus tard
$data    = array();

$data[0]['id']     = 'id1';
$data[0]['title']  = 'Title1 Organisation';
$data[0]['window'] = 'Window1';
$data[0]['lat']    = '46.809131';
$data[0]['long']   = '-71.212681';

$data[1]['id']     = 'id2';
$data[1]['title']  = 'Title2 Organisation';
$data[1]['window'] = 'Window2';
$data[1]['lat']    = '46.810354';
$data[1]['long']   = '-71.210224';

$data[2]['id']     = 'id3';
$data[2]['title']  = 'Title3 Organisation';
$data[2]['window'] = 'Window3';
$data[2]['lat']    = '46.809631';
$data[2]['long']   = '-71.210653';

$data[3]['id']     = 'id4';
$data[3]['title']  = 'Title4 Organisation';
$data[3]['window'] = 'Window4';
$data[3]['lat']    = '46.808254';
$data[3]['long']   = '-71.212691';

header('Content-type: application/json');

echo json_encode($data);
