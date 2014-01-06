<?php

function wcptfg_generate_table_structure()
{
	global $wpdb;
	global $wcptfg_installation;	

	require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );	

	
	$table_name = $wpdb->prefix . "wcptfg_tables";


	$sql = " CREATE TABLE ".$table_name."  (
		  	id mediumint(9) NOT NULL AUTO_INCREMENT,
		  	time datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
		  	name VARCHAR(55) DEFAULT '' NOT NULL,
		 	singular_name VARCHAR(55) DEFAULT '' NOT NULL,
		  	add_new VARCHAR(55) DEFAULT '' NOT NULL,
		  	add_new_item VARCHAR(55) DEFAULT '' NOT NULL,
		  	edit_item VARCHAR(55) DEFAULT '' NOT NULL,
		  	new_item VARCHAR(55) DEFAULT '' NOT NULL,
		  	view_item VARCHAR(55) DEFAULT '' NOT NULL,
			search_items VARCHAR(55) DEFAULT '' NOT NULL,
			not_found VARCHAR(55) DEFAULT '' NOT NULL,
			not_found_in_trash VARCHAR(55) DEFAULT '' NOT NULL,
			parent_item_colon VARCHAR(55) DEFAULT '' NOT NULL,
			menu_name VARCHAR(55) DEFAULT '' NOT NULL,
			hierarchical TINYINT(1) DEFAULT 0 NOT NULL,
			description VARCHAR(100) DEFAULT 0 NOT NULL,			
			supports text DEFAULT '' NOT NULL,			
			taxonomies text DEFAULT '' NOT NULL,	
			public TINYINT(1) DEFAULT 0 NOT NULL,
			show_ui TINYINT(1) DEFAULT 0 NOT NULL,
			show_in_menu TINYINT(1) DEFAULT 0 NOT NULL,

		  UNIQUE KEY id (id)
		    );";

 	dbDelta( $sql );

}

	
function wcptfg_generate_fields_structure()
{
	global $wpdb;
	global $wcptfg_installation;	

	require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );	

	# Create Fields Table options
	$table_name = $wpdb->prefix . "wcptfg_fields";	      
   
	$sql = "CREATE TABLE ".$table_name." (
		  id mediumint(9) NOT NULL AUTO_INCREMENT,
		  time datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
		  name tinytext NOT NULL,
		  title text NOT NULL,		  
		  title_as_placeholder TINYINT(1) DEFAULT 0 NOT NULL,	  
		  placeholder text DEFAULT '' NOT NULL,	
		  metabox_id text NOT NULL,		  
		  mysqltype VARCHAR(55) DEFAULT 'VARCHAR(55)' NOT NULL,
		  html_element VARCHAR(55) DEFAULT 'input' NOT NULL,
		  initial_values text DEFAULT '' NOT NULL,
		  UNIQUE KEY id (id)
		    );";	

    dbDelta( $sql );


}


function wcptfg_generate_metaboxes_structure()
{
	global $wpdb;
	global $wcptfg_installation;	

	require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );	


    # Create Fields Table options
	$table_name = $wpdb->prefix . "wcptfg_metaboxes";	      
   
	$sql = "CREATE TABLE ".$table_name." (
		  id mediumint(9) NOT NULL AUTO_INCREMENT,
		  time datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
		  title tinytext NOT NULL,
		  name tinytext NOT NULL,
		  post_type text NOT NULL,		  
		  UNIQUE KEY id (id)
		    );";	

    dbDelta( $sql );


}



function wcptfg_generate_log_structure()
{

	global $wpdb;
	global $wcptfg_installation;	

	require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );	

    # Create Log table
    $table_name = $wpdb->prefix . "wcptfg_log";	      
   
	$sql = "CREATE TABLE ".$table_name." (
		  id mediumint(9) NOT NULL AUTO_INCREMENT,
		  time datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
		  title text NOT NULL,	  
		  UNIQUE KEY id (id)
		    );";

    dbDelta( $sql );
	
}
?>