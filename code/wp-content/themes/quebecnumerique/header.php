<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=device-width, maximum-scale=1.0, user-scalable=no" />
<title><?php wp_title( '|' ); ?></title>
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link href='http://fonts.googleapis.com/css?family=PT+Sans+Narrow:400,700|Exo+2:400,300,500|Titillium+Web:300' rel='stylesheet' type='text/css'>
<link rel="stylesheet" type="text/css" media="all" href="<?php echo get_template_directory_uri(); ?>/font-awesome.css" />
<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
<link rel="icon" href="favicon.ico" type="image/x-icon">
<!--[if lt IE 9]>
	<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js"></script>
<![endif]-->
<?php 
wp_enqueue_script('jquery');
wp_enqueue_script('script', get_template_directory_uri() . '/js/script.js', 'jquery', '', true);
wp_head(); 
?>
</head>

<body <?php body_class(); ?>>

<header id="masthead" role="banner">

	<div class="group">

		<a class="home-link" href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
			<h1 class="site-title visuallyhidden"><?php bloginfo( 'name' ); ?></h1>
		</a>

		<nav id="site-navigation" class="navigation group" role="navigation">

			<?php wp_nav_menu( array( 'theme_location' => 'meta', 'container' => '', 'menu_class' => 'meta' ) ); ?>
			<?php get_search_form(); ?>
			<?php wp_nav_menu( array( 'theme_location' => 'navigation', 'container' => '', 'menu_class' => 'principal' ) ); ?>

		</nav><!-- #site-navigation -->
		
	</div>

</header><!-- #masthead -->

<?php echo get_template_part('content', 'search'); ?>

<div id="page" class="wrapper">

	<div class="fancyHead group">
		<div class="site-description c12">
			<span><?php bloginfo( 'description' ); ?></span>
		</div>
		<div class="triangle">
			<div></div>
			<div></div>
			<div></div>
			<div></div>
			<div></div>
			<div></div>
			<div></div>
			<div></div>
			<div></div>
			<div></div>
		</div>
	</div>

	<div id="main">