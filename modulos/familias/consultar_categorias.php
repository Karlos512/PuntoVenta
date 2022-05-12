<?php
if (!defined("RAIZ")) {
    define("RAIZ", dirname(dirname(dirname(__FILE__))));
}
require_once RAIZ . "/modulos/db.php";
require_once RAIZ . "/modulos/familias/familias.php";
$categorias = consultar_categorias_existentes();
echo json_encode($categorias);