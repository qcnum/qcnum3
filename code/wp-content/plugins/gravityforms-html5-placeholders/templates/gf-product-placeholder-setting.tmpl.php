<li class="placeholder_product_setting field_setting" style="display:none">
    <script type="text/html" id="tmpl-gf-placeholder-product-setting">
        <% if ((("singleproduct" === field.inputType || "calculation" === field.inputType ) && !field.disableQuantity ) || "price" === field.inputType ) { %>
            <div class="placeholder_product_container ginput_placeholder_product">
                <label for="placeholder_product" >
                    <?php echo $this->_strings->placeholders->singular->name ?>
                    <?php gform_tooltip( $this->_strings->placeholders->singular->tooltip ); ?>
                </label>
                <input type="text" id="placeholder_product" class="fieldwidth-3" value="<%= field.placeholder %>" />
            </div>
        <% } %>
    </script>
    <div id="placeholder_product_setting_container">
        <!-- content dynamically created from javascript -->
    </div>
</li>