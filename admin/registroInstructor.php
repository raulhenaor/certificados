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
    $registro=$conexion->query("SELECT ID_INST, instructor.TIPO_DOC, tipo_documento.NOMBRE AS TIPO_NOM, instructor.DOCUMENTO, instructor.NOMBRE, APELLIDO, CONTACTO, PROFESION, MATRICULA, ESPECIALIDAD, DESCRIPCION,FIRMA,ACTIVO 
                                FROM instructor 
                                INNER JOIN tipo_documento ON instructor.TIPO_DOC = tipo_documento.ID_DOC
                                ORDER BY ID_INST DESC LIMIT 15")->fetchAll(PDO::FETCH_OBJ);
    
    if (isset($_POST['enviando'])){
        
        $tipo_doc = $_POST["tipo_doc"];
        $cc = $_POST["documento"];
        $nom = $_POST["nombre"];
        $ape = $_POST["apellido"];
        $contacto = $_POST["cel"];
        $profesion = $_POST["profesion"];
        $matricula = $_POST["matricula"];
        $especialidad = $_POST["especialidad"];
        $descrip = $_POST["descp"];
        $id_usuario = $_SESSION['id_usuario'];
        $activo = $_POST["activo"];
        
        /*Datos del archivo*/
    	$nombre_imagen=$_FILES['firma']['name'];
    	$tipo_imagen=$_FILES['firma']['type'];
    	$tamano_imagen=$_FILES['firma']['size'];

    	$nombre_fichero=$nombre_imagen;
        
         /*Condiciones a seguir para el archivo*/
        if ($tamano_imagen<=1000000) {
            /*Ruta Carpeta destino del servidor*/
            if($tipo_imagen=="image/png"){
                      
                        $carpeta_destino=$_SERVER ['DOCUMENT_ROOT'] . '/servilog/intranet/uploads/';
                        //$carpeta_destino=$_SERVER ['DOCUMENT_ROOT'] . '/img/';
                        
                 /*Validar fichero si existe*/
                if (file_exists($carpeta_destino.$nombre_imagen)){
                    
                          echo "<div class='alert danger'>";
                          echo "<span class='closebtnAlert'>&times;</span> ";
                          echo "El fichero $nombre_fichero ya existe";
                          echo "</div>";
                   
                  }else{
                    move_uploaded_file($_FILES['firma']['tmp_name'],$carpeta_destino.$nombre_imagen);
                    
                    /*CONSULTA DE INSERCION */ 
                    $consulta="INSERT INTO instructor (TIPO_DOC, DOCUMENTO, NOMBRE, APELLIDO, CONTACTO, PROFESION, MATRICULA, ESPECIALIDAD, DESCRIPCION, FIRMA, ID_USER, ACTIVO) "
                            . "VALUES (:doc, :documento, :nom, :ape, :contac, :profesion, :matricula, :especialidad, :desc, :firma, :user, :activo)";

                    $resultado=$conexion->prepare($consulta);   

                    $resultado->execute(array(":doc"=>$tipo_doc, ":documento"=>$cc, ":nom"=>$nom, ":ape"=>$ape, ":contac"=>$contacto, ":profesion"=>$profesion
                            , ":matricula"=>$matricula, ":especialidad"=>$especialidad, ":desc"=>$descrip, ":firma"=>$nombre_imagen, ":user"=>$id_usuario, ":activo"=>$activo));    
                        //echo $carpeta_destino;
                    header("Location:registroInstructor.php");

                    $resultado->closeCursor(); 
                }//cierre del else si se cumple la condición para insertar
            } else {// Cirre el if del tipo de archivo y abro el else para alert
                
            		echo "<div class='alert danger'>";
			echo "<span class='closebtnAlert'>&times;</span> ";
			echo "Solo se pueden subir archivos .png";
			echo "</div>";   
                        
            }//cierre del else alert de extensión del archivo
        } else {//cierre del if tamaño del archivo y abro else para el alert
            
            		echo "<div class='alert danger'>";
			echo "<span class='closebtnAlert'>&times;</span> ";
			echo "Png muy grande max 1 mb";
			echo "</div>";
            
        }//cierre del else del if condición del tamaño del archivo
        
}//cierre if del boton del formulario
    
?>
        <!--******************************Encabezado*****************************-->
     <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        
         <h2 class="h2">Registrar Instructor</h2>
        <div class="btn-toolbar mb-2 mb-md-0">
        </div>
      </div>
         <!--******************************Fin Encabezado*****************************-->
        <div class="container overflow-hidden">
           
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">
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
                        <div id="" class="form-text">Ingrese Nombre del Instructor.</div>
                    </div>
                    <div class="col col-sm">
                        <label for="exampleFormControlInput1" class="form-label">Apellido</label>
                        <input type="text" class="form-control" id="apellido" name="apellido" placeholder="" required="">
                        <div id="" class="form-text">Ingrese El Apellido del Instructor.</div>
                    </div>
                </div><!-- cierre row -->   
                
                <div class="row gy-5">
                    <div class="col col-sm">
                        <label for="exampleFormControlInput1" class="form-label">Contacto</label>
                        <input type="number" class="form-control" id="cel" name="cel" placeholder="" required="">
                        <div id="" class="form-text">Ingrese Número de Celular del Instructor.</div>
                    </div>
                    <div class="col col-sm">
                        <label for="exampleFormControlInput1" class="form-label">Profesión</label>
                        <input type="text" class="form-control" id="profesion" name="profesion" placeholder="" required="">
                        <div id="" class="form-text">Profesión del Instructor</div>
                    </div>
                </div><!-- cierre row -->  
                
                 <div class="row gy-5">
                    <div class="col col-sm">
                        <label for="exampleFormControlInput1" class="form-label">Matricula</label>
                        <input type="text" class="form-control" id="matricula" name="matricula" placeholder="" required="">
                        <div id="" class="form-text">Matricula del Instructor.</div>
                    </div>
                    <div class="col col-sm">
                        <label for="exampleFormControlInput1" class="form-label">Especialidad</label>
                        <input type="text" class="form-control" id="especialidad" name="especialidad" placeholder="" required="">
                        <div id="" class="form-text">Especialidad del Instructor</div>
                    </div>
                </div><!-- cierre row --> 
                
                                 <div class="row gy-5">
                    <div class="col col-sm">
                        <label for="exampleFormControlInput1" class="form-label">Descripción</label>
                        <input type="text" class="form-control" id="descp" name="descp" placeholder="" required="">
                        <div id="" class="form-text">Descripción del Instructor.</div>
                    </div>
                    <div class="col col-sm">
                        <label for="exampleFormControlInput1" class="form-label">Firma</label>
                        <input type="file" class="form-control" id="firma" name="firma" placeholder="" required="">
                        <div id="" class="form-text">Firma del Instructor en png</div>
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
                <th>Profesión</th>
                <th>Matricula</th>
                <th>Especialidad</th>
                <th>Descripción</th>
                <th>Activo</th>
                <th>Firma</th>
                <th>Actualizar</th> 
                <th>Eliminar</th> 
              </tr>
          </thead> 
          <tbody>
              <?php 
              foreach ($registro as $data):
              ?>
              <tr class="row<?php echo $data->ID_INST?>">
                  <td class="celReg"><?php echo $data->TIPO_NOM?></td>
                  <td class="celReg"><?php echo $data->DOCUMENTO?></td>
                  <td class="celNBote"><?php echo $data->NOMBRE?></td>
                  <td class="celNpatente"><?php echo $data->APELLIDO?></td>
                  <td class="celNpatente"><?php echo $data->CONTACTO?></td>
                  <td class="celNpatente"><?php echo $data->PROFESION?></td>
                  <td class="celNpatente"><?php echo $data->MATRICULA?></td>
                  <td class="celNpatente"><?php echo $data->ESPECIALIDAD?></td>
                  <td class="celNpatente"><?php echo $data->DESCRIPCION?></td>
                  <?php
                  $estado_valor = '';
                  if ($data->ACTIVO==1){
                      $estado_valor = 'Activo';
                  }else{
                      $estado_valor = 'Bloqueado';
                  }
                  ?>
                  <td class="celNBote"><?php echo $estado_valor?></td>
                  <td class="celNpatente"><img src="/servilog/intranet/uploads/<?php echo $data->FIRMA?>" alt="" width="100px" height="50px"></td>
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
