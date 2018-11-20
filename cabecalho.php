<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta http-equiv=”content-type” content=”text/html; charset=UTF-8″ />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="https://getbootstrap.com/docs/4.1/examples/navbar-fixed/navbar-top-fixed.css" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <title>CADPALE</title>
  </head>


  <body style="min-height: auto;">
  <nav class="navbar navbar-expand-md navbar-light fixed-top bg-primary">
      <a class="navbar-brand border border-dark pl-2 pr-2 ml-4 font-weight-bold" href="index.php">CADPALE</a>

      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarCollapse">

        <ul class="navbar-nav mr-auto">
          <li class="nav-item">
            <a class="nav-link" href="paleform.php?tipo=incluir">Cadastrar Palestra</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="index.php">Visualizar Palestras<span class="sr-only">(current)</span></a>
          </li>
        </ul>

        <?php
          $url = $_SERVER['REQUEST_URI'];
          $termo = "index.php";
          $pattern = '/' . $termo . '/';
          if (preg_match($pattern, $url)) {
        ?>
        <form class="form-inline mt-2 mt-md-0" method="get">
          <input class="form-control mr-sm-2 text-center" name="palestra" type="text" placeholder="Buscar" aria-label="Search" value="<?php if(isset($_GET['palestra'])){ echo $_GET['palestra']; } else{ echo ""; } ?>">
          <button class="btn btn-outline-dark my-2 my-sm-0 border border-dark" type="submit">Filtrar</button>
        </form>
        <?php
          }
        ?>

      </div>
    </nav>
    <div class="container">
