<li class="placeholder_date_setting field_setting" style="display:none">
    <script type="text/html" id="tmpl-gf-placeholder-date-setting">
    <% if ( 'datepicker' === field.dateType ) { %>
        <div class="placeholder_date_container ginput_placeholder_email_simple">
            <label>
                <?php echo $this->_strings->placeholders->singular->name ?>
                <?php gform_tooltip( $this->_strings->placeholders->singular->tooltip ); ?>
            </label>
            <input type="text" id="placeholder_date" class="fieldwidth-3" value="<%- field.placeholder %>"/>
        </div>
    <% } %>
    <% if ( 'datefield' === field.dateType ) { %>
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
                <% // Date Day Placeholder Setting %>
                <tr id="placeholder_date_day_container" class="date_placeholder_setting" style="padding-top:4px;">
                    <td class="placeholder_setting_label">
                        <label for="placeholder_date_day" class="inline"><?php echo $this->_strings->labelDateDay->default; ?></label>
                    </td>
                    <td class="placeholder_setting_value">
                        <input type="text" id="placeholder_date_day" value="<%= field.placeholderDateDay %>" />
                    </td>
                </tr>
                <% // Date Day Placeholder Setting %>
                <tr id="placeholder_date_month_container" class="date_placeholder_setting" style="padding-top:4px;">
                    <td class="placeholder_setting_label">
                        <label for="placeholder_date_month" class="inline"><?php echo $this->_strings->labelDateMonth->default; ?></label>
                    </td>
                    <td class="placeholder_setting_value">
                        <input type="text" id="placeholder_date_month" value="<%= field.placeholderDateMonth %>" />
                    </td>
                </tr>
                <% // Date Year Placeholder Setting %>
                <tr id="placeholder_date_year_container" class="date_placeholder_setting" style="padding-top:4px;">
                    <td class="placeholder_setting_label">
                        <label for="placeholder_date_year" class="inline"><?php echo $this->_strings->labelDateYear->default; ?></label>
                    </td>
                    <td class="placeholder_setting_value">
                        <input type="text" id="placeholder_date_year" value="<%= field.placeholderDateYear %>" />
                    </td>
                </tr>
            </tbody>
        </table>    
    <% } %>
    </script>
    <div id="placeholder_date_setting_container">
        <!-- content dynamically created from javascript -->
    </div>
</li>