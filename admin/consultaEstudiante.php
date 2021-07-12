<?php 
include 'header.php';
include 'nabvar-menu.php';
?>  

<!--*******************************************************SideBar***************************************************************-->
<div class="container-fluid">
  <div class="row">
      
<?php 
include 'sidebar.php';
?> 
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <!///////////////////////////////////////////////Modal ACTUALIZAR///////////////////////////////////////////////////><!-- comment -->
  <div class="modal Modal">
      <div class="modal-dialog">
        <div class="modal-content ">
          <div class="modal-header">
            <div class="bodyModal ">
             <form  action="" method="post" name="form_add_product" id="form_add_product" onsubmit="event.preventDefault(); sendDataEstudiantes();">
                                                <div class="iconoAct text-success"><i class="fas fa-edit"></i></div>
                                                <h3>ACTUALIZAR DATOS DE ESTUDIANTE</h3><br>
                                                <div class="row">
                                                <div class="col-sm">
                                                <label for="exampleFormControlInput1" class="form-label">TIPO DE DOCUMENTO:</label>
                                                
                                                <select class="form-select" id="tipo_doc" name="tipo_doc">
                                                    <?php 
                                                    include ('../config/conexion1.php');
                                                    $consulta = mysqli_query($con, "SELECT ID_DOC,NOMBRE FROM tipo_documento");
                                                        while ($valores = mysqli_fetch_row($consulta)){            
                                                        echo '<option  value="'.$valores[0].'" >'.$valores[1].'</option>';
                                                        
                                                        }?>
                                                </select>
                                                </div>
                                                <div class="col-sm">
                                                <label for="exampleFormControlInput1" class="form-label">NÚMERO DE DOCUMENTO:</label>
                                                <input type="number" name="documento" id="documento" class="form-control" value="" placeholder="Registro del Bote"/><br> 
                                                </div>
                                                </div>
                                                <label for="exampleFormControlInput1" class="form-label">NOMBRES:</label>
                                                <input type="text" name="nombre" id="nombre" class="form-control" value="" placeholder="Nombre del Bote"/><br> 
                                                
                                                <label for="exampleFormControlInput1" class="form-label">APELLIDOS:</label>
                                                <input type="text" name="apellido" id="apellido" class="form-control" value="" placeholder="Nombre de la Patente"/><br> 
                                                
                                                <label for="exampleFormControlInput1" class="form-label">CONTACTO:</label>
                                                <input type="number" name="cel" id="cel" class="form-control" value="" placeholder="Nombre de la Patente"/><br> 
                                                

                                                <label for="exampleFormControlInput1" class="form-label">EMAIL:</label> 
                                                <input type="email" name="correo" id="correo" class="form-control" value="" placeholder="Nombre de la Patente"/><br> 

                                                <label for="exampleFormControlInput1" class="form-label">ESTADO:</label>
                                                <select name="activo" class="form-select" id="activo">
                                                    <option value="0">BLOQUEADO</option>
                                                    <option value="1">ACTIVO</option>
                                                </select>
                                                
                                                <input type="hidden" name="id_estudiante" id="id_estudiante" value=""/>
                                                <input type="hidden" name="action" value="addEstudiante"/>
                                                <div class="alertAddProduct"></div>
                                                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                                <button type="submit" class="btn btn-outline-success">Actualizar</button>
                                                <a href="#" class="closeModal btn btn-outline-success" onclick="closeModal();">Cerrar</a>
                                                </div>
                                          </form> 

  
            </div>
          </div>
       </div>
    </div>
  </div>  
        <!--/////////////////////////ENCABEZADO//////////////////////////////////-->
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        
    <h2 class="h2">CONSULTAR ESTUDIANTE</h2>
        <div class="btn-toolbar mb-2 mb-md-0">
        </div>
     
      </div>
      
        <!-- FIN ENCABEZADO ////////////////////////////////////////////////// -->  
        	<div class="container">
    <div class="contenedorCurso">
    
        
            
                   <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">        
                           <div class="row">
                                <div class="col">
                           <label for="colFormLabel" class="col-sm-4 col-form-label"><h3>Estudiante:</h3></label>
                           <input type="text" class="form-control" name="buscarPasajero" id="buscarPasajero">
                           <div id="" class="form-text">Buscar por: Cédula, Nombre y/o Apellido.</div>
                                </div>
                               </div>
                       <p></p>
                           <input type="submit" name="pasajero" value="Buscar" class="btn btn-color">
                           
                     
                    </form>        
           </div>  <p></p>
    
