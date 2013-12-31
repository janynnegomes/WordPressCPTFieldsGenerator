<?php
/*
Plugin Name: Wordpress CPT Fields Generator
Version: 1.0
Description: This polugins lets you design in Wordpress Framework yout database struture in a easy way.
Author: Janynne Gomes
Plugin URI: http://wordpress.org/extend/plugins/paginacao-numerica-wordpress
Text Domain: paginacao-numerica
Domain Path: /lang
*/

require_once dirname( __FILE__ ) . '/dashboard.php';

require_once dirname( __FILE__ ) . '/core/activate.php';
require_once dirname( __FILE__ ) . '/core/TablesRegister.php';
require_once dirname( __FILE__ ) . '/core/FieldsList.php';

require_once dirname( __FILE__ ) . '/core/DataMethods.php';
require_once dirname( __FILE__ ) . '/core/wcptfg_ajax.php';
require_once dirname( __FILE__ ) . '/core/wcptfg_Table.php';
require_once dirname( __FILE__ ) . '/core/wcptfg_Metaboxes.php';
require_once dirname( __FILE__ ) . '/core/wcptfg_field.php';

register_activation_hook( __FILE__, 'wcptfg_install' );
register_activation_hook( __FILE__, 'wcptfg_install_data' );

function wcptfg_scripts($hook) {
    if( 'edit.php' == $hook )
        return;
    wp_enqueue_script( 'wcptfg_scripts', plugin_dir_url( __FILE__ ) . 'core/js/dashboard.js' );
}

add_action( 'admin_enqueue_scripts', 'wcptfg_scripts' );


 add_action( 'admin_init', 'wcptfg_style' );
   
 function wcptfg_style() {
       
       wp_register_style( 'wcptfg_style', plugins_url('/core/wp-admin.css', __FILE__) );

       wp_enqueue_style( 'wcptfg_style' );
  } 
  ?>