<?php
function removeAccents($str) {
	$a = array('À', 'Á', 'Â', 'Ã', 'Ä', 'Å', 'Æ', 'Ç', 'È', 'É', 'Ê', 'Ë', 'Ì', 'Í', 'Î', 'Ï', 'Ð', 'Ñ', 'Ò', 'Ó', 'Ô', 'Õ', 'Ö', 'Ø', 'Ù', 'Ú', 'Û', 'Ü', 'Ý', 'ß', 'à', 'á', 'â', 'ã', 'ä', 'å', 'æ', 'ç', 'è', 'é', 'ê', 'ë', 'ì', 'í', 'î', 'ï', 'ñ', 'ò', 'ó', 'ô', 'õ', 'ö', 'ø', 'ù', 'ú', 'û', 'ü', 'ý', 'ÿ', 'Ā', 'ā', 'Ă', 'ă', 'Ą', 'ą', 'Ć', 'ć', 'Ĉ', 'ĉ', 'Ċ', 'ċ', 'Č', 'č', 'Ď', 'ď', 'Đ', 'đ', 'Ē', 'ē', 'Ĕ', 'ĕ', 'Ė', 'ė', 'Ę', 'ę', 'Ě', 'ě', 'Ĝ', 'ĝ', 'Ğ', 'ğ', 'Ġ', 'ġ', 'Ģ', 'ģ', 'Ĥ', 'ĥ', 'Ħ', 'ħ', 'Ĩ', 'ĩ', 'Ī', 'ī', 'Ĭ', 'ĭ', 'Į', 'į', 'İ', 'ı', 'Ĳ', 'ĳ', 'Ĵ', 'ĵ', 'Ķ', 'ķ', 'Ĺ', 'ĺ', 'Ļ', 'ļ', 'Ľ', 'ľ', 'Ŀ', 'ŀ', 'Ł', 'ł', 'Ń', 'ń', 'Ņ', 'ņ', 'Ň', 'ň', 'ŉ', 'Ō', 'ō', 'Ŏ', 'ŏ', 'Ő', 'ő', 'Œ', 'œ', 'Ŕ', 'ŕ', 'Ŗ', 'ŗ', 'Ř', 'ř', 'Ś', 'ś', 'Ŝ', 'ŝ', 'Ş', 'ş', 'Š', 'š', 'Ţ', 'ţ', 'Ť', 'ť', 'Ŧ', 'ŧ', 'Ũ', 'ũ', 'Ū', 'ū', 'Ŭ', 'ŭ', 'Ů', 'ů', 'Ű', 'ű', 'Ų', 'ų', 'Ŵ', 'ŵ', 'Ŷ', 'ŷ', 'Ÿ', 'Ź', 'ź', 'Ż', 'ż', 'Ž', 'ž', 'ſ', 'ƒ', 'Ơ', 'ơ', 'Ư', 'ư', 'Ǎ', 'ǎ', 'Ǐ', 'ǐ', 'Ǒ', 'ǒ', 'Ǔ', 'ǔ', 'Ǖ', 'ǖ', 'Ǘ', 'ǘ', 'Ǚ', 'ǚ', 'Ǜ', 'ǜ', 'Ǻ', 'ǻ', 'Ǽ', 'ǽ', 'Ǿ', 'ǿ', 'Ά', 'ά', 'Έ', 'έ', 'Ό', 'ό', 'Ώ', 'ώ', 'Ί', 'ί', 'ϊ', 'ΐ', 'Ύ', 'ύ', 'ϋ', 'ΰ', 'Ή', 'ή');
	$b = array('A', 'A', 'A', 'A', 'A', 'A', 'AE', 'C', 'E', 'E', 'E', 'E', 'I', 'I', 'I', 'I', 'D', 'N', 'O', 'O', 'O', 'O', 'O', 'O', 'U', 'U', 'U', 'U', 'Y', 's', 'a', 'a', 'a', 'a', 'a', 'a', 'ae', 'c', 'e', 'e', 'e', 'e', 'i', 'i', 'i', 'i', 'n', 'o', 'o', 'o', 'o', 'o', 'o', 'u', 'u', 'u', 'u', 'y', 'y', 'A', 'a', 'A', 'a', 'A', 'a', 'C', 'c', 'C', 'c', 'C', 'c', 'C', 'c', 'D', 'd', 'D', 'd', 'E', 'e', 'E', 'e', 'E', 'e', 'E', 'e', 'E', 'e', 'G', 'g', 'G', 'g', 'G', 'g', 'G', 'g', 'H', 'h', 'H', 'h', 'I', 'i', 'I', 'i', 'I', 'i', 'I', 'i', 'I', 'i', 'IJ', 'ij', 'J', 'j', 'K', 'k', 'L', 'l', 'L', 'l', 'L', 'l', 'L', 'l', 'l', 'l', 'N', 'n', 'N', 'n', 'N', 'n', 'n', 'O', 'o', 'O', 'o', 'O', 'o', 'OE', 'oe', 'R', 'r', 'R', 'r', 'R', 'r', 'S', 's', 'S', 's', 'S', 's', 'S', 's', 'T', 't', 'T', 't', 'T', 't', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'W', 'w', 'Y', 'y', 'Y', 'Z', 'z', 'Z', 'z', 'Z', 'z', 's', 'f', 'O', 'o', 'U', 'u', 'A', 'a', 'I', 'i', 'O', 'o', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'A', 'a', 'AE', 'ae', 'O', 'o', 'Α', 'α', 'Ε', 'ε', 'Ο', 'ο', 'Ω', 'ω', 'Ι', 'ι', 'ι', 'ι', 'Υ', 'υ', 'υ', 'υ', 'Η', 'η');
	return str_replace($a, $b, $str);
}

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
   $string = str_replace(array(' ','\'','.'), '-', $string); // Replaces all spaces with hyphens.

   //return preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.
   return removeAccents(strtolower($string)); // Removes special chars.
}

require_once('../../../../../wp-config.php');

//Inclusion du oAuth Wrapper PHP
require_once('../../inc/api-twitter/TwitterAPIExchange.php');

function listTweets($hashtags = ''){
    
        /** Déclaration des tokens, à mettre entre les guillemets - a voir sur: https://dev.twitter.com/apps/ **/
        $settings = array(
            'oauth_access_token'        => oauth_access_token,
            'oauth_access_token_secret' => oauth_access_token_secret,
            'consumer_key'              => consumer_key,
            'consumer_secret'           => consumer_secret
        );

        //On spécifie l'URL de l'API que l'on utilise
        $url = 'https://api.twitter.com/1.1/search/tweets.json';
    
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
        
        return $responseArray;
}




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
    if($cpt > 9){
        
        $responseArray = listTweets($hashtags);
        
        $allResponse = array_merge_recursive($allResponse,$responseArray);
               
        $hashtags = '';
        $cpt = 0;
    }
}
if($hashtags != '' && $cpt > 0){
    $responseArray = listTweets($hashtags);
    $allResponse = array_merge_recursive($allResponse,$responseArray);
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

$allResponse = json_encode($allResponse);

if(get_option('twitterJson')){
    update_option('twitterJson', $allResponse);
    update_option('twitterJson_maj', date('Y-m-d h:i:s'));
}else{
    add_option( 'twitterJson_maj', date('Y-m-d h:i:s'));
}

header('Content-type: application/json');
header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); // Date dans le passé
echo $allResponse;