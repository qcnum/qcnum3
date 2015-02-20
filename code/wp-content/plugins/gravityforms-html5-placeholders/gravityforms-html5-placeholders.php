<?php
/*
Plugin Name: Gravity Forms HTML5 Placeholders
Plugin URI: http://www.isoftware.gr/wordpress/plugins/gravityforms-html5-placeholders
Description: Adds native HTML5 placeholder support to Gravity Forms' fields with javascript fallback. Javascript & jQuery are required.
Version: 2.7.4
Author: iSoftware
Author URI: http://www.isoftware.gr

------------------------------------------------------------------------
Copyright 2014 iSoftware Greece.

This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation; either version 2 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA 02111-1307 USA
*/

if (!class_exists('GFHtml5Placeholders')):

class GFHtml5Placeholders
{
    protected $_version = "2.7.4";
    protected $_min_gravityforms_version = "1.7";
    protected $_max_gravityforms_version = "1.9";
    protected $_min_wordpress_version    = '3.5';
    protected $_slug = "html5_placeholders";
    protected $_full_path = __FILE__;
    protected $_title = "Gravity Forms HTML5 Placeholders";
    protected $_short_title = "HTML5 Placeholders";
    protected $_debug = false;

    // define strings
    private $_strings = array();

    // plugin warnings
    protected $warnings = array();

    /**
     * Class constructor which hooks the instance into the WordPress init action
     */
    public function __construct()
    {
        add_action('init', array($this, 'init'));
        $this->pre_init();
    }

    //--------------  Initialization functions  ---------------------------------------------------

    /**
     * Add tasks or filters here that you want to perform during the class constructor - before WordPress has been completely initialized
     */
    private function pre_init()
    {
        // initialize our strings
        $this->_strings = (object) array(

            // plugin warnings
            'warnings' => array(

                'wordpress_version' => sprintf(
                    __( 'Gravity Forms HTML5 Placeholders require WordPress %s or greater. You must upgrade WordPress in order to use Gravity Forms HTML5 Placeholders', 'gf-html5-placeholders' ),
                    $this->_min_wordpress_version
                ),

                'gf_missing' => sprintf(
                    __( 'Gravity Forms HTML5 Placeholders is enabled but not effective. It requires %s in order to work.', 'gf-html5-placeholders' ),
                    sprintf( '<a target="_blank" href="%s">%s</a>', 'http://www.gravityforms.com/', 'Gravity Forms' )
                ),

                'gf_version'  =>  sprintf(
                    __( 'Gravity Forms HTML5 Placeholders is enabled but not effective. It requires %s version <strong>%s</strong> and above in order to work. <strong>Version %s is not yet supported.</strong>', 'gf-html5-placeholders' ),
                    sprintf( '<a target="_blank" href="%s">%s</a>', 'http://www.gravityforms.com/', 'Gravity Forms' ),
                    $this->_min_gravityforms_version,
                    $this->_max_gravityforms_version
                ),

                'gf_html5_output' =>  sprintf(
                    __( 'Gravity Forms HTML5 Placeholders requires Output HTML5 setting to be enabled in %s page.', 'gf-html5-placeholders' ),
                    sprintf( '<a href="%s">%s</a>', admin_url('admin.php?page=gf_settings'), __( 'General Settings', 'gravityforms') )
                ),
            ),

            // general
            'labels' => (object) array(
                'singular'  => (object) array(
                    'name'  => __('Field label visible', 'gf-html5-placeholders'),
                    'tooltip'   => sprintf('<h6>%s</h6>%s',  __('Field Label Visible', 'gf-html5-placeholders'), __("Select this option to make the form field label visible.", 'gf-html5-placeholders')),
                ),
                'plural'    => (object) array(
                    'name'  => __('Field Sub Labels', 'gf-html5-placeholders'),
                    'tooltip'   => sprintf('<h6>%s</h6>%s',  __('Field Sub Labels', 'gf-html5-placeholders'), __("The following options are available for this field's sub labels.", 'gf-html5-placeholders')),
                ),
                'column'    => (object) array(
                    'field'     => __('Field', 'gf-html5-placeholders'),
                    'value'     => __('Label', 'gf-html5-placeholders'),
                ),
            ),
            'placeholders' => (object) array(
                'singular'  => (object) array(
                    'name'  => __('Field Placeholder', 'gf-html5-placeholders'),
                    'tooltip'   => sprintf('<h6>%s</h6>%s', __('Field Placeholder', 'gf-html5-placeholders'), __('Enter the placeholder text for this form field.', 'gf-html5-placeholders')),
                ),
                'plural'    => (object) array(
                    'name' => __('Field Placeholders', 'gf-html5-placeholders'),
                    'tooltip'   => sprintf('<h6>%s</h6>%s', __('Field Placeholders', 'gf-html5-placeholders'), __('Enter the placeholder texts for this form field.', 'gf-html5-placeholders')),
                ),
                'column'    => (object) array(
                    'field'     => __('Field', 'gf-html5-placeholders'),
                    'value'     => __('Placeholder', 'gf-html5-placeholders'),
                ),
            ),

            // email field
            'labelEnterEmail' => (object) array(
                'default'           =>  __('Enter Email', 'gravityforms'),
            ),
            'labelConfirmEmail' => (object) array(
                'default'           =>  __('Confirm Email', 'gravityforms'),
            ),

            // name field
            'labelNamePrefix'       => (object) array(
                'default'           =>  __('Prefix', 'gravityforms'),
            ),
            'labelNameFirst'        => (object) array(
                'default'           =>  __('First', 'gravityforms'),
            ),
            'labelNameLast'         => (object) array(
                'default'           =>  __('Last', 'gravityforms'),
            ),
            'labelNameSuffix'       => (object) array(
                'default'           =>  __('Suffix', 'gravityforms'),
            ),

            // address field
            'labelAddressStreet'    => (object) array(
                'default'           =>  __('Street Address', 'gravityforms'),
            ),
            'labelAddressStreet2'       => (object) array(
                'default'           =>  __('Address Line 2', 'gravityforms'),
            ),
            'labelAddressCity'      => (object) array(
                'default'           =>  __('City', 'gravityforms'),
            ),
            'labelAddressState' => (object) array(
                'default'           =>  __('State', 'gravityforms'),
            ),
            'labelAddressZip'       => (object) array(
                'default'           =>  __('Postal Code', 'gravityforms'),
            ),
            'labelAddressCountry'   => (object) array(
                'default'           =>  __('Country', 'gravityforms'),
            ),

            // date field
            'labelDateDay'          => (object) array(
                'name'              => __('Day', 'gravityforms'),
                'default'           => __('DD', 'gravityforms'),
            ),
            'labelDateMonth'        => (object) array(
                'name'              => __('Month', 'gravityforms'),
                'default'           => __('MM', 'gravityforms'),
            ),
            'labelDateYear'         => (object) array(
                'name'              => __('Year', 'gravityforms'),
                'default'           => __('YYYY', 'gravityforms'),
            ),

            // time field
            'labelTimeHour'         => (object) array(
                'name'              => __('Hour', 'gravityforms'),
                'default'           => __('HH', 'gravityforms'),
            ),
            'labelTimeMinute'       => (object) array(
                'name'              => __('Minute', 'gravityforms'),
                'default'           => __('MM', 'gravityforms'),
            ),
        );

    }

