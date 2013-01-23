<?php

// Widget class
class Deportation_Clock_Widget extends WP_Widget {


/*-----------------------------------------------------------------------------------*/
/*  Widget Setup
/*-----------------------------------------------------------------------------------*/
  
function Deportation_Clock_Widget() {

  // Widget settings
  $widget_ops = array(
    'classname' => 'Deportation_Clock_Widget',
    'description' => __('A widget that displays a deportation clock.')
  );

  // Widget control settings
  $control_ops = array(
    'width' => 300,
    'height' => 350,
    'id_base' => 'deportation_clock_widget'
  );

  /* Create the widget. */
  $this->WP_Widget( 'Deportation_Clock_Widget', __('Deportation Clock'), $widget_ops, $control_ops );
  
}


/*-----------------------------------------------------------------------------------*/
/*  Display Widget
/*-----------------------------------------------------------------------------------*/

function widget( $args, $instance ) {
  extract( $args );
  
  $title          = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );
  $background_url = apply_filters( 'widget_text', empty( $instance['background_url'] ) ? '' : $instance['background_url'], $instance );
  $action_link    = apply_filters( 'widget_text', empty( $instance['action_link'] ) ? '' : $instance['action_link'], $instance );

  $background_url = (!empty( $background_url )) ? $background_url : '';

  echo $before_widget;
  if ( !empty( $title ) ) { echo $before_title . $title . $after_title; } 

  include DC_OBAMA_PLUGINPATH .'/views/widget.php';

  // After widget (defined by theme functions file)
  echo $after_widget;

}


/*-----------------------------------------------------------------------------------*/
/*  Update Widget
/*-----------------------------------------------------------------------------------*/
  
function update( $new_instance, $old_instance ) {
  $instance = $old_instance;

  $instance['title']          = sanitize_text_field($new_instance['title']);
  $instance['background_url'] = esc_url($new_instance['background_url']);
  $instance['action_link']    = esc_url($new_instance['action_link']);

  return $instance;
}


/*-----------------------------------------------------------------------------------*/
/*  Widget Settings (Displays the widget settings controls on the widget panel)
/*-----------------------------------------------------------------------------------*/
   
function form( $instance ) {

  $instance       = wp_parse_args( (array) $instance, array( 'title' => '', 'background_url' => '', 'action_link' => '' ) );
  $title          = sanitize_text_field($instance['title']);
  $background_url = esc_url($instance['background_url']);
  $action_link    = esc_url($instance['action_link']);
  
  ?>

  <!-- Widget Title: Text Input -->
  <p>
    <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:'); ?></label>
    <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></p>
  </p>

  <!-- Widget Background Image: Text Input -->
  <p>
    <label for="<?php echo $this->get_field_id('background_url'); ?>"><?php _e('Background Image:'); ?></label>
    <input class="widefat" id="<?php echo $this->get_field_id('background_url'); ?>" name="<?php echo $this->get_field_name('background_url'); ?>" type="text" value="<?php echo esc_attr( DC_OBAMA_PLUGINURL_NOHOST . '/assets/img/dc_obama_background.png' ); ?>" /></p>
  </p>

  <!-- Widget Action Link: Text Input -->
  <p>
    <label for="<?php echo $this->get_field_id('action_link'); ?>"><?php _e('Action Link:'); ?></label>
    <input class="widefat" id="<?php echo $this->get_field_id('action_link'); ?>" name="<?php echo $this->get_field_name('action_link'); ?>" type="text" value="<?php echo esc_attr('http://presente.org/deportations/'); ?>" /></p>
  </p>



  <?php
  }
}
