<?php
function _merge_array($old, $new) {
  foreach($new as $key => $item) {
    if(isset($old[$key])
     && gettype($old[$key]) == gettype($new[$key])) {
      if(is_array($item) || is_object($item)) {
        $old[$key] = _merge_array($old[$key], $new[$key]);
      }
      else {
        $old[$key] = $new[$key];
      }
    }
  }
     
  return $old;
}

function clean($string) {
   $string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.

   return preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.
}

require_once('../../../../../wp-config.php');

//Inclusion du oAuth Wrapper PHP
require_once('../../inc/api-twitter/TwitterAPIExchange.php');

/** Déclaration des tokens, à mettre entre les guillemets - a voir sur: https://dev.twitter.com/apps/ **/
$settings = array(
    'oauth_access_token'        => oauth_access_token,
    'oauth_access_token_secret' => oauth_access_token_secret,
    'consumer_key'              => consumer_key,
    'consumer_secret'           => consumer_secret
);

//On spécifie l'URL de l'API que l'on utilise
$url = 'https://api.twitter.com/1.1/search/tweets.json';

$allResponse = array();

$tags     = get_terms( 'mots-cles',array('hide_empty' => 0));
$hashtags = '';
$cpt      = 0;
foreach ($tags as $t) {
    if($cpt > 0){
        $hashtags .= '+OR+';
    }
    $hashtags .= clean($t->name);
    $cpt++;
    if($cpt > 25){
        echo '<br />'.$hashtags.'<br />';
        //Système de pagination
        $maxID = '';
        if(isset($_GET['maxID']) && $_GET['maxID'] > 0){
            $maxID = '&max_id='.$_GET['maxID'];
        }

        //Construction de la requête, doc sur https://dev.twitter.com/docs/api/1.1/get/search/tweets for params
        $getfield = '?q=' . $hashtags . '+exclude:retweets&result_type=recent&count=100&geocode=46.803587,-71.242754,15km'.$maxID;
        //&result_type=recent&geocode=46.803587,-71.242754,400km

        //La requête ne comporte pas beaucoup de paramètres, on utilise donc la méthode GET au lieu de POST
        $requestMethod = 'GET';

        //Initialisation de la connection à l'API Twitter
        $twitter = new TwitterAPIExchange($settings);
        $response = $twitter->setGetfield($getfield)
                            ->buildOauth($url, $requestMethod)
                           ->performRequest();
        
        $responseArray = json_decode($response, true);
        echo '=>' . count($responseArray['statuses']).'<br />';
        /*if(empty($allResponse)){
            $allResponse = $responseArray;
        }else{*/
            $allResponse = array_merge_recursive($allResponse,$responseArray);
        //}                
        $hashtags = '';
        $cpt = 0;
    }
}

//$allResponse = '{"errors":[{"message":"Rate limit exceeded","code":88},{"message":"Rate limit exceeded","code":88},{"message":"Rate limit exceeded","code":88},{"message":"Rate limit exceeded","code":88},{"message":"Rate limit exceeded","code":88}]}';
//$allResponse = json_decode($allResponse);
//print_r($allResponse);

/*if(isset($allResponse->errors[0]->code) && $allResponse->errors[0]->code == '88'){  
    $allResponse = get_option('twitterJson');   
}else{
    $allResponse = json_encode($allResponse);
    if(get_option('twitterJson')){
        update_option('twitterJson', $allResponse);
    }else{
        add_option( 'twitterJson', $allResponse );
    }
}*/
//print_r($allResponse);
echo count($allResponse['statuses']);exit;

$allResponse = json_encode($allResponse);

header('Content-type: application/json');
header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); // Date dans le passé
echo $allResponse;