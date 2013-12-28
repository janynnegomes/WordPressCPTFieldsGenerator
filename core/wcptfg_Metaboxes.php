<?php
class wcptfg_Metaboxes extends DataMethods {
    
    private $_table_name = "wcptfg_metaboxes";

    #properties declaration
    private $_name = '';
    private $_post_type = '';
    private $_title = '';

    function __construct( $name = '', $title= 'News Authors', $post_type = array()) 
    {
        
        global $wpdb;

        $this->_table_name = $wpdb->prefix . (empty($_table_name)? 'wcptfg_metaboxes' : $_table_name);

        $this->_title = $title;
        $this->_name = $name;
        
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
                    'title' => 'nome tabela classe: '.$this->_table_name));

                return parent::Save(/*$this->_table_name*/ 'wcptfg_tables', $args, $wpdb);
            } 
        }
        }   
    

    public function GetList($args = array('id','name'))
    {           
        global $wpdb;  

        $sql = 'SELECT '.join(', ',$args).' FROM wp_wcptfg_tables ';
        
        $result = $wpdb->get_results($sql) or die(mysql_error());

        return $result;
    } 
}