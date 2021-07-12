<?php
session_start();
include '../../config/conexion.php';

//////////////// VALORES INICIALES ///////////////////////

$tabla="";
    /*$stmt=$conexion->query("SELECT ID_C, ID_TIPO_DOC, tipo_documento.TIPO_DOC, CC_CLIENTE, NOMBRES, APELLIDOS, CEL, GENERO, GS_RH, F_NACIMIENTO, ID_ACTIVO, activo.NOMBRE 
                                FROM pasajeros
                                INNER JOIN tipo_documento ON pasajeros.ID_TIPO_DOC = tipo_documento.ID
                                INNER JOIN activo ON pasajeros.ID_ACTIVO = activo.ID_A ORDER BY ID_C DESC")->fetchAll(PDO::FETCH_OBJ);*/

///////// LO QUE OCURRE AL TECLEAR SOBRE EL INPUT DE BUSQUEDA ////////////
if(isset($_POST['instructor']))
{
	$q=$_POST['instructor'];
	$query="SELECT ID_INST, TIPO_DOC, tipo_documento.NOMBRE, DOCUMENTO, instructor.NOMBRE AS NOM_INT, APELLIDO
                FROM instructor 
                INNER JOIN tipo_documento ON instructor.TIPO_DOC = tipo_documento.ID_DOC
                WHERE DOCUMENTO LIKE :cc AND ACTIVO=1 ORDER BY ID_INST DESC LIMIT 6";
        
            $stmt=$conexion->prepare($query);
            
            $stmt->execute(array(":cc"=>"%$q%"));
            
        $cuentaEstudiante = $stmt->rowCount();


if($cuentaEstudiante > 0){
    
    $tabla.=
            '<table class="table table-striped table-hover">
             <thead>
             <tr>
             <th colspan="3">Instrucores</th>
              </tr>
              <tr>

                <th>Nombres</th> 
                <th>Nombres</th>                      
                <th>Apellido</th> 


              </tr>
          </thead> 
          <tbody>  
            ';
            while($fila=$stmt->fetch(PDO::FETCH_ASSOC)){
           $tabla.=
            ' <tr>
                  <td>'.$fila['DOCUMENTO'].'</td> 
                  <td>'.$fila['NOM_INT'].'</td>                                                              
                  <td>'.$fila['APELLIDO'].'</td> 
              </tr>
		';
            }
            $tabla.='</tbody></table>';
    
} else
	{
            $tabla="<div class='alert alert-danger alert-dismissible fade show' role='alert'>
	    No se encontraron coincidencias con sus criterios de búsqueda.
            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
            </div>";

	}


echo $tabla;
}