$(obtener_registros());
$(obtener_registros_familiar());

// MOSTRAR LOS RESULTADOS EN LA SECCION PASAJERO/////////////////////////
function obtener_registros(estudiante){   
    $.ajax({
        url: 'consultas/consultasEstudiantes.php',
        type: 'POST',
        dataType: 'html',
        data: {estudiante: estudiante},          
    })
    
      .done(function(resultado){
          $("#tabla_resultado").html(resultado);
      })  
}
// CAPTURAR INPUT DE BUSQUEDA Y ENVIAR PARAMETRO PASAJERO/////////////////
$(document).on('keyup', '#busqueda', function(){
    
    var valorBusqueda = $(this).val();
    if(valorBusqueda!=""){
        obtener_registros(valorBusqueda);
    }else{
        obtener_registros();
    }
    
});

    
function obtener_registros_familiar(instructor){   
    $.ajax({
        url: 'consultas/consultasInstructor.php',
        type: 'POST',
        dataType: 'html',
        data: {instructor: instructor},          
    })
    
      .done(function(resultado){
          $("#tabla_resultado").html(resultado);
      })  
}

// CAPTURAR INPUT DE BUSQUEDA Y ENVIAR PARAMETRO PASAJERO FAMILIAR/////////////////
$(document).on('keyup', '#busquedaFamiliar', function(){
    
    var valorBusquedaF = $(this).val();
    if(valorBusquedaF!=""){
        console.log(valorBusquedaF);
        obtener_registros_familiar(valorBusquedaF);
    }else{
        obtener_registros_familiar();
    }
});
  