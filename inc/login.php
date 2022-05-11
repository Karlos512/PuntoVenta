<body>

<div class="col-md-4 col-md-offset-4 col-xs-12">
    <img src="img/validate.gif" alt="una imagen">
    <div class="col-md-12">
        <div class="form-group">
            <label for="usuario">Nombre de usuario</label>
            <input placeholder="Nombre de usuario" type="text" id="usuario" class="form-control">
        </div>
    </div>
    <div class="col-md-12">
        <div class="form-group">
            <label for="palabra_secreta">Contraseña</label>
            <input placeholder="Contraseña" type="password" id="palabra_secreta" class="form-control">
        </div>
    </div>
    <div class="col-md-12">
        <button id="iniciar_sesion" class="form-control btn btn-primary">Iniciar sesión</button>
    </div>
</div>
<!--  -->
</body>
<style>
body{
  width: 100%;
  color: #ffffff;
  background: -webkit-linear-gradient(left, #2293D6, #2463D3, #2293D6, #2463D3);
  background: linear-gradient(to right, #2293D6, #2463D3, #2293D6, #2463D3);
  background-size: 600% 100%;
  -webkit-animation: HeroBG 20s ease infinite;
          animation: HeroBG 20s ease infinite;
}

@-webkit-keyframes HeroBG {
  0% {
    background-position: 0 0;
  }
  50% {
    background-position: 100% 0;
  }
  100% {
    background-position: 0 0;
  }
}

@keyframes HeroBG {
  0% {
    background-position: 0 0;
  }
  50% {
    background-position: 100% 0;
  }
  100% {
    background-position: 0 0;
  }
}
</style>

<!--  -->
<script>
    $(document).ready(function () {
        $("#usuario").focus();
        escuchar_elementos();
    });

    function escuchar_elementos() {
        $("#usuario").keyup(function (evento) {
            if (evento.keyCode === 13) $("#palabra_secreta").focus();
        });

        $("#palabra_secreta").keyup(function (evento) {
            if (evento.keyCode === 13) $("#iniciar_sesion").click();
        });

        $("#iniciar_sesion").click(function () {
            var usuario = $("#usuario").val(),
                palabra_secreta = $("#palabra_secreta").val();
            if (usuario.length <= 0 || palabra_secreta.length <= 0) {
                $("#usuario").focus();
                return;
            }
            var html_original = $("#iniciar_sesion").html();
            $("#iniciar_sesion")
                .html('Comprobando... <i class="fa fa-spin fa-refresh"></i>')
                .removeClass('btn-success btn-warning btn-danger')
                .addClass('btn-warning');
            $.post('./modulos/usuarios/comprobar_datos.php', {datos_usuario: [usuario, palabra_secreta]}, function (respuesta) {

                respuesta = JSON.parse(respuesta);
                console.log("La respuesta es:", respuesta);
                if (respuesta === true) {
                    $("#iniciar_sesion")
                        .html('Correcto <i class="fa fa-check-square"></i>')
                        .removeClass('btn-success btn-warning btn-danger')
                        .addClass('btn-success')
                        .animateCss("bounceOut");
                    setTimeout(function () {
                        window.location.reload();
                    }, 200);
                } else {
                    $("#iniciar_sesion")
                        .html('Datos incorrectos <i class="fa fa-exclamation"></i>')
                        .removeClass('btn-success btn-warning btn-danger')
                        .addClass('btn-danger')
                        .animateCss("shake");
                    $("#usuario").focus();
                }
            });
        });
    }
</script>