    /**
     * Plugin starting point. Handles hooks and loading of language files.
     */
    public function init()
    {
         // we use this hook to render our warnings
        add_action( 'admin_notices', array( $this, 'render_warnings') );

        // check if Wordpress version is supported
        if( false === $this->is_wordpress_supported() ){
            $this->warnings[] = $this->_strings->warnings['wp_version'];
            return;
        }

        // check if gravity forms is installed
        if( false === $this->is_gravityforms_installed() ){
            $this->warnings[] = $this->_strings->warnings['gf_missing'];
            return;
        }

        // check if gravity forms is supported
        if ( false === $this->is_gravityforms_supported() ){
            $this->warnings[] = $this->_strings->warnings['gf_version'];
            return;
        }

        // load_plugin_textdomain($this->_slug, FALSE, $this->_slug . '/languages');

        if (defined('RG_CURRENT_PAGE') && RG_CURRENT_PAGE == 'admin-ajax.php') {
            $this->init_ajax();
        } else if (is_admin()) {
            $this->init_admin();
        } else {
            $this->init_frontend();
        }

    }

    /**
     * add tasks or filters here that you want to perform both in the backend and frontend and for ajax requests
     */
    private function init_ajax()
    {
        // We use this filter to manipulate our own field editor settings output
        add_filter('gform_field_content', array($this, 'get_field_content'), 10, 3);

            // We use this filter to manipulate our own field classes
        add_filter('gform_field_css_class', array($this, 'get_field_css_class'), 10, 3);

        // We use this filter to provide translation support through WPML Gravity Forms Multilingual
        add_filter('gform_multilingual_field_keys',    array($this, 'multilingual_field_keys'));
    }

    /**
     * add tasks or filters here that you want to perform only in admin
     */
    private function init_admin()
    {
        // check if we are currently on the form editor page
        if ($this->is_form_editor()) {

            // enqueues admin scripts
            add_action('admin_enqueue_scripts', array($this, 'enqueue_scripts_admin'), 10, 0);

            // we use this filter to make our scripts available in gravity forms no conflict mode
            add_filter('gform_noconflict_scripts', array($this, 'noconflict_scripts'));

            // we use this filter to make our styles available in gravity forms no conflict mode
            add_filter('gform_noconflict_styles', array($this, 'noconflict_styles'));

            // we use this action to add our own field editor settings on the standard tab
            add_action('gform_field_standard_settings',    array($this, 'field_standard_settings'), 10, 2);

            // we use this filter to manipulate our own field output
            add_filter('gform_field_content', array($this, 'get_field_content'), 10, 3);

            // we use this filter to manipulate our own field classes
            add_filter('gform_field_css_class', array($this, 'get_field_css_class'), 10, 3);

            // we use this to generate form editor warnings
            if (false === $this->is_gravityforms_html5_enabled()) {
                $this->warnings[] = $this->_strings->warnings['gf_html5_output'];
            }

        }

        // we use this filter to provide translation support through WPML Gravity Forms Multilingual
        add_filter('gform_multilingual_field_keys',    array($this, 'multilingual_field_keys'));

    }

    /**
     * add tasks or filters here that you want to perform only in the front end
     */
    private function init_frontend()
    {
        // enqueue frontend scripts
        add_action('gform_enqueue_scripts', array($this, 'enqueue_scripts_frontend'), 10, 0);

        // we use this filter to manipulate our own field editor settings output
        add_filter('gform_field_content', array($this, 'get_field_content'), 10, 3);

        // we use this filter to manipulate our own field classes
        add_filter('gform_field_css_class', array($this, 'get_field_css_class'), 10, 3);

        // we use this filter to provide translation support through WPML Gravity Forms Multilingual
        add_filter('gform_multilingual_field_keys',    array($this, 'multilingual_field_keys'));
    }

    //--------------  Action / Filter Target functions  ---------------------------------------------------

    /**
    * Target of wp_enqueue_scripts action.
    */
    public function enqueue_scripts_frontend($form = "", $ajax = false)
    {
        // add support for minified scripts
        $suffix   = defined('SCRIPT_DEBUG') && SCRIPT_DEBUG ? '' : '.min';
        $base_url = $this->get_base_url();

        // override the default gravity forms placeholders script
        wp_deregister_script('gform_placeholder');
        wp_register_script('gform_placeholder', "{$base_url}/js/Placeholders{$suffix}.js", null, '3.0.2');

        if ($this->is_gravityforms_html5_enabled()) {
            wp_enqueue_script('gform_placeholder');
        }

        // register the placeholders css
        wp_register_style('gforms_placeholders_css', "{$base_url}/css/gravityforms-placeholders{$suffix}.css", array('gforms_formsmain_css'), $this->_version);

        if (!apply_filters('gform_placeholders_disable_css', get_option('rg_gforms_disable_css'))) {
            wp_enqueue_style('gforms_placeholders_css');
        }
    }

    /**
    * Target of admin_enqueue_scripts action.
    */
    public function enqueue_scripts_admin()
    {
        // add support for minified scripts
        $suffix       = defined('SCRIPT_DEBUG') && SCRIPT_DEBUG ? '' : '.min';

        // register our scripts and styles
        wp_register_script('gforms_placeholders_editor',   $this->get_base_url() . "/js/gravityforms-placeholders-editor" . $suffix . ".js", array('jquery', 'backbone', 'underscore'), $this->_version, false);
        wp_register_style('gforms_placeholders_editor_css',   $this->get_base_url() . "/css/gravityforms-placeholders-editor.css", array(), $this->_version);

        // enqueue our scripts and styles
        wp_enqueue_script('gforms_placeholders_editor');
        wp_enqueue_style('gforms_placeholders_editor_css');

        // pass variables to gravityforms-placeholders-editor script
        wp_localize_script('gforms_placeholders_editor', '_gfPlaceholdersEditorL10n', array(
            'settings' => array(
                'is_gravityforms_html5_enabled' => $this->is_gravityforms_html5_enabled()
            ),
        ));
    }

