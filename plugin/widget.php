<?php

// Widget class
class Deportation_Clock_Widget extends WP_Widget {


/*-----------------------------------------------------------------------------------*/
/*	Widget Setup
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
	$this->WP_Widget( 'Deportation_Clock_Widget', __('Deportation Clock Widget'), $widget_ops, $control_ops );
	
}


/*-----------------------------------------------------------------------------------*/
/*	Display Widget
/*-----------------------------------------------------------------------------------*/

function widget( $args, $instance ) {
	extract( $args );
	
	$title = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );
	$link = apply_filters( 'widget_text', empty( $instance['link'] ) ? '' : $instance['link'], $instance );
	$text = apply_filters( 'widget_text', empty( $instance['text'] ) ? '' : $instance['text'], $instance );

	echo $before_widget;
	if ( !empty( $title ) ) { echo $before_title . $title . $after_title; } 

	//$background_url = DC_OBAMA_PLUGINURL . '/assets/img/dc_obama_background.png';
	$background_url = '';

	include DC_OBAMA_PLUGINPATH .'/views/widget.php';

	/*
		<a href="<?php echo $link; ?>"></a></div>
		<div class="textwidget"><?php echo !empty( $instance['filter'] ) ? wpautop( $text ) : $text; ?></div>
	*/	

	// After widget (defined by theme functions file)
	echo $after_widget;

}


/*-----------------------------------------------------------------------------------*/
/*	Update Widget
/*-----------------------------------------------------------------------------------*/
	
function update( $new_instance, $old_instance ) {
	$instance = $old_instance;

	$instance['title'] = strip_tags($new_instance['title']);
	$instance['link'] = $new_instance['link'];

	if ( current_user_can('unfiltered_html') )
		$instance['text'] =  $new_instance['text'];
	else
		$instance['text'] = stripslashes( wp_filter_post_kses( addslashes($new_instance['text']) ) ); // wp_filter_post_kses() expects slashed
	$instance['filter'] = isset($new_instance['filter']);

	return $instance;
}


/*-----------------------------------------------------------------------------------*/
/*	Widget Settings (Displays the widget settings controls on the widget panel)
/*-----------------------------------------------------------------------------------*/
	 
function form( $instance ) {

	$instance = wp_parse_args( (array) $instance, array( 'title' => '', 'link' => '', 'text' => '' ) );
	$title = strip_tags($instance['title']);
	$link = $instance['link'];
	$text = esc_textarea($instance['text']);
	
	?>

	<!-- Widget Title: Text Input -->
	<p>
		<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:'); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></p>
	</p>

	<!-- Widget Link: Text Input -->
	<p>
		<label for="<?php echo $this->get_field_id('link'); ?>"><?php _e('Link:'); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('link'); ?>" name="<?php echo $this->get_field_name('link'); ?>" type="text" value="<?php echo esc_attr($link); ?>" /></p>
	</p>

	<!-- Widget Text: Text Input -->
	<p>
		<label for="<?php echo $this->get_field_id('text'); ?>"><?php _e('Text:'); ?></label>
		<textarea class="widefat" rows="16" cols="20" id="<?php echo $this->get_field_id('text'); ?>" name="<?php echo $this->get_field_name('text'); ?>"><?php echo $text; ?></textarea>
	</p>

	<?php
	}
}

