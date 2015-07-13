<?php
    include_once ('../librerias.php');
    print_r($_POST);
    if(isset($_POST["agregar"])){
            $oProd = new Producto(NULL,$_POST["descripcion"],$_POST["descripcion"],$_POST["precio"],$_POST["unidad"],$_POST["id_tipo"]);
            $oProd->Agregar();
    }
    elseif (isset($_POST["accion"])){
        if($_POST["accion"] == "borrar"){
            if(isset($_POST["producto_seleccionado"])){
                $borrar_prod = $_POST["producto_seleccionado"];
                $catBorrar = new Producto();
                foreach($borrar_prod as $idCat){
                        $catBorrar->Elimina($idCat);
                }
            }
        }
    }
    header ("Location: agregarProducto.php");	
?>