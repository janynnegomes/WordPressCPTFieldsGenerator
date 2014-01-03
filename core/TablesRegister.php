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

    } # Close table loop

 } # Close verification

 add_action( 'add_meta_boxes', 'wctpfg_add_meta_box', 10, 2);

} 


function wctpfg_add_meta_box($post_id, $post) {

    global $wpdb;
    global $wcptfg_installation;

    /*
    $table_name = $wpdb->prefix . "wcptfg_tables";

    #read the fields from database
    $tables = $wpdb->get_results( "SELECT   name, 
                                            singular_name,
                                            add_new,
                                            add_new_item,
                                            menu_name,
                                            description,
                                            supports 
                                    FROM $table_name" ); */


    /* if($tables)
    {
        foreach ($tables as $table) {
           
        $name = $table->name;
        
        */  
        # Search for metaboxes on plugin database
        $table_name = $wpdb->prefix . "wcptfg_metaboxes";

        #Creates a new instance for metaboxes structures
        $metaboxes = new wcptfg_metaboxes($post->post_type);

        # Get the metabox saved on databse
        $mblist = $metaboxes->GetList(array('id', 'name'),$post->post_type);

        # Make sure that there was someting returned by the function
        if($mblist) 
        {
            //var_dump($mblist);
            foreach ($mblist as $metabox) {
                                  

                # Setting values to vars                
                $metabox_name = $metabox->name;
                $metabox_post_type = $metabox->post_type;
                $metabox_title = $metabox->title;
                $metabox_position = 'side';

                $metabox_id = $metabox_name.'_'.$metabox_post_type.'_metaboxid';

                if(isset($metabox_post_type)){
                add_meta_box(
                $metabox_id,
                $metabox_title,
                'wcptfg_inner_meta_box',
                $metabox_post_type ,
                $metabox_position,
                'high',
                array('metabox_id'=>$metabox->id)
                );
                }
               
           }

       }

    /* } # Close table loop

} # Close verification

*/
    }
      
    function wcptfg_inner_meta_box( $post, $args ) {

    $metabox_id = $args['args']['metabox_id'];

    if(!empty($metabox_id))
    {

       global $wpdb;  

        $result = $wpdb->get_results( 
                "SELECT F.`metabox_id` , 
                        F.`name` , 
                        F.`title` , 
                        F.`mysqltype` , 
                        M.`name` AS metabox_name, 
                        M.`post_type` 
                FROM    `wp_wcptfg_fields` AS F,  
                        `wp_wcptfg_metaboxes` AS M
                WHERE F.`metabox_id` = M.`ID` and F.`metabox_id` = ".$metabox_id);


            foreach ($result as $value)
            {?>
                <p>
                    <label  for="wcptfg_<?php echo $value->name;?>"><?php echo $value->title;?></label>
                    <br />
                    <input  type="text" name="wcptfg_<?php echo $value->name;?>" value="<?php echo get_post_meta( $post->ID, 'wcptfg_'.$value->name , true ); ?>" />
                </p>                   
           <?php }
        }    

} ?>