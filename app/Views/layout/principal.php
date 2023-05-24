<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Gestor</title>

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

  <link href="https://cdn.datatables.net/v/bs4/jq-3.6.0/dt-1.13.4/af-2.5.3/r-2.4.1/datatables.min.css" rel="stylesheet" />



  <link rel="stylesheet" href="<?php echo site_url("assets/css/styles.css") ?>">


</head>

<body>
  <!-- menu de navegação -->
  <main>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
      <a class="navbar-brand" href="#">Gestor</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item <?php echo (url_is('/') ? ' active' : '') ?>">
            <a class="nav-link <?php echo (url_is('/') ? ' text-warning' : '') ?>" href="<?php echo site_url("/") ?>">Home</span></a>
          </li>
          <li class="nav-item <?php echo (url_is('administracao*') ? ' active' : '') ?>">
            <a class="nav-link <?php echo (url_is('administracao*') ? ' text-warning' : '') ?>" href="#">Administração</a>
          </li>
          <li class="nav-item <?php echo (url_is('pessoal*') ? ' active' : '') ?>">
            <a class="nav-link <?php echo (url_is('pessoal*') ? ' text-warning' : '') ?>" href="#">Depto Pessoal</a>
          </li>
          <li class="nav-item">
            <a class="nav-link <?php echo (url_is('fiscal*') ? ' text-warning' : '') ?>" href="#">Depto Fiscal</a>
          </li>
          <li class="nav-item">
            <a class="nav-link <?php echo (url_is('contabil*') ? ' text-warning' : '') ?>" href="#">Depto Contábil</a>
          </li>
        </ul>
        <form class="form-inline my-2 my-lg-0">
          <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
          <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
        </form>
      </div>
    </nav>
  </main>
  <!-- fim menu de navegação -->

  <!-- conteúdo do site -->
  <div class="container my-3">

    <?php echo $this->renderSection('caminho'); ?>
    <?php echo $this->include('layout/mensagens'); ?>
    <?php echo $this->renderSection('conteudo'); ?>
  </div>
  <!-- fim conteúdo do site -->

  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>


  <script src="https://cdn.datatables.net/v/bs4/jq-3.6.0/dt-1.13.4/af-2.5.3/r-2.4.1/datatables.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/gasparesganga-jquery-loading-overlay@2.1.7/dist/loadingoverlay.min.js"></script>

  <script src="<?php echo site_url('assets/'); ?>jquery/jquery.mask.min.js"></script>
  <script src="<?php echo site_url('assets'); ?>/js/app.js"></script>
  <script src="<?php echo site_url("assets/js/scripts.js") ?>"></script>
  <script src="<?php echo site_url("assets/js/customer.script.js") ?>"></script>

</body>

</html>