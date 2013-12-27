<?php
class wcptfg_Table extends DataMethods {
    
    private $_table_name = "wcptfg_tables";

    #properties declaration
    private $_name = '';

    #labels
    private $_singular_name = '';
    private $_add_new = '';
    private $_add_new_item = '';
    private $_edit_item = '';
    private $_new_item = '';
    private $_view_item = '';
    private $_search_items = '';
    private $_not_found = '';
    private $_not_found_in_trash = '';
    private $_parent_item_colon = '';    
    private $_menu_name = '';

    #general settings
    private $_description = '';
    private $_taxonomies = array('post_tag','category');
    private $_supports = array('title','description');
    private $_public = true;
    private $_show_ui = true;
    private $_show_in_menu = true;
    private $_hierarchical = true;    

    #Fields Collection
    public $FiedlsCollection =  array();  


    #constructors
   /* function __construct() {
          
        $this->$_singular_name = 'Post';
        $this->$_add_new = 'New Post';
        $this->$_add_new_item = 'Add New item';
        $this->$_edit_item = 'Edit Item';
        $this->$_new_item = 'New Item';
        $this->$_view_item = 'View Item';
        $this->$_search_items = 'Search Items';
        $this->$_not_found = 'Not Found';
        $this->$_not_found_in_trash = 'Not Found in Trash';
        $this->$_parent_item_colon = 'Parent Item Colon';    
        $this->$_menu_name = 'Post Menu';

        $this->$_description = 'Description of the post type';
        $this->$_taxonomies = array('post_tag','category');
        $this->$_supports = array('title','description');
        $this->$_public = true;
        $this->$_show_ui = true;
        $this->$_show_in_menu = true;
        $this->$_hierarchical = true;    

        #Fields Collection
        public $FiedlsCollection = new array();

       }
*/

    function __construct( $name = 'News Authors', 
        $labels =  array(
                    'singular_name' => 'Notícia do Vaticano',
                    'add_new' => 'Adicionar Nova',
                    'add_new_item' => 'Adicionar Nova Notícia',
                    'edit_item' => 'Editar Notícia',
                    'new_item' => 'Nova Notícia',
                    'view_item' => 'Ver notícia',
                    'search_items' => 'Buscar notícias',
                    'not_found'=> 'Nenhuma notícia encontrada',
                    'not_found_in_trash' => 'Nada encontrado na lixeira',
                    'parent_item_colon' => '>>',
                    'menu_name' => 'Not. Vaticano'), 
        $args   = array(
                    'hierarchical'=> 1,
                    'description'=>'Exibe notícias do Vaticano'     ,
                    'supports'=> array('title','editor','excerpt','thumbnail','comments'),      
                    'taxonomies'=> array('tgenero'),    
                    'public' => 1,
                    'show_u' => 1,
                    'show_in_menu'=> 1)) 
    {
        
        global $wpdb;

        $this->_table_name = $wpdb->prefix . (empty($_table_name)? 'wcptfg_tables' : $_table_name);

        #labels 
        $this->_singular_name = $labels["singular_name"];
        $this->_name = $name;
        $this->_add_new = $labels['add_new'];
        $this->_add_new_item = $labels['add_new_item'];
        $this->_edit_item = $labels['edit_item'];
        $this->_new_item = $labels['new_item'];
        $this->_view_item = $labels['view_item'];
        $this->_search_items = $labels['search_items'];
        $this->_not_found = $labels['not_found'];
        $this->_not_found_in_trash = $labels['not_found_in_trash'];
        $this->_parent_item_colon = $labels['parent_item_colon'];
        $this->_menu_name = $labels['menu_name'];


        #arguments
        $this->_description = $args['description'];
        $this->_taxonomies =  (array) $args['taxonomies'];
        $this->_supports = (array) $args['supports'];
        $this->_public = $args['public'];
        $this->_show_ui = $args['show_ui'];
        $this->_show_in_menu = $args['show_in_menu'];
        $this->_hierarchical = $args['hierarchical'];

        #Fields Collection
        $this->FiedlsCollection =  array();

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

            /*$args =  array(
                'time' => current_time('mysql'), 
                'name' => $this->_name,
                'singular_name' => $this->_singular_name,
                'add_new'       => $this->_add_new,
                'add_new_item'  => $this->_add_new_item,
                'edit_item' => $this->_edit_item,
                'new_item' => $this->_new_item,
                'view_item' => $this->_view_item,
                'search_items' => $this->_search_items,
                'not_found' => $this->_not_found,
                'not_found_in_trash' => $this->_not_found_in_trash,
                'parent_item_colon' => $this->_parent_item_colon,
                'menu_name' => $this->_menu_name,
                'description' => $this->_description,
                'taxonomies' => is_array($this->_taxonomies)? join(',', $this->_taxonomies): $this->_taxonomies,
                'supports' => is_array($this->_supports)? join(',', $this->_supports): $this->_supports,
                'public' => $this->_public,
                'show_ui' => $this->_show_ui,
                'show_in_menu' => $this->_show_in_menu,
                'hierarchical' => $this->_hierarchical);  */          
           

            if($isValid)
            {
                /*$args = array(  'time' => current_time('mysql'), 
                        'name' => 'authors1',
                        'singular_name' => 'Lista de Autores',
                        'add_new' =>  'Novo autor',
                        'add_new_item' => 'Adicionar Nova Notícia',
                        'edit_item' => 'Editar Notícia',
                        'new_item' => 'Nova Notícia',
                        'view_item' => 'Ver notícia',
                        'search_items' => 'Buscar notícias',
                        'not_found'=> 'Nenhuma notícia encontrada',
                        'not_found_in_trash' => 'Nada encontrado na lixeira',
                        'parent_item_colon' => '>>',
                        'menu_name' => 'Not. Vaticano',
                        'hierarchical'=> 1,
                        'description'=>'Exibe notícias do Vaticano'     ,
                        'supports'=> 'title,editor,excerpt,thumbnail,comments',     
                        'taxonomies'=> '',  
                        'public' => 1,
                        'show_ui' => 1,
                        'show_in_menu'=> 1);*/

            $args =  array(
                'time' => current_time('mysql'), 
                'name' => $this->_name,
                'singular_name' => $this->_singular_name,
                'add_new'       => $this->_add_new,
                'add_new_item'  => $this->_add_new_item,
                'edit_item' => $this->_edit_item,
                'new_item' => $this->_new_item,
                'view_item' => $this->_view_item,
                'search_items' => $this->_search_items,
                'not_found' => $this->_not_found,
                'not_found_in_trash' => $this->_not_found_in_trash,
                'parent_item_colon' => $this->_parent_item_colon,
                'menu_name' => $this->_menu_name,
                'description' => $this->_description,
                'taxonomies' => is_array($this->_taxonomies)? join(',', $this->_taxonomies): $this->_taxonomies,
                'supports' => is_array($this->_supports)? join(',', $this->_supports): $this->_supports,
                'public' => $this->_public,
                'show_ui' => $this->_show_ui,
                'show_in_menu' => $this->_show_in_menu,
                'hierarchical' => $this->_hierarchical);  
            
                
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