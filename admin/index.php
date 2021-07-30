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
<!--*************************************************************Copia para Contenido del main*****************************************************--> 
<?php
include ('../config/conexion.php');

   
         /*INICIO CONUSLTA PARA EL CRUD*/
    $registro=$conexion->query("SELECT ID_CER, ID_CURSO,cursos.NOMBRE_CURSO, cursos.HORAS, cursos.SIGLA, CODIGO, ID_ESTUDIANTE, estudiantes.DOCUMENTO ,estudiantes.NOMBRE AS NOM_EST, estudiantes.APELLIDO AS APE_EST, estudiantes.CEL,estudiantes.CORREO, F_INCIAL,F_APROBACION, F_VENCIMIENTO, DATEDIFF(NOW(), F_VENCIMIENTO) AS DIASRESTADOS
        FROM certificado_curso 
        INNER JOIN estudiantes ON estudiantes.DOCUMENTO = certificado_curso.ID_ESTUDIANTE
        INNER JOIN cursos ON cursos.ID = certificado_curso.ID_CURSO ORDER BY DIASRESTADOS")->fetchAll(PDO::FETCH_OBJ);
    
?>

      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        
        <h1 class="h2">Dashboard</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
          <div class="btn-group me-2">
            <button type="button" class="btn btn-sm btn-outline-secondary">Share</button>
            <button type="button" class="btn btn-sm btn-outline-secondary">Export</button>
          </div>
          <button type="button" class="btn btn-sm btn-outline-secondary dropdown-toggle">
            <span data-feather="calendar"></span>
            This week
          </button>
        </div>
      </div>
      <h2>Cursos Próximos a Vencer Últimos 30 días</h2>
      <div class="table-responsive">
        <table class="table table-striped table-sm">
            <thead>
              <tr>
                <th>Certificado No</th>
                <th>Nombre del Curso</th>
                <th>Estudiante</th>
                <th>Contacto</th>
                <th>E-mail</th> 
                <th>F.Aprobación</th>
                <th>F. Vencimiento</th>
                <th>Estado</th>
 
              </tr>
          </thead> 
          <tbody>
              <?php 
              foreach ($registro as $data):
                  
                  $datetime1 = new DateTime("now");
                    $datetime2 = new DateTime($data->F_VENCIMIENTO);
                    $interval = $datetime1->diff($datetime2);
                    
                    if ($data->DIASRESTADOS>=-30 && $data->DIASRESTADOS<=0){
                    
              ?>
              <tr class="row<?php echo $data->ID_CER?>">
                  <td class="celTipodoc"><?php echo $data->SIGLA.$data->CODIGO?></td>
                  <td class="celNomCur"><?php echo $data->NOMBRE_CURSO?></td>
                  <td class="celNomEst"><?php echo $data->NOM_EST.' '.$data->APE_EST?></td>
                  <td class="celFinicial"><?php echo $data->CEL?></td>
                  <td class="celFinicial"><?php echo $data->CORREO?></td>
                  <td class="celFapro"><?php echo $data->F_APROBACION?></td>
                  <td class="celFVenci"><?php echo $data->F_VENCIMIENTO?></td>
                  <td class="celAprobado"><?php echo $interval->format('%R%a días');?></td>
              </tr>
              <?php 
                    }
              endforeach; ?>
          </tbody>    
        </table>
      </div>
<!--*************************************************************Fin Copia del Contenido del Main*****************************************************-->  
    </main>
  </div>
</div>
<?php include 'footer.php'?>
