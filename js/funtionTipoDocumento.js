$(document).ready(function(){
//Modal From actualizar cursos*********************************************************************
$('.add_tipodoc').click(function(e){
         e.preventDefault();

         
         
         var id_doc = $(this).attr('id_doc');
         var action = 'infoTipoDoc';
         //alert (id_doc);
         
         
         $.ajax({
            url:'update/tipoDocAjax.php',
            type:'POST',
            async: true,
            data:{action: action, id_doc: id_doc},
  
            success: function(response) {
                
                console.log(response);
                
                if(response != 'error'){
                    
                    //información traida del php
                    var info = JSON.parse(response);
                    console.log(info);
                    
                    
                    
                    $('.bodyModal').html('<form  action="" method="post" name="form_add_product" id="form_add_product" onsubmit="event.preventDefault(); sendDataTipoDoc();">'+
                                                '<div class="iconoAct text-success"><i class="fas fa-edit"></i></div>'+
                                                '<h3>ACTUALIZAR REGISTRO TIPO DOCUMENTO</h3><br> '+
                                                '<label for="exampleFormControlInput1" class="form-label">NOMBRE DEL CURSO:</label>'+
                                                '<input type="text" name="nom_docu" id="nom_docu" class="form-control" value="'+info.NOMBRE+'" placeholder="Nombre del Documento"/><br>'+
                                                '<input type="hidden" name="id_doc" id="id_doc" value="'+info.ID_DOC+'"/>'+
                                                '<input type="hidden" name="action" value="addTipoDoc"/>'+
                                                '<div class="alertAddProduct"></div>'+
                                                '<div class="d-grid gap-2 d-md-flex justify-content-md-end">'+
                                                '<button type="submit" class="btn btn-outline-success">Actualizar</button>'+
                                                '<a href="#" class="closeModal btn btn-outline-success" onclick="closeModal();">Cerrar</a>'+
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


     $('.del_tipodoc').click(function(e){
        e.preventDefault();
        
        
        var id_tipodoc = $(this).attr('id_doc');
        var action = 'infoTipoDoc';
        
  
        //alert(producto);
        
        $.ajax({
           url:'update/tipoDocAjax.php',
           type:'POST',
           async: true,
           data:{action: action, id_doc: id_tipodoc},
 
           success: function(response) {
               
               console.log(response);
               
               if(response != 'error'){
                   
                   var info = JSON.parse(response);
                   console.log(info);
                   
                   $('.bodyModal').html('<form  action="" method="post" name="form_del_product" id="form_del_product" onsubmit="event.preventDefault(); delTipoDoc();">'+
                                               '<h2>Eliminar Curso</h2>'+
                                               '<p>¿Está seguro de Eliminar el Siguiente Documento?</p>'+
                                               '<h2>'+info.NOMBRE+'</h2>'+
                                         
                                               '<input type="hidden" name="id_c" id="id_c" value="'+info.ID_DOC+'"/>'+
                                               '<input type="hidden" name="action" value="delDocu"/>'+
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
function sendDataTipoDoc(){
    
   
     $.ajax({
            url:'update/tipoDocAjax.php',
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
                      $('.row' + info.ID_DOC + ' .celNombreDocu').html(info.NOMBRE);
                       
                
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

function delTipoDoc(){
    var pr = $('#id_c').val();
    
    $.ajax({
            url:'update/tipoDocAjax.php',
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