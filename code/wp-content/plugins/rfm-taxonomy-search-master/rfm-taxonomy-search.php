<?php
/*
Plugin Name: RFM Taxonomy Search
Plugin URI: http://www.rfmeier.net/projects/rfm-taxonomy-search/
Description: Include taxonomy names within your search.
Version: 0.0.2
Author: Ryan Meier
Author URI: http://www.rfmeier.net/
Author Email: rfmeier@gmail.com 
Network: false
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Copyright 2014 Ryan Meier (rfmeier@gmail.com)

This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License, version 2, as 
published by the Free Software Foundation.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

/**
 * RFM_Taxonomy_Search Class
 * 
 * @package RFM TaxonomySearch
 * @author Ryan Meier <rfmeier@gmail.com>
 */
class RFM_Taxonomy_Search
{
    /**
     * Static instance variable.
     *
     * Store the class's instance to maintain a singleton.
     * 
     * @var object
     */
    protected static $instance = null;

    /**
     * Constructor
     *
     * @uses apply_filters()
     * @link http://codex.wordpress.org/Class_Reference/WP_Query#Filters
     */
    function __construct()
    {
        if( is_admin() )
            return;

        add_filter( 'posts_join', array( $this, 'posts_join' ), 10, 2 );
        add_filter( 'posts_where', array( $this, 'posts_where' ), 10, 2 );
        add_filter( 'posts_groupby', array( $this, 'posts_groupby' ), 10, 2 );
    }

    /**
     * Get a current instance of the object if it exists.  If an instance of 
     * the current object does not exist, create one.
     * 
     * @since  0.0.1
     * @author Ryan Meier <rfmeier@gmail.com>
     * 
     * @return RFM_Taxonomy_Search The current object instance.
     */
    public static function get_instance()
    {
        if ( null === self::$instance )
            self::$instance = new self;

        return self::$instance;
    }

    /**
     * Callback for WordPress 'posts_join' filter.
     * 
     * Alter the SQL join clause if within main query and 
     * doing a search.
     * 
     * @since 0.0.1
     * @author Ryan Meier <rfmeier@gmail.com>
     *
     * @link http://codex.wordpress.org/Plugin_API/Filter_Reference/posts_join
     * 
     * @global object   $wpdb   Reference to the WordPress database instance
     * @param string    $join   The current JOIN within the SQL clause
     * @param object    $query  The current WP_Query object
     * @return string   $join   The possibly modified JOIN within the SQL clause
     */
    public function posts_join( $join, $query )
    {
        global $wpdb;

        if( is_main_query() && is_search() )
        {
            $join .= "
                LEFT JOIN 
                ( 
                    {$wpdb->term_relationships}
                    INNER JOIN 
                        {$wpdb->term_taxonomy} ON {$wpdb->term_taxonomy}.term_taxonomy_id = {$wpdb->term_relationships}.term_taxonomy_id 
                    INNER JOIN 
                        {$wpdb->terms} ON {$wpdb->terms}.term_id = {$wpdb->term_taxonomy}.term_id 
                ) 
                ON {$wpdb->posts}.ID = {$wpdb->term_relationships}.object_id ";

            $join = apply_filters( 'rfmts_join', $join, $query );
        }

        return $join;
    }

    /**
     * Callback for WordPress 'posts_where' filter.
     * 
     * Alter the where clause for the current search to include 
     * category or post_tag taxonomy names
     * 
     * @since 0.0.1
     * @author Ryan Meier <rfmeier@gmail.com>
     *
     * @link http://codex.wordpress.org/Plugin_API/Filter_Reference/posts_where
     * 
     * @global object   $wpdb   Reference to the WordPress database instance
     * @param string    $where  The current WHERE within the SQL clause
     * @param object    $query  The current WP_Query object
     * @return string   $where  The possibly modified WHERE within the SQL clause
     */
    public function posts_where( $where, $query )
    {
        global $wpdb;

        if( is_main_query() && is_search() )
        {
            //$user_where = $this->get_user_posts_where();
            $user_where = '';

            $where .= " OR (
                            {$wpdb->term_taxonomy}.taxonomy IN( 'category', 'post_tag', 'mots-cles', 'secteurs', 'quartier' ) 
                            AND
                            {$wpdb->terms}.name LIKE '%" . esc_sql( get_query_var( 's' ) ) . "%'
                            {$user_where}
                        )";

            $where = apply_filters( 'rfmts_where', $where, $query );
        }

        return $where;
    }

    /**
     * Callback for WordPress 'posts_groupby' filter.
     * 
     * Append a groupby clause to the current SQL clause for the search.
     * 
     * @since 0.0.1
     * @author Ryan Meier <rfmeier@gmail.com>
     *
     * @link http://codex.wordpress.org/Plugin_API/Filter_Reference/posts_groupby
     * 
     * @global object   $wpdb       Reference to the WordPress database instance
     * @param string    $groupby    The current GROUPBY within the SQL clause
     * @param object    $query      The current WP_Query object
     * @return string   $groupby    The possibly modified GROUPBY within the SQL clause
     */
    public function posts_groupby( $groupby, $query )
    {
        global $wpdb;

        if( is_main_query() && is_search() )
        {
            $groupby = "{$wpdb->posts}.ID";

            $groupby = apply_filters( 'rfmts_groupby', $groupby, $query );
        }

        return $groupby;
    }

    /**
     * Generate a SQL part for a where clause depending if a user is logged in or not.
     *
     * If a user is not logged in, the search post status will just be 'publish'.  If a user 
     * is logged in, the post status 'publish' will be appended along with the user's ID for 
     * the post status.
     *
     * @since  0.0.2
     * @author Ryan Meier <rfmeier@gmail.com>
     *
     * @uses   wp_get_current_user
     * @link   http://codex.wordpress.org/Function_Reference/wp_get_current_user
     * 
     * @global $wpdb
     * 
     * @return string The generated sql for restricting posts in a search.
     */
    protected function get_user_posts_where()
    {
        global $wpdb;

        $user   = wp_get_current_user();
        $sql    = '';
        $status = array( "'publish'" );

        if( ! empty( $user->ID ) )
        {
            $status[] = "'private'";
            
            $sql .= " AND {$wpdb->posts}.post_author = " . esc_sql( $user->ID );
        }

        $sql .= " AND {$wpdb->posts}.post_status IN( " . implode( ',', $status ) . " )";

        /**
         * Filter 'rfmts_get_user_posts_where'.
         *
         * @param string $sql The user sql to constrict posts for a user during a search.
         */
        return apply_filters( 'rfmts_get_user_posts_where', $sql );
    }

}

RFM_Taxonomy_Search::get_instance();
