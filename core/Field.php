<?php
class Field {
   
    #private vars
    private $_title = '';
    private $_name = '';
    private $_subtitle = '';
    private $_mysqltype =  '';
    private $_nedded_validation =  '';


   #constructors
   function __construct($title = '', $name ='', $subtitle ='', $mysqltype='', $nedded_validation = false) {
      $this->$_title = $title;
      $this->$_name = $name;
      $this->$_subtitle = $subtitle;
      $this->$_mysqltype = $mysqltype;
      $this->$_nedded_validation = $nedded_validation;
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

 }
?>