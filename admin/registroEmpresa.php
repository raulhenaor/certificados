<?php 
include 'header.php';
include 'nabvar-menu.php';
?>  
<!--*******************************************************SideBar***************************************************************-->
<div class="container-fluid">
  <div class="row">    
<?php include 'sidebar.php';?> 
    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
<?php
include ('../config/conexion.php');
         /*INICIO CONUSLTA PARA EL CRUD*/
    $registro=$conexion->query("SELECT ID_EMP, NOMBRE_EMPRESA, NIT, WEB, DIR,CIUDAD,TEL_UNO,TEL_DOS, REPRESENTANTE, LOGO FROM empresa WHERE ID_EMP=1")->fetchAll(PDO::FETCH_OBJ);  
?>
  <div class="modal Modal">
      <div class="modal-dialog">
        <div class="modal-content ">
          <div class="modal-header">
            <div class="bodyModal ">
                
            <form action="" method="post" name="form_add_product" id="form_add_product" onsubmit="event.preventDefault(); sendDataEmpresa();" enctype="multipart/form-data">
                <div class="iconoAct text-success"><i class="fas fa-edit"></i></div>
                    <h3>ACTUALIZAR REGISTRO EMPRESA</h3><br>
                <div class="row">
                    
                    <div class="col-sm">
                        <label for="exampleFormControlInput1" class="form-label">Nombre Empresa</label>
                        <input type="text" class="form-control" id="nom_emp" name="nom_emp" placeholder="Nombre Empresa">
                        <div id="" class="form-text">Ingrese el Nombre de la Empresa.</div>
                    </div>  
                    <div class="col-sm">
                        <label for="exampleFormControlInput1" class="form-label">Nit.</label>
                        <input type="number" class="form-control" id="nit" name="nit" placeholder="Ingrese Solo Números" required="">
                        <div id="" class="form-text">Número de Identificación Tributaria.</div>
                    </div>
                </div><!-- cierre row -->
               <div class="row gy-5">
                    <div class="col col-sm">
                        <label for="exampleFormControlInput1" class="form-label">Web</label>
                        <input type="text" class="form-control" id="web" name="web" placeholder="">
                        <div id="" class="form-text">Sitio Web.</div>
                    </div>
                    <div class="col col-sm">
                        <label for="exampleFormControlInput1" class="form-label">Dirección</label>
                        <input type="text" class="form-control" id="dir" name="dir" placeholder="">
                        <div id="" class="form-text">Dirección de la empresa.</div>
                    </div>
                </div><!-- cierre row -->   
                
                <div class="row gy-5">
                    <div class="col col-sm">
                        <label for="exampleFormControlInput1" class="form-label">Contacto</label>
                        <input type="text" class="form-control" id="cel1" name="cel1" placeholder="">
                        <div id="" class="form-text">Ingrese Número de Contacto.</div>
                    </div>
                    <div class="col col-sm">
                        <label for="exampleFormControlInput1" class="form-label">Contacto</label>
                        <input type="text" class="form-control" id="cel2" name="cel2" placeholder="">
                        <div id="" class="form-text">Ingrese Número de Contacto.</div>
                    </div>
                </div><!-- cierre row -->  
                
                 <div class="row gy-5">
                     <div class="col col-sm">
                        <label for="exampleFormControlInput1" class="form-label">Ciudad</label>
                        <input type="text" class="form-control" id="ciudad" name="ciudad" placeholder="">
                        <div id="" class="form-text">Ingrese Ciudad.</div>
                    </div>
                    <div class="col col-sm">
                        <label for="exampleFormControlInput1" class="form-label">Representante</label>
                        <input type="text" class="form-control" id="representante" name="representante" placeholder="">
                        <div id="" class="form-text">Representante de la empresar.</div>
                    </div>
                </div><!-- cierre row --> 
                
                
                <div class="row gy-5">
                    <div class="col col-sm">
                        <label for="exampleFormControlInput1" class="form-label">Logo</label>
                        <p></p>
                        <center>
                        <img alt="" width="160px" height="90px" id="logo2">
                        </center>
                        <input type="file" class="form-control" id="file" name="file">
                        <div id="" class="form-text">Logo en png</div>
                        
                    </div>

                </div><!-- cierre row --> 
                <input type="hidden" name="id_empresa" id="id_empresa" value=""/>
                <input type="hidden" name="action" value="addEmpresa"/>
                <div class="alertAddProduct"></div>
                <p></p>
                  <button type="submit" class="btn btn-outline-primary">Actualizar</button>
                  <a href="#" class="closeModal btn btn-outline-primary" onclick="closeModal();">Cerrar</a>
                   
                </form>
  

  
            </div>
          </div>
       </div>
    </div>
  </div>        
        
        <!--******************************Encabezado*****************************-->
     <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        
         <h2 class="h2">Datos Empresa</h2>
        <div class="btn-toolbar mb-2 mb-md-0">
        </div>
      </div>
         <!--******************************Fin Encabezado*****************************-->
        <div class="container overflow-hidden">
   
            <table class="table table-hover">
                <tbody>
              <?php 
              foreach ($registro as $data):
              ?>
                    <tr class="row<?php echo $data->ID_EMP?>">
                        <th >EMPRESA</th>
                        <td class="celNomEmp"><?php echo $data->NOMBRE_EMPRESA?></td> 
                    </tr>    
                    <tr class="row<?php echo $data->ID_EMP?>">
                        <th>NIT</th>
                        <td class="celNit"><?php echo $data->NIT?></td> 
                    </tr>
                    <tr class="row<?php echo $data->ID_EMP?>">
                        <th>WEB</th>
                        <td class="celWeb"><?php echo $data->WEB?></td> 
                    </tr>    
                    <tr class="row<?php echo $data->ID_EMP?>">
                        <th>DIRECCIÓN</th>
                        <td class="celDir"><?php echo $data->DIR?></td> 
                    </tr>
                     <tr class="row<?php echo $data->ID_EMP?>">
                        <th>CIUDAD</th>
                        <td class="celCiudad"><?php echo $data->CIUDAD?></td> 
                    </tr>    
                    <tr class="row<?php echo $data->ID_EMP?>">
                        <th>CONTACTO</th>
                        <td class="celCel"><?php echo $data->TEL_UNO?></td> 
                    </tr>
                    <tr class="row<?php echo $data->ID_EMP?>">
                        <th>CONTACTO</th>
                        <td class="celCel2"><?php echo $data->TEL_DOS?></td> 
                    </tr>    
                    <tr class="row<?php echo $data->ID_EMP?>">
                        <th>REPRESENTANTE</th>
                        <td class="celRepren"><?php echo $data->REPRESENTANTE?></td> 
                    </tr>
                     <tr class="row<?php echo $data->ID_EMP?>">
                        <th>LOGO</th>
                        <td class="celLogo"><img src="/servilog/intranet/uploads/<?php echo $data->LOGO?>" alt="LOGO" width="300px" height="92px"  id="logo3"></td> 
                    </tr>
                    <tr>
                        <th>EDITAR</th>
                    <td>
                        <a class="add_empresa btn btn-outline-primary" id_empresa="<?php echo $data->ID_EMP ?>" href="#">
                        <i class="fas fa-edit"></i></a>
                    </td> 
                    </tr>
                </tbody>

               <?php endforeach; ?> 
            </table>
          
        </div><!<!-- Cierre container -->
            
    </main>
  </div>
</div>
<?php include 'footer.php'?>

