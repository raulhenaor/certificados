$(document).ready(function(){
//Modal From actualizar cursos visulizar información*********************************************************************
$('.add_empresa').click(function(e){
         e.preventDefault();
         
         var id_empresa = $(this).attr('id_empresa');
         var action = 'infoEmpresa';
         
         //alert(id_instructor);
         
         $.ajax({
            url:'update/empresaAjax.php',
            type:'POST',
            async: true,
            data:{action: action, id_empresa: id_empresa},
  
            success: function(response) {
                
                console.log(response);
                
                if(response != 'error'){
                    
                    var info = JSON.parse(response);
                    console.log(info);
                    
                    $('#id_empresa').val(info.ID_EMP);
                    $('#nom_emp').val(info.NOMBRE_EMPRESA);
                    $('#nit').val(info.NIT);
                    $('#web').val(info.WEB);
                    $('#dir').val(info.DIR);
                    $('#cel1').val(info.TEL_UNO);
                    $('#cel2').val(info.TEL_DOS);
                    $('#ciudad').val(info.CIUDAD);
                    $('#representante').val(info.REPRESENTANTE);                    

                    document.getElementById("logo2").src = "/servilog/intranet/uploads/"+info.LOGO;
                    
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
    url: 'update/empresaAjax.php',
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
                      $('.row' + info.ID_EMP + ' .celNomEmp').html(info.NOMBRE_EMPRESA);
                      $('.row' + info.ID_EMP + ' .celNit').html(info.NIT);
                      $('.row' + info.ID_EMP + ' .celWeb').html(info.WEB);
                      $('.row' + info.ID_EMP + ' .celDir').html(info.DIR);
                      $('.row' + info.ID_EMP + ' .celCiudad').html(info.CIUDAD);
                      $('.row' + info.ID_EMP + ' .celCel').html(info.TEL_UNO);
                      $('.row' + info.ID_EMP + ' .celCel2').html(info.TEL_DOS);
                      $('.row' + info.ID_EMP + ' .celRepren').html(info.REPRESENTANTE);

                      
                      $('.row' + info.ID_EMP + ' .celLogo #firma3').attr('src', '/servilog/intranet/uploads/'+info.LOGO);
                      $('#logo2').attr('src', "/servilog/intranet/uploads/"+info.LOGO);
                      
                       
                
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