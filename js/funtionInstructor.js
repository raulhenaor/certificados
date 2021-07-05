$(document).ready(function(){
//Modal From actualizar cursos visulizar información*********************************************************************
$('.add_instructor').click(function(e){
         e.preventDefault();
         
         var id_instructor = $(this).attr('id_instructor');
         var action = 'infoInstructor';
         
         //alert(id_instructor);
         
         $.ajax({
            url:'update/intructorcAjax.php',
            type:'POST',
            async: true,
            data:{action: action, id_instructor: id_instructor},
  
            success: function(response) {
                
                console.log(response);
                
                if(response != 'error'){
                    
                    var info = JSON.parse(response);
                    console.log(info);
                    
                    $('#id_instructor').val(info.ID_INST);
                    $('#tipo_doc1').val(info.TIPO_DOC);
                    $('#documento1').val(info.DOCUMENTO);
                    $('#nombre1').val(info.NOMBRE);
                    $('#apellido1').val(info.APELLIDO);
                    $('#cel1').val(info.CONTACTO);
                    $('#profesion1').val(info.PROFESION);
                    $('#matricula1').val(info.MATRICULA);                    
                    $('#especialidad1').val(info.MATRICULA);
                    $('#descp1').val(info.DESCRIPCION);
                    $('#activo1').val(info.ACTIVO);
                    document.getElementById("firma2").src = "/servilog/intranet/uploads/"+info.FIRMA;
                    
                }
            },
            
            error: function(error){
                console.log(error);
            }
         });
         
         $('.Modal').fadeIn();
         
     });
     
     // formulario modal que muestra información para eliminar
     
   $('.del_instructor').click(function(e){
         e.preventDefault();
         
         var id_instructor = $(this).attr('id_instructor');
         var action = 'infoInstructor';
   
         //alert(producto);
         
         $.ajax({
            url:'update/intructorcAjax.php',
            type:'POST',
            async: true,
            data:{action: action, id_instructor: id_instructor},
  
            success: function(response) {
                
                console.log(response);
                
                if(response != 'error'){
                    
                    var info = JSON.parse(response);
                    console.log(info);
                    
                    $('.bodyModal').html('<form  action="" method="post" name="form_del_product" id="form_del_product" onsubmit="event.preventDefault(); delInstructor();">'+
                                                '<h2>Eliminar Instructor</h2>'+
                                                '<p>¿Está seguro de Eliminar el Siguiente Instructor?</p>'+
                                                '<h2>'+info.NOMBRE+' '+info.APELLIDO+'</h2>'+
                                          
                                                '<input type="hidden" name="id_inst" id="id_inst" value="'+info.ID_INST+'"/>'+
                                                '<input type="hidden" name="action" value="delInstructor"/>'+
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
function sendDataInstructor(){
    
var data = new FormData();
jQuery.each($('input[type=file]')[0].files, function(i, file) {
    data.append('file-'+i, file);
});
var other_data = $('#form_add_product').serializeArray();
$.each(other_data,function(key,input){
    data.append(input.name,input.value);
});
    
jQuery.ajax({
    url: 'update/intructorcAjax.php',
    data: data,
    cache: false,
    contentType: false,
    processData: false,
    type: 'POST',    
     /*$.ajax({
            url:'update/intructorcAjax.php',
            type:'POST',
            async: true,
            data: $('#form_add_product').serialize(),*/
            
            success: function(response) {
                    console.log(response);
                if(response == 'error'){
                    $('.alertAddProduct').html('<p style="color:red">Error al Actualizar</p>');
                }else if(response == 'error1'){
                    $('.alertAddProduct').html('<p style="color:red">Error Imagen Tamaño 1-MEGA, PNG y/o existente </p>');
                }else{
                      var info = JSON.parse(response);
                      $('.row' + info.ID_INST + ' .celTipoNom').html(info.TIPO_NOM);
                      $('.row' + info.ID_INST + ' .celCc').html(info.DOCUMENTO);
                      $('.row' + info.ID_INST + ' .celNombre').html(info.NOMBRE);
                      $('.row' + info.ID_INST + ' .celApellido').html(info.APELLIDO);
                      $('.row' + info.ID_INST + ' .celCel').html(info.CONTACTO);
                      $('.row' + info.ID_INST + ' .celProfesion').html(info.PROFESION);
                      $('.row' + info.ID_INST + ' .celMatricula').html(info.MATRICULA);
                      $('.row' + info.ID_INST + ' .celEspe').html(info.ESPECIALIDAD);
                      $('.row' + info.ID_INST + ' .celDescrip').html(info.DESCRIPCION);
                      if(info.ACTIVO==1){
                          activo='Activo'
                      }else{
                          activo='Bloqueado'
                      }
                      $('.row' + info.ID_INST + ' .celActivo').html(activo);
                      
                      $('.row' + info.ID_INST + ' .celFirma #firma3').attr('src', '/servilog/intranet/uploads/'+info.FIRMA);
                      $('#firma2').attr('src', "/servilog/intranet/uploads/"+info.FIRMA);
                      
                       
                
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

function delInstructor(){
    var pr = $('#id_inst').val();
    
    $.ajax({
            url:'update/intructorcAjax.php',
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

function closeModal1(){
    $('.alertAddProduct').html('');
    $('.Modal').fadeOut();
    location.reload();
}