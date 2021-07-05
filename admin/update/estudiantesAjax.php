<?php
session_start();
include '../../config/conexion1.php';


if(!empty($_POST)){
    //extraer datos
    if($_POST['action']=='infoEstudiante'){
       //echo 'consultar';
        $id_estudiante = $_POST['id_estudiante'];
        
        $resultado = mysqli_query($con, "SELECT * FROM estudiantes WHERE ID=$id_estudiante");

        

        mysqli_close($con);
        
        $fila = mysqli_num_rows($resultado);
        
        if ($fila > 0){
            $data = mysqli_fetch_assoc($resultado);
            echo json_encode($data, JSON_UNESCAPED_UNICODE);
            exit();
        }


               
        exit();





    }
  //Actualizar datos curso
 if($_POST['action'] == 'addEstudiante'){
                
    if (!empty($_POST['tipo_doc']) || !empty($_POST['documento']) || !empty($_POST['nombre']) || !empty($_POST['apellido']) || !empty($_POST['cel']) || !empty($_POST['correo']) || !empty($_POST['activo']))
    {  
      
            $id_estudiante = $_POST['id_estudiante'];
            $tipo_doc= $_POST['tipo_doc'];
            $documento = $_POST['documento'];
            $nombre = $_POST['nombre'];
            $apellido= $_POST['apellido'];
            $cel =  $_POST['cel'];
            $correo = $_POST['correo'];
            $activo = $_POST["activo"];
            $usuario = $_SESSION["id_usuario"];
            
            $sql = mysqli_query($con, "UPDATE estudiantes SET TIPO_DOC=$tipo_doc, DOCUMENTO=$documento, NOMBRE='$nombre', APELLIDO='$apellido', CEL=$cel, CORREO='$correo', ACTIVO=$activo, ID_USER=$usuario WHERE ID=$id_estudiante");
           
            if($sql)
                    {
                $resultado = mysqli_query($con, "SELECT ID, TIPO_DOC, tipo_documento.NOMBRE AS NOMBREDOCU, DOCUMENTO, estudiantes.NOMBRE, APELLIDO, CEL, CORREO, ACTIVO, ID_USER 
                FROM estudiantes
                INNER JOIN tipo_documento ON estudiantes.TIPO_DOC = tipo_documento.ID_DOC
                WHERE ID =$id_estudiante");
                
                
                    $fila = mysqli_num_rows($resultado);
        
                if ($fila > 0)
                        {
                    $data = mysqli_fetch_assoc($resultado);
                    
                    echo json_encode($data, JSON_UNESCAPED_UNICODE);

                    exit();
                        }
                    } else {
                        echo 'error';    
                    }                  

                    mysqli_close($con);
            
        } else {
            
        echo 'error';
    }        

           
    }//if de la accion
   
    // Eliminar Curso
        if($_POST['action']=='delEstudiante'){
            //print_r($_POST);
       //echo 'consultar';
            if(empty($_POST['id_estu']) || !is_numeric($_POST['id_estu']) ){
                echo 'error';
            } else {
                $id_estudiante = $_POST['id_estu'];

                $sql_del = mysqli_query($con, "DELETE FROM estudiantes WHERE ID = $id_estudiante");
                mysqli_close($con);
                
                if($sql_del){
                    echo 'Ok';
                }else{
                    echo 'error';
                }
            }
            //echo 'error';
    }

    exit();
}//post
// primer if
//print_r($_POST);
exit();

