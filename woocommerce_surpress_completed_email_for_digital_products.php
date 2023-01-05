<?php
/**
 * Plugin Name: Woocommerce surpress completed email for digital products
 * Plugin URI: http://neofix.ch/
 * Description: Woocommerce Plugin to surpress completed email for digital products.
 * Version: 1.0.0
 * Author: Neofix
 * Author URI: http://neofix.ch
 */

class NeofixWooSurpressDigitalCompletedMail{
  function __construct(){
    add_filter( 'woocommerce_email_recipient_customer_completed_order', array( $this, 'conditional_email_on_completed_order' ), 10, 2 );
  }

  function conditional_email_on_completed_order( $recipient, $order ) {
    $items = $order->get_items();
    foreach ( $items as $item ) {
      $product = wc_get_product($item->get_product_id());
      if (!$product->is_virtual()) {
        return $recipient;
      }
    }
    return '';
  }
}

if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
  new NeofixWooSurpressDigitalCompletedMail(); 
}

?>