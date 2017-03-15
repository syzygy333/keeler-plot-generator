<?php
/**
 * Plugin Name: Keeler Plot Generator
 * Plugin URI: https://github.com/syzygy333
 * Description: This plugin is intended for use by the website of the Harry Stephen Keeler Society. It generates a plotline typical of a Keeler novel with randomized bits to make it different on each pageload.
 * Version: 1.0.0
 * Author: Brian Hogue (plugin) and Richard Polt (JS version of generator)
 * Author URI: https://github.com/syzygy333
 * License: GPL2
 */
 
class keeler_plot_generator extends WP_Widget {
  //  contructor
  function keeler_plot_generator() {
    
  }
  
  // widget form creation
  function form($instance) {
    
  }
  
  // widget update
  function update($new_instance, $old_instance) {
    
  }
  
  // widget display
  function widget($args, $instance) {
    
  }
}
// register widget
add_action( 'widgets_init', create_function( '', 'return register_widget("keeler_plot_generator");' ) );