<?php
 
if (isset($_POST['pasajero'])){

$buscar = $_POST['buscarPasajero'];

if(empty($_POST['buscarPasajero'])){
    
    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">';
    echo 'Ingrese un registro en la casilla';
    echo '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>';
    echo '</div>';
    
} else {
include ('../config/conexion.php');

$id_usuarioP = $_SESSION['id_usuario'];

      
/*INICIO CONUSLTA PARA EL CRUD PARA PLANILLA*/

$consulta = "SELECT ID, TIPO_DOC, tipo_documento.NOMBRE AS NOM_DOC, DOCUMENTO, estudiantes.NOMBRE AS NOM_EST, APELLIDO, CEL, CORREO, ACTIVO 
                FROM estudiantes
                INNER JOIN tipo_documento ON estudiantes.TIPO_DOC=tipo_documento.ID_DOC
                WHERE estudiantes.NOMBRE LIKE :buscar OR  APELLIDO LIKE :buscar OR DOCUMENTO LIKE :buscar 
                ORDER BY ID DESC";

$registro=$conexion->prepare($consulta);

$registro->execute(array(":buscar"=>"%$buscar%"));

$cuenta = $registro->rowCount();
    

if($cuenta>0){
?>
   <div class="table-responsive">
      <table class="table table-striped table-hover">
          <thead>
              <tr>
                <th>Tipo Documento</th>
                <th>Documento</th>
                <th>Nombres</th>                      
                <th>Apellido</th> 
                <th>Celular</th> 
                <th>E-mail</th> 
                <th>Estado</th> 
                <th>Actualizar</th> 
                <th>Eliminar</th> 
              </tr>
          </thead> 
          <tbody>
              <?php 
              while ($fila=$registro->fetch(PDO::FETCH_ASSOC)){
              ?>
              <tr class="row<?php echo $fila['ID']?>">
                  <td class="celTipodoc"><?php echo $fila['NOM_DOC']?></td>
                  <td class="celDocu"><?php echo $fila['DOCUMENTO']?></td>
                  <td class="celNombre"><?php echo $fila['NOM_EST']?></td>                                                              
                  <td class="celApellido"><?php echo $fila['APELLIDO']?></td> 
                  <td class="celCelu"><?php echo $fila['CEL']?></td>
                  <td class="celCorreo"><?php echo $fila['CORREO']?></td> 
                  <?php
                  $estado_valor = '';
                  if ($fila['ACTIVO']==1){
                      $estado_valor = 'Activo';
                  }else{
                      $estado_valor = 'Bloqueado';
                  }
                  ?>
                  <td class="celEstado"><?php echo $estado_valor?></td> 

                    <td>
                        <a class="add_estudiantes btn btn-outline-success" id_estudiante="<?php echo $fila['ID']?>" href="#">
                        <i class="fas fa-edit"></i></a>
                    </td>
                    <td>
                        <a class="del_estudiantes btn btn-outline-danger" id_estudiante="<?php echo $fila['ID']?>" href="#">
                        <i class="fas fa-trash-alt"></i></a>
                    </td>
              </tr>
              <?php } ?>
          </tbody>    
      </table>
    </div>    
<?php
} else {/////////////////////////CIERRE DEL IF CUENTA////////////////////////////
    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">';
    echo 'No se encontro pasajero relacionado';  
    echo '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>';
    echo '</div>';    
}////////////////////////////////// CIERRE DEL ELSE///////////////////////////////
}
}////////////////////////CIERRE DEL PRIMER IF/////////////////////////////////////
?>                   
                </div>
    </main>
  </div>
</div>
<?php include 'footer.php'?>

