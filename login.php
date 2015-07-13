<?php
session_start();
include ("./librerias.php");

$usr=new Usuario("",$_POST['login'], $_POST['pass'],"","","","","","");

if($usr->VerificaAcceso()){
    $_SESSION["oUsuario"]=$login;
    $_SESSION["oUsuario"]=$pass;
}
?>
<script>
    document.location.href="index.php";
</script>
