<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=device-width, maximum-scale=1.0, user-scalable=no" />
<title><?php wp_title( '|' ); ?></title>
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link href='http://fonts.googleapis.com/css?family=PT+Sans+Narrow:400,700%7CPT+Sans:400,700%7CExo+2:400,300,500%7CTitillium+Web:300' rel='stylesheet' type='text/css'>

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

<script src="http://maps.googleapis.com/maps/api/js?v=3&amp;sensor=false"></script>
<script src="<?php echo get_template_directory_uri() . '/js/markerclusterer_packed.js';?>"></script>
<script src="<?php echo get_template_directory_uri() . '/js/map_qn.js';?>"></script>

</head>

<body <?php body_class(); ?>>

<header id="masthead" role="banner">

	<div class="group">

		<a class="home-link" href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
			<h1 class="site-title visuallyhidden"><?php bloginfo( 'name' ); ?></h1>
		</a>

		<span class="site-description"><?php bloginfo( 'description' ); ?></span>

		<nav id="site-navigation" class="navigation group" role="navigation">
			<?php wp_nav_menu( array( 'theme_location' => 'meta', 'container' => '', 'menu_class' => 'meta' ) ); ?>
			<?php get_search_form(); ?>
			<?php wp_nav_menu( array( 'theme_location' => 'navigation', 'container' => '', 'menu_class' => 'principal' ) ); ?>
			<ul class="principal menu-toggle">
				<li><a href="#">Menu</a></li>
			</ul>
		</nav><!-- #site-navigation -->
		
	</div>

</header><!-- #masthead -->



	<?php if ( is_category() || is_archive() || is_single() ) {
			$queried_object = get_queried_object();
			$id = $queried_object->cat_ID;	
			$name = $queried_object->name;
			if ($id == 2 || in_category(2)) {
			  	$class="nouvelles";
			  	$title=$name;
			} else if ($id == 3 || in_category(3)) {
				$class="articles";
				$title=$name;
			} else if ($name == 'organisations' || is_singular('organisations'))  {
				$class="organisations";
				$title = $queried_object->label;
			} else if ($name == 'projets' || is_singular('projets'))  {
				$class="projets";
				$title = $queried_object->label;
			} else if ($name == 'evenements' || is_singular('evenements'))  {
				$class="evenements";
				$title = $queried_object->label;
			}

			if(is_single()) { $class .= ' single-post'; }

			if(is_tax()) {
				$term = $wp_query->get_queried_object();
				$class="organisations";
				$title = $term->name;
			}

		} else {
			$class = "normal";
			$title = get_the_title();
		}
		?>

		<div class="page-header header-post-type <?php echo $class?>">

			<div class="large-wrapper">
				<div class="c12">
					<div class="padding">
						<h1 class="page-title"><?php echo $title ?></h1>
					</div>
				</div>

				<?php
				if ( function_exists('yoast_breadcrumb') && !is_front_page() && !is_archive() && !is_category( $category )) {
					yoast_breadcrumb('<div class="padding" id="breadcrumbs">','</div>');
				} ?>

			</div>
			
			<hr class="clear">

		</div>
		<?php 
	//};?>


	<div id="page" class="wrapper">

		<div id="main">
