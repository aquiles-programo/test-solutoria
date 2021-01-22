<?= $this->extend('layouts/default') ?>

<?= $this->section('content') ?>

<script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.3/dist/Chart.min.js"></script>
<script src="js/control.js"></script>


<div class="container">
  <div class="card text-center">
    <div class="card-header">
      Indicadores Económicos
    </div>
    <ul class="nav nav-tabs" id="myTab" role="tablist">
      <?php
      if (isset($indicadores)) {
        foreach ($indicadores as $value) {
          echo '
        <li class="nav-item">
          <a class="nav-link ' . ($value == 'uf' ? 'active' : '') . '" id="profile-tab" data-toggle="tab" href="#' . $value . '" role="tab" aria-controls="profile" aria-selected="false">' . $value . '</a>
        </li>';
        }
      }
      ?>
    </ul>

    <div class="tab-content" id="myTabContent">
      <?php
      if (isset($indicadores)) {
        foreach ($indicadores as $value) {
          echo '
          <div class="tab-pane fade ' . ($value == 'uf' ? 'show active' : '') . '" id="' . $value . '" role="tabpanel" aria-labelledby="' . $value . '-tab">
            <canvas id="canvas-'.$value.'"></canvas>
          </div>
          ';
        }
      }
      ?>
    </div>
  </div>
</div>


<?= $this->endSection() ?>