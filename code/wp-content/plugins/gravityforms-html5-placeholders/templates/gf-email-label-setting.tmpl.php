<li class="email_label_setting field_setting" style="display:none">
    <script type="text/html" id="tmpl-gf-email-label-setting">
        <% field.labelEnterEmail   = field.labelEnterEmail   || '<?php echo $this->_strings->labelEnterEmail->default; ?>'; %>
        <% field.labelConfirmEmail = field.labelConfirmEmail || '<?php echo $this->_strings->labelConfirmEmail->default; ?>'; %>
        <% if ( field.emailConfirmEnabled ) { %>
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
                <% // Enter Email Sub Label Setting %>
                <tr id="label_enter_email_settings_container" class="email_sublabel_setting extended" style="padding-top:4px;">
                    <td class="sublabel_setting_field">
                        <input type="checkbox" id="label_enter_email_visible" <% if ( field.labelEnterEmailVisible ) { %>checked="checked"<% } %>>
                        <label for="label_enter_email_visible" class="inline"><?php echo $this->_strings->labelEnterEmail->default; ?></label>
                    </td>
                    <td class="sublabel_setting_value">
                        <input type="text" id="label_enter_email" value="<%= field.labelEnterEmail %>" <% if ( false === field.labelEnterEmailVisible ) { %>disabled="disabled"<% } %>/>
                    </td>
                </tr>
                <% // Enter Email Sub Label Setting %>
                <tr id="label_confirm_email_settings_container" class="email_sublabel_setting extended" style="padding-top:4px;">
                    <td class="sublabel_setting_field">
                        <input type="checkbox" id="label_confirm_email_visible" <% if ( field.labelConfirmEmailVisible ) { %>checked="checked"<% } %>>
                        <label for="label_confirm_email_visible" class="inline"><?php echo $this->_strings->labelConfirmEmail->default; ?></label>
                    </td>
                    <td class="sublabel_setting_value">
                        <input type="text" id="label_confirm_email" value="<%= field.labelConfirmEmail %>" <% if ( false === field.labelConfirmEmailVisible ) { %>disabled="disabled"<% } %>/>
                    </td>
                </tr>
                </tbody>
            </table>
        <% } %>
    </script>
    <div id="email_label_setting_container">
        <!-- content dynamically created from javascript -->
    </div>
</li>