<li class="placeholder_address_setting field_setting" style="display:none">
    <script type="text/html" id="tmpl-gf-placeholder-address-setting">
        <label>
            <?php echo $this->_strings->placeholders->plural->name; ?>
            <?php gform_tooltip( $this->_strings->placeholders->plural->tooltip ); ?>
        </label>
         <table class="field_setting_table" >
            <thead>
                <tr>
                    <th class="field_setting_field_col"><?php echo $this->_strings->placeholders->column->field; ?></th>
                    <th class="field_setting_value_col"><?php echo $this->_strings->placeholders->column->value; ?></th>
                </tr>
            </thead>
            <tbody>
                <% // Address Street Placeholder Setting %>
                <tr id="placeholder_address_street_container" class="address_placeholder_setting" style="padding-top:4px;">
                    <td class="placeholder_setting_label">
                        <label for="placeholder_address_street" class="inline"><?php echo esc_js(apply_filters("gform_address_street_{$form_id}",apply_filters("gform_address_street", $this->_strings->labelAddressStreet->default, $form_id), $form_id)); ?></label>
                    </td>
                    <td class="placeholder_setting_value">
                        <input type="text" id="placeholder_address_street" value="<%= field.placeholderAddressStreet %>" />
                    </td>
                </tr>
                <% // Address Street2 Placeholder Setting %>
                <% if ( false === field.hideAddress2 ) { %>
                <tr id="placeholder_address_street2_container" class="address_placeholder_setting" style="padding-top:4px;">
                    <td class="placeholder_setting_label">
                        <label for="placeholder_address_street2" class="inline"><?php echo esc_js(apply_filters("gform_address_street2_{$form_id}",apply_filters("gform_address_street2", $this->_strings->labelAddressStreet2->default, $form_id), $form_id)); ?></label>
                    </td>
                    <td class="placeholder_setting_value">
                        <input type="text" id="placeholder_address_street2" value="<%= field.placeholderAddressStreet2 %>" />
                    </td>
                </tr>
                <% } %>
                <% // Address City Placeholder Setting %>
                <tr id="placeholder_address_city_container" class="address_placeholder_setting" style="padding-top:4px;">
                    <td class="placeholder_setting_label">
                        <label for="placeholder_address_city" class="inline"><?php echo esc_js(apply_filters("gform_address_city_{$form_id}",apply_filters("gform_address_city", $this->_strings->labelAddressCity->default, $form_id), $form_id)); ?></label>
                    </td>
                    <td class="placeholder_setting_value">
                        <input type="text" id="placeholder_address_city" value="<%= field.placeholderAddressCity %>" />
                    </td>
                </tr>
                <% // Address State / Province Placeholder Setting %>
                <% if ( false === field.hideState && false === field.hasStateDropDown ) { %>
                <tr id="placeholder_address_state_container" class="address_placeholder_setting" style="padding-top:4px;">
                    <td class="placeholder_setting_label">
                        <?php foreach ($addressTypes as $key => $addressType) { ?>
                        <% if ( '<?php echo esc_js($key) ?>' === field.addressType ) { %>
                            <label for="placeholder_address_state" class="inline"><?php echo esc_js(isset($addressType["state_label"]) ? $addressType["state_label"] : $this->_strings->labelAddressState->default); ?></label>
                        <% } %>
                        <?php } ?>
                    </td>
                    <td class="placeholder_setting_value">
                        <input type="text" id="placeholder_address_state" value="<%= field.placeholderAddressState %>" />
                    </td>
                </tr>
                <% } %>
                <% // Address Zip / Postal Code Placeholder Setting %>
                <tr id="placeholder_address_zip_container" class="address_placeholder_setting" style="padding-top:4px;">
                    <td class="placeholder_setting_label">
                        <?php foreach ($addressTypes as $key => $addressType) { ?>
                        <% if ( '<?php echo esc_js($key) ?>' === field.addressType ) { %>
                            <label for="placeholder_address_zip" class="inline"><?php echo esc_js(isset($addressType["zip_label"]) ? $addressType["zip_label"] : $this->_strings->labelAddressZip->default); ?></label>
                        <% } %>
                        <?php } ?>
                    </td>
                    <td class="placeholder_setting_value">
                        <input type="text" id="placeholder_address_zip" value="<%= field.placeholderAddressZip %>" />
                    </td>
                </tr>
            </tbody>
        </table>
    </script>
    <div id="placeholder_address_setting_container">
        <!-- content dynamically created from javascript -->
    </div>
</li>