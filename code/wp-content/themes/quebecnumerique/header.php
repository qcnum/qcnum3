<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=device-width, maximum-scale=1.0, user-scalable=no" />
<title><?php wp_title( '|' ); ?></title>
<link rel="profile" href="http://gmpg.org/xfn/11" />
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

<div class="wrapper">

	<header id="masthead" role="banner">

		<div class="group">

			<div class="c5">

				<a class="home-link" href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
					<h1 class="site-title"><?php bloginfo( 'name' ); ?></h1>
					<span class="site-description"><?php bloginfo( 'description' ); ?></span>
				</a>

				<?php wp_nav_menu( array( 'theme_location' => 'meta', 'container' => '' ) ); ?>

			</div>

			<nav id="site-navigation" class="navigation c7" role="navigation">

				<?php wp_nav_menu( array( 'theme_location' => 'navigation', 'container' => '' ) ); ?>
				
			</nav><!-- #site-navigation -->
			
		</div>

	</header><!-- #masthead -->

	<div id="main">