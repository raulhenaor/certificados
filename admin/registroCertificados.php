<?php ob_start(); ?>
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
    $registro=$conexion->query("SELECT ID_CER, ID_CURSO,cursos.NOMBRE_CURSO, cursos.HORAS, cursos.SIGLA, CODIGO, ID_ESTUDIANTE, estudiantes.DOCUMENTO ,estudiantes.NOMBRE AS NOM_EST, estudiantes.APELLIDO AS APE_EST, ID_INSTRUCTOR, instructor.NOMBRE AS NOM_INST, instructor.APELLIDO AS APE_INST, instructor.PROFESION, instructor.MATRICULA, instructor.ESPECIALIDAD, instructor.FIRMA, F_INCIAL,F_APROBACION, F_VENCIMIENTO, ID_EMPRESA,empresa.NOMBRE_EMPRESA, empresa.WEB, empresa.TEL_UNO, empresa.TEL_DOS , empresa.LOGO, APROBADO, NOTIFICADO 
        FROM certificado_curso 
        INNER JOIN estudiantes ON estudiantes.DOCUMENTO = certificado_curso.ID_ESTUDIANTE
        INNER JOIN instructor ON instructor.DOCUMENTO = certificado_curso.ID_INSTRUCTOR
        INNER JOIN cursos ON cursos.ID = certificado_curso.ID_CURSO
        INNER JOIN empresa ON empresa.ID_EMP = certificado_curso.ID_EMPRESA
                                ORDER by ID_CER LIMIT 15")->fetchAll(PDO::FETCH_OBJ);
    
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
                    <label for="exampleFormControlInput1" class="form-label">Ingrese Documento</label>
                    <input type="text" class="form-control" name="id_estudiante" id="busqueda" placeholder="Buscar...">    
                    <div id="" class="form-text">Seleccione el estudiante</div>
                    </div>
                </div><!-- cierre row -->
               <div class="row gy-5">
                    <div class="col col-sm">

                        <label for="exampleFormControlInput1" class="form-label">Seleccione el Instructor</label>
                        <input type="text" class="form-control" name="id_instructor" id="busquedaFamiliar" placeholder="Buscar...">
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
        
        	<section id="tabla_resultado">
		<!-- AQUI SE DESPLEGARA NUESTRA TABLA DE CONSULTA -->
		</section
                <section id="tabla_resultado_instruc">
		<!-- AQUI SE DESPLEGARA NUESTRA TABLA DE CONSULTA -->
		</section  
        
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
                <th>Certificado No</th>
                <th>Nombre del Curso</th>
                <th>Estudiante</th>
                <th>Intructor</th>
                <th>F. Inicial</th> 
                <th>F.Aprobación</th>
                <th>F. Vencimiento</th>
                <th>Estado</th>
                <th>Ver Pdf</th>
                <th>Actualizar</th> 
                <th>Eliminar</th> 
              </tr>
          </thead> 
          <tbody>
              <?php 
              foreach ($registro as $data):
              ?>
              <tr class="row<?php echo $data->ID_CER?>">
                  <td class="celTipodoc"><?php echo $data->SIGLA.$data->CODIGO?></td>
                  <td class="celDocu"><?php echo $data->NOMBRE_CURSO?></td>
                  <td class="celNombre"><?php echo $data->NOM_EST?></td>
                  <td class="celApellido"><?php echo $data->NOM_INST?></td>
                  <td class="celCelu"><?php echo $data->F_INCIAL?></td>
                  <td class="celCorreo"><?php echo $data->F_APROBACION?></td>
                  <td class="celEstado"><?php echo $data->F_VENCIMIENTO?></td>
                  <td class="celEstado"><?php echo $data->APROBADO?></td>
                  <td>
                        <a class="btn btn-outline-success" product="" href="pdf/certificadoPdf.php?id_certificado=<?php echo $data->ID_CER?>">
                        <i class="fas fa-file-download"></i></a>
                    </td>
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
<?php ob_end_flush(); ?>