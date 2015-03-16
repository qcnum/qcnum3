=== Ajax Load More ===
Contributors: dcooney
Donate link: http://connekthq.com/donate/
Tags: ajax, query, loop, paging, filter, infinite scroll, infinite, dynamic, jquery, shortcode builder, shortcode, search, tags, category, post types, taxonomy, meta_query, post format, wmpl, archives, date
Requires at least: 3.6
Tested up to: 4.1.1
Stable tag: 2.6.0
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

A simple solution for lazy loading your WordPress posts and pages with Ajax.

== Description ==

Ajax Load More is a simple yet powerful solution for lazy loading WordPress posts and pages with Ajax.
Build complex WordPress queries using our shortcode builder then add the shortcode to your pages via the content editor or directly into your template files.
 

= Features =

* **Multiple Instances** - One, two, three or ten - you can now include multiple instances of Ajax Load More on a single page.
* **Shortcode Builder** - Easily create your own Ajax Load More shortcode by adjusting the various WordPress query parameters in our easy-to-use shortcode builder.(see Shortcode Parameters).
* **Query Parameters** - Ajax Load More allows you to query WordPress by many different content types. Query by Post Type, Post Format, Date, Category, Tags, Custom Taxonomies, Search Term, Authors and more!!
* **Customizable Repeater Templates** - Edit and extend the functionality of Ajax Load More by creating your own repeater template to match the look and feel of your website (see screenshots).
* **Setting Panel** - Customize your version of Ajax Load More by updating various plugin settings (see screenshots).

