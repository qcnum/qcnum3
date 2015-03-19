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
        define('oauth_access_token',"421936727-GRdijS26xhEkqczDWeFSvHacHLThOju15jxX2N8d");
        define('oauth_access_token_secret',"PScrCDTDLjKVrjUJIZ4NjlelKisjNyAYwVk40TjpADH8W");
        define('consumer_key',"5T1S4slgI6sDOmItbHsBrnlnG");
        define('consumer_secret',"0xz8sAWVfphJ9GnSIVf50GUj6xaDF5gycfovfn7zwOpMZri4UZ");
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
define('AUTH_KEY',         'QzVP{`>3(|`hu9~rm1ukmMFz|bdy7q7F-{TgAy#o-{L!Bc@i~OzSG[X]mok}QI>B');
define('SECURE_AUTH_KEY',  'm8#,uC5ki+3DdaW-YUvu -O0A8qCSrx5//A]VKM_-d&./LXVG%*c938+BtvITb6z');
define('LOGGED_IN_KEY',    'yJ,h`am|T>[x,$!U0La?qG|NP|3c*q(]VXL9=XyGs-k:-Ux<Z+&6#ElxF-0(qQD#');
define('NONCE_KEY',        'F{l|F4Kw`|DXCwiU_>|^u^4za7jgrjnaVj.QSOkM<+xB{IM`sd)]^sxT*F#}{C%y');
define('AUTH_SALT',        'ZEgq,71apfW4*K2]f^q5h2]PD4|Ok^=v4e0ALKb)E3Dzl>Pk@:Zm_KaqbVh8(WI#');
define('SECURE_AUTH_SALT', 'rd:EsV$Ukl`(<qH9grn]1t+/z()-+LYgX|X[R$F&VD$]O-T%mEV5E4=q7GO;^*+*');
define('LOGGED_IN_SALT',   'o,QZpV +uTKM-!x7wx|I5v4^`omgD@Oj8x{1Tc9LbC-Niw-Vh>Vkw@scP-3h=hfc');
define('NONCE_SALT',       '9q^0jD-LJ>-:pF|yL3h<Ktd6#Bo!T+Ph}xF){={YLY5]d+:,0Ow57jF<<hr>s--b');
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