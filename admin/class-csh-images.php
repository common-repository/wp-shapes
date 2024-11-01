<?php
/**
 * Handle WordPress images upload
 * 
 * Added support for uploading svg images
 * 
 * @package csh
 * @since 1.0.0
 */


if ( ! defined( 'ABSPATH' ) ) exit;

if ( ! class_exists( 'CSH_images' ) ) :

class CSH_images {

    /**
     * add mime types ( support mime uploads )
     * @uses css-shapes.php->upload_mimes - filter hook
     * 
     * @param array $mimes Current array of mime types
     * 
     * @return Updated array of mime types
     * 
     * @since 1.0.0
     */
    public static function add_mime_types( $mimes ) {

        // New allowed mime types.
        $mimes['svg'] = 'image/svg+xml';
        $mimes['svgz'] = 'image/svg+xml';

        return $mimes;
    }


}

endif; // END class_exists check