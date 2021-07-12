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
                    <form  action="" method="post" name="form_add_product" id="form_add_product" onsubmit="event.preventDefault(); sendDataCertificados();">
                     <div class="iconoAct text-success"><i class="fas fa-edit"></i></div>
                    <h3>ACTUALIZAR REGISTRO CERTIFICADO</h3><br>
                        <section id="tabla_resultado1">
                       <!-- AQUI SE DESPLEGARA NUESTRA TABLA DE CONSULTA -->
                        </section>     
                        <div class="row">
                    <div class="col-sm">
                        <label for="exampleFormControlInput1" class="form-label">Seleccione el curso</label>
                    
                        <select class="form-select" id="id_curso1" name="id_curso1">
	                    <?php 
	                      include ('../config/conexion1.php');
	                      $consulta = mysqli_query($con, "SELECT ID, NOMBRE_CURSO FROM cursos");
	                        while ($valores = mysqli_fetch_row($consulta)){            
	                        echo '<option  value="'.$valores[0].'" >'.$valores[1].'</option>';
	                        
	                        }?>
                    </select>
                        
                        <div id="" class="form-text">Curso del estudiante.</div>
                    </div>  

                </div><!-- cierre row -->
               <div class="row gy-5">
                                     <div class="col-sm">
                    <label for="exampleFormControlInput1" class="form-label">Ingrese Documento</label>
                    <input type="text" class="form-control" name="id_estudiante1" id="busqueda1" placeholder="Buscar..." required="">    
                    <div id="" class="form-text">Seleccione el estudiante</div>
                    </div>  
                   
                    <div class="col col-sm">
                        <label for="exampleFormControlInput1" class="form-label">Instructor</label>
                        <input type="text" class="form-control" name="id_instructor1" id="busquedaFamiliar1" placeholder="Buscar..." required="">
                        <div id="" class="form-text">Seleccione el instructor</div>
                       
                    </div>
                   </div><!-- cierre row -->   
                
                <div class="row gy-5">
                   <div class="col col-sm">
                    <label for="exampleFormControlInput1" class="form-label">Aprobó</label>

                    <select class="form-select" aria-label="Default select example" name="aprobo1" id="aprobo1">                        
                        <option value="1">Aprobó</option>
                        <option value="2">No Aprobó</option>
                    </select>
                       
                    </div>
                    <div class="col col-sm">    
                        <label for="exampleFormControlInput1" class="form-label">Fecha de Inicio</label>
                       <input type="date" class="form-control" id="fecha_ini" name="fecha_ini" placeholder="" required="">
                        <div id="" class="form-text">Fecha en la que inicio el curso.</div>
                    </div>

                </div><!-- cierre row -->  
                
                <div class="row gy-5">
                   <div class="col col-sm">
                        <label for="exampleFormControlInput1" class="form-label">Fecha de Aprobación</label>
                        <input type="date" class="form-control" id="fechaapro1" name="fechaapro1" placeholder="" required="">
                        <div id="" class="form-text">Fecha en la que aprobó el curso</div>
                    </div>
                    <div class="col col-sm">
                    <label for="exampleFormControlInput1" class="form-label">Fecha de Vencimiento</label>
                        <input type="date" class="form-control" id="fechaven1" name="fechaven1" placeholder="" required="">
                        <div id="" class="form-text">Fecha en la que se vence el certificado</div>
                    </div>

                </div><!-- cierre row -->  
                                                
                                                <input type="hidden" name="id_certificado1" id="id_certificado1" value=""/>
                                                <input type="hidden" name="action" value="addCertificado1"/>
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
        
    <h2 class="h2">CONSULTAR CERTIFICADOS POR ESTUDIANTES</h2>
        <div class="btn-toolbar mb-2 mb-md-0">
        </div>
     
      </div>
      
        <!-- FIN ENCABEZADO ////////////////////////////////////////////////// -->  
        	<div class="container">
    <div class="contenedorCurso">
    
        
            
                   <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">        
                           <div class="row">
                                <div class="col">
                           <label for="colFormLabel" class="col-sm-4 col-form-label"><h3>Datos Estudiante:</h3></label>
                           <input type="text" class="form-control" name="buscarPasajero" id="buscarPasajero">
                           <div id="" class="form-text">Buscar por: Cédula, Nombre y/o Apellido del estudiante.</div>
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

