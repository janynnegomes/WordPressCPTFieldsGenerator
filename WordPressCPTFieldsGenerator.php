<?php
/*
Plugin Name: Wordpress CPT Fields Generator
Version: 1.0
Description: Gera um shortcode pra adicionar paginação numérica ás páginas de listagem. Insira o trecho <code>echo do_shortcode('[paginacaonumerica /]');</code> logo após o fechamento do loop. ATENÇÃO: Você deve utilizar a função <code>query_posts</code> pra trazer a listagem.

Author: Janynne Gomes
Plugin URI: http://wordpress.org/extend/plugins/paginacao-numerica-wordpress
Text Domain: paginacao-numerica
Domain Path: /lang
*/

require_once dirname( __FILE__ ) . '/dashboard.php';

require_once dirname( __FILE__ ) . '/core/activate.php';
require_once dirname( __FILE__ ) . '/core/TablesRegister.php';

register_activation_hook( __FILE__, 'wcptfg_install' );
register_activation_hook( __FILE__, 'wcptfg_install_data' );


?>