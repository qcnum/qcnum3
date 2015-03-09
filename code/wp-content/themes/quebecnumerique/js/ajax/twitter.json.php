<?php

/* 
 * Fichier JSON des Twitters
 */

//Exemple il faudra le générer plus tard
$data    = array();

$data[0]['id']     = 'id1';
$data[0]['title']  = 'Title1 Twitter';
$data[0]['window'] = 'Window1';
$data[0]['lat']    = '';
$data[0]['long']   = '';

$data[1]['id']     = 'id2';
$data[1]['title']  = 'Title2 Twitter';
$data[1]['window'] = 'Window2';
$data[1]['lat']    = '';
$data[1]['long']   = '';

$data[2]['id']     = 'id3';
$data[2]['title']  = 'Title3 Twitter';
$data[2]['window'] = 'Window3';
$data[2]['lat']    = '';
$data[2]['long']   = '';

$data[3]['id']     = 'id4';
$data[3]['title']  = 'Title4 Twitter';
$data[3]['window'] = 'Window4';
$data[3]['lat']    = '';
$data[3]['long']   = '';

header('Content-type: application/json');

echo json_encode($data);
