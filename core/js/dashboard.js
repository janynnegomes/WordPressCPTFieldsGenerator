jQuery(function($)
{
    $.data(document.body, 'ajaxUrl', 'http://localhost/3ponto8/wp-admin/admin-ajax.php');

    $('#commentform').submit(function(e) {            

        e.preventDefault();            

        $.ajax( {
          url: $.data(document.body, 'ajaxUrl' ),
          type: 'POST',
          cache: false,
          data: $(this).serialize(),
          success: function(dados) {
            $('.comments-bottom').html( dados );
            
            $('#comment').val('');
            $('#comment').focus();

            //$(html).hide().appendTo("#respond").fadeIn(1000);
            $('#comment_alert').fadeIn(1000);
          }
        });            
      }); 
      

      $( "#btnCreateTable" ).click(function() {
        $('#wcptfg_name_label').html( $( "#wcptfg_table_name" ).val());
        $('#divCreateTable').fadeIn(1000);
      });

          

});  