<?php
session_start();
include '../../config/conexion1.php';


if(!empty($_POST)){
    //extraer datos
    if($_POST['action']=='infoTipoDoc'){
       //echo 'consultar';
        $id_tipodoc = $_POST['id_doc'];
        
        $resultado = mysqli_query($con, "SELECT ID_DOC, NOMBRE FROM tipo_documento WHERE ID_DOC =$id_tipodoc");
        
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
 if($_POST['action'] == 'addTipoDoc'){
                
    if (!empty($_POST['id_doc']) || !empty($_POST['nom_docu']))
    {  
      
            $id_doc = $_POST['id_doc'];
            $nombre_doc= $_POST['nom_docu'];
            
            
            $sql = mysqli_query($con, "UPDATE tipo_documento SET NOMBRE='$nombre_doc'WHERE ID_DOC=$id_doc");
           
            if($sql)
                    {
                $resultado = mysqli_query($con, "SELECT ID_DOC, NOMBRE FROM tipo_documento WHERE ID_DOC =$id_doc");
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
   /* 
    // Eliminar producto
        if($_POST['action']=='delProduct'){
       //echo 'consultar';
            if(empty($_POST['id_e']) || !is_numeric($_POST['id_e']) ){
                echo 'error';
            } else {
                $idEmpresa = $_POST['id_e'];
                $usuarioDEL = $_SESSION["id_usuario"];
                
                $sqld = mysqli_query($con, "UPDATE empresas SET  ID_USUARIO=$usuarioDEL WHERE ID_E=$idEmpresa");
                
                $sql_del = mysqli_query($con, "DELETE FROM empresas WHERE ID_E = $idEmpresa");
                mysqli_close($con);
                
                if($sql_del){
                    echo 'Ok';
                }else{
                    //echo 'error';
                }
            }
            echo 'error';
    }

    exit();*/ 
}//post
// primer if
//print_r($_POST);
exit();

