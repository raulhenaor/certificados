<?php 
include 'header.php';
include 'nabvar-menu.php';

$usuario =$_SESSION['id_usuario'];

?> 
<!--*******************************************************SideBar***************************************************************-->
<div class="container-fluid">
  <div class="row">
      
<?php 
include 'sidebar.php';
?>
 <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
<?php
include ('../config/conexion1.php');


if (!isset($_POST["bot_actualizar"])){
    
$id=$_GET['id'];


} else {
    
$id=$_POST['id'];
$pass=$_POST['contrasena'];

$contra_cifrada=  password_hash($pass, PASSWORD_DEFAULT, array("cost"=>13));

$sql_update = "UPDATE usuarios SET CONTRASENA='$contra_cifrada'"
        
        . "WHERE ID_USU=$id";
             
             $update_= mysqli_query($con, $sql_update);
             

            if($update_){
                          echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>";
                          echo "Se Actualizo Correctamente";
                          echo "<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>";
                          echo "</div>";
            } 
               
}
?>     
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        
         <h2 class="h2">ACTUALIZAR CONTRASEÑA</h2>
        <div class="btn-toolbar mb-2 mb-md-0">
        </div>
      </div>
     <form  action="" method="post" name="form_add_product" id="form_add_product" >
              
                 <div class="col-sm">
                        <label for="exampleFormControlInput1" class="form-label">Contraseña Nueva:</label>
                        <input type="password" class="form-control" id="contrasena" name="contrasena" placeholder="Digite su Nueva Contraseña" required="">
                    </div>
              

              
                    
                  <input type="hidden" name="id" value="<?php echo $id?>">
                 <div class="alertAddProduct"></div>
                 <br>
                 <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                 <button type="submit" class="btn btn-outline-success" name="bot_actualizar">ACTUALIZAR</button>
                 <a href="registroUsuarios.php" class="closeModal btn btn-outline-success" >Regresar</a>
                 </div>
</form>
     
     
    </main>
  </div>
</div>
<?php include 'footer.php'?>