Check out the **[demo site](http://connekthq.com/plugins/ajax-load-more/)** for more information!

***

= Shortcode Parameters =

Ajax Load More accepts a number of parameters that are passed to the WordPress query. These parameters are transferred via shortcode - don't worry, creating your shortcode is simple with our intuitive Shortcode Builder.
 
*   **repeater** - Choose a repeater template (<a href="http://connekthq.com/plugins/ajax-load-more/custom-repeaters/">Add-on available</a>). Default = ‘default’
*   **post_type** - Comma separated list of post types. Default = ‘post’
*   **post_format** - Query by post format. Default = null
*   **category** - A comma separated list of categories to include by slug. Default = null
*   **category__not_in** - A comma separated list of categories to exclude by ID. Default = null
*   **tag** - A comma separated list of tags to include by slug. Default = null
*   **tag__not_in** - A comma separated list of tags to exclude by ID. Default = null
*   **taxonomy** - Query by custom taxonomy name. Default = null
*   **taxonomy_terms** - Comma separated list of custom taxonomy terms(slug). Default = null
*   **taxonomy_operator** - Operator to compare Taxonomy Terms against (IN/NOT IN). Default = ‘IN’
*   **day** - Day of the week. Default = null
*   **month** - Month of the year. Default = null
*   **year** - Year of post. Default = null
*   **taxonomy_operator** - Operator to compare Taxonomy Terms against (IN/NOT IN). Default = ‘IN’
*   **meta_key** - Custom field key(name). Default = null
*   **meta_value** - Custom field value. Default = null
*   **meta_compare** - Operator to compare meta_key and meta_value against (IN/NOT IN/=/!=/>/>=/</<= etc.). Default = ‘IN’
*   **author** - Query by author id. Default = null
*   **search** - Query search term (‘s’). Default = null
*   **order** - Display posts in ASC(ascending) or DESC(descending) order. Default = ‘DESC’
*   **orderby** - Order posts by date, title, name, menu order, random, author, post ID or comment count.  Default = ‘date’
*   **exclude** - Comma separated list of post ID’s to exclude from query. Default = null 
*   **offset** - Offset the initial query (number). Default = ’0′
*   **posts_per_page** - Number of posts to load with each Ajax request. Default = ’5′
*   **scroll** - Load more posts as the user scrolls the page (true/false). Default = ‘true’
*   **scroll_distance** - The distance from the bottom of the screen to trigger the loading of posts while scrolling. Default = '150'
*   **max_pages** - Maximum number of pages to load while user is scrolling (activated on when scroll = true). Default = '5' 
*   **pause** - Do not load posts until user clicks the Load More button (true/false). Default = 'false'
*   **transition** - Choose a posts reveal transition (slide/fade/none). Default = 'slide' 
*   **destroy_after** - Remove ajax load more functionality after 'n' number of pages have been loaded. Default = null
*   **button_label** - The label text for Load More button. Default = 'Older Posts'
*   **cache** - Turn on content caching for the specific Ajax Load More query. <a href="http://connekthq.com/plugins/ajax-load-more/cache/">add-on only</a> - (true/false). Default = ‘false’
*   **cache_id** - A unique 10 digit ID for the cached query. <a href="http://connekthq.com/plugins/ajax-load-more/cache/">add-on only</a> - Default = A random 10 digit integer
*   **seo** - Enable address bar URL rewrites as users page through content - <a href="http://connekthq.com/plugins/ajax-load-more/search-engine-optimization/">add-on only</a> (true/false). Default = ‘false’
*   **preloaded** - Should Ajax Load More preload posts? <a href="http://connekthq.com/plugins/ajax-load-more/preloaded/">add-on only</a> - (true/false). Default = ‘false’
*   **preloaded_amount** - The amount of posts to preload. <a href="http://connekthq.com/plugins/ajax-load-more/preloaded/">add-on only</a> - Default = ‘5’


***

= Example Shortcode =

    [ajax_load_more post_type="post, portfolio" repeater="default" posts_per_page="5" transition="fade" button_label="Older Posts"]

***

= Demos =
* **[Default](http://connekthq.com/plugins/ajax-load-more/)** - Out of the box functionality and styling
* **[Destroy After](http://connekthq.com/plugins/ajax-load-more/examples/destroy-after/)** - Remove Ajax Load More functionality after 'n' number of pages
* **[Fade Transition](http://connekthq.com/plugins/ajax-load-more/examples/fade-transition/)** - Elements fade in as posts are loaded
* **[Mansory](http://connekthq.com/plugins/ajax-load-more/examples/masonry/)** - Creating a flexible grid layout with Masonry JS
* **[Multiple Instances](http://connekthq.com/plugins/ajax-load-more/examples/multiple-instances/)** - Include multiple Ajax Load More' on a single page
* **[Pause Loading](http://connekthq.com/plugins/ajax-load-more/examples/pause-loading/)** - Posts will not load until initiated by the user
* **[Preloaded posts](http://connekthq.com/plugins/ajax-load-more/examples/pause-loading/)** - Easily preload an initial set of posts before completing any Ajax requests to the server
* **[Search Results](http://connekthq.com/plugins/ajax-load-more/examples/search-results/)** - Returning results based on search terms
* **[SEO Paging](http://connekthq.com/plugins/ajax-load-more/examples/seo-paging/)** - Generate unique paging URLs with each Ajax Load More query

*The [Custom Repeater Add-On](http://connekthq.com/plugins/ajax-load-more/custom-repeaters/) has been installed for use on each of our product demos*

[youtube https://www.youtube.com/watch?v=EQ57i6dkOew]

***    

= Add-ons =
 The following Add-ons are available to increase the functionality of Ajax Load More.

> #### Custom Repeaters
> The **[Custom Repeaters](http://connekthq.com/plugins/ajax-load-more/custom-repeaters)** add-on will allow for **unlimited repeater templates** and provide the ability to create unique templates for different content types throughout your theme.<br />
> [Get More Information](http://connekthq.com/plugins/ajax-load-more/custom-repeaters)
> 
> #### Cache
> The **[Cache](http://connekthq.com/plugins/ajax-load-more/cache)** creates static HTML files of Ajax Load More requests then serves those static pages to your visitors without querying the database.<br />
> [Get More Information](http://connekthq.com/plugins/ajax-load-more/cache)
> 
> #### Preloaded
> The **[Preloaded](http://connekthq.com/plugins/ajax-load-more/preloaded)** add-on will allow you to quickly and easily preload an initial set of posts before completing any Ajax requests to the server.<br />
> [Get More Information](http://connekthq.com/plugins/ajax-load-more/preloaded)
> 
> #### Search Engine Optimization
> The **[SEO](http://connekthq.com/plugins/ajax-load-more/seo/)** add-on will optimize your ajax loaded content for search engines and site visitors by generating standard WordPress paging URLs with each Ajax Load More query.<br />
> [Get More Information](http://connekthq.com/plugins/ajax-load-more/seo/)

***

= Callback Functions =
The following functions are avaialble to be dispatched by Ajax Load More. 


**Ajax Complete** - The almComplete() function is triggered after every *successful* ajax call made by Ajax Load More.
To utilize the almComplete() function simply place the following code inside your sites javascript file.

    $.fn.almComplete = function(alm){
    	// Your on complete code goes here
    }
    
**Ajax Empty** - The almEmpty() function is triggered if there are zero results returned in the initial query.
To utilize the almEmpty() function simply place the following code inside your sites javascript file.

    $.fn.almEmpty = function(alm){
       console.log('Sorry, but we could not locate any posts that matched your criteria.');
    }

***
    
= Variables =

Ajax Load More passes the following PHP variables to each repeater template - these template variables can help you style and transform your repeater templates.
 
*   **$alm_page** - Returns the current page number. 'echo $alm_page;'
*   **$alm_item** - Returns the current item number within your loop. 'echo $alm_item;'
*   **$alm_found_posts** - Returns the total number of posts found within the entire WordPress query. 'echo $alm_found_posts;'
    
***

= Tested Browsers =

* Firefox (Mac, PC)
* Chrome (Mac, PC, iOS, Android)
* Safari (Mac, iOS)
* IE8+
* Android (Native)
* BB10 (Native)

***

= Website =
http://connekthq.com/ajax-load-more/

***

= Please Rate Ajax Load More! =

Your ratings make a big difference! If you like and use Ajax Load More, please consider taking the time to [rate my plugin](http://wordpress.org/support/view/plugin-reviews/ajax-load-more). Your ratings and reviews will help this plugin grow and provide the motivation needed to keep pushing it forward.



== Frequently Asked Questions ==


= What are the steps to getting Ajax Load More to display on my website =

1. Create your shortcode
2. Add the shortcode to your page, by adding it through the content editor or placing it directly within one of your template files.
3. Load a page with your shortcode in place and watch Ajax Load More fetch your posts. 

= What are my server requirements? =

Your server must be able to read/write/create files. Ajax Load More creates the default repeater on plugin activation and in order to modify the output we are required to write to the file as well. 

= Is the ajax functionality secure? =

Yes, Ajax Load more uses admin-ajax and nonces in order to protect URLs and forms from being misused.

= Can I make modifications to the plugin code? =

Sure, but please be aware that if modifications are made it may affect future updates of the plugin.

= Can I modify the repeater template? =

Yes, visit the Repeater Template section in your WordPress admin.

= How are my repeater templates saved? =

Repeater template data is saved into your WordPress database as well as written directly to a repeater template .php file in the ajax-load-more plugin directory.

= Can I use custom fields in a repeater? =

Yes, but you will need to define $post at the top of the repeater before requesting your custom fields. Like so:
global $post;


== Installation ==

How to install Ajax Load More.

= Using The WordPress Dashboard =

1. Navigate to the 'Add New' in the plugins dashboard
2. Search for 'Ajax Load More'
3. Click 'Install Now'
4. Activate the plugin on the Plugin dashboard

= Uploading in WordPress Dashboard =

1. Navigate to the 'Add New' in the plugins dashboard
2. Navigate to the 'Upload' area
3. Select `ajax-load-more.zip` from your computer
4. Click 'Install Now'
5. Activate the plugin in the Plugin dashboard

= Using FTP =

1. Download `ajax-load-more.zip`
2. Extract the `ajax-load-more` directory to your computer
3. Upload the `ajax-load-more` directory to the `/wp-content/plugins/` directory
4. Activate the plugin in the Plugin dashboard


== Screenshots ==

1. Settings screen
2. Available Repeater Templates
3. Custom Repeaters Add-On
4. Shortcode Builder
5. Content Editor shortcode icon
6. Edit Page Shortcode Builder
7. Shortcode and implementation examples

== Changelog ==


= 2.6.0 =
* NEW - Adding scroll_distance parameter - easily adjust the distance from the bottom of the page that will trigger loading of posts.
* NEW - Adding required functionality for Caching Add-on.
* NEW - Adding new almEmpty function triggered if zero results were returned.
* FIX - Disabled in previous versions, Preloaded and SEO can now work together to produce SEO URLs.
* UPDATE - Performance updates, various UI improvements.


= 2.5.1 =
* FIX - Dynamic population of category, tag and author content within Shortcode Builder - now this actually works as requested and no database queries happen if this setting is true.
* FIX - Small issue with new destory_after parameter in core js.
* UPDATE - Updated language .pot file.
* UPDATE - Small admin interface tweaks.


= 2.5.0 =
* NEW - Adding query by multiple categories and tags.
* NEW - Adding required functionality for new Preloaded add-on - preload posts before any ajax queries kick in.
* NEW - Adding 'destroy_after' parameter to completely remove Ajax Load More functionality after 'n' number of pages.
* NEW - Adding setting to disable dynamic population of category, tag and author content within shortcode builder.
* NEW - Adding functionality to exclude categories('category__not_in').
* NEW - Adding functionality to exclude tags('tag__not_in').
* NEW - Adding option to copy repeater content and update templates from database directly on the Repeater Template settings page.
* NEW - Query by multiple meta query values e.g "cat, dog, fish".
* FIX - Issue with simultaneous query by category and custom taxonomy.
* Fix - Issue for SEO add-on when pause = "true". ALM will now set pause to false if page > 1 when using the SEO add-on.


= 2.4.0 =
* Adding date query parameters - users can now query by day, month and year.
* Admin UX improvements including sticky navigation in shortcode builder.
* Updated ALM examples page with date query and improved archive.php.
* Fixed PHP warning related to hiding Ajax Load More button in editor and Custom Repeaters v1.
* Added language support for Polylang and qTranslate plugins.


= 2.3.1 =
* Urgent fix for array_push error


= 2.3.0 =
* Adding required functionality for ALM SEO add-on (http://connekthq.com/plugins/ajax-load-more/seo/)
* Adding variables for counting items within the ALM query - $alm_page & $alm_item are now accessible within repeater templates.
* Remove plugin activation notification due to error fetching column names.
* Fixed issue with orderby = "rand", ALM now excludes all previously queried post ids.
* fixed JS error on ALM setting pages.
* Fixed issue with hiding TinyMCE button that was affecting other plugins.
* General plugin improvements and enhancements.


= 2.2.8 =
* Adding required functionality for the NEW Ajax Load More Custom Repeaters v2 add-on - http://connekthq.com/plugins/ajax-load-more/custom-repeaters/
* Improved debug messaging for Ajax Load More and Add-Ons.
* Adding fix for ordering by meta value.
* Admin stying updates.
* Updated FAQs
* Fix meta_query query and orderby meta value 


= 2.2.7 =
* Fix for query by Standard post format.
* Fix for Shortcode Builder where Custom Taxonomies were not building correctly.


= 2.2.6 =
* Bug fix for meta_query parameters.
* Further improvements to WordPress query arguments from 2.2.4.
* Update plugin .pot file.

= 2.2.5 =
* Urgent fix for category queries.

= 2.2.4 =
* Improving WordPress query arguments.
* Removing empty query parameters which were conflicting with various hooks and filters reported by ALM users.
* Updated admin notifications.
* Added plugin action links to plugin listing.

= 2.2.3 =
* Adding query by Custom Field value(Meta Query). 
* Improved error handling for easier debugging.
* Fixed issue with pause = "true" and scroll = "true". Pause should always take precendence over scroll. 
* Code clean up, improving overall quality for easier merges and updates.

= 2.2.2 =
* Adding callback function that is dispatched once a successful ajax call is made. $.fn.almComplete(alm). 
* Adding WPML support for ICL_LANGUAGE_CODE - A 'lang' atributed is added dynamically if WPML is installed.
* Making JS variables and functions publically accessible.

= 2.2.1 =
* Fixed php notice/warning that would trigger if WP_DEBUG was enabled. 
* Adding minified core JS.
* Adding global option to disable shortcode button in the content editor.
* Adding touchmove js event for faster scroll detection on mobile devices.
* Code clean up, removing unused functions.

= 2.2.0 =
* Adding Post Format query.
* Adding syntax highlighting for Repeater Templates with CodeMirror (http://codemirror.net/).
* Adding custom alias integration for Repeater Templates (Only for the custom repeater add-on).
* Adding button preview on settings page.
* Adding 'White' button style.
* Updated .pot language file.

= 2.1.3 =
* Fixed issue causing the Ajax Load More menu to not show on some admin screen do to location conflict with another plugin.
* Adding column 'alias' to wp_alm table to allow for repeater alias (Only for the custom repeater add-on). 
* Remove legacy column 'test' from wp_alm table.  
* Updating styles in admin.css. 

= 2.1.2 =
* Adding ability to have multiple instances of script on a single page
* Adding global class name('.ajax-load-more-wrap') to Ajax Load More container. I plan to remove the #ajax-load-more naming convention in upcoming releases, but need time for users to update their code.
* Small styling enhancements to admin panel.
* Updated .pot language file.

= 2.1.1 =
* Adding Order and Orderby query parameters, you can now set these values within the Shortcode Builder
* Updating core javascript code
* Fixed bug with taxonomy query selectors

= 2.1.0 =
* Adding custom taxonomy query - select from a list of custom taxonomies then select terms and operator
* Fixed path to repeater file in admin functions

= 2.0.15 =
* Fixed issue with loading of admin javascript and css on pages other than Ajax Load More

= 2.0.14 =
* Fixed issue with author query

= 2.0.13 =
* Fixed issue where loading button was not turning off when posts remaining were zero 

= 2.0.12 =
* Adding add_filter('widget_text', 'do_shortcode'); 

= 2.0.11 =
* Removed 2 filters for widget_text which were casuing issues in sidebars

= 2.0.10 =
* Updating default repeater template to include the_permalink()

= 2.0.9 =
* Fixing issue with duplicate column names in database.

= 2.0.8 =
* removed upgrader_process_complete as it was unreliable. Replaced with admin_init to check whether plugin has been updated.

= 2.0.7 =
* Fixed jQuery conflict javascript error

= 2.0.6 =
* Fixing issue with scrolling of posts

= 2.0.5 =
* Updating db table structure
* Adding upgrader_process_complete checker

= 2.0.4 =
* Adding plugin version to wpdb table.
* Removed legacy repeater code.

= 2.0.3 =
* Fixed issue with WP auto updates overriding the default repeater. Please deactivate and then activate your plugin.

= 2.0.2 =
* Fixed issue with tinymce conflict

= 2.0.1 =
* Ajax Load More

== Upgrade Notice ==

* None 


