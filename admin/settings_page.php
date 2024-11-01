<?php
/**
 * template: wp css shapes - options page
 * @uses CSH_Admin::settings_page
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit;

?>

<div class="wrap">

    <?php settings_errors(); ?>
    
    <form action="options.php" method="post" class="">
        <?php settings_fields( 'csh_settings_group' ); ?>
        <?php do_settings_sections( 'csh_options_settings' ) ?>
        <?php submit_button() ?>
    </form>
        
</div>