<?php
class Field {
    
    #properties declaration
    public $title = '',
    public $subtitle = '';
    public $mysqltype =  

   #constructors
   function __construct() {
      $this.title = '';
      $this.subtitle = '';
      $this.mysqltype = String();
   }

   function __construct($title, $subtitle, $mysqltype) {
      $this.title = $title;
      $this.subtitle = $subtitle;
      $this.mysqltype = $mysqltype;
   }
}
?>