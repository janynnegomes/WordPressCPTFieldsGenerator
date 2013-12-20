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

	

	$table_name = $wpdb->prefix . "wcptfg_fields";
	      
   
	$sql = "CREATE TABLE ".$table_name." (
		  id mediumint(9) NOT NULL AUTO_INCREMENT,
		  time datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
		  title tinytext NOT NULL,
		  subtitle text NOT NULL,		  
		  mysqltype VARCHAR(55) DEFAULT 'VARCHAR(55)' NOT NULL,
		  UNIQUE KEY id (id)
		    );";

	

    dbDelta( $sql );
	
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
 
   add_option( "wcptfg_installation", $wcptfg_installation );
}

function wcptfg_install_data() {

    global $wpdb;

    $title = 'autor';
	$subtitle = 'Autor';
	$mysqltype = 'VARCHAR(55)';

    $table_name = $wpdb->prefix . "wcptfg_fields";

    $rows_affected = $wpdb->insert( $table_name, 
   			array( 	'time' => current_time('mysql'), 
   					'title' => $title, 
   					'subtitle' => $subtitle,
   					'mysqltype' => $mysqltype));


    #Default Table Data
    $table_name = $wpdb->prefix . "wcptfg_tables";

    /*
    INSERT INTO `sitesparresia`.`wp_11_wcptfg_tables` (`id`, `time`, `name`, `singular_name`, `add_new`, `add_new_item`, `edit_item`, `new_item`, `view_item`, `search_items`, `not_found`, `not_found_in_trash`, `parent_item_colon`, `menu_name`, `hierarchical`, `description`, `supports`, `taxonomies`, `public`, `show_ui`, `show_in_menu`) VALUES (NULL, '2013-12-31 00:00:00', 'wcptfg_videos', 'Vídeo', 'Novo vídeo', 'Add Novo Vídeo', 'Editar Vídeo', 'Novo Vìdeo', 'Ver Vídeo', 'Buscar Vídeos', '', '', '', '', '0', 'Exibe os vídeos do site', '', '', '0', '0', '0');
    */
    
    $rows_affected = $wpdb->insert( $table_name, 
   			array( 	'time' => current_time('mysql'), 
   					'name' => 'noticias_vaticano',
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
					'menu_name' => 'Not. Vaticano',
					'hierarchical'=> 1,
					'description'=>'Exibe notícias do Vaticano'		,
					'supports'=> 'title,editor,excerpt,thumbnail,comments',		
					'taxonomies'=> '',	
					'public' => 1,
					'show_u' => 1,
					'show_in_menu'=> 1));  

}



 ?>