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
                    <form action="" method="post" name="form_add_product" id="form_add_product" onsubmit="event.preventDefault(); sendDataInstructor();" enctype="multipart/form-data">
                <div class="iconoAct text-success"><i class="fas fa-edit"></i></div>
                    <h3>ACTUALIZAR REGISTRO INSTRUCTOR</h3><br>
                <div class="row">
                    
                    <div class="col-sm">
                        <label for="exampleFormControlInput1" class="form-label">Tipo Documento</label>
                    
                        <select class="form-select" id="tipo_doc1" name="tipo_doc1">
	                    <?php 
	                      include ('../config/conexion1.php');
	                      $consulta = mysqli_query($con, "SELECT ID_DOC,NOMBRE FROM tipo_documento");
	                        while ($valores = mysqli_fetch_row($consulta)){            
	                        echo '<option  value="'.$valores[0].'" >'.$valores[1].'</option>';
	                        
	                        }?>
                    </select>
                        
                        <div id="" class="form-text">Ingrese el Tipo de Documento.</div>
                    </div>  
                    <div class="col-sm">
                        <label for="exampleFormControlInput1" class="form-label">Documento No.</label>
                        <input type="number" class="form-control" id="documento1" name="documento1" placeholder="Ingrese Solo Números" required="">
                        <div id="" class="form-text">Documento de Identidad.</div>
                    </div>
                </div><!-- cierre row -->
               <div class="row gy-5">
                    <div class="col col-sm">
                        <label for="exampleFormControlInput1" class="form-label">Nombre</label>
                        <input type="text" class="form-control" id="nombre1" name="nombre1" placeholder="">
                        <div id="" class="form-text">Ingrese Nombre del Instructor.</div>
                    </div>
                    <div class="col col-sm">
                        <label for="exampleFormControlInput1" class="form-label">Apellido</label>
                        <input type="text" class="form-control" id="apellido1" name="apellido1" placeholder="">
                        <div id="" class="form-text">Ingrese El Apellido del Instructor.</div>
                    </div>
                </div><!-- cierre row -->   
                
                <div class="row gy-5">
                    <div class="col col-sm">
                        <label for="exampleFormControlInput1" class="form-label">Contacto</label>
                        <input type="number" class="form-control" id="cel1" name="cel1" placeholder="">
                        <div id="" class="form-text">Ingrese Número de Celular del Instructor.</div>
                    </div>
                    <div class="col col-sm">
                        <label for="exampleFormControlInput1" class="form-label">Profesión</label>
                        <input type="text" class="form-control" id="profesion1" name="profesion1" placeholder="">
                        <div id="" class="form-text">Profesión del Instructor</div>
                    </div>
                </div><!-- cierre row -->  
                
                 <div class="row gy-5">
                    <div class="col col-sm">
                        <label for="exampleFormControlInput1" class="form-label">Matricula</label>
                        <input type="text" class="form-control" id="matricula1" name="matricula1" placeholder="">
                        <div id="" class="form-text">Matricula del Instructor.</div>
                    </div>
                    <div class="col col-sm">
                        <label for="exampleFormControlInput1" class="form-label">Especialidad</label>
                        <input type="text" class="form-control" id="especialidad1" name="especialidad1" placeholder="">
                        <div id="" class="form-text">Especialidad del Instructor</div>
                    </div>
                </div><!-- cierre row --> 
                
                                 <div class="row gy-5">
                    <div class="col col-sm">
                        <label for="exampleFormControlInput1" class="form-label">Descripción</label>
                        <input type="text" class="form-control" id="descp1" name="descp1" placeholder="">
                        <div id="" class="form-text">Descripción del Instructor.</div>
                    </div>
                    <div class="col col-sm">
                        <label for="exampleFormControlInput1" class="form-label">Estado</label>
                        <select class="form-select" aria-label=".form-select-lg example" id="activo1" name="activo1"> 
                              <option value="1">Activo</option>
                              <option value="2">Bloqueado</option>
                            </select>
                        <div id="" class="form-text">Estado del Curso.</div>
                    </div>
                </div><!-- cierre row --> 
                
                <div class="row gy-5">
                    <div class="col col-sm">
                        <label for="exampleFormControlInput1" class="form-label">Firma</label>
                        <p></p>
                        <center>
                        <img alt="" width="100px" height="50px" id="firma2">
                        </center>
                        <input type="file" class="form-control" id="file" name="file">
                        <div id="" class="form-text">Firma del Instructor en png</div>
                        
                    </div>

                </div><!-- cierre row --> 
                <input type="hidden" name="id_instructor" id="id_instructor" value=""/>
                <input type="hidden" name="action" value="addInstructor"/>
                <div class="alertAddProduct"></div>
                <p></p>
                  <button type="submit" class="btn btn-outline-primary">Actualizar</button>
                  <a href="#" class="closeModal btn btn-outline-primary" onclick="closeModal();">Cerrar</a>
                   
                </form>

  
            </div>
          </div>
       </div>
    </div>
  </div>  
        <!--/////////////////////////ENCABEZADO//////////////////////////////////-->
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        
    <h2 class="h2">CONSULTAR INSTRUCTOR</h2>
        <div class="btn-toolbar mb-2 mb-md-0">
        </div>
     
      </div>
      
        <!-- FIN ENCABEZADO ////////////////////////////////////////////////// -->  
        	<div class="container">
    <div class="contenedorCurso">
    
        
            
                   <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">        
                           <div class="row">
                                <div class="col">
                           <label for="colFormLabel" class="col-sm-4 col-form-label"><h3>Instructor:</h3></label>
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

