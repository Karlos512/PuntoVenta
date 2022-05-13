<?php
if (!isset($_SESSION)) exit("<script>window.location.href = '../';</script>");
?>
<?php if ($_SESSION["administrador"] !== 1) exit('<h1 class="text-center">Lo sentimos, solamente el administrador puede ver esta sección<br><br><i class="fa fa-hand-paper-o fa-4x"></i></h1>'); ?>

<div class="row hidden-print">
    <div class="col-xs-6 text-center">
        <h4>Del</h4>
        <input id="fecha_inicio" type="datetime-local" class="form-control">
    </div>
    <div class="col-xs-6 text-center">
        <h4>Hasta</h4>
        <input id="fecha_fin" type="datetime-local" class="form-control">
    </div>
</div>
<br>
<div class="row">
    <div class="col-xs-4">
        <h4 hidden="hidden" class="text-center"><strong>Total en Ventas:</strong> $<span id="ventas"></span></h4>
    </div>
    <div class="col-xs-6">
        <h4 hidden="hidden" class="text-center"><strong>Total en caja:</strong> $<span id="total_caja"></span></h4>
    </div>
</div>
<hr style="height:2px;border-width:0;color:gray;background-color:gray"> 

<div class="row"><br>
    <div class="col-xs-12">
        <div id="contenedor_tabla" class="table-responsive">
        </div>
    </div>
</div>
<script src="./js/reporte-caja.js"></script>