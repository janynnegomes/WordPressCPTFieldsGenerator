<?php
 class wcptfg_Field extends DataMethods {
   
    #private vars
    private $_title = '';
    private $_name = '';
    private $_subtitle = '';
    private $_mysqltype =  '';
    private $_nedded_validation =  '';
    private $_metabox_id =  '';
    private $_initial_values =  '';
    private $_html_element =  '';
    private $_show_title_as_placeholder = '';
    private $_placeholder = '';
    

    private $_fieldlist;
    private $_newfieldlist;


   #constructors
   function __construct($title = '', $name ='', $subtitle ='', $mysqltype='',  $metabox_id='' , $nedded_validation = false, $html_element ='input', $initial_values = '', $show_title_as_placeholder= false, $placeholder = '') {
      $this->_title = $title;
      $this->_name = $name;
      $this->_subtitle = $subtitle;
      $this->_mysqltype = $mysqltype;
      $this->_nedded_validation = $nedded_validation;
      $this->_metabox_id = $metabox_id;
      $this->_initial_values = $initial_values;
      $this->_html_element = $html_element;
      $this->_show_title_as_placeholder = ($show_title_as_placeholder ? '1':'0');
      $this->_placeholder = $placeholder;

          
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

      if(!empty($metabox_id)){

        $result  = $wpdb->get_results( 
                "SELECT F.`id`,
                        F.`metabox_id` , 
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
      }else {        

        $result = $wpdb->get_results(
                " SELECT  id,
                          time,
                          title,
                          name,
                          '' as metabox_name,                
                          mysqltype,
                          metabox_id,
                          html_element,
                          initial_values,
                          title_as_placeholder,
                          placeholder,
                          '' as post_type
                 FROM wp_wcptfg_fields " );
    }

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
                    'metabox_id' => $this->_metabox_id,  
                    'html_element' => $this->_html_element, 
                    'initial_values' => $this->_initial_values,
                    'title_as_placeholder' => $this->_show_title_as_placeholder,
                    'placeholder' => $this->_placeholder ); 
               
                global $wpdb;              

                
                return parent::Save('wcptfg_fields', $args, $wpdb);
            } 
        }
     }
 }
?>