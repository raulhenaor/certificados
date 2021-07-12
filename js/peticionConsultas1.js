$(obtener_registros1());
$(obtener_registros_familiar1());

// MOSTRAR LOS RESULTADOS EN LA SECCION PASAJERO/////////////////////////
function obtener_registros1(estudiante){   
    $.ajax({
        url: 'consultas/consultasEstudiantes.php',
        type: 'POST',
        dataType: 'html',
        data: {estudiante: estudiante},          
    })
    
      .done(function(resultado){
          $("#tabla_resultado1").html(resultado);
      })  
}
// CAPTURAR INPUT DE BUSQUEDA Y ENVIAR PARAMETRO PASAJERO/////////////////
$(document).on('keyup', '#busqueda1', function(){
    
    var valorBusqueda = $(this).val();
    if(valorBusqueda!=""){
        obtener_registros1(valorBusqueda);
    }else{
        obtener_registros1();
    }
    
});

    
function obtener_registros_familiar1(instructor){   
    $.ajax({
        url: 'consultas/consultasInstructor.php',
        type: 'POST',
        dataType: 'html',
        data: {instructor: instructor},          
    })
    
      .done(function(resultado){
          $("#tabla_resultado1").html(resultado);
      })  
}

// CAPTURAR INPUT DE BUSQUEDA Y ENVIAR PARAMETRO PASAJERO FAMILIAR/////////////////
$(document).on('keyup', '#busquedaFamiliar1', function(){
    
    var valorBusquedaF = $(this).val();
    if(valorBusquedaF!=""){
        console.log(valorBusquedaF);
        obtener_registros_familiar1(valorBusquedaF);
    }else{
        obtener_registros_familiar1();
    }
});
  