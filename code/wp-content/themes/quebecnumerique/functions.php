<?php
/*
 * Functions for the site
 */

define("THEME_NAME", 'Québec Numérique');

//include_once('inc/advanced-custom-fields/acf.php');
//include_once('inc/acf-repeater/acf-repeater.php');
//include_once('inc/acf-options-page/acf-options-page.php');
//include_once('inc/post-expiring/post-expiring.php');


add_action( 'init', 'init' );
function init() {
	register_nav_menus( array( 'navigation' => 'Navigation' ) );
    register_nav_menus( array( 'meta' => 'Meta' ) );
	add_theme_support( 'post-thumbnails' );
	add_image_size('rectangle', 700, 500, true );
    add_image_size('rectangle-nocrop', 700, 500 );
    add_image_size('thumb-nocrop', 200, 200, false );
    add_image_size('profil', 400, 400, true );

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
            'show_admin_column' => true,
        )
    );


    register_taxonomy(
        'quartiers',
        array('projets', 'evenements', 'organisations', 'post'),
        array(
            'label' => __( 'Quartiers' ),
            'public' => true,
            'hierarchical' => true,
            'show_admin_column' => true
        )
    );

     register_taxonomy(
        'secteurs',
        array('organisations'),
        array(
            'label' => __( 'Secteurs' ),
            'public' => true,
            'hierarchical' => true,
            'show_admin_column' => true,
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

     p2p_register_connection_type( array(
        'name' => 'organisations-to-organisations',
        'from' => 'organisations',
        'to' => 'organisations',
        'admin_column' => 'any',
        'reciprocal' => true
    ) );

    p2p_register_connection_type( array(
        'name' => 'evenements-to-evenements',
        'from' => 'evenements',
        'to' => 'evenements',
        'admin_column' => 'any',
        'reciprocal' => true
    ) );


}
add_action( 'p2p_init', 'my_connection_types' );


if( function_exists('acf_add_options_sub_page') ) {
    acf_add_options_sub_page(array( 'title' => 'Options' ));
    acf_add_options_sub_page(array( 'title' => 'Accueil' ));
    acf_add_options_sub_page(array( 'title' => 'Pied de page' ));
    acf_add_options_sub_page(array( 'title' => 'Réseaux sociaux' ));
    acf_add_options_sub_page(array( 'title' => 'Images par défaut' ));

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
    $youtube = get_field('youtube', 'options');
    ?>

   <div class="rs">

        <?php if($tw) : ?>
            <a title="Twitter" href="<?php echo $tw; ?>"><i class="fa fa-twitter"></i></a>
        <?php endif; ?>
            
        <?php if($fb) : ?>
            <a title="Facebook" href="<?php echo $fb; ?>"><i class="fa fa-facebook"></i></a>
        <?php endif; ?>

        <?php if($gp) : ?>
            <a title="Google Plus" href="<?php echo $gp; ?>"><i class="fa fa-google-plus"></i></a>
        <?php endif; ?>

        <?php if($li) : ?>
            <a title="Linkedin" href="<?php echo $li; ?>"><i class="fa fa-linkedin"></i></a>
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

        <?php if($youtube) : ?>
            <a title="Youtube" href="<?php echo $youtube; ?>"><i class="fa fa-youtube-play"></i></a>
        <?php endif; ?>

         <?php if($github) : ?>
            <a title="Github" href="<?php echo $github; ?>"><i class="fa fa-github-alt"></i></a>
        <?php endif; ?>

    </div>

<?php }

function paging_nav() {
    global $wp_query;
    $big = 999999999;
    echo '<div class="pagination"><div>';
    echo paginate_links( array(
        'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
        'format' => '?paged=%#%',
        'current' => max( 1, get_query_var('paged') ),
        'total' => $wp_query->max_num_pages,
        'prev_text'    => __(''),
        'next_text'    => __('')
    ) );
    echo '</div></div>';
}


function wpa57065_filter_where( $where = '' ) {
    $where .= " AND post_date <= '" . date('Y-m-d') . "'";
    return $where;
}


function partition(Array $list, $p) {
    $listlen = count($list);
    $partlen = floor($listlen / $p);
    $partrem = $listlen % $p;
    $partition = array();
    $mark = 0;
    for($px = 0; $px < $p; $px ++) {
        $incr = ($px < $partrem) ? $partlen + 1 : $partlen;
        $partition[$px] = array_slice($list, $mark, $incr);
        $mark += $incr;
    }
    return $partition;
}

function get_sharing($post_id) { ?>
    <div class="sharing fr">
        <a href="#" class="sharer" title="Sharing"><i class="fa fa-share-alt"></i></a>
        <div>
            <?php 
            $urlimg = wp_get_attachment_url( get_post_thumbnail_id($post_id) ); 
            $title = $post_id; $title = urlencode($title);
            $desc = get_the_excerpt(); $desc = urlencode($desc);
            $source = get_bloginfo('name'); $source = urlencode($source);
            ?>

            <a target="_blank" href="http://www.facebook.com/sharer/sharer.php?u=<?php the_permalink(); ?>" class="fb" title="Facebook"><span>Facebook</span> <i class="fa fa-facebook"></i></a>
            <a target="_blank" href="https://twitter.com/intent/tweet?url=<?php the_permalink(); ?>&amp;text=<?php echo $title; ?>&amp;via=<?php echo $source; ?>" class="tw" title="Twitter"><span>Twitter</span> <i class="fa fa-twitter"></i></a>
            <a target="_blank" href="https://plus.google.com/share?url=<?php the_permalink(); ?>&amp;title=<?php echo $title; ?>" class="gp" title="Google+"><span>Google+</span> <i class="fa fa-google-plus"></i></a>
            <a target="_blank" href="https://www.linkedin.com/shareArticle?mini=true&amp;url=<?php the_permalink(); ?>&amp;title=<?php echo $title; ?>&amp;summary=<?php echo $desc; ?>&amp;source=<?php echo $source; ?>" class="li" title="Linkedin"><span>Linkedin</span> <i class="fa fa-linkedin"></i></a>
            <a target="_blank" href="https://pinterest.com/pin/create/button/?url=<?php the_permalink(); ?>&amp;media=<?php echo $urlimg; ?>&amp;description=<?php echo $desc; ?>" class="pin" title="Pinterest"><span>Pinterest</span> <i class="fa fa-pinterest-p"></i></a>
            <a href="mailto:?subject=<?php echo $title; ?>&amp;body=<?php echo $desc; ?>" class="email" title="Courriel"><span>Courriel</span> <i class="fa fa-envelope"></i></a>
            
        </div>
    </div>
<?php }

function posts_count( $wp_query = null ) {
    if ( ! $wp_query )
        global $wp_query;

    $posts = min( ( int ) $wp_query->get( 'posts_per_page' ), $wp_query->found_posts );
    $paged = max( ( int ) $wp_query->get( 'paged' ), 1 );
    $count = ( $paged - 1 ) * $posts;

    $output = $wp_query->found_posts . ' ';
    if($wp_query->found_posts > 1) :
        $output .= __('résultats', THEME_NAME);
    else :
        $output .= __('résultat', THEME_NAME);
    endif;
    echo $output;
}

function advanced_search_query($query) {
    $aSearch = array();
    if($query->is_search()) {
        if (isset($_GET['mots-cles']) && is_array($_GET['mots-cles'])) {

            $aMC = array(
                'taxonomy' => 'mots-cles',
                'field' => 'slug',
                'terms' => $_GET['mots-cles'],
                'operator' => 'IN'
            );
            array_push($aSearch, $aMC);
        }

        if (isset($_GET['quartiers']) && is_array($_GET['quartiers'])) {

            $aQ = array(
                'taxonomy' => 'quartiers',
                'field' => 'slug',
                'terms' => $_GET['quartiers'],
                'operator' => 'IN'
            );

            array_push($aSearch, $aQ);
        }

         if (isset($_GET['post_type']) && is_array($_GET['post_type'])) {
            $query->set( 'post_type', array($_GET['post_type']) );
        }

        $aSearch['relation'] = 'AND';
        $query->set( 'tax_query', $aSearch );
        return $query;
    }
}

add_action('pre_get_posts', 'advanced_search_query', 1000);

add_filter( 'wpseo_metabox_prio', function() { return 'low';});

function my_acf_save_post( $post_id ) {
    if ( get_post_type($post_id) != 'evenements' ) { return; }
    $debut = get_post_meta( $post_id, 'startdate' );
    $fin = get_post_meta( $post_id, 'enddate' );
    if( $fin[0] == "" ) { update_post_meta( $post_id, 'enddate', $debut[0] ); }

    //$hrsFin = get_post_meta( $post_id, 'hrs_fin' );
   // $realFin = $debut[0]+$hrsFin[0];
   // update_post_meta( $post_id, 'enddateH', $realFin );
}
// run after ACF saves the $_POST['acf'] data
add_action('acf/save_post', 'my_acf_save_post', 20);


add_action('get_footer','lm_dequeue_footer_styles');
function lm_dequeue_footer_styles() { wp_dequeue_style('yarppRelatedCss'); }
add_action('wp_print_styles','lm_dequeue_header_styles');
function lm_dequeue_header_styles() { wp_dequeue_style('yarppWidgetCss'); }

add_filter('wpseo_locale', 'override_og_locale');
function override_og_locale($locale) {
    return "fr_CA";
}

if (!function_exists('unregister_taxonomy')) {
    function unregister_taxonomy(){
        register_taxonomy('post_tag', array());
    }
}
add_action('init', 'unregister_taxonomy');

function remove_menus(){
    remove_menu_page('edit-tags.php?taxonomy=post_tag'); // Post tags
}

add_action( 'admin_menu', 'remove_menus' );


function mfields_set_default_object_terms( $post_id, $post ) {
    if ( 'publish' === $post->post_status ) {
        $defaults = array(
            'secteurs' => array( 'autres' ),
        );
        $taxonomies = get_object_taxonomies( $post->post_type );
        foreach ( (array) $taxonomies as $taxonomy ) {
            $terms = wp_get_post_terms( $post_id, $taxonomy );
            if ( empty( $terms ) && array_key_exists( $taxonomy, $defaults ) ) {
                wp_set_object_terms( $post_id, $defaults[$taxonomy], $taxonomy );
            }
        }
    }
}
add_action( 'save_post', 'mfields_set_default_object_terms', 100, 2 );
