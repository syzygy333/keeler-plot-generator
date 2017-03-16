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
      $title = esc_attr( $instance[ 'title' ] );
      $text  = esc_attr( $instance[ 'text' ] );
    } else {
      $title = '';
      $text  = '';
    }
    ?>
    
    <p>
      <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Widget Title', 'wp_widget_plugin' ); ?></label>
      <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $title; ?>" />
    </p>
    <p>
      <label for="<?php echo $this->get_field_id( 'text' ); ?>"><?php _e( 'Intro text:', 'wp_widget_plugin' ); ?></label>
      <input class="widefat" id="<?php echo $this->get_field_id( 'text' ); ?>" name="<?php echo $this->get_field_name( 'text' ); ?>" type="text" value="<?php echo $text; ?>" />
    </p>
    
    <?php
  }
  
  // update widget
  function update( $new_instance, $old_instance ) {
    $instance = $old_instance;
    $instance[ 'title' ] = strip_tags( $new_instance[ 'title' ] );
    $instance[ 'text' ]  = strip_tags( $new_instance[ 'text' ] );
    return $instance;
  }
  
  // display widget
  function widget( $args, $instance ) {
    extract( $args );
    // these are the widget options
    $title = apply_filters( 'widget_title', $instance[ 'title' ] );
    $text  = $instance[ 'text' ];
    
    echo $before_widget;
    // display the widget
    echo '<div class="plot-generator-widget">';
    
    // check if title is set
    if ( $title ) {
      echo $before_title . $title . $after_title;
    }
    // check if text is set
    if ( $text ) {
      echo '<p class="plot-generator-widget--intro-text">' . $text . '</p>';
    }
    
    echo '</div>';
    
    // all the logic and output from the .js file
    function randomize( $key ) {
      $plot_generator = [
        'titleText1' => [
          "The Case of the", "The Riddle of the", "The Man with the", "The Mystery of the"
        ],
        'titleText2' => [
          "Travelling", "Five", "Seven", "Silver", "Barking", "Transposed", "Crimson", "Ivory", "Transparent", "Thousand", "Crazy", "Wooden", "Yellow", "Waltzing", "Green", "16", "Jade", "Mysterious", "Magic", "Wonderful", "Orange"
        ],
        'titleText3' => [
          "Buddhas", "Clocks", "Clowns", "Legs", "Balls", "Kings", "Ear-Drums", "Faces", "Fingers", "Leaves", "Spectacles", "Hours", "Eyes", "Nightgowns", "Sparrows", "Beans", "Fans", "Bottles", "Birds", "Hands", "Boxes"
        ]
      ];
      $choice = $plot_generator[ $key ][ rand( 0, count( $plot_generator[ $key ] ) ) ];
      return $choice;
    }
    $plot_title_text_1 = randomize( 'titleText1' );
    $plot_title_text_2 = randomize( 'titleText2' );
    $plot_title_text_3 = randomize( 'titleText3' );
    
    echo '<p class="plot-generator-widget--plot-title">' . $plot_title_text_1 . ' ' . $plot_title_text_2 . ' ' . $plot_title_text_3 . '</p>';
    
    echo $after_widget;
  }
}
// register widget
add_action( 'widgets_init', create_function( '', 'return register_widget( "keeler_plot_generator" );' ) );