    /**
    * Target of gform_noconflict_scripts filter.
    */
    public function noconflict_scripts($scripts)
    {
        if (isset($scripts) && is_array($scripts)) {
            $scripts[] = 'gforms_placeholders_editor';
        }

        return $scripts;
    }

    /**
    * Target of gform_noconflict_scripts filter.
    */
    public function noconflict_styles($styles)
    {
        if (isset($styles) && is_array($styles)) {
            $styles[] = 'gforms_placeholders_editor_css';
        }

        return $styles;
    }

    /**
    * Target of gform_field_standard_settings action.
    */
    public function field_standard_settings($position, $form_id)
    {
        // put our field settings right after the Field Label
        if ($position == 0) {

            global $GFCommon;

            // add label management support for standard field types
            $this->get_template_part('gf-generic-label-setting.tmpl.php', null, true);

            // add label management support for advanced field types
            $this->get_template_part('gf-email-label-setting.tmpl.php', null, true);
            $this->get_template_part('gf-name-label-setting.tmpl.php', null, true);
            $this->get_template_part('gf-address-label-setting.tmpl.php', array('form_id' => $form_id, 'addressTypes' => GFCommon::get_address_types($form_id)), true);
            $this->get_template_part('gf-date-label-setting.tmpl.php', null, true);
            $this->get_template_part('gf-time-label-setting.tmpl.php', null, true);

            // add placeholder suport for standard field types
            $this->get_template_part('gf-generic-placeholder-setting.tmpl.php', null, true);

            // add placeholder suport for advanced field types
            $this->get_template_part('gf-email-placeholder-setting.tmpl.php', null, true);
            $this->get_template_part('gf-name-placeholder-setting.tmpl.php', null, true);
            $this->get_template_part('gf-address-placeholder-setting.tmpl.php', array('form_id' => $form_id, 'addressTypes' => GFCommon::get_address_types($form_id)), true);
            $this->get_template_part('gf-date-placeholder-setting.tmpl.php', null, true);
            $this->get_template_part('gf-time-placeholder-setting.tmpl.php', null, true);

            // add placeholder support for pricing field types
            $this->get_template_part('gf-product-placeholder-setting.tmpl.php', null, true);

        }

    }

    /**
    * Target of gform_multilingual_field_keys filter.
    */
    public function multilingual_field_keys($field_keys)
    {
        if ($this->is_gravityforms_html5_enabled() &&
            isset($field_keys) &&
            is_array($field_keys)
        ) {
            // Export our placeholder field keys for translation
            // *************************************************

            // general
            $field_keys[] = "placeholder";

            // email field
            $field_keys[] = "placeholderEmailConfirm";

            // name field
            $field_keys[] = "placeholderNamePrefix";
            $field_keys[] = "placeholderNameFirst";
            $field_keys[] = "placeholderNameLast";
            $field_keys[] = "placeholderNameSuffix";

            // address field
            $field_keys[] = "placeholderAddressStreet";
            $field_keys[] = "placeholderAddressStreet2";
            $field_keys[] = "placeholderAddressCity";
            $field_keys[] = "placeholderAddressState";
            $field_keys[] = "placeholderAddressZip";
            $field_keys[] = "placeholderAddressCountry";

            // date field
            $field_keys[] = "placeholderDateDay";
            $field_keys[] = "placeholderDateMonth";
            $field_keys[] = "placeholderDateYear";

            // time field
            $field_keys[] = "placeholderTimeHour";
            $field_keys[] = "placeholderTimeMinute";

        }

        // Export our label field keys for translation
        // *******************************************

        // email field
        $field_keys[] = "labelEnterEmail";
        $field_keys[] = "labelConfirmEmail";

        // name field
        $field_keys[] = "labelNamePrefix";
        $field_keys[] = "labelNameFirst";
        $field_keys[] = "labelNameLast";
        $field_keys[] = "labelNameSuffix";

        // address field
        $field_keys[] = "labelAddressStreet";
        $field_keys[] = "labelAddressStreet2";
        $field_keys[] = "labelAddressCity";
        $field_keys[] = "labelAddressState";
        $field_keys[] = "labelAddressZip";
        $field_keys[] = "labelAddressCountry";

        // date field
        $field_keys[] = "labelDateDay";
        $field_keys[] = "labelDateMonth";
        $field_keys[] = "labelDateYear";

        // time field
        $field_keys[] = "labelTimeHour";
        $field_keys[] = "labelTimeMinute";

        return $field_keys;

    }

    /**
    * Target of gform_field_css_class both on form editor & frontend.
    */
    public function get_field_css_class ($css_class, $field, $form)
    {
        if (!isset($css_class) || !isset($field) || !array_key_exists('formId', $field))
            return $css_class;

        $css_class_array = preg_split('/\s+/', $css_class);

        // process Field Label Replacements
        if (isset($field['labelVisible']) && $field['labelVisible'] == false) {
           $css_class_array[] = "gfield_label_hidden";
        }

        return implode(' ', $css_class_array);
    }

