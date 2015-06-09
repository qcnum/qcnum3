<?php
/**
 * La configuration de base de votre installation WordPress.
 *
 * Ce fichier contient les réglages de configuration suivants : réglages MySQL,
 * préfixe de table, clefs secrètes, langue utilisée, et ABSPATH.
 * Vous pouvez en savoir plus à leur sujet en allant sur 
 * {@link http://codex.wordpress.org/fr:Modifier_wp-config.php Modifier
 * wp-config.php}. C'est votre hébergeur qui doit vous donner vos
 * codes MySQL.
 *
 * Ce fichier est utilisé par le script de création de wp-config.php pendant
 * le processus d'installation. Vous n'avez pas à utiliser le site web, vous
 * pouvez simplement renommer ce fichier en "wp-config.php" et remplir les
 * valeurs.
 *
 * @package WordPress
 */

if ('www.quebecnumerique.dev.evollia.com' === $_SERVER[ 'HTTP_HOST' ]) {
	//define('DB_NAME', 'dev_quebecnumerique_www');
	//define('DB_USER', 'root');
	//define('DB_PASSWORD', 'root');
	//define('DB_HOST', 'localhost');
	//define('WP_SITEURL', 'http://www.quebecnumerique.dev.evollia.com');
	//define('WP_HOME', 'http://www.quebecnumerique.dev.evollia.com');
	//define('WP_DEBUG', false); 
  define('DB_NAME', 'approb_quebecnumerique_www');
  define('DB_USER', 'root');
  define('DB_PASSWORD', 'nac4Kaspuy2drEwreS6astez5ch8F2Spax5xehespafrebrEchAwaFr8spaCH7qe');
  define('DB_HOST', 'eris.evollia.com');
  define('WP_SITEURL', 'http://www.quebecnumerique.dev.evollia.com');
  define('WP_HOME', 'http://www.quebecnumerique.dev.evollia.com');
  define('WP_DEBUG', false); 
        //Apps Twitter
        define('oauth_access_token',"421936727-GRdijS26xhEkqczDWeFSvHacHLThOju15jxX2N8d");
        define('oauth_access_token_secret',"PScrCDTDLjKVrjUJIZ4NjlelKisjNyAYwVk40TjpADH8W");
        define('consumer_key',"5T1S4slgI6sDOmItbHsBrnlnG");
        define('consumer_secret',"0xz8sAWVfphJ9GnSIVf50GUj6xaDF5gycfovfn7zwOpMZri4UZ");

} elseif ('www.quebecnumerique.approb.evollia.com' === $_SERVER[ 'HTTP_HOST' ]) {
	define('DB_NAME', 'approb_quebecnumerique_www');
	define('DB_USER', 'root');
	define('DB_PASSWORD', 'nac4Kaspuy2drEwreS6astez5ch8F2Spax5xehespafrebrEchAwaFr8spaCH7qe');
	define('DB_HOST', 'localhost');
	define('WP_SITEURL', 'http://www.quebecnumerique.approb.evollia.com');
	define('WP_HOME', 'http://www.quebecnumerique.approb.evollia.com');
	define('WP_DEBUG', false); 
        //Apps Twitter
        define('oauth_access_token',"421936727-GRdijS26xhEkqczDWeFSvHacHLThOju15jxX2N8d");
        define('oauth_access_token_secret',"PScrCDTDLjKVrjUJIZ4NjlelKisjNyAYwVk40TjpADH8W");
        define('consumer_key',"5T1S4slgI6sDOmItbHsBrnlnG");
        define('consumer_secret',"0xz8sAWVfphJ9GnSIVf50GUj6xaDF5gycfovfn7zwOpMZri4UZ");
} elseif ('qn.appyk.fr' === $_SERVER[ 'HTTP_HOST' ]) {
	define('DB_NAME', 'approb_quebecnumerique_www');
        define('DB_USER', 'root');
        define('DB_PASSWORD', 'nac4Kaspuy2drEwreS6astez5ch8F2Spax5xehespafrebrEchAwaFr8spaCH7qe');
        define('DB_HOST', 'eris.evollia.com');
	define('WP_SITEURL', 'http://qn.appyk.fr');
	define('WP_HOME', 'http://qn.appyk.fr');
	define('WP_DEBUG', false); 
        //Apps Twitter
        define('oauth_access_token',"421936727-GRdijS26xhEkqczDWeFSvHacHLThOju15jxX2N8d");
        define('oauth_access_token_secret',"PScrCDTDLjKVrjUJIZ4NjlelKisjNyAYwVk40TjpADH8W");
        define('consumer_key',"5T1S4slgI6sDOmItbHsBrnlnG");
        define('consumer_secret',"0xz8sAWVfphJ9GnSIVf50GUj6xaDF5gycfovfn7zwOpMZri4UZ");
         
} else {
	define('DB_NAME', 'webaqueb_qcnum_2015_production');
	define('DB_USER', 'webaqueb_qcnum');
	define('DB_PASSWORD', 'Inkfwn7MdWSL');
	define('DB_HOST', 'localhost');
	define('WP_SITEURL', 'http://www.quebecnumerique.com');
	define('WP_HOME', 'http://www.quebecnumerique.com');
  define('WP_DEBUG', false); 
        //Apps Twitter
        define('oauth_access_token',"30934002-Z4rfoVNZjpnT33vMO3AaJNopQJqqQz9irxd58Lopl");
        define('oauth_access_token_secret',"zedYzsR75jaVyoNEJlz4ygWXBvstRILGFuYj59tdZzhQT");
        define('consumer_key',"YB2FxzPteMURUPKkMIjr11b5d");
        define('consumer_secret',"wX7Ty1QlheU9zUSZCp9fq1iaqMoDmWPjkuyNCbJfBPjDgq9WTR");
        //Apps Twitter
        //define('oauth_access_token',"421936727-GRdijS26xhEkqczDWeFSvHacHLThOju15jxX2N8d");
        //define('oauth_access_token_secret',"PScrCDTDLjKVrjUJIZ4NjlelKisjNyAYwVk40TjpADH8W");
        //define('consumer_key',"5T1S4slgI6sDOmItbHsBrnlnG");
        //define('consumer_secret',"0xz8sAWVfphJ9GnSIVf50GUj6xaDF5gycfovfn7zwOpMZri4UZ");
}

