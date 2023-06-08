$( document ).ready(function () {

     $("#data_table").on('click', '.delete', function (e) { 
      
     e.preventDefault();
     var id = $(this).attr("idRopa");

     console.log(id);

     $.ajax({
       type: "POST",
       url: "delete.php",
       data: id,      
       success: function (response) {
         if(response==1){
		  		alert("Eliminado con exito!");
          $("#data_table").load('../php_CRUD/tabla.php'); 
		  	}else{
          
        }
       }
     }).fail( function( jqXHR, textStatus, errorThrown ) {

      if (jqXHR.status === 0) {
    
        alert('Not connect: Verify Network.');
    
      } else if (jqXHR.status == 404) {
    
        alert('Requested page not found [404]');
    
      } else if (jqXHR.status == 500) {
    
        alert('Internal Server Error [500].');
    
      } else if (textStatus === 'parsererror') {
    
        alert('Requested JSON parse failed.');
    
      } else if (textStatus === 'timeout') {
    
        alert('Time out error.');
    
      } else if (textStatus === 'abort') {
    
        alert('Ajax request aborted.');
    
      } else {
    
        alert('Uncaught Error: ' + jqXHR.responseText);
    
      }
    
    });
    
  });
     
});