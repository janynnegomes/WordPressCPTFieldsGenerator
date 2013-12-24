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
require_once dirname( __FILE__ ) . '/core/Field.php';
require_once dirname( __FILE__ ) . '/core/DataMethods.php';
require_once dirname( __FILE__ ) . '/core/wcptfg_Table.php';

register_activation_hook( __FILE__, 'wcptfg_install' );
register_activation_hook( __FILE__, 'wcptfg_install_data' );


?>