<li class="placeholder_time_setting field_setting" style="display:none">
    <script type="text/html" id="tmpl-gf-placeholder-time-setting">
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
                <% // Time Hour Placeholder Setting %>
                <tr id="placeholder_time_hour_container" class="time_placeholder_setting" style="padding-top:4px;">
                    <td class="placeholder_setting_label">
                        <label for="placeholder_time_hour" class="inline"><?php echo $this->_strings->labelTimeHour->name; ?></label>
                    </td>
                    <td class="placeholder_setting_value">
                        <input type="text" id="placeholder_time_hour" value="<%= field.placeholderTimeHour %>" />
                    </td>
                </tr>
                <% // Time Minute Placeholder Setting %>
                <tr id="placeholder_time_minute_container" class="time_placeholder_setting" style="padding-top:4px;">
                    <td class="placeholder_setting_label">
                        <label for="placeholder_time_minute" class="inline"><?php echo $this->_strings->labelTimeMinute->name; ?></label>
                    </td>
                    <td class="placeholder_setting_value">
                        <input type="text" id="placeholder_time_minute" value="<%= field.placeholderTimeMinute %>" />
                    </td>
                </tr>
            </tbody>
        </table>    
    </script>
    <div id="placeholder_time_setting_container">
        <!-- content dynamically created from javascript -->
    </div>
</li>