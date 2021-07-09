<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Consulta Certificados Servilog</title>
        <link href="css/estilos.css" rel="stylesheet" type="text/css"/>
        <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <link href="recursos/fontawesome-free-5.15.3-web/css/fontawesome.css" rel="stylesheet" type="text/css"/>
        <link href="recursos/fontawesome-free-5.15.3-web/css/brands.css" rel="stylesheet" type="text/css"/>
        <link href="recursos/fontawesome-free-5.15.3-web/css/solid.css" rel="stylesheet" type="text/css"/>
</head>
<body>
    <?php
    include 'config/conexion.php';
    
    $consulta = 'SELECT LOGO FROM empresa WHERE ID_EMP=:id_emp';
    
    $registro = $conexion->prepare($consulta);
    
    $registro->execute(array(":id_emp"=>1));
    
    while ($fila=$registro->fetch(PDO::FETCH_ASSOC)){
 
    ?>
 <div class="container">    
    <div class="contenedorCurso">
    
        <img src="intranet/uploads/<?php echo $fila['LOGO']; ?>" alt="" width="400" height="180" class="imagenLogo img-fluid" />
            <div class="tituloCurso">
            <h1>Consulta de Certificados</h1>
            </div>
                   <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">        
                           
                       
                           <div class="row">
                                <div class="col">
                           <label for="exampleInputEmail1" class="form-label">Ingrese el Número de Identificación</label>
                           <input type="number" class="form-control" name="buscarPasajero" id="buscarPasajero">
                           <div id="emailHelp" class="form-text">Inserte Su No. de Documento.</div>
                                </div>
                               </div>
                           <input type="submit" name="pasajero" value="Buscar" class="btn btn-color">
                           
                     
                    </form>        
           </div>  

    <?php
 }// Cierrre while del Logo
 
if (isset($_POST['pasajero'])){

$buscar = $_POST['buscarPasajero'];

include 'config/conexion.php';


if(empty($_POST['buscarPasajero'])){
    echo '<div class="alert alert-danger alert-dismissible fade show formularioTamaño col-sm" role="alert">';
    echo 'Ingrese un registro en la casilla';
    echo '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>';
    echo '</div>';
} else {
      
/*INICIO CONUSLTA PARA EL CRUD PARA PLANILLA*/

$consulta = "SELECT ID_CER, ID_CURSO,cursos.NOMBRE_CURSO, cursos.HORAS, cursos.SIGLA, CODIGO, ID_ESTUDIANTE, estudiantes.DOCUMENTO ,estudiantes.NOMBRE AS NOM_EST, estudiantes.APELLIDO AS APE_EST, ID_INSTRUCTOR, instructor.NOMBRE AS NOM_INST, instructor.APELLIDO AS APE_INST, instructor.PROFESION, instructor.MATRICULA, instructor.ESPECIALIDAD, instructor.FIRMA, F_INCIAL,F_APROBACION, F_VENCIMIENTO, ID_EMPRESA,empresa.NOMBRE_EMPRESA, empresa.WEB, empresa.TEL_UNO, empresa.TEL_DOS , empresa.LOGO, APROBADO, NOTIFICADO 
FROM certificado_curso 
INNER JOIN estudiantes ON estudiantes.DOCUMENTO = certificado_curso.ID_ESTUDIANTE
INNER JOIN instructor ON instructor.DOCUMENTO = certificado_curso.ID_INSTRUCTOR
INNER JOIN cursos ON cursos.ID = certificado_curso.ID_CURSO
INNER JOIN empresa ON empresa.ID_EMP = certificado_curso.ID_EMPRESA
WHERE estudiantes.DOCUMENTO=:buscar ORDER BY ID_CER";

$registro=$conexion->prepare($consulta);

$registro->execute(array(":buscar"=>$buscar));

$cuenta = $registro->rowCount();
    

if($cuenta>0){
?>
    <div class="row">
 <div class="table-responsive">  
    <table class="table table-striped table-hover align-middle">
          <thead>
              <tr>
                <th>Certificado No.</th>
                <th>Estudiante</th>
                <th>Nombre Curso</th>                      
                <th>Intructor</th> 
                <th>Fecha Aprobación</th> 
                <th>Fecha Vencimiento</th> 
                <th>Ver Pdf</th>  
              </tr>
          </thead> 
          <tbody>
              <?php 
              while ($fila=$registro->fetch(PDO::FETCH_ASSOC)){

              ?>
              <tr class="">
                  <td class="celCc"><?php echo 'SLCAP'.$fila['SIGLA'].sprintf("%'.05d\n", $fila['CODIGO'])?></td>
                  <td class="celNom"><?php echo $fila['NOM_EST'].' '.$fila['APE_EST']?></td>
                  <td class="celApe"><?php echo $fila['NOMBRE_CURSO']?></td>                                                              
                  <td class="celCel"><?php echo $fila['NOM_INST']?></td> 
                  <td class="celEstado"><?php echo $fila['F_APROBACION']?></td>
                  <td class="celEstado"><?php echo $fila['F_VENCIMIENTO']?></td>
                    <td>
                        <a class="btn btn-outline-success" product="" href="admin/pdf/certificadoPdfCursos.php?id_certificado=<?php echo $fila['ID_CER']?>">
                        <i class="fas fa-file-download"></i></a>
                    </td>
              </tr>
              <?php } ?>
          </tbody>    
      </table> 
</div> 
        </div>
<?php
} else {/////////////////////////CIERRE DEL IF CUENTA////////////////////////////
    echo '<div class="alert alert-success alert-dismissible fade show formularioTamaño col-sm" role="alert">';
    echo 'No se encontro documento relacionado';  
    echo '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>';
    echo '</div>';  
}////////////////////////////////// CIERRE DEL ELSE///////////////////////////////
}
}////////////////////////CIERRE DEL PRIMER IF/////////////////////////////////////

?>
   </div> 
    <script src="js/bootstrap.min.js" type="text/javascript"></script>
</body>
</html>
