<li class="placeholder_email_setting field_setting" style="display:none">
    <script type="text/html" id="tmpl-gf-placeholder-email-setting">
    <% if ( field.emailConfirmEnabled === false ) { %>
        <div class="placeholder_email_container ginput_placeholder_email_simple">
            <label>
                <?php echo $this->_strings->placeholders->singular->name ?>
                <?php gform_tooltip( $this->_strings->placeholders->singular->tooltip ); ?>
            </label>
            <input type="text" id="placeholder_email" class="fieldwidth-3" value="<%- field.placeholder %>"/>
        </div>
    <% } %>
    <% if ( field.emailConfirmEnabled === true ) { %>
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
                <% // Email Placeholder Setting %>
                <tr id="placeholder_email_container" class="email_placeholder_setting" style="padding-top:4px;">
                    <td class="placeholder_setting_label">
                        <label for="placeholder_email" class="inline"><?php echo $this->_strings->labelEnterEmail->default; ?></label>
                    </td>
                    <td class="placeholder_setting_value">
                        <input type="text" id="placeholder_email" value="<%= field.placeholder %>" />
                    </td>
                </tr>
                <% // Email Placeholder Setting %>
                <tr id="placeholder_email_confirm_container" class="email_placeholder_setting" style="padding-top:4px;">
                    <td class="placeholder_setting_label">
                        <label for="placeholder_email_confirm" class="inline"><?php echo $this->_strings->labelConfirmEmail->default; ?></label>
                    </td>
                    <td class="placeholder_setting_value">
                        <input type="text" id="placeholder_email_confirm" value="<%= field.placeholderEmailConfirm %>" />
                    </td>
                </tr>
            </tbody>
        </table>
    <% } %>
    </script>
    <div id="placeholder_email_setting_container">
        <!-- content dynamically created from javascript -->
    </div>
</li>