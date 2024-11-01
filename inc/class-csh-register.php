<?php
/**
 * class csh_register
 * 
 * this class have methods to run when plugin
 *  activate, deactivate, uninstall, update
 * 
 * add values to Database - wp_options table
 *      plugin details
 */

if ( ! defined( 'ABSPATH' ) ) exit;

if ( ! class_exists( 'CSH_Register' ) ) :
        
class CSH_Register {

    /**
     * When plugin activate this function will call
     * 
     * Check min wp version 
     * calls self::db_plugin_details - add plugin details to db
     * 
     * @since 1.0.0
     * @uses register_activation_hook
     * 
     * @return void
     */
    public static function activate() {

        // check minimum version required to run this plugin
        if( version_compare( get_bloginfo('version'), CSH_WP_MIN_VERSION, '<') )  {
            wp_die( 'please update WordPress' );
        }

        // update plugin details to wp_options table
        self::db_plugin_details();
    }

    /**
     * When plugin deactivate
     * @since 1.0.0
     * @uses register_deactivation_hook
     * @return void
     */
    public static function deactivate() {

    }

    /**
     * When plugin uninstall ( delete )
     * @since 1.0.0
     * @uses register_uninstall_hook
     * @return void
     */
    public static function uninstall() {

    }
    

    /**
     * @uses action hook - plugins_loaded  
     * 
     * compare this content version with saved version in db
     * If version is different then run activate function
     * 
     * @since 1.0.0
     * 
     * @return void
     */
    public static function plugin_update() {
        
        $csh_plugin_details = get_option('csh_plugin_details');
    
        if ( CSH_VERSION !== $csh_plugin_details['version'] ) {
            //  to update the plugin - just like activate plugin
            self::activate();

        }
    }

    /**
     * Add plugin Details to db - wp_options table
     * Add plugin version to db - useful while updating plugin
     * 
     * @uses self::activate()
     * @return void
     */
    public static function db_plugin_details() {

        // plugin details 
        $plugin_details = array(
            'version' => CSH_VERSION,
        );

        // Always use update_option - override new values .. don't preseve already existing values
        update_option( 'csh_plugin_details', $plugin_details );
    }

    
}

endif; // END class_exists check