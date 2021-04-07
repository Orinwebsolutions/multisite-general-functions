<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       https://github.com/Orinwebsolutions
 * @since      1.0.0
 *
 * @package    multisite_general_functions
 * @subpackage multisite_general_functions/admin/partials
 */
?>

<!-- This file should primarily consist of HTML with a little bit of PHP. -->


<ul class="nav nav-tabs" id="myTab" role="tablist">
  <li class="nav-item">
    <a class="nav-link active" id="language-tab" data-toggle="tab" href="#language" role="tab" aria-controls="language" aria-selected="true">logo</a>
  </li>
</ul>
<div class="tab-content" id="myTabContent">
    <div class="tab-pane fade show active" id="language" role="tabpanel" aria-labelledby="language-tab">
    <form method="post" action="edit.php?action=genLogoAction" enctype="multipart/form-data">
        <?php wp_nonce_field( 'general-logo-network-validate' );?>
        <?php 
            $general_logo = get_site_option( 'general_logo_settings')?get_site_option( 'general_logo_settings'):''; 
        ?>
        <h2>General logo</h2>
        <table class="form-table" id="">
            <tbody>
                
                    <tr>
                        <th scope="row">
                        <label for="multisite_lang"><?php _e( 'General logo' ); ?>
                        <span class="dashicons dashicons-translation" aria-hidden="true"></span></label></th>
                        <td>
                        <textarea id="general_unified_logo" name="general_unified_logo[]" rows="4" cols="50">
                            <?php
                                if ( ! empty( $general_logo ) ) {
                                    echo stripcslashes($general_logo);
                                }
                            ?>
                        </textarea>
                        </td>
                    </tr>
            </tbody>
        </table>
        <?php 
            $logo_attributes = array( 'id' => 'logo-button-id' );
            submit_button( 'Save logo', 'primary', 'logo-save-settings', true, $logo_attributes );
        ?>
    </form>
</div>
</div>
<!-- Tabs content -->


