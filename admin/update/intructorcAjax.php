<?php
session_start();
include '../../config/conexion1.php';


if(!empty($_POST)){
    //extraer datos
    if($_POST['action']=='infoInstructor'){
       //echo 'consultar';
        $id_instructor = $_POST['id_instructor'];
        
        $resultado = mysqli_query($con, "SELECT ID_INST, TIPO_DOC, DOCUMENTO, NOMBRE, APELLIDO, CONTACTO, PROFESION, MATRICULA, ESPECIALIDAD, DESCRIPCION,FIRMA, ACTIVO "
                . "FROM instructor WHERE ID_INST =$id_instructor");
        
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
 if($_POST['action'] == 'addInstructor'){
   // print_r($_FILES);
   if (!empty($_POST['id_instructor']) || !empty($_POST['documento1']))
    {  
      
            $id_instructor = $_POST['id_instructor'];
            $tipo_doc = $_POST['tipo_doc1'];
            $cc= $_POST['documento1'];
            $nom = $_POST['nombre1'];
            $ape= $_POST['apellido1'];
            $cel = $_POST['cel1'];
            $profesion = $_POST['profesion1'];
            $matricula= $_POST['matricula1'];
            $especialidad= $_POST['especialidad1'];
            $descp = $_POST['descp1'];
            $activo= $_POST['activo1'];
           
           //Consultar imagen anterior
            $resultado = mysqli_query($con, "SELECT ID_INST, FIRMA FROM instructor WHERE ID_INST =$id_instructor");
            
             while ($valores = mysqli_fetch_row($resultado)){ 
                 $valorFImra=$valores[1];
                 
             }
            
            

             if(!empty($_FILES['file-0'])){
            //Datos del archivo
            $nombre_imagen=$_FILES['file-0']['name'];
            $tipo_imagen=$_FILES['file-0']['type'];
            $tamano_imagen=$_FILES['file-0']['size'];
            
            $nombre_fichero=$nombre_imagen;
                 $carpeta_destino=$_SERVER ['DOCUMENT_ROOT'] . '/servilog/intranet/uploads/';
               
                 if ($tipo_imagen=="image/png"){
                     
                     if ($tamano_imagen<=1000000) {
                        
                         if (file_exists($carpeta_destino.$nombre_imagen)){
                             $errMSG = "El archivO ya esxite";
                         }else{
                            
                          unlink($carpeta_destino.$valorFImra);
                         move_uploaded_file($_FILES['file-0']['tmp_name'],$carpeta_destino.$nombre_imagen);
                         }
   
                     } else {

                         $errMSG = "El archivo no puede superar 1MB";
                     }

                 } else {
                     $errMSG = "Solo archivos JPG, JPEG, PNG & GIF .";
                 }
                 
                 
           
             }else{
                 
                 $nombre_imagen = $valorFImra;
             }
            
            

            

         if(!isset($errMSG))
          {
            
            $sql = mysqli_query($con, "UPDATE instructor SET TIPO_DOC=$tipo_doc, DOCUMENTO='$cc', NOMBRE='$nom', APELLIDO='$ape',"
                    . "CONTACTO=$cel, PROFESION='$profesion', MATRICULA='$matricula', ESPECIALIDAD='$especialidad',"
                    . "DESCRIPCION='$descp', ACTIVO=$activo, FIRMA='$nombre_imagen' WHERE ID_INST=$id_instructor");
           
            if($sql)
                    {
                $resultado = mysqli_query($con, "SELECT ID_INST, instructor.TIPO_DOC, tipo_documento.NOMBRE AS TIPO_NOM, instructor.DOCUMENTO, instructor.NOMBRE, APELLIDO, CONTACTO, PROFESION, MATRICULA, ESPECIALIDAD, DESCRIPCION,FIRMA,ACTIVO 
                                                 FROM instructor 
                                                 INNER JOIN tipo_documento ON instructor.TIPO_DOC = tipo_documento.ID_DOC WHERE ID_INST =$id_instructor");
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
            
        echo 'error1';
    }
        
         

    }else{
        echo "error";// vacio de losc campos name    
    }
    }//if de la accion
   
    // Eliminar producto
        if($_POST['action']=='delInstructor'){
       //echo 'consultar';
            if(empty($_POST['id_inst']) || !is_numeric($_POST['id_inst'])){
                echo 'error';
            } else {
            $id_instructor = $_POST['id_inst'];
                
            //Consultar imagen anterior
            $resultado = mysqli_query($con, "SELECT ID_INST, FIRMA FROM instructor WHERE ID_INST =$id_instructor");
            
             while ($valores = mysqli_fetch_row($resultado)){ 
                 $valorFImra=$valores[1];
                 
             }
                
                $carpeta_destino=$_SERVER ['DOCUMENT_ROOT'] . '/servilog/intranet/uploads/';
                
                
                
                $sql_del = mysqli_query($con, "DELETE FROM instructor WHERE ID_INST = $id_instructor");
                mysqli_close($con);
                
                if($sql_del){
                    unlink($carpeta_destino.$valorFImra);
                    echo 'Ok';
                    
                }else{
                    echo 'error';
                }
            }
           // echo 'error';
    }

    exit();   
}//post
// primer if
//print_r($_POST);
exit();

