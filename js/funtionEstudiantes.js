$(document).ready(function(){
//Modal From actualizar cursos visulizar información*********************************************************************
$('.add_estudiantes').click(function(e){
         e.preventDefault();
         
         var id_estudiante = $(this).attr('id_estudiante');
         var action = 'infoEstudiante';
         var activo = '';
         //alert(producto);
         
         $.ajax({
            url:'update/estudiantesAjax.php',
            type:'POST',
            async: true,
            data:{action: action, id_estudiante: id_estudiante},
  
            success: function(response) {
                
                console.log(response);
                
                if(response != 'error'){
                    
                    var info = JSON.parse(response);
                    console.log(info);

                    $('#tipo_doc').val(info.TIPO_DOC);
                    $('#documento').val(info.DOCUMENTO);
                    $('#nombre').val(info.NOMBRE);
                    $('#apellido').val(info.APELLIDO);
                    $('#cel').val(info.CEL);
                    $('#correo').val(info.CORREO);
                    $('#activo').val(info.ACTIVO);
                    $('#id_estudiante').val(info.ID);
                    

                    
                }
            },
            
            error: function(error){
                console.log(error);
            }
         });
         
         $('.Modal').fadeIn();
         
     });
     
     // formulario modal que muestra información para eliminar
     
   $('.del_estudiantes').click(function(e){
         e.preventDefault();

         var id_estudiante = $(this).attr('id_estudiante');
         var action = 'infoEstudiante';
   
         //alert(producto);
         
         $.ajax({
            url:'update/estudiantesAjax.php',
            type:'POST',
            async: true,
            data:{action: action, id_estudiante: id_estudiante},
  
            success: function(response) {
                
                console.log(response);
                
                if(response != 'error'){
                    
                    var info = JSON.parse(response);
                    console.log(info);
                    
                    $('.bodyModal').html('<form  action="" method="post" name="form_del_product" id="form_del_product" onsubmit="event.preventDefault(); delEstudiante();">'+
                                                '<h2>Eliminar Estudiante</h2>'+
                                                '<p>¿Está seguro de Eliminar el Siguiente Estudiante?</p>'+
                                                '<h2>'+info.NOMBRE+' '+info.APELLIDO+'</h2>'+
                                          
                                                '<input type="hidden" name="id_estu" id="id_estu" value="'+info.ID+'"/>'+
                                                '<input type="hidden" name="action" value="delEstudiante"/>'+
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
function sendDataEstudiantes(){
        
     $.ajax({
            url:'update/estudiantesAjax.php',
            type:'POST',
            async: true,
            data: $('#form_add_product').serialize(),
  
            success: function(response) {
                    console.log(response);
                if(response == 'error'){
                    $('.alertAddProduct').html('<p style="color:red">Error al Actualizar</p>');
                }else{
                      var info = JSON.parse(response);
                      //var info = data;  

                      var esta = info.ACTIVO;
                      if (esta == 0) {
                          esta= "Bloqueado";

                      } else {
                        esta = "Activo";
                      }

                      $('.row' + info.ID + ' .celTipodoc').html(info.NOMBREDOCU);
                      $('.row' + info.ID + ' .celDocu').html(info.DOCUMENTO);
                      $('.row' + info.ID + ' .celNombre').html(info.NOMBRE);
                      $('.row' + info.ID + ' .celApellido').html(info.APELLIDO);
                      
                      $('.row' + info.ID + ' .celEstado').html(esta);
                      $('.row' + info.ID + ' .celCelu').html(info.CEL);
                       
                
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

function delEstudiante(){
    var pr = $('#id_estu').val();
    
    $.ajax({
            url:'update/estudiantesAjax.php',
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