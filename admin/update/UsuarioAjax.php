<?php
session_start();
include '../../config/conexion1.php';


if(!empty($_POST)){
    //extraer datos
    if($_POST['action']=='infoUsuario'){
       //echo 'consultar';
        $id_usu = $_POST['id_usu'];
        
        $resultado = mysqli_query($con, "SELECT * FROM usuarios WHERE ID_USU =$id_usu");
        
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
 if($_POST['action'] == 'addUsuario'){
                
    if (!empty($_POST['id_usuario']) || !empty($_POST['tipo_doc']) || !empty($_POST['documento']) || !empty($_POST['nombre']) || !empty($_POST['apellido']) || !empty($_POST['correo']) ||  !empty($_POST['activo']) || !empty($_POST['perfil']))
    {  
       
            $id_usuario = $_POST['id_usuario'];
            $tipo_doc= $_POST['tipo_doc'];
            $documento = $_POST['documento'];
            $nombre = $_POST['nombre'];
            $apellido= $_POST['apellido'];
            $correo =  $_POST['correo'];
           
            $activo = $_POST['activo'];
            $perfil = $_POST['perfil'];

                        
            $sql = mysqli_query($con, "UPDATE usuarios SET TIPO_DOC=$tipo_doc, CEDULA=$documento,  NOMBRE='$nombre', APELLIDO='$apellido', CORREO='$correo', PERFIL=$perfil, ACTIVO=$activo WHERE ID_USU=$id_usuario");
           
            if($sql)
                    {
                $resultado = mysqli_query($con, "SELECT ID_USU, TIPO_DOC, tipo_documento.NOMBRE AS NOMBREDOCU, CEDULA, CONTRASENA, usuarios.NOMBRE, APELLIDO, CORREO, PERFIL, ACTIVO 
                FROM usuarios
                INNER JOIN tipo_documento ON usuarios.TIPO_DOC = tipo_documento.ID_DOC
                WHERE ID_USU =$id_usuario");
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
        if($_POST['action']=='delUsuario'){
            //print_r($_POST);
       //echo 'consultar';
            if(empty($_POST['id_usuario']) || !is_numeric($_POST['id_usuario']) ){
                echo 'error';
            } else {
                $id_usuario = $_POST['id_usuario'];

                $sql_del = mysqli_query($con, "DELETE FROM usuarios WHERE ID_USU = $id_usuario");
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

