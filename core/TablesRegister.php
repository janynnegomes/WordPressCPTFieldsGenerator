<?php

add_action( 'init', 'wcptfg_register_tables_init' );


function wcptfg_register_tables_init()
{
    global $wpdb;
    global $wcptfg_installation;

    $table_name = $wpdb->prefix . "wcptfg_tables";

    #read the fields from database
    $tables = $wpdb->get_results( "SELECT   name, 
                                            singular_name,
                                            add_new,
                                            add_new_item,
                                            menu_name,
                                            description,
                                            supports 
                                    FROM $table_name" );


    if($tables)
    {
        foreach ($tables as $table) {
           
           $name = $table->name;
           $singular_name = $table->singular_name;
           $add_new = $table->add_new;
           $menu_name = $table->menu_name;
           $description = $table->description;

              $labels = array( 
                'name' => __( $menu_name, 'wcptfg' ),
                'singular_name' => __( $singular_name, 'wcptfg' ),
                'add_new' => __( $add_new,  'wcptfg' ),
                'add_new_item' => __( 'Adicionar Notícias do Regional  ',  'wcptfg' ),
                'edit_item' => __( 'Editar Notícias  ', 'wcptfg' ),
                'new_item' => __( 'Nova ', 'wcptfg' ),
                'view_item' => __( 'Ver Notícias  ',  'wcptfg' ),
                'search_items' => __( 'Pesquisar Notícias  ',  'wcptfg' ),
                'not_found' => __( 'Notícias   não encontrados',  'wcptfg' ),
                'not_found_in_trash' => __( 'Sem Notícias   na lixeira',  'wcptfg' ),
                'parent_item_colon' => __( 'Parent Notícias  :', 'wcptfg' ),
                'menu_name' => __( $menu_name, 'wcptfg' ),
            );

            $supports = $table->supports;

            if(!empty($supports))
            {
                $supports = explode(',', $supports);
            }
            else
            {
                $supports = array();
            }

            #
            $taxonomies = $table->taxonomies;

            if(!empty($taxonomies))
            {
                $taxonomies = explode(',', $taxonomies);
            }
            else
            {
                $taxonomies = array();
            }

            $args = array( 
                            'labels' => $labels,
                            'hierarchical' => true,
                            'description' => $description,
                            'supports' => $supports,
                            'taxonomies' => $taxonomies,
                            'public' => true,
                            'show_ui' => true,
                            'show_in_menu' => 'edit.php',
                            'menu_position' => 5,
                            
                            'show_in_nav_menus' => true,
                            'publicly_queryable' => true,
                            'exclude_from_search' => false,
                            'has_archive' => true,
                            'query_var' => true,
                            'can_export' => true,
                            'rewrite' => true,
                            'capability_type' => 'post'
                        );
        
        # Register table as Post Type
        register_post_type( $name, $args);

        # Look for metaboxes
        $table_name = $wpdb->prefix . "wcptfg_metaboxes";

        #read the fields from database
        $metaboxes = $wpdb->get_results( " SELECT   title,
                                                    name,                
                                                    post_type                
                                           FROM $table_name" );


        if($metaboxes)
        {
            foreach ($metaboxes as $metabox) {
               
               $name = $metabox->name;
               $title = $metabox->title;

               add_action( 'add_meta_boxes', 
                'wcptfg_add_'.$name.'metabox' );


           }
       }


        } # Close table loop

    } # Close verification

} 



function datas_evento_add_meta_box() {

  add_meta_box(
    'datas_evento_metaboxid',
    'Datas do Evento',
    'datas_evento_inner_meta_box',
    'eventodadiocese',
    'side'
  );
  }
  
function datas_evento_inner_meta_box( $eventodadiocese ) {

?>
<p>
<label  for="data_inicio_eventodadiocese">Data de Início do Evento:</label>
<br />
<input  type="datetime-local" name="data_inicio_eventodadiocese" value="<?php echo get_post_meta( $eventodadiocese->ID, '_data_inicio_eventodadiocese', true ); ?>" />
</p>
<p>
<label  for="data_final_eventodadiocese">Data Final do Evento:</label>
<br />
<input  type="datetime-local" name="data_final_eventodadiocese" value="<?php echo get_post_meta( $eventodadiocese->ID, '_data_final_eventodadiocese', true ); ?>" />
</p>
<?php 
}


?>