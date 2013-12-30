jQuery(function($)
{
    $.data(document.body, 'ajaxUrl', 'http://localhost/3ponto8/wp-admin/admin-ajax.php');

       $( "#btnSaveTable" ).click(function() {  
          
          // Getting values from page
          var wcptfg_table_name = $( "#wcptfg_table_name" ).val();
          var add_new = $( "#wcptfg_table_add_new" ).val();
          var name = $( "#wcptfg_table_name" ).val();
          var add_new_item = $( "#wcptfg_table_add_new_item" ).val();
          var menu_name = $( "#wcptfg_table_menu_name" ).val();
          

          $.ajax( {
          url: $.data(document.body, 'ajaxUrl' ),
          type: 'POST',
          cache: false,

          data: { action: "wcptfg_save_table", 
                  wcptfg_table_name: wcptfg_table_name,
                  add_new: add_new  ,
                  name: name,
                  add_new_item: add_new_item, 
                  menu_name: menu_name },

          success: function(dados) {
            
            $( "#btnSaveTable" ).after( "<span  class='wcptfg_server_response'>"+dados+"</span>" ).fadeIn(50);;          
          }
        }); 

            });


     
      
      $('#wcptfg_table_name').on('keyup', function () {
          
          var wcptfg_table_name = $( "#wcptfg_table_name" ).val();  

          if(wcptfg_table_name.trim().length > 0 )
          {
            $( "#btnCreateTable" ).attr( "disabled", false );    
            $( "#btnCreateTable" ).addClass('btn-success');

            $( "#btnCreateTable" ).click(function() {        
              $('#wcptfg_name_label').html( $( "#wcptfg_table_name" ).val());
              $('#divCreateTable').fadeIn(1000);
            });

          }
          else
          {
            $('#divCreateTable').fadeOut(500);

            $( "#btnCreateTable" ).attr( "disabled", true );  
            $( "#btnCreateTable" ).removeClass('btn-success');        

            $("#btnCreateTable").click(function(e){
                    e.preventDefault();
                });
          }

      });


  

      

          

});  