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
    $registro=$conexion->query("SELECT ID_DOC, NOMBRE FROM tipo_documento ORDER BY ID_DOC DESC")->fetchAll(PDO::FETCH_OBJ);
    
?>
        <!--******************************Encabezado*****************************-->
     <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        
         <h2 class="h2">Registrar Tipo de Documentos</h2>
        <div class="btn-toolbar mb-2 mb-md-0">
        </div>
      </div>
         <!--******************************Fin Encabezado*****************************-->

        

        <div class="container overflow-hidden">
           
            <form action="insert/insertTipoDocumento.php" method="post">
                
            <div class="contenedor1"> 
               <div class="row gy-5">
                    <div class="col col-sm">
                        <label for="exampleFormControlInput1" class="form-label">Tipo de Documento</label>
                        <input type="text" class="form-control" id="nombre" name="nombre" placeholder="" required="">
                        <div id="" class="form-text">Ingrese el tipo de documento</div>
                    </div>
                    
                </div><!-- cierre row -->   
                
                
                </div><!-- cierre Contenedor1 -->  
                <p></p>
                    <input class="btn btn-primary" type="submit" name="enviando" value="Ingresar">
                    <input class="btn btn-primary" type="reset" name="enviando" value="Borrar">
                   
                </form>  
        </div><!-- Cierre container -->
        
                <!--******************************Lista de Botes encabezado*****************************-->
     <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        
        <h2 class="h2">Tipos de Documentos</h2>
        <div class="btn-toolbar mb-2 mb-md-0">
        </div>
      </div>
                
 <div class="container">
     
      <div class="row table-responsive">           
      <table class="table table-striped table-hover">
          <thead>
              <tr>
                
                <th>Nombre</th>                
                <th>Actualizar</th> 
                <th>Eliminar</th> 
              </tr>
          </thead> 
          <tbody>
              <?php 
              foreach ($registro as $data):
              ?>
              <tr class="row<?php echo $data->ID_DOC?>">                  
                  <td class="celNBote"><?php echo $data->NOMBRE?></td>                  
                  
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