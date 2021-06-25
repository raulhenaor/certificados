$(document).ready(function(){
//Modal From actualizar cursos*********************************************************************
$('.add_curso').click(function(e){
         e.preventDefault();
         
         var id_curso = $(this).attr('id_curso');
         var action = 'infoCurso';
         var activo = '';
         //alert(producto);
         
         $.ajax({
            url:'update/cursosAjax.php',
            type:'POST',
            async: true,
            data:{action: action, id_curso: id_curso},
  
            success: function(response) {
                
                console.log(response);
                
                if(response != 'error'){
                    
                    var info = JSON.parse(response);
                    console.log(info);
                    
                    if(info.ACTIVO==1){
                        activo='Activo';                        
                    }else{
                        activo='Bloqueado';
                    }
                    
                    $('.bodyModal').html('<form  action="" method="post" name="form_add_product" id="form_add_product" onsubmit="event.preventDefault(); sendDataCursos();">'+
                                                '<div class="iconoAct text-success"><i class="fas fa-edit"></i></div>'+
                                                '<h3>ACTUALIZAR REGISTRO CURSOS</h3><br>'+
                                                '<label for="exampleFormControlInput1" class="form-label">NORMA:</label>'+
                                                '<input type="number" name="norma" id="norma" class="form-control" value="'+info.NORMA+'" placeholder="Registro del Bote"/><br> '+
                                                
                                                '<label for="exampleFormControlInput1" class="form-label">NOMBRE DEL CURSO:</label>'+
                                                '<input type="text" name="nom_cursos" id="nom_curso" class="form-control" value="'+info.NOMBRE_CURSO+'" placeholder="Nombre del Bote"/><br> '+
                                                
                                                '<label for="exampleFormControlInput1" class="form-label">HORAS:</label>'+  
                                                '<input type="number" name="horas" id="horas" class="form-control" value="'+info.HORAS+'" placeholder="Nombre de la Patente"/><br> '+
                                                
                                                '<label for="exampleFormControlInput1" class="form-label">CREDITOS:</label>'+  
                                                '<input type="number" name="creditos" id="creditos" class="form-control" value="'+info.CREDITOS+'" placeholder="Nombre de la Patente"/><br> '+
                                                
                                                '<label for="exampleFormControlInput1" class="form-label">ESTADO:</label>'+  
                                                '<select class="form-select" aria-label="Default select example" name="activo" id="activo">'+
                                                '<option value="'+info.ACTIVO+'">'+activo+'</option>'+
                                                '<option value="1">Activo</option>'+
                                                '<option value="2">Bloqueado</option>'+
                                                '</select>'+
                                                
                                                '<label for="exampleFormControlInput1" class="form-label">SIGLA:</label>'+
                                                '<input type="text" name="sigla" id="sigla" class="form-control" value="'+info.SIGLA+'" placeholder="Nombre del Bote"/><br> '+

                                                
                                                '<input type="hidden" name="idC" id="idC" value="'+info.ID+'"/>'+
                                                '<input type="hidden" name="action" value="addCurso"/>'+
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
});//fin funcion inicia

// Actualizar Boton empresas ************************************************************
function sendDataCursos(){
    
    var activo='';
    
     $.ajax({
            url:'update/cursosAjax.php',
            type:'POST',
            async: true,
            data: $('#form_add_product').serialize(),
  
            success: function(response) {
                    console.log(response);
                if(response == 'error'){
                    $('.alertAddProduct').html('<p style="color:red">Error al Actualizar</p>');
                }else{
                      var info = JSON.parse(response);
                      $('.row' + info.ID + ' .celNorma').html(info.NORMA);
                      $('.row' + info.ID + ' .celNomCurso').html(info.NOMBRE_CURSO);
                      $('.row' + info.ID + ' .celHoras').html(info.HORAS);
                      $('.row' + info.ID + ' .celCreditos').html(info.CREDITOS);
                      if(info.ACTIVO==1){
                          activo='Activo'
                      }else{
                          activo='Bloqueado'
                      }
                      $('.row' + info.ID + ' .celEstado').html(activo);
                      $('.row' + info.ID + ' .celSigla').html(info.SIGLA);
                       
                
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