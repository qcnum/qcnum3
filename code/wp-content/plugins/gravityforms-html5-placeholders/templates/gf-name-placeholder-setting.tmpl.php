<li class="placeholder_name_setting field_setting" style="display:none">
    <script type="text/html" id="tmpl-gf-placeholder-name-setting">
    <% if ( 'simple' === field.nameFormat ) { %>
        <div class="placeholder_name_container ginput_placeholder_email_simple">
            <label>
                <?php echo $this->_strings->placeholders->singular->name ?>
                <?php gform_tooltip( $this->_strings->placeholders->singular->tooltip ); ?>
            </label>
            <input type="text" id="placeholder_name" class="fieldwidth-3" value="<%- field.placeholder %>"/>
        </div>
    <% } %>
    <% if ( 'normal' === field.nameFormat || 'extended' === field.nameFormat ) { %>
        <label>
            <?php echo $this->_strings->placeholders->plural->name ?>
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
                <% // Name Prefix Placeholder Setting %>
                <% if ( field.nameFormat === 'extended' ) { %>
                <tr id="placeholder_name_prefix_container" class="name_placeholder_setting" style="padding-top:4px;">
                    <td class="placeholder_setting_label">
                        <label for="placeholder_name_prefix" class="inline"><?php echo $this->_strings->labelNamePrefix->default; ?></label>
                    </td>
                    <td class="placeholder_setting_value">
                        <input type="text" id="placeholder_name_prefix" value="<%= field.placeholderNamePrefix %>" />
                    </td>
                </tr>
                <% } %>
                <% // Name First Placeholder Setting %>
                <tr id="placeholder_name_first_container" class="name_placeholder_setting" style="padding-top:4px;">
                    <td class="placeholder_setting_label">
                        <label for="placeholder_name_first" class="inline"><?php echo $this->_strings->labelNameFirst->default; ?></label>
                    </td>
                    <td class="placeholder_setting_value">
                        <input type="text" id="placeholder_name_first" value="<%= field.placeholderNameFirst %>" />
                    </td>
                </tr>
                <% // Name Last Placeholder Setting %>
                <tr id="placeholder_name_last_container" class="name_placeholder_setting" style="padding-top:4px;">
                    <td class="placeholder_setting_label">
                        <label for="placeholder_name_last" class="inline"><?php echo $this->_strings->labelNameLast->default; ?></label>
                    </td>
                    <td class="placeholder_setting_value">
                        <input type="text" id="placeholder_name_last" value="<%= field.placeholderNameLast %>" />
                    </td>
                </tr>
                <% // Name Suffix Placeholder Setting %>
                <% if ( field.nameFormat === 'extended' ) { %>
                <tr id="placeholder_name_suffix_container" class="name_placeholder_setting" style="padding-top:4px;">
                    <td class="placeholder_setting_label">
                        <label for="placeholder_name_suffix" class="inline"><?php echo $this->_strings->labelNameSuffix->default; ?></label>
                    </td>
                    <td class="placeholder_setting_value">
                        <input type="text" id="placeholder_name_suffix" value="<%= field.placeholderNameSuffix %>" />
                    </td>
                </tr>
                <% } %>
            </tbody>
        </table>    
    <% } %>
    </script>
    <div id="placeholder_name_setting_container">
        <!-- content dynamically created from javascript -->
    </div>
</li>