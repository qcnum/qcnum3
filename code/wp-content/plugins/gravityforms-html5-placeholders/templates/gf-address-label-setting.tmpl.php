<li class="address_label_setting field_setting" style="display:none">
    <script type="text/html" id="tmpl-gf-address-label-setting">
        <% field.labelAddressStreet  = field.labelAddressStreet || '<?php echo esc_js(apply_filters("gform_address_street_{$form_id}",apply_filters("gform_address_street", $this->_strings->labelAddressStreet->default, $form_id), $form_id)); ?>'; %>
        <% field.labelAddressStreet2  = field.labelAddressStreet2 || '<?php echo esc_js(apply_filters("gform_address_street2_{$form_id}",apply_filters("gform_address_street2", $this->_strings->labelAddressStreet2->default, $form_id), $form_id)); ?>'; %>
        <% field.labelAddressCity   = field.labelAddressCity  || '<?php echo esc_js(apply_filters("gform_address_city_{$form_id}",apply_filters("gform_address_city", $this->_strings->labelAddressCity->default, $form_id), $form_id));?>'; %>
        <?php foreach ($addressTypes as $key => $addressType) { ?>
        <% if ( '<?php echo esc_js($key) ?>' === field.addressType ) { %>
            <% field.labelAddressState      = field.labelAddressState   || '<?php echo esc_js(isset($addressType["state_label"]) ? $addressType["state_label"] : $this->_strings->labelAddressState->default); ?>'; %>
            <% field.labelAddressZip        = field.labelAddressZip     || '<?php echo esc_js(isset($addressType["zip_label"]) ? $addressType["zip_label"] : $this->_strings->labelAddressZip->default); ?>'; %>
            <% field.labelAddressCountry    = field.labelAddressCountry || '<?php echo esc_js(apply_filters("gform_address_country_{$form_id}",apply_filters("gform_address_country", $this->_strings->labelAddressCountry->default, $form_id), $form_id)); ?>'; %>
        <% } %>
        <?php } ?>
        <label>
            <?php echo $this->_strings->labels->plural->name; ?>
            <?php gform_tooltip( $this->_strings->labels->plural->tooltip ); ?>
        </label>
        <table class="field_setting_table" >
            <thead>
                <tr>
                    <th class="field_setting_field_col"><?php echo $this->_strings->labels->column->field; ?></th>
                    <th class="field_setting_value_col"><?php echo $this->_strings->labels->column->value; ?></th>
                </tr>
            </thead>
            <tbody>
                <% // Address Street Sub Label Setting %>
                <tr id="label_address_street_visible_container" class="address_sublabel_setting extended" style="padding-top:4px;">
                    <td class="sublabel_setting_field">
                        <input type="checkbox" id="label_address_street_visible" <% if ( field.labelAddressStreetVisible ) { %>checked="checked"<% } %>>
                        <label for="label_address_street_visible" class="inline"><?php echo esc_js(apply_filters("gform_address_street_{$form_id}",apply_filters("gform_address_street", $this->_strings->labelAddressStreet->default, $form_id), $form_id)); ?></label>
                    </td>
                    <td class="sublabel_setting_value">
                        <input type="text" id="label_address_street" value="<%= field.labelAddressStreet %>" <% if ( false === field.labelAddressStreetVisible ) { %>disabled="disabled"<% } %>/>
                    </td>
                </tr>
                <% // Address Street2 Sub Label Setting %>
                <% if ( false === field.hideAddress2 ) { %>
                <tr id="label_address_street2_visible_container" class="address_sublabel_setting extended" style="padding-top:4px;">
                    <td class="sublabel_setting_field">
                        <input type="checkbox" id="label_address_street2_visible" <% if ( field.labelAddressStreet2Visible ) { %>checked="checked"<% } %>>
                        <label for="label_address_street2_visible" class="inline"><?php echo esc_js(apply_filters("gform_address_street2_{$form_id}",apply_filters("gform_address_street2", $this->_strings->labelAddressStreet2->default, $form_id), $form_id)); ?></label>
                    </td>
                    <td class="sublabel_setting_value">
                        <input type="text" id="label_address_street2" value="<%= field.labelAddressStreet2 %>" <% if ( false === field.labelAddressStreet2Visible ) { %>disabled="disabled"<% } %>/>
                    </td>
                </tr>
                <% } %>
                <% // Address City Sub Label Setting %>
                <tr id="label_address_city_visible_container" class="address_sublabel_setting extended" style="padding-top:4px;">
                    <td class="sublabel_setting_field">
                        <input type="checkbox" id="label_address_city_visible" <% if ( field.labelAddressCityVisible ) { %>checked="checked"<% } %>>
                        <label for="label_address_city_visible" class="inline"><?php echo esc_js(apply_filters("gform_address_city_{$form_id}",apply_filters("gform_address_city", $this->_strings->labelAddressCity->default, $form_id), $form_id)); ?></label>
                    </td>
                    <td class="sublabel_setting_value">
                        <input type="text" id="label_address_city" value="<%= field.labelAddressCity %>" <% if ( false === field.labelAddressCityVisible ) { %>disabled="disabled"<% } %>/>
                    </td>
                </tr>
                <% // Address State / Province Sub Label Setting %>
                <% if ( false === field.hideState) { %>
                <tr id="label_address_state_visible_container" class="address_sublabel_setting extended" style="padding-top:4px;">
                    <td class="sublabel_setting_field">
                        <input type="checkbox" id="label_address_state_visible" <% if ( field.labelAddressStateVisible ) { %>checked="checked"<% } %>>
                        <?php foreach ($addressTypes as $key => $addressType) { ?>
                        <% if ( '<?php echo esc_js($key) ?>' === field.addressType ) { %>
                            <label for="label_address_state_visible" class="inline"><?php echo esc_js(isset($addressType["state_label"]) ? $addressType["state_label"] : $this->_strings->labelAddressState->default); ?></label>
                        <% } %>
                        <?php } ?>
                    </td>
                    <td class="sublabel_setting_value">
                        <input type="text" id="label_address_state" value="<%= field.labelAddressState %>" <% if ( false === field.labelAddressStateVisible ) { %>disabled="disabled"<% } %>/>
                    </td>
                </tr>
                <% } %>
                <% // Address Zip / Postal Sub Label Setting %>
                <tr id="label_address_zip_visible_container" class="address_sublabel_setting extended" style="padding-top:4px;">
                    <td class="sublabel_setting_field">
                        <input type="checkbox" id="label_address_zip_visible" <% if ( field.labelAddressZipVisible ) { %>checked="checked"<% } %>>
                        <?php foreach ($addressTypes as $key => $addressType) { ?>
                        <% if ( '<?php echo esc_js($key) ?>' === field.addressType ) { %>
                            <label for="label_address_zip_visible" class="inline"><?php echo esc_js(isset($addressType["zip_label"]) ? $addressType["zip_label"] : $this->_strings->labelAddressZip->default); ?></label>
                        <% } %>
                        <?php } ?>
                    </td>
                    <td class="sublabel_setting_value">
                        <input type="text" id="label_address_zip" value="<%= field.labelAddressZip %>" <% if ( false === field.labelAddressZipVisible ) { %>disabled="disabled"<% } %>/>
                    </td>
                </tr>
                <% // Address Country Sub Label Setting %>
                <% if ( 'international' === field.addressType && false === field.hideCountry ) { %>
                <tr id="label_address_country_visible_container" class="address_sublabel_setting extended" style="padding-top:4px;">
                    <td class="sublabel_setting_field">
                        <input type="checkbox" id="label_address_country_visible" <% if ( field.labelAddressCountryVisible ) { %>checked="checked"<% } %>>
                        <label for="label_address_country_visible" class="inline"><?php echo esc_js(apply_filters("gform_address_country_{$form_id}",apply_filters("gform_address_country", $this->_strings->labelAddressCountry->default, $form_id), $form_id)); ?></label>
                    </td>
                    <td class="sublabel_setting_value">
                        <input type="text" id="label_address_country" value="<%= field.labelAddressCountry %>" <% if ( false === field.labelAddressCountryVisible ) { %>disabled="disabled"<% } %>/>
                    </td>
                </tr>
                <% } %>
            </tbody>
        </table>
    </script>
    <div id="address_label_setting_container">
        <!-- content dynamically created from javascript -->
    </div>
</li>