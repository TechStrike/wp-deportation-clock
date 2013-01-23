<?php
/*
Plugin Name: Deportation Clock
Plugin URI: https://github.com/TechStrike/wp-deportation-clock
Description: A Wordpress widget port of the Presente.org Deportation Clock
Version: 0.1
Author: TechStrike
Author URI: http://tech.st/rike
License: MIT
*/

if (!defined( DC_OBAMA_PLUGINURL ))
  define( DC_OBAMA_PLUGINURL, plugin_dir_url(__FILE__));

if (!defined( DC_OBAMA_PLUGINURL_NOHOST ))
  define( DC_OBAMA_PLUGINURL_NOHOST, str_replace(site_url(),'', plugin_dir_url(__FILE__) );

if (!defined( DC_OBAMA_PLUGINPATH ))
  define( DC_OBAMA_PLUGINPATH, plugin_dir_path(__FILE__));

$deportation_clock = new Deportation_Clock();

class Deportation_Clock {

  public function __construct()
  {
    add_action( 'init', array( $this, 'register_libs' ) );
    add_action( 'widgets_init', array( $this, 'register_widget' ) );
  }

  public function register_widget()
  {
    include DC_OBAMA_PLUGINPATH . 'widget.php';
    register_widget( 'Deportation_Clock_Widget' );
  }

  /*-----------------------------------------------------------------------------------*/
  /*  Register and load needed libs for view
  /*-----------------------------------------------------------------------------------*/

  public function register_libs()
  {
    $JS = '/assets/js/';  

    if (!is_admin()) 
    {

    wp_register_script('jshashtable',   DC_OBAMA_PLUGINURL  . $JS . 'extlib/jshashtable.js', false, null, true);
    wp_register_script('numberformatter',DC_OBAMA_PLUGINURL . $JS . 'extlib/jquery.numberformatter.js', 'jquery', null, true);
    wp_register_script('easing',        DC_OBAMA_PLUGINURL  . $JS . 'extlib/jquery.easing.js', 'jquery', null, true);
    wp_register_script('flipCounter',   DC_OBAMA_PLUGINURL  . $JS . 'extlib/jquery.flipCounter.js', 'jquery', null, true);
    wp_register_script('deportation',   DC_OBAMA_PLUGINURL  . $JS . 'deportation_clock.js', 'flipCounter', null, true);

    wp_enqueue_script('jquery');      //ships with WP
    wp_enqueue_script('jshashtable');
    wp_enqueue_script('numberformatter');
    wp_enqueue_script('easing');
    wp_enqueue_script('flipCounter');
    wp_enqueue_script('deportation');

    wp_register_style('deportation',    DC_OBAMA_PLUGINURL  . '/assets/css/deportation_clock.css', false, null);
    wp_register_style('deportationfont','http://fonts.googleapis.com/css?family=Fjalla+One', false, null);

    wp_enqueue_style('deportation');
    wp_enqueue_style('deportationfont');

    }
  }

}
