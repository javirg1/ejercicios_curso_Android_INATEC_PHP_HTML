<?php
//Vamos a utilizar variables de sesión para controlar si el usuario se ha identificado:
session_start();
//Vamos a comprobar si existe una variable de sesión que contenga el id de usuario:
if (isset($_SESSION["id_usuario"])) {
  //El usuario está identificado
  //Podría hacer una consulta y obtener todos sus datos
  $id_usuario = $_SESSION["id_usuario"];
  $nombre_usuario = $_SESSION["nombre_usuario"];
} else {
  //El usuario se está intentando colar, no se ha identificado:
  header("Location:../publica/login.php?error=Es necesario identificarse");
  exit;
}
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Jekyll v4.1.1">
    <title>Gualapop - Zona privada</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/4.5/examples/dashboard/">

    <!-- Bootstrap core CSS -->
<link href="../assets/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>
    <!-- Custom styles for this template -->
    <link href="dashboard.css" rel="stylesheet">
  </head>
  <body>
    <nav class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
  <a class="navbar-brand col-md-3 col-lg-2 mr-0 px-3" href="../publica/index.php">Gualapop</a>
  <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-toggle="collapse" data-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  
  <ul class="navbar-nav px-3">
    <li class="nav-item text-nowrap">
      <a class="nav-link" href="salir.php">Sign out</a>
    </li>
  </ul>
</nav>

<div class="container-fluid">
  <div class="row">
    <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
      <div class="sidebar-sticky pt-3">
        <ul class="nav flex-column">
          <li class="nav-item">
            <a class="nav-link active" href="#">
              <span data-feather="home"></span>
              Mis anuncios <span class="sr-only">(current)</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="form_nuevo_anuncio.php">
              <span data-feather="file"></span>
              Nuevo anuncio
            </a>
          </li>   
        </ul>

      </div>
    </nav>

    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 ">
        <h1 class="h2">Mis anuncios</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
          <div class="btn-group mr-2">

          </div>
        </div>
      </div>
      <div class="table-responsive">
        <table class="table table-striped table-sm">
          <thead>
            <tr>
              <th>FOTO</th>
              <th>TITULO</th>
              <th>FECHA</th>
              <th>PRECIO</th>
              <th></th>
              <th></th>
            </tr>
          </thead>
          <tbody>
            <?php
            //Incluyo el archivo con las funciones:
            require("../includes/funciones.php");
            //Cargar los anuncios del usuario:
            $anuncios = cargarAnuncios($id_usuario);

            for($pos=0;$pos<count($anuncios);$pos++) {
              //Con este bucle recorremos posicion a posicion el array y extraer el anuncio que hay en cada posición:
              $anuncio = $anuncios[$pos];
              $id_anuncio = $anuncio["id_anuncio"];
              //Ahora ya puedo pintar la fila en HTML:
              ?>
              <tr>
                <td><img src="../fotos/<?php echo $anuncio['foto'] ?>" width="80" /></td>
                <td><?php echo $anuncio["titulo"] ?></td>
                <td><?php echo $anuncio["fecha"] ?></td>
                <td><?php echo $anuncio["precio"] ?></td>
                <td><a href="controlador.php?op=1&id_anuncio=<?php echo $id_anuncio ?>" onclick="return confirm('¿Deseas `eliminar` este registro?')">eliminar</a></td>
                <td><a href="form_editar_anuncio.php?id_anuncio=<?php echo $id_anuncio ?>">editar</a></td>
              <tr>
            <?php } ?>
          </tbody>
        </table>
      </div>
    </main>
  </div>
</div>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
      <script>window.jQuery || document.write('<script src="../assets/js/vendor/jquery.slim.min.js"><\/script>')</script><script src="../assets/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/feather-icons/4.9.0/feather.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.min.js"></script>
        <script src="dashboard.js"></script></body>
</html>
