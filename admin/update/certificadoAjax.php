<?php
session_start();
include '../../config/conexion1.php';


if(!empty($_POST)){
    //extraer datos
    if($_POST['action']=='infoCertificado'){
       //echo 'consultar';
        $id_certificado = $_POST['id_certificado'];
        
        $resultado = mysqli_query($con, "SELECT ID_CER, ID_CURSO,cursos.NOMBRE_CURSO, cursos.HORAS, cursos.SIGLA, CODIGO, ID_ESTUDIANTE, estudiantes.DOCUMENTO AS DOC_EST ,estudiantes.NOMBRE AS NOM_EST, estudiantes.APELLIDO AS APE_EST, ID_INSTRUCTOR, instructor.DOCUMENTO AS DOC_INST, instructor.NOMBRE AS NOM_INST, instructor.APELLIDO AS APE_INST, instructor.PROFESION, instructor.MATRICULA, instructor.ESPECIALIDAD, instructor.FIRMA, F_INCIAL,F_APROBACION, F_VENCIMIENTO, ID_EMPRESA,empresa.NOMBRE_EMPRESA, empresa.WEB, empresa.TEL_UNO, empresa.TEL_DOS , empresa.LOGO, APROBADO, NOTIFICADO 
        FROM certificado_curso 
        INNER JOIN estudiantes ON estudiantes.DOCUMENTO = certificado_curso.ID_ESTUDIANTE
        INNER JOIN instructor ON instructor.DOCUMENTO = certificado_curso.ID_INSTRUCTOR
        INNER JOIN cursos ON cursos.ID = certificado_curso.ID_CURSO
        INNER JOIN empresa ON empresa.ID_EMP = certificado_curso.ID_EMPRESA WHERE ID_CER =$id_certificado");
        
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
 if($_POST['action'] == 'addCertificado1'){
   //print_r($_POST);
   if (!empty($_POST['id_certificado1']) || !empty($_POST['id_estudiante1']))
    {  
      
            $id_certificado = $_POST['id_certificado1'];
            $id_curso = $_POST['id_curso1'];
            $id_estudiante1 = $_POST['id_estudiante1'];
            $id_instructor1 = $_POST['id_instructor1'];
            $aprobo = $_POST['aprobo1'];
            $f_inicial= $_POST['fecha_ini'];
            $f_aprobo = $_POST['fechaapro1'];
            $f_vencimieto = $_POST['fechaven1'];
    
               $sql = mysqli_query($con, "UPDATE certificado_curso SET ID_CURSO=$id_curso, ID_ESTUDIANTE=$id_estudiante1, ID_INSTRUCTOR=$id_instructor1, "
                       . "APROBADO=$aprobo, F_INCIAL='$f_inicial', F_APROBACION='$f_aprobo', F_VENCIMIENTO='$f_vencimieto' WHERE ID_CER=$id_certificado");
           
            if($sql)
                    {
                $resultado = mysqli_query($con, "SELECT ID_CER, ID_CURSO,cursos.NOMBRE_CURSO, cursos.HORAS, cursos.SIGLA, CODIGO, ID_ESTUDIANTE, estudiantes.DOCUMENTO AS DOC_EST ,estudiantes.NOMBRE AS NOM_EST, estudiantes.APELLIDO AS APE_EST, ID_INSTRUCTOR, instructor.DOCUMENTO AS DOC_INST, instructor.NOMBRE AS NOM_INST, instructor.APELLIDO AS APE_INST, instructor.PROFESION, instructor.MATRICULA, instructor.ESPECIALIDAD, instructor.FIRMA, F_INCIAL,F_APROBACION, F_VENCIMIENTO, ID_EMPRESA,empresa.NOMBRE_EMPRESA, empresa.WEB, empresa.TEL_UNO, empresa.TEL_DOS , empresa.LOGO, APROBADO, NOTIFICADO 
        FROM certificado_curso 
        INNER JOIN estudiantes ON estudiantes.DOCUMENTO = certificado_curso.ID_ESTUDIANTE
        INNER JOIN instructor ON instructor.DOCUMENTO = certificado_curso.ID_INSTRUCTOR
        INNER JOIN cursos ON cursos.ID = certificado_curso.ID_CURSO
        INNER JOIN empresa ON empresa.ID_EMP = certificado_curso.ID_EMPRESA WHERE ID_CER =$id_certificado");
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
   
    // Eliminar producto
        if($_POST['action']=='delCertificado'){
       //echo 'consultar';
            if(empty($_POST['id_cert']) || !is_numeric($_POST['id_cert'])){
                echo 'error';
            } else {
            $id_cert = $_POST['id_cert'];

                $sql_del = mysqli_query($con, "DELETE FROM certificado_curso WHERE ID_CER = $id_cert");
                mysqli_close($con);
                
                if($sql_del){
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

