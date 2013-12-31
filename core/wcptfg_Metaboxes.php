<?php
class wcptfg_Metaboxes extends DataMethods {
    
    private $_table_name = "wcptfg_metaboxes";

    #properties declaration
    private $_name = '';
    private $_post_type = '';
    private $_title = '';

    function __construct( $name = '', $title = '', $post_type = array()) 
    {
        
        global $wpdb;

        $this->_table_name = $wpdb->prefix . (empty($_table_name)? 'wcptfg_metaboxes' : $_table_name);

        $this->_title = $title;
        $this->_name = $name;
        $this->_post_type = $post_type;
        
       }

    # Database manipulation functions
    public function Save()
    { 
        $isValid = false;
        
        //var_dump($this->_name);

        #validation
        if(true)//!empty($this->$_name))
        {
            $isValid = true;

            
            if($isValid)
            {

                $args =  array(
                    'time' => current_time('mysql'), 
                    'name' => $this->_name,
                    'title' => $this->_title,
                    'post_type'  => join(',',$this->_post_type)
                    );  
               
                global $wpdb;               

                $rows_affected = $wpdb->insert( 'wp_wcptfg_log', array('time'=> current_time('mysql'),
                    'title' => 'valores: '.join(',', $args)));

                return parent::Save(/*$this->_table_name*/ 'wcptfg_metaboxes', $args, $wpdb);
            } 
        }
        }   
    

    public function GetList($args = array('id','name'), $post_type)
    {           
        global $wpdb;  

        $result = $wpdb->get_results( " SELECT   id,
                                                    time,
                                                    title,
                                                    name,                
                                                    post_type                
                                           FROM wp_wcptfg_metaboxes 
                                            WHERE post_type like '%".$post_type."%' " );

        return $result;
    } 
}