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
                                                <label for="exampleFormControlInput1" class="form-label">TIPO DE DOCUMENTO:</label>
                                                
                                                <select class="form-select" id="tipo_doc" name="tipo_doc">
                                                    <?php 
                                                    include ('../config/conexion1.php');
                                                    $consulta = mysqli_query($con, "SELECT ID,NOMBRE,APELLIDO FROM estudiantes");
                                                        while ($valores = mysqli_fetch_row($consulta)){            
                                                        echo '<option  value="'.$valores[0].'" >'.$valores[1].''.$valores[2].'</option>';
                                                        
                                                        }?>
                                                </select>



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
        <!--******************************Encabezado*****************************-->
     <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        
         <h2 class="h2">Crear Certificados</h2>
        <div class="btn-toolbar mb-2 mb-md-0">
        </div>
      </div>
         <!--******************************Fin Encabezado*****************************-->
        <div class="container overflow-hidden">
           
            <form action="insert/insertCertificados.php" method="post">
                <div class="row">
                    <div class="col-sm">
                        <label for="exampleFormControlInput1" class="form-label">Seleccione el curso</label>
                    
                        <select class="form-select" id="id_curso" name="id_curso">
	                    <?php 
	                      include ('../config/conexion1.php');
	                      $consulta = mysqli_query($con, "SELECT ID, NOMBRE_CURSO FROM cursos");
	                        while ($valores = mysqli_fetch_row($consulta)){            
	                        echo '<option  value="'.$valores[0].'" >'.$valores[1].'</option>';
	                        
	                        }?>
                    </select>
                        
                        <div id="" class="form-text">Curso del estudiante.</div>
                    </div>  
                    <div class="col-sm">
                    <label for="exampleFormControlInput1" class="form-label">Seleccione el Estudiante</label>
                    <select class="form-select" id="id_estudiante" name="id_estudiante">
	                    <?php 
	                      include ('../config/conexion1.php');
	                      $consulta = mysqli_query($con, "SELECT ID, NOMBRE, APELLIDO FROM estudiantes");
	                        while ($valores = mysqli_fetch_row($consulta)){            
	                        echo '<option  value="'.$valores[0].'" >'.$valores[1].' '.$valores[2].'</option>';
	                        
	                        }?>
                    </select>
                        


                        <div id="" class="form-text">Seleccione el estudiante</div>
                    </div>
                </div><!-- cierre row -->
               <div class="row gy-5">
                    <div class="col col-sm">

                    <label for="exampleFormControlInput1" class="form-label">Seleccione el Instructor</label>
                    <select class="form-select" id="id_instructor" name="id_instructor">
	                    <?php 
	                      include ('../config/conexion1.php');
	                      $consulta = mysqli_query($con, "SELECT ID_INST, NOMBRE, APELLIDO FROM instructor");
	                        while ($valores = mysqli_fetch_row($consulta)){            
	                        echo '<option  value="'.$valores[0].'" >'.$valores[1].' '.$valores[2].'</option>';
	                        
	                        }?>
                    </select>
                        


                        <div id="" class="form-text">Seleccione el instructor</div>
                       
                    </div>
                    <div class="col col-sm">
                    <label for="exampleFormControlInput1" class="form-label">Seleccione si Aprobó</label>

                    <select class="form-select" aria-label="Default select example" name="aprobo" id="aprobo">                        
                        <option value="1">Aprobó</option>
                        <option value="2">No Aprobó</option>
                    </select>
                       
                        </div>
                    
                        
                       
                    
                </div><!-- cierre row -->   
                
                <div class="row gy-5">
                    <div class="col col-sm">
                        <label for="exampleFormControlInput1" class="form-label">Seleccione Fecha de Inicio</label>
                        <input type="date" class="form-control" id="fechaini" name="fechaini" placeholder="" required="">
                        <div id="" class="form-text">Fecha en la que inicio el curso.</div>
                    </div>
                    <div class="col col-sm">
                        <label for="exampleFormControlInput1" class="form-label">Seleccione Fecha de Aprobación</label>
                        <input type="date" class="form-control" id="fechaapro" name="fechaapro" placeholder="" required="">
                        <div id="" class="form-text">Fecha en la que aprobó el curso</div>
                    </div>
                </div><!-- cierre row -->  
                
                <div class="row gy-5">
                    <div class="col col-sm">
                    <label for="exampleFormControlInput1" class="form-label">Seleccione Fecha de Vencimiento</label>
                        <input type="date" class="form-control" id="fechaven" name="fechaven" placeholder="" required="">
                        <div id="" class="form-text">Fecha en la que se vence el certificado</div>
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
                  <td class="celTipodoc"><?php echo $data->TIPO_DOCUMENTO?></td>
                  <td class="celDocu"><?php echo $data->DOCUMENTO?></td>
                  <td class="celNombre"><?php echo $data->NOMBRE?></td>
                  <td class="celApellido"><?php echo $data->APELLIDO?></td>
                  <td class="celCelu"><?php echo $data->CEL?></td>
                  <td class="celCorreo"><?php echo $data->CORREO?></td>
                  <?php
                  $estado_valor = '';
                  if ($data->ACTIVO==1){
                      $estado_valor = 'Activo';
                  }else{
                      $estado_valor = 'Bloqueado';
                  }
                  ?>
                  <td class="celEstado"><?php echo $estado_valor?></td>
                  <?php?>
                    <td>
                        <a class="add_estudiantes btn btn-outline-primary" id_estudiante="<?php echo $data->ID ?>" href="#">
                        <i class="fas fa-edit"></i></a>
                    </td>
                    <td>
                        <a class="del_estudiantes btn btn-outline-danger" id_estudiante="<?php echo $data->ID ?>" href="#">
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