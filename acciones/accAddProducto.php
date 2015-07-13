<?php
include ("../librerias.php");
    if ($_POST) {
        $oProd = new Producto(NULL,$_POST["descripcion"],$_POST["descripcion"],$_POST["precio"],$_POST["unidad"]);
        if ($oProd->Agregar()) {
            echo "Producto Ingresado Correctamente!";
            echo "</div>";
        } else {
            echo "<div class=\"alert alert-danger alert-dismissable\">";
            echo "<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>";
            echo "No se pudo ingresar el Producto";
            echo "</div>";
        }
    }
            
?>
