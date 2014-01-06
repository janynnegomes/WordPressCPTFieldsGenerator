$(document).ready(function() {
    

    var triggers = $(".modalInput").overlay({

      // some mask tweaks suitable for modal dialogs
      mask: {
        color: '#ebecff',
        loadSpeed: 200,
        opacity: 0.9
      },

      closeOnClick: false
  });
  
 
    $("#btnSaveField").click(function() {
        console.log('oi');
      
      // get user input
      var input = $("input", this).val();





      // do something with the answer
      
      console.log('input');

      // close the overlay
      //triggers.eq(1).overlay().close();
  });
  });
