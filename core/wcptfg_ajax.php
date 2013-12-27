<?php

add_action('wp_ajax_wcptfg_save_table', 'wcptfg_save_table');


function wcptfg_save_table()
{   
    $wcptfg_table_name = isset($_POST['wcptfg_table_name'])?$_POST['wcptfg_table_name']:''; 
    $add_new = isset($_POST['add_new'])?$_POST['add_new']:''; 
    $name = isset($_POST['name'])?$_POST['name']:''; 
    $add_new_item = isset($_POST['add_new_item'])?$_POST['add_new_item']:''; 
    $menu_name = isset($_POST['menu_name'])?$_POST['menu_name']:''; 

    //Try o create the table

    # Create the Authors Table
    $labels = array(
        'singular_name' => $wcptfg_table_name,
        'add_new' => $add_new,
        'add_new_item' => $add_new_item,
        'edit_item' => 'Add New Sample Item',
        'new_item' => 'New Item',
        'view_item' => 'View Sample Item',
        'search_items' => 'Search Sample Tables',
        'not_found'=> 'Sample Table not found',
        'not_found_in_trash' => 'Sample Table not found in trash',
        'parent_item_colon' => '>>',
        'menu_name' =>  $menu_name);

    $args = array(
        'hierarchical'=> 1,
        'description'=>'Show Sample Table items. This description ... '     ,
        'supports'=> array('title','editor','excerpt','thumbnail','comments'),      
        'taxonomies'=> array('tax_sample'), 
        'public' => 1,
        'show_ui' => 1,
        'show_in_menu'=> 1); 


    $wcptfg_new_table = new wcptfg_Table($name, $labels, $args);
    
    $save_result = $wcptfg_new_table->Save();
    
    if($save_result)
    {
        echo 'Your new table was created sucessfuly. COngratulations. Next step, create the fields.';
    }
    else
    {
        echo 'Ops, we could not create yout table on Wordpress.';
    }
    
    die();

}  ?>