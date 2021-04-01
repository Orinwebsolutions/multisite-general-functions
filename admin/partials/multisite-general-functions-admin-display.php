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

<?php 
$installed_payment_methods = WC()->payment_gateways->payment_gateways();
 
// foreach( $installed_payment_methods as $methodClass  => $method ) {
    $acceptable_pay_class = ['paypal'];
    // echo $methodClass. '<br />';
    // if(!in_array($methodClass, $acceptable_pay_class)){
    //     continue;
    // }
    // echo "<pre>";
    // var_dump($method->form_fields). '<br />';
    // echo "</pre>";
    // if(isset($method->form_fields)){
        ?>
<ul class="nav nav-tabs" id="myTab" role="tablist">
  <li class="nav-item">
    <a class="nav-link active" id="paypal-tab" data-toggle="tab" href="#paypal" role="tab" aria-controls="paypal" aria-selected="true">Paypal</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" id="stripe-tab" data-toggle="tab" href="#stripe" role="tab" aria-controls="stripe" aria-selected="false">stripe</a>
  </li>
</ul>
<div class="tab-content" id="myTabContent">
  <div class="tab-pane fade show active" id="paypal" role="tabpanel" aria-labelledby="paypal-tab">
    <form method="post" action="edit.php?action=paypalAction">
        <?php wp_nonce_field( 'PP-network-validate' );?>
        <?php $generalOptions = get_site_option( 'general_woocommerce_paypal_settings')?get_site_option( 'general_woocommerce_paypal_settings'):''; ?>
        <h2>PayPal Standard<small class="wc-admin-breadcrumb">
        <table class="form-table">
            <tbody>
                <tr valign="top">
                    <th scope="row" class="titledesc">
                        <label for="woocommerce_paypal_enabled">Enable/Disable </label>
                    </th>
                    <td class="forminp">
                        <fieldset>
                            <legend class="screen-reader-text"><span>Enable/Disable</span></legend>
                            <label for="woocommerce_paypal_enabled">
                            <input class="" type="checkbox" <?php isset($generalOptions['enabled']) ? checked('yes', $generalOptions['enabled']): '' ; ?> name="woocommerce_paypal_enabled" id="woocommerce_paypal_enabled" style="" value="yes"> Enable PayPal Standard</label><br>
                        </fieldset>
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row" class="titledesc">
                        <label for="woocommerce_paypal_title">Title <span class="woocommerce-help-tip"></span></label>
                    </th>
                    <td class="forminp">
                        <fieldset>
                            <legend class="screen-reader-text"><span>Title</span></legend>
                            <input class="input-text regular-input " type="text" name="woocommerce_paypal_title" id="woocommerce_paypal_title" style="" 
                            value="<?php echo isset($generalOptions['title']) ? esc_attr( $generalOptions['title']):'PayPal'; ?>" placeholder="">
                        </fieldset>
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row" class="titledesc">
                        <label for="woocommerce_paypal_description">Description <span class="woocommerce-help-tip"></span></label>
                    </th>
                    <td class="forminp">
                        <fieldset>
                            <legend class="screen-reader-text"><span>Description</span></legend>
                            <input class="input-text regular-input " type="text" name="woocommerce_paypal_description" id="woocommerce_paypal_description" style="" 
                            value="<?php echo isset($generalOptions['description']) ? esc_attr( $generalOptions['description']):"Pay via PayPal; you can pay with your credit card if you don't have a PayPal account."; ?>" placeholder="">
                        </fieldset>
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row" class="titledesc">
                        <label for="woocommerce_paypal_email">PayPal email <span class="woocommerce-help-tip"></span></label>
                    </th>
                    <td class="forminp">
                        <fieldset>
                            <legend class="screen-reader-text"><span>PayPal email</span></legend>
                            <input class="input-text regular-input " type="email" name="woocommerce_paypal_email" id="woocommerce_paypal_email" style="" 
                            value="<?php echo isset($generalOptions['email']) ? esc_attr( $generalOptions['email']):''; ?>" placeholder="you@youremail.com">
                        </fieldset>
                    </td>
                </tr>
            </tbody>
        </table>
		<h3 class="wc-settings-sub-title " id="woocommerce_paypal_advanced">Advanced options</h3>
		<table class="form-table">
            <tbody>
                <tr valign="top">
                    <th scope="row" class="titledesc">
                        <label for="woocommerce_paypal_testmode">PayPal sandbox </label>
                    </th>
                    <td class="forminp">
                        <fieldset>
                            <legend class="screen-reader-text"><span>PayPal sandbox</span></legend>
                            <label for="woocommerce_paypal_testmode"> 
                            <input class="" type="checkbox" <?php isset($generalOptions['testmode']) ? checked('yes', $generalOptions['testmode'] ): ''; ?>
                             name="woocommerce_paypal_testmode" id="woocommerce_paypal_testmode" style="" value="yes"> Enable PayPal sandbox</label><br>
                            <p class="description">PayPal sandbox can be used to test payments. Sign up for a <a href="https://developer.paypal.com/">developer account</a>.</p>
                        </fieldset>
                    </td>
                </tr>
				<tr valign="top">
                    <th scope="row" class="titledesc">
                        <label for="woocommerce_paypal_debug">Debug log </label>
                    </th>
                    <td class="forminp">
                        <fieldset>
                            <legend class="screen-reader-text"><span>Debug log</span></legend>
                            <label for="woocommerce_paypal_debug">
                            <input class="" type="checkbox" <?php isset($generalOptions['debug']) ? checked('yes', $generalOptions['debug'] ):''; ?>
                            name="woocommerce_paypal_debug" id="woocommerce_paypal_debug" style="" value="yes"> Enable logging</label><br>
                        </fieldset>
                    </td>
                </tr>
				<tr valign="top">
                    <th scope="row" class="titledesc">
                        <label for="woocommerce_paypal_ipn_notification">IPN Email Notifications </label>
                    </th>
                    <td class="forminp">
                        <fieldset>
                            <legend class="screen-reader-text"><span>IPN Email Notifications</span></legend>
                            <label for="woocommerce_paypal_ipn_notification">
                            <input class="" type="checkbox" <?php isset($generalOptions['ipn_notification']) ? checked('yes', $generalOptions['ipn_notification'] ):''; ?>
                             name="woocommerce_paypal_ipn_notification" id="woocommerce_paypal_ipn_notification" style="" value="yes" checked="checked"> Enable IPN email notifications</label><br>
                            <p class="description">Send notifications when an IPN is received from PayPal indicating refunds, chargebacks and cancellations.</p>
                        </fieldset>
                    </td>
                </tr>
				<tr valign="top">
                    <th scope="row" class="titledesc">
                        <label for="woocommerce_paypal_receiver_email">Receiver email <span class="woocommerce-help-tip"></span></label>
                    </th>
                    <td class="forminp">
                        <fieldset>
                            <legend class="screen-reader-text"><span>Receiver email</span></legend>
                            <input class="input-text regular-input " type="email" name="woocommerce_paypal_receiver_email" 
                            id="woocommerce_paypal_receiver_email" style="" 
                            value="<?php echo  isset($generalOptions['receiver_email']) ? esc_attr( $generalOptions['receiver_email']):''; ?>" placeholder="you@youremail.com">
                        </fieldset>
                    </td>
                </tr>
				<tr valign="top">
                    <th scope="row" class="titledesc">
                        <label for="woocommerce_paypal_identity_token">PayPal identity token <span class="woocommerce-help-tip"></span></label>
                    </th>
                    <td class="forminp">
                        <fieldset>
                            <legend class="screen-reader-text"><span>PayPal identity token</span></legend>
                            <input class="input-text regular-input " type="text" name="woocommerce_paypal_identity_token" 
                            id="woocommerce_paypal_identity_token" style="" 
                            value="<?php echo isset($generalOptions['identity_token']) ? esc_attr( $generalOptions['identity_token']):''; ?>" placeholder="">
                        </fieldset>
                    </td>
                </tr>
				<tr valign="top">
                    <th scope="row" class="titledesc">
                        <label for="woocommerce_paypal_invoice_prefix">Invoice prefix <span class="woocommerce-help-tip"></span></label>
                    </th>
                    <td class="forminp">
                        <fieldset>
                            <legend class="screen-reader-text"><span>Invoice prefix</span></legend>
                            <input class="input-text regular-input " type="text" name="woocommerce_paypal_invoice_prefix"
                             id="woocommerce_paypal_invoice_prefix" style="" 
                             value="<?php echo isset($generalOptions['invoice_prefix']) ? esc_attr( $generalOptions['invoice_prefix']):'WC-'; ?>" placeholder="">
                        </fieldset>
                    </td>
                </tr>
				<tr valign="top">
                    <th scope="row" class="titledesc">
                        <label for="woocommerce_paypal_send_shipping">Shipping details </label>
                    </th>
                    <td class="forminp">
                        <fieldset>
                            <legend class="screen-reader-text"><span>Shipping details</span></legend>
                            <label for="woocommerce_paypal_send_shipping">
                            <input class="" <?php  isset($generalOptions['send_shipping']) ? checked('yes', $generalOptions['send_shipping'] ): ''; ?> type="checkbox" 
                            name="woocommerce_paypal_send_shipping" id="woocommerce_paypal_send_shipping" style="" value="yes" checked="checked"> Send shipping details to PayPal instead of billing.</label><br>
                            <p class="description">PayPal allows us to send one address. If you are using PayPal for shipping labels you may prefer to send the shipping address rather than billing. Turning this option off may prevent PayPal Seller protection from applying.</p>
                        </fieldset>
                    </td>
                </tr>
				<tr valign="top">
                    <th scope="row" class="titledesc">
                        <label for="woocommerce_paypal_address_override">Address override </label>
                    </th>
                    <td class="forminp">
                        <fieldset>
                            <legend class="screen-reader-text"><span>Address override</span></legend>
                            <label for="woocommerce_paypal_address_override">
                            <input class="" <?php isset($generalOptions['address_override']) ? checked('yes', $generalOptions['address_override'] ):''; ?> type="checkbox" 
                            name="woocommerce_paypal_address_override" id="woocommerce_paypal_address_override" style="" value="yes"> Enable "address_override" to prevent address information from being changed.</label><br>
                            <p class="description">PayPal verifies addresses therefore this setting can cause errors (we recommend keeping it disabled).</p>
                        </fieldset>
                    </td>
                </tr>
				<tr valign="top">
                    <th scope="row" class="titledesc">
                        <label for="woocommerce_paypal_paymentaction">Payment action <span class="woocommerce-help-tip"></span></label>
                    </th>
                    <td class="forminp">
                        <fieldset>
                            <legend class="screen-reader-text"><span>Payment action</span></legend>
                            <select class="select wc-enhanced-select select2-hidden-accessible enhanced" name="woocommerce_paypal_paymentaction" id="woocommerce_paypal_paymentaction" style="" tabindex="-1" aria-hidden="true">
                                <option <?php isset($generalOptions['paymentaction']) ? selected( $generalOptions['paymentaction'], 'sale' ):''; ?> value="sale" selected="selected">Capture</option>
                                <option <?php isset($generalOptions['paymentaction']) ? selected( $generalOptions['paymentaction'], 'authorization' ):''; ?> value="authorization">Authorize</option>
                            </select>
                        </fieldset>
                    </td>
                </tr>
				<tr valign="top">
                    <th scope="row" class="titledesc">
                        <label for="woocommerce_paypal_page_style">Page style <span class="woocommerce-help-tip"></span></label>
                    </th>
                    <td class="forminp">
                        <fieldset>
                            <legend class="screen-reader-text"><span>Page style</span></legend>
                            <input class="input-text regular-input " type="text" name="woocommerce_paypal_page_style" id="woocommerce_paypal_page_style"
                             style="" value="<?php echo isset($generalOptions['page_style']) ? esc_attr( $generalOptions['page_style']):''; ?>" placeholder="Optional">
                        </fieldset>
                    </td>
                </tr>
				<tr valign="top">
                    <th scope="row" class="titledesc">
                        <label for="woocommerce_paypal_image_url">Image url <span class="woocommerce-help-tip"></span></label>
                    </th>
                    <td class="forminp">
                        <fieldset>
                            <legend class="screen-reader-text"><span>Image url</span></legend>
                            <input class="input-text regular-input " type="text" name="woocommerce_paypal_image_url" id="woocommerce_paypal_image_url"
                             style="" value="<?php echo isset($generalOptions['image_url'])? esc_attr( $generalOptions['image_url']):''; ?>" placeholder="Optional">
                        </fieldset>
                    </td>
                </tr>
            </tbody>
        </table>
        <h3 class="wc-settings-sub-title " id="woocommerce_paypal_api_details">API credentials</h3>
        <p>Enter your PayPal API credentials to process refunds via PayPal. Learn how to access your <a href="https://developer.paypal.com/webapps/developer/docs/classic/api/apiCredentials/#create-an-api-signature">PayPal API Credentials</a>.</p>
        <table class="form-table" id="woocommerce_paypal_api_details_tbl">
            <tbody>
                <tr valign="top" style="display: table-row;">
                    <th scope="row" class="titledesc">
                        <label for="woocommerce_paypal_api_username">Live API username <span class="woocommerce-help-tip"></span></label>
                    </th>
                    <td class="forminp">
                        <fieldset>
                            <legend class="screen-reader-text"><span>Live API username</span></legend>
                            <input class="input-text regular-input " type="text" name="woocommerce_paypal_api_username"
                             id="woocommerce_paypal_api_username" style="" 
                             value="<?php echo isset($generalOptions['api_username'])?esc_attr( $generalOptions['api_username']):''; ?>" placeholder="Optional">
                        </fieldset>
                    </td>
                </tr>
				<tr valign="top" style="display: table-row;">
                    <th scope="row" class="titledesc">
                        <label for="woocommerce_paypal_api_password">Live API password <span class="woocommerce-help-tip"></span></label>
                    </th>
                    <td class="forminp">
                        <fieldset>
                            <legend class="screen-reader-text"><span>Live API password</span></legend>
                            <input class="input-text regular-input " type="password" name="woocommerce_paypal_api_password"
                             id="woocommerce_paypal_api_password" style="" 
                             value="<?php echo isset($generalOptions['api_password'])?esc_attr( $generalOptions['api_password']):''; ?>" placeholder="Optional">
                        </fieldset>
                    </td>
                </tr>
				<tr valign="top" style="display: table-row;">
                    <th scope="row" class="titledesc">
                        <label for="woocommerce_paypal_api_signature">Live API signature <span class="woocommerce-help-tip"></span></label>
                    </th>
                    <td class="forminp">
                        <fieldset>
                            <legend class="screen-reader-text"><span>Live API signature</span></legend>
                            <input class="input-text regular-input " type="password" name="woocommerce_paypal_api_signature"
                             id="woocommerce_paypal_api_signature" style="" 
                             value="<?php echo isset($generalOptions['api_signature'])? esc_attr( $generalOptions['api_signature']):''; ?>" placeholder="Optional">
                        </fieldset>
                    </td>
                </tr>
				<tr valign="top" style="display: none;">
                    <th scope="row" class="titledesc">
                        <label for="woocommerce_paypal_sandbox_api_username">Sandbox API username <span class="woocommerce-help-tip"></span></label>
                    </th>
                    <td class="forminp">
                        <fieldset>
                            <legend class="screen-reader-text"><span>Sandbox API username</span></legend>
                            <input class="input-text regular-input " type="text" name="woocommerce_paypal_sandbox_api_username"
                             id="woocommerce_paypal_sandbox_api_username" style="" 
                             value="<?php echo isset($generalOptions['sandbox_api_username'])? esc_attr( $generalOptions['sandbox_api_username']):''; ?>" placeholder="Optional">
                        </fieldset>
                    </td>
                </tr>
				<tr valign="top" style="display: none;">
                    <th scope="row" class="titledesc">
                        <label for="woocommerce_paypal_sandbox_api_password">Sandbox API password <span class="woocommerce-help-tip"></span></label>
                    </th>
                    <td class="forminp">
                        <fieldset>
                            <legend class="screen-reader-text"><span>Sandbox API password</span></legend>
                            <input class="input-text regular-input " type="password" name="woocommerce_paypal_sandbox_api_password"
                             id="woocommerce_paypal_sandbox_api_password" style="" 
                             value="<?php echo isset($generalOptions['sandbox_api_username'])?esc_attr( $generalOptions['sandbox_api_username']):''; ?>" placeholder="Optional">
                        </fieldset>
                    </td>
                </tr>
				<tr valign="top" style="display: none;">
                    <th scope="row" class="titledesc">
                        <label for="woocommerce_paypal_sandbox_api_signature">Sandbox API signature <span class="woocommerce-help-tip"></span></label>
                    </th>
                    <td class="forminp">
                        <fieldset>
                            <legend class="screen-reader-text"><span>Sandbox API signature</span></legend>
                            <input class="input-text regular-input " type="password" name="woocommerce_paypal_sandbox_api_signature"
                             id="woocommerce_paypal_sandbox_api_signature" style="" 
                             value="<?php echo isset($generalOptions['sandbox_api_signature'])? esc_attr( $generalOptions['sandbox_api_signature']):''; ?>" placeholder="Optional">
                        </fieldset>
                    </td>
                </tr>
            </tbody>
        </table>
        <?php
        $other_attributes = array( 'id' => 'paypal-button-id' );
        submit_button( 'Save paypal', 'primary', 'paypal-save-settings', true, $other_attributes ); ?>
    </form>
  </div>
  <div class="tab-pane fade" id="stripe" role="tabpanel" aria-labelledby="stripe-tab">
    <form method="post" action="edit.php?action=stripeAction">
        <?php wp_nonce_field( 'Stripe-network-validate' );?>
        <?php $generalStripeOpt = get_site_option( 'general_woocommerce_stripe_settings')?get_site_option( 'general_woocommerce_stripe_settings'):''; ?>
        <h2>Stripe</h2>
        <p>Stripe works by adding payment fields on the checkout and then sending the details to Stripe for verification. <a href="https://dashboard.stripe.com/register" target="_blank">Sign up</a> for a Stripe account, and <a href="https://dashboard.stripe.com/account/apikeys" target="_blank">get your Stripe account keys</a>.</p>
        <table class="form-table">
            <tbody>
                <tr valign="top">
                    <th scope="row" class="titledesc">
                        <label for="woocommerce_stripe_enabled">Enable/Disable </label>
                    </th>
                    <td class="forminp">
                        <fieldset>
                            <legend class="screen-reader-text"><span>Enable/Disable</span></legend>
                            <label for="woocommerce_stripe_enabled">
                            <input class="" type="checkbox" <?php isset($generalStripeOpt['enabled']) ? checked('yes', $generalStripeOpt['enabled'] ):''; ?>
                             name="woocommerce_stripe_enabled" id="woocommerce_stripe_enabled" style="" value="yes"> Enable Stripe</label><br>
                        </fieldset>
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row" class="titledesc">
                        <label for="woocommerce_stripe_title">Title <span class="woocommerce-help-tip"></span></label>
                    </th>
                    <td class="forminp">
                        <fieldset>
                            <legend class="screen-reader-text"><span>Title</span></legend>
                            <input class="input-text regular-input " type="text" name="woocommerce_stripe_title" id="woocommerce_stripe_title" style="" 
                            value="<?php echo isset($generalStripeOpt['title'])? esc_attr( $generalStripeOpt['title']):'Credit Card (Stripe)'; ?>" placeholder="">
                        </fieldset>
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row" class="titledesc">
                        <label for="woocommerce_stripe_description">Description <span class="woocommerce-help-tip"></span></label>
                    </th>
                    <td class="forminp">
                        <fieldset>
                            <legend class="screen-reader-text"><span>Description</span></legend>
                            <input class="input-text regular-input " type="text" name="woocommerce_stripe_description" id="woocommerce_stripe_description" style="" 
                            value="<?php echo isset($generalStripeOpt['description'])? esc_attr( $generalStripeOpt['description']):'Pay with your credit card via Stripe.'; ?>" placeholder="">
                        </fieldset>
                    </td>
                </tr>
            </tbody>
        </table>
        <h3 class="wc-settings-sub-title " id="woocommerce_stripe_webhook">Webhook Endpoints</h3>
        <p>You must add the following webhook endpoint <strong style="background-color:#ddd">&nbsp;https://frisorateljen.moreflotest.devlocal/?wc-api=wc_stripe&nbsp;</strong> to your <a href="https://dashboard.stripe.com/account/webhooks" target="_blank">Stripe account settings</a>. This will enable you to receive notifications on the charge statuses.</p>
        <table class="form-table" id="woocommerce_stripe_api_details_tbl">
            <tbody>
                <tr valign="top">
                    <th scope="row" class="titledesc">
                        <label for="woocommerce_stripe_testmode">Test mode <span class="woocommerce-help-tip"></span></label>
                    </th>
                    <td class="forminp">
                        <fieldset>
                            <legend class="screen-reader-text"><span>Test mode</span></legend>
                            <label for="woocommerce_stripe_testmode">
                            <input class="" type="checkbox" name="woocommerce_stripe_testmode" id="woocommerce_stripe_testmode" style="" value="yes"
                            <?php isset($generalStripeOpt['testmode']) ? checked('yes', $generalStripeOpt['testmode'] ):''; ?>> Enable Test Mode</label><br>
                        </fieldset>
                    </td>
                </tr>
                <tr valign="top" class="strip_test">
                    <th scope="row" class="titledesc">
                        <label for="woocommerce_stripe_test_publishable_key">Test Publishable Key <span class="woocommerce-help-tip"></span></label>
                    </th>
                    <td class="forminp">
                        <fieldset>
                            <legend class="screen-reader-text"><span>Test Publishable Key</span></legend>
                            <input class="input-text regular-input " type="text" name="woocommerce_stripe_test_publishable_key" id="woocommerce_stripe_test_publishable_key" 
                            style="" value="<?php echo isset($generalStripeOpt['test_publishable_key'])? esc_attr( $generalStripeOpt['test_publishable_key']):''; ?>" placeholder="">
                        </fieldset>
                    </td>
                </tr>
                <tr valign="top" class="strip_test">
                    <th scope="row" class="titledesc">
                        <label for="woocommerce_stripe_test_secret_key">Test Secret Key <span class="woocommerce-help-tip"></span></label>
                    </th>
                    <td class="forminp">
                        <fieldset>
                            <legend class="screen-reader-text"><span>Test Secret Key</span></legend>
                            <input class="input-text regular-input " type="password" name="woocommerce_stripe_test_secret_key" id="woocommerce_stripe_test_secret_key"
                             style="" value="<?php echo isset($generalStripeOpt['test_secret_key'])? esc_attr( $generalStripeOpt['test_secret_key']):''; ?>" placeholder="">
                        </fieldset>
                    </td>
                </tr>
                <tr valign="top" class="strip_test">
                    <th scope="row" class="titledesc">
                        <label for="woocommerce_stripe_test_webhook_secret">Test Webhook Secret <span class="woocommerce-help-tip"></span></label>
                    </th>
                    <td class="forminp">
                        <fieldset>
                            <legend class="screen-reader-text"><span>Test Webhook Secret</span></legend>
                            <input class="input-text regular-input " type="password" name="woocommerce_stripe_test_webhook_secret" id="woocommerce_stripe_test_webhook_secret"
                             style="" value="<?php echo isset($generalStripeOpt['test_webhook_secret'])? esc_attr( $generalStripeOpt['test_webhook_secret']):''; ?>" placeholder="">
                        </fieldset>
                    </td>
                </tr>
                <tr valign="top" class="strip_live" style="display: none;">
                    <th scope="row" class="titledesc">
                        <label for="woocommerce_stripe_publishable_key">Live Publishable Key <span class="woocommerce-help-tip"></span></label>
                    </th>
                    <td class="forminp">
                        <fieldset>
                            <legend class="screen-reader-text"><span>Live Publishable Key</span></legend>
                            <input class="input-text regular-input " type="text" name="woocommerce_stripe_publishable_key" id="woocommerce_stripe_publishable_key"
                             style="" value="<?php echo isset($generalStripeOpt['publishable_key'])? esc_attr( $generalStripeOpt['publishable_key']):''; ?>" placeholder="">
                        </fieldset>
                    </td>
                </tr>
                <tr valign="top" class="strip_live" style="display: none;">
                    <th scope="row" class="titledesc">
                        <label for="woocommerce_stripe_secret_key">Live Secret Key <span class="woocommerce-help-tip"></span></label>
                    </th>
                    <td class="forminp">
                        <fieldset>
                            <legend class="screen-reader-text"><span>Live Secret Key</span></legend>
                            <input class="input-text regular-input " type="password" name="woocommerce_stripe_secret_key" id="woocommerce_stripe_secret_key"
                             style="" value="<?php echo isset($generalStripeOpt['secret_key'])? esc_attr( $generalStripeOpt['secret_key']):''; ?>" placeholder="">
                        </fieldset>
                    </td>
                </tr>
                <tr valign="top" class="strip_live" style="display: none;">
                    <th scope="row" class="titledesc">
                        <label for="woocommerce_stripe_webhook_secret">Webhook Secret <span class="woocommerce-help-tip"></span></label>
                    </th>
                    <td class="forminp">
                        <fieldset>
                            <legend class="screen-reader-text"><span>Webhook Secret</span></legend>
                            <input class="input-text regular-input " type="password" name="woocommerce_stripe_webhook_secret" id="woocommerce_stripe_webhook_secret" 
                            style="" value="<?php echo isset($generalStripeOpt['webhook_secret'])? esc_attr( $generalStripeOpt['webhook_secret']):''; ?>" placeholder="">
                        </fieldset>
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row" class="titledesc">
                        <label for="woocommerce_stripe_inline_cc_form">Inline Credit Card Form <span class="woocommerce-help-tip"></span></label>
                    </th>
                    <td class="forminp">
                        <fieldset>
                            <legend class="screen-reader-text"><span>Inline Credit Card Form</span></legend>
                            <label for="woocommerce_stripe_inline_cc_form">
                            <input class="" type="checkbox" name="woocommerce_stripe_inline_cc_form" id="woocommerce_stripe_inline_cc_form" style=""
                            <?php isset($generalStripeOpt['inline_cc_form']) ? checked('yes', $generalStripeOpt['inline_cc_form'] ):''; ?> value="yes"> Inline Credit Card Form</label><br>
                        </fieldset>
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row" class="titledesc">
                        <label for="woocommerce_stripe_statement_descriptor">Statement Descriptor <span class="woocommerce-help-tip"></span></label>
                    </th>
                    <td class="forminp">
                        <fieldset>
                            <legend class="screen-reader-text"><span>Statement Descriptor</span></legend>
                            <input class="input-text regular-input " type="text" name="woocommerce_stripe_statement_descriptor" id="woocommerce_stripe_statement_descriptor" 
                            style="" value="<?php echo isset($generalStripeOpt['statement_descriptor'])? esc_attr( $generalStripeOpt['statement_descriptor']):''; ?>" placeholder="">
                        </fieldset>
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row" class="titledesc">
                        <label for="woocommerce_stripe_capture">Capture <span class="woocommerce-help-tip"></span></label>
                    </th>
                    <td class="forminp">
                        <fieldset>
                            <legend class="screen-reader-text"><span>Capture</span></legend>
                            <label for="woocommerce_stripe_capture">
                            <input class="" type="checkbox" name="woocommerce_stripe_capture" id="woocommerce_stripe_capture" style="" value="yes"
                            <?php isset($generalStripeOpt['capture']) ? checked('yes', $generalStripeOpt['capture'] ):''; ?>> Capture charge immediately</label><br>
                        </fieldset>
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row" class="titledesc">
                        <label for="woocommerce_stripe_payment_request">Payment Request Buttons <span class="woocommerce-help-tip"></span></label>
                    </th>
                    <td class="forminp">
                        <fieldset>
                            <legend class="screen-reader-text"><span>Payment Request Buttons</span></legend>
                            <label for="woocommerce_stripe_payment_request">
                            <input class="" type="checkbox" name="woocommerce_stripe_payment_request" id="woocommerce_stripe_payment_request" style="" value="yes"
                            <?php isset($generalStripeOpt['payment_request']) ? checked('yes', $generalStripeOpt['payment_request'] ):''; ?>> Enable Payment Request Buttons. (Apple Pay/Chrome Payment Request API) <br>By using Apple Pay, you agree to <a href="https://stripe.com/apple-pay/legal" target="_blank">Stripe</a> and <a href="https://developer.apple.com/apple-pay/acceptable-use-guidelines-for-websites/" target="_blank">Apple</a>'s terms of service.</label><br>
                        </fieldset>
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row" class="titledesc">
                        <label for="woocommerce_stripe_payment_request_button_type">Payment Request Button Type <span class="woocommerce-help-tip"></span></label>
                    </th>
                    <td class="forminp">
                        <fieldset>
                            <legend class="screen-reader-text"><span>Payment Request Button Type</span></legend>
                            <select class="select " name="woocommerce_stripe_payment_request_button_type" id="woocommerce_stripe_payment_request_button_type" style="">
                                <option value="default">Default</option>
                                <option value="buy" selected="selected">Buy</option>
                                <option value="donate">Donate</option>
                                <option value="branded">Branded</option>
                                <option value="custom">Custom</option>
                            </select>
                        </fieldset>
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row" class="titledesc">
                        <label for="woocommerce_stripe_payment_request_button_theme">Payment Request Button Theme <span class="woocommerce-help-tip"></span></label>
                    </th>
                    <td class="forminp">
                        <fieldset>
                            <legend class="screen-reader-text"><span>Payment Request Button Theme</span></legend>
                            <select class="select " name="woocommerce_stripe_payment_request_button_theme" id="woocommerce_stripe_payment_request_button_theme" style="">
                                <option value="dark" selected="selected">Dark</option>
                                <option value="light">Light</option>
                                <option value="light-outline">Light-Outline</option>
                            </select>
                        </fieldset>
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row" class="titledesc">
                        <label for="woocommerce_stripe_payment_request_button_height">Payment Request Button Height <span class="woocommerce-help-tip"></span></label>
                    </th>
                    <td class="forminp">
                        <fieldset>
                            <legend class="screen-reader-text"><span>Payment Request Button Height</span></legend>
                            <input class="input-text regular-input " type="text" name="woocommerce_stripe_payment_request_button_height" id="woocommerce_stripe_payment_request_button_height" style="" value="44" placeholder="">
                        </fieldset>
                    </td>
                </tr>
                <tr valign="top" id="custom" style="display: none;">
                    <th scope="row" class="titledesc">
                        <label for="woocommerce_stripe_payment_request_button_label">Payment Request Button Label <span class="woocommerce-help-tip"></span></label>
                    </th>
                    <td class="forminp">
                        <fieldset>
                            <legend class="screen-reader-text"><span>Payment Request Button Label</span></legend>
                            <input class="input-text regular-input " type="text" name="woocommerce_stripe_payment_request_button_label" id="woocommerce_stripe_payment_request_button_label" style="" value="Buy now" placeholder="">
                        </fieldset>
                    </td>
                </tr>
                <tr valign="top" id="branded" style="display: none;">
                    <th scope="row" class="titledesc">
                        <label for="woocommerce_stripe_payment_request_button_branded_type">Payment Request Branded Button Label Format <span class="woocommerce-help-tip"></span></label>
                    </th>
                    <td class="forminp">
                        <fieldset>
                            <legend class="screen-reader-text"><span>Payment Request Branded Button Label Format</span></legend>
                            <select class="select " name="woocommerce_stripe_payment_request_button_branded_type" id="woocommerce_stripe_payment_request_button_branded_type" style="">
                                <option value="short">Logo only</option>
                                <option value="long" selected="selected">Text and logo</option>
                            </select>
                        </fieldset>
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row" class="titledesc">
                        <label for="woocommerce_stripe_saved_cards">Saved Cards <span class="woocommerce-help-tip"></span></label>
                    </th>
                    <td class="forminp">
                        <fieldset>
                            <legend class="screen-reader-text"><span>Saved Cards</span></legend>
                            <label for="woocommerce_stripe_saved_cards">
                            <input class="" type="checkbox" name="woocommerce_stripe_saved_cards" id="woocommerce_stripe_saved_cards" style="" value="yes" checked="checked"> Enable Payment via Saved Cards</label><br>
                        </fieldset>
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row" class="titledesc">
                        <label for="woocommerce_stripe_logging">Logging <span class="woocommerce-help-tip"></span></label>
                    </th>
                    <td class="forminp">
                        <fieldset>
                            <legend class="screen-reader-text"><span>Logging</span></legend>
                            <label for="woocommerce_stripe_logging">
                            <input class="" type="checkbox" name="woocommerce_stripe_logging" id="woocommerce_stripe_logging" style="" value="yes"> Log debug messages</label><br>
                        </fieldset>
                    </td>
                </tr>
            </tbody>
        </table>
        <?php
        $other_attributes = array( 'id' => 'stripe-button-id' );
        submit_button( 'Save Stripe', 'primary', 'strip-save-settings', true, $other_attributes );
         ?>
    </form>
  </div>
</div>
<!-- Tabs content -->


