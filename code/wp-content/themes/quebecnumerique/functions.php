<?php
/*
 * Functions for the site
 */

define("THEME_NAME", 'Québec Numérique');

include_once('inc/advanced-custom-fields/acf.php');
include_once('inc/acf-repeater/acf-repeater.php');
include_once('inc/acf-options-page/acf-options-page.php');


add_action( 'init', 'init' );
function init() {
	register_nav_menus( array( 'navigation' => 'Navigation' ) );
    register_nav_menus( array( 'meta' => 'Meta' ) );
	add_theme_support( 'post-thumbnails' );
	add_image_size('rectangle', 580, 440, true );

	register_sidebar( array(
		'name' => __( 'Main Sidebar', THEME_NAME ),
		'id' => 'sidebar-1',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => "</aside>",
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	$labelsEvent = array(
        'name' => _x('Événements', 'post type general name', THEME_NAME),
        'singular_name' => _x('Événement', 'post type singular name', THEME_NAME),
        'add_new' => _x('Ajouter un événement', 'evenements'),
        'add_new_item' => __('Ajouter un événement'),
        'edit_item' => __('Modifier l\'événement'),
        'new_item' => __('Nouvel événement'),
        'all_items' => __('Tous les événement'),
        'view_item' => __('Voir l\'événement'),
        'search_items' => __('Chercher un événement'),
        'not_found' =>  __('Aucun événement trouvé'),
        'not_found_in_trash' => __('Rien de trouvé dans la corbeille'),
        'parent_item_colon' => '',
        'menu_name' => 'Événements'
    );
    
    $argEvent = array(
        'labels' => $labelsEvent,
        'public' => true,
        'publicly_queryable' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'query_var' => true,
        'capability_type' => 'post',
        'has_archive' => true,
        'hierarchical' => true,
        'menu_position' => 20,
        'menu_icon' => 'dashicons-calendar-alt',
        'supports' => array('title', 'thumbnail', 'editor', 'revisions', 'page-attributes')
    );

    $labelsOrg = array(
        'name' => _x('Organisations', 'post type general name', THEME_NAME),
        'singular_name' => _x('Organisation', 'post type singular name', THEME_NAME),
        'add_new' => _x('Ajouter une organisation', 'organisations'),
        'add_new_item' => __('Ajouter une organisation'),
        'edit_item' => __('Modifier l\'organisation'),
        'new_item' => __('Nouvelle organisation'),
        'all_items' => __('Toutes les organisations'),
        'view_item' => __('Voir l\'organisation'),
        'search_items' => __('Chercher une organisation'),
        'not_found' =>  __('Aucune organisation trouvé'),
        'not_found_in_trash' => __('Rien de trouvé dans la corbeille'),
        'parent_item_colon' => '',
        'menu_name' => 'Organisations'
    );
    
    $argOrg = array(
        'labels' => $labelsOrg,
        'public' => true,
        'publicly_queryable' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'query_var' => true,
        'capability_type' => 'post',
        'has_archive' => true,
        'hierarchical' => true,
        'menu_position' => 20,
        'menu_icon' => 'dashicons-groups',
        'supports' => array('title', 'thumbnail', 'editor', 'revisions', 'page-attributes')
    );

    $labelsProjet = array(
        'name' => _x('Projets', 'post type general name', THEME_NAME),
        'singular_name' => _x('Projet', 'post type singular name', THEME_NAME),
        'add_new' => _x('Ajouter un projet', 'projets'),
        'add_new_item' => __('Ajouter un projet'),
        'edit_item' => __('Modifier le projet'),
        'new_item' => __('Nouveau projet'),
        'all_items' => __('Tous les projets'),
        'view_item' => __('Voir le projet'),
        'search_items' => __('Chercher un projet'),
        'not_found' =>  __('Aucun projet trouvé'),
        'not_found_in_trash' => __('Rien de trouvé dans la corbeille'),
        'parent_item_colon' => '',
        'menu_name' => 'Projets'
    );
    
    $argProjet = array(
        'labels' => $labelsProjet,
        'public' => true,
        'publicly_queryable' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'query_var' => true,
        'capability_type' => 'post',
        'has_archive' => true,
        'hierarchical' => true,
        'menu_position' => 20,
        'menu_icon' => 'dashicons-star-empty',
        'supports' => array('title', 'thumbnail', 'editor', 'revisions', 'page-attributes')
    );

    register_post_type('projets', $argProjet);
    register_post_type('evenements', $argEvent);
    register_post_type('organisations', $argOrg);

    register_taxonomy(
        'mots-cles',
        array('projets', 'evenements', 'organisations', 'post'),
        array(
            'label' => __( 'Mots-clés' ),
            'public' => true,
            'hierarchical' => true,
        )
    );


    register_taxonomy(
        'quartier',
        array('projets', 'evenements', 'organisations', 'post'),
        array(
            'label' => __( 'Quartiers' ),
            'public' => true,
            'hierarchical' => true,
        )
    );

}

function my_connection_types() {

    p2p_register_connection_type( array(
        'name' => 'projets-to-post',
        'from' => 'projets',
        'to' => 'post',
        'admin_column' => 'any'
    ) );

    p2p_register_connection_type( array(
        'name' => 'projets-to-evenements',
        'from' => 'projets',
        'to' => 'evenements',
        'admin_column' => 'any'
    ) );

    p2p_register_connection_type( array(
        'name' => 'evenements-to-post',
        'from' => 'evenements',
        'to' => 'post',
        'admin_column' => 'any'
    ) );

    p2p_register_connection_type( array(
        'name' => 'organisations-to-post',
        'from' => 'organisations',
        'to' => 'post',
        'admin_column' => 'any'
    ) );

    p2p_register_connection_type( array(
        'name' => 'organisations-to-evenements',
        'from' => 'organisations',
        'to' => 'evenements',
        'admin_column' => 'any'
    ) );

    p2p_register_connection_type( array(
        'name' => 'organisations-to-projets',
        'from' => 'organisations',
        'to' => 'projets',
        'admin_column' => 'any'
    ) );


}
add_action( 'p2p_init', 'my_connection_types' );


if( function_exists('acf_add_options_sub_page') ) {
    acf_add_options_sub_page(array( 'title' => 'Options' ));
    acf_add_options_sub_page(array( 'title' => 'Pied de page' ));
    acf_add_options_sub_page(array( 'title' => 'Réseaux sociaux' ));
}

function get_social_media() {
    $fb = get_field('facebook', 'options');
    $gp = get_field('google_plus', 'options');
    $li = get_field('linkedin', 'options');
    $tw = get_field('twitter', 'options'); 
    $pt = get_field('pinterest', 'options');
    $tumb = get_field('tumblr', 'options');
    $dribble = get_field('dribbble', 'options');
    $stumbleupon = get_field('stumbleupon', 'options');
    $flickr = get_field('flickr', 'options');
    $spotify = get_field('spotify', 'options');
    $instagram = get_field('instagram', 'options');
    $skype = get_field('skype', 'options');
    $vimeo = get_field('vimeo', 'options');
    $github = get_field('github', 'options');
    ?>

   <div class="rs">

        <div class="c6">
            
                <?php if($fb) : ?>
                    <a title="Facebook" href="<?php echo $fb; ?>"><i class="fa fa-facebook"></i></a>
                <?php endif; ?>

                <?php if($gp) : ?>
                    <a title="Google Plus" href="<?php echo $gp; ?>"><i class="fa fa-google-plus"></i></a>
                <?php endif; ?>

                <?php if($li) : ?>
                    <a title="Linkedin" href="<?php echo $li; ?>"><i class="fa fa-linkedin"></i></a>
                <?php endif; ?>

                <?php if($tw) : ?>
                    <a title="Twitter" href="<?php echo $tw; ?>"><i class="fa fa-twitter"></i></a>
                <?php endif; ?>

                <?php if($pt) : ?>
                    <a title="Pinterest" href="<?php echo $pt; ?>"><i class="fa fa-pinterest"></i></a>
                <?php endif; ?>

                <?php if($tumb) : ?>
                    <a title="Tumblr" href="<?php echo $tumb; ?>"><i class="fa fa-tumblr"></i></a>
                <?php endif; ?>

                <?php if($dribble) : ?>
                    <a title="Dribbble" href="<?php echo $dribble; ?>"><i class="fa fa-dribbble"></i></a>
                <?php endif; ?>

                <?php if($stumbleupon) : ?>
                    <a title="Stumble Upn" href="<?php echo $stumbleupon; ?>"><i class="fa fa-stumbleupon"></i></a>
                <?php endif; ?>

                <?php if($flickr) : ?>
                    <a title="Flickr" href="<?php echo $flickr; ?>"><i class="fa fa-flickr"></i></a>
                <?php endif; ?>

                <?php if($spotify) : ?>
                    <a title="Spotify" href="<?php echo $spotify; ?>"><i class="fa fa-spotify"></i></a>
                <?php endif; ?>

                <?php if($instagram) : ?>
                    <a title="Instagram" href="<?php echo $instagram; ?>"><i class="fa fa-instagram"></i></a>
                <?php endif; ?>

                <?php if($skype) : ?>
                    <a title="Skype" href="<?php echo $skype; ?>"><i class="fa fa-skype"></i></a>
                <?php endif; ?>

                 <?php if($vimeo) : ?>
                    <a title="Vimeo" href="<?php echo $vimeo; ?>"><i class="fa fa-vimeo-square"></i></a>
                <?php endif; ?>

                 <?php if($github) : ?>
                    <a title="Github" href="<?php echo $github; ?>"><i class="fa fa-github-alt"></i></a>
                <?php endif; ?>

            </div>

        </div>

<?php }

function paging_nav() {
    global $wp_query;
    $big = 999999999;

    echo '<div class="pagination">';

    echo paginate_links( array(
        'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
        'format' => '?paged=%#%',
        'current' => max( 1, get_query_var('paged') ),
        'total' => $wp_query->max_num_pages
    ) );

    echo '</div>';
}