    /**
    * Target of gform_field_content both on form editor & frontend.
    */
    public function get_field_content ($field_content, $field, $force_frontend_label)
    {
        if (!isset($field_content) || !isset($field) || !array_key_exists('formId', $field)) {
            return $field_content;
        }

        // current field attributes
        $form_id = $field['formId'];
        $field_id = $field['id'];
        $input_type = isset($field['inputType']) && !empty($field['inputType']) ? $field['inputType'] : $field['type'];

        if ('html' === $input_type) {
            return $field_content;
        }

        $field_uid = $this->is_form_editor() ? "input_{$field_id}" : "input_{$form_id}_{$field_id}";

        // flag to check whether to process field placeholders
        $process_placeholders = $this->is_gravityforms_html5_enabled();

        $this->log("original field content", $field_content);

        // handle Field Content Encoding
        $encoding = mb_detect_encoding($field_content);
        if ($encoding != "UTF-8")
            $field_content = mb_convert_encoding($field_content, 'UTF-8');
        $field_content_wrapped = "<html><head><meta http-equiv=\"Content-Type\" content=\"text/html; charset=UTF-8\" /></head><body>$field_content</body></html>";

        // disable libxml error output while we are processing html
        $use_errors = libxml_use_internal_errors(true);

        // prepare DomDocument and XPath
        $doc = new DomDocument();
        $doc->preserveWhiteSpace = false; // needs to be before loading, to have any effect
        $doc->formatOutput = false;
       @$doc->loadHTML($field_content_wrapped);
        $xpath = new DOMXpath($doc);

        // process field label replacements
        if (isset($field['labelVisible']) && $field['labelVisible'] == false) {
            if ('section' === $input_type) {
                if ($h2 = (($result = $xpath->query("//h2[contains(@class,'gsection_title')]")) ? $result->item(0) : null)) {
                    $styles = $h2->getAttribute('style');
                    $h2->setAttribute('style', trim("{$styles} display:none;"));
                }
            }  else {
                if ($label = (($result = $xpath->query("//label[contains(@class,'gfield_label')]")) ? $result->item(0) : null)) {
                    $styles = $label->getAttribute('style');
                    $label->setAttribute('style', trim("{$styles} display:none;"));
                }
            }
        }

        switch($input_type) {

            case 'text':
            case 'textarea':
            case 'phone':
            case 'website':
            case 'number':
            case 'price':
            case 'post_title':
            case 'post_content':
            case 'post_excerpt':

                $lookup_type = ('textarea' === $input_type || 'post_content' === $input_type  || 'post_excerpt' === $input_type ) ? 'textarea' : 'input' ;
                if ($process_placeholders && isset($field['placeholder']) && !empty($field['placeholder'])) {
                    if ($input = (($result = $xpath->query("//{$lookup_type}[@id='{$field_uid}']")) ? $result->item(0) : null)) {
                        $input->setAttribute('placeholder', esc_attr($field['placeholder']));
                    }
                }
                break; // break text, textarea, phone, website, number, price, post_title, post_content, post_excerpt


            case 'email':

                // process email
                if ($process_placeholders && isset($field['placeholder']) && !empty($field['placeholder'])) {
                    if ($this->is_form_editor() && $input = (($result = $xpath->query("//input[@name='{$field_uid}']")) ? $result->item(0) : null)) {
                        $input->setAttribute('placeholder', esc_attr($field['placeholder']));
                    }
                    if ($input = (($result = $xpath->query("//input[@id='{$field_uid}']")) ? $result->item(0) : null)) {
                        $input->setAttribute('placeholder', esc_attr($field['placeholder']));
                    }
                }

                if (isset($field['labelEnterEmail'])) {
                    if ($label = (($result = $xpath->query("//label[@for='{$field_uid}' and not(contains(@class,'gfield_label'))]")) ? $result->item(0) : null)) {
                        $label->nodeValue = esc_html($field['labelEnterEmail']);
                    }
                }
                if (isset($field['labelEnterEmailVisible']) && $field['labelEnterEmailVisible'] == false) {
                    if ($label = (($result = $xpath->query("//label[@for='{$field_uid}' and not(contains(@class,'gfield_label'))]")) ? $result->item(0) : null)) {
                        $styles = $label->getAttribute('style');
                        $label->setAttribute('style', trim("{$styles} display:none;"));
                    }
                }

                if (isset($field['emailConfirmEnabled']) && $field['emailConfirmEnabled']) {

                    // process confirm
                    if ($process_placeholders && isset($field['placeholderEmailConfirm']) && !empty($field['placeholderEmailConfirm'])) {
                        if ($input = (($result = $xpath->query("//input[@id='{$field_uid}_2']")) ? $result->item(0) : null)) {
                            $input->setAttribute('placeholder', esc_attr($field['placeholderEmailConfirm']));
                        }
                    }
                    if (isset($field['labelConfirmEmail'])) {
                        if ($label = (($result = $xpath->query("//label[@for='{$field_uid}_2']")) ? $result->item(0) : null)) {
                            $label->nodeValue = esc_html($field['labelConfirmEmail']);
                        }
                    }
                    if (isset($field['labelConfirmEmailVisible']) && $field['labelConfirmEmailVisible'] == false) {
                        if ($label = (($result = $xpath->query("//label[@for='{$field_uid}_2']")) ? $result->item(0) : null)) {
                            $styles = $label->getAttribute('style');
                            $label->setAttribute('style', trim("{$styles} display:none;"));
                        }
                    }

                }
                break; // break email

            case 'name':

                $name_format = isset($field['nameFormat']) && !empty($field['nameFormat']) ? $field['nameFormat'] : 'normal';
                switch ($name_format) {

                    case 'simple':

                        if ($process_placeholders && isset($field['placeholder']) && !empty($field['placeholder'])) {
                            if ($input = (($result = $xpath->query("//input[@id='{$field_uid}']")) ? $result->item(0) : null)) {
                                $input->setAttribute('placeholder', esc_attr($field['placeholder']));
                            }
                        }
                        break; // break simple

                    case 'normal':
                    case 'extended':

                        // process name prefix
                        if ('extended' === $name_format) {
                            if ($process_placeholders && isset($field['placeholderNamePrefix']) && !empty($field['placeholderNamePrefix'])) {
                                if ($input = (($result = $xpath->query("//input[@id='{$field_uid}_2']")) ? $result->item(0) : null)) {
                                    $input->setAttribute('placeholder', esc_attr($field['placeholderNamePrefix']));
                                }
                            }
                            if (isset($field['labelNamePrefix'])) {
                                if ($label = (($result = $xpath->query("//span[@id='{$field_uid}_2_container']/label")) ? $result->item(0) : null)) {
                                    $label->nodeValue = esc_html($field['labelNamePrefix']);
                                }
                            }
                            if (isset($field['labelNamePrefixVisible']) && $field['labelNamePrefixVisible'] == false) {
                                if ($label = (($result = $xpath->query("//span[@id='{$field_uid}_2_container']/label")) ? $result->item(0) : null)) {
                                    $styles = $label->getAttribute('style');
                                    $label->setAttribute('style', trim("{$styles} display:none;"));
                                }
                            }
                        }

                        // process name first
                        if ($process_placeholders && isset($field['placeholderNameFirst']) && !empty($field['placeholderNameFirst'])) {
                            if ($input = (($result = $xpath->query("//input[@id='{$field_uid}_3']")) ? $result->item(0) : null)) {
                                $input->setAttribute('placeholder', esc_attr($field['placeholderNameFirst']));
                            }
                        }
                        if (isset($field['labelNameFirst'])) {
                            if ($label = (($result = $xpath->query("//span[@id='{$field_uid}_3_container']/label")) ? $result->item(0) : null)) {
                                $label->nodeValue = esc_html($field['labelNameFirst']);
                            }
                        }
                        if (isset($field['labelNameFirstVisible']) && $field['labelNameFirstVisible'] == false) {
                            if ($label = (($result = $xpath->query("//span[@id='{$field_uid}_3_container']/label")) ? $result->item(0) : null)) {
                                $styles = $label->getAttribute('style');
                                $label->setAttribute('style', trim("{$styles} display:none;"));
                            }
                        }

                        // process name last
                        if ($process_placeholders && isset($field['placeholderNameLast']) && !empty($field['placeholderNameLast'])) {
                            if ($input = (($result = $xpath->query("//input[@id='{$field_uid}_6']")) ? $result->item(0) : null)) {
                                $input->setAttribute('placeholder', esc_attr($field['placeholderNameLast']));
                            }
                        }
                        if (isset($field['labelNameLast'])) {
                            if ($label = (($result = $xpath->query("//span[@id='{$field_uid}_6_container']/label")) ? $result->item(0) : null)) {
                                $label->nodeValue = esc_html($field['labelNameLast']);
                            }
                        }
                        if (isset($field['labelNameLastVisible']) && $field['labelNameLastVisible'] == false) {
                            if ($label = (($result = $xpath->query("//span[@id='{$field_uid}_6_container']/label")) ? $result->item(0) : null)) {
                                $styles = $label->getAttribute('style');
                                $label->setAttribute('style', trim("{$styles} display:none;"));
                            }
                        }

                        // process name suffix
                        if ('extended' === $name_format) {

                            if ($process_placeholders && isset($field['placeholderNameSuffix']) && !empty($field['placeholderNameSuffix'])) {
                                if ($input = (($result = $xpath->query("//input[@id='{$field_uid}_8']")) ? $result->item(0) : null)) {
                                    $input->setAttribute('placeholder', esc_attr($field['placeholderNameSuffix']));
                                }
                            }
                            if (isset($field['labelNameSuffix'])) {
                                if ($label = (($result = $xpath->query("//span[@id='{$field_uid}_8_container']/label")) ? $result->item(0) : null)) {
                                    $label->nodeValue = esc_html($field['labelNameSuffix']);
                                }
                            }
                            if (isset($field['labelNameSuffixVisible']) && $field['labelNameSuffixVisible'] == false) {
                                if ($label = (($result = $xpath->query("//span[@id='{$field_uid}_8_container']/label")) ? $result->item(0) : null) ) {
                                    $styles = $label->getAttribute('style');
                                    $label->setAttribute('style', trim("{$styles} display:none;"));
                                }
                            }

                        }
                        break; // break normal & extended

                } // end switch name format
                break; // break name

            case 'address':

                // process address line 1
                if ($process_placeholders && isset($field['placeholderAddressStreet']) && !empty($field['placeholderAddressStreet'])) {
                    if ($input = (($result = $xpath->query("//input[@id='{$field_uid}_1']")) ? $result->item(0) : null)) {
                        $input->setAttribute('placeholder', esc_attr($field['placeholderAddressStreet']));
                    }
                }
                if (isset($field['labelAddressStreet'])) {
                    if ($label = (($result = $xpath->query("//span[@id='{$field_uid}_1_container']/label")) ? $result->item(0) : null)) {
                        $label->nodeValue = esc_html($field['labelAddressStreet']);
                    }
                }
                if (isset($field['labelAddressStreetVisible']) && $field['labelAddressStreetVisible'] == false) {
                    if ($label = (($result = $xpath->query("//span[@id='{$field_uid}_1_container']/label")) ? $result->item(0) : null)) {
                        $styles = $label->getAttribute('style');
                        $label->setAttribute('style', trim("{$styles} display:none;"));
                    }
                }

                // process address line 2
                if (!isset($field['hideAddress2']) || false === $field['hideAddress2']) {
                    if ($process_placeholders && isset($field['placeholderAddressStreet2']) && !empty($field['placeholderAddressStreet2'])) {
                        if ($input = (($result = $xpath->query("//input[@id='{$field_uid}_2']")) ? $result->item(0) : null)) {
                            $input->setAttribute('placeholder', esc_attr($field['placeholderAddressStreet2']));
                        }
                    }
                    if (isset($field['labelAddressStreet2'])) {
                        if ($label = (($result = $xpath->query("//span[@id='{$field_uid}_2_container']/label")) ? $result->item(0) : null)) {
                            $label->nodeValue = esc_html($field['labelAddressStreet2']);
                        }
                    }
                    if (isset($field['labelAddressStreet2Visible']) && $field['labelAddressStreet2Visible'] == false) {
                        if ($label = (($result = $xpath->query("//span[@id='{$field_uid}_2_container']/label")) ? $result->item(0) : null)) {
                            $styles = $label->getAttribute('style');
                            $label->setAttribute('style', trim("{$styles} display:none;"));
                        }
                    }
                }

                // process address city
                if ($process_placeholders && isset($field['placeholderAddressCity']) && !empty($field['placeholderAddressCity'])) {
                    if ($input = (($result = $xpath->query("//input[@id='{$field_uid}_3']")) ? $result->item(0) : null)) {
                        $input->setAttribute('placeholder', esc_attr($field['placeholderAddressCity']));
                    }
                }
                if (isset($field['labelAddressCity'])) {
                    if ($label = (($result = $xpath->query("//span[@id='{$field_uid}_3_container']/label")) ? $result->item(0) : null)) {
                        $label->nodeValue = esc_html($field['labelAddressCity']);
                    }
                }
                if (isset($field['labelAddressCityVisible']) && $field['labelAddressCityVisible'] == false) {
                    if ($label = (($result = $xpath->query("//span[@id='{$field_uid}_3_container']/label")) ? $result->item(0) : null)) {
                        $styles = $label->getAttribute('style');
                        $label->setAttribute('style', trim("{$styles} display:none;"));
                    }
                }

                // process address state / province
                if (!isset($field['hideState']) || false === $field['hideState']) {
                    if ($process_placeholders && isset($field['placeholderAddressState']) && !empty($field['placeholderAddressState'])) {
                        if ($this->is_form_editor()) {
                            if ($input = (($result = $xpath->query("//input[@name='{$field_uid}.4']")) ? $result->item(0) : null)) {
                                $input->setAttribute('placeholder', esc_attr($field['placeholderAddressState']));
                            }
                        } else {
                            if ($input = (($result = $xpath->query("//input[@id='{$field_uid}_4']")) ? $result->item(0) : null)) {
                                $input->setAttribute('placeholder', esc_attr($field['placeholderAddressState']));
                            }
                        }
                    }
                    if (isset($field['labelAddressState'])) {
                        if ($label = (($result = $xpath->query("//span[@id='{$field_uid}_4_container']/label")) ? $result->item(0) : null)) {
                            $label->nodeValue = esc_html($field['labelAddressState']);
                        }
                    }
                    if (isset($field['labelAddressStateVisible']) && $field['labelAddressStateVisible'] == false) {
                        if ($label = (($result = $xpath->query("//span[@id='{$field_uid}_4_container']/label")) ? $result->item(0) : null)) {
                            $styles = $label->getAttribute('style');
                            $label->setAttribute('style', trim("{$styles} display:none;"));
                        }
                    }
                }

                // process address zip / postal
                if ($process_placeholders && isset($field['placeholderAddressZip']) && !empty($field['placeholderAddressZip'])) {
                    if ($input = (($result = $xpath->query("//input[@id='{$field_uid}_5']")) ? $result->item(0) : null)) {
                        $input->setAttribute('placeholder', esc_attr($field['placeholderAddressZip']));
                    }
                }
                if (isset($field['labelAddressZip'])) {
                    if ($label = (($result = $xpath->query("//span[@id='{$field_uid}_5_container']/label")) ? $result->item(0) : null)) {
                        $label->nodeValue = esc_html($field['labelAddressZip']);
                    }
                }
                if (isset($field['labelAddressZipVisible']) && $field['labelAddressZipVisible'] == false) {
                    if ($label = (($result = $xpath->query("//span[@id='{$field_uid}_5_container']/label")) ? $result->item(0) : null)) {
                        $styles = $label->getAttribute('style');
                        $label->setAttribute('style', trim("{$styles} display:none;"));
                    }
                }

                // process address country
                if (!isset($field['hideCountry']) || false === $field['hideCountry']) {
                    if (isset($field['labelAddressCountry'])) {
                        if ($label = (($result = $xpath->query("//span[@id='{$field_uid}_6_container']/label")) ? $result->item(0) : null)) {
                            $label->nodeValue = esc_html($field['labelAddressCountry']);
                        }
                    }
                    if (isset($field['labelAddressCountryVisible']) && $field['labelAddressCountryVisible'] == false) {
                        if ($label = (($result = $xpath->query("//span[@id='{$field_uid}_6_container']/label")) ? $result->item(0) : null)) {
                            $styles = $label->getAttribute('style');
                            $label->setAttribute('style', trim("{$styles} display:none;"));
                        }
                    }
                }
                break; // break address

            case 'date':

                $date_type = isset($field['dateType']) && !empty($field['dateType']) ? $field['dateType'] : 'datepicker';
                switch ($date_type) {

                    case 'datepicker':

                        // process date picker
                        if ($process_placeholders && isset($field['placeholder']) && !empty($field['placeholder'])) {
                            if ($this->is_form_editor()) {
                                if ($input = (($result = $xpath->query("//input[@name='ginput_datepicker']")) ? $result->item(0) : null)) {
                                    $input->setAttribute('placeholder', esc_attr($field['placeholder']));
                                }
                            } else {
                                if ($input = (($result = $xpath->query("//input[@id='{$field_uid}']")) ? $result->item(0) : null)) {
                                    $input->setAttribute('placeholder', esc_attr($field['placeholder']));
                                }
                            }
                        }
                        break; // break datepicker

                    case 'datefield':

                        // process date month
                        if ($process_placeholders && isset($field['placeholderDateMonth']) && !empty($field['placeholderDateMonth'])) {
                            if ($this->is_form_editor()) {
                                if ($input = (($result = $xpath->query("//input[@name='ginput_month']")) ? $result->item(0) : null)) {
                                    $input->setAttribute('placeholder', esc_attr($field['placeholderDateMonth']));
                                }
                            } else {
                                if ($input = (($result = $xpath->query("//input[@id='{$field_uid}_1']")) ? $result->item(0) : null)) {
                                    $input->setAttribute('placeholder', esc_attr($field['placeholderDateMonth']));
                                }
                            }
                        }
                        if (isset($field['labelDateMonth'])) {
                            if ($this->is_form_editor()) {
                                if ($label = (($result = $xpath->query("//div[@id='gfield_input_date_month']/label")) ? $result->item(0) : null)) {
                                    $label->nodeValue = esc_html($field['labelDateMonth']);
                                }
                            } else {
                                if ($label = (($result = $xpath->query("//div[@id='{$field_uid}_1_container']/label")) ? $result->item(0) : null)) {
                                    $label->nodeValue = esc_html($field['labelDateMonth']);
                                }
                            }
                        }
                        if (isset($field['labelDateMonthVisible']) && $field['labelDateMonthVisible'] == false) {
                            if ($this->is_form_editor()) {
                                if ($label = (($result = $xpath->query("//div[@id='gfield_input_date_month']/label")) ? $result->item(0) : null)) {
                                    $styles = $label->getAttribute('style');
                                    $label->setAttribute('style', trim("{$styles} display:none;"));
                                }
                            } else {
                                if ($label = (($result = $xpath->query("//div[@id='{$field_uid}_1_container']/label")) ? $result->item(0) : null)) {
                                    $styles = $label->getAttribute('style');
                                    $label->setAttribute('style', trim("{$styles} display:none;"));
                                }
                            }
                        }

                        // process date day
                        if ($process_placeholders && isset($field['placeholderDateDay']) && !empty($field['placeholderDateDay'])) {
                            if ($this->is_form_editor()) {
                                if ($input = (($result = $xpath->query("//input[@name='ginput_day']")) ? $result->item(0) : null)) {
                                    $input->setAttribute('placeholder', esc_attr($field['placeholderDateDay']));
                                }
                            } else {
                                if ($input = (($result = $xpath->query("//input[@id='{$field_uid}_2']")) ? $result->item(0) : null)) {
                                    $input->setAttribute('placeholder', esc_attr($field['placeholderDateDay']));
                                }
                            }
                        }
                        if (isset($field['labelDateDay'])) {
                            if ($this->is_form_editor()) {
                                if ($label = (($result = $xpath->query("//div[@id='gfield_input_date_day']/label")) ? $result->item(0) : null)) {
                                    $label->nodeValue = esc_html($field['labelDateDay']);
                                }
                            } else {
                                if ($label = (($result = $xpath->query("//div[@id='{$field_uid}_2_container']/label")) ? $result->item(0) : null)) {
                                    $label->nodeValue = esc_html($field['labelDateDay']);
                                }
                            }
                        }
                        if (isset($field['labelDateDayVisible']) && $field['labelDateDayVisible'] == false) {
                            if ($this->is_form_editor()) {
                                if ($label = (($result = $xpath->query("//div[@id='gfield_input_date_day']/label")) ? $result->item(0) : null)) {
                                    $styles = $label->getAttribute('style');
                                    $label->setAttribute('style', trim("{$styles} display:none;"));
                                }
                            } else {
                                if ($label = (($result = $xpath->query("//div[@id='{$field_uid}_2_container']/label")) ? $result->item(0) : null)) {
                                    $styles = $label->getAttribute('style');
                                    $label->setAttribute('style', trim("{$styles} display:none;"));
                                }
                            }
                        }

                        // process date year
                        if ($process_placeholders && isset($field['placeholderDateYear']) && !empty($field['placeholderDateYear'])) {
                            if ($this->is_form_editor()) {
                                if ($input = (($result = $xpath->query("//input[@name='ginput_year']")) ? $result->item(0) : null)) {
                                    $input->setAttribute('placeholder', esc_attr($field['placeholderDateYear']));
                                }
                            } else {
                                if ($input = (($result = $xpath->query("//input[@id='{$field_uid}_3']")) ? $result->item(0) : null)) {
                                    $input->setAttribute('placeholder', esc_attr($field['placeholderDateYear']));
                                }
                            }
                        }
                        if (isset($field['labelDateYear'])) {
                            if ($this->is_form_editor()) {
                                if ($label = (($result = $xpath->query("//div[@id='gfield_input_date_year']/label")) ? $result->item(0) : null)) {
                                    $label->nodeValue = esc_html($field['labelDateYear']);
                                }
                            } else {
                                if ($label = (($result = $xpath->query("//div[@id='{$field_uid}_3_container']/label")) ? $result->item(0) : null)) {
                                    $label->nodeValue = esc_html($field['labelDateYear']);
                                }
                            }
                        }
                        if (isset($field['labelDateYearVisible']) && $field['labelDateYearVisible'] == false) {
                            if ($this->is_form_editor()) {
                                if ($label = (($result = $xpath->query("//div[@id='gfield_input_date_year']/label")) ? $result->item(0) : null)) {
                                    $styles = $label->getAttribute('style');
                                    $label->setAttribute('style', trim("{$styles} display:none;"));
                                }
                            } else {
                                if ($label = (($result = $xpath->query("//div[@id='{$field_uid}_3_container']/label")) ? $result->item(0) : null)) {
                                    $styles = $label->getAttribute('style');
                                    $label->setAttribute('style', trim("{$styles} display:none;"));
                                }
                            }
                        }
                        break; // break datefield
                } // end switch
                break; // break date

            case 'time':

                // process time hour
                if ($process_placeholders && isset($field['placeholderTimeHour']) && !empty($field['placeholderTimeHour'])) {
                    if ($input = (($result = $xpath->query("//input[@id='{$field_uid}_1']")) ? $result->item(0) : null)) {
                        $input->setAttribute('placeholder', esc_attr($field['placeholderTimeHour']));
                    }
                }
                if (isset($field['labelTimeHour'])) {
                    if ($label = (($result = $xpath->query("//label[@for='{$field_uid}_1']")) ? $result->item(0) : null)) {
                        $label->nodeValue = esc_html($field['labelTimeHour']);
                    }
                }
                if (isset($field['labelTimeHourVisible']) && $field['labelTimeHourVisible'] == false) {
                    if ($label = (($result = $xpath->query("//label[@for='{$field_uid}_1']")) ? $result->item(0) : null)) {
                        $styles = $label->getAttribute('style');
                        $label->setAttribute('style', trim("{$styles} display:none;"));
                    }
                }

                // process time minute
                if ($process_placeholders && isset($field['placeholderTimeMinute']) && !empty($field['placeholderTimeMinute'])) {
                    if ($input = (($result = $xpath->query("//input[@id='{$field_uid}_2']")) ? $result->item(0) : null)) {
                        $input->setAttribute('placeholder', esc_attr($field['placeholderTimeMinute']));
                    }
                }
                if (isset($field['labelTimeMinute'])) {
                    if ($label = (($result = $xpath->query("//label[@for='{$field_uid}_2']")) ? $result->item(0) : null)) {
                        $label->nodeValue = esc_html($field['labelTimeMinute']);
                    }
                }
                if (isset($field['labelTimeMinuteVisible']) && $field['labelTimeMinuteVisible'] == false) {
                    if ($label = (($result = $xpath->query("//label[@for='{$field_uid}_2']")) ? $result->item(0) : null)) {
                        $styles = $label->getAttribute('style');
                        $label->setAttribute('style', trim("{$styles} display:none;"));
                    }
                }
                break; // break time

            case 'product':
            case 'singleproduct':
            case 'calculation':

                $product_disable_quantity = isset($field['disableQuantity']) && $field['disableQuantity'];
                if ($process_placeholders && !$product_disable_quantity && isset($field['placeholder']) && !empty($field['placeholder'])) {
                    if ($this->is_form_editor()) {
                        if ($input = (($result = $xpath->query("//input[@name='{$field_uid}.3']")) ? $result->item(0) : null)) {
                            $input->setAttribute('placeholder', esc_attr($field['placeholder']));
                        }
                    } else {
                        if ($input = (($result = $xpath->query("//input[@name='input_{$field_id}.3']")) ? $result->item(0) : null)) {
                            $input->setAttribute('placeholder', esc_attr($field['placeholder']));
                        }
                    }
                }

            break; // break product, singleproduct & caclulation
            case 'quantity':

                $quantity_type = isset($field['inputType']) && !empty($field['inputType']) ? $field['inputType'] : 'number';
                switch ($quantity_type) {
                    case 'number':
                        // Process Product Amount
                        if ($process_placeholders && isset($field['placeholder']) && !empty($field['placeholder'])) {
                            if ($input = (($result = $xpath->query("//input[@id='{$field_uid}']")) ? $result->item(0) : null)) {
                                $input->setAttribute('placeholder', esc_attr($field['placeholder']));
                            }
                        }
                        break; // break number
                }
                break; // break quantity
        }

        $field_content = $doc->SaveHTML();

        // remove our html wrapper from processed field
        $field_content = str_replace(
            array('<html>', '</html>', '<head>', '</head>', "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=UTF-8\">", '<body>', '</body>'),
            array('', '', '', '', '', '', ''),
            $field_content
       );

        $field_content = trim(preg_replace('/^<!DOCTYPE.+?>/', '', $field_content));

        // check if we are currently on ajax and fix double quotes to single.
        if (defined('RG_CURRENT_PAGE') && RG_CURRENT_PAGE == 'admin-ajax.php') {

            // replace non escaped double quotes with single quotes for ajax support
            $matches = array();
            preg_match_all('/"[^"\\\\]*(?:\\\\.[^"\\\\]*)*"/s', $field_content, $matches);
            if (count($matches[0]) > 0) {
                foreach ($matches[0] as $match) {
                    $replace = "'" . substr($match, 1, strlen($match) - 2) . "'";
                    $field_content = str_replace($match, $replace, $field_content);
                }
            }

        }

        $this->log("processed field content", $field_content);

        // renable libxml error handling
        libxml_use_internal_errors($use_errors);

        return $field_content;
    }

