<?php include ('./lib/libScript.php'); ?>
<link rel="stylesheet" href="css/styleLogin.css">

<body>
<section class="container">
    <div class="login">
      <h1>Iniciar sesión</h1>
      <form method="post" action="index.php" id="frmvalida">
        <p><input type="text" name="login" value="" placeholder="Usuario"></p>
        <p><input type="password" name="pass" value="" placeholder="Contraseña"></p>
        <p class="submit"><input type="submit" name="commit" value="Iniciar Sesión"></p>
      </form>
      <form method="post" action="crearUsuario.php">
      Usuario no registrado?
      <a class="button pull-right" href="crearUsuario.php">Crear un usuario</a>
      </form>
    </div>
    </section>
</body>
<script>
    $("#frmvalida").validate({
        rules: {
            login: "required",
            pass: "required"
        },
        messages: {            
            login: "</br>Debe igresar el nombre de usuario",
            pass: "</br>Debe ingresar clave"
            }
    });
</script>

