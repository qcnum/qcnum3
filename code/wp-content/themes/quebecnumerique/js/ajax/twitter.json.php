<?php
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

$tags     = get_terms( 'mots-cles',array('hide_empty' => 0));
$hashtags = '';
$cpt      = 0;
foreach ($tags as $t) {
    if($cpt > 0){
        $hashtags .= '+OR+';
    }
    $hashtags .= $t->name;
    $cpt++;
}

//Construction de la requête, doc sur https://dev.twitter.com/docs/api/1.1/get/search/tweets for params
$getfield = '?q=' . $hashtags . '+exclude:retweets&result_type=recent&count=100&geocode=46.803587,-71.242754,25km';
//&result_type=recent&geocode=46.803587,-71.242754,400km

//La requête ne comporte pas beaucoup de paramètres, on utilise donc la méthode GET au lieu de POST
$requestMethod = 'GET';

//Initialisation de la connection à l'API Twitter
$twitter = new TwitterAPIExchange($settings);
$response = $twitter->setGetfield($getfield)
                    ->buildOauth($url, $requestMethod)
                   ->performRequest();

header('Content-type: application/json');
echo $response;