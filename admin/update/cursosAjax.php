<?php
session_start();
include '../../config/conexion1.php';


if(!empty($_POST)){
    //extraer datos
    if($_POST['action']=='infoCurso'){
       //echo 'consultar';
        $id_curso = $_POST['id_curso'];
        
        $resultado = mysqli_query($con, "SELECT ID, NORMA, NOMBRE_CURSO, HORAS, CREDITOS, ID_USER, ACTIVO, SIGLA FROM cursos WHERE ID =$id_curso");
        
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
 if($_POST['action'] == 'addCurso'){
                
    if (!empty($_POST['idC']) || !empty($_POST['norma']) || !empty($_POST['nom_cursos']) || !empty($_POST['horas']) || !empty($_POST['creditos']) || !empty($_POST['activo']) || !empty($_POST['sigla']))
    {  
      
            $id_curso = $_POST['idC'];
            $norma= $_POST['norma'];
            $nom_cursos = $_POST['nom_cursos'];
            $horas = $_POST['horas'];
            $creditos= $_POST['creditos'];
            $activo =  $_POST['activo'];
            $sigla = $_POST['sigla'];
            $usuario = $_SESSION["id_usuario"];
            
            $sql = mysqli_query($con, "UPDATE cursos SET NORMA='$norma', NOMBRE_CURSO='$nom_cursos', HORAS=$horas, CREDITOS=$creditos, ID_USER=$usuario, ACTIVO=$activo, SIGLA='$sigla' WHERE ID=$id_curso");
           
            if($sql)
                    {
                $resultado = mysqli_query($con, "SELECT ID, NORMA, NOMBRE_CURSO, HORAS, CREDITOS, ID_USER, ACTIVO, SIGLA FROM cursos WHERE ID =$id_curso");
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

