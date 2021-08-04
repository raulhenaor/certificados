<?php ob_start(); ?>
<?php
session_start();
include '../../config/conexion.php';

if (isset($_POST['enviando'])){

      $tipo_doc= $_POST['tipo_doc'];
      $cc= $_POST['documento'];
      $pass = $_POST['contrasena'];
      $nom= $_POST['nombre'];
      $ape = $_POST['apellido'];
      $correo = $_POST['correo'];
      $perfil = $_POST['perfil'];
      $activo = $_POST['activo'];
      
    $contra_cifrada=  password_hash($pass, PASSWORD_DEFAULT, array("cost"=>13));
 try{   
   
    $consulta="INSERT INTO usuarios (TIPO_DOC, CEDULA, CONTRASENA, NOMBRE, APELLIDO, CORREO, PERFIL, ACTIVO) VALUES "
            . "(:tipo_doc, :cc, :pass, :nom, :ape, :correo, :perfil, :activo)";
    
    $resultado=$conexion->prepare($consulta);   
        
    $resultado->execute(array(":tipo_doc"=>$tipo_doc, ":cc"=>$cc, ":pass"=>$contra_cifrada,  ":nom"=>$nom, ":ape"=>$ape, ":correo"=>$correo, ":perfil"=>$perfil,  ":activo"=>$activo));    
  

                     echo "<div class='container'>"; 
                     echo "<div class='row'>"; 
                    
                     echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>";
                     echo "Ingreso Con Exito";
                     echo "<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>";
                    
                     echo "</div>";
                     echo "</div>";
                     echo "</div>";
   
                     header("Location: ../registroUsuarios.php");   
    $resultado->closeCursor();
 }catch (Exception $ex) {
?>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="../../css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
  <title>ERROR</title>
</head>
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
           <a href="../registroUsuarios.php" class="btn btn-warning">Regresar</a>
           
       </div>
       <script src="../../js/jquery-3.6.0.min.js" type="text/javascript"></script>
       <script src="../../js/bootstrap.min.js" type="text/javascript"></script>
   </body>
</html>
<?php ob_end_flush(); ?>