$consulta = "SELECT ID_CER, ID_CURSO,cursos.NOMBRE_CURSO, cursos.HORAS, cursos.SIGLA, CODIGO, ID_ESTUDIANTE, estudiantes.DOCUMENTO ,estudiantes.NOMBRE AS NOM_EST, estudiantes.APELLIDO AS APE_EST, ID_INSTRUCTOR, instructor.NOMBRE AS NOM_INST, instructor.APELLIDO AS APE_INST, instructor.PROFESION, instructor.MATRICULA, instructor.ESPECIALIDAD, instructor.FIRMA, F_INCIAL,F_APROBACION, F_VENCIMIENTO, ID_EMPRESA,empresa.NOMBRE_EMPRESA, empresa.WEB, empresa.TEL_UNO, empresa.TEL_DOS , empresa.LOGO, APROBADO, NOTIFICADO 
        FROM certificado_curso 
        INNER JOIN estudiantes ON estudiantes.DOCUMENTO = certificado_curso.ID_ESTUDIANTE
        INNER JOIN instructor ON instructor.DOCUMENTO = certificado_curso.ID_INSTRUCTOR
        INNER JOIN cursos ON cursos.ID = certificado_curso.ID_CURSO
        INNER JOIN empresa ON empresa.ID_EMP = certificado_curso.ID_EMPRESA
                WHERE estudiantes.NOMBRE LIKE :buscar OR  estudiantes.APELLIDO LIKE :buscar OR estudiantes.DOCUMENTO LIKE :buscar 
                ORDER BY ID_CER DESC";

$registro=$conexion->prepare($consulta);

$registro->execute(array(":buscar"=>"%$buscar%"));

$cuenta = $registro->rowCount();
    

if($cuenta>0){
?>
   <div class="table-responsive">
      <table class="table table-striped table-hover">
          <thead>
              <tr>
                <th>Certificado No</th>
                <th>Nombre del Curso</th>
                <th>Estudiante</th>                      
                <th>Instructor</th> 
                <th>F. Incial</th> 
                <th>F. Aporbación</th> 
                <th>F.Vencimiento</th> 
                <th>Estado</th> 
                <th>Ver Pdf</th> 
                <th>Actualizar</th> 
                <th>Eliminar</th> 
              </tr>
          </thead> 
          <tbody>
              <?php 
              while ($fila=$registro->fetch(PDO::FETCH_ASSOC)){
              ?>
              <tr class="row<?php echo $fila['ID_CER']?>">
                  <td class="celTipodoc"><?php echo $fila['SIGLA'].$fila['CODIGO']?></td>
                  <td class="celDocu"><?php echo $fila['NOMBRE_CURSO']?></td>
                  <td class="celNombre"><?php echo $fila['NOM_EST']?></td>                                                              
                  <td class="celApellido"><?php echo $fila['NOM_INST']?></td> 
                  <td class="celCelu"><?php echo $fila['F_INCIAL']?></td>
                  <td class="celCorreo"><?php echo $fila['F_APROBACION']?></td> 
                  <td class="celCorreo"><?php echo $fila['F_VENCIMIENTO']?></td> 
                  <?php
                  $estado_valor = '';
                  if ($fila['APROBADO']==1){
                      $estado_valor = 'Aprobo';
                  }else{
                      $estado_valor = 'No Aprobo';
                  }
                  ?>
                  <td class="celEstado"><?php echo $estado_valor?></td> 
                  <td>
                        <a class="btn btn-outline-success" product="" href="pdf/certificadoPdf.php?id_certificado=<?php echo $fila['ID_CER']?>">
                        <i class="fas fa-file-download"></i></a>
                    </td>
                    <td>
                        <a class="add_certificado btn btn-outline-success" id_certificado="<?php echo $fila['ID_CER']?>" href="#">
                        <i class="fas fa-edit"></i></a>
                    </td>
                    <td>
                        <a class="del_certificado btn btn-outline-danger" id_certificado="<?php echo $fila['ID_CER']?>" href="#">
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