$consulta = "SELECT ID_INST, instructor.TIPO_DOC, tipo_documento.NOMBRE AS TIPO_NOM, instructor.DOCUMENTO, instructor.NOMBRE, APELLIDO, CONTACTO, PROFESION, MATRICULA, ESPECIALIDAD, DESCRIPCION,FIRMA,ACTIVO 
                FROM instructor 
                INNER JOIN tipo_documento ON instructor.TIPO_DOC = tipo_documento.ID_DOC
                WHERE instructor.NOMBRE LIKE :buscar OR  APELLIDO LIKE :buscar OR DOCUMENTO LIKE :buscar 
                ORDER BY ID_INST DESC";

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
                <th>Profesión</th> 
                <th>Matricula</th> 
                <th>Especialidad</th> 
                <th>Descripción</th> 
                <th>Estado</th> 
                <th>Firma</th> 
                <th>Actualizar</th> 
                <th>Eliminar</th> 
              </tr>
          </thead> 
          <tbody>
              <?php 
              while ($fila=$registro->fetch(PDO::FETCH_ASSOC)){
              ?>
              <tr class="row<?php echo $fila['ID_INST']?>">
                  <td class="celTipodoc"><?php echo $fila['TIPO_NOM']?></td>
                  <td class="celDocu"><?php echo $fila['DOCUMENTO']?></td>
                  <td class="celNombre"><?php echo $fila['NOMBRE']?></td>                                                              
                  <td class="celApellido"><?php echo $fila['APELLIDO']?></td> 
                  <td class="celCelu"><?php echo $fila['CONTACTO']?></td>
                  <td class="celCorreo"><?php echo $fila['PROFESION']?></td>
                  <td class="celApellido"><?php echo $fila['MATRICULA']?></td> 
                  <td class="celCelu"><?php echo $fila['ESPECIALIDAD']?></td>
                  <td class="celCorreo"><?php echo $fila['DESCRIPCION']?></td>
                  <?php
                  $estado_valor = '';
                  if ($fila['ACTIVO']==1){
                      $estado_valor = 'Activo';
                  }else{
                      $estado_valor = 'Bloqueado';
                  }
                  ?>
                  <td class="celEstado"><?php echo $estado_valor?></td> 
                  <td class="celFirma"><img src="/servilog/intranet/uploads/<?php echo $fila['FIRMA']?>" alt="" width="100px" height="50px" id="firma3"></td>
                    <td>
                        <a class="add_instructor btn btn-outline-success" id_instructor="<?php echo $fila['ID_INST']?>" href="#">
                        <i class="fas fa-edit"></i></a>
                    </td>
                    <td>
                        <a class="del_instructor btn btn-outline-danger" id_instructor="<?php echo $fila['ID_INST']?>" href="#">
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

