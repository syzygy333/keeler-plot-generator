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
    parent::WP_Widget( false, $name = __( 'Keeler Plot Generator', 'wp_widget_plugin' ) );
  }
  
  // widget form creation
  function form( $instance ) {
    if ( $instance ) {
      $title    = esc_attr( $instance[ 'title' ] );
      $text     = esc_attr( $instance[ 'text' ] );
      $textarea = esc_attr( $instance[ 'textarea' ] );
      $checkbox = esc_attr( $instance[ 'checkbox' ] );
      $select   = esc_attr( $instance[ 'select' ] );
    } else {
      $title    = '';
      $text     = '';
      $textarea = '';
      $checkbox = '';
      $select   = '';
    }
    ?>
    
    <p>
      <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Widget Title', 'wp_widget_plugin' ); ?></label>
      <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $title; ?>" />
    </p>
    <p>
      <label for="<?php echo $this->get_field_id( 'text' ); ?>"><?php _e( 'Text:', 'wp_widget_plugin' ); ?></label>
      <input class="widefat" id="<?php echo $this->get_field_id( 'text' ); ?>" name="<?php echo $this->get_field_name( 'text' ); ?>" type="text" value="<?php echo $text; ?>" />
    </p>
    <p>
      <label for="<?php echo $this->get_field_id( 'textarea' ); ?>"><?php _e( 'Textarea:', 'wp_widget_plugin' ); ?></label>
      <input class="widefat" id="<?php echo $this->get_field_id( 'textarea' ); ?>" name="<?php echo $this->get_field_name( 'textarea' ); ?>" type="text" value="<?php echo $textarea; ?>" />
    </p>
    <p>
      <input id="<?php echo esc_attr( $this->get_field_id( 'checkbox' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'checkbox' ) ); ?>" type="checkbox" value="1" <?php checked( '1', $checkbox ); ?> />
      <label for="<?php echo esc_attr( $this->get_field_id( 'checkbox' ) ); ?>"><?php _e( 'Checkbox', 'wp_widget_plugin' ); ?></label>
    </p>
    <p>
      <label for="<?php echo $this->get_field_id( 'select' ); ?>"><?php _e( 'Select', 'wp_widget_plugin' ); ?></label>
      <select name="<?php echo $this->get_field_name( 'select' ); ?>" id="<?php echo $this->get_field_id( 'select' ); ?>" class="widefat">
      <?php
      $options = [ 'lorem', 'ipsum', 'dolorem' ];
      foreach ( $options as $option ) {
        echo '<option value="' . $option . '" id="' . $option . '"', $select == $option ? ' selected="selected"' : '', '>', $option, '</option>';
      }
      ?>
      </select>
    </p>
    
    <?php
  }
  
  // update widget
  function update( $new_instance, $old_instance ) {
    $instance = $old_instance;
    $instance[ 'title' ]    = strip_tags( $new_instance[ 'title' ] );
    $instance[ 'text' ]     = strip_tags( $new_instance[ 'text' ] );
    $instance[ 'textarea' ] = strip_tags( $new_instance[ 'textarea' ] );
    $instance[ 'checkbox' ] = strip_tags( $new_instance[ 'checkbox' ] );
    $instance[ 'select' ]   = strip_tags( $new_instance[ 'select' ] );
    return $instance;
  }
  
  // display widget
  function widget( $args, $instance ) {
    extract( $args );
    // these are the widget options
    $title = apply_filters( 'widget_title', $instance[ 'title' ] );
    $text = $instance[ 'text' ];
    $textarea = $instance[ 'textarea' ];
    
    echo $before_widget;
    // display the widget
    echo '<div class="plot-generator-widget">';
    
    // check if title is set
    if ( $title ) {
      echo $before_title . $title . $after_title;
    }
    // check if text is set
    if ( $text ) {
      echo '<p class="plot-generator-widget--text">' . $text . '</p>';
    }
    // check if textarea is set
    if ( $textarea ) {
      echo '<p class="plot-generator-widget--textarea">' . $textarea . '</p>';
    }
    // check if checkbox is checked
    if ( $checkbox && $checkbox == '1' ) {
      echo '<p>' . __( 'Checkbox is checked', 'wp_widget_plugin' ) . '</p>';
    }
    // get select value
    if ( $select == 'lorem' ) {
      echo 'Lorem option is selected';
    } elseif ( $select == 'ipsum' ) {
      echo 'Ipsum option is selected';
    } else {
      echo 'Dolorem option is selected';
    }
    
    echo '</div>';
    echo $after_widget;
  }
}
// register widget
add_action( 'widgets_init', create_function( '', 'return register_widget( "keeler_plot_generator" );' ) );