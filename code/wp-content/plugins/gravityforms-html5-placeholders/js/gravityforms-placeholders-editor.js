/* global _gfPlaceholdersEditorL10n */
/*!
 * Gravity Forms HTML5 Placeholders Editor Script
 * Adds native HTML5 placeholder support to Gravity Forms' fields using Backbone
 * Copyright (c) 2014 iSoftware Greece
 * Licensed GNU General Public License
 * http://www.isoftware.gr/
 * v2.5
 */
(function ($) {

    // Create namespaces
    window.wp = window.wp || {};
    wp.GravityForms = wp.GravityForms || {};
    wp.GravityForms.Editor = wp.GravityForms.Editor || {};
    wp.GravityForms.Editor.FieldSettings = wp.GravityForms.Editor.FieldSettings || {};   
    
    // Create variables
    var GFViews = wp.GravityForms.Editor.Views = wp.GravityForms.Editor.Views || {};
    var GFEvents    = wp.GravityForms.Editor.Events = wp.GravityForms.Editor.Events || _.extend({}, Backbone.Events);
    var GFSettings = wp.GravityForms.Settings = _gfPlaceholdersEditorL10n.settings || {
        is_gravityforms_html5_enabled : false,
    };

    GFViews.FieldSettingEditor = Backbone.View.extend({
        fieldSettingClass : null,
        fieldTypesSupported : null,
        events: {},
        template : null,
        renderEnabled: true,
        renderContainer: null,
        isFieldTypeSupported: function ( field ){
            if( typeof field === 'string' ) {
                return $.inArray( field, this.fieldTypesSupported) > -1 ;
            } else {
                return field.type && $.inArray( field.type, this.fieldTypesSupported ) > -1  ||
                       'post_tags' === field.type && '' === field.inputType && $.inArray( 'text', this.fieldTypesSupported ) > -1 ||
                       'post_category' !== field.type && field.inputType && $.inArray( field.inputType, this.fieldTypesSupported ) > -1 ;
            }
        },
        constructor: function( args ) {
            
            Backbone.View.apply(this, [args]);
            
            // Register our field setting classes
            if ( this.fieldSettingClass && this.fieldTypesSupported && this.fieldTypesSupported.length > 0 ) {
                for( index in this.fieldTypesSupported ){
                    var fieldType = this.fieldTypesSupported[ index ];
                    if ( String(fieldSettings[ fieldType ]).indexOf( "." + this.fieldSettingClass ) === -1)
                        fieldSettings[ fieldType ] += ", ." + this.fieldSettingClass;
                }
            }
            
            var self = this;
            
            // Binding to the load field settings event to initialize custom fields
            $(document).bind('gform_load_field_settings', function(event, field, form) {

                // Render this setting
                if( self.renderEnabled ) {
                    self.render( field );
                }

            });

        },
        initialize: function(){
            throw 'FieldSettingEditor is an abstract view you must apply Inheritance if you want to use it';
        },
        initializeTooltips : function(){

            // Enable newly added tooltips
            this.$( ".gf_tooltip" ).tooltip({
                show: 500,
                hide: 1000,
                content: function () {
                    return $(this).prop('title');
                }
            });

        },
        model: function ( field ) {
            throw 'FieldSettingEditor is an abstract view you must apply Inheritance if you want to use it';
        },
        render: function( field ){
            
            if( this.renderEnabled && this.isFieldTypeSupported( field ) ) {

                var model = this.model( field );
                if (model && this.template) {
                
                    if ( this.container ){
                        this.container.html( this.template( model ) );
                    } else {
                        this.$el.html( this.template( model ) );
                    }

                    this.initializeTooltips();

                    // show the field setting if it is hidden
                    if ( this.$el ) this.$el.show();

                }
            
            }

            return this;
        },
        refresh : function () {
            var field = GetSelectedField();
            this.render(field);
        }
    });
    
    // Email Confirm Setting
    GFViews.EmailConfirmSettingEditor = GFViews.FieldSettingEditor.extend({
        el: 'li.email_confirm_setting.field_setting',
        fieldTypesSupported: [ 'email'],
        renderEnabled : false,
        events: {
            'click input#gfield_email_confirm_enabled' : 'inputEmailConfirmEnabledOnClick'
        },
        initialize: function(){

            // Initialize our object
            this.events = _.extend({}, GFViews.FieldSettingEditor.prototype.events,this.events);

            // Bind this to our events
            _.bindAll(this, "refresh");

        },

        // Events
        inputEmailConfirmEnabledOnClick : function( e ) {
            wp.GravityForms.Editor.Events.trigger("inputEmailConfirmEnabledOnClick", e );
        },

    });
    
    // Rules Setting
    GFViews.RulesSettingEditor = GFViews.FieldSettingEditor.extend({
        el: 'li.rules_setting.field_setting',
        fieldSettingClass: 'rules_setting',
        fieldTypesSupported : [], // will be configured in the initialize function
        renderEnabled : false,
        events: {
            'click input#field_required' : 'inputFieldRequiredOnClick'
        },
        initialize: function(){
            
            // Get all the types that support the label_setting
            for( var fieldType in fieldSettings ){
                if (String(fieldSettings[fieldType]).indexOf("." + this.fieldSettingClass) !== -1)
                    this.fieldTypesSupported.push( fieldType );
            }

            // Initialize our object
            this.events = _.extend({}, GFViews.FieldSettingEditor.prototype.events,this.events);

            // Bind this to our events
            _.bindAll(this, "refresh");

        },

        // Events
        inputFieldRequiredOnClick : function( e ) {
            $('.field_selected' ).toggleClass( 'gfield_contains_required', e.currentTarget.checked );
            wp.GravityForms.Editor.Events.trigger("inputFieldRequiredOnClick", e );
        },

    });

    // Product Field Type Setting
    GFViews.ProductFieldTypeSettingEditor = GFViews.FieldSettingEditor.extend({
        el: 'li.product_field_type_setting.field_setting',
        fieldSettingClass: 'product_field_type_setting',
        fieldTypesSupported: [ 'product'],
        renderEnabled : false,
        events: {
            'change select#product_field_type' : 'selectProductFieldTypeOnChange'
        },
        initialize: function(){
            
            // Initialize our object
            this.events = _.extend({}, GFViews.FieldSettingEditor.prototype.events,this.events);

            // Bind this to our events
            _.bindAll(this, "refresh");

        },

        // Events
        selectProductFieldTypeOnChange : function( e ) {
            wp.GravityForms.Editor.Events.trigger("selectProductFieldTypeOnChange", e );
        },

    });

    // Quantity Field Type Setting
    GFViews.QuantityFieldTypeSettingEditor = GFViews.FieldSettingEditor.extend({
        el: 'li.quantity_field_type_setting.field_setting',
        fieldSettingClass: 'quantity_field_type_setting',
        fieldTypesSupported: [ 'quantity'],
        renderEnabled : false,
        events: {
            'change select#quantity_field_type' : 'selectQuantityFieldTypeOnChange'
        },
        initialize: function(){

            // Initialize our object
            this.events = _.extend({}, GFViews.FieldSettingEditor.prototype.events,this.events);

            // Bind this to our events
            _.bindAll(this, "refresh");

        },

        // Events
        selectQuantityFieldTypeOnChange : function( e ) {
            wp.GravityForms.Editor.Events.trigger("selectQuantityFieldTypeOnChange", e );
        },

    });

    // Post Tag Type Setting
    GFViews.PostTagTypeSettingEditor = GFViews.FieldSettingEditor.extend({
        el: 'li.post_tag_type_setting.field_setting',
        fieldSettingClass: 'post_tag_type_setting',
        fieldTypesSupported: [ 'post_tags'],
        renderEnabled : false,
        events: {
            'change select#post_tag_type' : 'selectPostTagTypeOnChange'
        },
        initialize: function(){
            
            // Initialize our object            
            this.events = _.extend({}, GFViews.FieldSettingEditor.prototype.events,this.events);

            // Bind this to our events
            _.bindAll(this, "refresh");

        },

        // Events
        selectPostTagTypeOnChange : function( e ) {
            wp.GravityForms.Editor.Events.trigger("selectPostTagTypeOnChange", e );
        },

    });

    // Post Custom Field Type Setting
    GFViews.PostCustomFieldTypeSettingEditor = GFViews.FieldSettingEditor.extend({
        el: 'li.post_custom_field_type_setting.field_setting',
        fieldSettingClass: 'post_custom_field_type_setting',
        fieldTypesSupported: [ 'post_custom_field'],
        renderEnabled : false,
        events: {
            'change select#post_custom_field_type' : 'selectPostCustomFieldTypeOnChange'
        },
        initialize: function(){

            // Initialize our object
            this.events = _.extend({}, GFViews.FieldSettingEditor.prototype.events,this.events);

            // Bind this to our events
            _.bindAll(this, "refresh");

        },

        // Events
        selectPostCustomFieldTypeOnChange : function( e ) {
            wp.GravityForms.Editor.Events.trigger("selectPostCustomFieldTypeOnChange", e );
        },

    });

    // Disable Quantity Setting
    GFViews.DisableQuantitySettingEditor = GFViews.FieldSettingEditor.extend({
        el: 'li.disable_quantity_setting.field_setting',
        fieldSettingClass: 'disable_quantity_setting',
        fieldTypesSupported: [ 'singleproduct', 'calculation'],
        renderEnabled : false,
        events: {
            'click input#field_disable_quantity' : 'inputFieldDisableQuantityOnClick'
        },
        initialize: function(){

            // Initialize our object
            this.events = _.extend({}, GFViews.FieldSettingEditor.prototype.events,this.events);

            // Bind this to our events
            _.bindAll(this, "refresh");

        },
        refresh: function() {
            var field = GetSelectedField()
                disableQuantity = field.disableQuantity || false;
            $('.field_selected .ginput_quantity_label, .field_selected .ginput_quantity').toggle( !disableQuantity );
        },

        // Events
        inputFieldDisableQuantityOnClick : function( e ) {
            wp.GravityForms.Editor.Events.trigger("inputFieldDisableQuantityOnClick", e );
        },

    });

    // Placeholder Setting
    GFViews.PlaceholderSettingEditor = GFViews.FieldSettingEditor.extend({
        el: 'li.placeholder_setting.field_setting',
        fieldSettingClass : 'placeholder_setting',
        fieldTypesSupported : [ 'text', 'textarea', 'phone', 'website', 'number', 'post_title', 'post_content', 'post_excerpt' ],
        events: {
            'keyup input#placeholder'              : 'inputPlaceholderOnKeyUp',
            'keyup textarea#placeholder'           : 'inputPlaceholderOnKeyUp', 
        },
        initialize: function(){

            // Initialize our object
            this.events = _.extend({}, GFViews.FieldSettingEditor.prototype.events,this.events);
            this.template  = _.template( this.$('#tmpl-gf-placeholder-setting').html() );
            this.container = this.$('#placeholder_setting_container');
            
            // Bind this to our events
            _.bindAll(this, "refresh");

            // Listen to our events
            wp.GravityForms.Editor.Events.bind("selectPostTagTypeOnChange", this.refresh);
            wp.GravityForms.Editor.Events.bind("selectPostCustomFieldTypeOnChange", this.refresh);

        },
        model : function ( field ){
            var model = { 
                field : {
                    id:             field.id,
                    type:           field.type,
                    inputType:      field.inputType || 'text', 
                    size:           'undefined' === typeof field['size']        ? 'medium'  : field.size,
                    placeholder:    'undefined' === typeof field['placeholder'] ? ''        : field.placeholder,
                }
            };
            return model;
        },
        refresh : function () {
            var field = GetSelectedField(),
                placeholder = field.placeholder || '';
            $('#field_'+ field.id + '.field_selected #input_'+ field.id).attr('placeholder', placeholder);
            this.render( field );
        },

        // Events
        inputPlaceholderOnKeyUp : function( e ) {
            SetFieldProperty('placeholder', e.currentTarget.value );
            var field = GetSelectedField(),
                placeholder = field.placeholder || '';
            $('#field_'+ field.id + '.field_selected #input_'+ field.id).attr('placeholder', field.placeholder);
        },

    });

    // Address Setting
    GFViews.AddressSettingEditor = GFViews.FieldSettingEditor.extend({
        el: 'li.address_setting.field_setting',
        fieldSettingClass: 'address_setting',
        fieldTypesSupported: [ 'address'],
        renderEnabled : false,
        events: {
            'change select#field_address_type'                      : 'selectAddressTypeOnChange',
            'click input#field_address_hide_address2'               : 'inputHideAddressStreet2OnClick',
            'click input#field_address_hide_state_international'    : 'inputHideStateOnClick',
            'click input#field_address_hide_state_us'               : 'inputHideStateOnClick',
            'click input#field_address_hide_state_canadian'         : 'inputHideStateOnClick',
            'click input#field_address_hide_country_international'  : 'inputHideCountryOnClick',
        },
        initialize: function(){

            // Initialize our object
            this.events = _.extend({}, GFViews.FieldSettingEditor.prototype.events,this.events);

            // Bind this to our events
            _.bindAll(this, "refresh");

        },

        // Events
        selectAddressTypeOnChange : function( e ) {
            wp.GravityForms.Editor.Events.trigger("selectAddressTypeOnChange", e );
        },
        inputHideAddressStreet2OnClick : function( e ) {
            wp.GravityForms.Editor.Events.trigger("inputHideAddressStreet2OnClick", e );
        },
        inputHideStateOnClick : function( e ) {
            wp.GravityForms.Editor.Events.trigger("inputHideStateOnClick", e );
        },
        inputHideCountryOnClick : function( e ) {
            wp.GravityForms.Editor.Events.trigger("inputHideCountryOnClick", e );
        },
    });

    // Date Input Type Setting
    GFViews.DateInputTypeSettingEditor = GFViews.FieldSettingEditor.extend({
        el: 'li.date_input_type_setting.field_setting',
        fieldSettingClass: 'date_input_type_setting',
        fieldTypesSupported: [ 'date'],
        renderEnabled : false,
        events: {
            'change select#field_date_input_type' : 'selectDateInputTypeOnChange',
        },
        initialize: function(){

            // Initialize our object
            this.events = _.extend({}, GFViews.FieldSettingEditor.prototype.events,this.events);

            // Bind this to our events
            _.bindAll(this, "refresh");

        },

        // Events
        selectDateInputTypeOnChange : function( e ) {
            wp.GravityForms.Editor.Events.trigger("selectDateInputTypeOnChange", e );
        },

    });

    // Placeholder Email Setting
    GFViews.PlaceholderEmailSettingEditor = GFViews.FieldSettingEditor.extend({
        el: 'li.placeholder_email_setting.field_setting',
        fieldSettingClass: 'placeholder_email_setting',
        fieldTypesSupported : [ 'email' ],
        events: {
            'keyup input#placeholder_email'             : 'inputPlaceholderEmailOnKeyUp',
            'keyup input#placeholder_email_confirm'     : 'inputPlaceholderEmailConfirmOnKeyUp',
        },
        initialize: function(){

            // Initialize our object
            this.events = _.extend({}, GFViews.FieldSettingEditor.prototype.events,this.events);
            this.template  = _.template( this.$('#tmpl-gf-placeholder-email-setting').html() );
            this.container = this.$('#placeholder_email_setting_container');
            
            // Bind this to our events
            _.bindAll(this, "refresh");
            _.bindAll(this, "inputEmailConfirmEnabledOnClick");

            // Listen to our events
            wp.GravityForms.Editor.Events.bind("inputEmailConfirmEnabledOnClick", this.inputEmailConfirmEnabledOnClick);
            wp.GravityForms.Editor.Events.bind("inputLabelEnterEmailOnKeyUp", this.refresh );
            wp.GravityForms.Editor.Events.bind("inputLabelConfirmEmailOnKeyUp",  this.refresh );

        },
        model : function ( field ){
            var model = { 
                field : {
                    id:                         field.id,
                    type:                       field.type,
                    size:                       'undefined' === typeof field['size']                        ? 'medium'      : field.size,
                    emailConfirmEnabled:        'undefined' === typeof field['emailConfirmEnabled']         ?  false        : field.emailConfirmEnabled,
                    placeholder:                'undefined' === typeof field['placeholder']                 ? ''            : field.placeholder,
                    placeholderEmailConfirm:    'undefined' === typeof field['placeholderEmailConfirm']     ? ''            : field.placeholderEmailConfirm,
                },
            };
            return model;
        },

        // Events
        inputEmailConfirmEnabledOnClick: function( e ){
            this.refresh();
        },
        inputPlaceholderEmailOnKeyUp : function( e ) {
            SetFieldProperty('placeholder', e.currentTarget.value);
            var field = GetSelectedField();
            $('#field_'+ field.id + '.field_selected input[name="input_'+ field.id + '"]').attr('placeholder', e.currentTarget.value);
        },
        inputPlaceholderEmailConfirmOnKeyUp : function ( e ){
            SetFieldProperty('placeholderEmailConfirm', e.currentTarget.value);
            var field = GetSelectedField();
            $('#field_'+ field.id + '.field_selected input[name="input_'+ field.id + '_2"]').attr('placeholder', e.currentTarget.value);
        },

    }); 

    // Placeholder Name Setting Editor
    GFViews.PlaceholderNameSettingEditor = GFViews.FieldSettingEditor.extend({
        el: 'li.placeholder_name_setting.field_setting',
        fieldSettingClass: 'placeholder_name_setting',
        fieldTypesSupported : [ 'name' ],
        events: {
            'keyup input#placeholder_name'          : 'inputPlaceholderNameOnKeyUp',
            'keyup input#placeholder_name_prefix'   : 'inputPlaceholderNamePrefixOnKeyUp',
            'keyup input#placeholder_name_first'    : 'inputPlaceholderNameFirstOnKeyUp',
            'keyup input#placeholder_name_last'     : 'inputPlaceholderNameLastOnKeyUp',
            'keyup input#placeholder_name_suffix'   : 'inputPlaceholderNameSuffixOnKeyUp',
        },
        initialize: function(){

            // Initialize our object
            this.events = _.extend({}, GFViews.FieldSettingEditor.prototype.events,this.events);
            this.template  = _.template( this.$('#tmpl-gf-placeholder-name-setting').html() );
            this.container = this.$('#placeholder_name_setting_container');

            // Bind this to our events
            _.bindAll(this, "refresh");

            // Listen to our events
            wp.GravityForms.Editor.Events.bind("inputLabelNamePrefixOnKeyUp", this.refresh );
            wp.GravityForms.Editor.Events.bind("inputLabelNameFirstOnKeyUp",  this.refresh );
            wp.GravityForms.Editor.Events.bind("inputLabelNameLastOnKeyUp",   this.refresh );
            wp.GravityForms.Editor.Events.bind("inputLabelNameSuffixOnKeyUp", this.refresh );

        },
        model : function ( field ){
            var model = { 
                field : {
                    id:                         field.id,
                    type:                       field.type,
                    size:                       'undefined' === typeof field['size']                                    ? 'medium'      : field.size,
                    nameFormat:                 'undefined' === typeof field['nameFormat'] || '' === field.nameFormat   ? 'normal'      : field.nameFormat,
                    placeholder:                'undefined' === typeof field['placeholder']                             ? ''            : field.placeholder,
                    placeholderNamePrefix:      'undefined' === typeof field['placeholderNamePrefix']                   ? ''            : field.placeholderNamePrefix,
                    placeholderNameFirst:       'undefined' === typeof field['placeholderNameFirst']                    ? ''            : field.placeholderNameFirst,
                    placeholderNameLast:        'undefined' === typeof field['placeholderNameLast']                     ? ''            : field.placeholderNameLast,
                    placeholderNameSuffix:      'undefined' === typeof field['placeholderNameSuffix']                   ? ''            : field.placeholderNameSuffix,
                },
            };
            return model;
        },

        // Events
        inputPlaceholderNameOnKeyUp : function( e ) {
            SetFieldProperty('placeholder', e.currentTarget.value );
            var field = GetSelectedField();
            $('#field_'+ field.id + '.field_selected #input_'+ field.id ).attr('placeholder', e.currentTarget.value);
        },
        inputPlaceholderNamePrefixOnKeyUp : function( e ) {
            SetFieldProperty('placeholderNamePrefix', e.currentTarget.value );
            var field = GetSelectedField();
            $('#field_'+ field.id + '.field_selected #input_'+ field.id + '_2').attr('placeholder', e.currentTarget.value);
        },
        inputPlaceholderNameFirstOnKeyUp : function( e ) {
            SetFieldProperty('placeholderNameFirst', e.currentTarget.value );
            var field = GetSelectedField();
            $('#field_'+ field.id + '.field_selected #input_'+ field.id + '_3').attr('placeholder', e.currentTarget.value);
        },
        inputPlaceholderNameLastOnKeyUp : function( e ) {
            SetFieldProperty('placeholderNameLast', e.currentTarget.value );
            var field = GetSelectedField();
            $('#field_'+ field.id + '.field_selected #input_'+ field.id + '_6' ).attr('placeholder', e.currentTarget.value);
        },
        inputPlaceholderNameSuffixOnKeyUp : function( e ) {
            SetFieldProperty('placeholderNameSuffix', e.currentTarget.value );
            var field = GetSelectedField();
            $('#field_'+ field.id + '.field_selected #input_'+ field.id + '_8' ).attr('placeholder', e.currentTarget.value);
        },

    });     

    // Placeholder Address Setting Editor
    GFViews.PlaceholderAddressSettingEditor = GFViews.FieldSettingEditor.extend({
        el: 'li.placeholder_address_setting.field_setting',
        fieldSettingClass: 'placeholder_address_setting',
        fieldTypesSupported : [ 'address' ],
        events: {
            'keyup input#placeholder_address_street'    : 'inputPlaceholderAddressStreetOnKeyUp',
            'keyup input#placeholder_address_street2'   : 'inputPlaceholderAddressStreet2OnKeyUp',
            'keyup input#placeholder_address_city'      : 'inputPlaceholderAddressCityOnKeyUp',
            'keyup input#placeholder_address_state'     : 'inputPlaceholderAddressStateOnKeyUp',
            'keyup input#placeholder_address_zip'       : 'inputPlaceholderAddressZipOnKeyUp',
        },
        initialize: function(){

            // Initialize our object
            this.events = _.extend({}, GFViews.FieldSettingEditor.prototype.events,this.events);
            this.template  = _.template( this.$('#tmpl-gf-placeholder-address-setting').html() );
            this.container = this.$('#placeholder_address_setting_container');

            // Bind this to our events
            _.bindAll(this, "refresh");

            // Listen to our events
            wp.GravityForms.Editor.Events.bind( "selectAddressTypeOnChange", this.refresh );
            wp.GravityForms.Editor.Events.bind( "inputHideAddressStreet2OnClick", this.refresh );
            wp.GravityForms.Editor.Events.bind( "inputHideStateOnClick", this.refresh );
            wp.GravityForms.Editor.Events.bind( "inputHideCountryOnClick", this.refresh );

        },
        model : function ( field ){

            var addressType = $("#field_address_type").val(),
                hasStateDropDown = $("#field_address_has_states_" + addressType).val() != "",
                model = { 
                    field : {
                        id:                         field.id,
                        type:                       field.type,
                        addressType:                'undefined' === typeof field['addressType'] || '' === field.addressType     ? 'international'   : field.addressType,
                        hideAddress2:               'undefined' === typeof field['hideAddress2']                                ? false             : field.hideAddress2,
                        hideCountry:                'undefined' === typeof field['hideCountry']                                 ? false             : field.hideCountry,
                        hideState:                  'undefined' === typeof field['hideState']                                   ? false             : field.hideState,
                        hasStateDropDown:           hasStateDropDown,
                        placeholderAddressStreet:   'undefined' === typeof field['placeholderAddressStreet']                    ? ''                : field.placeholderAddressStreet,
                        placeholderAddressStreet2:  'undefined' === typeof field['placeholderAddressStreet2']                   ? ''                : field.placeholderAddressStreet2,
                        placeholderAddressCity:     'undefined' === typeof field['placeholderAddressCity']                      ? ''                : field.placeholderAddressCity,
                        placeholderAddressState:    'undefined' === typeof field['placeholderAddressState']                     ? ''                : field.placeholderAddressState,
                        placeholderAddressZip:      'undefined' === typeof field['placeholderAddressZip']                       ? ''                : field.placeholderAddressZip,
                    },
                };

            return model;
        },

        // Events
        inputPlaceholderAddressStreetOnKeyUp : function( e ) {
            SetFieldProperty('placeholderAddressStreet', e.currentTarget.value );
            var field = GetSelectedField();
            $('#field_'+ field.id + '.field_selected #input_'+ field.id + '_1').attr('placeholder', e.currentTarget.value);
        },
        inputPlaceholderAddressStreet2OnKeyUp : function( e ) {
            SetFieldProperty('placeholderAddressStreet2', e.currentTarget.value );
            var field = GetSelectedField();
            $('#field_'+ field.id + '.field_selected #input_'+ field.id + '_2').attr('placeholder', e.currentTarget.value);
        },
        inputPlaceholderAddressCityOnKeyUp : function( e ) {
            SetFieldProperty('placeholderAddressCity', e.currentTarget.value );
            var field = GetSelectedField();
            $('#field_'+ field.id + '.field_selected #input_'+ field.id + '_3').attr('placeholder', e.currentTarget.value);
        },
        inputPlaceholderAddressStateOnKeyUp : function( e ) {
            SetFieldProperty('placeholderAddressState', e.currentTarget.value );
            var field = GetSelectedField();
            $('#field_'+ field.id + '.field_selected input[name="input_'+ field.id + '.4"]' ).attr('placeholder', e.currentTarget.value);
        },
        inputPlaceholderAddressZipOnKeyUp : function( e ) {
            SetFieldProperty('placeholderAddressZip', e.currentTarget.value );
            var field = GetSelectedField();
            $('#field_'+ field.id + '.field_selected #input_'+ field.id + '_5' ).attr('placeholder', e.currentTarget.value);
        },

    });

    // Placeholder Date Setting Editor
    GFViews.PlaceholderDateSettingEditor = GFViews.FieldSettingEditor.extend({
        el: 'li.placeholder_date_setting.field_setting',
        fieldSettingClass: 'placeholder_date_setting',
        fieldTypesSupported : [ 'date' ],
        events: {
            'keyup input#placeholder_date'              : 'inputPlaceholderDateOnKeyUp',
            'keyup input#placeholder_date_day'          : 'inputPlaceholderDateDayOnKeyUp',
            'keyup input#placeholder_date_month'        : 'inputPlaceholderDateMonthOnKeyUp',
            'keyup input#placeholder_date_year'         : 'inputPlaceholderDateYearOnKeyUp',
        },
        initialize: function(){

            // Initialize our object
            this.events = _.extend({}, GFViews.FieldSettingEditor.prototype.events,this.events);
            this.template  = _.template( this.$('#tmpl-gf-placeholder-date-setting').html() );
            this.container = this.$('#placeholder_date_setting_container');
            
            // Bind this to our events
            _.bindAll(this, "refresh");

            // Listen to our events
            wp.GravityForms.Editor.Events.bind( "selectDateInputTypeOnChange", this.refresh );

        },
        model : function ( field ){

            var model = { 
                    field : {
                        id:                         field.id,
                        type:                       field.type,
                        dateType:                   'undefined' === typeof field['dateType'] || '' === field.dateType   ? 'datepicker'  : field.dateType,
                        placeholder:                'undefined' === typeof field['placeholder']                         ? ''            : field.placeholder,
                        placeholderDateDay:         'undefined' === typeof field['placeholderDateDay']                  ? ''            : field.placeholderDateDay,
                        placeholderDateMonth:       'undefined' === typeof field['placeholderDateMonth']                ? ''            : field.placeholderDateMonth,
                        placeholderDateYear:        'undefined' === typeof field['placeholderDateYear']                 ? ''            : field.placeholderDateYear,
                    },
                };

            return model;
        },

        // Events
        inputPlaceholderDateOnKeyUp : function( e ) {
            SetFieldProperty('placeholder', e.currentTarget.value );
            var field = GetSelectedField();
            $('#field_'+ field.id + '.field_selected input[name="ginput_datepicker"]').attr('placeholder', e.currentTarget.value);
        },
        inputPlaceholderDateDayOnKeyUp : function( e ) {
            SetFieldProperty('placeholderDateDay', e.currentTarget.value );
            var field = GetSelectedField();
            $('#field_'+ field.id + '.field_selected input[name="ginput_day"]').attr('placeholder', e.currentTarget.value);
        },
        inputPlaceholderDateMonthOnKeyUp : function( e ) {
            SetFieldProperty('placeholderDateMonth', e.currentTarget.value );
            var field = GetSelectedField();
            $('#field_'+ field.id + '.field_selected input[name="ginput_month"]').attr('placeholder', e.currentTarget.value);
        },
        inputPlaceholderDateYearOnKeyUp : function( e ) {
            SetFieldProperty('placeholderDateYear', e.currentTarget.value );
            var field = GetSelectedField();
            $('#field_'+ field.id + '.field_selected input[name="ginput_year"]' ).attr('placeholder', e.currentTarget.value);
        },

    });

    // Placeholder Time Setting Editor
    GFViews.PlaceholderTimeSettingEditor = GFViews.FieldSettingEditor.extend({
        el: 'li.placeholder_time_setting.field_setting',
        fieldSettingClass: 'placeholder_time_setting',
        fieldTypesSupported : [ 'time' ],
        events: {
            'keyup input#placeholder_time_hour'          : 'inputPlaceholderTimeHourOnKeyUp',
            'keyup input#placeholder_time_minute'        : 'inputPlaceholderTimeMinuteOnKeyUp',
        },
        initialize: function(){

            // Initialize our object
            this.events = _.extend({}, GFViews.FieldSettingEditor.prototype.events,this.events);
            this.template  = _.template( this.$('#tmpl-gf-placeholder-time-setting').html() );
            this.container = this.$('#placeholder_time_setting_container');

            // Bind this to our events
            _.bindAll(this, "refresh");

        },
        model : function ( field ){

            var model = { 
                    field : {
                        id:                         field.id,
                        type:                       field.type,
                        placeholderTimeHour:        'undefined' === typeof field['placeholderTimeHour']         ? ''                : field.placeholderTimeHour,
                        placeholderTimeMinute:      'undefined' === typeof field['placeholderTimeMinute']       ? ''                : field.placeholderTimeMinute,
                    },
                };

            return model;
        },

        // Events
        inputPlaceholderTimeHourOnKeyUp : function( e ) {
            SetFieldProperty('placeholderTimeHour', e.currentTarget.value );
            var field = GetSelectedField();
            $('#field_'+ field.id + '.field_selected #input_'+ field.id + '_1').attr('placeholder', e.currentTarget.value);
        },
        inputPlaceholderTimeMinuteOnKeyUp : function( e ) {
            SetFieldProperty('placeholderTimeMinute', e.currentTarget.value );
            var field = GetSelectedField();
            $('#field_'+ field.id + '.field_selected #input_'+ field.id + '_2').attr('placeholder', e.currentTarget.value);
        },

    });

    // Placeholder Product Setting Editor
    GFViews.PlaceholderProductSettingEditor = GFViews.FieldSettingEditor.extend({
        el: 'li.placeholder_product_setting.field_setting',
        fieldSettingClass: 'placeholder_product_setting',
        fieldTypesSupported : [ 'product' ],
        events: {
            'keyup input#placeholder_product'      : 'inputPlaceholderProductOnKeyUp',
        },
        initialize: function(){

            // Initialize our object
            this.events = _.extend({}, GFViews.FieldSettingEditor.prototype.events,this.events);
            this.template  = _.template( this.$('#tmpl-gf-placeholder-product-setting').html() );
            this.container = this.$('#placeholder_product_setting_container');

            // Bind this to our events
            _.bindAll(this, "refresh");
            _.bindAll(this, "inputFieldDisableQuantityOnClick"); 
    
            // Listen to our events
            wp.GravityForms.Editor.Events.bind( "selectProductFieldTypeOnChange", this.refresh );
            wp.GravityForms.Editor.Events.bind( "inputFieldDisableQuantityOnClick", this.inputFieldDisableQuantityOnClick );

        },
        model : function ( field ){

            var model = { 
                    field : {
                        id:                         field.id,
                        type:                       field.type,
                        inputType:                  'undefined' === typeof field['inputType'] || '' === field.inputType     ? 'singleproduct'   : field.inputType,
                        disableQuantity:            field['disableQuantity'] || false,
                        placeholder:                'undefined' === typeof field['placeholder']                             ? ''                : field.placeholder,
                    },
                };

            return model;
        },
        refresh: function(){
            var field = GetSelectedField(),
                placeholder = field.placeholder || '',
                inputType = field.inputType || 'singleproduct';

            if ( 'singleproduct' === inputType || 'calculation' === inputType ) {
                $('#field_'+ field.id + '.field_selected input[name="input_' + field.id + '.3"]').attr('placeholder', placeholder);
            } else if ( 'price' === inputType ) {
                $('#field_'+ field.id + '.field_selected #input_'+ field.id).attr('placeholder', placeholder);
            }
            this.render( field );
        },

        // Events
        inputPlaceholderProductOnKeyUp : function( e ) {
            SetFieldProperty('placeholder', e.currentTarget.value );
            var field = GetSelectedField(),
                placeholder = e.currentTarget.value,
                inputType = field.inputType || 'singleproduct';

            if ( 'singleproduct' === inputType || 'calculation' === inputType ) {
                $('#field_'+ field.id + '.field_selected input[name="input_' + field.id + '.3"]').attr('placeholder', placeholder);
            } else if ( 'price' === inputType ) {
                $('#field_'+ field.id + '.field_selected #input_'+ field.id).attr('placeholder', placeholder);
            }
        },
        inputFieldDisableQuantityOnClick : function ( e ) {
            var field = GetSelectedField(),
                placeholder = field.placeholder || '';

            if ( !e.currentTarget.checked ) {
                $('#field_'+ field.id + '.field_selected input[name="input_' + field.id + '.3"]').attr('placeholder', placeholder);
            }
            this.refresh();
        },

    });

    GFViews.LabelVisibleSettingEditor = GFViews.FieldSettingEditor.extend({
        el: 'li.label_setting.field_setting',
        fieldSettingClass : 'label_setting',
        fieldTypesSupported : [], // will be configured in the initialize function
        events: {
            'click input#label_visible'             : 'inputLabelVisibleOnClick',
        },
        initialize: function(){

            // Get all the types that support the label_setting
            for( var fieldType in fieldSettings ){
                if (String(fieldSettings[fieldType]).indexOf("." + this.fieldSettingClass) !== -1)
                    this.fieldTypesSupported.push( fieldType );
            }

            // Initialize our object
            this.events = _.extend({}, GFViews.FieldSettingEditor.prototype.events,this.events);
            this.template  = _.template( $('#tmpl-gf-label-setting').html() );

            // Bind this to our events
            _.bindAll(this, "refresh");

            // Move setting to the top
            this.$el.parent().prepend( this.$el );

            // Create and inject our custom container
            this.$('input#field_label').after('<div id="label_visible_setting_container"></div>');
            this.container = this.$('#label_visible_setting_container');

        },
        model : function ( field ){
            var model = { 
                field : {
                    id: field.id,
                    type: field.type,
                    labelVisible: typeof field['labelVisible'] !== 'undefined' ? field.labelVisible : true ,
                }
            };
            return model;
        },

        // Events
        inputLabelVisibleOnClick : function( e ) {
            SetFieldProperty('labelVisible', e.currentTarget.checked );
            var field = GetSelectedField();
            $('.field_selected' ).toggleClass( 'gfield_label_hidden', e.currentTarget.checked === false );
            if( 'section' === field.type) {
                $('.field_selected h2.gsection_title').toggle( e.currentTarget.checked );
            } else {
                $('.field_selected label.gfield_label').toggle( e.currentTarget.checked );
            }
        },

    });

    GFViews.EmailLabelSettingEditor = GFViews.FieldSettingEditor.extend({
        el: 'li.email_label_setting.field_setting',
        fieldSettingClass : 'email_label_setting',
        fieldTypesSupported : [ 'email' ],  
        events: {
            'click input#label_enter_email_visible'     : 'inputLabelEnterEmailVisibleOnClick',
            'keyup input#label_enter_email'             : 'inputLabelEnterEmailOnKeyUp',
            'click input#label_confirm_email_visible'   : 'inputLabelConfirmEmailVisibleOnClick',
            'keyup input#label_confirm_email'           : 'inputLabelConfirmEmailOnKeyUp',
        },
        initialize: function(){

            // Initialize our object
            this.events = _.extend({}, GFViews.FieldSettingEditor.prototype.events,this.events);
            this.template  = _.template( $('#tmpl-gf-email-label-setting').html() );
            this.container = this.$('#email_label_setting_container');
            
            // Bind this to our events
            _.bindAll(this, "refresh");
            _.bindAll(this, "inputEmailConfirmEnabledOnClick");

            // Listen to our events
            wp.GravityForms.Editor.Events.bind("inputEmailConfirmEnabledOnClick", this.inputEmailConfirmEnabledOnClick);

        },
        model : function ( field ){
            var model = { 
                field : {
                    id:                         field.id,
                    type:                       field.type,
                    emailConfirmEnabled:        'undefined' === typeof field['emailConfirmEnabled']         ? false         : field.emailConfirmEnabled,
                    labelEnterEmailVisible:     'undefined' === typeof field['labelEnterEmailVisible']      ? true          : field.labelEnterEmailVisible,
                    labelEnterEmail:            'undefined' === typeof field['labelEnterEmail']             ? null          : field.labelEnterEmail,
                    labelConfirmEmailVisible:   'undefined' === typeof field['labelConfirmEmailVisible']    ? true          : field.labelConfirmEmailVisible,
                    labelConfirmEmail:          'undefined' === typeof field['labelConfirmEmail']           ? null          : field.labelConfirmEmail,
                }
            };
            return model;
        },

        // Events
        inputEmailConfirmEnabledOnClick: function( e ){
            this.$el.hide();
            this.refresh();
            this.$el.toggle( e.currentTarget.checked );
        },
        inputLabelEnterEmailVisibleOnClick: function( e ){
            SetFieldProperty('labelEnterEmailVisible', e.currentTarget.checked);
            var field = GetSelectedField();
            $('#field_'+ field.id + '.field_selected label[for="input_'+ field.id + '"]:not(.gfield_label)').toggle(e.currentTarget.checked);
            this.refresh();
        },
        inputLabelEnterEmailOnKeyUp: function( e ){
            SetFieldProperty('labelEnterEmail', e.currentTarget.value);
            var field = GetSelectedField();
            $('#field_'+ field.id + '.field_selected label[for="input_'+ field.id + '"]:not(.gfield_label)').text(e.currentTarget.value);
            wp.GravityForms.Editor.Events.trigger("inputLabelEnterEmailOnKeyUp", e );
        },
        inputLabelConfirmEmailVisibleOnClick: function( e ){
            SetFieldProperty('labelConfirmEmailVisible', e.currentTarget.checked);
            var field = GetSelectedField();
            $('#field_'+ field.id + '.field_selected label[for="input_'+ field.id + '_2"]').toggle(e.currentTarget.checked);
            this.refresh();
        },
        inputLabelConfirmEmailOnKeyUp: function( e ){
            SetFieldProperty('labelConfirmEmail', e.currentTarget.value);
            var field = GetSelectedField();
            $('#field_'+ field.id + '.field_selected .ginput_confirm_email label[for="input_'+ field.id + '_2"]').text(e.currentTarget.value);
            wp.GravityForms.Editor.Events.trigger("inputLabelConfirmEmailOnKeyUp", e );
        },

    });


    GFViews.NameLabelSettingEditor = GFViews.FieldSettingEditor.extend({
        el: 'li.name_label_setting.field_setting',
        fieldSettingClass : 'name_label_setting',
        fieldTypesSupported : [ 'name' ],  
        events: {
            'click input#label_name_prefix_visible'     : 'inputLabelNamePrefixVisibleOnClick',
            'keyup input#label_name_prefix'             : 'inputLabelNamePrefixOnKeyUp',
            'click input#label_name_first_visible'      : 'inputLabelNameFirstVisibleOnClick',
            'keyup input#label_name_first'              : 'inputLabelNameFirstOnKeyUp',
            'click input#label_name_last_visible'       : 'inputLabelNameLastVisibleOnClick',
            'keyup input#label_name_last'               : 'inputLabelNameLastOnKeyUp',
            'click input#label_name_suffix_visible'     : 'inputLabelNameSuffixVisibleOnClick',
            'keyup input#label_name_suffix'             : 'inputLabelNameSuffixOnKeyUp',
        },
        initialize: function(){

            // Initialize our object
            this.events = _.extend({}, GFViews.FieldSettingEditor.prototype.events,this.events);
            this.template  = _.template( $('#tmpl-gf-name-label-setting').html() );
            this.container = this.$('#name_label_setting_container');
            
            // Bind this to our events
            _.bindAll(this, "refresh");

        },
        model : function ( field ){
            var model = { 
                field : {
                    id:                         field.id,
                    type:                       field.type,
                    nameFormat:                 'undefined' === typeof field['nameFormat'] || '' === field.nameFormat   ? 'normal'  : field.nameFormat,
                    labelNamePrefixVisible:     'undefined' === typeof field['labelNamePrefixVisible']                  ? true      : field.labelNamePrefixVisible,
                    labelNamePrefix:            'undefined' === typeof field['labelNamePrefix']                         ? null      : field.labelNamePrefix,
                    labelNameFirstVisible:      'undefined' === typeof field['labelNameFirstVisible']                   ? true      : field.labelNameFirstVisible,
                    labelNameFirst:             'undefined' === typeof field['labelNameFirst']                          ? null      : field.labelNameFirst,
                    labelNameLastVisible:       'undefined' === typeof field['labelNameLastVisible']                    ? true      : field.labelNameLastVisible,
                    labelNameLast:              'undefined' === typeof field['labelNameLast']                           ? null      : field.labelNameLast,
                    labelNameSuffixVisible:     'undefined' === typeof field['labelNameSuffixVisible']                  ? true      : field.labelNameSuffixVisible,
                    labelNameSuffix:            'undefined' === typeof field['labelNameSuffix']                         ? null      : field.labelNameSuffix,
                }
            };
            return model;
        },

        // Events
        selectAddressTypeOnClick: function( e ){
            this.$el.hide();
            this.refresh();
            this.$el.toggle( e.currentTarget.checked );
        },
        inputLabelNamePrefixVisibleOnClick: function( e ){
            SetFieldProperty('labelNamePrefixVisible', e.currentTarget.checked);
            var field = GetSelectedField();
            $('#field_'+ field.id + '.field_selected label[for="input_'+ field.id + '_2"]:not(.gfield_label)').toggle(e.currentTarget.checked);
            this.refresh();
        },
        inputLabelNamePrefixOnKeyUp: function( e ){
            SetFieldProperty('labelNamePrefix', e.currentTarget.value);
            var field = GetSelectedField();
            $('#field_'+ field.id + '.field_selected label[for="input_'+ field.id + '_2"]:not(.gfield_label)').text(e.currentTarget.value);
            wp.GravityForms.Editor.Events.trigger("inputLabelNamePrefixOnKeyUp", e );
        },
        inputLabelNameFirstVisibleOnClick: function( e ){
            SetFieldProperty('labelNameFirstVisible', e.currentTarget.checked);
            var field = GetSelectedField();
            $('#field_'+ field.id + '.field_selected label[for="input_'+ field.id + '_3"]:not(.gfield_label)').toggle(e.currentTarget.checked);
            this.refresh();
        },
        inputLabelNameFirstOnKeyUp: function( e ){
            SetFieldProperty('labelNameFirst', e.currentTarget.value);
            var field = GetSelectedField();
            $('#field_'+ field.id + '.field_selected label[for="input_'+ field.id + '_3"]:not(.gfield_label)').text(e.currentTarget.value);
            wp.GravityForms.Editor.Events.trigger("inputLabelNameFirstOnKeyUp", e );
        },
        inputLabelNameLastVisibleOnClick: function( e ){
            SetFieldProperty('labelNameLastVisible', e.currentTarget.checked);
            var field = GetSelectedField();
            $('#field_'+ field.id + '.field_selected label[for="input_'+ field.id + '_6"]').toggle(e.currentTarget.checked);
            this.refresh();
        },
        inputLabelNameLastOnKeyUp: function( e ){
            SetFieldProperty('labelNameLast', e.currentTarget.value);
            var field = GetSelectedField();
            $('#field_'+ field.id + '.field_selected label[for="input_'+ field.id + '_6"]').text(e.currentTarget.value);
            wp.GravityForms.Editor.Events.trigger("inputLabelNameLastOnKeyUp", e );
        },
        inputLabelNameSuffixVisibleOnClick: function( e ){
            SetFieldProperty('labelNameSuffixVisible', e.currentTarget.checked);
            var field = GetSelectedField();
            $('#field_'+ field.id + '.field_selected label[for="input_'+ field.id + '_8"]').toggle(e.currentTarget.checked);
            this.refresh();
        },
        inputLabelNameSuffixOnKeyUp: function( e ){
            SetFieldProperty('labelNameSuffix', e.currentTarget.value);
            var field = GetSelectedField();            
            $('#field_'+ field.id + '.field_selected label[for="input_'+ field.id + '_8"]').text(e.currentTarget.value);
            wp.GravityForms.Editor.Events.trigger("inputLabelNameSuffixOnKeyUp", e );
        },

    });
    
    // Address Label Setting
    GFViews.AddressLabelSettingEditor = GFViews.FieldSettingEditor.extend({
        el: 'li.address_label_setting.field_setting',
        fieldSettingClass : 'address_label_setting',
        fieldTypesSupported : [ 'address' ],  
        events: {
            'click input#label_address_street_visible'          : 'inputLabelAddressStreetVisibleOnClick',
            'keyup input#label_address_street'                  : 'inputLabelAddressStreetOnKeyUp',
            'click input#label_address_street2_visible'         : 'inputLabelAddressStreet2VisibleOnClick',
            'keyup input#label_address_street2'                 : 'inputLabelAddressStreet2OnKeyUp',
            'click input#label_address_city_visible'            : 'inputLabelAddressCityVisibleOnClick',
            'keyup input#label_address_city'                    : 'inputLabelAddressCityOnKeyUp',
            'click input#label_address_state_visible'           : 'inputLabelAddressStateVisibleOnClick',
            'keyup input#label_address_state'                   : 'inputLabelAddressStateOnKeyUp',
            'click input#label_address_zip_visible'             : 'inputLabelAddressZipVisibleOnClick',
            'keyup input#label_address_zip'                     : 'inputLabelAddressZipOnKeyUp',
            'click input#label_address_country_visible'         : 'inputLabelAddressCountryVisibleOnClick',
            'keyup input#label_address_country'                 : 'inputLabelAddressCountryOnKeyUp',
        },
        initialize: function(){

            // Initialize our object
            this.events = _.extend({}, GFViews.FieldSettingEditor.prototype.events,this.events);
            this.template  = _.template( $('#tmpl-gf-address-label-setting').html() );
            this.container = this.$('#address_label_setting_container');
            
            // Bind this to our events
            _.bindAll(this, "refresh");

            // Listen to our events
            wp.GravityForms.Editor.Events.bind( "selectAddressTypeOnChange", this.refresh );
            wp.GravityForms.Editor.Events.bind( "inputHideAddressStreet2OnClick", this.refresh );
            wp.GravityForms.Editor.Events.bind( "inputHideStateOnClick", this.refresh );
            wp.GravityForms.Editor.Events.bind( "inputHideCountryOnClick", this.refresh );

            // Override the default UpdateAddressFields Function
            var UpdateAddressFieldsProxy = window.UpdateAddressFields;
            window.UpdateAddressFields = function ()
            {
                UpdateAddressFieldsProxy();
                var addressType = $("#field_address_type").val(),
                    field = GetSelectedField();

                // Change back the State / Province label
                var state_label = 'undefined' === typeof field['labelAddressState'] ? $("#field_address_state_label_" + addressType).val() : field.labelAddressState;
                $(".field_selected #input_" + field["id"] + "_4_label").html( state_label );

                // Change back the Zip / Postal label
                var zip_label = 'undefined' === typeof field['labelAddressZip'] ? $("#field_address_zip_label_" + addressType).val() : field.labelAddressZip;
                $(".field_selected #input_" + field["id"] + "_5_label").html( zip_label );

            };

        },
        model : function ( field ){
            
            var addressType = $("#field_address_type").val();

            return { 
                field : {
                    id:                             field.id,
                    type:                           field.type,
                    addressType:                    'undefined' === typeof field['addressType'] || '' === field.addressType     ? 'international'   : field.addressType,
                    hideAddress2:                   'undefined' === typeof field['hideAddress2']                                ? false             : field.hideAddress2,
                    hideCountry:                    'undefined' === typeof field['hideCountry']                                 ? false             : field.hideCountry,
                    hideState:                      'undefined' === typeof field['hideState']                                   ? false             : field.hideState,
                    labelAddressStreetVisible:      'undefined' === typeof field['labelAddressStreetVisible']                   ? true              : field.labelAddressStreetVisible,
                    labelAddressStreet:             'undefined' === typeof field['labelAddressStreet']                          ? ''                : field.labelAddressStreet,
                    labelAddressStreet2Visible:     'undefined' === typeof field['labelAddressStreet2Visible']                  ? true              : field.labelAddressStreet2Visible,
                    labelAddressStreet2:            'undefined' === typeof field['labelAddressStreet2']                         ? ''                : field.labelAddressStreet2,
                    labelAddressCityVisible:        'undefined' === typeof field['labelAddressCityVisible']                     ? true              : field.labelAddressCityVisible,
                    labelAddressCity:               'undefined' === typeof field['labelAddressCity']                            ? ''                : field.labelAddressCity,
                    labelAddressStateVisible:       'undefined' === typeof field['labelAddressStateVisible']                    ? true              : field.labelAddressStateVisible,
                    labelAddressState:              'undefined' === typeof field['labelAddressState']                           ? $("#field_address_state_label_" + addressType).val() : field.labelAddressState,
                    labelAddressZipVisible:         'undefined' === typeof field['labelAddressZipVisible']                      ? true              : field.labelAddressZipVisible,
                    labelAddressZip:                'undefined' === typeof field['labelAddressZip']                             ? $("#field_address_zip_label_" + addressType).val() : field.labelAddressZip,
                    labelAddressCountryVisible:     'undefined' === typeof field['labelAddressCountryVisible']                  ? true              : field.labelAddressCountryVisible,
                    labelAddressCountry:            'undefined' === typeof field['labelAddressCountry']                         ? ''                : field.labelAddressCountry,
                }
            };
        },

        // Events
        inputLabelAddressStreetVisibleOnClick: function( e ){
            SetFieldProperty('labelAddressStreetVisible', e.currentTarget.checked);
            var field = GetSelectedField();
            $('#field_'+ field.id + '.field_selected label[for="input_'+ field.id + '_1"]:not(.gfield_label)').toggle(e.currentTarget.checked);
            this.refresh();
        },
        inputLabelAddressStreetOnKeyUp: function( e ){
            SetFieldProperty('labelAddressStreet', e.currentTarget.value);
            var field = GetSelectedField();
            $('#field_'+ field.id + '.field_selected label[for="input_'+ field.id + '_1"]:not(.gfield_label)').text(e.currentTarget.value);
            wp.GravityForms.Editor.Events.trigger("inputLabelAddressStreetOnKeyUp", e );
        },
        inputLabelAddressStreet2VisibleOnClick: function( e ){
            SetFieldProperty('labelAddressStreet2Visible', e.currentTarget.checked);
            var field = GetSelectedField();
            $('#field_'+ field.id + '.field_selected label[for="input_'+ field.id + '_2"]').toggle(e.currentTarget.checked);
            this.refresh();
        },
        inputLabelAddressStreet2OnKeyUp: function( e ){
            SetFieldProperty('labelAddressStreet2', e.currentTarget.value);
            var field = GetSelectedField();
            $('#field_'+ field.id + '.field_selected label[for="input_'+ field.id + '_2"]').text(e.currentTarget.value);
            wp.GravityForms.Editor.Events.trigger("inputLabelAddressStreet2OnKeyUp", e );
        },
        inputLabelAddressCityVisibleOnClick: function( e ){
            SetFieldProperty('labelAddressCityVisible', e.currentTarget.checked);
            var field = GetSelectedField();
            $('#field_'+ field.id + '.field_selected label[for="input_'+ field.id + '_3"]').toggle(e.currentTarget.checked);
            this.refresh();
        },
        inputLabelAddressCityOnKeyUp: function( e ){
            SetFieldProperty('labelAddressCity', e.currentTarget.value);
            var field = GetSelectedField();
            $('#field_'+ field.id + '.field_selected label[for="input_'+ field.id + '_3"]').text(e.currentTarget.value);
            wp.GravityForms.Editor.Events.trigger("inputLabelAddressCityOnKeyUp", e );
        },
        inputLabelAddressStateVisibleOnClick: function( e ){
            SetFieldProperty('labelAddressStateVisible', e.currentTarget.checked);
            var field = GetSelectedField();
            $('#field_'+ field.id + '.field_selected label[for="input_'+ field.id + '_4"]').toggle(e.currentTarget.checked);
            this.refresh();
        },
        inputLabelAddressStateOnKeyUp: function( e ){
            SetFieldProperty('labelAddressState', e.currentTarget.value);
            var field = GetSelectedField();         
            $('#field_'+ field.id + '.field_selected label[for="input_'+ field.id + '_4"]').text(e.currentTarget.value);
            wp.GravityForms.Editor.Events.trigger("inputLabelAddressStateOnKeyUp", e );
        },
        inputLabelAddressZipVisibleOnClick: function( e ){
            SetFieldProperty('labelAddressZipVisible', e.currentTarget.checked);
            var field = GetSelectedField();
            $('#field_'+ field.id + '.field_selected label[for="input_'+ field.id + '_5"]').toggle(e.currentTarget.checked);
            this.refresh();
        },
        inputLabelAddressZipOnKeyUp: function( e ){
            SetFieldProperty('labelAddressZip', e.currentTarget.value); 
            var field = GetSelectedField();         
            $('#field_'+ field.id + '.field_selected label[for="input_'+ field.id + '_5"]').text(e.currentTarget.value);
            wp.GravityForms.Editor.Events.trigger("inputLabelAddressZipOnKeyUp", e );
        },
        inputLabelAddressCountryVisibleOnClick: function( e ){
            SetFieldProperty('labelAddressCountryVisible', e.currentTarget.checked);
            var field = GetSelectedField();
            $('#field_'+ field.id + '.field_selected label[for="input_'+ field.id + '_6"]').toggle(e.currentTarget.checked);
            this.refresh();
        },
        inputLabelAddressCountryOnKeyUp: function( e ){
            SetFieldProperty('labelAddressCountry', e.currentTarget.value);
            var field = GetSelectedField();      
            $('#field_'+ field.id + '.field_selected label[for="input_'+ field.id + '_6"]').text(e.currentTarget.value);
            wp.GravityForms.Editor.Events.trigger("inputLabelAddressCountryOnKeyUp", e );
        },

    });

    GFViews.DateLabelSettingEditor = GFViews.FieldSettingEditor.extend({
        el: 'li.date_label_setting.field_setting',
        fieldSettingClass : 'date_label_setting',
        fieldTypesSupported : [ 'date' ],  
        events: {
            'click input#label_date_day_visible'        : 'inputLabelDateDayVisibleOnClick',
            'keyup input#label_date_day'                : 'inputLabelDateDayOnKeyUp',
            'click input#label_date_month_visible'      : 'inputLabelDateMonthVisibleOnClick',
            'keyup input#label_date_month'              : 'inputLabelDateMonthOnKeyUp',
            'click input#label_date_year_visible'       : 'inputLabelDateYearVisibleOnClick',
            'keyup input#label_date_year'               : 'inputLabelDateYearOnKeyUp',
        },
        initialize: function(){

            // Initialize our object
            this.events = _.extend({}, GFViews.FieldSettingEditor.prototype.events,this.events);
            this.template  = _.template( $('#tmpl-gf-date-label-setting').html() );
            this.container = this.$('#date_label_setting_container');

            // Bind this to our events
            _.bindAll(this, "refresh");

            // Listen to our events
            wp.GravityForms.Editor.Events.bind( "selectDateInputTypeOnChange", this.refresh );

        },
        model : function ( field ){
            var model = { 
                field : {
                    id:                         field.id,
                    type:                       field.type,
                    dateType:                   'undefined' === typeof field['dateType'] || '' === field.dateType   ? 'datepicker' : field.dateType,
                    labelDateDayVisible:        'undefined' === typeof field['labelDateDayVisible']                 ? true         : field.labelDateDayVisible,
                    labelDateDay:               'undefined' === typeof field['labelDateDay']                        ? null         : field.labelDateDay,
                    labelDateMonthVisible:      'undefined' === typeof field['labelDateMonthVisible']               ? true         : field.labelDateMonthVisible,
                    labelDateMonth:             'undefined' === typeof field['labelDateMonth']                      ? null         : field.labelDateMonth,
                    labelDateYearVisible:       'undefined' === typeof field['labelDateYearVisible']                ? true         : field.labelDateYearVisible,
                    labelDateYear:              'undefined' === typeof field['labelDateYear']                       ? null         : field.labelDateYear,
                }
            };
            return model;
        },

        // Events
        inputLabelDateDayVisibleOnClick: function( e ){
            SetFieldProperty('labelDateDayVisible', e.currentTarget.checked);
            var field = GetSelectedField();
            $('#field_'+ field.id + '.field_selected .gfield_date_day label').toggle(e.currentTarget.checked);
            this.refresh();
        },
        inputLabelDateDayOnKeyUp: function( e ){
            SetFieldProperty('labelDateDay', e.currentTarget.value);
            var field = GetSelectedField();
            $('#field_'+ field.id + '.field_selected .gfield_date_day label').text(e.currentTarget.value);
            wp.GravityForms.Editor.Events.trigger("inputLabelEnterEmailOnKeyUp", e );
        },
        inputLabelDateMonthVisibleOnClick: function( e ){
            SetFieldProperty('labelDateMonthVisible', e.currentTarget.checked);
            var field = GetSelectedField();
            $('#field_'+ field.id + '.field_selected .gfield_date_month label').toggle(e.currentTarget.checked);
            this.refresh();
        },
        inputLabelDateMonthOnKeyUp: function( e ){
            SetFieldProperty('labelDateMonth', e.currentTarget.value);
            var field = GetSelectedField();
            $('#field_'+ field.id + '.field_selected .gfield_date_month label').text(e.currentTarget.value);
            wp.GravityForms.Editor.Events.trigger("inputLabelConfirmEmailOnKeyUp", e );
        },
        inputLabelDateYearVisibleOnClick: function( e ){
            SetFieldProperty('labelDateYearVisible', e.currentTarget.checked);
            var field = GetSelectedField();
            $('#field_'+ field.id + '.field_selected .gfield_date_year label').toggle(e.currentTarget.checked);
            this.refresh();
        },
        inputLabelDateYearOnKeyUp: function( e ){
            SetFieldProperty('labelDateYear', e.currentTarget.value);
            var field = GetSelectedField();
            $('#field_'+ field.id + '.field_selected .gfield_date_year label').text(e.currentTarget.value);
            wp.GravityForms.Editor.Events.trigger("inputLabelConfirmEmailOnKeyUp", e );
        },

    });

    GFViews.TimeLabelSettingEditor = GFViews.FieldSettingEditor.extend({
        el: 'li.time_label_setting.field_setting',
        fieldSettingClass : 'time_label_setting',
        fieldTypesSupported : [ 'time' ],  
        events: {
            'click input#label_time_hour_visible'        : 'inputLabelDateDayVisibleOnClick',
            'keyup input#label_time_hour'                : 'inputLabelDateDayOnKeyUp',
            'click input#label_time_minute_visible'      : 'inputLabelDateMonthVisibleOnClick',
            'keyup input#label_time_minute'              : 'inputLabelDateMonthOnKeyUp',
        },
        initialize: function(){

            // Initialize our object
            this.events = _.extend({}, GFViews.FieldSettingEditor.prototype.events,this.events);
            this.template  = _.template( $('#tmpl-gf-time-label-setting').html() );
            this.container = this.$('#time_label_setting_container');

            // Bind this to our events
            _.bindAll(this, "refresh");

        },
        model : function ( field ){
            var model = { 
                field : {
                    id:                         field.id,
                    type:                       field.type,
                    labelTimeHourVisible:       'undefined' === typeof field['labelTimeHourVisible']     ? true         : field.labelTimeHourVisible,
                    labelTimeHour:              'undefined' === typeof field['labelTimeHour']            ? null         : field.labelTimeHour,
                    labelTimeMinuteVisible:     'undefined' === typeof field['labelTimeMinuteVisible']   ? true         : field.labelTimeMinuteVisible,
                    labelTimeMinute:            'undefined' === typeof field['labelTimeMinute']          ? null         : field.labelTimeMinute,
                }
            };
            return model;
        },

        // Events
        inputLabelDateDayVisibleOnClick: function( e ){
            SetFieldProperty('labelTimeHourVisible', e.currentTarget.checked);
            var field = GetSelectedField();
            $('#field_'+ field.id + '.field_selected label[for="input_'+ field.id + '_1"]:not(.gfield_label)').toggle(e.currentTarget.checked);
            this.refresh();
        },
        inputLabelDateDayOnKeyUp: function( e ){
            SetFieldProperty('labelTimeHour', e.currentTarget.value);
            var field = GetSelectedField();
            $('#field_'+ field.id + '.field_selected label[for="input_'+ field.id + '_1"]:not(.gfield_label)').text(e.currentTarget.value);
            wp.GravityForms.Editor.Events.trigger("inputLabelEnterEmailOnKeyUp", e );
        },
        inputLabelDateMonthVisibleOnClick: function( e ){
            SetFieldProperty('labelTimeMinuteVisible', e.currentTarget.checked);
            var field = GetSelectedField();
            $('#field_'+ field.id + '.field_selected label[for="input_'+ field.id + '_2"]').toggle(e.currentTarget.checked);
            this.refresh();
        },
        inputLabelDateMonthOnKeyUp: function( e ){
            SetFieldProperty('labelTimeMinute', e.currentTarget.value);
            var field = GetSelectedField();
            $('#field_'+ field.id + '.field_selected label[for="input_'+ field.id + '_2"]').text(e.currentTarget.value);
            wp.GravityForms.Editor.Events.trigger("inputLabelConfirmEmailOnKeyUp", e );
        },
        
    });

    $(document).ready( function(){

        // Build-in Settings
        wp.GravityForms.Editor.FieldSettings['emailConfirm']        = new GFViews.EmailConfirmSettingEditor();
        wp.GravityForms.Editor.FieldSettings['rules']               = new GFViews.RulesSettingEditor();
        wp.GravityForms.Editor.FieldSettings['address']             = new GFViews.AddressSettingEditor();
        wp.GravityForms.Editor.FieldSettings['dateInputType']       = new GFViews.DateInputTypeSettingEditor();
        wp.GravityForms.Editor.FieldSettings['productFieldType']    = new GFViews.ProductFieldTypeSettingEditor();
        wp.GravityForms.Editor.FieldSettings['quantityFieldType']   = new GFViews.QuantityFieldTypeSettingEditor();
        wp.GravityForms.Editor.FieldSettings['postTagType']         = new GFViews.PostTagTypeSettingEditor();
        wp.GravityForms.Editor.FieldSettings['postCustomFieldType'] = new GFViews.PostCustomFieldTypeSettingEditor();
        wp.GravityForms.Editor.FieldSettings['disableQuantity']     = new GFViews.DisableQuantitySettingEditor();

        if ( GFSettings.is_gravityforms_html5_enabled ) {

            // Placeholder Settings
            wp.GravityForms.Editor.FieldSettings['placeholder']         = new GFViews.PlaceholderSettingEditor();
            wp.GravityForms.Editor.FieldSettings['placeholderEmail']    = new GFViews.PlaceholderEmailSettingEditor();
            wp.GravityForms.Editor.FieldSettings['placeholderName']     = new GFViews.PlaceholderNameSettingEditor();
            wp.GravityForms.Editor.FieldSettings['placeholderAddress']  = new GFViews.PlaceholderAddressSettingEditor();
            wp.GravityForms.Editor.FieldSettings['placeholderDate']     = new GFViews.PlaceholderDateSettingEditor();
            wp.GravityForms.Editor.FieldSettings['placeholderTime']     = new GFViews.PlaceholderTimeSettingEditor();
            wp.GravityForms.Editor.FieldSettings['placeholderProduct']  = new GFViews.PlaceholderProductSettingEditor();
        
        }
        
        // Label Settings
        wp.GravityForms.Editor.FieldSettings['labelVisible']        = new GFViews.LabelVisibleSettingEditor();
        wp.GravityForms.Editor.FieldSettings['emailLabel']          = new GFViews.EmailLabelSettingEditor();
        wp.GravityForms.Editor.FieldSettings['nameLabel']           = new GFViews.NameLabelSettingEditor();
        wp.GravityForms.Editor.FieldSettings['addressLabel']        = new GFViews.AddressLabelSettingEditor();
        wp.GravityForms.Editor.FieldSettings['dateLabel']           = new GFViews.DateLabelSettingEditor();
        wp.GravityForms.Editor.FieldSettings['timeLabel']           = new GFViews.TimeLabelSettingEditor();

    });

})(jQuery);