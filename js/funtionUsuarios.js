$(document).ready(function(){
//Modal From actualizar cursos*********************************************************************
$('.add_usuario').click(function(e){
         e.preventDefault();

         var id_usu = $(this).attr('usuario');
         var action = 'infoUsuario';
         //alert (id_doc);
         
         
         $.ajax({
            url:'update/UsuarioAjax.php',
            type:'POST',
            async: true,
            data:{action: action, id_usu: id_usu},
  
            success: function(response) {
                
                console.log(response);
                
                if(response != 'error'){
                    
                    //información traida del php
                    var info = JSON.parse(response);
                    console.log(info);

                    $('#tipo_doc').val(info.TIPO_DOC);
                    $('#documento').val(info.CEDULA);
                    $('#nombre').val(info.NOMBRE);
                    $('#apellido').val(info.APELLIDO);
                    $('#correo').val(info.CORREO);
                    $('#pass').val(info.CONTRASENA);
                    $('#activo').val(info.ACTIVO);
                    $('#perfil').val(info.PERFIL);
                    $('#id_usuario').val(info.ID_USU);
                    
                    
                     
                }
            },
            
            error: function(error){
                console.log(error);
            }
         });
         
         $('.Modal').fadeIn();
         
     });


     $('.del_usuario').click(function(e){
        e.preventDefault();
        
        
        var id_usuario = $(this).attr('usuario');
        var action = 'infoUsuario';
        
  
        //alert(producto);
        
        $.ajax({
           url:'update/UsuarioAjax.php',
           type:'POST',
           async: true,
           data:{action: action, id_usu: id_usuario},
 
           success: function(response) {
               
               console.log(response);
               
               if(response != 'error'){
                   
                   var info = JSON.parse(response);
                   console.log(info);
                   
                   $('.bodyModal').html('<form  action="" method="post" name="form_del_product" id="form_del_product" onsubmit="event.preventDefault(); delUsu();">'+
                                               '<h2>Eliminar Usuario</h2>'+
                                               '<p>¿Está seguro de Eliminar el Siguiente Usuario?</p>'+
                                               '<h2>'+info.NOMBRE+'</h2>'+
                                         
                                               '<input type="hidden" name="id_usuario" id="id_usuario" value="'+info.ID_USU+'"/>'+
                                               '<input type="hidden" name="action" value="delUsuario"/>'+
                                               '<div class="alertAddProduct"></div>'+
                                               
                                               '<div class="d-grid gap-2 d-md-flex justify-content-md-center">'+
                                               '<button type="submit" class="btn-del btn btn-outline-danger"><i class="fas fa-trash-alt"></i>Eliminar</button>'+
                                               '<a href="#" class="closeModal btn btn-outline-success" onclick="closeModal();"><i class="fas fa-times-circle"></i>Cancelar</a>'+
                                               '</div>'+
                                         '</form>');
               }
           },
           
           error: function(error){
               console.log(error);
           }
        }); 
        
        $('.Modal').fadeIn();
        
    });  

});//fin funcion inicia




// Actualizar Boton empresas ************************************************************
function sendDataUsuarios(){
    
   
     $.ajax({
            url:'update/UsuarioAjax.php',
            type:'POST',
            async: true, 
            //nunca cambiar esta hp línea           
            data: $('#form_add_product').serialize(),
  
            success: function(response) {
                    console.log(response);
                if(response == 'error'){
                    $('.alertAddProduct').html('<p style="color:red">Error al Actualizar</p>');
                }else{
                      var info = JSON.parse(response);

                      if (info.PERFIL == 1) {
                          var perr = 'Admin';

                      }

                      if (info.ACTIVO == 0) {
                        var esta1= "Bloqueado";

                    } else {
                      var esta1 = "Activo";
                    }



                      $('.row' + info.ID_USU + ' .celTipoDoc').html(info.NOMBREDOCU);
                      $('.row' + info.ID_USU + ' .celCedu').html(info.CEDULA);
                      $('.row' + info.ID_USU + ' .celNombre').html(info.NOMBRE);
                      $('.row' + info.ID_USU + ' .celApellido').html(info.APELLIDO);
                      $('.row' + info.ID_USU + ' .celCorreo').html(info.CORREO);
                      $('.row' + info.ID_USU + ' .celPerfil').html(perr);
                      $('.row' + info.ID_USU + ' .celActivo').html(esta1);

                       
                
                    //location.reload();
                   
                       $('.alertAddProduct').html('<div class="alert alert-success alert-dismissible fade show" role="alert">Actualizado Correctamente</div>');
                }

            },
            
            error: function(error){
                console.log(error);
            }
         });
    
    $('.alertAddProduct').html('');
        
}

function delUsu(){
    var pr = $('#id_usuario').val();
    
    $.ajax({
            url:'update/UsuarioAjax.php',
            type:'POST',
            async: true,
            data: $('#form_del_product').serialize(),
  
            success: function(response) {
                    console.log(response);
               if(response == 'error'){ 
                    $('.alertAddProduct').html('<div class="alert alert-danger" alert-dismissible fade show" role="alert">No se Puede Eliminar Esta Relacionado<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');
                }else{
                      
                      $('.row' + pr).remove();
                      $('#form_del_product .btn-del').remove();
                
                    //location.reload();
                   
                       $('.alertAddProduct').html('<div class="alert alert-success" alert-dismissible fade show" role="alert">Eliminado Corretamente<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');
                }

            },
            
            error: function(error){
                console.log(error); 
                
            }
         });
    
    $('.alertAddProduct').html('');
    
}


function closeModal(){
    $('.alertAddProduct').html('');
    //Limpiar Formulario Limpiar
    //$('#planilla').val('');
    $('#empresa').val(4);
    
    $('.Modal').fadeOut();
    //location.reload();
}