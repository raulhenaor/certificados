<?php
    session_start();
   if(!isset($_SESSION["usuario"]) || !isset($_SESSION["id_usuario"])){
   header("location:../index.php");
   }
?>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="generator">
   
    <link rel="shortcut icon" href="https://servilog.co/wp-content/uploads/2020/11/favicon.png?v=a8def514be8a">
    
    <title>SERVILOG</title>
    
    
    <link href="../css/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
    <!-- Bootstrap core CSS -->
    <link href="../css/bootstrap.min.css" rel="stylesheet" type="text/css"/>

    <!-- Favicons -->
    
    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }

    </style>
    <!-- Custom styles for this template -->
    <link href="../css/dashboard.css" rel="stylesheet" type="text/css"/>
   
    <link href="../recursos/fontawesome-free-5.15.3-web/css/fontawesome.css" rel="stylesheet" type="text/css"/>
    <link href="../recursos/fontawesome-free-5.15.3-web/css/brands.css" rel="stylesheet" type="text/css"/>
    <link href="../recursos/fontawesome-free-5.15.3-web/css/solid.css" rel="stylesheet" type="text/css"/>
    <link href="../css/estilos.css" rel="stylesheet" type="text/css"/>
  </head>
  <!--cambiar la siguiente linea a <div class="modal Modal"> -->
  <div class="modal Modal">
      <div class="modal-dialog">
        <div class="modal-content ">
          <div class="modal-header">
            <div class="bodyModal ">    

              <!-- <form  action="" method="post" name="form_add_product" id="form_add_product" onsubmit="event.preventDefault(); sendDataProduct();">
                 <h2>Contenido del Modal</h2>
                 <input type="number" name="registro" id="txtRegistro" class="form-control" placeholder="Registro del Bote"/><br> 
                 <input type="text" name="nBote" id="txtnBote" class="form-control" placeholder="Nombre del Bote"/><br> 
                 <input type="text" name="nPatente" id="txtnPatente" class="form-control" placeholder="Nombre de la Patente"/><br> 
                 <input type="hidden" name="idBote" id="idBote" />
                 <input type="hidden" name="action" value="addProduct"/>
                 <div class="alertAddProduct"></div>
                 <button type="submit">Actualizar</button>
                 <a href="#" class="closeModal" onclick="closeModal();">Cerrar</a>
               </form>-->

  
            </div>
          </div>
       </div>
    </div>
  </div>
  <body>