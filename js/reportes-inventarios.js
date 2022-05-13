var limite = 1000,
    orden = "asc",
    filtro = "nombre";
$(document).ready(function () {
    $("#cambiar_limite").val(limite);
    $("#orden").val(orden);
    $("#filtro").val(filtro);
    consulta_todos_los_productos();
    escuchar_elementos();
    $("li#elem_reportes").addClass("active");
    consultar_valor_del_inventario();
});

function consultar_valor_del_inventario() {
    $.post("./modulos/inventario/consultar_valor_del_inventario.php", function (data) {
        var respuesta = JSON.parse(data);
        if (respuesta !== "Restringido" && !isNaN(respuesta)) $("#total_dinero").text(respuesta.slice(0,-2)).parent().show();
    });
}

function escuchar_elementos() {

    $("#generar_reporte").click(function () {
        $("#fecha_hoy").html(dame_fecha());
        window.print();
    });

    $("#orden").change(function (event) {
        orden = $(this).val();
        consulta_todos_los_productos();
    });

    $("#filtro").change(function (event) {
        filtro = $(this).val();
        consulta_todos_los_productos();
    });
}
function isInt(n) {
    return n % 1 === 0;
}
function consulta_todos_los_productos() {
    $.post('./modulos/inventario/consultar_todos_los_productos_reportes.php', {
        limite: limite,
        orden: orden,
        filtro: filtro
    }, function (respuesta) {
        respuesta = JSON.parse(respuesta);
        dibuja_tabla(respuesta);
    });
}
function dame_fecha() {
    var d = new Date($.now());
    var año = d.getFullYear();
    var mes_temporal = d.getMonth() + 1;
    var mes = (mes_temporal < 10) ? "0" + mes_temporal : mes_temporal;
    var dia = (d.getDate() < 10) ? "0" + d.getDate() : d.getDate();
    var hora = (d.getHours() < 10) ? "0" + d.getHours() : d.getHours();
    var minutos = (d.getMinutes() < 10) ? "0" + d.getMinutes() : d.getMinutes();
    return año + "-" + mes + "-" + dia + " " + hora + ":" + minutos;
}
function dibuja_tabla(productos) {
    $("#total_productos").text("").parent().hide();
    $("#generar_reporte").hide();
    $("#contenedor_tabla")
        .empty();
    if (productos.length <= 0) return;
    $("#contenedor_tabla")
        .append(
            $("<table>")
                .addClass('table table-striped table-bordered table-hover table-condensed')
                .append(
                    $("<thead>")
                        .append(
                            $("<tr style='color:white; background-color:#203EA6;'>")
                                .append(
                                    $("<th>")
                                        .html('Código'),

                                    $("<th>")
                                        .html('Nombre'),

                                    $("<th>")
                                        .html('Precio de compra'),

                                    $("<th>")
                                        .html('Precio de venta'),

                                    $("<th>")
                                        .html('Utilidad'),

                                    $("<th>")
                                        .html('Cantidad'),

                                    $("<th>")
                                        .html('Categoría')
                                )
                        )
                )
                .append(
                    $("<tbody>")
                )
        );
    var total_productos = productos.length,
        total_dinero = 0;
    for (var i = total_productos - 1; i >= 0; i--) {
        total_dinero += parseFloat(productos[i].precio_venta);
        $("#contenedor_tabla tbody")
            .append(
                $("<tr>")
                    .append(
                        $("<td>").html(productos[i].codigo),
                        $("<td>").html(productos[i].nombre),
                        $("<td>").html(productos[i].precio_compra),
                        $("<td>").html(productos[i].precio_venta),
                        $("<td>").html(productos[i].utilidad),
                        $("<td>").html(productos[i].existencia),
                        $("<td>").html(productos[i].familia)
                    )
            );
    }
    $("#total_productos").text(total_productos).parent().show();
    $("#generar_reporte").show();
    return;
}