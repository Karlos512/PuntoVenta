<?php
if (!isset($_SESSION)) exit("<script>window.location.href = '../';</script>");
?>
<?php if ($_SESSION["administrador"] !== 1) exit('<h1 class="text-center">Lo sentimos, solamente el administrador puede ver esta sección<br><br><i class="fa fa-hand-paper-o fa-4x"></i></h1>'); ?>

<div class="row text-center">
    <div class="col-xs-6">
        <h2 hidden="hidden"><strong>Total de productos:</strong> <span id="total_productos"></span></h2>
    </div>
    <div class="col-xs-6">
        <h2 hidden="hidden"><strong>Valor del inventario: </strong><span id="total_dinero"></span></h2>
    </div>
</div>
<div class="row hidden-print">
    <div class="col-xs-12">
        <button class="btn btn-info form-control" id="generar_reporte">Generar reporte <i class="fa fa-file-pdf-o"></i>
        </button>
    </div>
</div>
<div class="row"><br>
    <div class="col-xs-12">
        <div id="contenedor_tabla" class="table-responsive">
        </div>
    </div>
</div>
<script src="./js/reportes-inventarios.js"></script>