define('DB_CHARSET', 'utf8');
define('DB_COLLATE', '');

/**#@+
 * Clefs uniques d'authentification et salage.
 *
 * Remplacez les valeurs par défaut par des phrases uniques !
 * Vous pouvez générer des phrases aléatoires en utilisant 
 * {@link https://api.wordpress.org/secret-key/1.1/salt/ le service de clefs secrètes de WordPress.org}.
 * Vous pouvez modifier ces phrases à n'importe quel moment, afin d'invalider tous les cookies existants.
 * Cela forcera également tous les utilisateurs à se reconnecter.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         '[%6VIX!W=h<wKVyp2oIa<j/9V|(NDb_bC4O74;&H8p+Sdx2g*uZMpVRj7mOu.8fY');
define('SECURE_AUTH_KEY',  'AA}*nhbR-ly3kjy(n;CS8Z,VbJm8r8rd=VO?y1_cDcDS>]NI$/NB@U-{`-]e7 xX');
define('LOGGED_IN_KEY',    'VCmkG1{-91d{uv9&;tyFBHA|6w40I/J+&~mX|tL&kw&#KDGcr#Ufnj);PwYeLSpt');
define('NONCE_KEY',        '3%h-N4zM}nXVUBwsev^ 7Fv0f.v8qpcx6H7*2|MYwrwn^N(:ic1bu/n~a>9(52Z5');
define('AUTH_SALT',        'Co<6&tIIFm7Rx-k=]J+2Da@]_1U4/xAT@W/NAfnz(urxZxYP^l!AmQk)f6^T^JMK');
define('SECURE_AUTH_SALT', '-3c6vx#gp8jonl~xAVpAHcr]w)O-UTp.KdNIxMFQkkyjA8b ~QyG(.S3u^P~7qyN');
define('LOGGED_IN_SALT',   'K/M VpDj,>D4>zU2AFp:?j2}B+}?Wx|((bcq|eVs_Cy*@HmR-,v$j7I`RQEymj.6');
define('NONCE_SALT',       'h1{|ie|LA**<,Kx@M9n|*YllHk>8!I-xJvk[sU5G!vEpv=?BI|gOmKh] n]t_gpS');
/**#@-*/

/**
 * Préfixe de base de données pour les tables de WordPress.
 *
 * Vous pouvez installer plusieurs WordPress sur une seule base de données
 * si vous leur donnez chacune un préfixe unique. 
 * N'utilisez que des chiffres, des lettres non-accentuées, et des caractères soulignés!
 */
$table_prefix  = 'wp_';

/** 
 * Pour les développeurs : le mode deboguage de WordPress.
 * 
 * En passant la valeur suivante à "true", vous activez l'affichage des
 * notifications d'erreurs pendant votre essais.
 * Il est fortemment recommandé que les développeurs d'extensions et
 * de thèmes se servent de WP_DEBUG dans leur environnement de 
 * développement.
 */ 
define('WP_DEBUG', true); 

/* C'est tout, ne touchez pas à ce qui suit ! Bon blogging ! */

/** Chemin absolu vers le dossier de WordPress. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Réglage des variables de WordPress et de ses fichiers inclus. */
require_once(ABSPATH . 'wp-settings.php');