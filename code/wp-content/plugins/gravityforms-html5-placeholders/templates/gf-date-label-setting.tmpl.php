<li class="date_label_setting field_setting" style="display:none">
    <script type="text/html" id="tmpl-gf-date-label-setting">
        <% field.labelDateDay   = field.labelDateDay    || '<?php echo $this->_strings->labelDateDay->default; ?>'; %>
        <% field.labelDateMonth = field.labelDateMonth  || '<?php echo $this->_strings->labelDateMonth->default; ?>'; %>
        <% field.labelDateYear  = field.labelDateYear   || '<?php echo $this->_strings->labelDateYear->default; ?>'; %>
        <% if ( 'datefield' === field.dateType ) { %>
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
                <% // Date Day Sub Label Setting %>
                <tr id="label_date_day_settings_container" class="date_sublabel_setting extended" style="padding-top:4px;">
                    <td class="sublabel_setting_field">
                        <input type="checkbox" id="label_date_day_visible" <% if ( field.labelDateDayVisible ) { %>checked="checked"<% } %>>
                        <label for="label_date_day_visible" class="inline"><?php echo $this->_strings->labelDateDay->name; ?></label>
                    </td>
                    <td class="sublabel_setting_value">
                        <input type="text" id="label_date_day" value="<%= field.labelDateDay %>" <% if ( false === field.labelDateDayVisible ) { %>disabled="disabled"<% } %>/>
                    </td>
                </tr>
                <% // Date Month Sub Label Setting %>
                <tr id="label_date_month_settings_container" class="date_sublabel_setting extended" style="padding-top:4px;">
                    <td class="sublabel_setting_field">
                        <input type="checkbox" id="label_date_month_visible" <% if ( field.labelDateMonthVisible ) { %>checked="checked"<% } %>>
                        <label for="label_date_month_visible" class="inline"><?php echo $this->_strings->labelDateMonth->name; ?></label>
                    </td>
                    <td class="sublabel_setting_value">
                        <input type="text" id="label_date_month" value="<%= field.labelDateMonth %>" <% if ( false === field.labelDateMonthVisible ) { %>disabled="disabled"<% } %>/>
                    </td>
                </tr>
                <% // Date Year Sub Label Setting %>
                <tr id="label_date_year_settings_container" class="date_sublabel_setting extended" style="padding-top:4px;">
                    <td class="sublabel_setting_field">
                        <input type="checkbox" id="label_date_year_visible" <% if ( field.labelDateYearVisible ) { %>checked="checked"<% } %>>
                        <label for="label_date_year_visible" class="inline"><?php echo $this->_strings->labelDateYear->name; ?></label>
                    </td>
                    <td class="sublabel_setting_value">
                        <input type="text" id="label_date_year" value="<%= field.labelDateYear %>" <% if ( false === field.labelDateYearVisible ) { %>disabled="disabled"<% } %>/>
                    </td>
                </tr>
                </tbody>
            </table>
        <% } %>
    </script>
    <div id="date_label_setting_container">
        <!-- content dynamically created from javascript -->
    </div>
</li>