<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Gestor</title>

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

  <link href="https://cdn.datatables.net/v/bs4/jq-3.6.0/dt-1.13.4/af-2.5.3/r-2.4.1/datatables.min.css" rel="stylesheet" />

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.15.2/css/selectize.default.min.css" integrity="sha512-pTaEn+6gF1IeWv3W1+7X7eM60TFu/agjgoHmYhAfLEU8Phuf6JKiiE8YmsNC0aCgQv4192s4Vai8YZ6VNM6vyQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />

  <link rel="stylesheet" href="<?php echo site_url("assets/css/styles.css") ?>">


</head>

<body style="background-color: #c6cbce;">
  <!-- menu de navegação -->
  <main>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
      <h6 class="navbar-brand text-danger">Gestor</h6>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item <?php echo (url_is('/') ? ' active' : '') ?>">
            <a class="nav-link <?php echo (url_is('/') ? ' bg-warning text-dark' : '') ?>" href="<?php echo site_url("/") ?>">Home</span></a>
          </li>
          <li class="nav-item <?php echo (url_is('administracao*') ? ' active' : '') ?>">
            <a class="nav-link <?php echo (url_is('administracao*') ? ' bg-warning text-dark' : '') ?>" href="#">Administração</a>
          </li>
          <li class="nav-item <?php echo (url_is('pessoal*') ? ' active' : '') ?>">
            <a class="nav-link <?php echo (url_is('pessoal*') ? ' bg-warning text-dark' : '') ?>" href="#">Depto Pessoal</a>
          </li>
          <li class="nav-item">
            <a class="nav-link <?php echo (url_is('fiscal*') ? '  bg-warning text-dark' : '') ?>" href="#">Depto Fiscal</a>
          </li>
          <li class="nav-item">
            <a class="nav-link <?php echo (url_is('contabil*') ? '  bg-warning text-dark' : '') ?>" href="#">Depto Contábil</a>
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


  <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js" integrity="sha384-+sLIOodYLS7CIrQpBjl+C7nPvqq+FbNUBDunl/OZv93DB7Ln/533i8e/mZXLi/P+" crossorigin="anonymous"></script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
  <!--
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>
-->

  <script src="https://cdn.datatables.net/v/bs4/jq-3.6.0/dt-1.13.4/af-2.5.3/r-2.4.1/datatables.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/gasparesganga-jquery-loading-overlay@2.1.7/dist/loadingoverlay.min.js"></script>

  <script src="<?php echo site_url("assets/jquery/jquery.validate.js") ?>"></script>

  <script src="https://www.gstatic.com/charts/loader.js"></script>


  <script src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.15.2/js/selectize.min.js" integrity="sha512-IOebNkvA/HZjMM7MxL0NYeLYEalloZ8ckak+NDtOViP7oiYzG5vn6WVXyrJDiJPhl4yRdmNAG49iuLmhkUdVsQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

  <script src="<?php echo site_url('assets/'); ?>jquery/jquery.mask.min.js"></script>
  <script src="<?php echo site_url('assets'); ?>/js/app.js"></script>
  <script src="<?php echo site_url("assets/js/scripts-comuns.js") ?>"></script>
  <script src="<?php echo site_url("assets/js/scripts.js") ?>"></script>
  <script src="<?php echo site_url("assets/js/customer.script.js") ?>"></script>
  <script src="<?php echo site_url("assets/jquery/jquery.itens.js") ?>"></script>

  <?php echo $this->renderSection('scripts'); ?>
</body>

</html>