<?php
/**
 * Creates top level menu
 * and options page 
 * 
 * @package csh
 * @subpackage admin
 * @since 1.0.0
 * 
 */

if ( ! defined( 'ABSPATH' ) ) exit;

if ( ! class_exists( 'CSH_Admin' ) ) :
    
class CSH_Admin {


    /**
     * Adds top level menu -> WP CSS Shapes
     *
     * @uses action hook - admin_menu
     * 
     * @since 1.0.0
     * @return void
     */
    public function csh_options_page() {
        add_menu_page(
            'WP Shapes - Settings Page',
            'WP Shapes',
            'manage_options',
            'wp-shapes',
            array( $this, 'settings_page' ),
            'dashicons-heart'
        );
    }


    /**
     * Options page Content - 
     *   get settings form from a template settings_page.php
     * 
     * Call back from - $this->csh_options_page, add_menu_page
     *
     * @since 1.0.0
     * @return void
     */
    public function settings_page() {
        
        if ( ! current_user_can('manage_options') ) {
            return;
        }

        // get options page form
        require_once('settings_page.php'); 
    }


    /**
     * Options page - Regsiter, add section and add setting fields
     *
     * @uses action hook - admin_init
     * 
     * @since 1.0.0
     * @return void
     */
    public function csh_custom_settings() {

        register_setting( 'csh_settings_group', 'csh_options' , array( $this, 'csh_options_sanitize' ) );
        
        add_settings_section( 'csh_settings', '', array( $this, 'csh_settings_section_cb' ), 'csh_options_settings' );
        
        add_settings_field( 'csh_enable_svg', __( 'Enable SVG images upload' , 'wp-shapes' ) , array( $this, 'csh_svg_enable_cb' ), 'csh_options_settings', 'csh_settings' );

    }

    // section heading
    function csh_settings_section_cb() {
        echo '<h1>WP-Shapes - '.__( 'Settings', 'wp-shapes' ).' </h1>';
    }
    
    /**
     * Options page - call back
     * 
     * enable svg upload
     *
     * @since 1.0.0
     * @return void
     */
    public function csh_svg_enable_cb() {

        $csh_svg_enable = get_option('csh_options');
        
        if ( isset( $csh_svg_enable['svg_enable'] ) ) {
        ?>
            <input type="checkbox" name="csh_options[svg_enable]" checked value="1" id="">
            <?php echo __( 'enabled' , 'wp-shapes' ) ?>
        <?php
        } else {
        ?>
            <input type="checkbox" name="csh_options[svg_enable]" id="">
        <?php
        }
        ?>
        <p class="description"><?php _e( 'checkmark to Enable SVG Images upload' , 'wp-shapes' ) ?> - <a target="_blank" href="https://holithemes.com/wp-shapes/enable-svg-images-upload/"><?php _e( 'moreinfo' , 'wp-shapes' ) ?></a> </p>
        <?php
    }


    /**
     * Sanitize each setting field as needed
     *
     * @since 1.0.0
     * @param array $input Contains all settings fields as array keys
     */
    public function csh_options_sanitize( $input ) {

        if ( ! current_user_can( 'manage_options' ) ) {
            wp_die( 'not allowed to modify - please contact admin ' );
        }

        $new_input = array();

        if( isset( $input['svg_enable'] ) )
        $new_input['svg_enable'] = sanitize_text_field( $input['svg_enable'] );

        return $new_input;
    }



}

endif; // END class_exists check