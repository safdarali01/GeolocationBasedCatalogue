
jQuery(document).ready(function($)
{ 

    $("#gbc_settings_tab_product_dropdown").select2();
    $("#gbc_settings_tab_category_dropdown").select2();
    
    $("#gbc_settings_tab_geolocation_checkbox").click(function()
    {
        if( $("#gbc_settings_tab_geolocation_checkbox").prop('checked') )
        {
            $('#gbc_settings_tab_product_dropdown').parent().show();
            $('#gbc_settings_tab_product_dropdown').parent().siblings().show();
            $('#gbc_settings_tab_category_dropdown').parent().show();
            $('#gbc_settings_tab_category_dropdown').parent().siblings().show();
        }
        else{
            $('#gbc_settings_tab_product_dropdown').parent().hide();
            $('#gbc_settings_tab_product_dropdown').parent().siblings().hide();
            $('#gbc_settings_tab_category_dropdown').parent().hide();
            $('#gbc_settings_tab_category_dropdown').parent().siblings().hide();

        }
    });
});