    /**
    * Target of admin_notices action.
    */
    public function render_warnings()
    {
        global $pagenow;
        if ( $pagenow === 'plugins.php' ){
            foreach ( $this->warnings as $warning ){

                $view_data = array(
                    'message' => (object) array(
                        'text' => $warning,
                        'type' => 'error',
                    ),
                );

                $this->get_template_part( 'gf-message.tmpl.php', $view_data, true );

            }
        }
    }

    //--------------  helper functions  ---------------------------------------------------



    protected function log($message, $attachment = null)
    {
        if (!$this->_debug) return;

        if (defined('DOING_AJAX')) {
            $call_mode = "WP_AJAX";
        }elseif (defined('RG_CURRENT_PAGE') && RG_CURRENT_PAGE == 'admin-ajax.php') {
            $call_mode = "GF_AJAX";
        }else {
            $call_mode = "NORMAL";
        }

        $user_mode = defined('IS_ADMIN') ? "ADMIN"  : "NORMAL";

        $timestamp = date("Y-m-d H:i:s");
        $log  = "[ {$timestamp} ][ $call_mode ][ $user_mode ][ $message ]\r\n\n";

        if (isset($attachment)) {

            $type = gettype($attachment);
            switch ($type) {
                case 'array':
                case 'object':
                    $log .= print_r($attachment, true);
                    break;

                default:
                    $log .= (string) $attachment;
                    break;
            }
            $log .= "\r\n\n";
        }

        $logfile = $this->get_base_path() . '/debug.log';
        file_put_contents ($logfile, $log, FILE_APPEND);
    }

