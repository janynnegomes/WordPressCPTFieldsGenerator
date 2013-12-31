<?php
 class wcptfg_field extends DataMethods {
   
    #private vars
    private $_title = '';
    private $_name = '';
    private $_subtitle = '';
    private $_mysqltype =  '';
    private $_nedded_validation =  '';
    private $_post_type =  '';

    private $_fieldlist;
    private $_newfieldlist;


   #constructors
   function __construct($title = '', $name ='', $subtitle ='', $mysqltype='', $post_type='' , $nedded_validation = false) {
      $this->_title = $title;
      $this->_name = $name;
      $this->_subtitle = $subtitle;
      $this->_mysqltype = $mysqltype;
      $this->_nedded_validation = $nedded_validation;
      $this->_nedded_validation = $nedded_validation;
      $this->_post_type = $post_type;

     
      $this->_fieldlist = $this->GetList($post_type);
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

   function AddToList()
   {
      if ($this->_newfieldlist == null)
      {
        $this->_newfieldlist = array();
      }

      
      array_push($this->_newfieldlist, 
        array('title' =>  $this->_title,
        'name'=> $this->_name,
        'post_type'=> $this->_post_type));

      var_dump($this->_newfieldlist);
   }


   function GetList($post_type = '')
   {
      global $wpdb;  

      $result = $wpdb->get_results( " SELECT   id,
                                                  time,
                                                  title,
                                                  name,                
                                                  mysqltype,
                                                  post_type                
                                         FROM wp_wcptfg_fields 
                                         WHERE post_type like '%".$post_type."%' " );

      return $result;
   }

   public function Save()
   {
      if ($this->_newfieldlist == null)
      {
        $this->_newfieldlist = array();
      }


      global $wpdb;

      $rows_affected = $wpdb->insert( 'wp_wcptfg_log', array('time'=> current_time('mysql'),
                    'title' => 'campo: '.join(',',$this->_newfieldlist)));


      return parent::Save('wcptfg_fields', $this->_newfieldlist, $wpdb);
   }
 }
?>