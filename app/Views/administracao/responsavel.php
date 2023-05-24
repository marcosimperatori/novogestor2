<?php echo $this->extend('layout/principal'); ?>

<?php echo $this->section('conteudo'); ?>
<div class="my-2">
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="<?php echo site_url("/"); ?>">Home</a></li>
      <li class="breadcrumb-item"><a href="<?php echo site_url("administracao"); ?>">Administração</a></li>
      <li class="breadcrumb-item active" aria-current="page">Definir responsável por empresa</li>
    </ol>
  </nav>
</div>




<div class="jumbotron"></div>

<div class="jumbotron">

  <div class="row">
    <div class="col-6 my-2">
      <div class="accordion" id="accordionExample">
        <div class="card">
          <div class="card-header" id="headingOne">
            <h2 class="mb-0">
              <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                Responsável x 40 empresas
              </button>
            </h2>
          </div>

          <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
            <div class="card-body">
              <p>mostrar a lista de empresas aqui</p>
              Some placeholder content for the first accordion panel. This panel is shown by default, thanks to the <code>.show</code> class.
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="col-6 my-2">
      <div class="accordion" id="accordionExample1">
        <div class="card">
          <div class="card-header" id="headingOne">
            <h2 class="mb-0">
              <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#collapseOne1" aria-expanded="true" aria-controls="collapseOne">
                Responsável y 32 empresas
              </button>
            </h2>
          </div>

          <div id="collapseOne1" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample1">
            <div class="card-body">
              <p>mostrar a lista de empresas aqui</p>
              Some placeholder content for the first accordion panel. This panel is shown by default, thanks to the <code>.show</code> class.
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="col-6 my-2">
      <div class="accordion" id="accordionExample1">
        <div class="card">
          <div class="card-header" id="headingOne">
            <h2 class="mb-0">
              <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#collapseOne2" aria-expanded="true" aria-controls="collapseOne">
                Responsável y 32 empresas
              </button>
            </h2>
          </div>

          <div id="collapseOne2" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample1">
            <div class="card-body">
              <p>mostrar a lista de empresas aqui</p>
              Some placeholder content for the first accordion panel. This panel is shown by default, thanks to the <code>.show</code> class.
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

</div>

<?php $this->endSection(); ?>