    /**
     * Returns the url of the root folder of the current Add-On.
     *
     * @param string $full_path Optional. The full path the the plugin file.
     * @return string
     */
    protected function get_base_url($full_path = "")
    {
        if (empty($full_path)) {
            $full_path = $this->_full_path;
        }
        return plugins_url(null, $full_path);
    }

    protected function get_base_path($full_path = "")
    {
        if (empty($full_path)) {
            $full_path = $this->_full_path;
        }
        return plugin_dir_path($full_path);
    }

    /**
    * Render a Template File
    *
    * @param $filePath
    * @param null $viewData
    * @param false $echo
    * @return string
    */
    protected function get_template_part($template_filename, $view_data = null, $echo = false)
    {
        if ($view_data) {
            extract($view_data);
        }

        ob_start();
        include ($this->get_base_path() . "templates" . DIRECTORY_SEPARATOR . $template_filename);
        $template = ob_get_contents();
        ob_end_clean();

        if ($echo) {
            echo $template;
        } else {
            return $template;
        }
    }

    /**
    * Returns TRUE if the current page is the form editor page. Otherwise, returns FALSE
    */
    protected function is_form_editor()
    {
        // Normal GET
        if (rgget("page") == "gf_edit_forms" && !rgempty("id", $_GET) && rgempty("view", $_GET))
            return true;

        // AJAX Calls
        if (defined('RG_CURRENT_PAGE') && RG_CURRENT_PAGE == 'admin-ajax.php' && rgpost("action") == "rg_change_input_type")
            return true;

        return false;
    }

