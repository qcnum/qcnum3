<li class="name_label_setting field_setting" style="display:none">
    <script type="text/html" id="tmpl-gf-name-label-setting">
    <% if ( 'extended' === field.nameFormat || 'normal' === field.nameFormat ) { %>
        <% field.labelNamePrefix = field.labelNamePrefix || '<?php echo $this->_strings->labelNamePrefix->default; ?>'; %>
        <% field.labelNameFirst  = field.labelNameFirst  || '<?php echo $this->_strings->labelNameFirst->default; ?>'; %>
        <% field.labelNameLast   = field.labelNameLast   || '<?php echo $this->_strings->labelNameLast->default; ?>'; %>
        <% field.labelNameSuffix = field.labelNameSuffix || '<?php echo $this->_strings->labelNameSuffix->default; ?>'; %>
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
                <% // Name Prefix Sub Label Setting %>
                <% if ( field.nameFormat === 'extended' ) { %>
                <tr id="label_name_prefix_container" class="name_sublabel_setting extended" style="padding-top:4px;">
                    <td class="sublabel_setting_field">
                        <input type="checkbox" id="label_name_prefix_visible" <% if ( field.labelNamePrefixVisible ) { %>checked="checked"<% } %>>
                        <label for="label_name_prefix_visible" class="inline"><?php echo $this->_strings->labelNamePrefix->default; ?></label>
                    </td>
                    <td class="sublabel_setting_value">
                        <input type="text" id="label_name_prefix" value="<%= field.labelNamePrefix %>" <% if ( false === field.labelNamePrefixVisible ) { %>disabled="disabled"<% } %>/>
                    </td>
                </tr>
                <% } %>
                <% // Name First Sub Label Setting %>
                <tr id="label_name_first_container" class="name_sublabel_setting extended" style="padding-top:4px;">
                    <td class="sublabel_setting_field">
                        <input type="checkbox" id="label_name_first_visible" <% if ( field.labelNameFirstVisible ) { %>checked="checked"<% } %>>
                        <label for="label_name_first_visible" class="inline"><?php echo $this->_strings->labelNameFirst->default; ?></label>
                    </td>
                    <td class="sublabel_setting_value">
                        <input type="text" id="label_name_first" value="<%= field.labelNameFirst %>" <% if ( false === field.labelNameFirstVisible ) { %>disabled="disabled"<% } %>/>
                    </td>
                </tr>
                <% // Name Last Sub Label Setting %>
                <tr id="label_name_last_container" class="name_sublabel_setting extended" style="padding-top:4px;">
                    <td class="sublabel_setting_field">
                        <input type="checkbox" id="label_name_last_visible" <% if ( field.labelNameLastVisible ) { %>checked="checked"<% } %>>
                        <label for="label_name_last_visible" class="inline"><?php echo $this->_strings->labelNameLast->default; ?></label>
                    </td>
                    <td class="sublabel_setting_value">
                        <input type="text" id="label_name_last" value="<%= field.labelNameLast %>" <% if ( false === field.labelNameLastVisible ) { %>disabled="disabled"<% } %>/>
                    </td>
                </tr>
                <% if ( field.nameFormat === 'extended' ) { %>
                <tr id="label_name_suffix_container" class="name_sublabel_setting extended" style="padding-top:4px;">
                    <td class="sublabel_setting_field">
                        <input type="checkbox" id="label_name_suffix_visible" <% if ( field.labelNameSuffixVisible ) { %>checked="checked"<% } %>>
                        <label for="label_name_suffix_visible" class="inline"><?php echo $this->_strings->labelNameSuffix->default; ?></label>
                    </td>
                    <td class="sublabel_setting_value">
                        <input type="text" id="label_name_suffix" value="<%= field.labelNameSuffix %>" <% if ( false === field.labelNameSuffixVisible ) { %>disabled="disabled"<% } %>/>
                    </td>
                </tr>
                <% } %>
            </tbody>
         </table>
    <% } %>
    </script>
    <div id="name_label_setting_container">
        <!-- content dynamically created from javascript -->
    </div>
</li>