<?php
/*
Plugin Name: WPHobby Settings API
Plugin URI: https://wphobby.com
Description: Custom Admin Pages and Settings.
Version: 1.0.0
Author: WPHobby
Author URI: https://wphobby.com
*/

/* Add Admin Page */
add_action( 'admin_menu', 'wphobby_settings_page' );

function wphobby_settings_page() {
    add_menu_page( 'WPHobby Settings API',
        'WPHobby',
        'manage_options',
        'wphobby-panel',
        'wphobby_panel_general'
    );
}
/* Register Use Settings */
add_action( 'admin_init', 'wphobby_register_settings' );

function wphobby_register_settings() {
    register_setting(
        'wphobby_settings_form', // A settings group name.
        'wphobby_settings_form_data' //The name of an option to sanitize and save.
    );

    add_settings_section( 'wphobby_section_general',
        '',
        'wphobby_section_general_output' ,
        'wphobby_panel_general'
    );
    add_settings_field( 'wphobby_field_text',
        __("WPHobby Field Text", "wphobby"),
        'wphobby_field_output',
        'wphobby_panel_general',
        'wphobby_section_general'
    );

}

/* Output Admin Page Content */
function wphobby_section_general_output() {
    echo "Display Settings";
}

function wphobby_field_output() {
    $options = get_option( 'wphobby_settings_form_data' );
    ?>
    <input type='text' name='wphobby_settings_form_data[wphobby_field_text]' value='<?php echo $options['wphobby_field_text']; ?>'>
    <?php
}

function wphobby_panel_general() {
    ?>
    <div class="inner-panel">
        <h3>General Settings</h3>
        <form id="wphobby-panel" method="post" action="options.php">
            <?php
            settings_fields( 'wphobby_settings_form' );
            do_settings_sections( 'wphobby_panel_general' );
            submit_button( 'Save' );
            ?>
        </form>
    </div>
    <?php
}











