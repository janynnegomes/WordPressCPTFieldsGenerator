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
                                            edit_item,
                                            new_item ,
                                            view_item,
                                            search_items, 
                                            not_found, 
                                            not_found_in_trash, 
                                            parent_item_colon, 
                                            menu_name,
                                            hierarchical,
                                            description,
                                            supports,
                                            taxonomies,
                                            public,
                                            show_ui,
                                            show_in_menu
                                    FROM $table_name" );


    if($tables)
    {
        foreach ($tables as $table) {
           
            $name =  $table->name;
            $singular_name = $table->singular_name;
            $add_new = $table->add_new;
            $add_new_item =  $table->add_new_item;
            $edit_item =  $table->edit_item;
            $new_item  =  $table->new_item;
            $view_item =  $table->view_item;
            $search_items =  $table->search_items; 
            $not_found =  $table->not_found; 
            $not_found_in_trash =  $table->not_found_in_trash; 
            $parent_item_colon =  $table->parent_item_colon; 
            $menu_name =  $table->menu_name;
            $hierarchical =  $table->hierarchical;
            $description =  $table->description;
            $taxonomies =  $table->taxonomies;
            $public =  $table->public;
            $show_ui =  $table->show_ui;
            $show_in_menu =  $table->show_in_menu;         


            $labels = array( 
                'name' => __( $menu_name, 'wcptfg' ),
                'singular_name' => __( $singular_name, 'wcptfg' ),
                'add_new' => __( $add_new,  'wcptfg' ),
                'add_new_item' => __( $add_new_item,  'wcptfg' ),
                'edit_item' => __( $edit_item, 'wcptfg' ),
                'new_item' => __( $new_item, 'wcptfg' ),
                'view_item' => __( $view_item,  'wcptfg' ),
                'search_items' => __($search_items,  'wcptfg' ),
                'not_found' => __( $not_found,  'wcptfg' ),
                'not_found_in_trash' => __( $not_found_in_trash,  'wcptfg' ),
                'parent_item_colon' => __( $parent_item_colon, 'wcptfg' ),
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
                            'show_in_menu' => true,
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
        foreach ($mblist as $metabox){                          

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
                        F.`title_as_placeholder`,
                        F.`placeholder`,
                        F.`initial_values` , 
                        F.`html_element` , 
                        F.`mysqltype` , 
                        M.`name` AS metabox_name, 
                        M.`post_type` 
                FROM    `wp_wcptfg_fields` AS F,  
                        `wp_wcptfg_metaboxes` AS M
                WHERE F.`metabox_id` = M.`ID` and F.`metabox_id` = ".$metabox_id);


            foreach ($result as $field_value)
            {
                $show_title_as_placeholder  = $field_value->title_as_placeholder == 1;
                $field_name  = $field_value->name; 
                $field_html_element  = $field_value->html_element;
                $field_initial_values  = $field_value->initial_values;
                $field_title  = $field_value->title; 
                $placeholder = $field_value->placeholder;?>
                
                <p>
                    <?php if(!$show_title_as_placeholder) { ?>
                    <label  for="wcptfg_<?php echo $field_value->name;?>"><?php echo $field_title;?></label>
                    <br />
                    <?php } ?>

                    <?php 
                            echo wcptfg_get_html_element(
                                        $field_html_element, 
                                        'wcptfg_'.$field_name, 
                                        get_post_meta( $post->ID, 'wcptfg_'.$field_name , true ),
                                        $placeholder);?>         
                </p>                   
           <?php }
        }    

} 

function wcptfg_get_html_element( $html_element_name, $id, $value, $placeholder = '') {

    $html_element = '';

    

    switch ($html_element_name) {
        case 'input':
            $html_element = '<input type="text"  
                                    name="'.$id.'" 
                                    id="'.$id.'" 
                                    value="'.$value.'"'.
                                    ((!empty($placeholder))? ' placeholder="'.$placeholder.'"': '').' />';
        break;

        case 'checkbox':
            $html_element = '<input type="checkbox" 
                                    name="'.$id.'" 
                                    id="'.$id.'" 
                                    value="true" '.$value.' />
                                    <label for="'.$id.'">'.$placeholder.'</label>';
        break;
        
        default:
            # code...
            break;
    }

    return $html_element;

 } ?>