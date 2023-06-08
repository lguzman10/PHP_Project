$( document ).ready(function() {

  //Oculta el botón de actualizar y cancelar

  $("#actualizar").hide();
  $("#cancelar").hide();

  //Validación del formualrio

  var validate = $("#frm-articulo").validate({
    rules:{
      selection:{
        required: true
      },
      title:{
        required: true, 
        minlength: 1
      },
      description:{
        required: true,
        maxlength: 255
      }
    },

    messages:{
      selection:{
        required: "Debes seleccionar una categoría"
      },
      title: {
        required: "Debes ingresar un nombre",
        minlength: "Debe contener al menos un caracter"
      },
      description:{
        required: "Debes agregar una descripción",
        minlength: "La descripción debe ser de al menos cinco caracteres"
      }
    }
  });


  //Envía los datos del formulario
    
  $( "#frm-articulo" ).submit('#save_task', function( event ) { 

      event.preventDefault(); 
      
      if($("#list").valid && $("#titulo").valid() && $("#descripcion").valid()){
        $.post( "save.php", { 
          selection: $( "#list" ).val(), 
          title: $( "#titulo" ).val(), 
          description: $( "#descripcion" ).val() 
        }).done(function( data ) { 
            console.log(data);
            let success = data.success;
            var message = data.message;
            if(success == false){
              alertify.alert('Error', message, function(){});
            }
            else{
              alertify.alert('AVISO', '¡Registro guardado correctamente!', function(){});
            }
            // let respuesta = JSON.parse(data);
            // console.log(respuesta);
            $( "#frm-articulo" )[0].reset();
            $("#data_table").load('../php_CRUD/tabla.php');  
        }); 
      }
    });  

  //Función para eliminar regisrtos

  $("#data_table").on('click', '.delete', function (e) { 

    e.preventDefault();
    var id_borrar = $(this).attr("idRopa");
    console.log(id_borrar);

    alertify.confirm('Eliminar Datos', '¿Esta seguro de eliminar este registro?', 
          function(){ 
            $.post( "delete.php", {
              id_articulo: id_borrar , 
            }).done(function( data ) {
              console.log(data);
              $("#data_table").load('../php_CRUD/tabla.php');    
            }); 
            }, function(){ alertify.error('La operación fue cancelada')}); 
  });

  //Función para editar los registros

  $("#data_table").on('click', '.modif', function (e) { 
    
    e.preventDefault();

    $("#cancelar").show();
    validate.resetForm();

    //Almacena el valor de los campos del formulario, el ID está oculto
    
    var id_modificar = $(this).attr("data-id");
    var categoria = $(this).attr("data-categoria");
    var nombre = $(this).attr("data-nombre");
    var descripcion = $(this).attr("data-descripcion");

    console.log(id_modificar)

    $.post( "404.php", { 
      selection: $( "#list" ).val()
    }).done(function( data ) { 
        var comprobar = data.message;

        if(comprobar == false){
          url = "404.html";
          $(location).attr('href',url)
        }else{
          //Carga los registros de la tabla en el formulario para que sean modificados
      
          $('#idpersona').val(id_modificar);
          $('#list').val(categoria);
          $('#titulo').val(nombre);
          $('#descripcion').val(descripcion); 
      
          //Oculta el botón guardar y muestra el botón actualizar
          
          $("#guardar").hide();
          $("#actualizar").show();
        }
        //Envía los registros actualizados usando el método post
    
        $("#frm-articulo").on('click', '#actualizar', function (event) {   
    
          event.preventDefault();
          
          if ($("#list").valid && $("#titulo").valid() && $("#descripcion").valid()) {
            $.post( "edit.php", { 
              id_articulo: $('#idpersona').val(),
              selection:  $('#list').val(),
              title:  $('#titulo').val(), 
              description:  $('#descripcion').val()
            }).done(function( data ) { 
              let success = data.success;
              var message = data.message;

              if (success == false) {
                alertify.alert('Error', message, function(){});
              }else{
                alertify
                  .alert('AVISO', "Registro actualizado correctamente", function(){
                });
                console.log(data)
                $("#actualizar").hide();
                $("#guardar").show();
                $("#cancelar").hide();
                $( "#frm-articulo" )[0].reset();
                $("#data_table").load('../php_CRUD/tabla.php');  
              }
            });    
          }      
        });
    
        $('#cancelar').on('click', function (event) {
    
          event.preventDefault();
    
          $("#actualizar").hide();
          $("#cancelar").hide();
          $("#guardar").show();
          $("#frm-articulo")[0].reset();
          validate.resetForm();
      
        });
    }); 

  });
});