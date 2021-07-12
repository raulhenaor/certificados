$(document).ready(function(){
//Modal From actualizar cursos visulizar información*********************************************************************
$('.add_certificado').click(function(e){
         e.preventDefault();
         
         var id_certificado = $(this).attr('id_certificado');
         var action = 'infoCertificado';
         
         //alert(id_certificado);
         
         $.ajax({
            url:'update/certificadoAjax.php',
            type:'POST',
            async: true,
            data:{action: action, id_certificado: id_certificado},
  
            success: function(response) {
                
                console.log(response);
                
                if(response != 'error'){
                    
                    var info = JSON.parse(response);
                    console.log(info);
                    
                    $('#id_curso1').val(info.ID_CURSO);
                    $('#busqueda1').val(info.DOC_EST);
                    $('#busquedaFamiliar1').val(info.DOC_INST);
                   
                    $('#aprobo1').val(info.APROBADO);
                    $('#fecha_ini').val(info.F_INCIAL);
                    $('#fechaapro1').val(info.F_APROBACION);
                    $('#fechaven1').val(info.F_VENCIMIENTO);
                    $('#id_certificado1').val(info.ID_CER);                    
  
                   
                    
                }
            },
            
            error: function(error){
                console.log(error);
            }
         });
         
         $('.Modal').fadeIn();
         
     });
     
     // formulario modal que muestra información para eliminar
     
   $('.del_certificado').click(function(e){
         e.preventDefault();
         
         var id_certificado = $(this).attr('id_certificado');
         var action = 'infoCertificado';
   
         //alert(producto);
         
         $.ajax({
            url:'update/certificadoAjax.php',
            type:'POST',
            async: true,
            data:{action: action, id_certificado: id_certificado},
  
            success: function(response) {
                
                console.log(response);
                
                if(response != 'error'){
                    
                    var info = JSON.parse(response);
                    console.log(info);
                    
                    $('.bodyModal').html('<form  action="" method="post" name="form_del_product" id="form_del_product" onsubmit="event.preventDefault(); delCertificado();">'+
                                                '<h2>Eliminar Certificado</h2>'+
                                                '<p>¿Está seguro de Eliminar el Siguiente Certificado?</p>'+
                                                '<h2>'+info.NOM_EST+' '+info.APE_EST+'</h2>'+
                                          
                                                '<input type="hidden" name="id_cert" id="id_cert" value="'+info.ID_CER+'"/>'+
                                                '<input type="hidden" name="action" value="delCertificado"/>'+
                                                '<div class="alertAddProduct"></div>'+
                                                
                                                '<div class="d-grid gap-2 d-md-flex justify-content-md-center">'+
                                                '<button type="submit" class="btn-del btn btn-outline-danger"><i class="fas fa-trash-alt"></i>Eliminar</button>'+
                                                '<a href="#" class="closeModal btn btn-outline-success" onclick="closeModal1();"><i class="fas fa-times-circle"></i>Cancelar</a>'+
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
function sendDataCertificados(){
    
    var activo='';
    
     $.ajax({
            url:'update/certificadoAjax.php',
            type:'POST',
            async: true,
            data: $('#form_add_product').serialize(),
  
            success: function(response) {
                    console.log(response);
                if(response == 'error'){
                    $('.alertAddProduct').html('<p style="color:red">Error al Actualizar</p>');
                }else{
                      var info = JSON.parse(response);
                      $('.row' + info.ID_CER + ' .celNomCur').html(info.NOMBRE_CURSO);
                      $('.row' + info.ID_CER + ' .celNomEst').html(info.NOM_EST);
                      $('.row' + info.ID_CER + ' .celNomInst').html(info.NOM_INST);
                      $('.row' + info.ID_CER + ' .celFinicial').html(info.F_INCIAL);
                      $('.row' + info.ID_CER + ' .celFapro').html(info.F_APROBACION);
                      $('.row' + info.ID_CER + ' .celFVenci').html(info.F_VENCIMIENTO);
                      $('.row' + info.ID_CER + ' .celAprobado').html(info.APROBADO);
                
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

function delCertificado(){
    var pr = $('#id_cert').val();
    
    $.ajax({
            url:'update/certificadoAjax.php',
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