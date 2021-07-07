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
    $registro=$conexion->query("SELECT ID, NORMA, NOMBRE_CURSO, HORAS, CREDITOS, ID_USER, ACTIVO, SIGLA FROM cursos ORDER BY ID DESC LIMIT 15")->fetchAll(PDO::FETCH_OBJ);
    
?>
        <!--******************************Encabezado*****************************-->
     <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        
         <h2 class="h2">Registrar Cursos</h2>
        <div class="btn-toolbar mb-2 mb-md-0">
        </div>
      </div>
         <!--******************************Fin Encabezado*****************************-->
        <div class="container overflow-hidden">
           
            <form action="insert/insertCursos.php" method="post">
                <div class="row">
                    <div class="col-sm">
                        <label for="exampleFormControlInput1" class="form-label">Registro</label>
                        <input type="number" class="form-control" id="norma" name="norma" placeholder="Ingrese Solo Números" required="">
                        <div id="" class="form-text">Ingrese Código del Curso.</div>
                    </div>  
                    <div class="col-sm">
                        <label for="exampleFormControlInput1" class="form-label">Nombre del Curso</label>
                        <input type="text" class="form-control" id="nom_curso" name="nom_curso" placeholder="" required="">
                        <div id="" class="form-text">Ingrese Nombre del Curso.</div>
                    </div>
                </div><!-- cierre row -->
               <div class="row gy-5">
                    <div class="col col-sm">
                        <label for="exampleFormControlInput1" class="form-label">Registro de Horas</label>
                        <input type="number" class="form-control" id="horas" name="horas" placeholder="Ingrese Solo Números" required="">
                        <div id="" class="form-text">Duración del Curso.</div>
                    </div>
                    <div class="col col-sm">
                        <label for="exampleFormControlInput1" class="form-label">Registro Creditos</label>
                        <input type="number" class="form-control" id="creditos" name="creditos" placeholder="Ingrese Solo Números" required="">
                        <div id="" class="form-text">Creditos.</div>
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
                    <div class="col col-sm">
                        <label for="exampleFormControlInput1" class="form-label">Registro de Sigla del Curso</label>
                        <input type="text" class="form-control" id="sigla" name="sigla" placeholder="" required="">
                        <div id="" class="form-text">Registrar Sigla del Curso.</div>
                    </div>
                </div><!-- cierre row -->  
                <p></p>
                    <input class="btn btn-primary" type="submit" name="enviando" value="Ingresar">
                    <input class="btn btn-primary" type="reset" name="enviando" value="Borrar">
                   
                </form>           
          
        </div><!<!-- Cierre container -->
        
                <!--******************************Lista de Botes encabezado*****************************-->
     <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        
        <h1 class="h2">Lista de Cursos</h2>
        <div class="btn-toolbar mb-2 mb-md-0">
        </div>
      </div>
                
 <div class="container">
      <div class="row">           
      <table class="table table-striped table-hover">
          <thead>
              <tr>
                <th>Código</th>
                <th>Curso</th>
                <th>Horas</th>
                <th>Creditos</th> 
                <th>Activo</th>
                <th>Sigla</th>
                <th>Actualizar</th> 
                <th>Eliminar</th> 
              </tr>
          </thead> 
          <tbody>
              <?php 
              foreach ($registro as $data):
              ?>
              <tr class="row<?php echo $data->ID?>">
                  <td class="celNorma"><?php echo $data->NORMA?></td>
                  <td class="celNomCurso"><?php echo $data->NOMBRE_CURSO?></td>
                  <td class="celHoras"><?php echo $data->HORAS?></td>
                  <td class="celCreditos"><?php echo $data->CREDITOS?></td>
                  <?php
                  $estado_valor = '';
                  if ($data->ACTIVO==1){
                      $estado_valor = 'Activo';
                  }else{
                      $estado_valor = 'Bloqueado';
                  }
                  ?>
                  <td class="celEstado"><?php echo $estado_valor?></td>
                  <td class="celSigla"><?php echo $data->SIGLA?></td> 
                    <td>
                        <a class="add_curso btn btn-outline-primary" id_curso="<?php echo $data->ID ?>" href="#">
                        <i class="fas fa-edit"></i></a>
                    </td>
                    <td>
                        <a class="del_curso btn btn-outline-danger" id_curso="<?php echo $data->ID ?>" href="#">
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
