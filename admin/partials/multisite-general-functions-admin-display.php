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
<!--Need add strip and paypal settings -->
<form method="post" action="edit.php?action=paypalAction">';
<?php wp_nonce_field( 'PP-network-validate' );?>
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
                        <input class="" type="checkbox" name="woocommerce_paypal_enabled" id="woocommerce_paypal_enabled" style="" value="1"> Enable PayPal Standard</label><br>
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
                        <input class="input-text regular-input " type="text" name="woocommerce_paypal_title" id="woocommerce_paypal_title" style="" value="PayPal" placeholder="">
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
                        <input class="input-text regular-input " type="text" name="woocommerce_paypal_description" id="woocommerce_paypal_description" style="" value="Pay via PayPal; you can pay with your credit card if you don't have a PayPal account." placeholder="">
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
                        <input class="input-text regular-input " type="email" name="woocommerce_paypal_email" id="woocommerce_paypal_email" style="" value="daniel.hoglund@moreflo.com" placeholder="you@youremail.com">
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
                            <input class="" type="checkbox" name="woocommerce_paypal_testmode" id="woocommerce_paypal_testmode" style="" value="1"> Enable PayPal sandbox</label><br>
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
                            <input class="" type="checkbox" name="woocommerce_paypal_debug" id="woocommerce_paypal_debug" style="" value="1"> Enable logging</label><br>
                            <p class="description">Log PayPal events, such as IPN requests, inside <code>D:\xampp\htdocs\moreflo/wp-content/uploads/wc-logs/paypal-2021-03-26-58ff0349acb5dd86f2a033c0ba3a0227.log</code> Note: this may log personal information. We recommend using this for debugging purposes only and deleting the logs when finished.</p>
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
                            <input class="" type="checkbox" name="woocommerce_paypal_ipn_notification" id="woocommerce_paypal_ipn_notification" style="" value="1" checked="checked"> Enable IPN email notifications</label><br>
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
                            <input class="input-text regular-input " type="email" name="woocommerce_paypal_receiver_email" id="woocommerce_paypal_receiver_email" style="" value="daniel.hoglund@moreflo.com" placeholder="you@youremail.com">
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
                            <input class="input-text regular-input " type="text" name="woocommerce_paypal_identity_token" id="woocommerce_paypal_identity_token" style="" value="" placeholder="">
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
                            <input class="input-text regular-input " type="text" name="woocommerce_paypal_invoice_prefix" id="woocommerce_paypal_invoice_prefix" style="" value="WC-" placeholder="">
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
                            <input class="" type="checkbox" name="woocommerce_paypal_send_shipping" id="woocommerce_paypal_send_shipping" style="" value="1" checked="checked"> Send shipping details to PayPal instead of billing.</label><br>
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
                            <input class="" type="checkbox" name="woocommerce_paypal_address_override" id="woocommerce_paypal_address_override" style="" value="1"> Enable "address_override" to prevent address information from being changed.</label><br>
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
                                <option value="sale" selected="selected">Capture</option>
                                <option value="authorization">Authorize</option>
                            </select><span class="select2 select2-container select2-container--default select2-container--below" dir="ltr" style="width: 400px;"><span class="selection"><span class="select2-selection select2-selection--single" aria-haspopup="true" aria-expanded="false" tabindex="0" aria-labelledby="select2-woocommerce_paypal_paymentaction-container" role="combobox"><span class="select2-selection__rendered" id="select2-woocommerce_paypal_paymentaction-container" role="textbox" aria-readonly="true" title="Capture">Capture</span><span class="select2-selection__arrow" role="presentation"><b role="presentation"></b></span></span></span><span class="dropdown-wrapper" aria-hidden="true"></span></span>
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
                            <input class="input-text regular-input " type="text" name="woocommerce_paypal_page_style" id="woocommerce_paypal_page_style" style="" value="" placeholder="Optional">
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
                            <input class="input-text regular-input " type="text" name="woocommerce_paypal_image_url" id="woocommerce_paypal_image_url" style="" value="" placeholder="Optional">
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
                            <input class="input-text regular-input " type="text" name="woocommerce_paypal_api_username" id="woocommerce_paypal_api_username" style="" value="" placeholder="Optional">
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
                            <input class="input-text regular-input " type="password" name="woocommerce_paypal_api_password" id="woocommerce_paypal_api_password" style="" value="" placeholder="Optional">
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
                            <input class="input-text regular-input " type="password" name="woocommerce_paypal_api_signature" id="woocommerce_paypal_api_signature" style="" value="" placeholder="Optional">
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
                            <input class="input-text regular-input " type="text" name="woocommerce_paypal_sandbox_api_username" id="woocommerce_paypal_sandbox_api_username" style="" value="" placeholder="Optional">
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
                            <input class="input-text regular-input " type="password" name="woocommerce_paypal_sandbox_api_password" id="woocommerce_paypal_sandbox_api_password" style="" value="" placeholder="Optional">
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
                            <input class="input-text regular-input " type="password" name="woocommerce_paypal_sandbox_api_signature" id="woocommerce_paypal_sandbox_api_signature" style="" value="" placeholder="Optional">
                        </fieldset>
                    </td>
                </tr>
            </tbody>
        </table>
        <?php submit_button(); ?>
	</form>

        <?php
        // foreach ($method->form_fields as $form_field){
            
        //     echo "<pre>";
        //     var_dump($form_field). '<br />';
        //     echo "</pre>";

        //     echo '<tr valign="top" style="display: table-row;">
        //             <th scope="row" class="titledesc">
        //                 <label for="woocommerce_paypal_api_username">'
        //                 .$test.
        //                 '<span class="woocommerce-help-tip"></span></label>
        //             </th>
        //             <td class="forminp">
        //             <fieldset>
        //                 <legend class="screen-reader-text"><span>'
        //                 .$test.
        //                 '</span></legend>
        //                 <input class="input-text regular-input " 
        //                 type="text" 
        //                 name="woocommerce_paypal_api_username" id="woocommerce_paypal_api_username" style="" value="" placeholder="Optional">
        //             </fieldset>
        //             </td>
        //         </tr>';
        // }
    // }
// }

?>
