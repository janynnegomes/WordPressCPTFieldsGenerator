<?php
class DataMethods {
    
    #properties declaration
    public $listTitle = '';
    public $subtitle = '';

    public $FiedlsCollection =  array();

   

    #constructors
    function SaveField($field) {       

    $title = $field.title;
    $subtitle = 'Autor';
    $mysqltype = 'VARCHAR(55)';

    $table_name = $wpdb->prefix . "wcptfg_fields";

    $rows_affected = $wpdb->insert( $table_name, 
            array(  'time' => current_time('mysql'), 
                    'title' => $title, 
                    'subtitle' => $subtitle,
                    'mysqltype' => $mysqltype));

    }

     function Save($db_table_name, $args, $wpdb)
    {
        $db_table_name = $wpdb->prefix . $db_table_name;

        $rows_affected = $wpdb->insert( 'wp_wcptfg_log', array('time'=> current_time('mysql'),
                    'title' => 'nome: '.$db_table_name));

        $rows_affected = $wpdb->insert( $db_table_name, $args);                   
    }

    function Delete($table)
    {
       
    }



   
}
?>