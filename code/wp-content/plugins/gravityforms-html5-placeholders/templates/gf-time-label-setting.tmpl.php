<li class="time_label_setting field_setting" style="display:none">
    <script type="text/html" id="tmpl-gf-time-label-setting">
        <% field.labelTimeHour   = field.labelTimeHour    || '<?php echo $this->_strings->labelTimeHour->default; ?>'; %>
        <% field.labelTimeMinute = field.labelTimeMinute  || '<?php echo $this->_strings->labelTimeMinute->default; ?>'; %>
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
            <% // Time Hour Sub Label Setting %>
            <tr id="label_time_hour_settings_container" class="time_sublabel_setting extended" style="padding-top:4px;">
                <td class="sublabel_setting_field">
                    <input type="checkbox" id="label_time_hour_visible" <% if ( field.labelTimeHourVisible ) { %>checked="checked"<% } %>>
                    <label for="label_time_hour_visible" class="inline"><?php echo $this->_strings->labelTimeHour->name; ?></label>
                </td>
                <td class="sublabel_setting_value">
                    <input type="text" id="label_time_hour" value="<%= field.labelTimeHour %>" <% if ( false === field.labelTimeHourVisible ) { %>disabled="disabled"<% } %>/>
                </td>
            </tr>
            <% // Time Minute Sub Label Setting %>
            <tr id="label_time_minute_settings_container" class="time_sublabel_setting extended" style="padding-top:4px;">
                <td class="sublabel_setting_field">
                    <input type="checkbox" id="label_time_minute_visible" <% if ( field.labelTimeMinuteVisible ) { %>checked="checked"<% } %>>
                    <label for="label_time_minute_visible" class="inline"><?php echo $this->_strings->labelTimeMinute->name; ?></label>
                </td>
                <td class="sublabel_setting_value">
                    <input type="text" id="label_time_minute" value="<%= field.labelTimeMinute %>" <% if ( false === field.labelTimeMinuteVisible ) { %>disabled="disabled"<% } %>/>
                </td>
            </tr>
            </tbody>
        </table>
    </script>
    <div id="time_label_setting_container">
        <!-- content dynamically created from javascript -->
    </div>
</li>