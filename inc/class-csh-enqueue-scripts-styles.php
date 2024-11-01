<?php
/**
 * Enqueuw Scripts, Styles
 */

 if ( ! defined( 'ABSPATH' ) ) exit;

 if ( ! class_exists( 'CSH_Enqueue_Scripts_Sytles' ) ) :

class CSH_Enqueue_Scripts_Sytles {

    /**
     * Enqueue Styles, Scripts to public pages - wp front end
     * 
     * @uses action hook - wp_enqueue_scripts
     * @return void
     */
    public static function enqueue() {

        // enqueue main.css
        wp_enqueue_style( 'csh_styles', plugins_url( 'assets/css/main.css', CSH_PLUGIN_FILE ), '', CSH_VERSION );

    }

}

endif; // END class_exists check