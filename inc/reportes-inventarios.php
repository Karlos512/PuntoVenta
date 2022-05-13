<?php
if (!isset($_SESSION)) exit("<script>window.location.href = '../';</script>");
?>
<?php if ($_SESSION["administrador"] !== 1) exit('<h1 class="text-center">Lo sentimos, solamente el administrador puede ver esta sección<br><br><i class="fa fa-hand-paper-o fa-4x"></i></h1>'); ?>

<div class="row text-center">
    <div class="col-xs-12">
        <h4 hidden="hidden"><strong>Total de productos:</strong> <span id="total_productos"></span></h4>
    </div>
</div>
<hr style="height:2px;border-width:0;color:gray;background-color:gray"> 
<div class="row hidden-print">
    <div class="col-xs-12">
        <button class="btn btn-info form-control" id="generar_reporte">Imprimir Inventario <i class="fa fa-file-pdf-o"></i>
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