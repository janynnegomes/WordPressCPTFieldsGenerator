<?php

global $wcptfg_installation;
$wcptfg_installation = "1.0";

function wcptfg_install($blog_id=null) {

	if(empty($blog_id))
            $blog_id = get_current_blog_id();

        //if a blog id is specified, switch to it
        if(MULTISITE && !switch_to_blog($blog_id))
            return;

        require_once dirname( __FILE__ ) . '/wcptfg_databasegenerator.php';	

        # Start creating database structure
        wcptfg_generate_table_structure();

        wcptfg_generate_fields_structure();

        wcptfg_generate_metaboxes_structure();

        wcptfg_generate_log_structure();

        # End database structure generation

        add_option( "wcptfg_installation", $wcptfg_installation );

}

function wcptfg_install_data() {

    # Create the Authors Table
    $sampleLabel = array(
		'singular_name' => 'My Sample Table',
	  	'add_new' => 'Add New Sample Item',
	  	'add_new_item' => 'Add New Sample Item',
	  	'edit_item' => 'Add New Sample Item',
	  	'new_item' => 'New Item',
	  	'view_item' => 'View Sample Item',
		'search_items' => 'Search Sample Tables',
		'not_found'=> 'Sample Table not found',
		'not_found_in_trash' => 'Sample Table not found in trash',
		'parent_item_colon' => '>>',
		'menu_name' => 'my Sample Table');

    $sampleArgs = array(
		'hierarchical'=> 1,
		'description'=>'Show Sample Table items. This description ... '		,
		'supports'=> array('title','editor','excerpt','thumbnail','comments'),		
		'taxonomies'=> array('tax_sample'),	
		'public' => 1,
		'show_ui' => 1,
		'show_in_menu'=> 1); 

    $sample_table_name = 'mysampletable';

    $AuthorsTable = new wcptfg_Table($sample_table_name, $sampleLabel, $sampleArgs);
 	$AuthorsTable->Save();

 	$metaboxes = new wcptfg_Metaboxes('sample', 'Sample Fields', array($sample_table_name));
 	$metabox_id = $metaboxes->Save();

 	$samplefield = new wcptfg_field('Full People Name: ', 'full-name', 'This will be used latter', 'char(10)', $metabox_id, false, 'input', '', true, 'Your name here');
 	$samplefield->Save();

 	$samplefield = new wcptfg_field('E-mail', 'email', 'This will be used latter', 'char(10)', $metabox_id, false , 'input', '', false, 'user@mail.com');
 	$samplefield->Save();

 	$metabox_id = 0;


 	$metaboxes = new wcptfg_Metaboxes('second-sample', 'Second Sample Fields', array($sample_table_name));
 	$metabox_id = $metaboxes->Save();

 	$samplefield = new wcptfg_field( 'Address: ', 'address-1', 'Full Address', 'char(100)', $metabox_id, false, 'input', '', false, 'Street Name, number...');
 	$samplefield->Save();

 	$samplefield = new wcptfg_field('Zip Code: ', 'zip-code',  'The zip code', 'char(10)', $metabox_id, false, 'input', '', false, '00000-000');
 	$samplefield->Save();

} ?>