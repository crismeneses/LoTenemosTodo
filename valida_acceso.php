<?php
include('librerias.php');
session_start();
if (!isset($_SESSION["oUsuario"])){
?>
<script>
    document.location.href="index.php";
</script>
<?php 
}
?>
