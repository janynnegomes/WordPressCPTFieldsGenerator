<?php
 class wcptfg_Field extends DataMethods {
   
    #private vars
    private $_title = '';
    private $_name = '';
    private $_subtitle = '';
    private $_mysqltype =  '';
    private $_nedded_validation =  '';
    private $_metabox_id =  '';

    private $_fieldlist;
    private $_newfieldlist;


   #constructors
   function __construct($title = '', $name ='', $subtitle ='', $mysqltype='', $metabox_id='' , $nedded_validation = false) {
      $this->_title = $title;
      $this->_name = $name;
      $this->_subtitle = $subtitle;
      $this->_mysqltype = $mysqltype;
      $this->_nedded_validation = $nedded_validation;
      $this->_nedded_validation = $nedded_validation;
      $this->_metabox_id = $metabox_id;

     
      $this->_fieldlist = $this->GetList($metabox_id);
   }

  function Title()
   {
     return $_title;
   }

  function Name()
   {
     return $_name;
   }

  function SubTitle()
   {
     return $_subtitle;
   }

  function MySQLTtype()
   {
     return $_mysqltype;
   }

   function GetList($metabox_id = '')
   {
      global $wpdb;  

      $result = $wpdb->get_results( " SELECT   id,
                                                  time,
                                                  title,
                                                  name,                
                                                  mysqltype,
                                                  metabox_id                
                                         FROM wp_wcptfg_fields 
                                         WHERE metabox_id =".$metabox_id );

      return $result;
   }

   public function Save()
   {
      global $wpdb;
      
      $isValid = false;
        
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
                    'mysqltype'  => join(',',$this->_mysqltype),
                    'metabox_id' => $this->_metabox_id);  
               
                global $wpdb;               

                /* $rows_affected = $wpdb->insert( 'wp_wcptfg_log', array('time'=> current_time('mysql'),
                    'title' => 'valores: '.join(',', $args)));*/

                return parent::Save('wcptfg_fields', $args, $wpdb);
            } 
        }
     }
 }
?>