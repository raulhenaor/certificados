<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="../../css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
  <title>ERROR</title>
</head>
<?php
session_start();
include '../../config/conexion.php';

if (isset($_POST['enviando'])){

      $norma= $_POST['norma'];
      $nom_curso= $_POST['nom_curso'];
      $horas = $_POST['horas'];
      $creditos = $_POST['creditos'];
      $actvio = $_POST['activo'];
      $sigla = $_POST['sigla'];
      $id_usuario = $_SESSION['id_usuario'];
  
 try{   
   
    $consulta="INSERT INTO cursos (NORMA, NOMBRE_CURSO, HORAS, CREDITOS, ID_USER, ACTIVO, SIGLA) VALUES (:norma, :nom_curso, :horas, :creditos, :user, :activo, :sigla)";
    
    $resultado=$conexion->prepare($consulta);   
        
    $resultado->execute(array(":norma"=>$norma, ":nom_curso"=>$nom_curso, ":horas"=>$horas, ":creditos"=>$creditos, ":user"=>$id_usuario, ":activo"=>$actvio, ":sigla"=>$sigla));    
  

                     echo "<div class='container'>"; 
                     echo "<div class='row'>"; 
                    
                     echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>";
                     echo "Ingreso Con Exito";
                     echo "<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>";
                    
                     echo "</div>";
                     echo "</div>";
                     echo "</div>";
   
                     header("Location: ../registroCursos.php");   
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
           <a href="../registroCursos.php" class="btn btn-warning">Regresar</a>
           
       </div>
       <script src="../../js/jquery-3.6.0.min.js" type="text/javascript"></script>
       <script src="../../js/bootstrap.min.js" type="text/javascript"></script>
   </body>
</html>

