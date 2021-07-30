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
 
        <!--/////////////////////////ENCABEZADO//////////////////////////////////-->
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        
    <h2 class="h2">CONSULTAR POR FECHAS</h2>
        <div class="btn-toolbar mb-2 mb-md-0">
        </div>
     
      </div>
      
        <!-- FIN ENCABEZADO ////////////////////////////////////////////////// -->  
        	<div class="container">
    <div class="contenedorCurso">
    
        
            
                   <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">        
                           <div class="row">
                                <div class="col">
                           <div id="" class="form-text">Fecha inicial.</div>
                           <input type="date" name="buscarPasajero" id="buscarPasajero" class="form-control" placeholder=""/>
                           <div id="" class="form-text">Fecha Final.</div>
                                </div>
                               
                           <div class="col-12">   
                             <div class="input-group">
                               
                                 <input type="date" name="fechaF" id="fechaF" class="form-control" placeholder=""/>
                                   
                             </div>
                        </div>    
                               </div>
                       <p></p>
                           <input type="submit" name="pasajero" value="Buscar" class="btn btn-color">
                           
                     
                    </form>        
           </div>  <p></p>
    
<?php
 
if (isset($_POST['pasajero'])){

$buscar = $_POST['buscarPasajero'];
$fechaF = $_POST['fechaF'];

if(empty($_POST['buscarPasajero'])){
    
    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">';
    echo 'Ingrese un registro en la casilla';
    echo '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>';
    echo '</div>';
    
} else {
include ('../config/conexion.php');

$id_usuarioP = $_SESSION['id_usuario'];

      
/*INICIO CONUSLTA PARA EL CRUD PARA PLANILLA*/

$consulta = "SELECT cursos.NOMBRE_CURSO, COUNT(certificado_curso.ID_CURSO) AS CANTIDAD, F_INCIAL
FROM certificado_curso 
INNER JOIN cursos ON certificado_curso.ID_CURSO = cursos.ID
GROUP BY ID_CURSO
HAVING F_INCIAL BETWEEN :buscar AND :fechaF";

$registro=$conexion->prepare($consulta);

$registro->execute(array(":buscar"=>"$buscar", ":fechaF"=>$fechaF));

$cuenta = $registro->rowCount();
    

if($cuenta>0){
?>
   <div class="table-responsive">
      <table class="table table-striped table-hover">
          <thead>
              <tr>
                <th>Curso</th>
                <th>Cantidad</th>

              </tr>
          </thead> 
          <tbody>
              <?php 
              while ($fila=$registro->fetch(PDO::FETCH_ASSOC)){
              ?>
              <tr class="">
                  <td class="celTipodoc"><?php echo $fila['NOMBRE_CURSO']?></td>
                  <td class="celDocu"><?php echo $fila['CANTIDAD']?></td>
           
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

