<?php
include ('librerias.php');
session_start();
?>
<!doctype html>
<html lang=''>
<head>
   <meta charset='utf-8'>
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <link rel="stylesheet" href="css/styles.css">
   <script src="js/jquery-latest.min.js" type="text/javascript"></script>
   <title>Lo tenemos todo</title>
</head>
<body>
<?php 
include('form/formLogin.php');

if (!isset($_SESSION["oUsuario"])){

}
else{
$oUsr=$_SESSION["oUsuario"];
?>
include('menu.php');
BIENVENIDO: <?=$oUsr->getNombre_usuario();?><a href="logout.php">Salir</a>
<?php
echo " Hora y Fecha: ";
/* mostrar hora y fecha */
$time = time();
echo date("d-m-Y (H:i:s)", $time);
}?>

<?php

?>
</body>
</html>