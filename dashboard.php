<?php 

add_action( 'admin_init', 'wcptfg_register_settings' );

add_action('admin_menu', 'wcptfg_menu');

add_action('wp_head', 'wcptfg_embed_style');


function wcptfg_menu() {
  add_options_page( __('Fields','wcptfg'), 
                    __('WCTP Fields Generator','wcptfg'), 
                    __('manage_options','wcptfg'), 
                    'WordPressCPTFieldsGenerator.php', 
                    'wcptfg_dashboard');
}

function wcptfg_register_settings() 
{ 
  register_setting( 'configuracao_comentarios', 'qtdeMinimaCaracteres' );
}

function wcptfg_dashboard()
{?>
  <script type="text/javascript">
  
  </script>

  <div class="wrap">
  <?php screen_icon(); ?>
  <h2> <?php _e('Structures','wcptfg'); ?> </h2>
   <form method="post" action="options.php">
    <?php settings_fields( 'configuracao_comentarios' ); ?>
    
    <table class="wp-list-table widefat fixed pages">
        <tr valign="top">
        <th scope="row">Tamanho do comentário</th>
        <td>
          <fieldset>
            <legend></legend>
            <label for="qtdeMinimaCaracteres">Quantidade mínima de caracteres</label>
            <input type="text"  style="width:100px;" name="qtdeMinimaCaracteres" value="<?php echo esc_attr(get_option('qtdeMinimaCaracteres')); ?>" />
            <br/>
            
          </fieldset>
          </td>
        </tr> 

        <tr valign="top">
        <th scope="row">Tamanho do comentário</th>
        <td>
          <fieldset>
            <legend></legend>
            
            <label for="qtdeMinimaCaracteres">Quantidade máxima de caracteres</label>
            <input type="text" style="width:100px;" name="qtdeMaximaCaracteres" value="<?php echo esc_attr(get_option('qtdeMaximaCaracteres')); ?>" />
            <small>
              <em>Se não houver preenchimento, será ilimitado.</em>
            </small>
          </fieldset>
          </td>
        </tr> 

    </table>    
    <?php submit_button(); ?>
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