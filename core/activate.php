<?php

global $wcptfg_installation;
$wcptfg_installation = "1.0";

function wcptfg_install($blog_id=null) {

	if(empty($blog_id))
            $blog_id = get_current_blog_id();

        //if a blog id is specified, switch to it
        if(MULTISITE && !switch_to_blog($blog_id))
            return;

	global $wpdb;
	global $wcptfg_installation;

	require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );	

	# Create table Structure Options

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


	# Create Fields Table options

	$table_name = $wpdb->prefix . "wcptfg_fields";	      
   
	$sql = "CREATE TABLE ".$table_name." (
		  id mediumint(9) NOT NULL AUTO_INCREMENT,
		  time datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
		  name tinytext NOT NULL,
		  title text NOT NULL,		  
		  mysqltype VARCHAR(55) DEFAULT 'VARCHAR(55)' NOT NULL,
		  UNIQUE KEY id (id)
		    );";

	

    dbDelta( $sql );
	
	
 
   add_option( "wcptfg_installation", $wcptfg_installation );
}

function wcptfg_install_data() {

    # Create the Authors Table

    $AuthorsLabel = array(
		'singular_name' => 'Notícia do Vaticano',
	  	'add_new' => 'Adicionar Nova',
	  	'add_new_item' => 'Adicionar Nova Notícia',
	  	'edit_item' => 'Editar Notícia',
	  	'new_item' => 'Nova Notícia',
	  	'view_item' => 'Ver notícia',
		'search_items' => 'Buscar notícias',
		'not_found'=> 'Nenhuma notícia encontrada',
		'not_found_in_trash' => 'Nada encontrado na lixeira',
		'parent_item_colon' => '>>',
		'menu_name' => 'Not. Vaticano');

    $AuthorsArgs = array(
		'hierarchical'=> 1,
		'description'=>'Exibe notícias do Vaticano'		,
		'supports'=> array('title','editor','excerpt','thumbnail','comments'),		
		'taxonomies'=> array('tgenero'),	
		'public' => 1,
		'show_ui' => 1,
		'show_in_menu'=> 1);

    /*$args = array(  'time' => current_time('mysql'), 
                    'name' => 'authors',
                    'singular_name' => 'Lista de Autores',
                    'add_new' =>  'Novo autor',
                    'add_new_item' => 'Adicionar Nova Notícia',
                    'edit_item' => 'Editar Notícia',
                    'new_item' => 'Nova Notícia',
                    'view_item' => 'Ver notícia',
                    'search_items' => 'Buscar notícias',
                    'not_found'=> 'Nenhuma notícia encontrada',
                    'not_found_in_trash' => 'Nada encontrado na lixeira',
                    'parent_item_colon' => '>>',
                    'menu_name' => 'Not. Vaticano',
                    'hierarchical'=> 1,
                    'description'=>'Exibe notícias do Vaticano'     ,
                    'supports'=> 'title,editor,excerpt,thumbnail,comments',     
                    'taxonomies'=> '',  
                    'public' => 1,
                    'show_ui' => 1,
                    'show_in_menu'=> 1);*/


    $AuthorsTable = new Table('newsauthors2', $AuthorsLabel, $AuthorsArgs);

 	$AuthorsTable->Save();

}



 ?>