    /**
     * Checks whether the Gravity Forms is installed.
     *
     * @return bool
     */
    public function is_gravityforms_installed()
    {
        return class_exists("GFForms");
    }

    /**
     * Checks whether the Gravity Forms html5 output is enabled.
     *
     * @return bool
     */
    public function is_gravityforms_html5_enabled()
    {
        return class_exists("RGFormsModel") && RGFormsModel::is_html5_enabled();
    }

    /**
     * Checks whether the current version of Gravity Forms is supported
     *
     * @param $min_gravityforms_version
     * @return bool|mixed
     */
    public function is_gravityforms_supported($min_gravityforms_version = "", $max_gravityforms_version = "")
    {
        if (isset($this->_min_gravityforms_version) &&
            empty($min_gravityforms_version)
        ) {
            $min_gravityforms_version = $this->_min_gravityforms_version;
        }

        if (isset($this->_max_gravityforms_version) &&
            empty($max_gravityforms_version)
        ) {
            $max_gravityforms_version = $this->_max_gravityforms_version;
        }

        if (empty($min_gravityforms_version) && empty($max_gravityforms_version)) {
            return true;
        }

        if (class_exists("GFCommon")) {
            $is_correct_version = version_compare(GFCommon::$version, $min_gravityforms_version, ">=") && version_compare(GFCommon::$version, $max_gravityforms_version, "<");
            return $is_correct_version;
        }

        return false;

    }

    /**
     * Checks whether the current version of WordPress is supported
     *
     * @param $min_wordpress_version
     * @return bool|mixed
     */
    public function is_wordpress_supported( $min_wordpress_version = "" ){

        if (isset($this->_min_wordpress_version) &&
            empty($min_wordpress_version)
        ) {
            $min_wordpress_version = $this->_min_wordpress_version;
        }

        if (empty($min_wordpress_version)) {
            return true;
        }

        return version_compare( get_bloginfo("version"), $min_wordpress_version, ">=" );
    }

}

new GFHtml5Placeholders();

endif;