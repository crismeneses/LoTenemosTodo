<?php
session_start();
include ("librerias.php");
include ('./lib/libScript.php');
include( "modulos/PHPMailer/PHPMailerAutoload.php");
?>

<!doctype html>
<html>
    <link rel="stylesheet" href="css/styleLogin.css">
    <head>
        <title>Crear Usuario</title>
    </head>
    <body>
        <!--<div class="container">-->
            <div class="login">
                <form action="crearUsuario.php"  method="post" id="form_login">
                <h1>Formulario para crear un nuevo usuario</h1>
                <table class='table table-hover table-responsive table-bordered'>
                    <tr>
                        <td>Nombre de Usuario</td>
                        <td><input type="text" class='form-control required text' name="login"></td>
                    </tr>
                    <tr>
                        <td>Contraseña</td>
                        <td><input type="password" class='form-control required text' name="pass"></td>
                    </tr>
                    <tr>
                        <td>Nombre</td>
                        <td><input type="text" class='form-control required text' name="nombre"></td>
                    </tr>
                    <tr>
                        <td>Apellido</td>
                        <td><input type="text" class='form-control required text' name="apellido"></td>
                    </tr>
                    <tr>
                        <td>Correo</td>
                        <td><input type="text" class='form-control required text' name="correo"></td>
                    </tr>
                    <tr>
                        <td>Edad</td>
                        <td><input type="text" class='form-control required text' name="edad" style="size: 2"></td>
                    </tr>
                    <tr>
                        <td>Código de Perfil</td>
                        <td><input type="text" class='form-control required text' name="codigo"></td>
                    </tr>
                    <tr>
                        <td>Fecha de Nacimiento</td>
                        <td><input type="date" class='form-control required text' name="fechaNacimiento"></td>
                    </tr>
                    </br>
                </table>
                </br>
                <input type="submit" name="commit" value="Crear Usuario">
            </form>
            </div>
        <?php
            if ($_POST) {                
                $oUsuario = new Usuario();
                $oUsuario->login = $_POST['login'];
                $oUsuario->pass = md5($_POST['pass']);
                $oUsuario->nombre = $_POST['nombre'];
                $oUsuario->apellido = $_POST['apellido'];
                $oUsuario->correo = $_POST['correo'];
                $oUsuario->edad = $_POST['edad'];
                $oUsuario->codigo = $_POST['codigo'];
                $oUsuario->fechaNacimiento = $_POST['fechaNacimiento'];
                
                if ($oUsuario->agregarUsuario()) {
                    echo "Usuario Ingresado Correctamente";
                    echo "</div>";

                    $mail = new PHPMailer();
                    $mail->IsSMTP();
                    $mail->SMTPAuth = true;
                    $mail->SMTPSecure = 'tls';
                    $mail->Host = 'smtp.gmail.com';
                    $mail->Port = 587;
                    $mail->Username = 'cris.meneses@alumnos.duoc.cl';
                    $mail->Password = 'demo123';
                    $mail->SetFrom('cris.meneses2012@gmail.com', 'Cristian Meneses');
                    $mail->Subject = 'Creacion de usuario';
                    $mail->Body = 'Sr/Sra: ' .$_POST['nombre'] . ' ' .$_POST['apellido'] .' ';
                    $mail->AddAddress( $_POST['correo']);
                    
                    if (!$mail->Send()) {
                        echo 'Error: ' . $mail->ErrorInfo;
                    } else {
                        echo 'Mensaje enviado correctamente.';
                    }
                } else {
                    echo "No se pudo ingresar el Usuario!";
                    echo "</div>";
                }
            }
            ?>
        </div>
        <script>
            $('#form_login').validate({
                rules: {
                login: "required",
                pass: "required",
                nombre: "required",
                apellido: "required",
                correo: "required",
                edad: "required",
                codigo: "required",
                fechaNacimineto: "required",
                },
                messages: {
                login: "</br>Debe ingresar usuario",
                pass: "</br>Debe ingresar una clave",
                nombre: "</br>Debe ingresar nombre",
                apellido: "</br>Debe ingresar apellido",
                correo: "</br>Debe ingresar correo",
                edad: "</br>Debe ingresar edad",
                codigo: "</br>Debe ingresar código de perfil",
                fechaNacimineto: "</br>Debe ingresar una fecha de nacimiento"
                }                   
            });
        </script>
    </body>
</html>

