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
    <a class="nav-link active" id="language-tab" data-toggle="tab" href="#language" role="tab" aria-controls="language" aria-selected="true">Language</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" id="currency-tab" data-toggle="tab" href="#currency" role="tab" aria-controls="currency" aria-selected="false">Currency</a>
  </li>
</ul>
<div class="tab-content" id="myTabContent">
    <div class="tab-pane fade show active" id="language" role="tabpanel" aria-labelledby="language-tab">
    <form method="post" action="edit.php?action=languageAction">
        <?php wp_nonce_field( 'language-network-validate' );?>
        <?php 
            $locale = get_site_option( 'general_WPLANG_settings')?get_site_option( 'general_WPLANG_settings'):''; 
        ?>
        <h2>Language</h2>
        <table class="form-table" id="">
            <tbody>
                <?php
                $languages    = get_available_languages();
                if ( ! is_multisite() && defined( 'WPLANG' ) && '' !== WPLANG && 'en_US' !== WPLANG && ! in_array( WPLANG, $languages, true ) ) {
                    $languages[] = WPLANG;
                }
                if ( ! empty( $languages ) ) {
                    ?>
                    <tr>
                        <th scope="row">
                        <label for="multisite_lang"><?php _e( 'Site Language' ); ?>
                        <span class="dashicons dashicons-translation" aria-hidden="true"></span></label></th>
                        <td>
                            <?php
                            wp_dropdown_languages(
                                array(
                                    'name'                        => 'multisite_lang',
                                    'id'                          => 'multisite_lang',
                                    'selected'                    => $locale,
                                    'languages'                   => $languages
                                )
                            );
                            ?>
                        </td>
                    </tr>
                    <?php
                }
                    ?>
            </tbody>
        </table>
        <?php 
            $language_attributes = array( 'id' => 'language-button-id' );
            submit_button( 'Save language', 'primary', 'language-save-settings', true, $language_attributes );
        ?>
    </form>
</div>
  <div class="tab-pane fade" id="currency" role="tabpanel" aria-labelledby="currency-tab">
   <?php 

//    var_dump($array);
   ?>
       <form method="post" action="edit.php?action=currencyAction">
        <?php wp_nonce_field( 'currency-network-validate' );?>
        <?php 
            $currencySelected = get_site_option( 'general_woocommerce_currency')?get_site_option( 'general_woocommerce_currency'):''; 
        ?>
        <h2>Currency</h2>
        <table class="form-table" id="">
            <tbody>
                <?php
                $currencies = get_woocommerce_currencies(); 
                if ( ! empty( $currencies ) ) {
                    ?>
                    <tr>
                        <th scope="row">
                        <label for="multisite_lang"><?php _e( 'Currency' ); ?>
                        <span class="dashicons dashicons-translation" aria-hidden="true"></span></label></th>
                        <td>
                            <select name="general_currency">
                            <?php
                            foreach ($currencies as $key => $currency) {
                                echo '<option value="'.$key.'" '.selected( $currencySelected, $key ).'>'.$currency.'</option>';
                            }
                            ?>
                            </select>
                        </td>
                    </tr>
                    <?php
                }
                    ?>
            </tbody>
        </table>
        <?php 
            $language_attributes = array( 'id' => 'currency-button-id' );
            submit_button( 'Save currency', 'primary', 'currency-save-settings', true, $language_attributes );
        ?>
    </form>
  </div>
</div>
<!-- Tabs content -->


