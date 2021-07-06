<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="../../css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
  <title>ERROR</title>
</head>
<?php
session_start();
include '../../config/conexion1.php';
include '../../config/conexion.php';


if (isset($_POST['enviando'])){

      
      $id_curso= $_POST['id_curso'];
      
      $id_estudiante = $_POST['id_estudiante'];
      $id_instructor = $_POST['id_instructor'];
      $fecha_inicial = $_POST['fechaini'];
      $fecha_apobacion = $_POST['fechaapro'];
      $fecha_vencimiento = $_POST['fechaven'];
      $id_empresa = 1;
      $aprobado = $_POST['aprobo'];
      $notificado = 0;
      $id_usuario = $_SESSION['id_usuario'];

      if ($aprobado == 0) {
         $codigo = -1;

      } else {
         if ($aprobado == 1) {
            $consulta = mysqli_query($con, "SELECT certificado_curso.ID_CURSO, cursos.SIGLA ,MAX(certificado_curso.CODIGO)  FROM certificado_curso INNER JOIN cursos ON certificado_curso.ID_CURSO = cursos.ID WHERE cursos.ID=$id_curso");
            while ($valores = mysqli_fetch_row($consulta)){            
            echo '<option  value="'.$valores[0].'" >'.$valores[1].' '.$valores[2].'</option>';
            $hola = $valores[2];
            if ($hola==-1) {
               $codigo = $hola+2;

            } else {
               if ($hola>=0) {
                  $codigo = $hola+1;

               }
            }
            
            }


         }
      }
      echo($codigo);

 try{

   
   
    $consulta="INSERT INTO certificado_curso (ID_CURSO, CODIGO, ID_ESTUDIANTE, ID_INSTRUCTOR, F_INCIAL, 	F_APROBACION, F_VENCIMIENTO, ID_EMPRESA, APROBADO, NOTIFICADO, ID_USER) VALUES "
            . "(:id_curso, :codigo, :id_estudiante, :id_instructor, :f_inicial, :f_aprobacion, :f_vencimiento, :id_empresa, :aprobado, :notificado, :id_user)";
    
    $resultado=$conexion->prepare($consulta);   
        
    $resultado->execute(array(":id_curso"=>$id_curso, ":codigo"=>$codigo, ":id_estudiante"=>$id_estudiante, ":id_instructor"=>$id_instructor, ":f_inicial"=>$fecha_inicial, ":f_aprobacion"=>$fecha_apobacion, ":f_vencimiento"=>$fecha_vencimiento, ":id_empresa"=>$id_empresa, ":aprobado"=>$aprobado, ":notificado"=>$notificado, ":id_user"=>$id_usuario));    
  

                     echo "<div class='container'>"; 
                     echo "<div class='row'>"; 
                    
                     echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>";
                     echo "Ingreso Con Exito";
                     echo "<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>";
                    
                     echo "</div>";
                     echo "</div>";
                     echo "</div>";
   
                     header("Location: ../registroCertificados.php");   
    $resultado->closeCursor();
 }catch (Exception $ex) {
?>
   <body>
       <div class="container">
     <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        
        <h1 class="h2">Error al ingresar</h2>
        <div class="btn-toolbar mb-2 mb-md-0">
        </div>
      </div>
            <?php
             
                echo "<div class='alert alert-warning alert-dismissible fade show' role='alert'> ";
                echo "Duplicado Registro" . $ex->getMessage();
                echo "<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>";
                echo "</div>";
                 //header("Location: ../ingresarBote.php");  
            } 
            }//if de ingreso
            ?> 
           <a href="../registroEstudiantes.php" class="btn btn-warning">Regresar</a>
           
       </div>
       <script src="../../js/jquery-3.6.0.min.js" type="text/javascript"></script>
       <script src="../../js/bootstrap.min.js" type="text/javascript"></script>
   </body>
</html>
