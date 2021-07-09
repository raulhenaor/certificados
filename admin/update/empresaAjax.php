<?php
session_start();
include '../../config/conexion1.php';


if(!empty($_POST)){
    //extraer datos
    if($_POST['action']=='infoEmpresa'){
       //echo 'consultar';
        $id_empresa = $_POST['id_empresa'];
        
        $resultado = mysqli_query($con, "SELECT ID_EMP, NOMBRE_EMPRESA, NIT, WEB, DIR,CIUDAD,TEL_UNO,TEL_DOS, REPRESENTANTE, LOGO FROM empresa WHERE ID_EMP=$id_empresa");
        
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
 if($_POST['action'] == 'addEmpresa'){
   // print_r($_FILES);
   if (!empty($_POST['id_empresa']) || !empty($_POST['nit']))
    {  
      
            $id_empresa = $_POST['id_empresa'];
            $nom_emp = $_POST['nom_emp'];
            $nit= $_POST['nit'];
            $web = $_POST['web'];
            $dir= $_POST['dir'];
            $cel = $_POST['cel1'];
            $cel2 = $_POST['cel2'];
            $ciudad= $_POST['ciudad'];
            $representante= $_POST['representante'];

           
           //Consultar imagen anterior
            $resultado = mysqli_query($con, "SELECT ID_EMP, LOGO FROM empresa WHERE ID_EMP =$id_empresa");
            
             while ($valores = mysqli_fetch_row($resultado)){ 
                 $valorFImra=$valores[1];
                 
             }
 
             if(!empty($_FILES['files-0'])){
            //Datos del archivo
            $nombre_imagen=$_FILES['files-0']['name'];
            $tipo_imagen=$_FILES['files-0']['type'];
            $tamano_imagen=$_FILES['files-0']['size'];
            
            $nombre_fichero=$nombre_imagen;
                 $carpeta_destino=$_SERVER ['DOCUMENT_ROOT'] . '/servilog/intranet/uploads/';
               
                 if ($tipo_imagen=="image/png"){
                     
                     if ($tamano_imagen<=1000000) {
                        
                         if (file_exists($carpeta_destino.$nombre_imagen)){
                             $errMSG = "El archivO ya esxite";
                         }else{
                            
                          unlink($carpeta_destino.$valorFImra);
                         move_uploaded_file($_FILES['files-0']['tmp_name'],$carpeta_destino.$nombre_imagen);
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
            
            $sql = mysqli_query($con, "UPDATE empresa SET NOMBRE_EMPRESA='$nom_emp', NIT=$nit, WEB='$web', DIR='$dir',"
                    . "CIUDAD='$ciudad', TEL_UNO=$cel, TEL_DOS=$cel2, REPRESENTANTE='$representante',"
                    . "LOGO='$nombre_imagen' WHERE ID_EMP=$id_empresa");
           
            if($sql)
                    {
                $resultado = mysqli_query($con, "SELECT ID_EMP, NOMBRE_EMPRESA, NIT, WEB, DIR,CIUDAD,TEL_UNO,TEL_DOS, REPRESENTANTE, LOGO FROM empresa WHERE ID_EMP=$id_empresa");
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
   

    exit();   
}//post
// primer if
//print_r($_POST);
exit();

