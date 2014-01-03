<?php 

add_action( 'admin_init', 'wcptfg_register_settings' );

add_action('admin_menu', 'wcptfg_menu');

add_action('wp_head', 'wcptfg_embed_style');


function wcptfg_menu() {
   
   add_management_page(  __('Fields','wcptfg'),
                        __('WCTP Fields Generator','wcptfg'), 
                        'manage_options', 
                        'wcptfg_dashboard_page',
                        'wcptfg_dashboard' );

  
}

function wcptfg_register_settings() 
{ 
  register_setting( 'tables_register', 'tables' );
}


function wcptfg_dashboard()
{?>
  <script type="text/javascript">
  
  </script>

  <div class="wrap">
  <?php screen_icon(); ?>
  <h2> <?php _e('Structures','wcptfg'); ?> </h2>
   <form method="post" action="options.php">
    <?php settings_fields( 'tables_register' ); ?>
    
    <table class="wp-list-table widefat fixed pages wcptfg-table">
    <tr>
    <td>
      
      <div class="row">  
          <div class="col-lg-6">
            
            <div class="input-group">
              
              <input type="text"  class="form-control" name="wcptfg_table_name" id="wcptfg_table_name"  value="<?php echo esc_attr(get_option('qtdeMinimaCaracteres')); ?>" />
              <span class="input-group-btn">
                <button class="btn btn-default" disabled="disabled"  name="btnCreateTable" id="btnCreateTable" type="button">Create table!</button>
              </span>
            </div><!-- /input-group -->
          </div><!-- /.col-lg-6 -->
      </div><!-- /.row -->

      </td>
      <tr>
      <td>
        <div id="divCreateTable" style="display:none;" >

        <div class="panel panel-default">
              <!-- Default panel contents -->
              <div class="panel-heading"><?php _e('+ Adding new Table','wcptfg'); ?></div>
              <div class="panel-body">
                <p><?php _e('This adds a new Wordpress structure to your relational table.','wcptfg'); ?></p>
              </div>

              <!-- Table -->
              <table class="table">

                <thead>                
                  <tr>
                    <th>#</th>
                    <th><?php _e('Table Atributes','wcptfg'); ?></th>
                    <th><?php _e('Atributes Value','wcptfg'); ?></th>                   
                  </tr>
                </thead>

                <tbody>
            <?php
              /*

               http://codex.wordpress.org/Function_Reference/register_post_type

                Labels: 

              'name' - general name for the post type, usually plural. The same as, and overridden by $post_type_object->label
              'singular_name' - name for one object of this post type. Defaults to value of name
              'menu_name' - the menu name text. This string is the name to give menu items. Defaults to value of name
              'all_items' - the all items text used in the menu. Default is the Name label
              'add_new' - the add new text. The default is Add New for both hierarchical and non-hierarchical types. When internationalizing this string, please use a gettext context matching your post type. Example: _x('Add New', 'product');
              'add_new_item' - the add new item text. Default is Add New Post/Add New Page
              'edit_item' - the edit item text. Default is Edit Post/Edit Page
              'new_item' - the new item text. Default is New Post/New Page
              'view_item' - the view item text. Default is View Post/View Page
              'search_items' - the search items text. Default is Search Posts/Search Pages
              'not_found' - the not found text. Default is No posts found/No pages found
              'not_found_in_trash' - the not found in trash text. Default is No posts found in Trash/No pages found in Trash
              'parent_item_colon' - the parent text. This string isn't used on non-hierarchical types. In hierarchical ones the default is Parent Page

              */ ?>

            <!-- Table Name -->  
            <tr>
              <td><label for="wcptfg_name"><?php _e('Table Name','wcptfg'); ?></label></td>
              <td><label for="wcptfg_name" id="wcptfg_name_label">-----</label></td>
            </tr>

            <tr>
              <td colspan="2"><label class="bold"><?php _e('Wordpress Labels Required','wcptfg'); ?></label></td>
              <td></td>
            </tr>

            <!-- Wordpress Singular Name-->
            <tr>
              <td><label for="wcptfg_table_singular_name"><?php _e('Singular Name','wcptfg'); ?></label></td>
              <td><input type="text"  id="wcptfg_table_singular_name"   name="wcptfg_table_singular_name" value="<?php echo esc_attr(get_option('wcptfg_singular_name')); ?>" /></td>
              <td class="wcptfg_table_atribute_subtitle">
              <p class="description"><?php _e('Name for one object of this post type. Defaults to value of name','wcptfg'); ?></p></td>
            </tr>

            <!-- Wordpress Add New -->
            <tr>
              <td><label for="wcptfg_table_add_new"><?php _e('Add new','wcptfg'); ?></label></td>
              <td><input type="text"   id="wcptfg_table_add_new"  name="wcptfg_table_add_new" value="<?php echo esc_attr(get_option('wcptfg_add_new')); ?>" /></td>
              <td class="wcptfg_table_atribute_subtitle">
              <p class="description"><?php _e('The add new text','wcptfg'); ?></p></td>
            </tr>

            <!-- Wordpress Add New -->
            <tr>
              <td><label for="wcptfg_add_new_item"><?php _e('Add new item','wcptfg'); ?></label></td>
              <td><input type="text"  id="wcptfg_table_add_new_item" name="wcptfg_table_add_new_item" value="<?php echo esc_attr(get_option('wcptfg_add_new_item')); ?>" /></td>
              <td class="wcptfg_table_atribute_subtitle">
              <p class="description"><?php _e('The add new item text','wcptfg'); ?></p></td>
            </tr>

            <!-- Wordpress Menu Name -->
            <tr>
              <td><label for="wcptfg_menu_name"><?php _e('Menu name','wcptfg'); ?></label></td>
              <td><input type="text"   name="wcptfg_table_menu_name" id="wcptfg_table_menu_name" value="<?php echo esc_attr(get_option('wcptfg_menu_name')); ?>" /></td>
              <td class="wcptfg_table_atribute_subtitle">
              <p class="description"><?php _e('The menu name text','wcptfg'); ?></p></td>
            </tr>  

            <tr>
              <td colspan="3">
                  <div class="btn-group">
                    <button type="button" id="btnCancelSaveTable" name="btnCancelSaveTable" class="btn btn-default btn-danger">Cancel</button>
                    <button type="button" id="btnSaveTable" name="btnSaveTable" class="btn btn-default btn-success">Save</button>                    
                  </div> 
              </td>
            </tr>  

            

          </tbody>
          </table>
        </div>
        </div>

         
          
    <!-- Shows all tables created -->
     <div class="panel panel-default">
      <!-- Default panel contents -->
      <div class="panel-heading"><?php _e('Created tables','wcptfg'); ?></div>
      <div class="panel-body">
        <p><?php _e('This shows you all tables created by plugin.','wcptfg'); ?></p>
      </div>

      <!-- Table -->
      <table class="table">

        <thead>                
          <tr>
            <th><?php _e('My Tables','wcptfg'); ?></th>
            <th><?php _e('Table field','wcptfg'); ?></th>
            <th><?php _e('Actions','wcptfg'); ?></th>                   
          </tr>
        </thead>

        <tbody>

        <?php $wcptfg_created_tables =  new wcptfg_Table('');

        $list =  $wcptfg_created_tables->GetList(); 

        if(is_array($list))
          { 

            foreach ($list as $wcptfg_table) {
             ?>
            <tr>
              <td><span><a href="#"><?php echo $wcptfg_table->name; ?></a></span></td>
              <td><span><a href="#" id="AddFieldButton" name="AddFieldButton">+ Add Field</a></span></td>
              <td>

              <div class="btn-group">
                <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                  Action <span class="caret"></span>
                </button>
                <ul class="dropdown-menu" role="menu">
                  <li><a href="#">Action</a></li>
                  <li><a href="#">Another action</a></li>
                  <li><a href="#">Something else here</a></li>
                  <li class="divider"></li>
                  <li><a href="#">Separated link</a></li>
                </ul>
              </div>

              </td>

            </tr> 
          <?php 
          }
          }?>     
       </tbody>
       </table>
       </div>

  
    <?php submit_button(); ?>
    </td>
    </tr>
    </tr>
    </table>
</form>
</div>
<?php } 



function wcptfg_embed_style()
{
  $wp_admin_path = plugin_dir_url(__FILE__) . '/js/wp-admin.css'
  ?>
  <style type="text/css">            
          @import url( <?php echo $wp_admin_path; ?>);
    </style>
  <?php 
}


?>