<?php
defined( 'ABSPATH' ) or die( 'No script kiddies please!' );
/*
   Plugin Name: WP WhatsApp Sharing
   Plugin URI: https://github.com/MatteoCandura/WP-WhatsApp-Sharing
   Description: Allow you to share any content (post, page, image or custom post type) by shortcode.
   Version: 1.0
   Author: Matteo Candura
   Author URI: http://matteocandura.com
   License: GPL3
 */

function register_ws_shortcode( $atts, $content="" ) {
  extract(
    shortcode_atts(
      array(
        'id' => null,
        'class' => '',
        'text' => __("Share via Whatsapp", 'wp-whatsapp-sharing')
      ),
      $atts
    )
  );

  if( $id === null )
    global $post;
  else
    $post = get_post($id);
  
  $title = sprintf( __('Share x via WhatsApp!', 'wp-whatsapp-sharing'), $post->post_title );

  return wp_is_mobile() ? '<a href="whatsapp://send?text=' . get_permalink($post->ID) . '" class="' . $class . '" title="' . $title . '" data-action="share/whatsapp/share">' . $text . '</a>' : '';
}
add_shortcode( 'whatsapp_sharing', 'register_ws_shortcode' );