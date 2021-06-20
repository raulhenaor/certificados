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
<?php
include ('../config/conexion.php');

   
         /*INICIO CONUSLTA PARA EL CRUD*/
    $registro=$conexion->query("SELECT estudiantes.ID, estudiantes.TIPO_DOC, tipo_documento.NOMBRE AS TIPO_DOCUMENTO, DOCUMENTO, estudiantes.NOMBRE, APELLIDO, CEL, CORREO, ACTIVO 
                                FROM estudiantes 
                                INNER JOIN tipo_documento ON estudiantes.TIPO_DOC = tipo_documento.ID_DOC
                                ORDER by estudiantes.ID LIMIT 15")->fetchAll(PDO::FETCH_OBJ);
    
?>
        <!--******************************Encabezado*****************************-->
     <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        
         <h2 class="h2">Registrar Estudiantes</h2>
        <div class="btn-toolbar mb-2 mb-md-0">
        </div>
      </div>
         <!--******************************Fin Encabezado*****************************-->
        <div class="container overflow-hidden">
           
            <form action="insert/insertEstudiantes.php" method="post">
                <div class="row">
                    <div class="col-sm">
                        <label for="exampleFormControlInput1" class="form-label">Tipo Documento</label>
                    
                        <select class="form-select" id="tipo_doc" name="tipo_doc">
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
                        <input type="number" class="form-control" id="documento" name="documento" placeholder="Ingrese Solo Números" required="">
                        <div id="" class="form-text">Documento de Identidad.</div>
                    </div>
                </div><!-- cierre row -->
               <div class="row gy-5">
                    <div class="col col-sm">
                        <label for="exampleFormControlInput1" class="form-label">Nombre</label>
                        <input type="text" class="form-control" id="nombre" name="nombre" placeholder="" required="">
                        <div id="" class="form-text">Ingrese Nombre del Estudiante.</div>
                    </div>
                    <div class="col col-sm">
                        <label for="exampleFormControlInput1" class="form-label">Apellido</label>
                        <input type="text" class="form-control" id="apellido" name="apellido" placeholder="" required="">
                        <div id="" class="form-text">Ingrese El Apellido del Estudiante.</div>
                    </div>
                </div><!-- cierre row -->   
                
                <div class="row gy-5">
                    <div class="col col-sm">
                        <label for="exampleFormControlInput1" class="form-label">Contacto</label>
                        <input type="number" class="form-control" id="cel" name="cel" placeholder="" required="">
                        <div id="" class="form-text">Ingrese Número de Celular del Estudiante.</div>
                    </div>
                    <div class="col col-sm">
                        <label for="exampleFormControlInput1" class="form-label">E-mail</label>
                        <input type="text" class="form-control" id="correo" name="correo" placeholder="" required="">
                        <div id="" class="form-text">Dirección E-mail del Estudiante</div>
                    </div>
                </div><!-- cierre row -->  
                
                <div class="row gy-5">
                    <div class="col col-sm">
                        <label for="exampleFormControlInput1" class="form-label">Estado</label>
                        <select class="form-select" aria-label=".form-select-lg example" id="activo" name="activo"> 
                              <option value="1">Activo</option>
                              <option value="2">Bloqueado</option>
                            </select>
                        <div id="" class="form-text">Estado del Curso.</div>
                    </div>

                </div><!-- cierre row -->  
                <p></p>
                    <input class="btn btn-primary" type="submit" name="enviando" value="Ingresar">
                    <input class="btn btn-primary" type="reset" name="enviando" value="Borrar">
                   
                </form>           
          
        </div><!<!-- Cierre container -->
        
                <!--******************************Lista de Botes encabezado*****************************-->
     <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        
        <h2 class="h2">Lista de Últimos 15 Estudiantes Registrados</h2>
        <div class="btn-toolbar mb-2 mb-md-0">
        </div>
      </div>
                
 <div class="container">
      <div class="row">           
      <table class="table table-striped table-hover">
          <thead>
              <tr>
                <th>Tipo Documento</th>
                <th>Documento</th>
                <th>Nombre</th>
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
              foreach ($registro as $data):
              ?>
              <tr class="row<?php echo $data->ID?>">
                  <td class="celReg"><?php echo $data->TIPO_DOCUMENTO?></td>
                  <td class="celReg"><?php echo $data->DOCUMENTO?></td>
                  <td class="celNBote"><?php echo $data->NOMBRE?></td>
                  <td class="celNpatente"><?php echo $data->APELLIDO?></td>
                  <td class="celNpatente"><?php echo $data->CEL?></td>
                  <td class="celNpatente"><?php echo $data->CORREO?></td>
                  <?php
                  $estado_valor = '';
                  if ($data->ACTIVO==1){
                      $estado_valor = 'Activo';
                  }else{
                      $estado_valor = 'Bloqueado';
                  }
                  ?>
                  <td class="celNBote"><?php echo $estado_valor?></td>
                  <?php?>
                    <td>
                        <a class="add_product btn btn-outline-primary" product="<?php echo $data->ID_BOTE ?>" href="#">
                        <i class="fas fa-edit"></i></a>
                    </td>
                    <td>
                        <a class="del_product btn btn-outline-danger" product="<?php echo $data->ID_BOTE ?>" href="#">
                        <i class="fas fa-trash-alt"></i></a>
                    </td>
              </tr>
              <?php endforeach; ?>
          </tbody>    
      </table>
       </div><!-- cierre row -->
 </div><!<!-- Cierre container -->
                
    </main>
  </div>
</div>
<?php include 'footer.php'?>